@extends('layouts.client.app')
@section('content')
    <div class="px-4">
        @include('layouts.global-msg')
        @include('layouts.global-error')
    </div>
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
                            <div class="pr-2"> {{ $main_ticket->amount }} <span> تومان </span></div>
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
            @if (!empty($sub_tickets[0]))
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
                                    <span>{{ App\User::where('id', $sub_ticket->user_id)->first()->UserAttr()->first()->job == 'client'? 'شما': 'اپراتور' }}</span>
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
            @endif
        </div>
    </div>


    {{-- create answer --}}

    <div class="flex h-100 items-center">
        <div class="block p-6 rounded-lg bg-white w-full pt-10">
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
@endsection
@section('script')
@endsection
