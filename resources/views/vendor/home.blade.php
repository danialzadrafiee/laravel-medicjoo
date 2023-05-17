@extends('layouts.vendor.app')
@section('content')
    <section class=" context   pb-10 mt-2 px-4">
        {{-- <div class="advertise pt-4">
            <img src="{{ asset('img/vendor_banner.png') }}" class="w-full" alt="">
        </div>
        <div class="divider py-3 w-full"></div> --}}
        <div class="main-icons mt-12">
            <div class="grid  gap-x-2 gap-y-7 items-center grid-cols-4 justify-center">
                <div class="col-span-1">
                    <a class="icon" href="{{ route('vendor_order_index', 'همه') }}">
                        <img src="{{ asset('img/icon/vendor_orders.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">سفارشات</div>
                    </a>
                </div>
                <div class="col-span-1 ">
                    <a href="{{ route('vendor_accounting') }}" class="icon">
                        <img src=" {{ asset('img/icon/creadit.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            حسابداری
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="{{ route('vendor_support') }}" class="icon">
                        <img src="img/icon/support.png" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            پشتیبانی
                        </div>
                    </a>
                </div>
                <a href="{{ route('vendor_history_index') }}" class="col-span-1">
                    <div class="icon">
                        <img src="img/icon/history.png" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            تاریخچه
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section class="orders px-4 pt-5">
        <header>
            <div class="flex mt-4 pr-4 items-center justify-between">
                <div class="right">
                    <div class="title text-xl font-bold ">
                        پیشنهاد سریع
                    </div>
                </div>
                <div class="left">
                    <a href="{{ route('vendor_order_index') }}" class="watch-all text-bold ml-5  text-green-500 ">
                        مشاهده همه
                    </a>
                </div>
            </div>
        </header>
        {{-- in bayad az offer index update beshe --}}
        <section class="offers px-4">
            <div class="list">
                @foreach ($orders as $index => $order)
                    <form action="{{ route('vendor_order_show', $order->id) }}">
                        {{-- @if ($index >= 4)
                            @php break; @endphp
                        @endif --}}
                        <div data-id="{{ $order->id }}" class="js-item item bg-white rounded-lg mt-10 shadow-md">
                            <div class="grid h-max grid-cols-9  w-full">
                                <div class="col-span-3 h-max relative  ">
                                    <div class="img absolute right-4 -top-4 ">
                                        @php
                                        if (App\Stuff::where('name', 'LIKE', "{$order->name}")->exists()) {
                                            $img = App\Stuff::where('name', 'LIKE', "{$order->name}")->first()->image;
                                        } else {
                                            $img = '/images/stuffholder.png';
                                        }
                                        if (App\Offer::where('order_id', $order->id)->exists()) {
                                            if (App\Offer::where('order_id', $order->id)->first()->image != null) {
                                                $img = App\Offer::where('order_id', $order->id)->first()->image;
                                            }
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
                                            @if ($order->offers()->where('vendor_id', auth()->user()->id)->where('status', 1)->exists())
                                                <div
                                                    class="time bg-yellow-400 rounded-t-none  -mt-2 rounded px-3 text-sm py-1 ">
                                                    در انتظار ارسال</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="middle">
                                        <div class="flex justify-between mx-3 mt-2 between">
                                            <div class="stuff mt-1">
                                                <div class="name font-bold">{{ $order->name }}</div>
                                                <div class="brand">{{ $order->brand }}</div>
                                            </div>
                                            <div class="counting border-r mr-3 pr-4 mt-2">
                                                <div class="count">{{ $order->count }}</div>
                                                <div class="unit">{{ $order->unit }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-9">
                                    @if ($order->offers()->where('vendor_id', auth()->user()->id)->where('status', 1)->exists())
                                        <div class="flex pb-4 mt-2 px-4 buttons">
                                            <a href="{{ route('vendor_offer_show', $order->offers()->first()->id) }}"
                                                class="button bg-green-800 w-max rounded px-7 py-1 text-white text-center ">مشاهده
                                                و ارسال</a>
                                        </div>
                                    @elseif($order->offers()->where('vendor_id', auth()->user()->id)->where('status', 0)->exists())
                                        <div class="flex pb-4 mt-2 px-4 buttons">
                                            <a href="{{ route('vendor_offer_show', $order->offers()->first()->id) }}"
                                                class="button bg-purple-800 w-max rounded px-7 py-1 text-white text-center ">
                                                مشاهده پیشنهاد
                                            </a>
                                        </div>
                                    @else
                                        <div class="flex pb-4 mt-2 px-4 buttons">
                                            <button type="submit"
                                                class="button bg-purple-800 rounded px-7 py-1 text-white text-center ">ثبت
                                                پیشنهاد</button>

                                            <div data-id="{{ $order->id }}"
                                                class="cursor-pointer js-btn-showing-toggle js-btn-show hidden button bg-blue-400 rounded px-7 py-1 text-white mr-2 text-center ">
                                                نمایش
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </section>
    </section>
@endsection
