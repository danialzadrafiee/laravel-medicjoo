<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request){
        $request->image->store('uploads','public');
        // $request->image->storeAs('uploads','rand(10,100)');
    }
}
