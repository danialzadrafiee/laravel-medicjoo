<?php

namespace App\Http\Controllers;

use App\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function change(Request $request)
    {
        $validate = $request->validate([
            "action_type" => "required",
            "amount" => "required|numeric",
            "variable" => "required",
        ]);

        if ($request->action_type == 'sum') {
            if (in_array('debt', $request->variable)) {
                Credit::create([
                    'user_id' => $request->user_id,
                    'debt' => $request->amount,
                    'describe' => 'اعمال دستی اپراتور',
                ]);
            }
            if (in_array('credit', $request->variable)) {
                Credit::create([
                    'user_id' => $request->user_id,
                    'change' => $request->amount,
                    'describe' => 'اعمال دستی اپراتور',

                ]);
            }
        }

        if ($request->action_type == 'sub') {
            if (in_array('debt', $request->variable)) {
                Credit::create([
                    'user_id' => $request->user_id,
                    'debt' => $request->amount * -1,
                    'describe' => 'اعمال دستی اپراتور',

                ]);
            }
            if (in_array('credit', $request->variable)) {
                Credit::create([
                    'user_id' => $request->user_id,
                    'change' => $request->amount * -1,
                    'describe' => 'اعمال دستی اپراتور',
                ]);
            }
        }
        return redirect()->back()->with('msg', 'تغییرات بر موجودی کاربر اعمال شد');
    }

    public function user_transaction($user_id)
    {
        $transactions = Credit::where('user_id', $user_id)->orderBy('updated_at', 'DESC')->get();
        return view('admin.ticket.user_transactions', compact('transactions'));
    }
}
