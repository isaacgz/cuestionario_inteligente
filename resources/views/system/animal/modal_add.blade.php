<!--begin::Modal - Add animal-->
<div class="modal fade" id="kt_modal_new_animal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Agregar animal</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-animal-modal-action="close">
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
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-lg-5 my-7" id="kt_add_animal">
                <!--begin::Form-->
                <form id="kt_modal_add_animal_form" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_animal_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_animal_header" data-kt-scroll-wrappers="#kt_modal_add_animal_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Animal</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input id="text_add" class="form-control form-control-solid" placeholder="Ingresa tu animal" name="text_add" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <div class="d-flex flex-stack mb-7">
                            <div class="me-5">
                                <label class="fs-6 fw-bold">Estatus:</label>
                                <div class="fs-7 fw-bold text-muted">Deslice para activar y desactivar:</div>
                            </div>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input name="active" id="active_add" class="form-check-input" type="checkbox" value="1" checked="checked" />
                                <span class="form-check-label fw-bold text-muted">Activo</span>
                            </label>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" id="btn_modal_animal_cls" data-bs-dismiss="modal" class="btn btn-light me-3">Cerrar</button>
                        <button type="button" class="btn btn-primary"onclick="validate_animal_add(event)" id="btn_modal_animal_add">
                            <span class="spinner-border spinner-border-sm visually-hidden" id="spi_modal_animal_add" role="status" aria-hidden="true"></span>
                            <span class="indicator-label">Guardar</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add animal-->