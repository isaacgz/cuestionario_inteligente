@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

<style>
    body {
        background-image: url("{{asset('assets/media/image-resources/errors/403Forbidden.png')}}");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-position-y: 0%;
    }
</style>