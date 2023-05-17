@extends('layouts.vendor.app')
@section('content')
    <style>
        .ui-tabs .ui-tabs-panel {
            padding: 0 !important;
        }

        .ui-tabs .ui-tabs-nav li {
            float: right !important;
        }

        .ui-widget input,
        .ui-widget select,
        .ui-widget textarea,
        .ui-widget button {
            font-family: inherit !important;
            font-size: inherit !important;
        }

    </style>
    <div class="mt-10">

        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">فروش</a></li>
                <li><a href="#tabs-2">تسویه</a></li>
            </ul>
            <div id="tabs-1">
                <form action="{{ route('vendor_accounting') }}">
                    <div class="flex mt-6 mb-2 px-2 items-center justify-between">
                        <div class="right flex items-center">
                            <div class="js-from">
                                <input value="{{ auth()->user()->created_at }}"
                                    class="js-from-calendar input rounded w-28 text-center text-xs input-bordered input-xs" />
                                <input type="hidden" name="from" class="js-from-data">
                            </div>
                            <div class="text-xs px-2">تا</div>
                            <div class="js-to">
                                <input
                                    class="js-to-calendar input rounded w-28 text-center text-xs input-bordered input-xs" />
                                <input type="hidden" name="to" class="js-to-data">

                            </div>
                        </div>
                        <div class="left">
                            <button type="submit" class="btn btn-xs rounded  text-xs bg-gray-800 font-light px-4"
                                style="font-size: 12px!important">انتخاب</button>
                        </div>
                    </div>
                </form>
                <table class="text-center text-xs bg-white rounded">
                    <thead class=" ">
                        <th>کد</th>
                        <th>کالا</th>
                        {{-- <th>تعداد</th> --}}
                        <th>زمان</th>
                        <th>قیمت</th>
                    </thead>
                    <tbody class="">
                        @foreach ($success_offers as $offer)
                            <tr>
                                <td>
                                    <span>{{ $offer->id }}</span>
                                </td>
                                <td>
                                    <span>{{ $offer->name }}</span>
                                </td>
                                {{-- <td>
                                <span>{{ $offer->count }} {{ $offer->unit }}</span>
                            </td> --}}
                                <td>
                                    <span>{{ verta($offer->updated_at)->format('H:i Y/n/j') }}</span>
                                </td>
                                <td>
                                    <span>{{ number_format($offer->price) }} تومان</span>
                                </td>
                            </tr>
                        @endforeach
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-left font-bold"> جمع : </td>
                            <td>{{ number_format($success_offers->sum('price')) }} تومان</td>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
            <div id="tabs-2">
                <table class="text-center text-xs">
                    <thead>
                        <th>کد</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                        <th>ضمیمه</th>
                    </thead>
                    @foreach (auth()->user()->withdraw as $withdraw)
                        <tr>
                            <td>{{ $withdraw->id }}</td>
                            <td>{{ $withdraw->amount }}</td>
                            <td>{{ verta($withdraw->updated_at)->format('H:i Y/n/j') }}</td>
                            <td>{{ $withdraw->descirbe ?? 'خالی' }}</td>

                        </tr>
                    @endforeach
                    <tbody>

            </div>

        </div>


    </div>
@endsection
@section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>

    <script>
        $(document).ready(function() {
            $('table').DataTable({
                "info": false,
                "order": [
                    [1, "desc"]
                ],
                "dom": "tp",
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });

        });
    </script>
    <script>
        $(function() {
            $("#tabs").tabs({
                active: 0,
            });
        });
        var from = $('.js-from-calendar').persianDatepicker({
            format: 'L',
            altField: '.js-from-data'
        });
        var to = $('.js-to-calendar').persianDatepicker({
            format: 'L',
            altField: '.js-to-data'
        });
    </script>
@endsection
