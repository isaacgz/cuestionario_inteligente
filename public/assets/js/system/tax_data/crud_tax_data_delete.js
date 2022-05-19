let destroy_tax_data = (element, id, evt) => {
    evt.preventDefault();
    let url = global_url + '/TaxData/{TaxData}';
    let t = datatable_cont.DataTable();
    
    Swal.fire({
        title: 'Alerta:',
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
        if(result.value) {
            var params = {   
                id:  id
            };
            fetch(url , {
                method: 'DELETE',
                body: JSON.stringify(params),
                credentials: "same-origin",
                headers:{
                    'Contet-Type': 'aplication/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "X-Requested-With": "XMLHttpRequest",
                } 
            })
            .then(function(res){
                if(res.status === 200){
                    t.row($(element).parents("tr")).remove().draw();
                    toastr_notify('Datos borrados correctamente', 'success'); 
                }else res_status(res.status)
            }).catch(function (e) {
                toastr_notify('Ha ocurrido el error:' + e, 'danger');
            });
        } else if (result.dismiss === "cancel") {
            
        }
    }).catch(function(err){
        toastr_notify('Error:' +  e, 'error');
    })

}