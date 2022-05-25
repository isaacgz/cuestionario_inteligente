<!DOCTYPE html>
<html lang="es">
    	<!--begin::Head-->
	<head><base href="">
		<title>Factura Cruz Verde</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="Inteligencia Artificial" />
		<meta name="keywords" content="Factura1, cruz, verde, factura, cruzverde" />
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
								<img alt="Logo" src="{{asset('assets/media/logos/logo-cruz-verde.png')}}" class="h-70px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #F8D800;">Bienvenido a tu sistema de facturaci&oacute;n</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #F8D800;">Alta de factura
							<br />Visualizar mis facturas</p>
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
						<div class="w-lg-600px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_up_form">
								<!--begin::Heading-->
								<div class="mb-10 text-center">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Crear una cuenta</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-bold fs-4">¿Ya tienes cuenta?
									<a href="{{ route('login') }}" class="link-primary fw-bolder">Inicia sesi&oacute;n aqu&iacute;</a></div>
									<!--end::Link-->
								</div>
								<!--end::Heading-->
								<!--begin::Input group-->
								<div class="row fv-row mb-7">
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Nombre(s)</label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Nombre(s)" name="first-name" autocomplete="off" />
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-xl-6">
										<label class="form-label fw-bolder text-dark fs-6">Apellido(s)</label>
										<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Apellido(s)" name="last-name" autocomplete="off" />
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<label class="form-label fw-bolder text-dark fs-6">Correo</label>
									<input class="form-control form-control-lg form-control-solid" type="email" placeholder="Correo" name="email" autocomplete="off" />
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="mb-10 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6">Contraseña</label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid" type="password" placeholder="Contraseña" name="password" autocomplete="off" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
										</div>
										<!--end::Input wrapper-->
										<!--begin::Meter-->
										<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
											<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
										</div>
										<!--end::Meter-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Hint-->
									<div class="text-muted">Usa 8 o más caracteres con letras, números &amp; simbolos.</div>
									<!--end::Hint-->
								</div>
								<!--end::Input group=-->
								<!--begin::Input group-->
								<div class="fv-row mb-5">
									<label class="form-label fw-bolder text-dark fs-6">Confirma Contraseña</label>
									<input class="form-control form-control-lg form-control-solid" type="password" placeholder="Confirma Contraseña" name="confirm-password" autocomplete="off" />
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<label class="form-check form-check-custom form-check-solid form-check-inline">
										<input class="form-check-input" type="checkbox" name="toc" value="1" />
										<span class="form-check-label fw-bold text-gray-700 fs-6">Yo acepto
										<a href="#" class="ms-1 link-primary">Terminos y condiciones</a>.</span>
									</label>
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<button type="button" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
										<span class="indicator-label">Enviar</span>
										<span class="indicator-progress">Por favor espera...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
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
		<script src="{{ asset('assets/js/auth/signup.js') }}"></script>
		<script src="{{ asset('assets/js/auth/jquery.min.js')}}"></script>   
	</body>
</html>