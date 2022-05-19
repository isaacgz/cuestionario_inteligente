@extends('errors::illustrated-layout')

@section('title', __('Página no encontrada'))
@section('code', '404')
@section('message', __('La página no ha sido encontrada'))
   
<style>
    body {
        background-image: url("{{asset('assets/media/image-resources/errors/404NotFound.png')}}");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-position-y: 0%;
    }
</style>
