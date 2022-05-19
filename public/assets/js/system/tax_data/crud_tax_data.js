const target = document.querySelector("#data_tab_brancho");
const blockUI = new KTBlockUI(target, {
    message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Cargando...</div>',
});


let getTaxData = () => {
    let url = global_url + '/TaxData/getTaxData';
    let t = $('#kt_datatable_td').DataTable();
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

/* 
|--------------------------------------------------------------------------
| Convert nodelist to array
|--------------------------------------------------------------------------
|
*/