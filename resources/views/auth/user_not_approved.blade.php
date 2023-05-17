@extends('layouts.auth.app')
@section('content')
    @if (auth()->user()->UserAttr()->first()->approved == 1)
        <script>
            window.location = "{{ route('start') }}";
        </script>
    @endif

    <body>
        <div class="flex h-screen w-screen items-center p-8 justify-center">
            <form action="{{ route('logout') }}" class="absolute bottom-20" method="post">
                @csrf
                <button type="submit" class="btn btn-gray px-8">
                    خروج
                </button>

            </form>


            <div class="inner w-full text-center">
                <img src="{{ asset('svg/approvation.svg') }}">
                <h1 class="mt-4 font-bold">اطلاعات شما درحال بررسی است</h1>
                <h1 class="">بعد از فعال سازی اکانت با شما تماس میگیریم</h1>
                <div>

                </div>

            </div>
        </div>
    </body>

    </html>
@endsection
