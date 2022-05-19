const target = document.querySelector("#data_tab_brancho");
const blockUI = new KTBlockUI(target, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Cargando...</div>',
});


let get_roles = () => {
    let url = global_url + '/roles/getRoles';
    let t = $('#kt_datatable_roles').DataTable();
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

let validate_role_add = (event) => {
    event.preventDefault();
    let name = document.querySelector('#name_role_add').value;
    
    if(name.trim()==''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            customClass: {
                confirmButton: "btn btn-primary",
            },
            text: 'Por favor llene todos los campos marcados como requeridos',
          })
    }else{
        store_role(event);
    }    
}

let validate_role_edit = (event) => {
    event.preventDefault();
    let name = document.querySelector('#name_role_edit').value;

    if(name.trim()==''){
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        customClass: {
            confirmButton: "btn btn-primary",
        },
        text: 'Por favor llene todos los campos marcados como requeridos',
        })
    }else{
        update_role(event);
    }    
}
/* 
|--------------------------------------------------------------------------
| Convert nodelist to array
|--------------------------------------------------------------------------
|
*/
let nodeToArrayString = (nodeList) => {
    let array = [];
    for (var i = 0; i < nodeList.length; i++) {
        array[i] = (nodeList[i].value);
    }
    return array;
}

function getCheckedValues() {
    return Array.from(document.querySelectorAll('input[type="checkbox"]'))
    .filter((checkbox) => checkbox.checked)
    .map((checkbox) => checkbox.value);
}

let store_role = (event) => {
    event.preventDefault();
    let url = global_url + '/roles';
    let cls = document.querySelector('#btn_modal_roles_cls');
    dis_btn_role(true, 1);
    
    var params = {   
        name    :  document.querySelector('#name_role_add').value,
        permission  :  getCheckedValues()
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
        dis_btn_role(false, 1);
        get_roles();
        cls.click();
        toastr_notify('Datos guardados correctamente', 'success');
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
 

}

let destroy_role = (id, evt) => {
    let url = global_url + '/roles/{role}';
    evt.preventDefault();
    Swal.fire({
        title: 'Alerta:',
        text: "La información actual y relacionada a ella, se borraran de manera permanente.",
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
                        get_roles();
                        toastr_notify('Datos borrados correctamente', 'success');                
                    break;
                    case 422: 
                        toastr_notify('Ha ocurrido un error, vuelva a intentarlo', 'danger');
                    break;
                    case 401: 
                        toastr_notify('Su sesión a expirado, vuelva a inicar sesión', 'danger');
                    break;
                    case 419: 
                        toastr_notify('Su sesión a expirado, vuelva a inicar sesión', 'danger');
                    break;
                    case 403: 
                        toastr_notify('No puede eliminar este registro. Se encuentra en uso en otro módulo.', 'danger');
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
 
let show_info_edit_role = (id, event) => {
    event.preventDefault();
    dis_btn_role(true, 2);
    let url = global_url + '/roles/' + id;
    
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
        // console.log(id);
        $("#name_role_edit").val(data.role.name);              
        $("#id_role_edit").val(id);
        
        //All rows from permisions table
        for (let option in data.rolePermissions) {                
            let permission_id = data.rolePermissions[option].permission_id;      
            var x = document.getElementById("permissions_"+permission_id).checked = true;            
        }
        dis_btn_role(false, 2);
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}

let update_role = (event) => {
    dis_btn_role(true, 2);
    event.preventDefault();

    let cls =  document.querySelector('#btn_modal_roles_edit_cls');
    let url = global_url + '/roles/edit';

    var params = {   
        name        :  document.querySelector('#name_role_edit').value,        
        permission  :  getCheckedValues(),
        id          :  document.querySelector('#id_role_edit').value
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
        dis_btn_role(false, 2);
        get_roles();
        cls.click();
        toastr_notify('Datos guardados correctamente', 'success');
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}

let dis_btn_role = (action, modal) => {

    if(modal == 1){ //add

        let spinner_add     =   document.querySelector('#spi_modal_role_add');
        let btn_add         =   document.querySelector('#btn_modal_role_add');
        let name_add        =   document.querySelector('#name_role_add');

        name_add.disabled = action;
        if(action == true)
            spinner_add.classList.remove("visually-hidden");
        else 
            spinner_add.classList.add("visually-hidden");
        btn_add.disabled = action; 
        
    }else if(modal == 2){ //edit
    

        let spinner_edit =   document.querySelector('#spi_modal_roles_edit');
        let btn_edit     =   document.querySelector('#btn_modal_roles_edit');
        let name_edit =         document.querySelector('#name_role_edit');

        name_edit.disabled = action;
        if(action == true)
            spinner_edit.classList.remove("visually-hidden");
        else 
            spinner_edit.classList.add("visually-hidden");
        btn_edit.disabled = action; 
    }
}