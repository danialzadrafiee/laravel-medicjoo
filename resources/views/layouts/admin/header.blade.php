<nav class="bg-white flex border-b border-gray-200 mb-5">
    <a class=" w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_order_index') ? 'bg-gray-200' : 'text-gray-600' }}"
        href="{{ route('admin_order_index') }}">سفارشات</a>
    <a class=" w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_stuff_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r"
        href="{{ route('admin_stuff_index', 1) }}">کالاها</a>
    <a class=" w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_category_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r"
        href="{{ route('admin_category_index') }}">دسته بندی</a>
    <a class=" w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_user_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r"
        href="{{ route('admin_user_index') }}">کاربران</a>
    {{--  --}}
    <div tabindex="0"
        class="dropdown w-32 cursor-pointer text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_banner_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r">
        <label class="cursor-pointer w-full  block">اعتبار</label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li><a href="{{ route('admin_ticket_index') }}"> تیکت ها </a></li>
            <li><a href="{{ route('admin_ticket_users') }}"> کاربران </a></li>
        </ul>
    </div>
    {{--  --}}
    <div tabindex="1"
        class="dropdown w-32 cursor-pointer text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_banner_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r">
        <label class="cursor-pointer w-full  block">بنرها</label>
        <ul tabindex="1" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li><a href="{{ route('admin_banner_index') }}">درخواست ها </a></li>
            <li><a href="{{ route('admin_banner_edit') }}"> مدیریت جایگاه </a></li>
        </ul>
    </div>
    {{--  --}}
    <a class=" w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_bevendor_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r border-l"
        href="{{ route('admin_bevendor_index') }}">کاربر دو سمتی</a>
    {{--  --}}
    <a class=" w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_withdraw_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r border-l"
        href="{{ route('admin_withdraw_index') }}">تسویه حساب</a>

    <form action="{{ route('logout') }}" method="post" class="mr-auto h-0">
        @csrf
        <button type="submit"
            class="w-32 text-center border-gray-300 py-4 px-3 {{ request()->routeIs('admin_user_index') ? 'bg-gray-200' : 'text-gray-600' }} border-r">خروج</button>
    </form>
</nav>
