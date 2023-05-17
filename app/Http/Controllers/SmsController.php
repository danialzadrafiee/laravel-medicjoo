<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sms_active()
    {

        return view('auth.sms');
    }
    public function send_code()
    {
        $code =  rand(1000, 9999);
        \Smsirlaravel::sendVerification($code,auth()->user()->phone);
        return $code;
    }
    public function account_actived()
    {
        auth()->user()->UserAttr()->update([
            'active' =>1
        ]);
        return redirect()->route('login');
    }
}
