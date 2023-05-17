@extends('layouts.client.app')

@php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.iotype.com/developer/token');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['ip' => $ip]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: VjS4JHtsYxKaryTciwVTK3lBABk2yTnN', 'Accept: application/json', 'X-Requested-With: XMLHttpRequest']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
curl_close($ch);
try {
    $token = json_decode($output)->data->token;
} catch (\Throwable $th) {
    $token = 'iotype-accout-end';
}
@endphp
<input type="hidden" class="token-client" value="{{ $token }}">


@section('content')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css' />
    <style>
        .owl-stage {
            right: -30px !important;
        }

        .owl-dots {
            margin: auto;
            bottom: 16px;
            position: absolute;
            left: 0;
            right: 0;
        }

        .owl-nav {
            display: none;
        }

        .advertise .owl-stage {
            right: 0px !important;
        }

        .context {
            background: #FAFBFF !important;
        }

    </style>
    {{-- main-context --}}




    <section class=" context relative mb-4 pb-4  mt-2 px-4">
        <div class="fixed z-50 w-full block right-0 px-4 left-0 mx-auto top-5">
            @include('layouts.global-error')
        </div>

        <div class="advertise w-full h-32  rounded-xl">

            <div class="owl-carousel owl-top owl-theme" dir="ltr">
                @foreach ($banners_1 as $banner)
                    <div class="item">
                        <a href="{{ $banner->link }}" class="rounded-xl bg-red-100 ">
                            <img src="{{ $banner->image }}" alt="{{ $banner->title }}"
                                class="w-full rounded-xl h-full block">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class=" py-3 w-full"></div>
        <div class="main-icons">
            <div class="grid  gap-x-2 gap-y-7 items-center grid-cols-4 justify-center">
                <div class="col-span-1">
                    <a class="icon" href="{{ route('client_catalog', 'همه') }}">
                        <img src="{{ asset('img/icon/3/catalog.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            کاتالوگ
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="{{ route('client_offer_actives', ['id' => 1]) }}" class="icon">
                        <img src="{{ asset('img/icon/3/peygiri.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            پیگیری
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="{{ route('client_support') }}" class="icon">
                        <img src="{{ asset('img/icon/3/support.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            پشتیبانی
                        </div>
                    </a>
                </div>
                <a href="{{ route('client_offer_history') }}" class="col-span-1">
                    <div class="icon">
                        <img src="{{ asset('img/icon/3/history.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            تاریخچه
                        </div>
                    </div>
                </a>
                <a href="{{ route('client_credit') }}" class="col-span-1">
                    <div class="icon">
                        <img src="{{ asset('img/icon/3/creadit.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            اعتبارات
                        </div>
                    </div>
                </a>
                <a href="{{ route('client_news') }}" class="col-span-1">
                    <div class="icon  ">
                        <img src="{{ asset('img/icon/3/news.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            اخبار
                        </div>
                    </div>
                </a>
                <div class="col-span-1">
                    <a href="{{ route('banner') }}" class="icon  cursor-pointer filter  ">
                        <img src="{{ asset('img/icon/3/advertise.png') }}" class="mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            تبلیغات
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="{{ route('client_be_vendor_index') }}" class="icon  cursor-pointer filter  ">
                        <img src="{{ asset('img/icon/3/sellers.png') }} " class=" mx-auto w-full px-4 mb-2" alt="">
                        <div class="text text-center text-sm">
                            فروشنده
                        </div>
                    </a>
                </div>
            </div>
        </div>
        {{-- carousel --}}
        <section class="ad-one mt-6" dir="ltr">
            <div class="owl-carousel owl-center" dir="ltr">
                @foreach ($banners_2 as $banner)
                    <div>
                        <a href="{{ $banner->link }}">
                            <img src="{{ $banner->image }}" class="rounded-box" />
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        {{-- endcontext --}}
    </section>
    <section class="js-popup popup fixed z-20  px-8 bg-white shadow-md w-full bottom-0 right-0 rounded-t-3xl"
        style="display: none">
        <div class="header">
            <div class="flex justify-between pt-5">
                <div class="title font-bold">ثبت سریع سفارش</div>
                <button class="btn-xs js-order-hide btn-outline btn btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="text text-gray-500 pt-2 text-sm">
                سفارش خود را ثبت کنید تا مناسب ترین پیشنهاد فروشندگان را
                برای شما جستجو کنیم . همچنین می توانید سفارش مورد نظر
                خود را از
                <a class="font-bold" href="{{ route('client_catalog', 'همه') }}">
                    کاتالوگ
                </a>
                انتخاب کنید
            </div>
        </div>
        <div class="form">
            <form action="{{ route('client_order_store') }}" class="js-fast-order" method="post">
                @csrf
                <div class="inputs">
                    <div class=" relative mt-3">
                        <div
                            class="js-autofill  bg-white rounded absolute z-50  h-max w-full  top-16 border p-2 px-4 border-gray-200">
                        </div>
                        <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> نام کالا</label>
                        <input autocomplete="nope" name="name" id="myInput" type="text"
                            class="js-input-name  z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                            placeholder="مثلا : کامپوزیت ">
                    </div>
                </div>
                <div class="inputs">
                    <div class=" relative mt-3">
                        <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> برند (غیر
                            ضروری)</label>
                        <input name="brand" type="text" class=" z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                            placeholder="مثلا : اولترادنت">
                    </div>
                </div>
                <div class="grid gap-3 grid-cols-2">
                    <div class="col-span-1">
                        <div class="inputs">
                            <div class=" relative mt-3">
                                <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">تعداد
                                </label>
                                <input data-rule="required|integer" name="count" type="number"
                                    class=" text-center z-10 border h-12 border-gray-300 rounded py-3 my-2 w-full"
                                    placeholder="مثلا : ۱۵">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="inputs">
                            <div class=" relative mt-3">
                                <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">
                                    واحد
                                </label>
                                <select name="unit" id=""
                                    class="bg-white text-center h-12 z-10 border border-gray-300 rounded py-3 my-2 w-full">
                                    <option value="عدد">عدد</option>
                                    <option value="جعبه">جعبه</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons mt-2 pb-2">
                    <div class="grid grid-cols-6 justify-between">
                        <div style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);"
                            class="col-span-1 w-12 h-12  voice bg-purple-900 text-white rounded-3xl mx-1 js-mice-show py-2 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mt-0.5 cursor-pointer  " width="19.456"
                                height="28.299" viewBox="0 0 19.456 28.299">
                                <path id="Icon_awesome-microphone" data-name="Icon awesome-microphone"
                                    d="M9.728,19.456a5.306,5.306,0,0,0,5.306-5.306V5.306a5.306,5.306,0,0,0-10.612,0v8.843A5.306,5.306,0,0,0,9.728,19.456Zm8.843-8.843h-.884a.884.884,0,0,0-.884.884v2.653a7.083,7.083,0,0,1-7.782,7.04,7.29,7.29,0,0,1-6.368-7.356V11.5a.884.884,0,0,0-.884-.884H.884A.884.884,0,0,0,0,11.5v2.22A10.032,10.032,0,0,0,8.4,23.758v1.888h-3.1a.884.884,0,0,0-.884.884v.884a.884.884,0,0,0,.884.884h8.843a.884.884,0,0,0,.884-.884V26.53a.884.884,0,0,0-.884-.884h-3.1V23.779a9.737,9.737,0,0,0,8.4-9.63V11.5A.884.884,0,0,0,18.571,10.612Z"
                                    fill="#fff" />
                            </svg>
                        </div>
                        <button style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);" type="submit"
                            class=" js-fast-order-submit  col-span-5 mr-1 submit bg-purple-900 text-white rounded-lg py-2 text-center">ثبت
                            سفارش</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="js-miceup fixed  z-20 px-8 bg-white shadow-md w-full bottom-0 right-0 rounded-t-3xl"
        style="display:none">
        <div class="header">
            <div class="flex justify-between pt-5">
                <div class="title font-bold"> سفارش هوشمند</div>
                <button class="btn-xs js-miceup-close btn-outline btn btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="text text-gray-500 pt-2 text-sm">
                دکمه میکروفون را لمس کرده و سفارش خود را بیان کنید.
                درصورت صحت سفارش آن را ثبت کنید.
            </div>
        </div>
        <div class="object-mice mt-10 mx-auto pt-4 flex justify-start items-center block relative">
            <div class="mice-border-2 animate__animated animate__infinite animate__slow animate__pulse ">
            </div>
            <div class="mice-border-1  animate__animated animate__infinite  animate__pulse">
            </div>
            <div
                class="js-mice-btn absolute rounded-full bg-green-500 text-center text-4xl mx-auto text-white cursor-pointer mt-4 flex justify-center items-center css-mice ">
                <svg width="41" height="59" viewBox="0 0 41 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.2465 45.3357V56.7398Z" fill="url(#paint0_linear_104_3)" />
                    <path
                        d="M11.1232 56.7398H29.3697M38.493 22.5276V27.0893C38.493 37.1248 30.282 45.3357 20.2465 45.3357M20.2465 45.3357C10.2109 45.3357 2 37.1248 2 27.0893V22.5276M20.2465 45.3357V56.7398"
                        stroke="white" stroke-width="3.98816" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M16.7481 2.68227C17.8577 2.22592 19.0468 1.99407 20.2466 2.00012C25.3784 2.00012 29.3698 5.99153 29.3698 11.1234V26.9465C29.3698 32.0783 25.2359 36.2123 20.2466 36.2123C15.2573 36.2123 11.1233 31.9642 11.1233 26.9465V11.1234C11.1173 9.92358 11.3492 8.73451 11.8055 7.6249C12.2618 6.51529 12.9336 5.50715 13.782 4.65877C14.6304 3.8104 15.6385 3.13861 16.7481 2.68227Z"
                        stroke="white" stroke-width="3.98816" stroke-linecap="round" stroke-linejoin="round" />
                    <defs>
                        <linearGradient id="paint0_linear_104_3" x1="20.2465" y1="22.5276" x2="20.2465" y2="56.7398"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4C1D95" />
                            <stop offset="1" stop-color="#381A67" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="js-text-generated text-center text-gray-600 my-2 ">دکمه میکروفون را لمس کنید </div>
        <div class="inputs">
            <div class=" relative mt-3">
                <div
                    class="js-autofill  bg-white rounded absolute z-30  h-max w-full  top-16 border p-2 px-4 border-gray-200">
                </div>
                <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> دستور سفارش </label>
                <input autocomplete="nope" name="name" id="myInput" type="text"
                    class="js-input-voice-rec  z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                    placeholder="مثلا : یک جعبه قلم دایکال دناپویا ">
            </div>
        </div>
        <div class="buttons mt-2 pb-2">
            <div class="grid grid-cols-6 justify-between">
                <div style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);"
                    class="js-miceup-close col-span-1 flex justify-center items-center w-12 h-12 voice bg-purple-900 text-white rounded-3xl mx-1 py-2 text-center">
                    <svg width="22" height="28" viewBox="0 0 22 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21.0411 11.9955V23.6549C21.0411 24.417 20.7384 25.1479 20.1994 25.6868C19.6605 26.2258 18.9296 26.5285 18.1675 26.5285H4.75697C3.99483 26.5285 3.2639 26.2258 2.72498 25.6868C2.18606 25.1479 1.8833 24.417 1.8833 23.6549V4.49703C1.8833 3.73488 2.18606 3.00395 2.72498 2.46503C3.2639 1.92611 3.99483 1.62335 4.75697 1.62335H10.669C11.1769 1.62343 11.664 1.8252 12.0232 2.18432L20.4802 10.6413C20.8393 11.0005 21.041 11.4876 21.0411 11.9955Z"
                            stroke="white" stroke-width="1.91578" stroke-linejoin="round" />
                        <path
                            d="M6.67276 20.7812H16.2517M11.4622 2.10229V9.28648C11.4622 9.79458 11.6641 10.2819 12.0233 10.6411C12.3826 11.0004 12.8699 11.2023 13.378 11.2023H20.5622L11.4622 2.10229ZM6.67276 15.9917H16.2517H6.67276Z"
                            stroke="white" stroke-width="1.91578" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <button style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);" type="submit"
                    class="col-span-5 mr-1 submit bg-purple-900 text-white rounded-lg py-2 text-center">ثبت
                    سفارش</button>
            </div>
        </div>
        <input type="hidden" class='js-stuff-names' value="{{ json_encode($stuffs_names, JSON_UNESCAPED_UNICODE) }}">
    </section>

    @include('layouts.client.fast-order-html')
@endsection
@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
    <script>
        $(document).ready(function() {
            $('.owl-center').owlCarousel({
                stagePadding: 30,
                loop: true,
                margin: 20,
                items: 1
            });
            //
            $('.owl-top').owlCarousel({
                loop: true,
                margin: 20,
                items: 1,
                nav: true,
            })
        });
    </script>
    @include('layouts.client.fast-order-js')
@endsection
