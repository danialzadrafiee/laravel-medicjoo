<?php

namespace App\Http\Controllers;

use App\ForgetCode;
use App\User;
use Illuminate\Http\Request;
use Response;

class ForgetCodeController extends Controller
{
    public function forget_code_send(Request $request)
    {
        $code = rand(10000, 99999);

        if (!User::where('phone', $request->phone)->exists()) {
            return Response::json([
                'msg' => 'user_not_found'
            ]);
        }
        // ***
        $user = User::where('phone', $request->phone)->first();
        // ***
        if ($user->ForgetCode()->exists()) {
            $toDate = strtotime($user->ForgetCode()->latest()->first()->created_at->toDateTimeString());
            $fromDate = strtotime(now()->toDateTimeString());
            $diff = ($fromDate - $toDate) / 60;
            if ($diff < 2) {
                return Response::json([
                    'msg' => 'wating_error',
                    'time' => 120 - $diff * 60,
                ]);
            }
        }

        ForgetCode::create([
            'user_id' => $user->id,
            'code' => $code,
        ]);
        \Smsirlaravel::sendVerification($code,  $user->phone);

        return Response::json([
            'msg' => 'success',
        ]);

    }
    public function forget_index()
    {
        return view('auth.forget');
    }
}
