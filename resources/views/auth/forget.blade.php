@extends('layouts.auth.app')
@section('content')
    {{--  --}}
    {{--  --}}
    <div class="px-12 mt-6 flex w-full justify-end items-end">
        <a href="{{ route('start') }}">بازگشت</a>
    </div>
    <div class="p-4">
        @include('layouts.global-error')
        @include('layouts.global-msg')
        {{--  --}}
        <div
            class="js-autohide js-error-alert hidden bg-red-300 rounded w-full py-3  top-10 px-4 mx-auto block right-0 left-0  shadow-lg">
            <div>
                <span class="flex items-center block justify-between ">
                    <div class="right">
                        <ul>
                            <span class="js-error-msg"></span>
                        </ul>
                    </div>
                    <div class="js-autohide-close left flex self-center items-center h-full">
                        <ion-icon class="js-autohide-close" name="close-circle-outline" size="large"
                            style=" --ionicon-stroke-width: 12px;"></ion-icon>
                    </div>
                </span>
            </div>
        </div>
        {{--  --}}
        <div
            class="js-autohide hidden  js-success-alert bg-green-300 rounded w-full py-3  top-10 px-4 mx-auto block right-0 left-0  shadow-lg">
            <div>
                <span class="flex items-center block justify-between ">
                    <div class="right">
                        <span class="js-success-msg"></span>
                    </div>

                    <div class="js-autohide-close left flex self-center items-center h-full">
                        <ion-icon class="js-autohide-close" name="close-circle-outline" size="large"
                            style=" --ionicon-stroke-width: 12px;"></ion-icon>
                    </div>

                </span>
            </div>
        </div>
    </div>
    {{--  --}}
    {{--  --}}
    <div class="flex bg-white px-8 w-screen h-full items-center justify-center">
        <div class="inner">
            <img src="{{ asset('images/forget.svg') }}" alt="" class="w-20 mx-auto rounded-full block">
            <p class="text-center font-bold text-lg">فراموشی رمز عبور</p>
            {{-- <p class="text-center">لطفا جهت دریافت رمز عبور جدید، کد ارسال شده و رمز عبور جدید را وارد کنید</p> --}}
            <form action="{{ route('user_update_with_code') }}">
                <div class="divider">اطلاعات کاربری</div>
                <div class="relative">
                    <label for="phone">شماره همراه :</label>
                    <input type="phone" id="phone" name="phone" value="{{ old('phone') }}"
                        class="js-phone input w-full input-bordered mt-2" placeholder="شماره همراه خودرا وارد کنید">
                </div>
                <div class="divider">تغییر رمز عبور</div>
                <div class="relative">
                    <label for="password">رمز عبور جدید :</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        class="input w-full input-bordered mt-2" placeholder="********">
                </div>
                <div class="relative mt-4">
                    <label for="password_confirmation"> تکرار رمز عبور :</label>
                    <input type="password" id="password_confirmation" value="{{ old('password') }}"
                        name="password_confirmation" class="input w-full input-bordered mt-2" placeholder="********">
                </div>
                <div class="divider">کد فعال سازی</div>
                <div class="relative">
                    <label for="code"> کد تایید:</label>
                    <input type="text" id="code" name="code" class="input w-full input-bordered mt-2"
                        placeholder="کد ارسال شده">
                </div>
                <div class="grid mt-4 grid-cols-2 gap-2">
                    <div class="col-span-1">
                        <button type="submit" class="btn bg-purple-800 btn-primary  w-full">ثبت رمز جدید</button>
                    </div>
                    <div class="col-span-1">
                        <button type="button" class="js_generate_code btn btn-gray  w-full">ارسال کد </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- bayad shomarasho vared kone
bayad barash sms-code biad
bayad codo + passworde jadidesho vared kone
bayad codi ke vared mikone ta 2 deyeghe time diff ba codi ke too databace baraye oon shomare zakhire shode 1ki bashe --}}
@endsection




@section('script')
    <script>
        $('.js_generate_code').on('click', function() {



            $.ajax({
                type: "get",
                url: "{{ route('forget_code_send') }}",
                dataType: 'json',
                data: {
                    phone: $('.js-phone').val(),
                },
                success: function(data) {
                    console.log(data.msg);
                    if (data.msg == "user_not_found") {
                        $('.js-error-msg').text('شماره وارد شده در سیستم ثبت نشده است.');
                        $('.js-error-alert').show();
                        $('.js-error-alert').delay(2000).fadeOut();
                    }
                    if (data.msg == "wating_error") {
                        $('.js-error-msg').text(' برای ارسال مجدد کد لطفا ' + data.time +
                            ' ثانیه صبر کنید ');
                        $('.js-error-alert').show();
                        $('.js-error-alert').delay(2000).fadeOut();
                    }
                    if (data.msg == "success") {
                        $('.js-success-msg').text('کد تایید به شماره همراه شما ارسال شد');
                        $('.js-success-alert').show();
                        $('.js-success-alert').delay(2000).fadeOut();
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        })
    </script>
@endsection
