<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\BannerSelected;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('updated_at','DESC')->get();
        return view('admin.banner.index',compact('banners'));
    }
    public function edit(){
        $banners = BannerSelected::orderBy('updated_at','DESC')->get();
        return view('admin.banner.edit',compact('banners'));

    }
    public function banner_selected_store(Request $request)
    {

        $validated = $request->validate([
            'link' => 'required',
            'title' => 'required',
            'image' => 'required',
            'location_2' => 'required',
            'location_1' => 'required',
        ]);
        $path = "https://via.placeholder.com/300";
        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
        }
        BannerSelected::create([
            'title'=> $request->title,
            'link'=> $request->link,
            'image'=> $path,
            'location_1'=> $request->location_1,
            'location_2'=> $request->location_2,
        ]);
        return redirect()->back()->with('msg','بنر یا موفقیت ایجاد شد');
    }



    public function banner_selected_update(Request $request)
    {
        $validated = $request->validate([
            'link' => 'required',
            'title' => 'required',
            'location_2' => 'required',
            'location_1' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
            BannerSelected::where('id',$request->id)->update([
                'image'=> $path,
            ]);
        };
        BannerSelected::where('id',$request->id)->update([
            'title'=> $request->title,
            'link'=> $request->link,
            'location_1'=> $request->location_1,
            'location_2'=> $request->location_2,
        ]);
        return redirect()->back()->with('msg','بنر آپدیت شد');
    }

}
