<?php

namespace App\Http\Controllers\Vendor;

use App\Category;
use App\Http\Controllers\Controller;
use App\Stuff;
use App\Notification;
use App\Vendor\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.setting.index');
    }

    // public function catalog($name = null){
    //     $user = auth()->user();
    //     $category = Category::all();
    //     if(!$name || $name == 'همه'){
    //         $stuffs = Stuff::all();
    //     }else{
    //         $stuffs =  $category->where('name',$name)->first()->stuffs()->orderBy('created_at', 'desc')->get();
    //     }
    //     $notifications = $user->UserAttr()->first()->notifications;
    //     return view('vendor.setting.catalog',compact('notifications','user','category','stuffs','name'));
    // }

    public function catalog($name = null)
    {

        $stuffs_forsearch = Stuff::all(); // use for search
        $stuffs_names = [];
        foreach ($stuffs_forsearch as $stuff) {
            array_push($stuffs_names, $stuff->name);
        }
        $notifications = auth()->user()->UserAttr()->first()->notifications;
        $category = Category::all();
        if (!$name || $name == 'همه') {
            $stuffs = Stuff::all();
        } else {
            $stuffs =  $category->where('name', $name)->first()->stuffs()->get();
        }
        return view('vendor.setting.catalog', compact('notifications','category', 'stuffs', 'name','stuffs_names'));
    }


    public function notification_unset($variable){
        $notifications = explode(',',auth()->user()->UserAttr()->first()->notifications);
        $notifications_new = array_values(array_diff($notifications,[$variable]));
        $notifications_new_encoded = implode(',',$notifications_new);
        auth()->user()->UserAttr()->update([
             'notifications' => $notifications_new_encoded
         ]);
         return redirect()->back();
    }


    public function notification_insert($variable){
        $notifications = explode(',',auth()->user()->UserAttr()->first()->notifications);
        array_push($notifications,$variable);
        $notifications_new = array_unique($notifications);
        $notifications_new_encoded = implode(',',$notifications_new);
        auth()->user()->UserAttr()->update([
             'notifications' => $notifications_new_encoded
         ]);
         return redirect()->back();

    }
}
