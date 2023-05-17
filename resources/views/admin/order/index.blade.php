@extends('layouts.admin.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('src/datatables.min.css') }}">


    <table class="table text-sm text-center" id="table">
        <thead>
            <tr>
                <th class="bg-gray-200">#</th>
                <th class="bg-gray-200">مشتری</th>
                <th class="bg-gray-200">نام</th>
                <th class="bg-gray-200">برند سفارش</th>
                <th class="bg-gray-200">تعداد</th>
                <th class="bg-gray-200">واحد</th>
                <th class="bg-gray-100">برند پیشنهاد</th>
                <th class="bg-gray-100">قیمت</th>
                <th class="bg-gray-100">وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                @php
                    $offer = App\Offer::where('id', $order->id)->first();
                @endphp

                <tr class="item{{ $order->id }}">
                    <td>{{ $order->id }}</td>
                    <td>{{ App\User::where('id', $order->user_id)->first()->name }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->brand }}</td>
                    <td>{{ $order->count }}</td>
                    <td>{{ $order->unit }}</td>
                    <td>
                        {{ $offer->offer_brand ?? '-' }}
                    </td>
                    <td>
                        {{ $offer->price ??  '-' }}
                    </td>

                    <td>
                        @switch($order->status)
                            @case(0)
                                <span class="bg-gray-500 block w-2/3 mx-auto text-white rounded px-3 py-1">جستجوی پیشنهاد</span>
                            @break

                            @case(1)
                                <span class="bg-blue-400 block w-2/3 mx-auto text-white rounded px-3 py-1">پرداخت شده</span>
                            @break

                            @case(2)
                                <span class="bg-green-500 block w-2/3 mx-auto text-white rounded px-3 py-1">ارسال شده</span>
                            @break

                            @case(-21)
                                <span class="bg-red-300 block w-2/3 mx-auto  rounded px-3 py-1">حذف شده مشتری</span>
                            @break

                            @case(-31)
                                <span class="bg-red-300 block w-2/3 mx-auto  rounded px-3 py-1">سفارش لغو ادمین</span>
                            @break

                            @case(-32)
                                <span class="bg-red-300 block w-2/3 mx-auto  rounded px-3 py-1">پرداخت شده لغو ادمین</span>
                            @break
                        @endswitch
                    </td>




                    <td>
                        @switch($order->status)
                            @case(0)
                                <a href="{{ route('admin_order_show', $order->id) }}"
                                    class="bg-gray-800 text-sm py-0.5 px-3 rounded border-black cursor-pointer text-white">مشاهده
                                </a>
                            @break

                            @case(1)
                                <div class="flex  justify-center w-full">
                                    <a href="{{ route('client_offer_change_status', ['id' => $order->id, 'status' => 2, 'redirect' => 'admin_order_index']) }}"
                                        class="bg-green-300 text-sm py-0.5 px-3 rounded-r border-black cursor-pointer">تایید
                                        ارسال</a>
                                    <a href="{{ route('client_offer_change_status', ['id' => $order->id,'status' => -32,'redirect' => 'admin_order_index']) }}"
                                        class="bg-red-500 text-sm py-0.5 px-3 rounded-l border-black cursor-pointer text-white">لغو
                                    </a>
                                </div>
                            @break

                            @case(2)
                                <a href="{{ route('client_offer_change_status', ['id' => $order->id,'status' => -32,'redirect' => 'admin_order_index']) }}"
                                    class="bg-gray-800 text-sm py-0.5 px-3 rounded border-black cursor-pointer text-white">مشاهده
                                </a>
                            @break

                            @case(-21)
                            @case(-31)

                            @case(-32)
                                <a href="{{ route('client_offer_change_status', ['id' => $order->id,'status' => -32,'redirect' => 'admin_order_index']) }}"
                                    class="bg-gray-800 text-sm py-0.5 px-3 rounded border-black cursor-pointer text-white">مشاهده
                                </a>
                            @break
                        @endswitch

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "info": false,
                "order": [
                    [1, "desc"]
                ],
                "dom": "Bftp",
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });

        });
    </script>

@endsection


@section('background', 'white')
