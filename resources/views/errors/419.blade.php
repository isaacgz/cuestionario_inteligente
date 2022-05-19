@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

<style>
    body {
        background-image: url("{{asset('assets/media/image-resources/errors/419PageExpired.png')}}");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-position-y: 0%;
    }
</style>