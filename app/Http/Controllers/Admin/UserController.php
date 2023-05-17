<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\UserAttr as AppUserAttr;
use Illuminate\Auth\Events\Verified;
use UserAttr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with('UserAttr')->whereHas('UserAttr', function ($query) {
            return $query->where('job', '!=', 'non');
        })->get();
        return view('admin.usres.index', compact('users'));
    }
    public function update(Request $request)
    {
        if (isset($request->name)) {
            User::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        }
        if (isset($request->email)) {
            User::where('id', $request->id)->update([
                'email' => $request->email,
            ]);
        }
        if (isset($request->phone)) {
            User::where('id', $request->id)->update([
                'phone' => $request->phone,
            ]);
        }

        if (isset($request->password)) {
            $validatedData = $request->validate([
                'password' => 'required|confirmed',
            ]);
            User::where('id', $request->id)->update([
                'password' => Hash::make($request->password),
            ]);
        }
        if (isset($request->job)) {
            $UserAttr = User::where('id', $request->id)->first()->UserAttr()->update([
                'job' => $request->job
            ]);
        }
        return redirect()->back()->with('msg', 'تغییرات کاربر اعمال شد');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => ['required','regex:/^(\09|0098|98|0)?9\d{9}$/','unique:users'],
            'password' => 'required',
            'job' => 'required',
        ]);
            $user = User::create([
            'name' =>$request->name,
            'phone' =>$request->phone,
            'password' =>Hash::make($request->name),
        ]);
        $user->UserAttr()->create([
            'user_id'=>$user->id,
            'active'=>1,
            'job'=>$request->job,
        ]);
        return redirect()->back()->with('msg', 'تغییرات کاربر اعمال شد');
    }
}
