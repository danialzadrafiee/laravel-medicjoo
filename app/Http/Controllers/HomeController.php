<?php

namespace App\Http\Controllers;

use App\Banner;
use App\ForgetCode;
use App\Offer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start()
    {
        $user = auth()->user();
        // dd($user);
        $user['role'] =  $user->UserAttr()->first()->job;
        switch ($user['role']) {
            case 'client':
                return redirect()->route('client_index');
                break;
            case 'vendor':
                return  redirect()->route('vendor_index');
                break;
            case 'admin':
                return  redirect()->route('admin_index');
                break;
        }
    }

    public function banner()
    {
        return view('banner.index');
    }
    public function banner_store(Request $request)
    {
        $validated = $request->validate([

            'location' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
            'link' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->image->store('uploads', 'public');
        }

        Banner::create([
            'user_id' => auth()->user()->id,
            'location' => $request->location,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('msg', 'درخواست شما برای تبلیغ ثبت شد، به زودی کارشناس مربوط با شما تماس میگیرد');
    }


}
