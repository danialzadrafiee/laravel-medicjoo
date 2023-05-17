@extends('layouts.client.app')
@section('background', '#fcfcfc')
@section('content')



    <section class="offers px-4">

        <div class="order bg-white mt-32 relative">
            @foreach ($offers as $offer)


                <div class="shadow-md shadow-gray-800 relative rounded ">
                    <div class="header relative w-full ">
                        <div class="image  absolute -top-20 right-0 left-0 mx-auto">
                            <img src=" https://picsum.photos/id/13/200" class="rounded mx-auto w-32" alt="">
                        </div>
                        <div class="title pt-14 font-bold text-center">{{ $offer->name }}</div>
                        <div
                            class="brand border-b border-gray-200 mt-1 pb-3  mx-auto px-14 block w-max text-sm text-center">
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
                        <div class="title  mx-auto text-sm   text-center font-bold w-full border-t border-b border-gray-200 py-2 ">
                            وضعیت : درحال آماده سازی ...
                        </div>
                        <p class="describe  text-center text-xs mt-2 pb-2 px-10 pt-2 text-gray-700 ">
                            <span class="font-bold"> تحویل به :</span>
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                        </p>
                        <div class="title text-center mt-2 text-xs text-bold bg-gray-100 py-2"> جزییات سفارش </div>
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
                                <td class="px-4 py-2 ">{{ $offer->brand }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">برند ارسالی</td>
                                <td class="px-4 py-2 ">{{ $offer->brand }}</td>
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
                                <td class="font-bold px-4">تاریخ ثبت</td>
                                <td class="px-4 py-2 ">{{ now() }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold px-4">زمان ثبت</td>
                                <td class="px-4 py-2 ">{{ now() }}</td>
                            </tr>
                        </table>
                        <div class="submit mt-2 pb-0">
                            <button type="submit"
                                class="bg-purple-800 py-2 text-sm rounded-t-none w-full mx-auto block  text-white text-center px-8 rounded"> دریافت پشتیبانی </button>
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </section>
@endsection
