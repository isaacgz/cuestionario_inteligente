<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_new_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="currentColor">
                                <rect fill="currentColor" x="0" y="7" width="16" height="2" rx="1" />
                                <rect fill="currentColor" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="form_add" class="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                 <!--begin::Heading-->
                    @csrf
                    <div class="mb-13 text-left">
                        <!--begin::Title-->
                        <h1 class="mb-3">Agregar Datos Fiscales</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-bold fs-5">
                            Llene los siguientes campos 
                         </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Nombre:</label>
                        <!--end::Label-->                        
                        <input id="name_user_add" name="name_add" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nombre"/>                         
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Tipo de documento:</label>
                        <!--end::Label-->
                        <select name="" id="doc_type_add" class='form-select form-select-solid form-select-lg fw-bold' data-hide-search="true" aria-label="Selecciona un documento" data-control="select2" data-placeholder= "Selecciona una opción">
                            <option value="1">C.C</option>
                            <option value="2">C.E</option>
                            <option value="3">Pasaporte</option>                            
                        </select>
                    </div>
                    <!--end::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                            <span class="required">Contraseña</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Utilice una contraseña segura"></i>
                        </label>
                        <!--end::Label-->
                        <input id="password_user_add" name="password_user_add" type="password"  class="form-control form-control-lg form-control-solid" placeholder="Contraseña" />            
                    </div>                
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                            <span class="required">Roles</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Asigne correctamente el rol"></i>
                        </label>
                        <!--end::Label-->
                        <select id="roles_user_add" name="roles_user_add" >
                                <option selected value="">Selecciona una opción</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach                                        
                        </select>
                    </div>
                    <!--end::Input group-->
                    <!--end::Input group-->
                    <div class="d-flex flex-stack mb-7">
                        <div class="me-5">
                            <label class="fs-6 fw-bold">Estatus:</label>
                            <div class="fs-7 fw-bold text-muted">Deslice para activar y desactivar:</div>
                        </div>
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input name="active" id="active_user_add" class="form-check-input" type="checkbox" value="1" checked="checked" />
                            <span class="form-check-label fw-bold text-muted">Activo</span>
                        </label>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="btn_modal_users_cls" data-bs-dismiss="modal" class="btn btn-light me-3">Cerrar</button>
                        <button type="button" id="btn_modal_user_add" class="btn btn-primary">
                            <span class="indicator-label">Guardar</span>
                            <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-center ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->