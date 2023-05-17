@extends('layouts.admin.app')
@section('content')
    <table id="table" class="text-right">
        <thead>
            <th>#</th>
            <th>فرستنده</th>
            <th>مبلغ</th>
            <th>توضیح</th>
            <th>نوع</th>
            <th>وضعیت</th>
            <th>ایجاد</th>
            <th>آپدیت</th>
            <th>عملیات</th>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                @if (App\User::where('id', $ticket->user_id)->first()->UserAttr()->first()->job == 'client')
                {{-- only show client tickets --}}
                    <tr>
                        <td>
                            {{ $ticket->id }}
                        </td>
                        <td>
                            {{ App\User::where('id', $ticket->user_id)->first()->name }}
                        </td>
                        <td>
                            <span>
                                {{ $ticket->parent_id == 0 ?  number_format($ticket->amount) . ' تومان' : '-' }}

                            </span>

                        </td>
                        <td>
                            {{ $ticket->msg ?? 'خالی' }}
                        </td>
                        <td>
                            {{ $ticket->parent_id == 0 ? 'درخواست' : 'کامنت' }}
                        </td>
                        <td>
                            @switch($ticket->status)
                                @case(0)
                                    <div class="badge w-32 badge-warning">
                                        حالت درخواست
                                    </div>
                                @break

                                @case(1)
                                    <div class="badge w-32 badge-success">
                                        تایید شده
                                    </div>
                                @break

                                @case(-1)
                                    <div class="badge w-32 badge-error">
                                        لغو شده
                                    </div>
                                @break
                            @endswitch
                        </td>
                        <td>
                            {{ new Verta($ticket->created_at) }}
                        </td>
                        <td>
                            {{ new Verta($ticket->updated_at) }}
                        </td>
                        <td>
                            <a href="{{ route('admin_ticket_show', ['id' => $ticket->id]) }}"
                                class="js-modal-show btn btn-xs btn-dark">
                                <span>مشاهده</span>
                                <ion-icon name="eye" class="pr-1"></ion-icon>
                            </a>
                        </td>
                    </tr>
                @endif
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
    <script>
        $(document).on('click', '.js-modal-show', function() {

        })
    </script>
@endsection
