@extends('layouts.vendor.app')
@section('content')
    <div class="px-4 py-2">
        @include('layouts.global-error')
        @include('layouts.global-msg')
    </div>


    <section class="offers px-4">
        <header>
            <div class="flex mt-4 justify-between">
                <div class="right">
                    <div class="title text-xl font-bold mt-4">
                        سفارش های فعال
                    </div>
                </div>
                <div class="left flex">

                    <div class="show js-show">
                        <div
                            class="border cursor-pointer border-gray-300 bg-white rounded px-2 py-2 text-center ml-2 hidden">
                            <svg class=" transform scale-75" width="34" height="34" viewBox="0 0 34 34" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.9775 7.4375C11.8018 7.4375 6.4926 10.4331 2.31299 16.4243C2.19369 16.5971 2.12831 16.8015 2.12512 17.0116C2.12193 17.2216 2.18107 17.4279 2.29506 17.6043C5.50647 22.6313 10.7446 26.5625 16.9775 26.5625C23.1426 26.5625 28.4883 22.6193 31.7057 17.5811C31.8171 17.4081 31.8763 17.2067 31.8763 17.001C31.8763 16.7953 31.8171 16.5939 31.7057 16.4209C28.481 11.4405 23.0962 7.4375 16.9775 7.4375Z"
                                    stroke="black" stroke-width="2.125" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M17 22.3125C19.934 22.3125 22.3125 19.934 22.3125 17C22.3125 14.066 19.934 11.6875 17 11.6875C14.066 11.6875 11.6875 14.066 11.6875 17C11.6875 19.934 14.066 22.3125 17 22.3125Z"
                                    stroke="black" stroke-width="2.125" stroke-miterlimit="10" />
                            </svg>
                        </div>
                    </div>
                    <div class="show js-hide hidden">
                        <div
                            class="border cursor-pointer border-gray-300 bg-white rounded px-2 py-2 text-center ml-2 hidden">
                            <svg class=" transform  scale-75" width="34" height="34" viewBox="0 0 34 34" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M28.6876 29.7501C28.5481 29.7503 28.4098 29.7229 28.2809 29.6694C28.152 29.616 28.035 29.5375 27.9366 29.4386L4.56155 6.06361C4.3707 5.86273 4.26588 5.59524 4.26943 5.31819C4.27297 5.04113 4.38461 4.77641 4.58054 4.58049C4.77646 4.38456 5.04118 4.27292 5.31824 4.26937C5.5953 4.26583 5.86278 4.37065 6.06366 4.5615L29.4387 27.9365C29.5872 28.0851 29.6883 28.2744 29.7292 28.4804C29.7702 28.6865 29.7491 28.9 29.6688 29.0941C29.5884 29.2882 29.4523 29.4541 29.2776 29.5708C29.103 29.6876 28.8977 29.75 28.6876 29.7501V29.7501ZM16.9775 25.5001C14.2223 25.5001 11.5654 24.6846 9.0805 23.0762C6.81803 21.6153 4.78135 19.5228 3.19026 17.0333V17.0279C4.5144 15.1307 5.96471 13.5263 7.5226 12.2328C7.5367 12.221 7.54819 12.2064 7.55637 12.1899C7.56454 12.1735 7.56921 12.1555 7.57008 12.1372C7.57095 12.1188 7.56801 12.1005 7.56144 12.0833C7.55487 12.0662 7.54481 12.0506 7.5319 12.0375L6.20909 10.7167C6.18558 10.693 6.15401 10.679 6.12067 10.6775C6.08732 10.6761 6.05464 10.6872 6.02913 10.7087C4.37428 12.1033 2.83831 13.8139 1.44178 15.8167C1.20152 16.1615 1.06919 16.57 1.06162 16.9903C1.05406 17.4105 1.17159 17.8235 1.39928 18.1768C3.15307 20.9213 5.41022 23.2329 7.92569 24.8606C10.7579 26.6954 13.806 27.6251 16.9775 27.6251C18.6895 27.6197 20.3893 27.3376 22.0111 26.7897C22.0325 26.7824 22.0517 26.7698 22.0669 26.7531C22.0821 26.7363 22.0927 26.716 22.0978 26.694C22.1029 26.672 22.1024 26.649 22.0961 26.6273C22.0899 26.6056 22.0783 26.5858 22.0623 26.5699L20.6292 25.1368C20.5962 25.1046 20.5554 25.0816 20.5108 25.0699C20.4662 25.0583 20.4194 25.0585 20.3749 25.0704C19.2651 25.3562 18.1236 25.5006 16.9775 25.5001V25.5001ZM32.595 15.8446C30.8378 13.1272 28.5581 10.819 26.0028 9.16877C23.1759 7.34126 20.0548 6.37505 16.9775 6.37505C15.2837 6.37806 13.6026 6.66608 12.0044 7.22705C11.9831 7.23446 11.964 7.24716 11.949 7.26397C11.934 7.28078 11.9235 7.30114 11.9185 7.32313C11.9135 7.34512 11.9142 7.36801 11.9205 7.38966C11.9268 7.4113 11.9385 7.43099 11.9546 7.44685L13.3856 8.87791C13.4189 8.91065 13.4603 8.93404 13.5055 8.9457C13.5508 8.95735 13.5983 8.95688 13.6433 8.94431C14.7303 8.65025 15.8514 8.50088 16.9775 8.50005C19.6796 8.50005 22.3285 9.32548 24.85 10.9571C27.155 12.4446 29.2155 14.5351 30.8106 17.0001C30.8118 17.0016 30.8124 17.0034 30.8124 17.0054C30.8124 17.0073 30.8118 17.0092 30.8106 17.0107C29.6528 18.8335 28.216 20.4632 26.5526 21.8404C26.5384 21.8521 26.5268 21.8667 26.5185 21.8832C26.5102 21.8997 26.5054 21.9177 26.5045 21.9362C26.5035 21.9546 26.5064 21.973 26.513 21.9903C26.5196 22.0075 26.5297 22.0232 26.5427 22.0363L27.8642 23.3571C27.8876 23.3807 27.9189 23.3947 27.9521 23.3963C27.9853 23.3979 28.0179 23.387 28.0435 23.3658C29.8192 21.8706 31.3563 20.1132 32.6016 18.1542C32.8217 17.809 32.9381 17.4078 32.9369 16.9984C32.9357 16.589 32.8171 16.1885 32.595 15.8446V15.8446Z"
                                    fill="black" />
                                <path
                                    d="M16.9999 10.625C16.5224 10.6247 16.0463 10.6782 15.5808 10.7844C15.5573 10.7893 15.5355 10.8004 15.5178 10.8167C15.5002 10.833 15.4872 10.8537 15.4804 10.8767C15.4736 10.8998 15.4732 10.9242 15.4791 10.9475C15.4851 10.9707 15.4973 10.9919 15.5144 11.0088L22.9911 18.4835C23.0079 18.5006 23.0291 18.5128 23.0524 18.5187C23.0757 18.5247 23.1001 18.5243 23.1231 18.5175C23.1462 18.5106 23.1669 18.4977 23.1832 18.48C23.1995 18.4624 23.2106 18.4406 23.2155 18.4171C23.4284 17.4835 23.4282 16.5139 23.2149 15.5803C23.0017 14.6467 22.5808 13.7732 21.9837 13.0246C21.3865 12.276 20.6284 11.6715 19.7656 11.2561C18.9028 10.8407 17.9575 10.625 16.9999 10.625V10.625ZM11.0087 15.5165C10.9918 15.4994 10.9706 15.4872 10.9474 15.4813C10.9241 15.4753 10.8996 15.4757 10.8766 15.4825C10.8536 15.4894 10.8328 15.5023 10.8166 15.52C10.8003 15.5376 10.7891 15.5594 10.7843 15.5829C10.5434 16.635 10.5737 17.731 10.8721 18.7682C11.1706 19.8055 11.7275 20.7499 12.4907 21.5131C13.2539 22.2763 14.1984 22.8333 15.2356 23.1317C16.2728 23.4302 17.3689 23.4604 18.421 23.2196C18.4445 23.2147 18.4662 23.2036 18.4839 23.1873C18.5016 23.171 18.5145 23.1503 18.5213 23.1273C18.5281 23.1042 18.5286 23.0798 18.5226 23.0565C18.5166 23.0333 18.5045 23.012 18.4874 22.9952L11.0087 15.5165Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>
                    <select class="bg-white rounded py-1 border-gray-300 border px-4 hidden" name="" id="">
                        <option value="">جدیدترین</option>
                        <option value="">قدیمی ترین</option>
                    </select>
                </div>
            </div>
        </header>
        <div class="list">
            @foreach ($orders as $order)
                <form action="{{ route('vendor_order_show', $order->id) }}">
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
                                    <img src="{{ asset($img) }}" class="rounded w-32 h-24 shadow object-cover" alt="">
                                    {{-- <img src="https://picsum.photos/id/0/200" class="rounded w-32" alt=""> --}}
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
                                            class="button bg-purple-800 rounded px-7 py-1 text-white text-center ">پیشنهاد</button>
                                        <div data-id="{{ $order->id }}"
                                            class="cursor-pointer js-btn-showing-toggle hidden js-btn-hidden button bg-gray-800 rounded px-7 py-1 text-white mr-2 text-center ">
                                            پنهان
                                        </div>
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
            {!! $orders->links('pagination::default') !!}
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('src/js.cookie.min.js') }}"></script>
    <script>
        $(window).on('load', function() {
            hiddens = Cookies.get('hidden').split(",");
            $('.js-item').each(function() {
                var this_id = $(this).attr('data-id');
                if ($.inArray(this_id, hiddens) !== -1) {
                    $(this).addClass('hidden');
                }
            })
            $('.js-btn-showing-toggle').each(function() {
                var this_id = $(this).attr('data-id');
                if ($.inArray(this_id, hiddens) !== -1) {
                    if ($(this).hasClass('js-btn-hidden')) {
                        $(this).addClass('hidden');
                    } else {
                        $(this).removeClass('hidden');
                    }

                }
            })
        })
        $(document).on('click', '.js-btn-show', function() {
            var this_id = $(this).attr('data-id');
            hiddens = Cookies.get('hidden').split(",");
            hiddens = $.grep(hiddens, function(value) {
                return value != this_id;
            });
            $.unique(hiddens)
            Cookies.set('hidden', hiddens);

            $(this).addClass('hidden');
            $('.js-btn-hidden[data-id=' + this_id + ']').removeClass('hidden')
        })
        $(document).on('click', '.js-btn-hidden', function() {
            var this_id = $(this).attr('data-id');
            hiddens = Cookies.get('hidden').split(",");
            hiddens.push(this_id);
            $.unique(hiddens)
            Cookies.set('hidden', hiddens);
            if ($('.js-hide').hasClass('hidden')) {
                $('.js-item').each(function() {
                    if ($(this).attr('data-id') == this_id) {
                        $(this).addClass('hidden');
                    }
                })
            }
            $('.js-btn-showing-toggle').each(function() {
                var this_id = $(this).attr('data-id');
                if ($.inArray(this_id, hiddens) !== -1) {
                    if ($(this).hasClass('js-btn-hidden')) {
                        $(this).addClass('hidden');
                    } else {
                        $(this).removeClass('hidden');
                    }

                }
            })
        })
        $(document).on('click', '.js-show', function() {
            $('.js-item').removeClass('hidden')
            $(this).addClass('hidden');
            $('.js-hide').removeClass('hidden')
        })
        $(document).on('click', '.js-hide', function() {

            hiddens = Cookies.get('hidden').split(",");
            $('.js-item').each(function() {
                var this_id = $(this).attr('data-id');
                if ($.inArray(this_id, hiddens) !== -1) {
                    $(this).addClass('hidden');
                }
            })

            $(this).addClass('hidden');
            $('.js-show').removeClass('hidden')
        })
    </script>
@endsection
