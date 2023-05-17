@extends('layouts.client.app')
@section('content')
    <div class="px-4 py-2 mt-2  flex justify-between items-center">
        <title class="block font-bold">درخواست ها</title>
        <a href="{{ route('ticket_create') }}" class="btn btn-primary btn-sm">درخواست جدید</a>
    </div>
    <div class="tickets px-4 mt-2">


        @foreach ($tickets as $ticket)
            <div class="item pb-4 bg-white shadow rounded my-2">
                @switch($ticket->status)
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
                                <div class="pr-2"> {{ number_format($ticket->amount ?? 0) }} <span> تومان
                                    </span></div>
                            </div>
                            <div>
                                <a href="{{ route('ticket_show', ['id' => $ticket->id]) }}"
                                    class="pt-0.5 mt-2 bg-gray-800 text-white flex justify-between items-center px-2 pl-1 rounded ">
                                    <div>مشاهده</div>
                                    <div class="flex items-center justify-center px-1">
                                        <ion-icon name="eye"></ion-icon>
                                    </div>
                                </a>
                            </div>
                        </div>


                    </div>
                    <div class="left px-4 flex items-center mt-2">

                        <td class="py-1 px-4"> توضیحات :</td>
                        <td class="py-1 px-4"> {{ $ticket->message ?? 'بدون توضیح' }} </td>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
