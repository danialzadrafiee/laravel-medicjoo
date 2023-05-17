@extends('layouts.client.app')
@section('background', '#fcfcfc')
@section('content')

    <section class="offers px-4">
        @if (session('msg'))
            <div class="alert mt-10 alert-success bg-green-300 rounded text-center w-max mx-auto">
                {{ session('msg') }}
            </div>
        @endif
        <div class="order bg-white mt-32 relative">



            <div class="shadow-md shadow-gray-800 relative rounded ">
                <div class="header relative w-full ">
                    <div class="image  absolute -top-20 right-0 left-0  mx-auto">
                        @php
                            if (App\Stuff::where('name', 'LIKE', "{$order->name}")->exists()) {
                                $img = App\Stuff::where('name', 'LIKE', "{$order->name}")->first()->image;
                            } else {
                                $img = '/images/stuffholder.png';
                            }
                            if (isset($offer)) {
                                if ($offer->image != null) {
                                    $img = $offer->image;
                                }
                            }
                        @endphp
                        <img src="{{ asset($img) }}" class="rounded w-32 h-32 shadow mx-auto" alt="">

                    </div>
                    <div class="title pt-14 font-bold text-center">{{ $order->name }}</div>
                    {!! Form::hidden('name', $order->name) !!}
                    <div class="brand border-b border-gray-200 mt-1 pb-3  mx-auto px-14 block w-max text-sm text-center">
                        {{ $order->brand }}</div>
                    {!! Form::hidden('brand', $order->brand) !!}

                </div>
                <div class="counting mt-3 w-max mx-auto">
                    <div class="grid-cols-2 items-center justify-center grid">
                        <div class="col-span-1">
                            <label class="block text-center px-4">تعداد</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">{{ $order->count }}</label>
                            {!! Form::hidden('count', $order->count) !!}

                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">واحد</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">{{ $order->unit }}</label>
                            {!! Form::hidden('unit', $order->unit) !!}

                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center text-sm font-bold mt-2 mb-1">توضحیات</div>
                <div class="px-8">
                    <textarea  rows="2" class="border-t pt-2  rounded  border-gray-200 text-center px-2 mx-auto w-full" readonly >{{ $order->order_describe }}</textarea>
                </div>
                <div class="submit flex px-4   mt-2 pb-0">

                    <a href="{{ route('client_offer_list_order_offers', ['id' => $order->id]) }}"
                        class="bg-purple-800 text-sm py-3  rounded-l-none mb-2 block w-full text-white text-center px-8 rounded">
                        پیشنهاد ها
                    </a>




                    <a href="{{ route('client_order_destroy', ['id' => $order->id]) }}" type="submit"
                        class="bg-gray-800 text-sm py-3  rounded-r-none mb-2 block w-full  text-white text-center px-8 rounded">
                        لغو سفارش </a>
                </div>
            </div>

        </div>

    </section>
@endsection
