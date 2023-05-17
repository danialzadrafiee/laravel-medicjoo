@extends('layouts.admin.app')
@section('content')
    <table id="table" class="text-center">
        <thead>
            <th>#</th>
            <th>کد</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>شماره همراه</th>
            <th>رمزعبور</th>
            <th>عملیات</th>
        </thead>
        <tbody>
            @foreach ($bevendors as $bevendor)
            <tr>
                    <td>
                        {{ $bevendor->id }}
                    </td>
                    <td>
                        {{ $bevendor->user_id }}
                    </td>
                    <td>
                        {{ $bevendor->name }}
                    </td>
                    <td>
                        {{ $bevendor->lastname }}
                    </td>
                    <td>
                        {{ $bevendor->phone }}
                    </td>
                    <td>
                        {{ $bevendor->password }}
                    </td>
                    <td>
                        <form action="{{ route('admin_badauth_store') }}">
                            <input type="hidden" value="{{ $bevendor->user_id }}" name="user_id">
                            <input type="hidden" value="{{ $bevendor->name }}" name="name">
                            <input type="hidden" value="{{ $bevendor->lastname }}" name="lastname">
                            <input type="hidden" value="{{ $bevendor->phone }}" name="phone">
                            <input type="hidden" value="{{ $bevendor->password }}" name="password">
                            <button type="submit" class="btn btn-sm">فعال سازی سمت</button>
                        </form>
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
