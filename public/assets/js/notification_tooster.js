
'use_strict';

/*
|--------------------------------------------------------------------------
| Notification Tooster
|--------------------------------------------------------------------------
*/
@if(Session::has('message')) //En caso de que tenga message
var type = "{{ Session::get('alert-type', 'success') }}";
toastr.options = {   //le cambiamos posicion y algunos estilos a la notificación
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
switch(type){ //entra al switch y depediendo del tipo de notificación será el color de esta 
    case 'info':
        toastr.info("{{ Session::get('message') }}");
    break;
    case 'success':
        toastr.success("{{ Session::get('message') }}");
    break;
}
@endif


  