@extends('layouts.client.app')
@section('background', '#fcfcfc')
@section('content')
    @php
    use Hekmatinasser\Verta\Verta;
    @endphp
    {{-- modal --}}
    <section class="modal">
        <div id="re_order" class="modal">
            <div class="js-modal-content">

                <div class="form">
                    <form class="js-form" action="{{ route('client_order_store') }}" method="post">
                        @csrf
                        <div class="image hidden mx-auto w-40">
                            <img src="{{ asset('img/placeholder-image.png') }}" class="js-image-value w-40" alt="">
                        </div>
                        <div class="inputs">
                            <div class="input relative mt-3">
                                <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> نام کالا</label>
                                <input name="name" type="text" readonly
                                    class="js-name-value z-10 border bg-gray-50 border-gray-300 rounded py-3 my-2 w-full pr-6"
                                    placeholder="مثلا : کامپوزیت ">
                            </div>
                        </div>
                        <div class="inputs">
                            <div class="input relative mt-3">
                                <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> برند (غیر
                                    ضروری)</label>


                                <input type="text" name="brand"
                                    class="js-brand-value  bg-white  z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                                    id="">



                            </div>
                        </div>
                        <div class="grid gap-3 grid-cols-2">
                            <div class="col-span-1">
                                <div class="inputs">
                                    <div class="input relative mt-3">
                                        <label
                                            class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">تعداد
                                        </label>
                                        <input name="count" type="number"
                                            class="js-count-value text-center z-10 border border-gray-300 rounded py-3 my-2 w-full"
                                            placeholder="مثلا : ۱۵">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="inputs">
                                    <div class="input relative mt-3">
                                        <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">
                                            واحد
                                        </label>
                                        <!-- <input type="text" class=" z-10 border border-gray-300 rounded py-3 my-2 w-full"> -->
                                        <select name="unit" id=""
                                            class="js-unit-value bg-white text-center  z-10 border border-gray-300 rounded py-3 my-2 w-full">
                                            <option value="عدد">عدد</option>
                                            <option value="جعبه">جعبه</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons mt-2 pb-2">
                            <div class="grid grid-cols-6 justify-between">

                                <button type="submit"
                                    class="col-span-6 mr-1 submit bg-purple-900 text-white rounded-lg py-2 text-center">ثبت
                                    سفارش</button>

                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </section>





    <section class="offers px-4">
        <div class="header">
            <div class="title mt-4 text-xl font-bold">
                تاریخچه سفارشات
            </div>
        </div>
        <div class="list">
            @if ($offers->first() == null)
                <div class="pic block w-max mt-20 mx-auto">
                    <img src="{{ asset('svg/client-no-order.svg') }}" alt="">
                </div>
                <h1 class="text-center font-light mt-4 mb-2">درحال حاضر هیچ تاریخچه ای وجود ندارد</h1>
                <div class="flex mt-2 justify-center">
                    <a href="{{ route('client_offer_actives') }}"
                        class="btn btn-primary rounded-l-none w-40 btn-md btn-active">
                        <span> پیگیری سفارشات</span>
                    </a>
                    <a href="{{ route('client_offer_actives') }}" class="btn btn-info  w-40  btn-md rounded-r-none "> لیست سفارشات </a>
                </div>
            @endif


            @foreach ($offers as $offer)
                @if (intval(date_diff($offer->created_at, now())->format('%H')) > 1)
                    <form action="">
                        <div class="item bg-white rounded-lg mt-2 shadow-md relative">

                            <div class="grid h-max grid-cols-9  w-full ">
                                <div class="col-span-2 h-max   ">
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
                                <div class="col-span-7 ">
                                    <div class="top">
                                        <div class="flex px-2 mt-2">
                                            <div class="name ml-2 font-bold rounded  py-1 ">{{ $offer->name }}</div>
                                            <div class="brand border-r border-gray-200 rounded px-2 py-1 ">
                                                {{ $offer->offer_brand }}</div>
                                        </div>
                                    </div>
                                    <div class="middle">
                                        <div class="flex text-sm  px-2 ">
                                            <div class="date">
                                                {{ Verta::instance($offer->created_at)->format('l, %d %B ') }}</div>
                                            <div class="time mr-4">
                                                {{ Verta::instance($offer->created_at)->format('H:i') }} </div>
                                        </div>
                                    </div>
                                    {{-- //todo --}}
                                    <div class="bottom hidden mt-2 px-2">
                                        <div
                                            class="brand   justify-between w-full  bg-green-100 rounded px-1 py-1 mt-1 flex items-center ">
                                            <div class="text-xs ">نظرتان را درباره این سفارش </div>
                                            <div class="text-green-500  pl-2 text-sm">ثبت نظر</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-9">
                                    <div class="flex pb-2 mt-4 px-2 w-full   buttons">
                                        <a href="{{ route('client_offer_show', [$offer->id]) }}"
                                            class="button grow w-full bg-purple-800 rounded px-7 py-1 text-white text-center ">مشاهده</a>
                                        <a data-unit={{ $offer->unit }} data-brand={{ $offer->order_brand }}
                                            data-name={{ $offer->name }} data-count={{ $offer->count }}
                                            data-id="{{ $offer->id }}" href="#re_order" rel="modal:open"
                                            class="js-reorder button  grow w-full bg-gray-800 rounded px-7 py-1 text-white mr-2 text-center ">
                                            سفارش مجدد
                                        </a>




                                    </div>
                                </div>
                            </div>
                    </form>
                @endif
            @endforeach
            {!! $offers->links('pagination::default') !!}
        </div>

    </section>
@endsection
@section('script')

    <script>
        var id;
        var name;
        var count;
        var unit;
        var brand;
        $(document).on('click', '.js-reorder', function() {
            id = $(this).attr('data-id');
            name = $(this).attr('data-name');
            count = $(this).attr('data-count');
            unit = $(this).attr('data-unit');
            brand = $(this).attr('data-brand');

            $('.js-name-value').val(name)
            $('.js-brand-value').val(brand)
            $('.js-count-value').val(count)

            $(".js-unit-value").val(unit).change();
        });
    </script>

@endsection
