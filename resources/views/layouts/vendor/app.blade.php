@include('layouts.global-header')

<body>
    <main class="relative">
        @include('layouts.vendor.header')
        @yield('content')
    </main>
    @include('layouts.global-footer')
    @include('layouts.vendor.pusher')
    <script>
        $('.js-menu-vendor-btn').on('click', function() {
            $('.js-menu-vendor').fadeIn('fast')
        });
        $('.js-menu-vendor-btn-close').on('click', function() {
            $('.js-menu-vendor').fadeOut('fast')
        });
    </script>
    @yield('script')
</body>

</html>
