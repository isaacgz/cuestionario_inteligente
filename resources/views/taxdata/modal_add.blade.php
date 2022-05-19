<div class="modal fade" id="kt_modal_new_td" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header flex-stack">
                <h2>Agregar Datos Fiscales</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                {{-- Step 1 --}}
                <div data-kt-element="step-1-add">  
                    <h3 class="text-dark fw-bolder mb-7">Detalles generales</h3>                      
                        <form data-kt-element="step-1-form-add" class="form" action="#">                         
                        <div class="fv-row">
                            <div class="row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">NIT</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escribe tu NIT" id="nit_add" name="nit_add"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Razón Social:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escriba la razón social" id="business_name_add" name="business_name_add"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Correo Eletronico:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input class="form-control form-control-solid" id="email_add" name="email_add" placeholder="Escriba el correo"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Calle:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input class="form-control form-control-solid" id="street_add" name="street_add" placeholder="Escribe la Calle"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"># Ext:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escriba un nombre" id="numex_add" name="numex_add"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required"># Int:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input class="form-control form-control-solid" id="numint_add" name="numint_add" placeholder="Escriba la dirección"/>
                                </div>                                
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-100" data-kt-element="step-1-btn-next-add">Continuar</button>
                    </form>
                </div>
                {{-- Step 2 --}}
                <div class="d-none" data-kt-element="step-2-add">
                    
                    <form data-kt-element="step-2-form-add" class="form" action="#">
                        <div class="fv-row">
                            <div class="row">                                   
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Departamento:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escriba un número de zona" id="depa_add" name="depa_add" maxlength="256"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Municipio:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escriba un número de lote" id="muni_add" name="muni_add" maxlength="256"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Colonia:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escriba un número de manzana" id="colo_add" name="colo_add" maxlength="256"/>
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">Código Postal:</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Campo obligatorio"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Escriba una superficie" id="cp_add" name="cp_add" maxlength="256"/>
                                </div>
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span class="required">Tipo de documento</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Campo Obligatorio"></i>
                                    </label>
                                    <select id="id_doctype_add" name="id_doctype_add" class='form-select form-select-solid form-select-lg fw-bold' data-hide-search="true" aria-label="Selecciona un Rol" data-control="select2" data-placeholder= "Selecciona una opción">
                                            <option selected value="">Selecciona una opción</option>
                                        @foreach ($doctype as $td)
                                            <option value="{{ $td->id }}">{{ $td->name }}</option>
                                        @endforeach                                        
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Número de documento:</label>
                                    <input id="numdoc_add" name="numdoc_add" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Número de documento"/>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-center">                                
                            <button type="reset" data-kt-element="step-2-cancel-add" class="btn btn-light me-3">Regresar</button>
                            <button type="button" data-kt-element="step-2-submit-add" class="btn btn-primary">
                                <span class="indicator-label">Guardar</span>
                                <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
