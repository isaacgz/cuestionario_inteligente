<!DOCTYPE html>
<html lang="es">
    	<!--begin::Head-->
	<head><base href="">
		<title>Cuestionarios Inteligencia Artificial</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />		
		<!--end::Head-->
		
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/auth/fontawesome-all.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/global/plugins.bundle.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/custom/animate/animate.min.css') }}"/>
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<body>
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #009E3F">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<!--begin::Logo-->
							<a href="#" class="py-9">
								<img alt="Logo" src="" class="h-70px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #F8D800;">Bienvenido a tu sistema de facturaci&oacute;n</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #F8D800;">Encuentra el animal que buscas							
							<!--end::Description-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" novalidate id="form_login" action="#">
								<!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Inicia Sesión</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-bold fs-4">¿Eres nuevo aquí?
										<a href="{{route('register')}}" class="link-primary fw-bolder">Crea tu cuenta</a>
									</div>
									<!--end::Link-->
									<div class="al_inf alert alert-warning alert-dismissible fade show with-icon animate__animated" role="alert">
										Por favor completa la siguiente información
									</div>
									<div class="al_error alert alert-danger alert-dismissible fade show with-icon animate__animated d-none" role="alert">
										Los datos ingresados son incorrectos.
									</div>
									<div class="al_success alert alert-success alert-dismissible fade show with-icon d-none" role="alert">
										Datos correctos.
									</div>
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" spellcheck="false" required type="email" id="email" name="email" placeholder="Correo" autocomplete="off">
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Contraseña</label>
										<!--end::Label-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" required type="password" id="password" name="password" placeholder="Contraseña" autocomplete="off">									
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->								
									<button type="button" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="login-text">Iniciar sesión</span>
										<span class="d-none spinner">Espere... <i class="ms-2 align-middle fa fa-spinner fa-spin mb-1"></i></span>
									</button>
									<!--end::Submit button-->
									
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->					
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->
        @include('layouts.javascript')
		<script src="{{ asset('assets/js/auth/login.js') }}"></script>
		<script src="{{ asset('assets/js/auth/jquery.min.js')}}"></script>		
		<script src="{{ asset('assets/js/auth/main.js')}}"></script>    
	</body>
</html>