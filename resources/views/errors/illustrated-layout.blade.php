<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('title')</title>

    </head>
    <body id="kt_body" class="error error-3 d-flex flex-row-fluid bgi-size-cover bgi-position-center">
    {{-- <body style="margin: none; border: none; padding: none;"> --}}
        <div style="">
            <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                <button class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary">
                    {{ __('Regresar') }}
                </button>
            </a>
        </div>
        
            @yield('image')
            {{--@yield('code', __('Oh no'))
            @yield('message')--}}
        
    </body>
</html>
