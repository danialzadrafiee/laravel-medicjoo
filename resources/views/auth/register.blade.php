@extends('layouts.auth.app')
@section('content')
    <style>
        .button {
            background: linear-gradient(180deg, #503BFF 0%, #373299 100%);
        }
        html,
        body {
            background: white !important;
        }

    </style>
    <div class="p-4 fixed top-10 z-50 w-full">
        @include('layouts.global-error')
        @include('layouts.global-msg')
    </div>
    <section class="js-signup-form signup  pt-8 px-4 bg-white w-full z-40 ">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="divider">ثبت اکانت مدیکجو</div>
            <div class="title text-sm mb-4 hidden  text-center  mt-1">ساخت اکانت پلتفرم مدیکجو</div>
            <div class="mt-2">

                <div class=" mt-2 relative">
                    <label class="!block hidden text-sm mb-2">نام کامل :</label>
                    <div
                        class="icon  absolute text-gray-600 text-2xl  top-2 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                    <input autocomplete="nope" type="text" name="name"
                        class=" py-2.5  w-full  !border-b-2 !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                        placeholder="نام و نام خانوادگی">
                </div>

                <div class=" mt-2 relative">
                    <label class="!block hidden text-sm mb-2">کد ملی :</label>
                    <div
                        class="icon  absolute text-gray-600 text-2xl  top-2 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                    <input autocomplete="nope" type="number" name="meli_code"
                        class=" py-2.5  w-full  !border-b-2 !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                        placeholder="کد ملی">
                </div>

                <div class=" mt-2 relative">
                    <label class="!block hidden text-sm mb-2">شماره شبا :</label>
                    <div
                        class="icon  absolute text-gray-600 text-2xl  top-2 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                    <input autocomplete="nope" type="number" name="sheba_code"
                        class=" py-2.5  w-full  !border-b-2 !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                        placeholder="شماره شبا بدون IR">
                </div>

                <div class=" mt-2 relative">
                    <label class="!block hidden text-sm mb-2">کد imed :</label>
                    <div
                        class="icon  absolute text-gray-600 text-2xl  top-2 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                    <input autocomplete="nope" type="text" name="imed_code"
                        class=" py-2.5  w-full  !border-b-2 !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                        placeholder="کد IMED">
                </div>

                <div class=" mt-2 relative">
                    <label class="!block hidden text-sm mb-2">شماره تماس همراه : </label>
                    <div
                        class="icon  absolute text-gray-600 text-2xl  top-2 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                    <input autocomplete="nope" type="text" name="phone" value="{{ old('phone') }}"
                        class=" py-2.5  w-full  !border-b-2 !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                        placeholder="مثلا : 09121004422">
                </div>
                {{--  --}}
                <div class="grid mt-4 grid-cols-2 gap-2">
                    <div class="col-span-1">
                        <div class="  relative">
                            <label class="block text-sm mb-2">رمز عبور :</label>
                            <div
                                class="icon  absolute text-gray-600 text-2xl  top-10 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <input autocomplete="nope" type="password" name="password"
                                class=" py-2.5  w-full  border rounded !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                                placeholder="********">
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="  relative">
                            <label class="block text-sm mb-2">تکرار رمز عبور :</label>
                            <div
                                class="icon  absolute text-gray-600 text-2xl  top-10 right-2 fill-gray-300 stroke-gray-500 bottom-0 my-auto ">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <input autocomplete="nope" type="password" name="password_confirmation"
                                class="  py-2.5  w-full  border rounded !border-gray-300 border rounded  text-gray-600 placeholder-gray-500 pr-9"
                                placeholder="********">
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="relative">
                    <div class="divider text-sm">
                        گروه کاربری
                    </div>
                    <div class="grid  grid-cols-2">
                        <div class="col-span-1 flex items-center justify-start">
                            <label class="ml-2" for="radioClient">مشتری هستم</label>
                            <input id="radioClient" type="radio" name="job" value="client" class="radio radio-xs" checked>
                        </div>

                        <div class="col-span-1 flex items-center justify-end">
                            <label class="ml-2" for="radioVendor">فروشنده هستم</label>
                            <input id="radioVendor" type="radio" name="job" value="vendor" class="radio radio-xs">
                        </div>
                        <div class="col-span-2 mt-2">
                            <div class="rounded flex w-full py-2 text-xs px-2 bg-yellow-100">
                                <div>
                                    <ion-icon name="alert-circle-outline" class="h-full ml-2 text-3xl text-gray-500">
                                    </ion-icon>
                                </div>
                                <div class="text-right">
                                    اگر قصد فعالیت همزمان در هر دو گروه با
                                    <span class="font-bold">
                                        "یک شماره همراه"
                                    </span>
                                    را دارید، ابتدا
                                    اکانت
                                    <span class="font-bold">
                                        "مشتری"
                                    </span>

                                    ثبت کنید
                                    سپس آن را به سطح فروشنده ارتقا دهید
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="button rounded w-full py-2 mt-4 text-center text-white text-lg font-bold">
                    ثبت نام
                </button>
                <div class="signup mt-4 text-sm">
                    <div class="text-center">
                        قبلا اکانت ساختید؟
                        <a href="{{ route('login') }}" class="text-purple-800 js-close-signup">وارد شوید </a>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
