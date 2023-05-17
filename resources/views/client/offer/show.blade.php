@extends('layouts.client.app')
@section('background', '#fcfcfc')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

    {{-- todo
        
        form link to store
        if medicjoo ersal shode bood tarif she
        dokmeye tahvil gereftam corn jobe tahvil shode --}}

    <div class="px-4 py-4">
        @include('layouts.global-error')
        @include('layouts.global-msg')
    </div>

    <section class="navbar hidden px-4">

    </section>
    <section class="offers px-4">

        @if (!App\Offer::where('id', $offer->id)->first()->comment()->exists())
            <div class="comment">
                <form action="{{ route('comment_store') }}">

                    <input type="hidden" class="js-point" value="0" name="point">
                    <input type="hidden" value="{{ $offer->id }}" name="offer_id">
                    <input type="hidden" value="{{ $offer->vendor_id }}" name="vendor_id">
                    <input type="hidden" value="{{ $offer->client_id }}" name="user_id">
                    @csrf
                    <div class="rounded px-4 py-4 mt-4 bg-purple-400">
                        <div class="justify-between mb-2 flex items-center">
                            <span class="text-purple-800 font-bold">از سفارش راضی بودید؟ </span>
                            <section class='rating-widget' dir="ltr">
                                <!-- Rating Stars Box -->
                                <div class='rating-stars text-center'>
                                    <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>

                            </section>
                        </div>
                        <textarea name="describe" id="" rows="1" class="js-textarea hidden  bg-purple-100 border-purple-400 textarea w-full"
                            placeholder="توضیحات (غیر ضروری)"></textarea>
                        <div class="flex w-full justify-end">
                            <button type="submit" class="font-normal js-btn-submit hidden btn btn-primary  btn-sm bg-purple-800">ثبت نظر</button>

                        </div>
                    </div>

                </form>
            </div>
        @endif


        <div class="order bg-white mt-32 relative">

            <div class="shadow-md shadow-gray-800 relative rounded ">
                <div class="header relative w-full ">
                    <div class="image  absolute -top-20 right-0 left-0 mx-auto">
                        <img src=" https://picsum.photos/id/13/200" class="rounded mx-auto w-32" alt="">
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
                        <span class="mx-1"> وضعیت :</span>
                        @switch($offer->status)
                            @case(0)
                                در انتظار پرداخت
                            @break

                            @case(1)
                                در حال آماده سازی
                                {{-- montazere ersale forooshande --}}
                            @break

                            @case(2)
                                @if (intval(date_diff($offer->updated_at, now())->format('%H')) < 2)
                                    در مسیر مقصد
                                    @php
                                        $time = explode(' ', date_diff($offer->updated_at, now())->format('%H %i %s'));
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
                                    @if (intval(date_diff($offer->updated_at, now())->format('%H')) < 5)
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
                    <div class="text-center text-xs"> {{ $offer->address }}</div>
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
    <script>
        //rating starts https://codepen.io/depy/pen/vEWWdw


        $(document).ready(function() {

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                console.log(ratingValue)

            });
        });

        $('.star').on('click', function() {
            $('.js-textarea').show();
            $('.js-btn-submit').show();
        })
    </script>
    <style>
        /* rating-starts */


        .new-react-version {
            padding: 20px 20px;
            border: 1px solid #eee;
            border-radius: 20px;
            box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);

            text-align: center;
            font-size: 24px;
            line-height: 1.7;
        }

        .new-react-version .react-svg-logo {
            text-align: center;
            max-width: 60px;
            margin: 20px auto;
            margin-top: 0;
        }





        .success-box {
            margin: 50px 0;
            padding: 10px 10px;
            border: 1px solid #eee;
            background: #f9f9f9;
        }

        .success-box img {
            margin-right: 10px;
            display: inline-block;
            vertical-align: top;
        }

        .success-box>div {
            vertical-align: top;
            display: inline-block;
            color: #888;
        }



        /* Rating Star Widgets Style */
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul>li.star {
            display: inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul>li.star>i.fa {
            font-size: 1em;
            /* Change the size of the stars */
            color: #ccc;
            /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul>li.star.hover>i.fa {
            color: #ff50d3;

        }

        /* Selected state of the stars */
        .rating-stars ul>li.star.selected>i.fa {
            color: #562bb9;
        }

    </style>
@endsection
