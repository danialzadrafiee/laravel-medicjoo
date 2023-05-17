@extends('layouts.client.app')
@section('content')
    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">

    <style>
        .leaflet-control-zoom {
            display: none !important;
        }

        .fixed-header {
            position: absolute !important;
        }

        .js-search-box {
            transition: 400ms;
        }

        .tabs {
            display: none !important;
        }

        .pb-28 {
            padding-bottom: 3.5rem !important;
        }

    </style>
    @if (session('msg'))
        <div class="rounded px-2 py-2 bg-yellow-300">
            {{ session('msg') }}
        </div>
    @endif
    <div class="js-search-window  bg-white fixed right-0 top-0 w-screen h-screen hidden z-40">
        <div class="inside pt-20 px-4">
            <div class="title  font-bold pb-4 border-b">جستجوی منطقه</div>
            <div class="js-items">

            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="px-4 js-autohide">
            <div class="alert my-4 alert-warning shadow-lg ">
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> <span>{{ $error }}</span></li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    @endif


    <form action="{{ route('client_setting_address_store') }}" method="POST">
        <div class=" relative bg-white w-full -mt-1 h-max  ">
            <div class="px-4 z-40 absolute top-5 w-full">
                <div class="relative">
                    <input type="text" class="js-search-box bg-white py-3 rounded px-4 border top-10 w-full block"
                        placeholder="جستجوی محله">
                    <div class="icon left-8 absolute top-3 w-7">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24.043" height="24.047" viewBox="0 0 24.043 24.047">
                            <path id="Icon_awesome-search" data-name="Icon awesome-search"
                                d="M23.716,20.79l-4.682-4.682a1.126,1.126,0,0,0-.8-.329H17.47a9.764,9.764,0,1,0-1.691,1.691v.765a1.126,1.126,0,0,0,.329.8l4.682,4.682a1.122,1.122,0,0,0,1.592,0l1.329-1.329a1.132,1.132,0,0,0,0-1.6ZM9.768,15.779a6.011,6.011,0,1,1,6.011-6.011A6.008,6.008,0,0,1,9.768,15.779Z"
                                fill="#4419b9" />
                        </svg>
                    </div>
                </div>
            </div>
            <div id="map" class="w-full h-1/2 z-0 " style="height:50vh"></div>


            @csrf
            <div class="relative px-4 py-2">
                <div class="title text-lg mt-2 font-bold">ایجاد آدرس :</div>
                <p class="text-neutral"> لطفا نشانی دقیق آدرس دریافت سفارش را وارد کنید</p>

                <div class="inputs mt-5">
                    <div class=" relative">
                        <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> عنوان آدرس </label>
                        <input name="title" type="text" class=" {{ $errors->has('title') ? 'ring-2 ring-red-400' : '' }} z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                            placeholder="مثلا : خانه">
                    </div>
                </div>
                <div class="inputs -mt-2">
                    <div class=" relative">
                        <div class="address">
                            <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute">نشانی : </label>
                            <textarea name="address" class="{{ $errors->has('address') ? 'ring-2 ring-red-400' : '' }}  js-address-textarea z-10 border border-gray-300 rounded py-3 px-6 pt-6 w-full"
                                placeholder="آدرس"></textarea>

                        </div>
                    </div>
                </div>
                <div class="location">
                    <input name="location" type="hidden" value='0' class="px-2 py-2 border w-full " placeholder="loc">
                </div>

                <input type="hidden" name="location" class="js-location">
                <button type="submit" class=" btn btn-primary w-full px-4  py-4 bg-purple-800 text-white">ثبت
                    آدرس</button>

            </div>

        </div>

    </form>
@endsection
@section('script')
    <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('.js-search-box').on('change keyup', function() {
            if ($('.js-search-box').val().length >= 3) {
                $.ajax({
                    type: "GET",
                    url: "https://api.neshan.org/v1/search?term=" + "تهران," + $('.js-search-box').val() +
                        "&lat=35.699739&lng=51.338097",
                    headers: {
                        'Api-Key': 'service.xr4HpnQpIl7gRdKa0fOFy0CbUjXbqdQOS7arMiNq',
                    },
                    success: function(response) {
                        $('.js-items').empty();
                        $.each(response.items, function(i, e) {
                            $('.js-items').append(
                                `
                            <div class="item py-4 border-b" data-locX="` + response.items[i].location.x +
                                `" data-locY="` + response.items[i].location.y + `">
                            <div class="title">` + response.items[i].title + `</div>
                            <div class="describe text-sm">` + response.items[i].address + `</div>
                            </div>  `
                            )
                            if (i >= 6) {
                                return false;
                            }
                        })
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        })

        $('.js-search-box').on('click', function() {
            $('.js-search-box').css('margin-top', '-3.5rem')
            $('.js-search-window').fadeIn(200);
        })

        $(document).on('click', '.js-items .item', function() {
            $('.js-search-box').css('margin-top', '0')
            $('.js-search-window').fadeOut(200);
            console.log($(this).attr('data-locx'));
            console.log($(this).attr('data-locy'));
            map.flyTo([$(this).attr('data-locy'), $(this).attr('data-locx')], 15)
        })

        $(document).on('click', '.js-search-window ', function() {
            $('.js-search-box').css('margin-top', '0')
            $('.js-search-window').fadeOut(200);
        })

        var map = new L.Map('map', {
            key: 'web.WMHQFd9CEuEbJB8ICWaydCUAhUw524y97MJUM8m5',
            maptype: 'dreamy',
            poi: true,
            traffic: false,
            center: [35.699739, 51.338097],
            zoom: 15
        });
        var marker = {};
        map.on('click', function(e) {
            var coord = e.latlng;
            var lat = coord.lat;
            var lng = coord.lng;
            if (marker != undefined) {
                map.removeLayer(marker);
            };
            marker = L.marker(e.latlng).addTo(map);
            $('.js-location').val(lat + ',' + lng)
            $.ajax({
                type: "GET",
                url: "https://api.neshan.org/v4/reverse?lat=" + lat + "&lng=" + lng + "",
                headers: {
                    'Api-Key': 'service.xr4HpnQpIl7gRdKa0fOFy0CbUjXbqdQOS7arMiNq',
                },
                success: function(response) {
                    console.log(response);
                    $('.js-address-textarea').text(response.formatted_address)
                }
            });

        });
    </script>
    <script>

    </script>
@endsection
