@include('layouts.global-header')
<body>
    @include('layouts.client.menu-side')
    <main class="relative">
        @include('layouts.client.header')
        @yield('content')
    </main>
    @include('layouts.global-footer')
    @include('layouts.client.pusher')
    @yield('script')
</body>

</html>
