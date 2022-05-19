<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
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
                <form id="form_edit" class="form" action="" method="POST">
                 <!--begin::Heading-->
                    @csrf
                    <div class="mb-13 text-left">
                        <!--begin::Title-->
                        <h1 class="mb-3">Editar Usuario</h1>
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
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">Imagen</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">                            
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('assets/media/avatars/blank.png') }})">
                                <!--begin::Preview existing avatar-->
                                <div id="img_user" class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('assets/media/avatars/blank.png') }})"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" id="user_image_edit" name="user_image_edit" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" id="avatar_remove" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                {{-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span> --}}
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Formatos permitidos: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Nombre:</label>
                        <!--end::Label-->
                        
                        <input type="text" id="name_user_edit" name="name_user_edit" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Nombre completo"/>                         
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Correo electrónico:</label>
                        <!--end::Label-->
                        <input autocomplete="off" id="email_user_edit" type="email" name="email_user_edit" class="form-control form-control-lg form-control-solid" placeholder="correo@ejemplo.com" />                       
                    </div>
                    <!--end::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                            <span class="required">Nueva contraseña:</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Utilice una contraseña segura"></i>
                        </label>
                        <!--end::Label-->
                        <input autocomplete="off" id="password_user_edit" name="password_user_edit" type="password" class="form-control form-control-lg form-control-solid" placeholder="Contraseña" />            
                    </div>
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                            <span class="required">Roles</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Asigne correctamente el rol"></i>
                        </label>
                        <!--end::Label-->
                        <select id="roles_user_edit" name="roles_user_edit" class='form-select form-select-solid form-select-lg fw-bold' data-hide-search="true" aria-label="Selecciona un Rol" data-control="select2" data-placeholder= "Selecciona una opción">
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
                            <input name="active" id="active_user_edit" class="form-check-input" type="checkbox" value="1" checked="checked" />
                            <span class="form-check-label fw-bold text-muted">Activo</span>
                        </label>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="btn_cls_users_edit" data-bs-dismiss="modal" class="btn btn-light me-3">Cerrar</button>
                        <button type="button" id="btn_modal_users_edit" class="btn btn-primary">
                            <span class="indicator-label">Guardar</span>
                            <span class="indicator-progress">Por favor espere...
                            <span class="spinner-border spinner-border-sm align-center ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                    <input type="hidden" id="id_user_edit">
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