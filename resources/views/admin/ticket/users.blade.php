@extends('layouts.admin.app')
@section('content')
    <div class="modal" class="text-right" id="change_credit">
        <form action="{{ route('admin_credit_change') }}">
            <input type="hidden" name="user_id" class="js-user_id">
            <div class="describe">
                <div class="grid bg-gray-200  py-2 rounded-lg text-center grid-cols-3">
                    <div class="col-span-1">
                        <div class="font-bold">کاربر</div>
                        <div class="js-name"></div>
                    </div>
                    <div class="col-span-1">
                        <div class="font-bold">بدهی</div>
                        <div class="js-credit"></div>
                    </div>
                    <div class="col-span-1">
                        <div class="font-bold">اعتبار</div>
                        <div class="js-debt"></div>
                    </div>
                </div>
            </div>
            <div class="divider">
                نوع عملیات
            </div>
            <div class="inputs">

                <div class="flex items-center justify-center gap-8 ">
                    <div class="flex items">
                        <span>افزایش</span>
                        <input type="radio" name="action_type" class="radio mr-2 radio-xs" checked value="sum">
                    </div>
                    <div class="flex items">
                        <span>کاهش</span>
                        <input type="radio" name="action_type" class="radio mr-2 radio-xs" value="sub">
                    </div>
                </div>
            </div>
            <div class="divider">
                مبلغ مورد نظر
            </div>
            <div class="inputs flex items-center  gap-4">
                <span>مبلغ</span>
                <input type="text" name="amount" class="js-numeric input input-sm w-full input-bordered"
                    placeholder="مبلغ به تومان">
            </div>
            <div class="divider">
                فیلد متغیر
            </div>
            <div class="inputs">
                <div class="flex gap-8 items-center justify-center">
                    <div class="flex  items-center">
                        <span class="label-text">اعتبار</span>
                        <input type="checkbox" name="variable[]" value="credit"
                            class="checkbox checkbox-xs rounded-sm mx-2 checkbox-accent">
                    </div>
                    <div class="flex items-center">
                        <span class="label-text">بدهی</span>
                        <input type="checkbox" name="variable[]" value="debt"
                            class="checkbox checkbox-xs rounded-sm mx-2 checkbox-secondary">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block bg-gray-800 btn-sm mt-3 text-white">اعمال تغییرات</button>
        </form>
    </div>

    <table id="table" class="text-right">
        <thead>
            <th>#</th>
            <th>نام</th>
            <th>شماره</th>
            <th>اعتبار</th>
            <th>بدهی</th>
            <th>عملیات</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ number_format($user->credit()->sum('change')) }}</td>
                    <td>{{ number_format($user->credit()->sum('debt')) }}</td>
                    <td>
                        <a href="{{ route('admin_user_transaction', ['user_id' => $user->id]) }}"
                            class="btn btn-xs">تراکنش ها</a>
                        <a user_id="{{ $user->id }}" user_name="{{ $user->name }}"
                            user_debt="{{ $user->credit()->sum('debt') }}"
                            user_credit="{{ $user->credit()->sum('change') }}" href="#change_credit" rel="modal:open"
                            class="js-btn-modal btn btn-xs">بدهی - اعتبار</a>
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
        $('.js-btn-modal').on('click', function() {
            $('.js-name').text($(this).attr('user_name'))
            $('.js-credit').text($(this).attr('user_credit'))
            $('.js-debt').text($(this).attr('user_debt'))
            $('.js-user_id').val($(this).attr('user_id'))


        });
    </script>
@endsection
