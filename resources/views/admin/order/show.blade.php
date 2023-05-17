@extends('layouts.admin.app')
@section('content')
    <section class="orders px-4">
        <div class="order bg-white mt-32 relative">
            <div class="shadow-md shadow-gray-800 relative rounded ">
                <div class="header relative w-full ">
                    <div class="image  absolute -top-20 right-0 left-0 mx-auto">
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
                        <img src="{{ asset($img) }}" class="rounded w-32 h-24 shadow object-cover" alt="">

                    </div>
                    <div class="title pt-14 font-bold text-center">{{ $order->name }}</div>
                    <div class="brand border-b border-gray-200 mt-1 pb-3  mx-auto px-14 block w-max text-sm text-center">
                        {{ $order->brand }}</div>
                </div>
                <div class="counting mt-3 w-max mx-auto">
                    <div class="grid-cols-2 items-center justify-center grid">
                        <div class="col-span-1">
                            <label class="block text-center px-4">تعداد</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">{{ $order->count }}</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">واحد</label>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-center px-4">{{ $order->unit }}</label>
                            {{-- <label>{{ $order->unit }}</label> --}}
                        </div>
                    </div>
                </div>
                <div class="orffer  mt-3">
                    <div
                        class="title  mx-auto text-sm   text-center font-bold w-full border-t border-b border-gray-200 py-2 ">
                        <span class="mx-1"> وضعیت :</span>
                        @switch($order->status)
                            @case(0)
                                در انتظار تایید
                            @break

                            @case(1)
                                در حال آماده سازی
                                {{-- montazere ersale forooshande --}}
                            @break

                            @case(2)
                                @if (intval(date_diff($order->updated_at, now())->format('%H')) < 2)
                                    در مسیر مقصد
                                    @php
                                        $time = explode(' ', date_diff($order->updated_at, now())->format('%H %i %s'));
                                        $time['h'] = $time[0];
                                        $time['m'] = $time[1];
                                        $time['s'] = $time[2];
                                        $seconds = $time['h'] * 3600 + $time['m'] * 60 + $time['s'];
                                    @endphp
                                    <input type="hidden" class="js-timer-start" value="{{ $seconds }}">
                                    <div class="block text-center mx-auto text-xs font-normal">
                                        <span class="js-timer-show">00:00:00</span>
                                        <span> باقی مانده</span>
                                    </div>
                                @else
                                    <span class="text-success"> تکمیل شده</span>
                                    @if (intval(date_diff($order->updated_at, now())->format('%H')) < 5)
                                        <button class="btn mx-auto my-2 block btn-error btn-sm "> سفارش را دریافت نکردید؟</button>
                                        {{-- action send notif to admin --}}
                                    @endif
                                @endif
                            @break

                            @default
                        @endswitch
                    </div>
                    <p class="describe  text-center text-xs mt-2 pb-2 px-10 pt-2 text-gray-700 ">
                        <span class="font-bold"> تحویل به :</span>
                    <div class="text-center text-xs"> {{ $order->address }}</div>
                    </p>
                    <div class="title text-center mt-2 text-xs text-bold bg-gray-100 py-2"> جزییات سفارش </div>
                    <table class="table  w-full  rounded mx-auto  text-sm table-auto">
                        <tr class="pt-5">
                            <td class="font-bold px-4">کد سفارش</td>
                            <td class="px-4 py-2 ">{{ $order->id }}</td>
                        </tr>
                        <tr class="pt-5">
                            <td class="font-bold px-4">نام کالا</td>
                            <td class="px-4 py-2 ">{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">برند سفارش</td>
                            <td class="px-4 py-2 ">{{ $order->order_brand }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">برند ارسالی</td>
                            <td class="px-4 py-2 ">{{ $order->order_brand }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">تعداد</td>
                            <td class="px-4 py-2 ">{{ $order->count }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">واحد</td>
                            <td class="px-4 py-2 ">{{ $order->unit }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">قیمت</td>
                            <td class="px-4 py-2 ">{{ $order->price }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">تاریخ ثبت</td>
                            <td class="px-4 py-2 ">{{ Verta::instance($order->created_at)->format('l, %d %B ') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold px-4">زمان ثبت</td>
                            <td class="px-4 py-2 "> {{ Verta::instance($order->created_at)->format('H:i') }}</td>
                        </tr>
                    </table>
                    <div class="submit mt-2 pb-0">
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        String.prototype.toHHMMSS = function() {
            var sec_num = parseInt(this, 10); // don't forget the second param
            var hours = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);
            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            return hours + ':' + minutes + ':' + seconds;
        }
        var start = $('.js-timer-start').val();
        var diff = (3600 * 2) - start;
        $('.js-timer-show').text(diff.toString().toHHMMSS())
        setInterval(function() {
            diff = diff - 1;
            $('.js-timer-show').text(diff.toString().toHHMMSS())
            if (diff == 0) {
                location.reload();
            }
        }, 1000);
    </script>
@endsection
