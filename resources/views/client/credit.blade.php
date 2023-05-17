@extends('layouts.client.app')
@section('content')
    <div class="p4">
        @include('layouts.global-error')
        @include('layouts.global-msg')
    </div>

    <div id="deptmodal" class="modal relative w-72">
        <p class="text-center font-bold text">مبلغ وارد شده از موجودی شما کثر میشود و مقدار بدهی به همان میزان کاهش میابد</p>
        <div class="grid grid-cols-2 mx-auto gap-2 mt-2">
            {{-- <div class="col-span-1">
                <div class="btn rounded py-1 px-2 w-full bg-purple-800 text-white text-center">
                    پرداخت آنلاین
                </div>
            </div> --}}
            <div class="col-span-2">
                <form action="{{ route('client_credit_pay_debt') }}">
                    {{-- ye fild readonly mablagho bege behesh --}}
                    <input type="hidden" name="value" class="js-value js-paydebt">
                    <button type="submit" class="btn rounded py-1 px-2 w-full bg-gray-800 text-white text-center">
                        پرداخت از موجودی
                    </button>
                </form>
            </div>
        </div>
    </div>
    <section class="bg-white pt-8">
        <div class="img">
            <img src="{{ asset('img/credit.png') }}" class="w-32 mx-auto block" alt="">
        </div>
        <div class="text-center py-2 px-4 ">
            <div
                class="tab   mx-auto rounded-b-none  rounded bg-purple-800 text-white border-b-2 font-extrabold  mt-4 border-purple-800 px-3 w-max ">
                کیف پول مدیکجو
            </div>
            <div class="line w-full border-t border-gray-300 "></div>
            <div class="title text-xl hidden  ">
                اعتبار کیف پول شما :
            </div>
            <table class="table text-center w-full">

                <tr>
                    <td>
                        <div class="ml-1">میزان بدهی </div>
                    </td>
                    <td>
                        <div class="number inline-block"> {{ number_format($credit->sum('debt')) ?? '' }} </div>
                        <span class="unit mr-1">تومان</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class=" ml-1">موجودی کیف پول </div>
                    </td>
                    <td>
                        <div class="number inline-block"> {{ number_format($credit->sum('change')) ?? '' }} </div>
                        <span class="unit mr-1">تومان</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="add px-4">
            <div class="grid gap-y-2 grid-cols-6">
                <div data-value="500000"
                    class="js-fix-price col-span-2 border border-gray-400 cursor-pointer text-center text-sm py-2 rounded ">
                    500,000 تومان</div>
                <div data-value="1000000"
                    class="js-fix-price col-span-2 border border-gray-400 cursor-pointer text-center text-sm py-2 rounded mx-2">
                    1,000,000 تومان</div>
                <div data-value="5000000"
                    class="js-fix-price col-span-2 border border-gray-400 cursor-pointer text-center text-sm py-2 rounded ">
                    5,000،000 تومان</div>
                <div data-value="500000"
                    class="js-sum-price   col-span-1 border border-gray-400 cursor-pointer text-center text-lg py-1 rounded ">
                    +</div>
                <div class="col-span-4  text-center   mx-1 text-sm placeholder:text-gray-400">
                    <input type="text" class="js-price w-full py-2.5 rounded mx-auto text-center"
                        placeholder="مبالغ پرداخت">
                </div>
                <div data-value="500000"
                    class="js-sub-price  col-span-1 border border-gray-400 cursor-pointer text-center  text-lg py-1 rounded ">
                    -</div>
            </div>
            <div class="flex  max-w-content">
                <a href="#deptmodal" rel="modal:open"
                    class="
                    bg-green-600 cursor-pointer rounded block ml-1 w-full  py-2 text-white mt-2   text-center">
                    <span>تسویه بدهی</span>
                </a>
                <a href="{{ route('ticket_index') }}" rel=""
                    class="
                 bg-blue-400 cursor-pointer rounded block w-full mr-1  py-2 text-white mt-2   text-center">
                    <span>درخواست افزایش اعتبار</span>
                </a>
            </div>
            <form action="{{ route('client_credit_add_credit') }}" class="">
                <input type="hidden" value="0" name="value" class="js-value">
                <button type="submit"
                    class="bg-purple-800 cursor-pointer rounded block w-full  py-2 text-white mt-2   text-center">
                    افزایش موجودی
                </button>
            </form>
        </div>
    </section>
@endsection
@section('script')
    <script>
        theval = new AutoNumeric('.js-price', {
            decimalPlaces: 0,
            digitGroupSeparator: ',',
            unformatOnSubmit: true,
            currencySymbol: ' تومان ',
            defaultValueOverride: 0,
            currencySymbolPlacement: 's',
        });
        theval.rawValue = 0;

        $(document).on('click', '.js-fix-price', function() {


            theval.rawValue = parseInt($(this).attr('data-value'))
            theval.set(theval.rawValue)

        });


        $(document).on('click', '.js-sum-price', function() {
            if ($('.js-price').val().length == 0) {
                $('.js-price').val(0)
            }

            if ($('.js-price').length != 0) {
                theval.set(parseInt(theval.rawValue) + parseInt($(this).attr('data-value')))
            }

        });
        $(document).on('click', '.js-sub-price', function() {
            if ($('.js-price').val().length == 0 || theval.rawValue <= 0) {
                theval.set(0);


            } else {
                theval.set(parseInt(parseInt(theval.rawValue) - parseInt($(this).attr('data-value'))))
            }




        });
        $(document).on('change click keyup keydown load focus select keypress',
            '.js-price , .js-fix-price , .js-sum-price , .js-sub-price',
            function() {


                $('.js-value').val(theval.rawValue)

                console.log($('.js-value').val())
            });
    </script>
@endsection
