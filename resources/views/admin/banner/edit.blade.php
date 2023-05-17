@extends('layouts.admin.app')

@section('content')

    <div id="banner_add" class="modal text-right">
        <form action="{{ route('admin_banner_selected_store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <div class="grid grid-cols-4 pt-2 gap-1 mx-auto">
                <div class="col-span-4 text-sm">
                    جایگاه بنر خودرا انتخاب کنید :
                </div>
                <div class="js-banner-item relative border-2 rounded p-2 col-span-2 border-purple-800 selected">
                    <input checked="checked" type="radio" value="1"
                        class="w-full h-32 absolute h-full opacity-0 top-0 right-0 rounded-none" name="location_1">
                    <img c src="{{ asset('images/banner1.png') }}" alt="">
                </div>
                <div class="js-banner-item relative border-2 rounded p-2 col-span-2">
                    <input type="radio" value="2" class="w-full h-32 absolute h-full opacity-0 top-0 right-0 rounded-none"
                        name="location_1">
                    <img src="{{ asset('images/banner2.png') }}" alt="">
                </div>
                <div class="pt-4 col-span-1 self-center items-center text-sm">
                    ترتیب قرارگیری
                </div>
                <div class="pt-4 col-span-3"> <select name="location_2"
                        class="w-full select-bordered block select-block select">
                        <option value="1">یک</option>
                        <option value="2">دو</option>
                        <option value="3">سه</option>
                        <option value="4">چهار</option>
                    </select></div>

                <div class="col-span-4">
                    <div class="divider"></div>
                </div>

                {{--  --}}
                <div class="col-span-1 text-sm flex items-center">
                    <span>عنوان </span>
                </div>
                <div class="col-span-3 py-1 text-sm flex items-center">
                    <input type="text" class="input input-bordered input-sm w-full" name="title" placeholder=" عنوان بنر">
                </div>
                {{--  --}}

                <div class="col-span-1 text-sm flex items-center">
                    <span>لینک </span>
                </div>
                <div class="col-span-3 py-1 text-sm flex items-center">
                    <input type="text" class="input input-bordered input-sm w-full" name="link"
                        placeholder="بنر  به این لینک ریدایرکت میشود">
                </div>
                {{--  --}}
                <div class="col-span-1 text-sm flex items-center">
                    <span>تصویر بنر </span>
                </div>
                <div class="col-span-3 py-1 text-sm flex items-center">
                    <div class="relative rounded-lg border w-full h-32">
                        <img src="" class="js-image w-full opacity-0 h-32 absolute" alt="">
                        <div
                            class="left-0 right-0 top-12 w-max h-max block absolute top-0 mx-auto my-auto font-bold text-center">
                            <ion-icon class="js-icon" name="cloud-upload-outline" size="large"></ion-icon>
                        </div>
                        <input class="js-file opacity-0  w-full h-32" type="file" name="image">
                    </div>
                </div>
            </div>
            {{--  --}}
            <button type="submit" class="btn btn-primary bg-purple-800 mt-3 btn-block">ثبت و ارسال</button>
        </form>
    </div>
    <div id="banner_edit" class="modal text-right">
        <form action="{{ route('admin_banner_selected_update') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" class="js-banner-id" name="id">
            <div class="grid grid-cols-4 pt-2 gap-1 mx-auto">
                <div class="col-span-4 text-sm">
                    جایگاه بنر خودرا انتخاب کنید :
                </div>
                <div class="js-banner-item relative border-2 rounded p-2 col-span-2 border-purple-800 selected">
                    <input checked="checked" type="radio" value="1"
                        class="w-full h-32 absolute h-full opacity-0 top-0 right-0 rounded-none" name="location_1">
                    <img c src="{{ asset('images/banner1.png') }}" alt="">
                </div>
                <div class="js-banner-item relative border-2 rounded p-2 col-span-2">
                    <input type="radio" value="2" class="w-full h-32 absolute h-full opacity-0 top-0 right-0 rounded-none"
                        name="location_1">
                    <img src="{{ asset('images/banner2.png') }}" alt="">
                </div>
                <div class="pt-4 col-span-1 self-center items-center text-sm">
                    ترتیب قرارگیری
                </div>
                <div class="pt-4 col-span-3"> <select name="location_2"
                        class="w-full select-bordered block select-block select">
                        <option value="1">یک</option>
                        <option value="2">دو</option>
                        <option value="3">سه</option>
                        <option value="4">چهار</option>
                    </select></div>

                <div class="col-span-4">
                    <div class="divider"></div>
                </div>

                {{--  --}}
                <div class="col-span-1 text-sm flex items-center">
                    <span>عنوان </span>
                </div>
                <div class="col-span-3 py-1 text-sm flex items-center">
                    <input type="text" class="input js-banner-title input-bordered input-sm w-full" name="title"
                        placeholder=" عنوان بنر">
                </div>
                {{--  --}}

                <div class="col-span-1 text-sm flex items-center">
                    <span>لینک </span>
                </div>
                <div class="col-span-3 py-1 text-sm flex items-center">
                    <input type="text" class="input js-banner-link input-bordered input-sm w-full" name="link"
                        placeholder="بنر  به این لینک ریدایرکت میشود">
                </div>
                {{--  --}}
                <div class="col-span-1 text-sm flex items-center">
                    <span>تصویر بنر </span>
                </div>
                <div class="col-span-3 py-1 text-sm flex items-center">
                    <div class="relative rounded-lg border w-full h-32">
                        <img src="" class="js-image js-banner-image w-full  h-32 absolute" alt="">
                        <div
                            class="left-0 right-0 top-12 w-max h-max block absolute top-0 mx-auto my-auto font-bold text-center">
                            <ion-icon class="js-icon" name="cloud-upload-outline" size="large"></ion-icon>
                        </div>
                        <input class="js-file opacity-0  w-full h-32" type="file" name="image">
                    </div>
                </div>
            </div>
            {{--  --}}
            <button type="submit" class="btn btn-primary bg-purple-800 mt-3 btn-block">ثبت و ارسال</button>
        </form>
    </div>



    <table id="table" class="text-right">
        <thead>
            <th>#</th>
            <th>عنوان</th>
            <th>جایگاه</th>
            <th>ترتیب</th>
            <th>تصویر</th>
            <th>لینک</th>
            <th>تاریخ</th>
            <th>عملایت</th>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->location_1 }}</td>
                    <td>{{ $banner->location_2 }}</td>
                    <td>
                        <a href="{{ asset($banner->image) }}" data-fancybox>
                            <img src="{{ asset($banner->image) }}" class="w-12 h-12" alt="">
                        </a>
                    </td>
                    <td>{{ $banner->link }}</td>
                    <td>{{ $banner->updated_at }}</td>
                    <td><button banner_id="{{ $banner->id }}" banner_link="{{ $banner->link }}" banner_image="{{ $banner->image }}"
                            banner_title="{{ $banner->title }}" class="js-edit-modal btn btn-sm flex items-center">
                            <ion-icon name="create" class="pl-1"></ion-icon>
                            <span>ویرایش</span>
                        </button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {});
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
                    text: 'افزودن بنر',
                    className: 'bg-purple-800 cursor-pointer w-max absolute h-maxw-48 fixed top-2 left-10 -mt-4 text-white text-center rounded py-2 px-4',
                    action: function(e, dt, node, config) {
                        $('#banner_add').modal()
                    }
                }],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });

        });
    </script>
    <script>
        $('.js-banner-item').on('click', function() {
            $('.js-banner-item').removeClass('border-purple-800');
            $(this).addClass('border-purple-800')
        })
        $('.js-file').on('change', function() {
            console.dir($(this).prop('files')[0].name);
            $('.js-image').attr('src', URL.createObjectURL($(this).prop('files')[0]))
            $('.js-image').removeClass('opacity-0');
            $('.js-icon').addClass('opacity-0');
        })
        $('.js-edit-modal').on('click', function() {
            $('.js-banner-title').val($(this).attr('banner_title'))
            $('.js-banner-id').val($(this).attr('banner_id'))
            $('.js-banner-link').val($(this).attr('banner_link'))
            $('.js-banner-image').attr('src', "{{ asset('') }}" + $(this).attr('banner_image'))
            $('#banner_edit').modal();
        })
    </script>
@endsection
