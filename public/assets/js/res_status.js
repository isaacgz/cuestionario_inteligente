'use_strict'

let res_status = (status) => {
    switch(status){  
        case 422:
            toastr_notify('Ha ocurrido un error, vuelva a intentarlo', 'danger');
        break;
        case 401:
            toastr_notify('Su sesión a expirado, vuelva a inicar sesión.', 'danger');
        break;
        case 403: 
            toastr_notify('No puede eliminar este registro. Se encuentra en uso en otro módulo', 'danger');
        break;
        case 419:
            toastr_notify('Su sesión a expirado, vuelva a inicar sesión.', 'danger');
        break;
        case 500:
            toastr_notify('Internal server error', 'danger');
        break;
    }
}