<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UserAddresses;
use App\UserAttr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->UserAddresses()->orderBy('created_at', 'desc')->get();
        return view('client.setting.address_index', compact('addresses'));
    }
    public function create()
    {
        return view('client.setting.address_create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'address' => 'required|min:3',
            'location' => 'required'
        ], [
            'location.required' => 'آدرس خود را روی نقشه مشخص کنید'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        };

        UserAddresses::create([
                'user_id'=> auth()->user()->id,
                'title'=> $request->title,
                'address'=>$request->address,
                'location'=>$request->location
            ]);


        if (in_array('offer', explode('/', url()->previous()))) {
            return redirect()->route('client_offer_index')->with('msg', '  آدرس با موفقیت ثبت شد  ');;
        } else {
            return redirect()->route('client_setting_address_index')->with('msg', '  آدرس با موفقیت ثبت شد  ');
        }
    }
    public function destroy($id)
    {
        UserAddresses::find($id)->delete();
        return redirect()->back()->with('delete', 'آدرس مورد نظر حذف شد');
    }
    public function list()
    {
        return auth()->user()->UserAddresses()->orderBy('created_at', 'desc')->get();
    }
}
