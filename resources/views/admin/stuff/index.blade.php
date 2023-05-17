@extends('layouts.admin.app')
@section('background', 'white')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
@section('content')


    @if (session('msg'))
        <div alert-id='msg1' class="js-alert flex justify-between w-full my-4 py-2 text-sm px-4 bg-green-300 rounded">
            <div class="msg">
                {{ session('msg') }}
            </div>
            <div class="close js-close-alert text-xl cursor-pointer" alert-id="msg1"> &times; </div>
        </div>
    @endif

    @include('layouts.global-error')

    <a href="#create" rel="modal:open"
        class="hidden js-hidden-new-btn bg-purple-800 cursor-pointer w-48 fixed top-2 left-16 text-white text-center rounded py-2 px-4">
        <span>افزودن کالای جدید</span>
    </a>

    {{-- delete --}}
    <div id="delete" class="modal">
        <div class="text-center">آیا از حذف این کالا مطمئن هستید؟</div>
        <div class="flex cursor-pointer mx-auto justify-center mt-4">
            <a href="" class="js-delete-link text-white bg-green-500 rounded-r py-2 px-8">بله</a>
            <a href="" class="text-white bg-gray-800 rounded-l py-2 px-8 " rel="modal:close">خیر</a>
        </div>
    </div>
    {{-- edit --}}
    <div id="edit" class="modal">

        <form action="{{ route('admin_stuff_update') }}" class="js-edit-form" method="POST"
            enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" class="js-stuff-id">
            <img src="" id="output" name="image" class="h-56 js-stuff-image rounded block mx-auto my-2">

            <div class="flex justify-center">
                <div class="mb-3 w-96">

                </div>
            </div>


            <table class="table w-full">
                <tr>
                    <td><label>تصویر</label></td>
                    <td> <input
                            class="form-control block w-full px-3 input input-bordered py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="file" name="image" accept="image/*"
                            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                    </td>
                </tr>
                <tr>
                    <td><label>نام کالا</label></td>
                    <td> <input type="text" name="name" class="js-stuff-name input input-bordered w-full"></td>
                </tr>
                <tr>
                    <td><label>برند ها</label></td>
                    <td>
                        <textarea class="js-stuff-brand text-sm border rounded" name="" id="" cols="30" rows="10"></textarea>
                        <input type="hidden" name="brand" class="js-stuff-brand-new">
                    </td>
                </tr>
                <tr>
                    <td><label>دسته بندی</label></td>
                    <td>
                        <select name="category" class='js-stuff-category select select-bordered w-full'>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

            </table>
            <div class="flex w-full cursor-pointer mx-auto justify-center mt-4">
                <button type="submit"
                    class=" w-full text-center text-white bg-purple-800 rounded-r py-2 px-8">ذخیره</button>
                <a href="#" class="text-white bg-gray-800  text-center w-full  rounded-l py-2 px-8 "
                    rel="modal:close">لغو</a>
            </div>
        </form>


    </div>
    {{-- create --}}
    <div id="create" class="modal">

        <form action="{{ route('admin_stuff_store') }}" class="js-create-form" method="POST"
            enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id">
            <img src="https://via.placeholder.com/300" id="createImage" name="image"
                class="h-56 rounded block mx-auto my-2">
            <div class="flex justify-center">
                <div class="mb-3 w-96">
                </div>
            </div>

            <table class="table w-full">
                <tr>
                    <td><label>تصویر</label></td>
                    <td> <input
                            class="form-control block w-full px-3 input input-bordered py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="file" name="image" accept="image/*"
                            onchange="document.getElementById('createImage').src = window.URL.createObjectURL(this.files[0])">
                    </td>
                </tr>
                <tr>
                    <td><label>نام کالا</label></td>
                    <td> <input type="text" name="name" class="input input-bordered w-full"></td>
                </tr>
                <tr>
                    <td><label>برند ها</label></td>
                    <td>
                        <textarea class="js-stuff-brand-create text-sm border rounded" name="" id="" cols="30" rows="10"></textarea>
                        <input type="hidden" name="brand" class="js-stuff-brand-create-hidden">
                    </td>
                </tr>
                <tr>
                    <td><label>دسته بندی</label></td>
                    <td>
                        <select name="cat" class='select select-bordered w-full'>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

            </table>
            <div class="flex  w-full cursor-pointer mx-auto justify-center mt-4">
                <button type="submit"
                    class=" w-full text-center text-white bg-purple-800 rounded-r py-2 px-8">ذخیره</button>
                <a href="#" class="text-white bg-gray-800  text-center w-full  rounded-l py-2 px-8 "
                    rel="modal:close">لغو</a>
            </div>
        </form>


    </div>
    <table id="table" class="text-center text-sm">
        <thead>
            <th>#</th>
            <th>نام</th>
            <th>دسته بند</th>
            <th>برند</th>
            <th>تصویر</th>
            <th>عملایت</th>
        </thead>
        <tbody>
            @foreach ($stuffs as $stuff)
                <tr class="item{{ $stuff->id }} hover:bg-gray-100">
                    <td class="border-b border-gray-300">{{ $stuff->id }}</td>
                    <td class="border-b border-gray-300">{{ $stuff->name }}</td>
                    <td class="border-b border-gray-300">
                        {{ App\Category::where('id', $stuff->category_id)->first()->name ?? '-' }}
                    </td>
                    <td class="border-b border-gray-300"> {{ $stuff->brands }}</td>
                    <td class="border-b border-gray-300">
                        <a class="mx-auto  rounded text-xs h-max text-center" data-fancybox href="{{ asset($stuff->image) }}">
                            <span class="inline-block">مشاهده </span>
                            <img class="rounded mx-auto inline-block w-8 " src="{{ asset($stuff->image) }}" alt="">
                        </a>

                    </td>
                    <td class="border-b border-gray-300">
                        <a href="#edit" rel="modal:open" stuff-id="{{ $stuff->id }}" stuff-name="{{ $stuff->name }}"
                            stuff-brands="{{ $stuff->brands }}" stuff-image="{{ asset($stuff->image) }}"
                            class="js-edit-modal bg-purple-800 text-sm py-0.5 px-3 rounded-r border-black cursor-pointer text-white">ویرایش
                        </a>
                        <a href="#delete" rel="modal:open" data-id="{{ $stuff->id }}"
                            data-delete="{{ route('admin_stuff_delete', $stuff->id) }}"
                            class="js-delete-modal bg-gray-800 text-sm py-0.5 px-3 rounded-l border-black cursor-pointer text-white">حذف
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('script')
    <script src="{{ asset('src/tag/jquery.caret.min.js') }}"></script>
    <script src="{{ asset('src/tag/jquery.tag-editor.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('src/tag/jquery.tag-editor.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
        //delete
        $(document).on('click', '.js-delete-modal', function() {
            $('.js-delete-link').attr('href', $(this).attr('data-delete'))
        })
        //edit



        //edittag
        $(document).on('click', '.js-edit-modal', function() {
            $('.js-stuff-id').val($(this).attr('stuff-id'));
            $('.js-stuff-name').val($(this).attr('stuff-name'));
            $('.js-stuff-brand').tagEditor('destroy')
            $('.js-stuff-brand').tagEditor({
                initialTags: $(this).attr('stuff-brands').split(','),
                delimiter: ', ',
                placeholder: 'برندها .. ',
                onChange: function(field, editor, tags) {
                    $('.js-stuff-brand-new').val($('.js-stuff-brand').tagEditor('getTags')[0].tags);
                },
            });
            $('.js-stuff-brand-new').val($('.js-stuff-brand').tagEditor('getTags')[0].tags);

            var image = $(this).attr('stuff-image');
            var imagelink = `${image}`;
            $('.js-stuff-image').attr('src', imagelink);
        })

        //create tag

        $('.js-stuff-brand-create').tagEditor({
            initialTags: [''],
            delimiter: ', ',
            placeholder: 'برندها .. ',
            onChange: function(field, editor, tags) {
                // alert($('.js-stuff-brand-create').tagEditor('getTags')[0].tags)
                $('.js-stuff-brand-create-hidden').val($('.js-stuff-brand-create').tagEditor('getTags')[0]
                    .tags);
            },
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "info": false,
                "order": [
                    [1, "desc"]
                ],
                "dom": "Bftp",
                buttons: [{
                    text: 'افزودن کالای جدید',
                    className: 'bg-purple-800 cursor-pointer w-max absolute h-maxw-48 fixed top-2 left-10 -mt-4 text-white text-center rounded py-2 px-4',
                    action: function(e, dt, node, config) {
                        $('.js-hidden-new-btn').click()
                    }
                }],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });

        });
    </script>
@endsection
