@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

<style>
    body {
        background-image: url("{{asset('assets/media/image-resources/errors/503ServiceUnavailable.png')}}");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-position-y: 0%;
    }
</style>