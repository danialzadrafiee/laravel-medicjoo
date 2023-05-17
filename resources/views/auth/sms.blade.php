@extends('layouts.auth.app')
@section('content')
    <style>
        .button {
            background: linear-gradient(180deg, #503BFF 0%, #373299 100%);
        }

        .js-signup-form {
            bottom: -100vh;
            transition: 300ms;
            transition-timing-function: ease-out;
        }

        .sms-fields {
            direction: ltr;
            padding-left: 15px;
            letter-spacing: 42px;
            border: 0;
            background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
            background-position: bottom;
            background-size: 50px 1px;
            background-repeat: repeat-x;
            background-position-x: 35px;
            width: 220px;
            min-width: 220px;
            outline: none;
        }

        #divInner {
            left: 0;
            position: sticky;
        }

        #divOuter {
            width: 190px;
            overflow: hidden;
        }

    </style>

    @if ($errors->any())
        <div
            class=" js-autohide bg-red-300 rounded   z-50 py-3 fixed top-10 px-4 w-5/6 mx-auto block right-0 left-0  shadow-lg">
            <div>

                <span>
                    <title class="block font-bold border-b w-full mb-1 pb-1 border-black"> خطا : </title>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        </div>
    @endif

    <div
        class="js-time-error hidden js-autohide bg-yellow-300 rounded   py-3 absolute z-50 top-10 px-4 w-5/6 mx-auto block right-0 left-0 shadow-lg">
        <div>
            <span>
                <title class="block font-bold border-b w-full mb-1 pb-1 border-black"> خطا : </title>
                <span>لطفا تا پایان زمان باقی مانده برای ارسال مجدد کد صبر کنید</span>
            </span>
        </div>
    </div>


    <div class="flex relative justify-center items-center  h-screen   bg-white px-6 ">
        <div class="absolute top-20 rounded w-full js-error px-20 text-center hidden">
            <div class="bg-red-400 rounded px-4 py-3">
                کد وارد شده معتبر نمی باشد
            </div>
        </div>
        <form method="POST" class="js-form-main" action="{{ route('sms_account_actived') }}">
            @csrf
            <img class="block mx-auto w-48 mb-8" src="{{ asset('img/sms.png') }}" alt="">
            <div class="title text-2xl text-center font-bold">فعال سازی</div>
            <div class="title  mt-2 text-center text-gray-600">کد چهار رقمی پیامک شده را وارد کنید</div>

            <div class="sms-code">
                <div id="divOuter" class="mx-auto transform pb-6 scale-125 pt-6 ">
                    <div id="divInner">
                        <input class="sms-fields js-sms" class="mb-4" type="text" maxlength="4" autofocus />
                    </div>
                </div>
            </div>
            <div class="relative w-full">
                <button type="submit" class="js-submit bg-gray-700 rounded text-white py-3 px-4 w-full mt-7">تایید</button>
                <a class="js-get-code mt-4 block text-sm text-blue-400" href="#">کد دریافت نکردید؟</a>
            </div>

            <div class="js-time-left-section hidden mt-8 text-center text-sm absolute  bottom-20 ">
                <span> زمان باقی مانده برای ارسال مجدد کد:</span>
                <span class="js-time-left ">00:00</span>
            </div>
        </form>
    </div>

    <input type="hidden" class="js-hidden-var" value="">
@endsection
@section('script')
    <script>
        function millisToMinutesAndSeconds(millis) {
            var minutes = Math.floor(millis / 60000);
            var seconds = ((millis % 60000) / 1000).toFixed(0);
            return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
        }
        var twoMin = new Date(new Date().getTime() + 2 * 60 * 1000);
        var timeDiff = (new Date() - new Date(Cookies.get('sms-time')).getTime());

        setInterval(() => {
            timeDiff = (new Date() - new Date(Cookies.get('sms-time')).getTime());
            if (120000 - timeDiff > 0) {
                $('.js-time-left').text(millisToMinutesAndSeconds(120000 - timeDiff))
                $('.js-time-left-section').show(0)
            } else {
                $('.js-time-left-section').hide(0)
            }
        }, 1000);


        if (Cookies.get('sms') == undefined && Cookies.get('first-time') == undefined) {
            $.ajax({
                type: "GET",
                url: "{{ route('sms_send_code') }}",
                success: function(response) {

                    Cookies.set('sms', 'sended', {
                        expires: twoMin
                    })
                    Cookies.set('sms-time', Date(), {
                        expires: twoMin
                    })
                    Cookies.set('code', response, {
                        expires: twoMin
                    })
                    Cookies.set('first-time', 'yes', {
                        expires: 1
                    })
                }
            });
        }


        $('.js-get-code').on('click', function() {
            if (Cookies.get('sms') == undefined) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('sms_send_code') }}",
                    success: function(response) {
                        Cookies.set('sms', 'sended', {
                            expires: twoMin
                        })
                        Cookies.set('sms-time', Date(), {
                            expires: twoMin
                        })
                        Cookies.set('code', response, {
                            expires: twoMin
                        })

                        Cookies.set('first-time', 'yes', {
                            expires: 1
                        })
                    }
                });
            } else {
                $('.js-time-left-section').show(0)
                $('.js-time-error').show()
            }
        });


        $('.js-form-main').on('submit', function(e) {
            if (Cookies.get('code') != $('.js-sms').val()) {
                e.preventDefault()
                $('.js-sms').val('')
                $('.js-error').fadeIn(0).delay(3000).fadeOut('slow')
            }
        })
    </script>
@endsection
