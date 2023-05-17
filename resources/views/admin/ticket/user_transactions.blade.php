@extends('layouts.admin.app')
@section('content')
    <table id="table" class="text-center">
        <thead>
            <th>#</th>
            <th>موجودی</th>
            <th>بدهی</th>
            <th>توضیج</th>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ number_format($transaction->id) }}</td>
                    <td>{{ number_format($transaction->change) }}</td>
                    <td>{{ number_format($transaction->debt) }}</td>
                    <td>{{ $transaction->describe ?? 'خالی' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>#</td>
                <td>
                    <span> مجموع </span>
                    {{ number_format($transactions->sum('change') ?? '') }}
                    <span> تومان </span>
                </td>
                <td>
                    <span> مجموع </span>
                    {{ number_format($transactions->sum('debt') ?? '') }}
                    <span> تومان </span>
                </td>
                <td>
                    --
                </td>
            </tr>
        </tfoot>
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
