@extends("app")

@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/animate/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Facturas Clientes</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('home') }}" class="text-muted text-hover-primary">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Busca tu animal</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Reporte</li>
            </ul>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div class="container-xxl">
        <div class="card mb-0" id="kt_animal_container">
            <div class="card-header pt-0 pb-0 overflow-auto">
                <div class="card-title">
                    <span class="px-2">
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="currentColor"/>
                            <path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </span>                        
                    <h3 class="card-label">Busca tu animal</h3>
                </div>
            </div> 
           <div class="card-body">
                <div class="tab-content m-0 h-auto">
                    <div class="views animate__animated animate__fadeIn animate__faster" id="c-v-1">
                        <div class="card-body pt-6">
                            <form id="form" onsubmit="event.preventDefault();">
                                <div class="row">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="row align-items-center">
                                                <div class="col-lg-3 my-2 my-md-0 mx-0">
                                                    <label class="form-label">Fecha:
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Fecha de solicitud"></i>
                                                    </label>
                                                    <input id="date_or_rp" name="date_or_rp" class="form-control form-control-solid" readonly placeholder="Selecciona un rango de fechas"/>
                                                </div>
                                                <div class="col-md-4 my-2 my-md-0">
                                                    <label class="mr-6 mx-2 mb-0 d-md-block">NIT:</label>
                                                    <div class="d-flex align-items-center">
                                                        <input id="nit" type="text" class="form-control" placeholder="Buscar por nit"/>
                                                    </div>
                                                </div>                         
                                                <div class="col-md-3 my-0 my-md-0 mx-0">
                                                    <div class="d-flex align-items-center mt-8">                                                     
                                                        <button type="button" id="btn_search" class="btn btn-light-primary mx-1" onclick="getDataAdvances()">
                                                            <span class="svg-icon svg-icon-md" id="btn_svg">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="currentColor"/>
                                                                    <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="currentColor"/>
                                                                </svg>
                                                            </span>
                                                            Buscar
                                                        </button>
                                                    </div>    
                                                </div>                                    
                                            </div> 
                                        </div>    
                                    </div>
                                </div> 
                            </form>    
                        </div>
                        <div class="card-body pt-6">
                            <table id="kt_datatable_animals" class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder text-uppercase gs-0">
                                        <th>id</th>
                                        <th>Folio</th>
                                        <th>Fecha doc</th>                                        
                                        <th>Importe</th>
                                        <th>Estatus</th>
                                        <th>Texto</th>
                                        <th>Respuesta</th>
                                        <th class="min-w-100px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold"></tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>    
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

<script src="{{ asset('assets/js/animal/animal_report.js')}}"></script>
<script src="{{ asset('assets/js/animal/animal_report_datatable.js')}}"></script>
<script src="{{ asset('assets/js/animal/animal_validate.js')}}"></script>
<script src="{{ asset('assets/js/animal/animal_decision.js')}}"></script>
<script src="{{ asset('assets/js/animal/animal_combos.js')}}"></script>
<script src="{{ asset('assets/js/animal/animal_add.js')}}"></script>
<script src="{{ asset('assets/js/animal/animal_delete.js')}}"></script>
@endsection