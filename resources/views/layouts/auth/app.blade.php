@include('layouts.global-header')
<body>
    <main class="relative">
        @yield('content')
    </main>
    @include('layouts.global-footer')
    @yield('script')
</body>
</html>
