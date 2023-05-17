<div class="fixed-header fixed right-0 -top-1 z-40 w-screen ">
    <header class="main-header shadow-md shadow-purple-300 bg-white">
        <div class="flex px-4 pt-2 items-center justify-between">
            <a href="{{ route('client_index') }}" class="logo font-extrabold  my-3     text-purple-800 text-xl">
                <span>مدیکجو</span>
            </a>
            <div class="js-menu-btn  bg-white text-center p-2 shadow rounded-xl  flex items-center">
                <ion-icon name="person-outline" class="text-lg"></ion-icon>
            </div>
        </div>
        <section class="tabs !scale-90 w-full pt-2   transform grid grid-cols-3 justify-between">

            <div class="col-span-1">
                <a href="{{ route('client_index') }}"
                    class="flex items-center pb-2 justify-center border-b-2 {{ Route::currentRouteName() === 'client_index' ? 'border-purple-800' : 'border-white' }} w-full block">
                    <div
                        class="icon ml-2 bg-white h-8 w-8 flex justify-center items-center text-center shadow rounded-xl text-purple-800">
                        <ion-icon name="home"></ion-icon>
                    </div>
                    <div class="text text-xs transform"> خانه</div>
                </a>
            </div>
            <div class="col-span-1">

                <a href="{{ route('client_order_index_active') }}"
                    class="flex items-center pb-2 justify-center border-b-2 {{ Route::currentRouteName() === 'client_order_index_active' ? 'border-green-500' : 'border-white' }} w-full block">
                    {{-- todo bayad routaye dgeye sefaresham ezafeshan --}}
                    <div
                        class="icon ml-2 bg-white h-8 w-8 flex justify-center items-center text-center shadow rounded-xl text-green-500 ">
                        <ion-icon name="reader"></ion-icon>
                    </div>
                    <div class="text text-xs transform"> لیست سفارشات</div>
                </a>

            </div>
            <div class="col-span-1">

                <a href="{{ route('notification_index') }}"
                    class="flex items-center pb-2 justify-center border-b-2 {{ Route::currentRouteName() === 'notification_index' ? 'border-yellow-500' : 'border-white' }} w-full block">
                    {{-- todo bayad routaye dgeye sefaresham ezafeshan --}}
                    <div
                        class="icon ml-2 bg-white h-8 w-8 flex justify-center items-center text-center shadow rounded-xl text-yellow-500 ">
                        <ion-icon name="notifications"></ion-icon>
                    </div>
                    <div class="text text-xs transform">اعلانات</div>
                </a>

            </div>
        </section>
    </header>
</div>
<div class="pb-28" style="background:transparent;"></div>
