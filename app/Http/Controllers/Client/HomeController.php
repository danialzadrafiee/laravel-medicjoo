<?php

namespace App\Http\Controllers\Client;

use App\BannerSelected;
use App\Http\Controllers\Controller;

use App\Category;
use App\Stuff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // check notif wp
        // app('App\Http\Controllers\WhatsappController')->send_notification();

        $stuffs = Stuff::all(); // use for search
        $stuffs_names = [];
        foreach ($stuffs as $stuff) {
            array_push($stuffs_names, $stuff->name);
        }

        $banners_1 = BannerSelected::where('location_1', 1)->orderBy('location_2')->get();
        $banners_2 = BannerSelected::where('location_1', 2)->orderBy('location_2')->get();
        return view('client.home', compact('stuffs_names','banners_1','banners_2'));
    }

    public function catalog($name = null)
    {

        $stuffs_forsearch = Stuff::all(); // use for search
        $stuffs_names = [];
        foreach ($stuffs_forsearch as $stuff) {
            array_push($stuffs_names, $stuff->name);
        }

        $category = Category::all();
        if (!$name || $name == 'همه') {
            $stuffs = Stuff::all();
        } else {
            $stuffs =  $category->where('name', $name)->first()->stuffs()->get();
        }
        return view('client.catalog', compact('category', 'stuffs', 'name','stuffs_names'));
    }
    public function client_support()
    {
        return view('client.support');
    }

    public function catalog_search(Request $request){
        $keyword = $request->keyword;
        $category = Category::all();
        $stuffs_forsearch = Stuff::all(); // use for search
        $stuffs_names = [];
        foreach ($stuffs_forsearch as $stuff) {
            array_push($stuffs_names, $stuff->name);
        }
        $stuffs = Stuff::where('name', 'LIKE', "%$keyword%")->get();

        return view('client.catalog_search',compact('stuffs','stuffs_names'));

    }
    public function news()
    {
        return view('client.news');
    }
    public function user_edit()
    {
        return view('client.user_edit');
    }
}
