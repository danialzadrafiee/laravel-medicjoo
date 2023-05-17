<?php

namespace App\Http\Controllers;

use App\BadAuth;
use App\BeVendor;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class BeVendorController extends Controller
{
    public function index(){
        if(auth()->user()->BadAuth()->first() !== null){
            if(auth()->user()->BadAuth()->first()->active == 1 ){
                $user = auth()->user()->BadAuth()->first();
                $phone = $user->phone;
                $password = $user->password;
                Auth::logout();
                Auth::attempt(['phone' => $phone, 'password' => $password]);
                return redirect()->route('vendor_index');
            }
        }
        return view('client.be_vendor');
    }
    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'password' => ['required','min:8','confirmed'],
        ]);
        BeVendor::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => "xx".auth()->user()->phone,
            'password' => $request->password,
            'describe' => $request->describe ?? 'خالی',
        ]);

        $user = auth()->user();
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        Auth::attempt(['phone' => $user->phone, 'password' => $user->password]);

        return redirect()->back()->with('msg','درخواست شما ثبت شد و درحال پیگیری است');
    }


    public function vendor_to_user(){
                $user_client_id = BadAuth::where('phone',auth()->user()->phone)->first()->user_id;
                $user_client_password = BadAuth::where('phone',auth()->user()->phone)->first()->password;
                $phone = User::where('id',$user_client_id)->first()->phone;
                $password = $user_client_password;
                Auth::logout();
                Auth::attempt(['phone' => $phone, 'password' => $password]);
                return redirect()->route('vendor_index');
        }



    public function admin_index()
    {
        $bevendors = BeVendor::all();
        return view('admin.bevendor.index',compact('bevendors'));
    }
}
