<?php

namespace App\Http\Controllers\Client;

use App\Credit;
use App\Events\Vendor\Offer_selected;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Order;
use App\User;
use App\Notification;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::where('client_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('client.offer.index', compact('offers'));
    }
    public function list_order_offers($id)
    {
        $offers = Offer::where('order_id', $id)->where('status', 0)->orderBy('created_at', 'desc')->paginate(5);
        return view('client.offer.index', compact('offers'));
    }
    public function detect($order_id)
    {
        $user = auth()->user();
        $offers = Offer::where('client_id', $user->id)->where('order_id', $order_id)->where('status', 1)->orderBy('created_at', 'desc')->paginate(5);
        return view('client.offer.detect', compact('offers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offer::find($id);
        return view('client.offer.show', compact('offer'));
    }

    public function choose($id)
    {

        $addresses = auth()->user()->UserAddresses()->orderBy('created_at', 'desc')->paginate(5);
        if (empty($addresses->first())) {
            return redirect()->route('client_setting_address_create')->with('msg', 'برای سفارش باید ابتدا آدرس خودرا ثبت کنید');
        }
        $offer = Offer::find($id);
        if (!$offer) {
            return redirect()->back();
        }
        if ($offer->status >= 1) {
            return redirect()->route('client_offer_show', $offer->id);
        }
        if ($offer->status < 0) {
            return redirect()->back();
        }
        return view('client.offer.choose', compact('offer', 'addresses'));
    }
    public function change_status($offer_id, Request $request)
    {
        $offer = Offer::where('id', $offer_id);
        $offer->update([
            'status' => $request->status
        ]);
        $order = Order::where('id', $offer->first()->order_id);
        $order->update([
            'status' => $request->status
        ]);
        if ($request->redirect == null) {
            return redirect()->back();
        }
        return redirect()->route($request->redirect, $offer_id)->with(['msg' => ' سفارش شما ثبت شد و درحال بررسی است']);
    }

    public function select(Request $request)
    {



        // اگه پیمیت اوکی بود
        $validate = $request->validate([
            'payment_method' => 'required',
            'address' => 'required',
        ]);

        //چک کردن آدرس خالی
        if ($request->address == 'افزودن آدرس جدید') {
            return redirect()->back()->withErrors('آدرس معتبر نیست');
        }
        $offer = Offer::where('id', $request->offer_id);

        //اگه پیمنت اعتباری بود
        if ($request->payment_method == 'credit') {
            $userCredit = Credit::where('user_id', auth()->user()->id)->sum('change');
            if ($userCredit < $offer->first()->price) {
                return redirect()->back()->withErrors('اعتبار برای این سفارش کافی نیست');
            }
            //کثر از اعتبار
            auth()->user()->credit()->create([
                'change' => $offer->first()->price * -1,
                'describe' => 'خرید اعتباری',
            ]);
        }


        // اگه پیمینت آنلاین بود
        if ($request->payment_method == 'online') {
            // dd($request);
            $merchant_id = "354c9418-c7a3-4dc7-b49c-0c42b660daf1";
            $phone = auth()->user()->phone;
            $offer_id = $request->offer_id;
            $offer_price = $offer->first()->price * 10; //rial to toman
            // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.zarinpal.com/pg/v4/payment/request.json');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"merchant_id\": \"$merchant_id\",\n  \"amount\": $offer_price,\n  \"callback_url\": \"http://medicjoo.com/order_online?offer_id=$offer_id\",\n  \"description\": \"پرداخت آنلاین مدیکجو\",\n  \"metadata\": {\"mobile\": \"$phone\",\"email\": \"mail@medicjoo.com\"}\n}");

            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            $auth = json_decode($result)->data->authority ?? '';
            header("Location: https://www.zarinpal.com/pg/StartPay/" . $auth);
            exit;
        }


        // به فروشنده ناتیف میده که برای پیشنهادت انتخاب شده
        $event_message = " سفارش " . $offer->first()->name . " انتخاب شد ";

        $vendor = User::where('id', $offer->first()->vendor_id)->first();

        event(new Offer_selected($vendor, $event_message));
        app('App\Http\Controllers\WhatsappController')->send_notification($vendor, $event_message);


        //bad user notif

        $vendor_trimed_phone = trim($vendor->phone, 'xx');

        if (User::where('phone', 'LIKE', "%$vendor_trimed_phone%")->exists()) {
            $bad_user = User::where('phone', 'LIKE', "%$vendor_trimed_phone%")->first();
            event(new Offer_selected($bad_user, $event_message));
            app('App\Http\Controllers\WhatsappController')->send_notification($vendor, $event_message);
        }

        // زخیره ناتیف تو دیتابیس
        Notification::create([
            'user_id' => $offer->first()->vendor_id, // ناتیف برای کی میره
            'message' => $event_message,
            'tag' => 'انتخاب شده'
        ]);

        $offer->update([
            'status' => 1,
            'address' => $request->address,
        ]);

        // آفر بقیه لغو شه
        $offer_other = Offer::where('id', '!=', $request->offer_id)->where('order_id', $offer->first()->order_id);
        $offer_other->update([
            'status' => -1,
        ]);


        return redirect()->route('client_offer_show', $offer->first()->id);
        //ino ghablan order_id gozashte boodam va nemidoonam chera
    }
    public function order_online(Request $request)
    {
        //بعد از پرداخت اینجا لود میشه
        $offer = Offer::where('id', $request->offer_id);
        if ($request->Status == "OK") {
            //todo amniat ezafe she ke dasti natoone data bezane
            // به فروشنده ناتیف میده که برای پیشنهادت انتخاب شده
            $event_message = " سفارش " . $offer->first()->name . " انتخاب شد ";
            $vendor = User::where('id', $offer->first()->vendor_id)->first();
            event(new Offer_selected($vendor, $event_message));
            app('App\Http\Controllers\WhatsappController')->send_notification($vendor, $event_message);

            //bad user notif
            $vendor_trimed_phone = trim($vendor->phone, 'xx');
            if (User::where('phone', 'LIKE', "%$vendor_trimed_phone%")->exists()) {
                $bad_user = User::where('phone', 'LIKE', "%$vendor_trimed_phone%")->first();
                event(new Offer_selected($bad_user, $event_message));
                app('App\Http\Controllers\WhatsappController')->send_notification($vendor, $event_message);
            }
            // زخیره ناتیف تو دیتابیس
            Notification::create([
                'user_id' => $offer->first()->vendor_id, // ناتیف برای کی میره
                'message' => $event_message,
                'tag' => 'انتخاب شده'
            ]);
            $offer->update([
                'status' => 1,
                'address' => $request->address,
            ]);
            // آفر بقیه لغو شه
            $offer_other = Offer::where('id', '!=', $request->offer_id)->where('order_id', $offer->first()->order_id);
            $offer_other->update([
                'status' => -1,
            ]);

            return redirect()->route('client_offer_show', $offer->first()->id);
        } else {
            return redirect()->route('client_offer_choose', ['id' => $request->offer_id])->withErrors('پرداخت موفق نبود');
        }
    }

    public function history()
    {
        $user = auth()->user();
        // $offers = Offer::where('client_id',$user->id)->where('status','3')->paginate(5);
        $offers = Offer::where('client_id', $user->id)->where('status', '2')->orderBy('created_at', 'desc')->paginate(5);
        // felan history nadarim az 2 ke 2 saat gozasht history neshoon mide

        return view('client.offer.history', compact('offers'));
    }

    public function actives()
    {
        $user = auth()->user();
        $offers = Offer::where('status', '2')->where('client_id', $user->id)->orderBy('created_at', 'desc')->paginate(5); //active offers
        return view('client.offer.actives', compact('offers'));
    }
}