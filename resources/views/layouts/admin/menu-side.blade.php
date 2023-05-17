{{-- this is vendor layout  --}}
<style>
    header.menu-header {
        background-color: #330055;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 1000'%3E%3Cg %3E%3Ccircle fill='%23330055' cx='50' cy='0' r='50'/%3E%3Cg fill='%2339005e' %3E%3Ccircle cx='0' cy='50' r='50'/%3E%3Ccircle cx='100' cy='50' r='50'/%3E%3C/g%3E%3Ccircle fill='%23400066' cx='50' cy='100' r='50'/%3E%3Cg fill='%2347006f' %3E%3Ccircle cx='0' cy='150' r='50'/%3E%3Ccircle cx='100' cy='150' r='50'/%3E%3C/g%3E%3Ccircle fill='%234e0077' cx='50' cy='200' r='50'/%3E%3Cg fill='%23550080' %3E%3Ccircle cx='0' cy='250' r='50'/%3E%3Ccircle cx='100' cy='250' r='50'/%3E%3C/g%3E%3Ccircle fill='%235c0088' cx='50' cy='300' r='50'/%3E%3Cg fill='%23640091' %3E%3Ccircle cx='0' cy='350' r='50'/%3E%3Ccircle cx='100' cy='350' r='50'/%3E%3C/g%3E%3Ccircle fill='%236c0099' cx='50' cy='400' r='50'/%3E%3Cg fill='%237400a2' %3E%3Ccircle cx='0' cy='450' r='50'/%3E%3Ccircle cx='100' cy='450' r='50'/%3E%3C/g%3E%3Ccircle fill='%237d00aa' cx='50' cy='500' r='50'/%3E%3Cg fill='%238500b3' %3E%3Ccircle cx='0' cy='550' r='50'/%3E%3Ccircle cx='100' cy='550' r='50'/%3E%3C/g%3E%3Ccircle fill='%238e00bb' cx='50' cy='600' r='50'/%3E%3Cg fill='%239700c4' %3E%3Ccircle cx='0' cy='650' r='50'/%3E%3Ccircle cx='100' cy='650' r='50'/%3E%3C/g%3E%3Ccircle fill='%23a000cc' cx='50' cy='700' r='50'/%3E%3Cg fill='%23aa00d4' %3E%3Ccircle cx='0' cy='750' r='50'/%3E%3Ccircle cx='100' cy='750' r='50'/%3E%3C/g%3E%3Ccircle fill='%23b400dd' cx='50' cy='800' r='50'/%3E%3Cg fill='%23be00e6' %3E%3Ccircle cx='0' cy='850' r='50'/%3E%3Ccircle cx='100' cy='850' r='50'/%3E%3C/g%3E%3Ccircle fill='%23c800ee' cx='50' cy='900' r='50'/%3E%3Cg fill='%23d200f7' %3E%3Ccircle cx='0' cy='950' r='50'/%3E%3Ccircle cx='100' cy='950' r='50'/%3E%3C/g%3E%3Ccircle fill='%23D0F' cx='50' cy='1000' r='50'/%3E%3C/g%3E%3C/svg%3E");
        background-attachment: fixed;
        background-size: contain;
    }

</style>

<div class="flex px-4 py-2 items-center justify-between">
    <a href="{{ route('vendor_index') }}" class="logo font-bold text-purple-800  text-xl">مدیکجو</a>

    <div class="js-menu-vendor-btn-close text-purple-800">
        <ion-icon name="arrow-forward-circle-outline" size="large"></ion-icon>
    </div>
</div>
<header class="menu-header h-36">
    <div class="profile mx-auto">
        <div class="flex pt-16  w-full justify-center gap-4 items-center">
            <div class="image rounded-full">
                <img class="rounded-full w-32 h-32" src="{{ asset('images/profile-placeholder.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="name text-center text-lg mt-2 font-bold">کد فروشنده : {{ auth()->user()->id }} </div>
</header>
<div class="inner mt-20 mx-4 px-4 h-3/4  rounded-xl py-4 mt-6">
    <div class="links">

        {{-- age user 2semati bood neshoon nade --}}
        @if (!App\BadAuth::where('phone', auth()->user()->phone)->exists())
        <a href="{{ route('vendor_user_edit') }}" class=" flex py-8 border-b border-gray-200 gap-3 items-center">
            <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="19.023" height="19.023"
                    viewBox="0 0 19.023 19.023">
                    <path id="Icon_awesome-info-circle" data-name="Icon awesome-info-circle"
                        d="M10.074.563a9.512,9.512,0,1,0,9.512,9.512A9.513,9.513,0,0,0,10.074.563Zm0,4.219A1.611,1.611,0,1,1,8.463,6.392,1.611,1.611,0,0,1,10.074,4.781Zm2.148,9.742a.46.46,0,0,1-.46.46H8.387a.46.46,0,0,1-.46-.46V13.6a.46.46,0,0,1,.46-.46h.46V10.688h-.46a.46.46,0,0,1-.46-.46v-.92a.46.46,0,0,1,.46-.46h2.455a.46.46,0,0,1,.46.46v3.835h.46a.46.46,0,0,1,.46.46Z"
                        transform="translate(-0.563 -0.563)" fill="#4419b9" />
                </svg>
            </div>
            <div class="text text-right">اطلاعات کاربری</div>
        </a>
        @endif

        <a href="{{ route('vendor_setting_catalog', ['name' => 'همه']) }}"
            class=" flex py-8 border-b items-center border-gray-200 gap-3 items-center">
            <div class="icon">
                <div class="icon text-purple-800">
                    <ion-icon class="w-6 h-6" name="notifications"></ion-icon>
                </div>
            </div>
            <div class="text text-right">اعلانات (ناتیفیکیشن)</div>
        </a>


        <form action="{{ route('logout') }}" method="post">
            <button type="submit" class=" flex py-8 border-b border-gray-200 gap-3 items-center">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19.023" height="19.33" viewBox="0 0 19.023 19.33">
                        <path id="Icon_awesome-power-off" data-name="Icon awesome-power-off"
                            d="M15.6,2.075a9.51,9.51,0,1,1-11.053,0,.923.923,0,0,1,1.342.3l.606,1.078a.92.92,0,0,1-.253,1.189,6.443,6.443,0,1,0,7.667,0,.915.915,0,0,1-.249-1.185l.606-1.078a.919.919,0,0,1,1.335-.3Zm-3.989,8.05V.92a.918.918,0,0,0-.92-.92H9.46a.918.918,0,0,0-.92.92v9.2a.918.918,0,0,0,.92.92h1.227A.918.918,0,0,0,11.608,10.125Z"
                            transform="translate(-0.563)" fill="#4419b9" />
                    </svg>
                </div>
                @csrf
                <span class="text text-right">خروج از حساب</span>
                </a>
        </form>
    </div>
</div>
