

let dark_mode = (id) => {
    dk_chk = document.querySelector("input[name=kt_user_menu_dark_mode_toggle]");
    let url = global_url + '/dark_mode'; 
    let dk;

    if (dk_chk.checked)  dk = 1; else dk = 0;

    var params = {   
        dark_mode:  dk,
        id:  id,
    };

    fetch(url , {
    method: 'PATCH',
    credentials: "same-origin", 
    body: JSON.stringify(params),
    cache: 'no-cache',
    headers:{
        'Contet-Type': 'aplication/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        "X-Requested-With": "XMLHttpRequest",
    } 
    })
    .then(function(res){
        location.reload();
    }) 
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
 
}