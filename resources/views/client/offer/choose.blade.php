@extends('layouts.client.app')
@section('background', '#fcfcfc')
@section('content')
    <style>
        .tabs {
            display: none;
        }

        .pb-28 {
            padding-bottom: 1rem !important;
        }

        .fixed-header {
            position: relative !important;
        }

    </style>
    @php
    if ($offer->status < 0) {
        header('Location: ' . route('start')); //check if order is deleted back home
    }

    @endphp



    <section class="address my-3">
        <div class="px-4 py-4">
            @include('layouts.global-error')
            @include('layouts.global-msg')
        </div>
        <div class="px-4">
            <div class="bg-white border-t-4 border-purple-800 shadow rounded  px-2 py-4">
                <title class="block font-bold pr-2">انتخاب آدرس :</title>
                <div class="address px-2 mt-2 ">
                    <select name="address"
                        class="js-address-select px-2 border rounded border-gray-300 bg-white py-3    w-full">
                        @foreach ($addresses as $address)
                            <option value="">{{ $address->title . ' : ' . $address->address }} </option>
                        @endforeach
                        <option value="" class="js_add_new_address">افزودن آدرس جدید</option>
                    </select>
                </div>
            </div>
        </div>

    </section>

    <section class="offers px-4">

        <div class="order bg-white mt-32 relative">


            <div class="shadow-md border-t-4 border-purple-800 relative rounded ">
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

                        </div>
                    </div>
                </div>


                <div class="orffer  mt-3">


                    <div class="title text-center mt-2  font-bold py-4 border-t border-b border-gray-300"> جزییات سفارش
                    </div>
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
                    </table>
                    <form action="{{ route('client_offer_select') }}">

                        <div class="pay px-4 mx-auto   ">
                            <div class="divider my-2 font-bold">پرداخت</div>
                            <div class="bg-white  ">
                                <div
                                    class="inputs border-purple-800 js-inputs  border rounded-t relative flex items-center w-full h-14 ">
                                    <input value="online" checked type="radio"
                                        class="absolute top-0  right-0 w-full h-full  opacity-0 bg-blue-400"
                                        name="payment_method" id="">
                                    <span class="absolute block right-4 z-30 ">
                                        آنلاین
                                    </span>
                                </div>
                                <div class="inputs js-inputs  border rounded-b relative flex items-center w-full h-14 ">
                                    <input value="credit" type="radio"
                                        class="absolute top-0  right-0 w-full h-full  opacity-0 bg-blue-400"
                                        name="payment_method" id="">
                                    <span class="absolute  right-4 z-30 flex  ">
                                        اعتباری
                                    </span>
                                    <span class="absolute  left-4 z-30 flex  ">
                                        موجودی شما :
                                        {{ auth()->user()->credit()->sum('change') }}
                                    </span>
                                </div>
                            </div>

                        </div>


                </div>
                <div class="border-t border-gray-200 mt-4 pt-3 pb-4 flex " action="{{ route('client_offer_select') }}">
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <input class="js-form-address" type="hidden" name="address"
                        value="{{ $address->title . ':' . $address->address }}">
                    <button type="submit" class="btn bg-purple-800 rounded text-white mx-auto w-40 px-4 py-2 ">
                        <span> پرداخت و ثبت</span>
                    </button>
                    <a href="{{ route('client_order_destroy', ['id' => $offer->order_id]) }}"
                        class="btn bg-gray-800 rounded text-white mx-auto w-40 px-4 py-2 ">
                        <span>لغو سفارش</span>
                    </a>
                </div>
                </form>

            </div>


        </div>







    </section>
@endsection
@section('script')
    <script>
        $('.js-address-select').change(function() {
            $('.js-form-address').val($('.js-address-select  :selected').text())
            if ($('.js-address-select  :selected').hasClass('js_add_new_address')) {
                window.location = "{{ route('client_setting_address_create') }}"
            }
        });
    </script>
    <script>
        //input select style
        $('.js-inputs').on('click', function() {
            $('.js-inputs').removeClass('border-purple-800')
            $(this).addClass('border-purple-800')
        })
    </script>
@endsection
{{-- //todo inja bayad pardakht kone etebari ya interneti --}}
{{-- //todo inja bayad addressesho ham vared kone --}}
