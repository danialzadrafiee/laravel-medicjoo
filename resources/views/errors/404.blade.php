<script>  window.location = "{{ URL::previous() }}" </script>


@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

