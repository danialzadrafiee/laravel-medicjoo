@include('layouts.global-header')

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>

<body>
    <main class="relative">
        @include('layouts.admin.header')
        <div class="px-4">
            @include('layouts.global-error')
            @include('layouts.global-msg')
        </div>
        @yield('content')
    </main>
    @include('layouts.global-footer')
    @yield('script')
</body>

</html>
