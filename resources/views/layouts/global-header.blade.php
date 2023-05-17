<!doctype html>
<html data-theme="light" dir="rtl" charset="UTF-8" lang="fa">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ URL::asset('/favicon.ico') }}" type="image/x-icon" />
    @include('layouts.global-loading')

    <link rel="stylesheet" href="{{ asset('src/tailwind.min.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <title>{{ auth()->user()->name ?? '' }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.13.6/dist/full.css" rel="stylesheet" type="text/css" />
    @laravelPWA
</head>
<div id="whitescreen">
    <img src="{{ asset('img/loading.png') }}" width="160px" height="160px" >
</div>
