const date_request_imp = document.querySelector("#date_request_imp");;
const msg_employee_imp = document.querySelector("#msg_employee_imp");
const form_imp = document.querySelector("#form_imp");
const btn_import_up = document.querySelector("#btn_import_up");
const cont_orders = $("#cont_orders");


/** Build Orders */
const buildEmployees = (employees,data_noExists) => {
    var xsf = ``;
    //Quitar pedidos anteriores    
    cont_orders.empty();
    deleteStorage();
    //Set storage
    setStorageImport('employees_imp', employees);

    if(employees.length>0){
        msg_employee_imp.classList.add('d-none');
        
            xsf = `<div class="mb-5 mt-4 pt-2">
                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1">
                        <span class="accordion-icon">
                            <span class="svg-icon svg-icon-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <h3 class="fs-5 fw-bold mb-0 ms-4">Empleados en excel</h3>
                    </div>
                    <div id="kt_accordion_1" class="fs-6 collapse show ps-10 mt-5" data-bs-parent="#kt_accordion_2">
                        <table id="tb_ord_1" class="table align-middle table-row-dashed fs-8 gy-2 p-0" >
                            <thead>
                                <tr class="text-start text-gray-400 fw-bolder text-uppercase gs-0 w-900px px-0">
                                    <th class="min-w-100px">Nombre Completo</th>
                                    <th class="min-w-50px">Correo</th>
                                    <th class="min-w-25px text-left"># Empleado SAP</th>
                                    <th class="min-w-25px text-left">Sociedad</th>                                    
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>`
            //Crear nodo de emp
            cont_orders.append(xsf);              
            let data = employees; 
            //Inicializar datatable del emp
            let datatable = `tb_ord_1`;
            init_data_import(datatable);     
            //Montar datos
            let t = $(`#${datatable}`).DataTable();
                t.rows.add(data).draw();        
              
        //Inicializar todos los tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();  
    }else{
       msg_employee_imp.classList.remove('d-none'); 
    }

 
}

/** SET Session storage */
const setStorageImport = (storage, dataArray) => {
    sessionStorage.setItem(storage, JSON.stringify(dataArray));
} 

/** GET Session storage */
const getStorageImport = (storage) =>{
    let dataStorage = JSON.parse(sessionStorage.getItem(storage));
    return dataStorage ? dataStorage : [];
}

/** Delete items storage */
const deleteStorage = () => {
    sessionStorage.removeItem('employees_imp');
}

/** Modal errores */
const modal_errors = (employees, data_noExists) => {   
    // let t = $('#kt_dt_imp_errors').DataTable();   
    
    let t = $('#kt_dt_imp_errors').DataTable();  
        t.rows().remove().draw(); 
    let cont = document.querySelector("#kt_modal_import_errors");
    let btn_desc_imp = document.querySelector("#btn_desc_imp");
    let btn_cls_imp = document.querySelector("#btn_cls_imp");

    /**Montar datos */
    let modal = new bootstrap.Modal(cont);
        modal.show();
        t.rows.add(data_noExists).draw();      
    /**Descartar y continuar */
    btn_desc_imp.addEventListener("click", function (e) {
        btn_desc_imp.setAttribute("data-kt-indicator", "on");
        btn_desc_imp.disabled = !0;
        setTimeout(function () {
            buildEmployees(employees, data_noExists);               
            modal.hide();
            btn_desc_imp.removeAttribute("data-kt-indicator");
            btn_desc_imp.disabled = !1;
        }, 1500);
    });
   
    /**Cancelar operacion */
    btn_cls_imp.addEventListener("click", function (e) {
        modal.hide();
    });
}

/** Store */
const store_imp = () =>{
    let url = global_url + "/users/storeEmployeeImport";

    let params = {        
        data_employees: getStorageImport('employees_imp'),        
        date_request : (date_request_imp.value).trim().replaceAll("/", "-") + " 00:00:00",
    };    

    fetch(url, {
        method: "POST",
        body: JSON.stringify(params),
        credentials: "same-origin",
        headers: {
            "Contet-Type": "aplication/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    }).then(function (res) {
        if(res.status === 200){
            Swal.fire({
                text: "¡Datos guardados correctamente!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "¡OK!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            clear_all_imp();
        }else if (res.status === 422){
            
            res.json().then(function(data) {    
                // console.log(data);                                            
                Swal.fire({
                    text: "No podemos procesar su solicitud, verifique que no exista un usuario con ese correo y número de SAP, además revise la sociedad.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "¡OK!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            });
        }else if (res.status === 401){
            toastr_notify('Su sesión a expirado, vuelva a inicar sesión.', 'danger');
        }
    })
    .catch(function (e) {
        toastr_notify("Error :" + e, "danger");
    });


}

/** clear all */
let clear_all_imp = () => {
    //Delete item session storage
    deleteStorage();
    //Form reset
    form_imp.reset();    
    //Init date request datepicker
    initDateRequest('date_request_imp');
    //Mostrar mensaje añadir articulos
    cont_orders.empty();
    msg_employee_imp.classList.remove('d-none');
}
//Data pickers options setup
const setDatePicker = {
    separator: " - ",
    applyLabel: "Aplicar",
    cancelLabel: "Cancelar",
    customRangeLabel: "Custom",
    daysOfWeek: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"],
    monthNames: [
        "Enero", "Febrero", "Mazo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    dayNames: ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"],
    dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
    format: "YYYY/MM/DD",
};
/**Init datepicker*/
const initDateRequest = (tb) =>{
    $(`#${tb}`).daterangepicker({
        locale: setDatePicker,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2020,
        maxYear: parseInt(moment().format("YYYY"), 10),
    });
}

/** Loades DOM */
KTUtil.onDOMContentLoaded(function () {
    initDateRequest('date_request_imp'); //datepicker import
    deleteStorage();
});



 