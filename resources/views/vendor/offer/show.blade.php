@extends('layouts.vendor.app')
@section('background', '#fcfcfc')
@section('content')



    <section class="offers px-4">


        <div class="order bg-white mt-32 relative">


            <div class="shadow-md shadow-gray-800 relative rounded ">
                <div class="header relative w-full ">
                    <div class="image  absolute -top-20 right-0 left-0 mx-auto">
                        @php
                        if (App\Stuff::where('name', 'LIKE', "{$offer->name}")->exists()) {
                            $img = App\Stuff::where('name', 'LIKE', "{$offer->name}")->first()->image;
                        } else {
                            $img = '/images/stuffholder.png';
                        }
                        if (isset($offer)) {
                            if ($offer->image != null) {
                                $img = $offer->image;
                            }
                        }
                    @endphp
                        <img src="{{ asset($img) }}" class="rounded w-32 h-32 mx-auto shadow" alt="">

                    </div>
                    <div class="title pt-14 font-bold text-center">{{ $offer->name }}</div>
                    <div class="brand border-b border-gray-200 mt-1 pb-3  mx-auto px-14 block w-max text-sm text-center">
                        {{ $offer->brand }}</div>

                </div>
                <div class="counting mt-3 w-max mx-auto">
                    <div class="grid-cols-2 items-center justify-center grid">
                        <div class="col-span-1">
                            <label class="block text-center px-4">تعداد</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">{{ $offer->count }}</label>

                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">واحد</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">{{ $offer->unit }}</label>
                            {{-- <label>{{ $order->unit }}</label> --}}
                        </div>
                    </div>
                </div>

                <div class="orffer  mt-3">

                    <div
                        class="title  mx-auto text-sm   text-center font-bold w-full border-t border-b border-gray-200 py-2 ">
                        <span>وضعیت :</span>
                        @switch($offer->status)
                            @case(-1)
                                <span class="bg-red-400 rounded px-2  my-2">لغو شده</span>
                            @break

                            @case(0)
                                در انتظار تایید
                            @break

                            @case(1)
                                پرداخت شده
                            @break

                            @case(2)
                                ارسال شده

                                @default
                            @endswitch
                        </div>

                        <div class="title text-center mt-2 text-sm text-bold bg-gray-100 py-2"> جزییات سفارش </div>
                        <table class="table  w-full  rounded mx-auto  text-sm table-auto">

                            <tr class="pt-5">
                                <td class="font-bold px-4">کد سفارش</td>
                                <td class="px-4 py-2 ">{{ $offer->id }}</td>
                            </tr>
                            <tr class="pt-5">
                                <td class="font-bold px-4">نام کالا</td>
                                <td class="px-4 py-2 ">{{ $offer->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">برند سفارش</td>
                                <td class="px-4 py-2 ">{{ $offer->order_brand }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">برند ارسالی</td>
                                <td class="px-4 py-2 ">{{ $offer->offer_brand }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">تعداد</td>
                                <td class="px-4 py-2 ">{{ $offer->count }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">واحد</td>
                                <td class="px-4 py-2 ">{{ $offer->unit }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">قیمت</td>
                                <td class="px-4 py-2 ">{{ number_format($offer->price) }} تومان</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">تاریخ انقضا</td>
                                <td class="px-4 py-2 ">{{$offer->expire ?? 'ندارد' }} </td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">تاریخ ثبت</td>
                                <td class="px-4 py-2 ">{{ Verta::instance($offer->created_at)->format('l, %d %B ') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">زمان ثبت</td>
                                <td class="px-4 py-2 "> {{ Verta::instance($offer->created_at)->format('H:i') }}</td>
                            </tr>
                        </table>
                        <div class="submit mt-2 pb-0">


                            @switch($offer->status)
                                @case(0)
                                    <button type="submit"
                                        class="bg-gray-800 py-2 text-sm rounded-t-none w-full mx-auto block  text-white text-center px-8 rounded">
                                        پیشنهاد درحال بررسی مشتریست
                                    </button>
                                @break

                                @case(1)
                                    <div class="px-4 pb-4">
                                        <a href="{{ route('vendor_offer_sended', $offer->id) }}"
                                            class="bg-purple-800 py-2 mx-2 w-max  mx-auto block  text-white text-center px-8 rounded">
                                            سفارش را ارسال کردم
                                        </a>
                                    </div>
                                @break

                                @case(2)
                                    <div class="px-4 pb-4">
                                        <a class="bg-green-300 py-2 mx-2 w-max  mx-auto block   text-center px-8 rounded">
                                            با موفقیت ارسال شده
                                        </a>
                                    </div>
                                @break
                            @endswitch

                        </div>

                        @if (session('msg'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </section>
    @endsection
