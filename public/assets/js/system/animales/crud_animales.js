const target = document.querySelector("#data_tab_brancho");
const blockUI = new KTBlockUI(target, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Cargando...</div>',
});


let get_animal = () => {
    let url = global_url + '/animal/getAnimales';
    let t = $('#kt_datatable_animal').DataTable();
    if(t){
        blockUI.block();
        fetch(url , {
            method: 'POST',
            credentials: "same-origin",
            headers:{
                'Contet-Type': 'aplication/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "X-Requested-With": "XMLHttpRequest",
            } 
        })
        .then(function(res){
            return res.json();
        })
        .then(data => {             
            t.rows().remove().draw();  
            t.rows.add(data).draw();
            blockUI.release();
        })
        .catch(function (e) {
            toastr_notify('Error: ' + e, 'danger');
        });
    }
}

let validate_animal_add = (event) => {
    event.preventDefault();
    let text = document.querySelector('#text_add').value;
    
    if(text.trim()==''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            customClass: {
                confirmButton: "btn btn-primary",
            },
            text: 'Por favor llene todos los campos marcados como requeridos',
          })
    }else{
        store_animal(event);
    }    
}

let validate_animal_edit = (event) => {
    event.preventDefault();
    let text = document.querySelector('#text_edit').value;

    if(text.trim()==''){
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        customClass: {
            confirmButton: "btn btn-primary",
        },
        text: 'Por favor llene todos los campos marcados como requeridos',
        })
    }else{
        update_animal(event);
    }    
}
/* 
|--------------------------------------------------------------------------
| Convert nodelist to array
|--------------------------------------------------------------------------
|
*/

let store_animal = (event) => {
    event.preventDefault();
    let url = global_url + '/animal';
    let cls = document.querySelector('#btn_modal_animal_cls');
    dis_btn_animal(true, 1);
    
    var params = {   
        text    :  document.querySelector('#text_add').value,
        active    :  document.querySelector('#active_add').checked
    };
    // console.log(params);
    fetch(url , {
        method: 'POST',
        body: JSON.stringify(params),
        credentials: "same-origin",
        headers:{
            'Contet-Type': 'aplication/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "X-Requested-With": "XMLHttpRequest",
        } 
    })
    .then(function(res){
        return res.json();
    })
    .then(data => { 
        dis_btn_animal(false, 1);
        get_animal();
        cls.click();
        toastr_notify('Datos guardados correctamente', 'success');
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
 

}

let destroy_animal = (id, evt) => {
    let url = global_url + '/animal/{animal}';
    evt.preventDefault();
    Swal.fire({
        title: 'Alerta:',
        text: "La informaci??n actual y relacionada a ella, se borraran de manera permanente.",
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
            
            var params = {   
                id:  id,
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
                switch(res.status){
                    case 200: 
                        get_animal();
                        toastr_notify('Datos borrados correctamente', 'success');                
                    break;
                    case 422: 
                        toastr_notify('Ha ocurrido un error, vuelva a intentarlo', 'danger');
                    break;
                    case 401: 
                        toastr_notify('Su sesi??n a expirado, vuelva a inicar sesi??n', 'danger');
                    break;
                    case 419: 
                        toastr_notify('Su sesi??n a expirado, vuelva a inicar sesi??n', 'danger');
                    break;
                    case 403: 
                        toastr_notify('No puede eliminar este registro. Se encuentra en uso en otro m??dulo.', 'danger');
                    break;
                }
            }).catch(function (e) {
                toastr_notify('Ha ocurrido el error:' + e, 'error');
            });
 
        } else if (result.dismiss === "cancel") {
            
        }
    }).catch(function(err){
        toastr_notify('Error: ' + e, 'danger');
    })

}
 
let show_info_edit_animal = (id, event) => {
    event.preventDefault();
    dis_btn_animal(true, 2);
    let url = global_url + '/animal/' + id;
    
    fetch(url , {
        method: 'GET',
        credentials: "same-origin",
        headers:{
            'Contet-Type': 'aplication/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "X-Requested-With": "XMLHttpRequest",
        } 
    })
    .then(function(res){
        return res.json();
    })
    .then(data => { 
        console.log(data);
        $("#text_edit").val(data.Animal.texto);              
        $("#id_animal_edit").val(id);

        if(data.Animal.active == 1){
            $("#active_animal_edit").prop('checked', true).val(1);
        }else{
            $("#active_animal_edit").prop('checked', false).val(0);
        }
        dis_btn_animal(false, 2);
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}

let update_animal = (event) => {
    dis_btn_animal(true, 2);
    event.preventDefault();

    let cls =  document.querySelector('#btn_modal_animal_edit_cls');
    let url = global_url + '/animal/edit';
    
    var params = {   
        name    :  document.querySelector('#text_edit').value,
        active  :  document.querySelector('#active_animal_edit').checked,
        id      :  document.querySelector('#id_animal_edit').value
    };
    fetch(url , {
        method: 'PATCH',
        body: JSON.stringify(params),
        credentials: "same-origin",
        headers:{
            'Contet-Type': 'aplication/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "X-Requested-With": "XMLHttpRequest",
        } 
    })
    .then(function(res){
        return res.json();
    })
    .then(data => {       
        dis_btn_animal(false, 2);
        get_animal();
        cls.click();
        toastr_notify('Datos guardados correctamente', 'success');
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}

let dis_btn_animal = (action, modal) => {

    if(modal == 1){ //add

        let spinner_add     =   document.querySelector('#spi_modal_animal_add');
        let btn_add         =   document.querySelector('#btn_modal_animal_add');
        let name_add        =   document.querySelector('#text_add');

        name_add.disabled = action;
        if(action == true)
            spinner_add.classList.remove("visually-hidden");
        else 
            spinner_add.classList.add("visually-hidden");
        btn_add.disabled = action; 
        
    }else if(modal == 2){ //edit
    

        let spinner_edit =   document.querySelector('#spi_modal_animal_edit');
        let btn_edit     =   document.querySelector('#btn_modal_animal_edit');
        let name_edit =         document.querySelector('#text_edit');

        name_edit.disabled = action;
        if(action == true)
            spinner_edit.classList.remove("visually-hidden");
        else 
            spinner_edit.classList.add("visually-hidden");
        btn_edit.disabled = action; 
    }
}