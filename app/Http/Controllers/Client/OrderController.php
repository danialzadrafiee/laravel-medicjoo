<?php

namespace App\Http\Controllers\Client;

use App\Events\Vendor\Order_created;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WhatsappController;
use App\Notification;
use App\Notifications\OrderCreateNotification;
use App\Offer;
use App\Order;
use App\Stuff;
use App\User;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index_active()
    {
        $stuffs = Stuff::all(); // use for search
        $stuffs_names = [];
        foreach ($stuffs as $stuff) {
            array_push($stuffs_names, $stuff->name);
        }
        $orders = Order::where([
            ['status', '=', 0],
            ['user_id', '=', auth()->user()->id]
        ])->orWhere([
            ['status', '=', 1], ['user_id', '=', auth()->user()->id]
        ])->orderBy('created_at', 'desc')->paginate(5);
        return view('client.order.index_active', compact('orders', 'stuffs_names'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'count' => 'required',
            'unit' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        };
        $order = ORDER::Create([
            "user_id" => Auth::id(),
            "name" => $request->name,
            "brand" => $request->brand ?: 'بدون برند',
            "count" =>  $request->count,
            "order_describe" =>  $request->order_describe ?: 'بدون توضیح',
            "unit" => $request->unit,
        ]);

        $event_message =  "درخواست برای : " . $request->name;


        //send notif for vendor and badusers
        // todo geto bardashtam chon error intelece midad
        
        // $vendors = User::with('UserAttr')->whereHas('UserAttr', function ($e) {
        //     global $request;
        //     return $e->where('job', 'vendor')->where('notifications', 'LIKE', "%$request->name%");
        // })->get();

        $vendors = User::with('UserAttr')->whereHas('UserAttr', function ($e) {
            global $request;
            return $e->where('job', 'vendor')->where('notifications', 'LIKE', "%$request->name%");
        });


        foreach ($vendors as $vendor) {

            Notification::create([
                'user_id' => $vendor->id,
                'message' => $event_message,
                'tag' => 'درخواست جدید',
            ]);
            event(new Order_created($vendor, $event_message));
            app('App\Http\Controllers\WhatsappController')->send_notification($vendor, $event_message);



            // ersale notif be bad_auth users (FELAN OFFE CHON BA JOFT LOGINE)
            // $vendor_trimed_phone = trim($vendor->phone, 'xx');
            // if (User::where('phone', 'LIKE', "%$vendor_trimed_phone%")->exists()) {
            //     $bad_user = User::where('phone', 'LIKE', "%$vendor_trimed_phone%")->first();
            //     event(new Order_created($bad_user, $event_message));
            // }
            // todo moshakhas kardane taklife notification bara baduser
        }



        return redirect()->route('client_order_show', $order->id)->with('msg', 'سفارش شما با موفقیت ثبت شد');
    }



    public function show($id)
    {
        $order = Order::find($id);
        return view('client.order.show', compact('order'));
    }


    public function destroy($id)
    {
        if (Offer::where('order_id', $id)->where('status', '!=', 0)->exists()) {
            return redirect()->back()->withError('لغو سفارش شما ممکن نیست ، با پشتیبانی تماس بگیرید');
        }

        if (Offer::where('order_id', $id)->where('status', 0)->exists()) {
            Offer::where('order_id', $id)->where('status', 0)->update([
                'status' => '-11'
            ]);
        }

        Offer::where('order_id', $id)->update([
            'status' => '-11'

        ]);
        Order::where('id', $id)->delete();
        return redirect()->route('client_order_index_active');
    }
}
