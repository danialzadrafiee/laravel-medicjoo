@if(auth()->user()->UserAttr()->first()->job == 'client')
@include('layouts.client.app')
@endif
@if(auth()->user()->UserAttr()->first()->job == 'vendor')
@include('layouts.vendor.app')
@endif
@if(auth()->user()->UserAttr()->first()->job == 'admin')
@include('layouts.admin.app')
@endif
