@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

<style>
    body {
        background-image: url("{{asset('assets/media/image-resources/errors/429TooManuRequests.png')}}");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-position-y: 0%;
    }
</style>