<?php

namespace App\Http\Controllers;

use App\UserAttr;
use Illuminate\Http\Request;

class UserAttrController extends Controller
{
    public function user_not_approved()
    {
        return view('auth.user_not_approved');
    }
    public function admin_approve_status($user_id, $status)
    {
        UserAttr::where('user_id', $user_id)->first()->update([
            'approved' => $status
        ]);
        return redirect()->back()->with('msg', 'وضعیت فعال سازی کاربر ویرایش شد');
    }
}
