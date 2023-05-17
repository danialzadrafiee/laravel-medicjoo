@extends('layouts.admin.app')
@section('content')


    @include('layouts.global-error')

    {{-- edit --}}
    <div id="edit" class="modal">



        <form action="{{ route('admin_category_update') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="title font-bold text-lg py-2 text-center"> ویرایش دسته </div>

            <img src="https://via.placeholder.com/300" id="outputup"
                class="h-56 js-category-image rounded block mx-auto my-2">

            <input
                class="form-control block w-full px-3 input input-bordered py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                type="file" name="image" accept="image/*"
                onchange="document.getElementById('outputup').src = window.URL.createObjectURL(this.files[0])">

            <input type="hidden" name='id' class="js-category-id">
            <div class="inputs w-2/3 mx-auto block text-right">
                <div class=" relative">
                    <label for="">نام دسته :</label>
                    <input name="name" type="text" class="js-category-name border rounded w-full px-4 py-2" placeholder=""
                        value="">
                </div>
                <label for="" class="mt-3"> زیرمجموعه :</label>
                <select name="parent_id" id="" class="js-category-parent-select border w-full rounded px-4 py-2">
                </select>
            </div>
            <div class="flex cursor-pointer mx-auto justify-center mt-4">
                <button type="submit" class="js-delete-link text-white bg-green-500 rounded-r py-2 px-8">بله</button>
                <a rel="modal:close" href="#" class="text-white bg-gray-800 rounded-l py-2 px-8 ">خیر</a>
            </div>
        </form>
    </div>

    <a href="#create" rel="modal:open" class="js-btn-hidden"></a>
    <div id="create" class="modal">
        <form action="{{ route('admin_category_store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="title font-bold text-lg py-2 text-center"> افزودن دسته </div>

            <img src="https://via.placeholder.com/300" id="output" class="h-56 js-category-image rounded block mx-auto my-2">

            <input
                class="form-control block w-full px-3 input input-bordered py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                type="file" name="image" accept="image/*"
                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">


            <input type="hidden" name='id' class="js-category-id">
            <div class="inputs w-2/3 mx-auto block text-right">
                <div class=" relative">
                    <label for="">نام دسته :</label>
                    <input name="name" type="text" class=" border rounded w-full px-4 py-2" placeholder="" value="">
                </div>
                <label for="" class="mt-3"> زیرمجموعه :</label>
                <select name="parent_id" id="" class="js-category-parent-select border w-full rounded px-4 py-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex cursor-pointer mx-auto justify-center mt-4">
                <button type="submit" class="js-delete-link text-white bg-green-500 rounded-r py-2 px-8">بله</button>
                <a rel="modal:close" href="#" class="text-white bg-gray-800 rounded-l py-2 px-8 ">خیر</a>
            </div>
        </form>
    </div>


    <table class=" w-full" id="table">
        <thead>
            <th>#</th>
            <th>دسته</th>
            <th>دسته ی مادر</th>
            <th>تصویر</th>
            <th>عملیات</th>
        </thead>
        <tbody>

            @php
                $categories_list = [];
            @endphp

            @foreach ($categories as $category)
                @php
                    $categories_list[$category->id] = $category->name;
                @endphp
                <tr>
                    <td class="border-b border-b-gray-300">{{ $category->id }}</td>
                    <td class="border-b border-b-gray-300">{{ $category->name }}</td>
                    <td class="border-b border-b-gray-300">
                        {{ App\Category::where('id', $category->parent_id)->first()->name }}</td>

                    <td class="border-b border-gray-300">
                        <a class="mx-auto  rounded text-xs h-max text-center" data-fancybox
                            href="{{ asset($category->image) }}">
                            <span class="inline-block">مشاهده </span>
                            <img class="rounded mx-auto inline-block w-8 " src="{{ asset($category->image) }}" alt="">
                        </a>

                    </td>
                    <td class="border-b border-b-gray-300">
                        <div
                            class='flex {{ $category->id == 1 ? 'pointer-events-none grayscale opacity-40 cursor-not-allowed filter' : '' }}  justify-center w-full'>
                            <a data-parent-id="{{ $category->parent_id }}" data-name="{{ $category->name }}"
                                data-image="{{ $category->image }}" data-id="{{ $category->id }}" href="#edit"
                                rel="modal:open"
                                class="js-edit-category-btn bg-gray-800 text-white text-sm py-1 px-3 rounded-r border-black cursor-pointer">
                                ویرایش</a>
                            <a href="{{ route('admin_category_destroy', ['id' => $category->id]) }}"
                                class="bg-red-400 text-sm py-1 px-3 rounded-l border-black cursor-pointer text-white">حذف
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! Form::hidden('categories_list', json_encode($categories_list, JSON_UNESCAPED_UNICODE), ['class' => 'js-cateogries-list']) !!}
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>


<script>
        Fancybox.bind("[data-fancybox]", {});

        $(document).on('click', '.js-delete-modal', function() {
            $('.js-delete-link').attr('href', $(this).attr('data-delete'))
        })


        $(document).on('click', '.js-edit-category-btn', function() {
            $cat_name = $(this).attr('data-name');
            $cat_id = $(this).attr('data-id');
            $cat_image = $(this).attr('data-image');
            $('.js-category-name').val($cat_name);
            $('.js-category-image').attr('src', "{{ asset('') }}" + $cat_image);
            $('.js-category-id').val($cat_id);
            $('.js-category-parent-select').empty();
            var list_obj = JSON.parse($('.js-cateogries-list').val());
            // todo yeseri if else bezar khode daste nayad
            $.each(list_obj, function(index, value) {
                if (value != $cat_name) {
                    $("<option/>", {
                        value: index,
                        text: value
                    }).appendTo($('.js-category-parent-select'));
                }
            });

        })
    </script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "info": false,
                "dom": "Bftp",
                buttons: [{
                    text: 'افزودن دسته جدید',
                    className: 'bg-purple-800 cursor-pointer w-max absolute h-maxw-48 fixed top-2 left-10 -mt-4 text-white text-center rounded py-2 px-4',
                    action: function(e, dt, node, config) {
                        $('.js-btn-hidden').click()
                    }
                }],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });
        });
    </script>
@endsection
