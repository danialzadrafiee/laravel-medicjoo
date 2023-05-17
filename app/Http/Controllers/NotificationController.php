<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id',Auth()->user()->id)->where('hidden',0)->orderBy('created_at', 'DESC')->get();
        return view('notification.index',compact('notifications'));
    }
    public function hide($id)
    {
        Notification::where('id',$id)->update([
            'hidden'=>1,
        ]);
        return redirect()->back()->with('msg', 'اعلان حذف شد.');
    }
}
