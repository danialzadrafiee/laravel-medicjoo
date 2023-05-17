@extends('layouts.client.app')
@section('content')
    <div class="px-4 my-4">
        @include('layouts.global-error')
        @include('layouts.global-msg')
        <div class="rounded shadow px-4 py-4 bg-white">
            <title class="block text-center w-full text-lg py-4 font-bold">
                سفارش بنر تبلیغاتی
            </title>
            <p class="text-sm text-center pb-8">
                برای سفارش تبلیغ در پلتفرم مدیکجو لطفا فرم زیر را تکمیل کنید.
                بعد از ارسال درخواست از طرف بخش مربوطه با شما تماس حاصل میشود
            </p>


            <form action="{{ route('banner_store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="grid grid-cols-4 pt-2 gap-1 mx-auto">
                    <div class="col-span-4 text-sm">
                        جایگاه بنر خودرا انتخاب کنید :
                    </div>
                    <div class="js-banner-item relative border-2 rounded p-2 col-span-2 border-purple-800 selected">
                        <input checked="checked" type="radio" value="1"
                            class="w-full h-32 absolute h-full opacity-0 top-0 right-0 rounded-none" name="location">
                        <img  src="{{ asset('images/banner1.png') }}" alt="">
                    </div>
                    <div class="js-banner-item relative border-2 rounded p-2 col-span-2">
                        <input type="radio" value="2"
                            class="w-full h-32 absolute h-full opacity-0 top-0 right-0 rounded-none" name="location">
                        <img src="{{ asset('images/banner2.png') }}" alt="">
                    </div>
                    <div class="col-span-4 pt-3 text-sm">
                        اطلاعات زیر را تکمیل کنید :
                    </div>
                    {{--  --}}
                    <div class="col-span-1 text-sm flex items-center">
                        <span>عنوان </span>
                    </div>
                    <div class="col-span-3 py-1 text-sm flex items-center">
                        <input type="text" class="input input-bordered input-sm w-full" name="title"
                            placeholder=" عنوان بنر">
                    </div>
                    {{--  --}}
                    <div class="col-span-1 text-sm flex items-center">
                        <span>شرح بنر</span>
                    </div>
                    <div class="col-span-3 py-1 text-sm flex items-center">
                        <input type="text" class="input input-bordered input-sm w-full" name="description"
                            placeholder="توضیح مختصر از  محتوای بنر">
                    </div>
                    {{--  --}}
                    <div class="col-span-1 text-sm flex items-center">
                        <span>لینک </span>
                    </div>
                    <div class="col-span-3 py-1 text-sm flex items-center">
                        <input type="text" class="input input-bordered input-sm w-full" name="link"
                            placeholder="بنر شما به این لینک ریدایرکت میشود">
                    </div>
                    {{--  --}}
                    <div class="col-span-1 text-sm flex items-center">
                        <span>تصویر بنر </span>
                    </div>
                    <div class="col-span-3 py-1 text-sm flex items-center">
                        <div class="relative rounded-lg border w-full h-32">
                            <img src="" class="js-image w-full opacity-0 h-32 absolute" alt="">
                            <div
                                class="left-0 right-0 top-12 w-max h-max block absolute top-0 mx-auto my-auto font-bold text-center">
                                <ion-icon class="js-icon" name="cloud-upload-outline" size="large"></ion-icon>
                            </div>
                            <input class="js-file opacity-0  w-full h-32" type="file" name="image">
                        </div>
                    </div>
                </div>
                {{--  --}}
                <button type="submit" class="btn btn-primary bg-purple-800 mt-3 btn-block">ثبت و ارسال</button>
        </div>
        </form>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $('.js-banner-item').on('click', function() {
            $('.js-banner-item').removeClass('border-purple-800');
            $(this).addClass('border-purple-800')
        })
        $('.js-file').on('change', function() {
            console.dir($(this).prop('files')[0].name);
            $('.js-image').attr('src', URL.createObjectURL($(this).prop('files')[0]))
            $('.js-image').removeClass('opacity-0');
            $('.js-icon').addClass('opacity-0');
        })
    </script>
@endsection
