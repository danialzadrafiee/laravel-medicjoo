



<header class="main-header shadow-md shadow-purple-300 bg-white">
    <div class="flex px-4 py-2 items-center justify-between">
        @if (auth()->user())
            <a href="
    @if (auth()->user()->UserAttr()->first()->job == 'client') {{ route('client_index') }}
    @elseif (auth()->user()->UserAttr()->first()->job == 'vendor')
    {{ route('vendor_index') }} @endif
    " class="logo font-bold my-3  text-purple-800 text-xl">
                {{-- medicjoo text logo --}}
           <span>مدیکجو</span>
            </a>
        @endif
        <div class="js-menu-btn-close">           <svg xmlns="http://www.w3.org/2000/svg" width="24.743" height="23.34" viewBox="0 0 24.743 23.34">
            <path id="Icon_ionic-md-arrow-round-back" data-name="Icon ionic-md-arrow-round-back" d="M28.223,15.75H13.177l5.836-5.583a2.326,2.326,0,0,0,0-3.178,2.079,2.079,0,0,0-3.038,0L6.258,16.411a2.142,2.142,0,0,0-.633,1.575v.028a2.142,2.142,0,0,0,.633,1.575l9.71,9.422a2.079,2.079,0,0,0,3.037,0,2.326,2.326,0,0,0,0-3.178L13.17,20.25H28.216A2.2,2.2,0,0,0,30.368,18,2.178,2.178,0,0,0,28.223,15.75Z" transform="translate(-5.625 -6.33)" fill="#4419b9"/>
          </svg>
        </div>
    </div>

    <section class="tabs scale-90 hidden  pt-3  transform flex justify-center">
        <a class="flex @if (Route::currentRouteName() == 'client_index') border-b-2 border-purple-800 @endif  px-3 pb-3  -mb-1  items-center "
            href="{{ route('client_index') }}">
            <div class="icon shadow rounded-md px-1.5  py-2 h-8 flex items-center border-gray-100 border "><svg
                    xmlns="http://www.w3.org/2000/svg" width="17.27" height="12.709" viewBox="0 0 17.27 12.709">
                    <path id="Icon_awesome-home" data-name="Icon awesome-home"
                        d="M8.4,5.551,2.877,9.859v4.65a.467.467,0,0,0,.48.454l3.36-.008a.467.467,0,0,0,.477-.454V11.785a.467.467,0,0,1,.48-.454H9.592a.467.467,0,0,1,.48.454V14.5a.442.442,0,0,0,.14.322.494.494,0,0,0,.34.133l3.358.009a.467.467,0,0,0,.48-.454V9.856L8.864,5.551A.382.382,0,0,0,8.4,5.551Zm8.731,2.928L14.63,6.524V2.594a.351.351,0,0,0-.36-.34H12.591a.351.351,0,0,0-.36.34v2.06L9.547,2.564a1.5,1.5,0,0,0-1.829,0L.129,8.479a.328.328,0,0,0-.048.479l.764.88a.366.366,0,0,0,.243.123.374.374,0,0,0,.264-.076L8.4,4.387a.382.382,0,0,1,.459,0l7.052,5.5a.374.374,0,0,0,.507-.045l.764-.88a.328.328,0,0,0,.08-.25.336.336,0,0,0-.131-.23Z"
                        transform="translate(0.001 -2.254)" fill="#4419b9" />
                </svg>
            </div>
            <div class="text text-sm pr-2">خانه </div>
        </a>

        <a class="flex @if (Route::currentRouteName() == 'client_order_index_active') border-b-2 border-green-500 @endif  px-3 pb-3  -mb-1  items-center"
            href="{{ route('client_order_index_active') }}">
            <div class="icon shadow rounded-md px-1.5  py-2 h-8 flex items-center border-gray-100 border "><svg
                    class="w-" xmlns="http://www.w3.org/2000/svg" width="16.681" height="16.681"
                    viewBox="0 0 16.681 16.681">
                    <g id="newspaper" transform="translate(-32 -32)">
                        <path id="Path_19" data-name="Path 19"
                            d="M416.89,112H416a0,0,0,0,0,0,0V123.32a1.192,1.192,0,0,0,2.383,0v-9.827A1.493,1.493,0,0,0,416.89,112Z"
                            transform="translate(-369.702 -77.021)" fill="#8dc17a" />
                        <path id="Path_20" data-name="Path 20"
                            d="M45.107,46.3V33.489A1.489,1.489,0,0,0,43.617,32H33.489A1.489,1.489,0,0,0,32,33.489V46.6a2.085,2.085,0,0,0,2.085,2.085H46.851a.043.043,0,0,0,.011-.084A2.387,2.387,0,0,1,45.107,46.3ZM34.383,35.575a.6.6,0,0,1,.6-.6h2.383a.6.6,0,0,1,.6.6v2.383a.6.6,0,0,1-.6.6H34.979a.6.6,0,0,1-.6-.6ZM42.128,45.7H35a.607.607,0,0,1-.612-.567.6.6,0,0,1,.6-.624h7.132a.607.607,0,0,1,.612.567.6.6,0,0,1-.6.624Zm0-2.383H35a.607.607,0,0,1-.612-.567.6.6,0,0,1,.6-.624h7.132a.607.607,0,0,1,.612.567.6.6,0,0,1-.6.624Zm0-2.383H35a.607.607,0,0,1-.612-.567.6.6,0,0,1,.6-.624h7.132a.607.607,0,0,1,.612.567.6.6,0,0,1-.6.624Zm0-2.383H39.762a.607.607,0,0,1-.612-.567.6.6,0,0,1,.6-.624h2.366a.607.607,0,0,1,.612.567.6.6,0,0,1-.6.624Zm0-2.383H39.762a.607.607,0,0,1-.612-.567.6.6,0,0,1,.6-.624h2.366a.607.607,0,0,1,.612.567.6.6,0,0,1-.6.624Z"
                            fill="#8dc17a" />
                    </g>
                </svg>

            </div>
            <div class="text text-sm pr-2"> سفارشات فعال </div>
        </a>

    </section>
</header>
