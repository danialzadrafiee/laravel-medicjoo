<?php

namespace App\Http\Controllers;

use App\BadAuth;
use App\BeVendor;
use App\User;
use Hash;
use Illuminate\Http\Request;

class BadAuthController extends Controller
{
    public function store(Request $request)
    {
        //remove bevendor request
        BeVendor::where('user_id', $request->user_id)->delete();

        //create bad auth bridge
        BadAuth::create([
            'user_id' => $request->user_id,
            'phone' => $request->phone,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'password' => $request->password,
            'active' => 1,
        ]);
        //create vendor user
        $user =  User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $user->UserAttr()->create([
            'user_id' => $user->id,
            'job' => 'vendor',
            'active' => 1
        ]);

        //todo send notification u are vendor now
        return redirect()->back()->with('msg', 'سمت جدید برای کاربر فعال شد');
    }
    public function user_update(Request $request)
    {
        $validated = $request->validate([
            'password' => ['confirmed']
        ]);


        $thisuser = auth()->user();


        if (isset($request->password)) {
            $thisuser->update([
                'password' => Hash::make($request->password),
            ]);
        }
        //phone
        if (isset($request->phone)) {
            $thisuser->update([
                'phone' => $request->phone,
            ]);
        }
        //name
        if (isset($request->name)) {
            $thisuser->update([
                'name' => $request->name,
            ]);
        }
        //edit badauth and vendor
        if (BadAuth::where('user_id', auth()->user()->id)->exists()) {
            $badauth = BadAuth::where('user_id', auth()->user()->id)->first();
            $vendorUser = User::where('phone', $badauth->phone)->first();
            //password
            if (isset($request->password)) {
                $badauth->update([
                    'password' => $request->password,
                ]);
                $vendorUser->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            //phone
            if (isset($request->phone)) {
                $badauth->update([
                    'phone' => 'xx' . $request->phone,
                ]);
                $vendorUser->update([
                    'phone' => 'xx' . $request->phone,
                ]);
            }
            //name
            if (isset($request->name)) {
                $badauth->update([
                    'name' => $request->name,
                ]);
                $vendorUser->update([
                    'name' => $request->name,
                ]);
            }
        }
        return redirect()->back()->with('msg', 'تغییرات اعمال شد');
    }
    // ******
    public function user_update_with_code(Request $request)
    //in dge phono update nemikone bahash usero peyda mikone
    {
        // $thisuser = auth()->user();
        if (!User::where('phone', $request->phone)->exists()) {
            return redirect()->back()->withErrors('شماره همراه شما در سیستم وجود ندارد');
        }
        $thisuser = User::where('phone', $request->phone)->first();
        //**** */    
        $validated = $request->validate([
            'password' => ['confirmed']
        ]);
        if (!$thisuser->ForgetCode()->exists()) {
            return redirect()->back()->withErrors('کدفعال تایید معتبر نیست');
        }
        // 
        $thisuser_lastcode = $thisuser->ForgetCode()->latest()->first()->code;
        if ($thisuser_lastcode != $request->code) {
            return redirect()->back()->withErrors('کدفعال تایید معتبر نیست');
        }

        if (isset($request->password)) {
            $thisuser->update([
                'password' => Hash::make($request->password),
            ]);
        }
        // //phone
        // if (isset($request->phone)) {
        //     $thisuser->update([
        //         'phone' => $request->phone,
        //     ]);
        // }
        //name
        if (isset($request->name)) {
            $thisuser->update([
                'name' => $request->name,
            ]);
        }
        //edit badauth and vendor
        if (BadAuth::where('user_id', $thisuser->id)->exists()) {
            $badauth = BadAuth::where('user_id', $thisuser->id)->first();
            $vendorUser = User::where('phone', $badauth->phone)->first();
            //password
            if (isset($request->password)) {
                $badauth->update([
                    'password' => $request->password,
                ]);
                $vendorUser->update([
                    'password' => Hash::make($request->password),
                ]);
            }
            //phone
            // if (isset($request->phone)) {
            //     $badauth->update([
            //         'phone' => 'xx' . $request->phone,
            //     ]);
            //     $vendorUser->update([
            //         'phone' => 'xx' . $request->phone,
            //     ]);
            // }
            //name
            if (isset($request->name)) {
                $badauth->update([
                    'name' => $request->name,
                ]);
                $vendorUser->update([
                    'name' => $request->name,
                ]);
            }
        }
        return redirect()->route('start')->with('msg', 'تغییرات اعمال شد');
    }
}
