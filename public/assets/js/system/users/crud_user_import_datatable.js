/**Datatable order */
const init_data_import = (tb) =>{
    $("#" + tb).DataTable({
        language: {
            url : global_data + '/assets/plugins/custom/datatables/es.js'
        },
        responsive: true,
        searching: false,
        processing: false,
        info: false, 
        scrollY: "400px",
        scrollCollapse: true,
        paging: false,
        order: [[0, 'asc']],
        columnDefs: [
            { //fullName
                targets: 0,
                width: "",
                data: null,
                className: 'text-left',
                render: function (data, type, row, meta) {               
                    return `
                        <input name="id_employees_imp[]" type="hidden" value="${row.id}">                       
                        <span style="cursor: pointer" for="" class="form-label fs-8">${row.fullName}</span>                        
                    `;
                },
            },
            { //email
                targets: 1,
                width: "",
                data: null,
                className: 'text-left',
                render: function (data, type, row, meta) {
                    return `
                        <span class="fw-bold text-gray-800">${row.email}</span>
                    `;
                },
            },
            { //numberSAP
                targets: 2,
                width: "",
                data: null,
                className: 'text-left',
                render: function (data, type, row, meta) {
                    return `
                        <span class="fw-bold text-gray-800">${row.numberSAP}</span>                        
                    `;
                },
            },
            { //society
                targets: 3,
                width: "",
                data: null,
                className: 'align-items-center',
                render: function (data, type, row, meta) {
                    return `
                        <span class="fw-bold text-gray-800">${row.society}</span>                       
                    `;
                },
            },
        ],   
        dom:
            "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +
            "<'table-responsive'tr>" +
            "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });
};

/**Modal Errors */
const init_data_errors = (tb) => {
    var table = $("#" + tb).DataTable({
        language: {
            url : global_data + '/assets/plugins/custom/datatables/es.js'
        },
        responsive: true,
        searching: false,
        processing: false,
        info: true, 
        scrollY: "350px",
        scrollCollapse: false,
        paging: false,
        order: [[ 1, 'desc' ]],
        columnDefs: [
            { "width": "15%", "targets":3 },
            { "width": "45%", "targets":-1 },
            {
                targets: -1,
                render: function(data, type, full, meta) {
                    var errors = {
                        1: { 'title': 'El nombre es requerido', 'class': 'light-danger' },
                        2: { 'title': 'El correo es requerido', 'class': 'light-primary' },
                        3: { 'title': 'El # de SAP de Empleado es requerido', 'class': 'light-info' },
                        4: { 'title': 'La Sociedad es requerida', 'class': 'light-success' },
                    };
                    if (typeof errors[data] === 'undefined') {
                        return data;
                    }
                    return '<span class="badge badge-' + errors[data].class + ' label-inline">' + errors[data].title + '</span>';
                },
            },
        ], 
        columns: [
            { data: "fullName" },
            { data: "email" },
            { data: "numberSAP" },
            { data: "society" },
            { data: "error" }
        ],  
        dom: 'Blfrtip',
         
        buttons: {
            buttons: [ 
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            },
            {
                extend: 'copy',
                text: 'Copiar',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            }
            ],
            dom: {
                  button: { className: "btn btn-bg-light btn-sm"},
                  buttonLiner: { tag: null }
                 }
        },


    });
    
}

KTUtil.onDOMContentLoaded(function () {     
    init_data_errors('kt_dt_imp_errors');
});