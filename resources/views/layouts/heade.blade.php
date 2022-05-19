	<!--begin::Head-->
	<head><base href="">
		<title>Cuestionarios Inteligencia Artificial</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="es_LA" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="" />
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		@if(Auth::check() && Auth::user()->dark_mode==1)
		<link href="{{ asset('assets/plugins/global/plugins.dark.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.dark.bundle.css') }}" rel="stylesheet" type="text/css" />
		@else
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		@endif
		<!--end::Global Stylesheets Bundle-->
		@yield('styles')
	</head>
	<!--end::Head-->