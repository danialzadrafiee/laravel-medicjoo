@extends('layouts.smart_app')
@section('content')
<div class="px-4">
    @include('layouts.global-msg')
</div>
    <div class="px-4 py-8">
        @foreach ($notifications as $notification)
            <div class="rounded pb-4 mb-3 bg-white shadow">
                <header
                    class="flex justify-between items-center  w-full bg-purple-800 rounded-t  mb-2 text-white py-1 px-4  ">
                    <title class="font-bold block">
                        {{ $notification->tag }}
                    </title>
                    <div class="time">
                        {{ Verta($notification->created_at)->format('ساعت H:i | %d  %B ') }}
                    </div>
                </header>

                <div class="flex items-center px-4 pt-1 justify-between">
                    <div class="right">
                        <p>
                            {{ $notification->message }}
                        </p>

                    </div>
                    <div class="left">
                        <a href="{{ route('notification_hide', ['id' => $notification->id]) }}"
                            class="bg-gray-800 rounded text-white w-8 h-8 block flex justify-center items-center">
                            <ion-icon name="trash"></ion-icon>
                        </a>


                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection
