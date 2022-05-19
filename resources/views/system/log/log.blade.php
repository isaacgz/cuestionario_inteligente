@extends("app")

@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Log de eventos</h1>
            <span class="h-20px border-gray-200 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('home') }}" class="text-muted text-hover-primary">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Sistema</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Log de eventos</li>
            </ul>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post_articles">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card card-custom">
                <div class="card-header py-3">
                    <div class="card-title">
                        <span class="px-2">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                    <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </span>                        
                        <h3 class="card-label">Log de eventos</h3>
                    </div>
                </div>
                <div class="card-body pt-6">
                    <form id="form">
                        <div class="row">
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 my-2 my-md-0">
                                            <label class="form-label">M&oacute;dulo:</label>
                                            <div class="d-flex align-items-center">
                                                <select id="sel_module" name="sel_module" class="form-select" data-control="select2" data-placeholder="Seleccionauna opción" data-allow-clear="true">
                                                    <option value="0" selected>Selecciona una opción</option>
                                                    <optgroup label="Autenticación">
                                                        <option value="1">Login/Logout</option>
                                                    </optgroup>
                                                    <optgroup label="Anticipos">
                                                        <option value="2">Solicitud</option>
                                                        <option value="3">Legalización</option>
                                                        <option value="4">Compensación</option>                                                        
                                                    </optgroup>
                                                    <optgroup label="Catálogos">
                                                        <option value="5">Usuarios</option>
                                                        <option value="6">Roles</option>
                                                        <option value="7">Sociedades</option>                                                        
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0">
                                            <label class="form-label">Archivo:</label>
                                            <div class="d-flex align-items-center">
                                                <select id="sel_files" name="sel_files" disabled class="form-select" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true">
                                                    <option value="" selected>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                    </form>
                   </div>
                </div>            
            </div>
            
            <div class="card-body pt-6">
                <table id="kt_datatable_log" class="table align-middle table-row-dashed fs-7 gy-3">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder text-uppercase gs-0">
                            <th>Fecha</th>
                            <th>Evento</th>
                            <th>Mensaje</th>
                            <th>ID</th>
                            <th>Usuario del evento</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold"></tbody>
                </table>
            </div>   
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> 
<script src="{{ asset('assets/js/system/log/system_log_datatable.js')}}"></script> 
<script src="{{ asset('assets/js/system/log/system_log.js')}}"></script>
@endsection