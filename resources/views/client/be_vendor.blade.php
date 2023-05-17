@extends('layouts.client.app')
@section('content')
    <div class="px-4 py-4">
        @include('layouts.global-error')
        @include('layouts.global-msg')
        <div class="rounded bg-white shadow mt-2 px-4 relative py-2">
            <div class="top py-2 text-white absolute right-0 top-0 px-4 w-full bg-purple-800 rounded-t">درخواست ثبت اکانت
                فروشنده</div>
            <div class="w-full my-10 block"></div>
            <form action="{{ route('client_be_vendor_store') }}">
                <div class="grid grid-cols-2">
                    {{--  --}}
                    <div class="col-span-1 py-2">
                        <span>نام</span>
                    </div>
                    <div class="col-span-1 py-2">
                        <input type="text" class="input input-sm w-full" name="name" placeholder="نام">
                    </div>
                    {{--  --}}
                    <div class="col-span-1 py-2">
                        <span>نام خانوادگی</span>
                    </div>
                    <div class="col-span-1 py-2">
                        <input type="text" class="input input-sm w-full" name="lastname" placeholder="نام خانوادگی">
                    </div>
                    {{--  --}}

                    <div class="col-span-2">
                        <div class="divider">رمز عبور جدید</div>
                    </div>
                    {{--  --}}
                    <div class="col-span-1 py-2">
                        <span>رمز عبور </span>
                    </div>
                    <div class="col-span-1 py-2">
                        <input type="password" class="input input-sm w-full" name="password" placeholder="********">
                    </div>
                    {{--  --}}

                    <div class="col-span-1 py-2">
                        <span>رمز عبور تکرار</span>
                    </div>
                    <div class="col-span-1 py-2">
                        <input type="password" class="input input-sm w-full" name="password_confirmation"
                            placeholder="********">
                    </div>
                    <div class="col-span-2">
                        <div class="bg-yellow-300 rounded text-center py-2 mb-3"> رمز عبور فعلی شما به این مقدار تغییر می کند</div>
                    </div>
                    {{--  --}}
                    <div class="col-span-2 py-2">
                        <span>توضیح (غیر اجباری)</span>
                    </div>
                    <div class="col-span-2 pt-1">
                        <textarea class="textarea textarea-bordered w-full" name="describe" placeholder="متن پیام"></textarea>
                    </div>
                    {{--  --}}
                    <div class="col-span-2 py-2">
                        @if (App\BeVendor::where('user_id', auth()->user()->id)->exists())
                        <button type="submit" disabled class="btn disable btn-disabled btn-block"> درخواست شما قبلا ثبت شده </button>
                        @else
                        <button type="submit" class="btn btn-block bg-purple-800 "> ثبت و ارسال</button>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
