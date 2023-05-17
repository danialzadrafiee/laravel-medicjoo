<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.index',compact('orders'));
    }
    public function show($id)
    {
        $order = Order::where('id',$id)->first();
        return view('admin.order.show',compact('order'));
    }
}
