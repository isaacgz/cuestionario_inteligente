<!--begin::Modal - Create App-->
<div class="modal fade" id="kt_modal_import_errors" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px ">
        <div class="modal-content">
            <div class="modal-header">
                
                <div >
                    <h2>Errores de importación</h2>
                    <span class="fs-6 text-gray-700">La siguiente información no puede ser procesada, verifique el error.</span>   
                </div>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="kt_dt_imp_errors" class="table align-middle table-row-dashed fs-8 gy-2 p-0" style="width:100%">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder text-uppercase gs-0 w-900px px-0">
                                <th class="min-w-150px">NOMBRE COMPLETO</th>
                                <th class="min-w-150px">CORREO</th>
                                <th class="min-w-100px"># EMPLEADO SAP</th>
                                <th class="min-w-150px">SOCIEDAD</th>
                                <th class="min-w-100px">ERROR</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="tbody_history"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="btn_cls_imp">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_desc_imp">
                    <span class="indicator-label">
                        Descartar
                    </span>
                    <span class="indicator-progress">
                        Por favor espere... 
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>