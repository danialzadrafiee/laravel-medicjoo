@extends('layouts.auth.app')
@section('content')
    <style>
        html,
        body {
            background: white !important;
        }

        .login {
            background: linear-gradient(180deg, #030a26 0%, #0c0c15 100%);
        }

        .button {
            background: linear-gradient(180deg, #503BFF 0%, #373299 100%);
        }

    </style>
    @if ($errors->any())
        <div
            class=" js-autohide bg-red-300 rounded  z-50  py-2 fixed top-10 px-4 w-5/6 mx-auto block right-0 left-0  shadow-lg">
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

    <div class="js-web-app-sec z-30 top-0 right-0 py-4 fixed w-full px-4 hidden bg-gray-800 text-white ">
        <div class="inside flex justify-between items-center">
            <span class="text">نصب نسخه وب اپلیکیشن مدیکجو</span>
            <span class="js-icon-android hidden"><svg width="20" height="24" viewBox="0 0 20 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.3222 7.62685C17.3947 7.62685 16.6444 8.39069 16.6444 9.33347V15.3828C16.6444 15.8357 16.8211 16.2702 17.1358 16.5905C17.4504 16.9108 17.8772 17.0907 18.3222 17.0907C18.7672 17.0907 19.1939 16.9108 19.5086 16.5905C19.8232 16.2702 20 15.8357 20 15.3828V9.33347C20 8.39069 19.2496 7.62685 18.3222 7.62685ZM1.67782 7.62685C0.750361 7.62685 0 8.39069 0 9.33347V15.3828C0 15.8357 0.17677 16.2702 0.491421 16.5905C0.806073 16.9108 1.23283 17.0907 1.67782 17.0907C2.1228 17.0907 2.54956 16.9108 2.86421 16.5905C3.17887 16.2702 3.35563 15.8357 3.35563 15.3828V9.33347C3.35581 9.10919 3.31252 8.88708 3.22824 8.67986C3.14397 8.47264 3.02037 8.28437 2.86452 8.12584C2.70867 7.96732 2.52363 7.84164 2.32 7.75602C2.11636 7.67039 1.89814 7.6265 1.67782 7.62685ZM13.3386 2.54037L14.3461 0.686859C14.3755 0.63409 14.3944 0.57589 14.4015 0.515641C14.4087 0.455391 14.404 0.394293 14.3878 0.335896C14.3715 0.2775 14.3441 0.22297 14.307 0.175475C14.2698 0.127979 14.2238 0.0884651 14.1716 0.0592288C14.1195 0.0293266 14.0621 0.0102637 14.0027 0.00314833C13.9433 -0.00396707 13.8831 0.00100685 13.8256 0.0177811C13.7681 0.0345553 13.7145 0.0627954 13.6678 0.100859C13.6211 0.138923 13.5823 0.186052 13.5537 0.239506L12.5187 2.13575C11.7473 1.82194 10.8973 1.64433 10 1.64433C9.10272 1.64433 8.25266 1.8206 7.48131 2.13442L6.44628 0.240841C6.41766 0.187387 6.37888 0.140259 6.33221 0.102195C6.28553 0.0641306 6.23189 0.0358909 6.1744 0.0191167C6.11691 0.00234246 6.05672 -0.00263146 5.99732 0.00448394C5.93792 0.0115993 5.88051 0.0306619 5.82841 0.0605641C5.77643 0.0900627 5.73066 0.129711 5.69375 0.177238C5.65683 0.224765 5.62949 0.279238 5.61328 0.337537C5.59707 0.395837 5.59232 0.456818 5.5993 0.516989C5.60628 0.57716 5.62485 0.635339 5.65394 0.688195L6.66142 2.54171C4.84717 3.59399 3.63505 5.47555 3.63505 7.62685C3.63505 7.64154 3.63505 7.65489 3.63768 7.67225C3.63505 7.68027 3.63505 7.68961 3.63505 7.69763V7.69896H16.3636V7.62685C16.3649 5.47555 15.1528 3.59533 13.3386 2.54037ZM7.06153 5.16841C7.00183 5.16797 6.94281 5.15557 6.88783 5.13191C6.83284 5.10825 6.78298 5.0738 6.74107 5.03052C6.65644 4.94312 6.60939 4.82508 6.61026 4.70236C6.61113 4.57964 6.65985 4.4623 6.74571 4.37615C6.83157 4.29 6.94753 4.2421 7.06808 4.24299C7.18864 4.24387 7.30391 4.29347 7.38854 4.38087C7.47316 4.46827 7.52022 4.58632 7.51935 4.70904C7.51848 4.83176 7.46976 4.9491 7.3839 5.03525C7.29804 5.12139 7.18208 5.16929 7.06153 5.16841ZM12.9385 5.16841C12.8241 5.15955 12.7171 5.10702 12.6391 5.02135C12.5611 4.93568 12.5178 4.82318 12.5178 4.70637C12.5178 4.58956 12.5611 4.47706 12.6391 4.39138C12.7171 4.30571 12.8241 4.25318 12.9385 4.24432C13.0589 4.24432 13.1743 4.293 13.2594 4.37965C13.3445 4.4663 13.3924 4.58382 13.3924 4.70637C13.3924 4.82891 13.3445 4.94643 13.2594 5.03308C13.1743 5.11973 13.0589 5.16841 12.9385 5.16841ZM3.63505 17.522C3.63505 18.3847 4.32376 19.0858 5.17513 19.0858H5.94385V22.292C5.94385 22.745 6.12062 23.1794 6.43528 23.4998C6.74993 23.8201 7.17669 24 7.62167 24C8.06666 24 8.49342 23.8201 8.80807 23.4998C9.12272 23.1794 9.29949 22.745 9.29949 22.292V19.0858H10.6979V22.292C10.6979 23.2362 11.4482 23.9987 12.3731 23.9987C13.3032 23.9987 14.0535 23.2362 14.0535 22.292V19.0858H14.8222C15.6723 19.0858 16.3623 18.386 16.3623 17.522V8.0515H3.63505V17.522Z"
                        fill="white" />
                </svg>
            </span>
            <span class="js-icon-ios hidden">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21.4286 0H2.57143C1.152 0 0 1.152 0 2.57143V21.4286C0 22.848 1.152 24 2.57143 24H21.4286C22.848 24 24 22.848 24 21.4286V2.57143C24 1.152 22.848 0 21.4286 0ZM6.804 18.8837C6.66192 19.1295 6.42804 19.3087 6.15381 19.382C5.87957 19.4553 5.58746 19.4167 5.34171 19.2746C5.09597 19.1325 4.91674 18.8986 4.84344 18.6244C4.77014 18.3501 4.80878 18.058 4.95086 17.8123L5.71714 16.4889C6.57943 16.2266 7.28657 16.4297 7.83857 17.0991L6.804 18.8837ZM14.2449 15.9969H4.5C3.91029 15.9969 3.42857 15.5143 3.42857 14.9254C3.42857 14.3366 3.91114 13.854 4.5 13.854H7.23257L10.7357 7.78971L9.63771 5.89371C9.4964 5.6478 9.45819 5.35594 9.53143 5.08193C9.60467 4.80792 9.78341 4.57404 10.0286 4.43143C10.2745 4.29012 10.5664 4.2519 10.8404 4.32514C11.1144 4.39838 11.3482 4.57712 11.4909 4.82229L11.9674 5.64686L12.444 4.82229C12.5144 4.70061 12.608 4.59398 12.7195 4.50848C12.8311 4.42299 12.9584 4.3603 13.0942 4.32401C13.23 4.28771 13.3716 4.27852 13.5109 4.29695C13.6503 4.31538 13.7846 4.36108 13.9063 4.43143C14.028 4.50178 14.1346 4.59541 14.2201 4.70697C14.3056 4.81853 14.3683 4.94584 14.4046 5.08162C14.4409 5.21741 14.4501 5.35901 14.4316 5.49835C14.4132 5.63769 14.3675 5.77204 14.2971 5.89371L9.70114 13.8549H13.0277C14.1094 13.8549 14.7154 15.1243 14.244 15.9977L14.2449 15.9969ZM19.5 15.9969H17.946L18.996 17.8131C19.2909 18.3274 19.1134 18.9814 18.6051 19.2754C18.0909 19.5703 17.4369 19.3929 17.1429 18.8846C15.3806 15.8366 14.0623 13.5437 13.1786 12.0223C12.2837 10.4683 12.9214 8.91514 13.5591 8.39057C14.2611 9.60686 15.3111 11.4283 16.7143 13.8549H19.5C19.7842 13.8549 20.0567 13.9677 20.2576 14.1687C20.4585 14.3696 20.5714 14.6421 20.5714 14.9263C20.5714 15.2104 20.4585 15.483 20.2576 15.6839C20.0567 15.8848 19.7842 15.9977 19.5 15.9977V15.9969Z"
                        fill="white" />
                </svg>
            </span>
            <span class="js-icon-windows hidden">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 3.30553L9.34375 2.01466V11.0702H0V3.30553ZM10.493 1.86803L23 0V10.9228H10.493V1.86803ZM0 12.0772H9.34375V21.1327L0 19.8368V12.0772ZM10.493 12.0772H23V23L10.6397 21.2743L10.493 12.0772Z"
                        fill="white" />
                </svg>

            </span>
        </div>
    </div>


    <section class="login w-full z-40">
        <div class="top h-1/2 flex w-full justify-center items-center">'
            <div class="inside text-center text-white">
                <img src="{{ asset('img/login_logo.png') }}" class="mx-auto  transform scale-75 -mb-20 mt-6 block">
                <div class="text-3xl font-bold">مدیکـــجو</div>
                <div class="text-lg mt-1 pb-8">عمده فروشی ابزار دندانپزشکی</div>
            </div>
        </div>
        <div class="bottom h-2/5  bg-white px-6 rounded-t-3xl pt-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="title text-3xl font-bold">خوش آمدید</div>
                <div class="title text-sm mt-1">ورود به اکانت مدیکجو</div>
                <div class="s mt-5">
                    <div class=" relative">
                        <div class="icon absolute top-2 right-1 fill-gray-500 stroke-gray-500 bottom-0 my-auto ">
                            <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.5" clip-path="url(#clip0_59_6)">
                                    <path
                                        d="M18.2664 1.55203H9.70643C8.28816 1.55203 7.13843 2.70177 7.13843 4.12003V24.664C7.13843 26.0823 8.28816 27.232 9.70643 27.232H18.2664C19.6847 27.232 20.8344 26.0823 20.8344 24.664V4.12003C20.8344 2.70177 19.6847 1.55203 18.2664 1.55203Z"
                                        stroke="black" stroke-width="1.712" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M9.70654 1.55203H10.9905C11.1041 1.55203 11.2129 1.59713 11.2932 1.67739C11.3735 1.75766 11.4185 1.86652 11.4185 1.98003C11.4185 2.20706 11.5087 2.42478 11.6693 2.58532C11.8298 2.74585 12.0475 2.83603 12.2745 2.83603H15.6985C15.9256 2.83603 16.1433 2.74585 16.3038 2.58532C16.4644 2.42478 16.5545 2.20706 16.5545 1.98003C16.5545 1.86652 16.5996 1.75766 16.6799 1.67739C16.7602 1.59713 16.869 1.55203 16.9825 1.55203H18.2665"
                                        stroke="black" stroke-width="1.712" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_59_6">
                                        <rect width="27.392" height="27.392" fill="white"
                                            transform="translate(0.290527 0.696045)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <input type="text" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus
                            class=" py-3 pr-9 w-full rounded bg-gray-200 text-gray-600 placeholder-gray-500 pr-4"
                            placeholder="شماره همراه">
                    </div>
                    <div class=" mt-2 relative">
                        <div class="icon  absolute top-2.5 right-2 fill-2ray-500 stroke-gray-500 bottom-0 my-auto ">
                            <svg width="19" height="27" viewBox="0 0 19 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.7498 10.9527V5.90581C13.7498 4.77864 13.302 3.69763 12.505 2.9006C11.7079 2.10357 10.6269 1.65581 9.49976 1.65581C8.37259 1.65581 7.29158 2.10357 6.49455 2.9006C5.69752 3.69763 5.24976 4.77864 5.24976 5.90581V10.9527"
                                    stroke="#7F7F7F" stroke-width="1.95824" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M15.45 10.9527H3.55C2.14167 10.9527 1 12.0943 1 13.5027V22.8527C1 24.261 2.14167 25.4027 3.55 25.4027H15.45C16.8583 25.4027 18 24.261 18 22.8527V13.5027C18 12.0943 16.8583 10.9527 15.45 10.9527Z"
                                    stroke="#7F7F7F" stroke-width="1.95824" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <input type="password" name="password" autocomplete="current-password"
                            class=" py-3 pr-9 w-full rounded bg-gray-200 text-gray-600 placeholder-gray-500 pr-4"
                            placeholder="رمز عبور">
                        <a href="{{ route('forget_index') }}"
                            class="forget left-4 text-sm text-purple-800 absolute top-4">فراموش کردید؟</a>
                    </div>
                    <div class="remember flex mt-1 items-center">
                        <div class="">
                            <input type="checkbox" class="mt-2 mr-1" name="remember" id="">
                        </div>
                        <label for="remember" class="text mr-2 text-sm">
                            به خاطر سپاری
                        </label>

                    </div>

                    <button type="submit" class="button rounded w-full py-2 mt-4 text-center text-white text-lg font-bold">
                        ورود به پنل
                    </button>
                    <a href="{{ route('register') }}" class="signup block mt-2 pb-2">
                        <div class="text-center">
                            اکانت مدیکجو ندارید؟
                            <span class="js-signup-show text-purple-800">ثبت نام کنید</span>
                        </div>
                    </a>
                </div>
            </form>
            <button onclick="showNotification('hello')" class="btn hidden  ">Notify me!</button>
        </div>
    </section>


@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.5/mobile-detect.min.js"></script>

    <script>
        var md = new MobileDetect(window.navigator.userAgent);
        switch (md.os()) {
            case 'iOS':
                $('.js-icon-ios').show()
                $('.js-web-app-sec').slideDown('fast');
                break;
            case 'Android':
                $('.js-icon-android').show()

                break;
            case null:
                $('.js-icon-windows').show()
                break;
            default:
                $('.js-icon-android').show()
                break;
        }

        $('.js-web-app-sec').on('click', function() {
            runa2hs();
        })
    </script>
@endsection
