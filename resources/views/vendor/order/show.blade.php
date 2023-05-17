@extends('layouts.vendor.app')
@section('background', '#fcfcfc')
@section('content')
    <div class="hidden fixed top-0 right-0  js-block pointer-events-none z-50 bg-purple-800 h-screen w-screen items-center justify-center">
        <h1 class="text-white font-bold">محتوای پیشنهاد شما درحال آپلود است</h1>
    </div>
    <div class="my-4 px-4">
        @include('layouts.global-error')
        @include('layouts.global-msg')
    </div>
    @php if (
        App\Offer::where('order_id', $order->id)
            ->where('vendor_id', auth()->user()->id)
            ->exists()
    ) {
        header('Location: {{ url()->previous() }}');
        die();
    }
    @endphp
    <section class="offers px-4">
        <div class="order bg-white mt-32 relative">
            <form action="{{ route('vendor_order_convert', $order->id) }}" id="js-form" class="js-form" method="POST" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="shadow-md shadow-gray-800 relative rounded ">
                    <div class="header relative w-full ">
                        <div class="image  absolute -top-20 right-0 left-0  mx-auto">
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
                            <img src="{{ asset($img) }}" class="rounded w-32 h-32 mx-auto shadow" alt="">
                            {{-- <img src="https://picsum.photos/id/13/200" class="rounded mx-auto w-32" alt=""> --}}
                        </div>
                        <div class="title pt-14 font-bold text-center">{{ $order->name }}</div>
                        {!! Form::hidden('name', $order->name) !!}
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
                                {!! Form::hidden('count', $order->count) !!}
                            </div>
                            <div class="col-span-1">
                                <label class="block text-center px-4">واحد</label>
                            </div>
                            <div class="col-span-1">
                                <label class="block text-center px-4">{{ $order->unit }}</label>
                                {!! Form::hidden('unit', $order->unit) !!}
                            </div>
                        </div>
                    </div>
                    <div class="text-center text-sm font-bold mt-2 mb-1">توضحیات</div>
                    <div class="px-8">
                        <textarea  rows="2" class="border-t pt-2  rounded  border-gray-200 text-center px-2 mx-auto w-full" readonly >{{ $order->order_describe }}</textarea>
                    </div>
                    <div class="badges">
                        <div class="flex justify-center mt-2">
                            <div class="time flex justify-center text-gray-700 bg-gray-100 rounded  py-1 mx-1 text-xs text-center w-full ">
                                <div class="icon mt-0.5 ml-1 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.526" height="9.884" viewBox="0 0 10.526 9.884">
                                        <g id="Group_21" data-name="Group 21" transform="translate(-318.6 -432.6)">
                                            <path id="Path_16" data-name="Path 16"
                                                d="M72.988,84.865a4.054,4.054,0,1,0-4.054,4.054A4.054,4.054,0,0,0,72.988,84.865Zm-6.941-4.581A1.183,1.183,0,0,0,65.284,80l-.071,0a1.255,1.255,0,0,0-1.144,1.29.969.969,0,0,0,.276.69.115.115,0,0,0,.082.045h.022a.082.082,0,0,0,.064-.033l1.54-1.512a.136.136,0,0,0,.039-.1A.133.133,0,0,0,66.047,80.284Zm5.771,0A1.183,1.183,0,0,1,72.581,80l.071,0a1.255,1.255,0,0,1,1.144,1.29.968.968,0,0,1-.276.69.115.115,0,0,1-.082.045h-.022a.082.082,0,0,1-.064-.033l-1.54-1.512a.136.136,0,0,1-.039-.1A.133.133,0,0,1,71.818,80.284Z"
                                                transform="translate(254.93 353)" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="0.8" />
                                            <path id="Path_17" data-name="Path 17" d="M100.124,160v2.838H98.1m6.081,4.054-1.013-1.013m-7.094,1.013,1.013-1.013" transform="translate(223.741 275.027)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="value ml-0.5"> {{ Verta($order->updated_at)->formatDifference() }} </div>
                            </div>
                            <div class="time flex justify-center text-gray-700 bg-gray-100 rounded  py-1 mx-1 text-xs text-center w-full ">
                                <span>{{ App\Offer::where('order_id', $order->id)->count() }} &thinsp; </span>
                                پیشنهاد
                            </div>
                            <div class="time hidden flex justify-center text-gray-700 bg-gray-100 rounded  py-1 mx-1 text-xs text-center w-full ">
                                مشاهده</div>
                        </div>
                    </div>
                    <div class="orffer  mt-5">
                        <div class="title w-max mx-auto  text-center font-bold border-b border-gray-200 pb-2 px-4">
                            ارسال پیشنهاد
                        </div>
                        <div class="rounded text-xs  p-2 w-5/6 mx-auto bg-info">
                            <ul>
                                <li> &#8226; قیمت پیشنهادی برای کل سفارش است </li>
                                <li> &#8226; 3 درصد قیمت افزوده سفارش پورسانت مدیکجو است</li>
                            </ul>
                        </div>
                        <div class="text-sm text-center leading-4 mt-4 font-bold mb-2">تاریخ انقضا</div>

                        <div class="rounded text-xs  p-2 w-5/6 mx-auto bg-yellow-400">
                            <ul>
                                <li> اگر کالای شما شامل <strong>تاریخ انقضا</strong> است حتما آن را وارد کنید</li>
                            </ul>

                            <div class="flex text-sm mt-2 justify-center items-center mb-1 js_date_div">
                                <input type="text" class="js_date py-1 w-full border border-gray-700 rounded mx-auto text-center" >
                                <input type="hidden" name="expire" class="js_expire_data">
                            </div>
                            <div class="mt-2 w-full flex items-center">
                                <input type="checkbox" class="js_hide_expire ml-1">
                                <span>کالا انقضا ندارد</span>
                            </div>
                        </div>


                        <p class="describe  text-center text-xs mt-2 pb-2 px-10 pt-2 text-gray-700 ">میتوانید قیمت موردنظر
                            خودرا برای
                            این برند را برای
                            همین برند یا برای برند دیگر ارسال کنید</p>
                        <div class="radios mt-2">
                            <div class="flex justify-center">
                                <div class="relative bg-green-500 py-1 rounded-full px-2 flex items-center">
                                    <label class="text-white text-sm pl-1">با همین برند</label>
                                    <input type="radio" name="brand" checked class="radio radio-xs" name="" id="">
                                </div>
                                <div class="relative  border  mr-4 border-green-500 py-1 rounded-full px-2 flex items-center">
                                    <label class="text-green-500 text-sm pl-1">برند دیگر</label>
                                    <input type="radio" name="brand" class="js-new-brand radio radio-xs" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="offer-brand js-offer-brand hidden ">
                            <div class="flex mt-4 justify-between items-center px-4">
                                <div class="text text-sm  ml-3">
                                    برند پیشنهادی :
                                </div>
                                <div class="input relative w-2/3 ">
                                    <label class="top-0 bg-white font-bold px-2 text-xs right-3 absolute"> برند</label>
                                    <input type="text" class="js-input-new-brand text-sm block border border-gray-300 rounded py-2 my-2 w-full pr-5" placeholder="برند پیشنهادی">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4 px-4 pl-8 justify-between">
                            <div class="text-sm w-1/2 ">تصویر (غیر اجباری)</div>
                            <div class="relative rounded-lg border w-1/2 h-32">
                                <img src="" class="js-image w-full opacity-0 h-32  rounded absolute" alt="">
                                <div class="left-0 right-0 top-12 w-max h-max block absolute top-0 mx-auto my-auto font-bold text-center">
                                    <ion-icon class="js-icon" name="cloud-upload-outline" size="large"></ion-icon>
                                </div>
                                <input id="js-file" class="js-file opacity-0 w-full h-32" type="file" name="image">

                            </div>
                        </div>
                        <div class="offer-price">
                            <div class="flex mt-4 justify-between items-center px-4">
                                <div class="text text-sm  ml-3">
                                    پیشنهاد شما:
                                </div>
                                <div class="input relative w-2/3 ">
                                    <label class=" top-0 bg-white font-bold px-2 text-xs right-3 absolute">
                                        قیمت</label>
                                    <input name="before_price" type="text" id="js-beforepirce" class="js-beforepirce  text-sm block border border-gray-300 rounded py-2 my-2 w-full pr-5" placeholder="قیمت به تومان ">
                                </div>
                            </div>
                            <div class="flex mt-4 justify-between items-center px-4">
                                <div class="text text-sm  ml-3">
                                    قیمت نهایی :
                                </div>
                                <div class="input border-none bg-white relative w-2/3 ">
                                    <input type="text" class="js-price  text-sm bg-white block  rounded py-2 my-2 w-full pr-1" placeholder="-">
                                </div>
                                <input type="hidden" name="price" class="js-final-price">
                            </div>
                        </div>
                        {{-- upload image --}}

                        <div class="submit mt-4 pb-0">
                            <button class="bg-purple-800 py-3 js-submit  rounded-t-none w-full mx-auto block  text-white text-center px-8 rounded">ارسال
                                پیشنهاد </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="js-old-brand" value="{{ $order->brand }}">
                <input type="hidden" class="js-new-brand" name="brand" value="">
            </form>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{ asset('src/compress.js') }}"></script>




    <script>
        var old_brand;
        $(window).on('load', function() {
            old_brand = $('.js-old-brand').val();
            $('.js-new-brand').val(old_brand);
        });
        $('input[type="radio"]').on('click', function() {
            if ($('.js-new-brand').prop('checked')) {
                $('.js-offer-brand ').removeClass('hidden')
            } else {
                $('.js-offer-brand ').addClass('hidden')
                $('.js-new-brand').val(old_brand);
            }
        })
        $(document).on('change click keydown keyup select', '.js-input-new-brand', function() {
            if ($('.js-new-brand').prop('checked')) {
                $('.js-new-brand').val($(this).val());
            }
        });
        var before_numeric = new AutoNumeric('.js-beforepirce', {
            decimalPlaces: 0,
            digitGroupSeparator: ',',
            unformatOnSubmit: true,
            currencySymbol: ' تومان ',
            currencySymbolPlacement: 's',
        });
        $(document).on('change click keydown keyup select', '.js-beforepirce', function() {
            after_numberic = new AutoNumeric('.js-price', {
                decimalPlaces: 0,
                digitGroupSeparator: ',',
                unformatOnSubmit: true,
                currencySymbol: ' تومان ',
                currencySymbolPlacement: 's',
            }).set(before_numeric.get() * 1.03)
            $('.js-final-price').val(after_numberic.get());
            console.log($('input[name="price"]').val());
        })
        $('.js-banner-item').on('click', function() {
            $('.js-banner-item').removeClass('border-purple-800');
            $(this).addClass('border-purple-800')
        })

        $('.js-submit').on('click', function() {
            $('.js-block').addClass('flex');
            $('.js-block').removeClass('hidden');
            $('.js-block').show(0);
            $('.js-form').submit();
        })

        //  **************
        //         var compress = new Compress()
        //         var img1
        //         var base64str
        //         var imgExt
        //         var file
        // var
        //         compress.attach('#js-file', {
        //             size: 4,
        //             quality: .75
        //         }).then((results) => {
        //             img1 = results[0]
        //             base64str = img1.data
        //             imgExt = img1.ext
        //             file = Compress.convertBase64ToFile(base64str, imgExt)

        //             console.log(file)
        //             formData = new FormData(document.getElementById('js-form'));

        //         })
        // *************

        $('.js-file').on('change', function() {
            console.dir($(this).prop('files')[0].name);
            $('.js-image').attr('src', URL.createObjectURL($(this).prop('files')[0]))
            $('.js-image').removeClass('opacity-0');
            $('.js-icon').addClass('opacity-0');
        })
    </script>

    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">

    <script type="text/javascript">
        $(document).ready(function() {
            $(".js_date").pDatepicker({
                format: 'YYYY/MM/DD',
            });
        });
    </script>

    <script>
        $('.js_hide_expire').on('click', function() {
            $('.js_date_div').slideToggle();
            $('.js_date').val(null);
        })
    </script>
@endsection
