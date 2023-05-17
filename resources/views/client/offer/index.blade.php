@extends('layouts.client.app')
@section('content')
    <section class="offers px-4">
        <header>
            <div class="flex mt-4 justify-between">
                <div class="right">
                    <div class="title text-xl font-bold">
                        پیشنهادات
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
            @foreach ($offers as $offer)
                <form action="{{ route('client_offer_show', $offer->id) }}">
                    <div class="item bg-white rounded-lg mt-10 shadow-md relative">
                        <div
                            class="badge_promote hidden absolute top-0 left-3 bg-green-500 text-sm text-white text-center px-3 rounded-b py-1 ">
                            پیشنهاد ویژه</div>
                        <div class="grid h-max grid-cols-9  w-full ">
                            <div class="col-span-3 h-max relative  ">
                                <div class="img absolute right-4 -top-4 ">
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
                                    {{-- <img src="https://picsum.photos/id/0/200" class="rounded w-32" alt=""> --}}
                                    <img src="{{ asset($img) }}" class="rounded w-32 h-24 shadow object-cover" alt="">
                                </div>
                            </div>
                            <div class="col-span-6 ">
                                <div class="top">
                                    <div class="flex justify-between mx-3 mt-2">
                                        <div class="time bg-gray-200 rounded px-2 py-1 text-xs">
                                            {{ Verta::instance($offer->created_at)->formatDifference() }}</div>
                                        <div class="slug hidden bg-red-300 rounded px-2 py-1 text-xs">دریافت سریع</div>
                                    </div>
                                </div>
                                <div class="middle">
                                    <div class="flex justify-between mx-3 mt-2 between">
                                        <div class="top mt-1">
                                            <div class="name font-bold ">{{ $offer->name }}</div>
                                            <div class="price text-sm flex ">
                                                <div class="lable">قیمت :</div>
                                                <div class="lable">{{ number_format($offer->price) }} تومان</div>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <div class="count">{{ $offer->count }}</div>
                                            <div class="unit mr-1">{{ $offer->unit }}</div>
                                        </div>
                                    </div>
                                    <div class="bottom  mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-9">
                            <div class="flex pb-4 mt-2 px-4 w-full justify-between  buttons">
                                <div class="flex">

                                    <a href="{{ route('client_offer_choose', $offer->id) }}"
                                        class="button bg-purple-800 rounded px-7 py-1 text-white text-center ">مشاهده</a>

                                </div>
                                <div class="brand text-xs   bg-green-100 rounded mt-1  flex items-center px-2 w-max">

                                    {{ $offer->offer_brand }}</div>
                            </div>
                        </div>
                    </div>
        </div>
        </form>
        @endforeach
        {!! $offers->links('pagination::default') !!}
        </div>

    </section>
@endsection
