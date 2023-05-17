@extends('layouts.client.app')
@section('content')
    @if ($addresses->first() == null)
        <script>
            window.location = "{{ route('client_setting_address_create') }}";
        </script>
    @endif

    @if (Session::has('delete'))
        <div class="px-4 my-2">
            <div class="alert js-autohide alert-success shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ Session::get('delete') }}</span>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('msg'))
        <div class="px-4 my-2">
            <div class="alert js-autohide alert-success shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ Session::get('msg') }}</span>
                </div>
            </div>
        </div>
    @endif



    <div class="px-4 mt-4   ">
        <div class="flex justify-between mb-3 items-center">
            <title class="block font-bold ">لیست آدرس ها</title>
            <a href="{{ route('client_setting_address_create') }}" class="text-green-500">
                <div class="flex">
                    <ion-icon name="add"></ion-icon>
                    <span>افزودن آدرس جدید</span>
                </div>
            </a>
        </div>
        @foreach ($addresses as $address)
            <div
                class="border-green-500  bg-white shadow-sm border-r-4 rounded-r-none mb-3  items-center rounded py-2 px-4 flex justify-between">
                <div class="right">
                    <title class="block  font-bold  ">{{ $address->title }}</title>
                    <p class="block pl-3 ">{{ $address->address }}</p>
                </div>
                <div class="left">
                    <a href="#" class="w-8 hidden mb-1 h-8 bg-gray-800 rounded text-white flex justify-center items-center">
                        <ion-icon name="create"></ion-icon>
                    </a>
                    <a href="{{ route('client_setting_address_destroy', ['id' => $address->id]) }}"
                        class="w-8 h-8 bg-gray-800 rounded text-white flex justify-center items-center">
                        <ion-icon name="trash"></ion-icon>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
@endsection
