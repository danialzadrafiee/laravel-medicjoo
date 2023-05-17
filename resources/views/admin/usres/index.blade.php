@extends('layouts.admin.app')

@section('content')

    @include('layouts.global-error')
    <link rel="stylesheet" href="{{ asset('src/datatables.min.css') }}">

    {{-- update --}}
    <div id="user_update" class="modal text-right js-modal-edit">
        <p class="text-right"> تغییر اطلاعات کاربر</p>
        <form action="{{ route('admin_user_update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" class="js-input-user-id">
            <div class="inputs">
                <div class="relative text-right ">
                    <label for="">نام :</label>
                    <input name="name" type="text" class="js-input-user-name py-2 mt-1 px-4 block w-full  border rounded"
                        value="">
                </div>
                <div class="relative mt-4 text-right ">
                    <label for="">تماس :</label>
                    <input name='phone' type="text" class="js-input-user-phone py-2 mt-1 px-4 block w-full  border rounded"
                        value="">
                </div>

                <div class="relative mt-4 text-right ">
                    <label for="">سمت کاربری :</label>
                    <select name='job' type="text" class="js-select-user-job py-2 mt-1 px-4 block w-full  border rounded"
                        value="">
                        <option value="client">مشتری</option>
                        <option value="vendor">فروشنده</option>
                        <option value="admin">اپراتور</option>
                    </select>
                </div>

            </div>
            <div class="buttons flex justify-center mt-4">
                <button type="submit"
                    class="py-2  px-2 bg-green-500 text-white text-center  w-28 block     rounded-r cursor-pointer">ثبت
                </button>
                <a href="#" rel="modal:close"
                    class="py-2  px-2 bg-gray-800 text-white text-center  w-28 block     rounded-l cursor-pointer">لغو</a>
            </div>
        </form>
    </div>
    {{-- create --}}
    <a href="#user_store" rel="modal:open" class="js-create-new"></a>
    <div id="user_store" class="modal text-right js-modal-edit">
        <p class="text-right font-bold text-lg py-2"> افزودن کاربر جدید</p>
        <form action="{{ route('admin_user_store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" class="">
            <div class="inputs">
                <div class="relative text-right ">
                    <label for="">نام :</label>
                    <input name="name" type="text" class=" py-2 mt-1 px-4 block w-full  border rounded" value="">
                </div>
                <div class="relative mt-4 text-right ">
                    <label for="">تماس :</label>
                    <input name='phone' type="text" class=" py-2 mt-1 px-4 block w-full  border rounded" value="">
                </div>

                <div class="relative mt-4 text-right ">
                    <label for="">رمز عبور</label>
                    <input name='password' placeholder="********" type="password"
                        class=" py-2 mt-1 px-4 block w-full  border rounded" value="">
                </div>


                <div class="relative mt-4 text-right ">
                    <label for="">سمت کاربری :</label>
                    <select name='job' type="text" class=" py-2 mt-1 px-4 block w-full  border rounded" value="">
                        <option value="client">مشتری</option>
                        <option value="vendor">فروشنده</option>
                        <option value="admin">اپراتور</option>
                    </select>
                </div>

            </div>
            <div class="buttons flex justify-center mt-4">
                <button type="submit"
                    class="py-2  px-2 bg-green-500 text-white text-center  w-28 block     rounded-r cursor-pointer">ثبت
                </button>
                <a href="#" rel="modal:close"
                    class="py-2  px-2 bg-gray-800 text-white text-center  w-28 block     rounded-l cursor-pointer">لغو</a>
            </div>
        </form>
    </div>


    <div id="password" class="modal text-right js-modal-edit">
        <p class="text-right"> تغییر اطلاعات کاربر</p>
        <form action="{{ route('admin_user_update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" class="js-input-user-id">
            <div class="inputs">
                <div class="relative text-right ">
                    <label for="">رمز عبور :</label>
                    <input name="password" type="password"
                        class="js-input-user-password py-2 mt-1 px-4 block w-full  border rounded" placeholder="********">
                </div>
                <div class="relative mt-4 text-right ">
                    <label for="">تکرار رمزعبور :</label>
                    <input name='password_confirmation' type="password"
                        class="js-input-user-password-confrimation py-2 mt-1 px-4 block w-full  border rounded"
                        placeholder="********">
                </div>
            </div>
            <div class="buttons flex justify-center mt-4">
                <button type="submit"
                    class="py-2  px-2 bg-green-500 text-white text-center  w-28 block     rounded-r cursor-pointer">ثبت
                </button>
                <a href="#" rel="modal:close"
                    class="py-2  px-2 bg-gray-800 text-white text-center  w-28 block     rounded-l cursor-pointer">لغو</a>
            </div>
        </form>
    </div>


    <table class="table text-sm text-center" id="table">
        <thead>
            <th>#</th>
            <th>نام</th>
            <th>تماس</th>
            <th>رمز عبور </th>
            <th>آدرس ها </th>
            <th> سمت اکانت</th>
            <th> عملیات</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>

                    <td>
                        <a data-user-id='{{ $user->id }}' rel="modal:open" href="#password"
                            class="js-btn-user-edit-password py-1 px-2 bg-gray-800 text-white text-center    w-28 block   mx-auto rounded cursor-pointer">ویرایش</a>
                    </td>
                    <td>
                        <a href="#"
                            class="py-1 px-2 bg-gray-800 text-white text-center    w-28 block   mx-auto rounded cursor-pointer">مشاهده</a>

                    </td>
                    <td>

                        @switch($user->UserAttr->job)
                            @case('client')
                                مشتری
                            @break

                            @case('vendor')
                                فروشنده
                            @break

                            @case('admin')
                                اپراتور
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>
                        <div class="flex gap-2">

                            <a data-user='{"id":"{{ $user->id }}","name":"{{ $user->name }}","phone":"{{ $user->phone }}","job":"{{ $user->UserAttr->job }}"}'
                                rel="modal:open" href="#user_update" class="js-btn-user-edit btn btn-xs rounded">ویرایش</a>

                            @switch($user->UserAttr->approved)
                                @case('0')
                                    <a href="{{ route('user_approve_status', ['id' => $user->id, 'status' => '1']) }}"
                                        class="btn btn-xs rounded w-20 btn-error">غیر فعال است</a>
                                @break

                                @case('1')
                                    <a href="{{ route('user_approve_status', ['id' => $user->id, 'status' => '0']) }}"
                                        class="btn btn-xs rounded w-20 btn-success">فعال است</a>
                                @break
                            @endswitch


                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>



@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "info": false,
                "order": [
                    [1, "desc"]
                ],
                "dom": "Bftp",
                buttons: [{
                    text: 'افزودن کاربر جدید',
                    className: 'bg-purple-800 cursor-pointer w-max absolute h-maxw-48 fixed top-2 left-10 -mt-4 text-white text-center rounded py-2 px-4',
                    action: function(e, dt, node, config) {
                        $('.js-create-new').click()
                    }
                }],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });

        });
    </script>
    <script>
        var user_data;
        $(document).on('click', '.js-delete-modal', function() {
            $('.js-delete-link').attr('href', $(this).attr('data-delete'))
        })
        $(document).on('click', '.js-btn-user-edit', function() {
            user_data = JSON.parse($(this).attr('data-user'));
            console.dir(user_data);
            $('.js-input-user-id').val(user_data.id)
            $('.js-input-user-name').val(user_data.name)
            $('.js-input-user-phone').val(user_data.phone)
        })
        $(document).on('click', '.js-btn-user-edit-password', function() {
            user_data_id = $(this).attr('data-user-id');
            console.dir(user_data_id);
            $('.js-input-user-id').val(user_data_id)
        })
    </script>
@endsection


@section('background', 'white')
