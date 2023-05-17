<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Offer;
use App\Order;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('vendor_id', auth()->user()->id)->where('status', '<', '2')->orderBy('created_at', 'desc')->paginate(5);
        return view('vendor.offer.index', compact('offers'));
    }

    public function show($id)
    {
        $offer = Offer::find($id);
        return view('vendor.offer.show', compact('offer'));
    }
    public function sended($id)
    {
        $offer = Offer::where('id', $id);
        $order = Order::where('id', $offer->first()->order_id);
        $offer->update([
            'status' => 2
        ]);
        $order->update([
            'status' => 2
        ]);
        return redirect()->route('vendor_history_index');
    }

    public function history()
    {
        $history = Offer::where('vendor_id', auth()->user()->id)->where('status', 2)->orderBy('created_at', 'desc')->paginate(5);
        return view('vendor.history.index', compact('history'));
    }

    public function destroy($id)
    {

        $offer = Offer::where('id', $id)
            ->where('status', '<', 0) // jolo giri az pack kardane sefareshaye order salem
            ->delete();
        return redirect()->back()->with('msg', 'سفارش حذف شد');
    }
}
