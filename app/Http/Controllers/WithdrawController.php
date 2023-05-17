<?php

namespace App\Http\Controllers;

use App\Offer;
use App\User;
use App\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('UserAttr')->whereHas('UserAttr', function ($query) {
            return $query->where('job', '=', 'vendor');
        })->get();
        return view('admin.withdraw.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'amount' => ['required', 'numeric']
        ]);

        $user = User::find($request->user_id);
        $balance = Offer::where('vendor_id', $user->id)->sum('price') - $user->withdraw()->sum('amount');
        if ($request->amount > $balance) {
           return redirect()->back()->withErrors('مقدار تسویه از موجودی کاربر بیشتر است');
        }

        Withdraw::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'describe' => $request->describe ?? 'خالی',
        ]);
        return redirect()->back()->with('msg', 'تسویه با موفقیت انجام شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdraw $withdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
