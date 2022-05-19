'use_strict'

let toastr_notify = (message, type) => {

    let title_toast = 'Inteligencia Artificial';
 
    toastr.options = {    
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    switch(type){  
        case 'info':
            toastr.info(message, title_toast);
        break;
        case 'success':
            toastr.success(message, title_toast);
        break;
        case 'danger':
            toastr.error(message, title_toast);
        break;
    }
}