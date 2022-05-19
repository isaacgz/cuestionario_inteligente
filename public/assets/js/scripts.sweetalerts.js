"use strict";

/**
 * Confirm
 * @param {title alert} title
 * @param {id form} id
 * @param {event javascript} evt
 */

function confirmDestroy(title, id, evt) {
 
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "La información se borrara de manera permanente.",
        icon: "warning",
        buttonsStyling: false,
        confirmButtonText: "Si, eliminar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel
        }
    }).catch(function(err){
       console.log(id);
    })
}

function confirmDesactivate(title, id, evt) {
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "El registro se desactivará.",
        icon: "warning",
        buttonsStyling: false,
        confirmButtonText: "Si, desactivar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel
        }
    })
}


function confirmActivate(title, id, evt) {
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "El registro se activará.",
        icon: "warning",
        buttonsStyling: false,
        confirmButtonText: "Si, activar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel
        }
    })
}

function confirmSubmit(title, id, evt){
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "El producto será entregado",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Si, enviar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel                
        }
    })
    
}
function confirmQuo(title, id, evt){
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "La cotización será creada",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Si, enviar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel                
        }
    })
}
function confirmEmp(title, id, evt){
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "El empleado será agregado al proyecto",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Si, enviar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel                
        }
    })
}
function confirmDate(title, id, evt){
    evt.preventDefault();
    Swal.fire({
        title: title,
        text: "La fecha del proyecto será modificada",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Si, enviar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-default"
        }
    }).then(function(result) {
        if (result.value) {
            //Action canfirm
            document.getElementById(id).submit();
        } else if (result.dismiss === "cancel") {
            //Action cancel                
        }
    })
}