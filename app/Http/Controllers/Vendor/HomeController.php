<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

use App\Category;
use App\Offer;
use App\Order;
use App\Stuff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::with('Offers')->whereHas('Offers', function ($query) {
            return $query->where('status', '0')->orWhere([
                ['vendor_id', '=', auth()->user()->id], ['status', '=', '1']
            ]);
        })->orWhereDoesntHave('Offers')->orderBy('created_at', 'desc')->get();
        return view('vendor.home', compact('orders'));
    }
    public function support()
    {
        return view('vendor.support.index');
    }

    public function catalog_search(Request $request)
    {
        $keyword = $request->keyword;
        $category = Category::all();
        $stuffs_forsearch = Stuff::all(); // use for search
        $stuffs_names = [];
        foreach ($stuffs_forsearch as $stuff) {
            array_push($stuffs_names, $stuff->name);
        }
        $stuffs = Stuff::where('name', 'LIKE', "%$keyword%")->get();

        return view('vendor.catalog_search', compact('stuffs', 'stuffs_names'));
    }

    public function accounting(Request $request)
    {

        $success_offers = Offer::where('vendor_id', auth()->user()->id)->where('status', '>', 0)->orderBy('updated_at', 'DESC')->get();
        if (isset($request->from) && isset($request->to)) {
            $from = date("Y-m-d H:i:s", $request->from / 1000);
            $to = date("Y-m-d H:i:s", $request->to / 1000);
            $success_offers = Offer::where('vendor_id', auth()->user()->id)->where('status', '>', 0)->whereBetween('created_at', [$from, $to])->orderBy('updated_at', 'DESC')->get();
        }

        return view('vendor.accounting.index', compact('success_offers'));
    }
    public function user_edit(){
        return view('vendor.user_edit');
    }
}
