    <style>
        header.menu-header {
            background-color: #330055;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 1000'%3E%3Cg %3E%3Ccircle fill='%23330055' cx='50' cy='0' r='50'/%3E%3Cg fill='%2339005e' %3E%3Ccircle cx='0' cy='50' r='50'/%3E%3Ccircle cx='100' cy='50' r='50'/%3E%3C/g%3E%3Ccircle fill='%23400066' cx='50' cy='100' r='50'/%3E%3Cg fill='%2347006f' %3E%3Ccircle cx='0' cy='150' r='50'/%3E%3Ccircle cx='100' cy='150' r='50'/%3E%3C/g%3E%3Ccircle fill='%234e0077' cx='50' cy='200' r='50'/%3E%3Cg fill='%23550080' %3E%3Ccircle cx='0' cy='250' r='50'/%3E%3Ccircle cx='100' cy='250' r='50'/%3E%3C/g%3E%3Ccircle fill='%235c0088' cx='50' cy='300' r='50'/%3E%3Cg fill='%23640091' %3E%3Ccircle cx='0' cy='350' r='50'/%3E%3Ccircle cx='100' cy='350' r='50'/%3E%3C/g%3E%3Ccircle fill='%236c0099' cx='50' cy='400' r='50'/%3E%3Cg fill='%237400a2' %3E%3Ccircle cx='0' cy='450' r='50'/%3E%3Ccircle cx='100' cy='450' r='50'/%3E%3C/g%3E%3Ccircle fill='%237d00aa' cx='50' cy='500' r='50'/%3E%3Cg fill='%238500b3' %3E%3Ccircle cx='0' cy='550' r='50'/%3E%3Ccircle cx='100' cy='550' r='50'/%3E%3C/g%3E%3Ccircle fill='%238e00bb' cx='50' cy='600' r='50'/%3E%3Cg fill='%239700c4' %3E%3Ccircle cx='0' cy='650' r='50'/%3E%3Ccircle cx='100' cy='650' r='50'/%3E%3C/g%3E%3Ccircle fill='%23a000cc' cx='50' cy='700' r='50'/%3E%3Cg fill='%23aa00d4' %3E%3Ccircle cx='0' cy='750' r='50'/%3E%3Ccircle cx='100' cy='750' r='50'/%3E%3C/g%3E%3Ccircle fill='%23b400dd' cx='50' cy='800' r='50'/%3E%3Cg fill='%23be00e6' %3E%3Ccircle cx='0' cy='850' r='50'/%3E%3Ccircle cx='100' cy='850' r='50'/%3E%3C/g%3E%3Ccircle fill='%23c800ee' cx='50' cy='900' r='50'/%3E%3Cg fill='%23d200f7' %3E%3Ccircle cx='0' cy='950' r='50'/%3E%3Ccircle cx='100' cy='950' r='50'/%3E%3C/g%3E%3Ccircle fill='%23D0F' cx='50' cy='1000' r='50'/%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: contain;
        }

    </style>
    {{-- side-menu --}}
    <section class="js-side-menu hidden fixed bg-gray-50 h-screen w-screen z-50 top-0 right-0">
        @include('layouts.client.header-close')
        <header class="menu-header h-36">
            <div class="profile mx-auto">
                <div class="flex pt-16  w-full justify-center gap-4 items-center">
                    <div class="image rounded-full">
                        <img class="rounded-full w-32 h-32" src="{{ asset('images/profile-placeholder.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="name text-center text-lg mt-2 font-bold">کد کاربری : {{ auth()->user()->id }} </div>
        </header>
        <div class="inner mt-20 mx-4 px-4 h-3/4  rounded-xl py-4 mt-6">
            <div class="links">
                <a href="{{ route('client_user_edit') }}"
                    class=" flex py-8 border-b border-gray-200 gap-3 items-center">
                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="19.023" height="19.023"
                            viewBox="0 0 19.023 19.023">
                            <path id="Icon_awesome-info-circle" data-name="Icon awesome-info-circle"
                                d="M10.074.563a9.512,9.512,0,1,0,9.512,9.512A9.513,9.513,0,0,0,10.074.563Zm0,4.219A1.611,1.611,0,1,1,8.463,6.392,1.611,1.611,0,0,1,10.074,4.781Zm2.148,9.742a.46.46,0,0,1-.46.46H8.387a.46.46,0,0,1-.46-.46V13.6a.46.46,0,0,1,.46-.46h.46V10.688h-.46a.46.46,0,0,1-.46-.46v-.92a.46.46,0,0,1,.46-.46h2.455a.46.46,0,0,1,.46.46v3.835h.46a.46.46,0,0,1,.46.46Z"
                                transform="translate(-0.563 -0.563)" fill="#4419b9" />
                        </svg>
                    </div>
                    <div class="text text-right">اطلاعات کاربری</div>
                </a>
                <a href="{{ route('client_setting_address_index') }}"
                    class=" flex py-8 border-b border-gray-200 gap-3 items-center">
                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="13.667" height="19.525"
                            viewBox="0 0 13.667 19.525">
                            <path id="Icon_material-add-location" data-name="Icon material-add-location"
                                d="M14.334,3A6.841,6.841,0,0,0,7.5,9.834c0,5.125,6.834,12.691,6.834,12.691s6.834-7.566,6.834-12.691A6.841,6.841,0,0,0,14.334,3Zm3.9,7.81H15.31v2.929H13.357V10.81H10.429V8.857h2.929V5.929H15.31V8.857h2.929Z"
                                transform="translate(-7.5 -3)" fill="#4419b9" />
                        </svg>
                    </div>
                    <div class="text text-right">آدرس ها</div>
                </a>
                <a href="{{ route('ticket_index') }}" class=" flex py-8 border-b border-gray-200 gap-3 items-center">
                    <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="13"
                            viewBox="0 0 17 13">
                            <path id="Path_64" data-name="Path 64"
                                d="M14.875,0H2.125a2.157,2.157,0,0,0-1.5.606A2.043,2.043,0,0,0,0,2.068v8.864a2.043,2.043,0,0,0,.623,1.462,2.157,2.157,0,0,0,1.5.606h12.75a2.157,2.157,0,0,0,1.5-.606A2.043,2.043,0,0,0,17,10.932V2.068A2.043,2.043,0,0,0,16.377.606,2.157,2.157,0,0,0,14.875,0Zm-.538,3.421L8.873,7.557a.62.62,0,0,1-.745,0L2.663,3.421A.6.6,0,0,1,2.5,3.247a.579.579,0,0,1,.045-.66.6.6,0,0,1,.181-.152.62.62,0,0,1,.678.053L8.5,6.342l5.092-3.854a.619.619,0,0,1,.446-.114.611.611,0,0,1,.4.223.58.58,0,0,1,.124.432A.587.587,0,0,1,14.337,3.421Z"
                                fill="#4419b9" />
                        </svg>
                    </div>
                    <div class="text text-right">درخواست های اعتباری</div>
                </a>
                <form action="{{ route('logout') }}" method="post">
                    <button type="submit" class=" flex py-8 border-b border-gray-200 gap-3 items-center">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.023" height="19.33"
                                viewBox="0 0 19.023 19.33">
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
    </section>
    <script>
        $(document).on('click', '.js-menu-btn', function() {
            $('.js-side-menu').fadeIn('fast');
        })
        $(document).on('click', '.js-menu-btn-close', function() {
            $('.js-side-menu').fadeOut('fast');
        })
    </script>
