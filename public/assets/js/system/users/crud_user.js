
const target = document.querySelector("#data_tab_brancho");
const blockUI = new KTBlockUI(target, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Cargando...</div>',
});

const name_user_add = document.querySelector('#name_user_add');
const email_user_add = document.querySelector('#email_user_add');
const password_user_add = document.querySelector('#password_user_add');
const roles_user_add = document.querySelector('#roles_user_add');
const active_user_add = document.querySelector('#active_user_add');

const btn_user_edit = document.querySelector('#btn_modal_users_edit');
const name_user_edit = document.querySelector('#name_user_edit');
const email_user_edit = document.querySelector('#email_user_edit');
const password_user_edit = document.querySelector('#password_user_edit');
const roles_user_edit = document.querySelector('#roles_user_edit');
const active_user_edit = document.querySelector('#active_user_edit');
const id_user_edit = document.querySelector('#id_user_edit');


let get_users = () => {
    let url = global_url + '/users/getUsers';
    let t = $('#kt_datatable_user').DataTable();
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
 
let store_user = () => {
    let url = global_url + '/users';
    
    let formData = new FormData();
        formData.append("archivo", user_image_add.files[0]);
        formData.append("name", name_user_add.value);
        formData.append("email", email_user_add.value);
        formData.append("password", password_user_add.value);
        formData.append("role", roles_user_add.value);
        formData.append("active", active_user_add.value);
        
    fetch(url , {
        method: 'POST',
        body: formData,
        credentials: "same-origin",
        headers:{
            'Contet-Type': 'aplication/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "X-Requested-With": "XMLHttpRequest",
        } 
    })
    .then(function(res){
        if(res.status === 200){  

            get_users();
            document.getElementById("img_user_add").style.backgroundImage = "url('assets/media/avatars/blank.png')"; 
            toastr_notify('Datos guardados correctamente', 'success');  
        }else res_status(res.status)
    }) 
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
 

}

let destroy_user = (id, evt) => {
    let url = global_url + '/users/{user}';
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
                if(res.status === 200){            
                    get_users();
                    toastr_notify('Datos borrados correctamente', 'success'); 
                }else res_status(res.status)
            }).catch(function (e) {
                toastr_notify('Ha ocurrido el error:' + e, 'error');
            });
 
        } else if (result.dismiss === "cancel") {
            
        }
    }).catch(function(err){
        toastr_notify('Error: ' + e, 'danger');
    })

}
 
let show_info_edit_user = (id, event) => {
    event.preventDefault();
    dis_btn_user(true);
    let url = global_url + '/users/' + id;
    
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
      
        if(data[0].image != "")
            document.getElementById("img_user").style.backgroundImage = "url('storage/"+ data[0].image +"')"; 
        else
            document.getElementById("img_user").style.backgroundImage = "url('assets/media/avatars/blank.png')"; 

        $("#name_user_edit").val(data[0].name);
        $("#email_user_edit").val(data[0].email);      
        $("#roles_user_edit").val(data[0].id_role).trigger('change');   
            
        $("#id_user_edit").val(id);

        if(data[0].active == 1){
            $("#active_user_edit").prop('checked', true).val(1);
        }else{
            $("#active_user_edit").prop('checked', false).val(0);
        }
        dis_btn_user(false);
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}

let update_user = () => {
    let url = global_url + '/users/edit';    
    let formData = new FormData();
        formData.append("archivo", user_image_edit.files[0]);
        formData.append("name", name_user_edit.value);
        formData.append("email", email_user_edit.value);
        formData.append("password", password_user_edit.value);
        formData.append("role", roles_user_edit.value);
        formData.append("active", active_user_edit.value);
        formData.append("id", id_user_edit.value);
        formData.append("avatar_remove", avatar_remove.value);
    
    fetch(url , {
        method: 'POST',
        body: formData,
        credentials: "same-origin",
        headers:{
            'Contet-Type': 'aplication/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "X-Requested-With": "XMLHttpRequest",
        } 
    })
    .then(function(res){
        if(res.status === 200){            
            get_users();
            toastr_notify('Datos guardados correctamente', 'success');  
        }else res_status(res.status)
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}

let dis_btn_user = (action) => {
    name_user_edit.disabled = action;
    email_user_edit.disabled = action;
    password_user_edit.disabled = action;
    roles_user_edit.disabled = action;

    if(action == true)
    (btn_user_edit.setAttribute("data-kt-indicator", "on"),
    btn_user_edit.disabled = !0)
        else 
            (btn_user_edit.removeAttribute("data-kt-indicator"),
            btn_user_edit.disabled = !1);
}