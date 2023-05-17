@extends('layouts.client.app')@section('content')
<div class="px-4">
    @include('layouts.global-msg')
    @include('layouts.global-error')
</div>
    <div class="flex h-100 items-center">
        <div class="block p-6 rounded-lg bg-white w-full pt-10">
            <form action="{{ route('ticket_store') }}">
                <title class="text-lg font-bold pb-2 block">درخواست افزایش سقف بدهی</title>
                <div class="form-group mb-6">
                    <label class="mb-1 block ">مبلغ درخواست</label>
                    <input name="amount" type="text"
                        class="form-control js-numberic block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="مبلغ به تومان">
                </div>
                <div class="form-group mb-6">
                    <label class="mb-1 block">توضیحات (غیر ضروری)</label>

                    <textarea class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                        name="message" rows="3" placeholder="متن پیام"></textarea>
                </div>
                <button type="submit"
                    class=" w-full px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">ثبت
                    و ارسال</button>
            </form>
        </div>
    </div>
@endsection
