@extends('layouts.admin.app')
@section('content')
    <div class="grid grid-cols-12">
        <div class="right col-span-9">
            <div class="tickets px-4 mt-4">
                <div class="item pb-4 bg-white shadow rounded my-2">
                    @switch($main_ticket->status)
                        @case(0)
                            <div class="py-2 mb-2 flex rounded-b-none justify-between text-sm bg-yellow-400 rounded px-4">
                                <span class="font-bold"> افزایش سقف بدهی</span>
                                <span>وضعیت : درحال بررسی</span>
                            </div>
                        @break

                        @case(1)
                            <div class="py-2 mb-2 flex rounded-b-none justify-between text-sm bg-green-400 rounded px-4">
                                <span class="font-bold"> افزایش سقف بدهی</span>
                                <span>وضعیت : تایید شده</span>
                            </div>
                        @break

                        @case(-1)
                            <div class="py-2 mb-2 flex rounded-b-none justify-between text-sm bg-red-400 rounded px-4">
                                <span class="font-bold"> افزایش سقف بدهی</span>
                                <span> وضعیت : لغو شده</span>
                            </div>
                        @break
                    @endswitch
                    <div class="content">
                        <div class="flex justify-between">
                            <div class="right justify-between w-full px-4 items-center flex ">
                                <div class="  flex"> مبلغ :
                                    <div class="pr-2"> {{ number_format($main_ticket->amount ?? 0) }} <span>
                                            تومان </span></div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                        <div class="left px-4 flex items-center mt-2">
                            <td class="py-1 px-4"> توضیحات :</td>
                            <td class="py-1 px-4"> {{ $main_ticket->message ?? 'بدون توضیح' }} </td>
                        </div>
                    </div>
                    <div class="text-center block border-t border-b border-gray-300 py-2 mb-2 mt-2 text-sm">
                        گفتگو
                    </div>
                    @foreach ($sub_tickets as $sub_ticket)
                        <div class="px-4 mt-2">
                            <div class="left  bg-gray-100 rounded  items-center mt-2">
                                <div
                                    class="py-1 flex justify-between items-center rounded-t   {{ App\User::where('id', $sub_ticket->user_id)->first()->UserAttr()->first()->job == 'client'? 'bg-purple-800': 'bg-blue-500' }}     w-full text-white px-4">
                                    <div>
                                        <span>فرستنده : </span>
                                        <span>{{ App\User::where('id', $sub_ticket->user_id)->first()->UserAttr()->first()->job == 'client'? 'کابر': 'اپراتور' }}</span>
                                    </div>
                                    <div class="date">
                                        {{ Verta($sub_ticket->updated_at)->format('H:i | Y/%m/%d') }}
                                    </div>
                                </div>

                                <div class="py-2 px-4 block ">
                                    {{ $sub_ticket->message ?? 'بدون توضیح' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            {{-- create answer --}}

            <div class="flex px-4 items-center">
                <div class="block p-6 shadow rounded-lg bg-white w-full pt-10">
                    <form action="{{ route('ticket_store') }}">
                        <input type="hidden" name="parent_id" value="{{ $main_ticket->id }}">
                        <title class="text-lg font-bold  block">ارسال کامنت</title>

                        <div class="form-group mb-6">
                            <label class="mb-1 block">محتوای پیام برای این درخواست</label>

                            <textarea class=" form-control block mt-2 w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                name="message" rows="3" placeholder="متن پیام"></textarea>
                        </div>
                        <button type="submit"
                            class=" w-full px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">ثبت
                            و ارسال</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="left col-span-3">
            <form action="{{ route('ticket_update') }}">
                <input type="hidden" name="main_ticket_id" value="{{ $main_ticket->id }}">
                <div class="inside px-4 mt-4 shadow bg-white rounded">
                    <div class="box py-4 border-b ">
                        <div class="divider pb-2">وضعیت تیکت</div>
                        <div class="inputs">
                            <select name="status" class="js-select select select-bordered w-full ">
                                <option disabled selected>انتخاب وضعیت</option>
                                <option value="0">درحال بررسی</option>
                                <option value="1">تایید شده</option>
                                <option value="-1">لغو شده</option>
                            </select>
                        </div>
                        <div class="js-credit-section hidden text-sm ">
                            <div class="divider "> اعتبار</div>
                            <div class="inputs items-center justify-center rounded py-4 px-4 bg-blue-200">
                                <div class="text"> با تایید این درخواست اعتبار حساب کاربر افزایش میابد و به میزان
                                    بدهی کاربر افزوده میشود </div>

                                <div class="flex items-center mt-2 w-full">
                                    <div>مبلغ افزایش :</div>
                                    <div><input type="text" readonly class="input input-xs border px-3 mr-3 w-full "
                                            value="{{ number_format($main_ticket->amount) }} تومان "></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box py-4 border-b ">
                        <button type="submit" class="btn btn-block btn-primary">ثبت</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.js-select').on('change', function() {
            if ($(this).val() == 1 && "{{ $is_it_main }}" == 1) {
                $('.js-credit-section').show(0);
            } else {
                $('.js-credit-section').hide(0);
            }
        })
    </script>
@endsection
