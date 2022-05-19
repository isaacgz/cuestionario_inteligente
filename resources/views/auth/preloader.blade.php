<!DOCTYPE html>
<html lang="es">
    <head>        
    <title>Cargando...</title>
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/auth/preloader.css') }}" id="dev-css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
    </head>
    <body>         
        <div class="dev-page-loading preloader"></div>
        <meta http-equiv="refresh" content="1; url={{ route('home') }}">
    </body>
</html>