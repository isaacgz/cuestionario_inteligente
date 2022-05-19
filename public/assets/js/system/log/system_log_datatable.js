$("#kt_datatable_log").DataTable({
    language: {
       url : global_data + '/assets/plugins/custom/datatables/es.js'
    },
    responsive: true,
    searching: true,
    processing: false,
    columnDefs: [
        { "width": "15%", "targets":0 },
        { "width": "10%", "targets":1 },
        { "width": "40%", "targets":2 },
        { "width": "15%", "targets":3 },
        { "width": "20%", "targets":-1 },
        {
            targets: 1,
            render: function(data, type, full, meta) {
                var status = {
                    'delete': { 'title': 'delete', 'class': 'light-danger' },
                    'store': { 'title': 'store', 'class': 'light-success' },
                    'update': { 'title': 'update', 'class': 'light-warning' },
                    'import': { 'title': 'import', 'class': 'light-success' },

                    'login': { 'title': 'login', 'class': 'light-primary' },
                    'logout': { 'title': 'logout', 'class': 'light-info' },
                };
                if (typeof status[data] === 'undefined') {
                    return data;
                }
                return '<span class="badge badge-' + status[data].class + ' label-inline">' + status[data].title + '</span>';
            },
        },
    ],
    columns:[
        {data:'date'},
        {data:'event'},
        {data:'message'},
        {data:'id_event'},
        {data:'user_event'}
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