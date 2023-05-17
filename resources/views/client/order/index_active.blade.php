@extends('layouts.client.app')
@section('content')
    <section class="offers px-4 pb-28">
        <header>
            <div class="flex mt-4 justify-between">
                <div class="right">
                    <div class="title text-xl font-bold">
                        سفارش های فعال
                    </div>
                </div>
                <div class="left">
                    <select class="bg-white rounded py-1 border-gray-300 border px-4 hidden" name="" id="">
                        <option value="">جدیدترین</option>
                        <option value="">قدیمی ترین</option>
                    </select>
                </div>
            </div>
        </header>
        <div class="list">

            @if ($orders->first() == null)
                <div class="pic block w-max mt-20 mx-auto">
                    <img src="{{ asset('svg/client-no-order.svg') }}" alt="">
                </div>

                <h1 class="text-center font-light mt-4 mb-2">درحال حاضر هیچ سفارش فعالی ندارید</h1>
                <div class="flex  mt-2 justify-center">
                    <a href="{{ route('client_offer_actives') }}"
                        class="btn btn-primary w-40 rounded-l-none btn-md btn-active">پیگیری
                        سفارشات</a>
                    <a href="{{ route('client_offer_history') }}" class="btn btn-info btn-md w-40  rounded-r-none">تاریخچه
                        سفارشات</a>
                </div>
            @endif
            @foreach ($orders as $order)
                <form action="{{ route('client_offer_show', $order->id) }}">
                    <div class="item bg-white rounded-lg mt-10 shadow-md relative">
                        <div
                            class="badge_promote hidden absolute top-0 left-3 bg-green-500 text-sm text-white text-center px-3 rounded-b py-1 ">
                            پیشنهاد ویژه</div>
                        <div class="grid h-max grid-cols-9  w-full ">
                            <div class="col-span-3 h-max relative  ">
                                <div class="img absolute right-4 -top-4 ">
                                    @php
                                        if (App\Stuff::where('name', 'LIKE', "{$order->name}")->exists()) {
                                            $img = App\Stuff::where('name', 'LIKE', "{$order->name}")->first()->image;
                                        } else {
                                            $img = '/images/stuffholder.png';
                                        }
                                    @endphp
                                    {{-- <img src="https://picsum.photos/id/0/200" class="rounded w-32" alt=""> --}}
                                    <img src="{{ asset($img) }}" class="rounded w-32 h-24 shadow object-cover" alt="">
                                </div>
                            </div>
                            <div class="col-span-6 ">
                                <div class="top">
                                    <div class="flex justify-between mx-3 mt-2">
                                        <div class="time bg-gray-200 rounded px-2 py-1 text-xs">
                                            {{ Verta::instance($order->created_at)->formatDifference() }}</div>
                                        <div class="slug hidden bg-red-300 rounded px-2 py-1 text-xs">دریافت سریع</div>
                                    </div>
                                </div>
                                <div class="middle">
                                    <div class="flex justify-between mx-3 mt-2 between">
                                        <div class="top mt-1">
                                            <div class="name font-bold ">{{ $order->name }}</div>
                                            <div class="name text-sm ">{{ $order->brand }}</div>

                                        </div>
                                        <div class="flex">
                                            <div class="count">{{ $order->count }}</div>
                                            <div class="unit mr-1">جعبه</div>
                                        </div>
                                    </div>
                                    <div class="bottom  mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            @if ($order->Offers()->exists() && $order->Offers()->first()->status == 1)
                                <div class="flex pb-4 mt-2 px-4 w-full justify-between  buttons">
                                    <div class="flex">
                                        <a href="{{ route('client_offer_show', ['id' => $order->Offers()->first()->id]) }}"
                                            class="button bg-green-800 rounded px-7 py-1 text-white text-center ">
                                            <span>مشاهده</span>
                                        </a>

                                    </div>
                                    <div class="brand text-xs bg-green-100 rounded mt-1  flex items-center px-2 w-max">

                                        <span class="ml-1"> در حال آماده سازی... </span>


                                    </div>
                                </div>
                            @else
                                <div class="flex pb-4 mt-2 px-4 w-full justify-between  buttons">
                                    <div class="flex">
                                        <a href="{{ route('client_offer_list_order_offers', ['id' => $order->id]) }}"
                                            class="button bg-purple-800 rounded px-7 py-1 text-white text-center ">پیشنهاد
                                            ها</a>
                                        <a href="{{ route('client_order_destroy', ['id' => $order->id]) }}"
                                            class="button bg-gray-800 rounded px-7 py-1 text-white mr-2 text-center ">لغو
                                        </a>
                                    </div>
                                    <div
                                        class="brand text-xs {{ $order->Offers()->count() > 0 ? 'bg-green-100' : 'bg-gray-100' }} rounded mt-1  flex items-center px-2 w-max">

                                        <span class="ml-1">
                                            {{ $order->Offers()->count() }}
                                        </span>
                                        پیشنهاد

                                    </div>
                                </div>
                            @endif




                        </div>
                    </div>
                </form>
            @endforeach
        </div>
        {!! $orders->links('pagination::default') !!}
    </section>


    <input type="hidden" class='js-stuff-names' value="{{ json_encode($stuffs_names, JSON_UNESCAPED_UNICODE) }}">
    @include('layouts.client.fast-order-html')
@endsection
@section('script')
    @include('layouts.client.fast-order-js')
@endsection
