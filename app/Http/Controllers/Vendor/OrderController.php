<?php

namespace App\Http\Controllers\Vendor;

use App\Events\Client\Order_find_offer;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\Offer;
use App\User;
use Illuminate\Http\Request;

use function React\Promise\reduce;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //orderayi ke offer nadaran
        //orderayi ke offer daran vali status 0 an (pardakht nashodan)
        //orderayi ke pardakht shodan vali ersan va VENDORE U oono bayad ersal koni nashodan
        $orders = Order::with('Offers')->whereHas('Offers', function ($query) {
            return $query->where('status', '0')->orWhere([
                ['vendor_id', '=', auth()->user()->id], ['status', '=', '1']
            ]);
        })->orWhereDoesntHave('Offers')->orderBy('created_at', 'desc')->paginate(5);
        return view('vendor.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        if ($order !== null && Offer::where('order_id', $order->id)->where('status', '>', 0)->exists()) {
            return redirect()->route('vendor_order_index');
        } else {
            if ($order !== null) {
                return view('vendor.order.show', compact('order'));
            } else {
                return redirect()->back();
            }
        }
    }



    public function convert(Request $request)
    {


        if (Offer::where('order_id', $request->order_id)->where('vendor_id', auth()->user()->id)->exists()) {
            return redirect()->back()->withErrors('شما قبلا به این درخواست پیشنهاد دادید');
        }


        $validate = $request->validate([
            'price' => 'required',
            'unit' => 'required'
        ]);
        $order = Order::find($request->id);
        $client = $order->User();
        $cilent_id = $client->first()->id;
        $vendor = Auth()->user();
        $vendor_id = $vendor->id;




        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
        }


        $offer = Offer::create([
            'vendor_id' => $vendor_id,
            'client_id' => $cilent_id,
            'order_id' => $order->id,
            'name' => $request->name,
            'image' => $path ?? '',
            'count' => $request->count,
            'expire' => $request->expire ?? null,
            'unit' => $request->unit,
            'order_brand' => $order->brand,
            'offer_brand' => $request->brand,
            'price' => $request->price,
        ]);
        $event_message="پیشنهاد جدید برای سفارش".$request->name;

        $client = User::where('id', $cilent_id)->first();
        event(new Order_find_offer($client, $event_message));
        app('App\Http\Controllers\WhatsappController')->send_notification($client, $event_message);


        $client_trimed_phone = trim($client->phone, 'xx');
        if (User::where('phone', 'LIKE', "%$client_trimed_phone%")->exists()) {
            $bad_user = User::where('phone', 'LIKE', "%$client_trimed_phone%")->first();
            event(new Order_find_offer($bad_user, $event_message));
            app('App\Http\Controllers\WhatsappController')->send_notification($bad_user, $event_message);
        }

        Notification::create([
            'user_id' => $cilent_id,
            'message' => $event_message,
            'tag' => 'انتخاب شده'
        ]);
        return redirect()->route('vendor_offer_show', [$offer->id]);
    }
}
