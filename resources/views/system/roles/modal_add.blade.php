<!--begin::Modal - Add role-->
<div class="modal fade" id="kt_modal_new_role" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Agregar Rol</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
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
            <div class="modal-body scroll-y mx-lg-5 my-7" id="kt_add_role">
                <!--begin::Form-->
                <form id="kt_modal_add_role_form" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Nombre del Rol</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input id="name_role_add" class="form-control form-control-solid" placeholder="Ingresa el nombre del rol" name="name" />                            
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">Permisos del rol</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-4">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-bold">                                      
                                        <!--begin::Table row-->
                                        @php
                                            $rol = "";
                                        @endphp
                                        @foreach ($permission as $item1)
                                            @php                                                            
                                                $roles1 = explode("_",$item1->name);                                                            
                                            @endphp
                                            @if ($roles1[1] != $rol)
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">{{ trim(ucfirst($roles1[1])) }}</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    @php
                                                        $ajas = $roles1[1];
                                                    @endphp
                                                    @foreach ($permission as $item)
                                                        @php
                                                            $roles2 = explode("_",$item->name); 
                                                        @endphp
                                                        @if ($ajas == $roles2[1])
                                                            <td>
                                                                <!--begin::Wrapper-->
                                                                <div class="d-flex">
                                                                    <!--begin::Checkbox-->
                                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                        <input id="{{ "permision_".$item->id}}" class="form-check-input" type="checkbox" name="permission[]" value="{{ $item->id }}" name="repository_management_create" />
                                                                        <span class="form-check-label">{{ trim(ucfirst($roles2[0])) }}</span>
                                                                    </label>
                                                                    <!--end::Checkbox-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <!--end::Options-->
                                                </tr>
                                                @php
                                                    $rol = $roles1[1];
                                                @endphp
                                            @endif
                                        @endforeach
                                        <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" id="btn_modal_roles_cls" data-bs-dismiss="modal" class="btn btn-light me-3">Cerrar</button>
                        <button type="button" class="btn btn-primary"onclick="validate_role_add(event)" id="btn_modal_role_add">
                            <span class="spinner-border spinner-border-sm visually-hidden" id="spi_modal_role_add" role="status" aria-hidden="true"></span>
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
<!--end::Modal - Add role-->