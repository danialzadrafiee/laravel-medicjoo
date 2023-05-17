@extends('layouts.vendor.app')
@section('content')
    <style>
        .stuffs {
            background: #f7f8f9 !important;
        }

    </style>
    @include('layouts.vendor.fast-search-html')
    @include('layouts.global-error')

    <section class="search  px-4 pb-3 bg-white">
        <form action="{{ route('vendor_catalog_search') }}">
            <div class="flex mt-5 items-center">
                <div class="searchbox relative w-full">
                    <button type='submit' class="icon left-3 absolute top-3 w-7">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24.043" height="24.047" viewBox="0 0 24.043 24.047">
                            <path id="Icon_awesome-search" data-name="Icon awesome-search"
                                d="M23.716,20.79l-4.682-4.682a1.126,1.126,0,0,0-.8-.329H17.47a9.764,9.764,0,1,0-1.691,1.691v.765a1.126,1.126,0,0,0,.329.8l4.682,4.682a1.122,1.122,0,0,0,1.592,0l1.329-1.329a1.132,1.132,0,0,0,0-1.6ZM9.768,15.779a6.011,6.011,0,1,1,6.011-6.011A6.008,6.008,0,0,1,9.768,15.779Z"
                                fill="#4419b9" />
                        </svg>

                    </button>
                    <input type="text" name="keyword" autocomplete="off"
                        class="js-input-name px-4 pl-12 w-full py-3 rounded-lg bg-gray-100 border"
                        placeholder="جستوجوی کالا">
                </div>
                <div
                    class="js-close-search hidden  rounded  justify-center items-center w-12 h-12 mr-2 border-2 border-purple-800 text-purple-800">
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </div>

            </div>
        </form>
    </section>
    <section class="navbar bg-white  px-4">
        <nav class="w-full">
            <div class="grid w-full pb-2 gap-4 grid-cols-4 relative ">
                @foreach ($category as $index => $group)
                    @if ($index == 0)
                        <div class="col-span-2 h-max relative w-full">
                            <a href="{{ route('vendor_setting_catalog', $group->name) }}"
                                class="item  w-full  h-32 rounded block justify-center items-center relative ">
                                <img class="  h-32 w-full block rounded-lg absolute "
                                    src="{{ asset('images/category_all.jpg') }}" alt="">
                                <div
                                    class="w-full h-full block absolute rounded-lg  @if ($name == $group->name) bg-purple-800 opacity-60  @else bg-gray-800 opacity-60 @endif  ">
                                </div>

                                <div
                                    class=" h-32  absolute right-0 left-0 top-0 left-0 mx-auto text-white font-bold flex justify-center items-center">
                                    تمام کالاها</div>
                            </a>
                        </div>
                    @elseif ($index <= 1)
                        <div class="col-span-2 h-max relative w-full">
                            <a href="{{ route('vendor_setting_catalog', $group->name) }}"
                                class="item  w-full  h-32 rounded block justify-center items-center relative ">
                                <img class="  h-32 w-full block rounded-lg absolute " src="{{ asset($group->image) }}"
                                    alt="">
                                <div
                                    class="w-full h-full block absolute rounded-lg  @if ($name == $group->name) bg-purple-800 opacity-60  @else bg-gray-800 opacity-60 @endif  ">
                                </div>

                                <div
                                    class=" h-32  absolute right-0 left-0 top-0 left-0 mx-auto text-white font-bold flex justify-center items-center">
                                    {{ $group->name }}</div>
                            </a>
                        </div>
                    @else
                        <div class="col-span-1 w-full relative">



                            <a href="{{ route('vendor_setting_catalog', $group->name) }}"
                                class="item relative block  w-full rounded-lg ">
                                <div
                                    class="w-full h-full block absolute rounded-lg  @if ($name == $group->name) bg-purple-800 opacity-60 @endif ">
                                </div>
                                <img class="w-full rounded-lg" src="{{ asset($group->image) }}" alt=""
                                    style="aspect-ratio: 1 / 1;">
                            </a>
                            <div class="text pt-2  text-center text-xs block w-full">{{ $group->name }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </nav>


    </section>
    <section class="hidden offers px-4">
        <header>
            <div class="flex mt-4 justify-between">
                <div class="right">
                    <div class="title text-lg font-bold">
                        کاتالوگ
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
    </section>
    <section class="stuffs ">





        <div class="stuffs">
            <div class="grid  w-full grid-cols-2">
                @foreach ($stuffs as $stuff)
                    <div class="col-span-1  border py-5 border-gray-100  ">
                        <div class="item shadow-md rounded-lg py-4 bg-white mx-3">
                            <div class="image rounded-sm p-4" style=" aspect-ratio: 1 / 1;">
                                <img src=" {{ asset($stuff->image) }} " class=" rounded     block mx-auto" alt="">
                            </div>
                            <div class="describe pt-2">
                                <div class="name text-center text-xs  font-bold  ">{{ $stuff->name }}</div>
                                <div class="fast-order px-4">

                                    @php
                                        $x = App\UserAttr::where('user_id', auth()->user()->id)->first()->notifications;
                                        $x = explode(',', $x);
                                    @endphp
                                    @if (in_array($stuff->name, $x))
                                        <a href="{{ route('vendor_setting_notification_unset',$stuff->name) }}"
                                            data-url="{{ route('stuff_show', $stuff->id) }}"
                                            class="js-fastorder mt-2 btn border-none flex justify-center items-center btn-xs block w-full mx-auto py-2 h-auto mt-1  rounded bg-green-500 text-center text-white text-xs">
                                            <span>روشن است</span>
                                            <ion-icon class="mr-1 text-sm" name="notifications"></ion-icon>
                                        </a>
                                    @else
                                        <a href="{{ route('vendor_setting_notification_insert',$stuff->name) }}"
                                            data-url="{{ route('stuff_show', $stuff->id) }}"
                                            class="js-fastorder mt-2 btn border-none flex justify-center items-center btn-xs block w-full mx-auto py-2 h-auto mt-1  rounded bg-gray-500 text-center text-white text-xs">
                                            <span>خاموش است</span>
                                            <ion-icon class="mr-1 text-sm" name="notifications-off"></ion-icon>
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


@section('script')
@include('layouts.vendor.fast-search-js')
    <script>
        $(document).on('click', '.js-fastorder', function() {
            $('.js-modal-section').removeClass('hidden').addClass('flex')
        })
        $(document).on('click', '.js-modal-close', function() {
            $('.js-modal-section').removeClass('flex').addClass('hidden')
        })
    </script>
    <script>

        var ajaxUrl = '';
        $(document).on('click', '.js-fastorder', function() {
            ajaxUrl = $(this).attr('data-url')
            $.ajax({
                    url: ajaxUrl
                })
                .done(function(data) {
                    if (console && console.log) {
                        console.log("Sample of data:", data);
                    }
                    $('.js-name-value').val(data.name)
                    $('.js-brand-value').val(data.brands)
                    $('.js-tags-value').val(data.tags)
                });

        })
    </script>
@endsection
