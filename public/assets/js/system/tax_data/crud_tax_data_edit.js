/**const, variables */
const id_contract = document.querySelector("#id_contract");
const invoice_edit = document.querySelector("#invoice_edit");
const buyer_name_edit = document.querySelector("#buyer_name_edit");
const buyer_address_edit = document.querySelector("#buyer_address_edit");
const buyer_number_edit = document.querySelector("#buyer_number_edit");
const seller_name_edit = document.querySelector("#seller_name_edit");
const seller_address_edit = document.querySelector("#seller_address_edit");
const seller_number_edit = document.querySelector("#seller_number_edit");
const zone_number_edit = document.querySelector("#zone_number_edit");
const lot_number_edit = document.querySelector("#lot_number_edit");
const apple_number_edit = document.querySelector("#apple_number_edit");
const surface_edit = document.querySelector("#surface_edit");
 

let show_info_edit_td = (id, event) => {
    event.preventDefault();
    let url = global_url + '/contract/getContractsDetails/' + id;
    
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
        if(res.status === 200){
            return res.json();
        }else res_status(res.status)
    })
    .then(data => { 
        //inputs
        id_contract.value           = data[0].id;  
        invoice_edit.value          = data[0].invoice;  
        buyer_name_edit.value       = data[0].buyer_name;  
        buyer_address_edit.value    = data[0].buyer_address;
        buyer_number_edit.value     = data[0].buyer_number;
        seller_name_edit.value      = data[0].seller_name;
        seller_address_edit.value   = data[0].seller_address;
        seller_number_edit.value    = data[0].seller_number;
        zone_number_edit.value      = data[0].zone_number;  
        lot_number_edit.value       = data[0].lot_number;
        apple_number_edit.value     = data[0].apple_number;  
        surface_edit.value          = data[0].surface;
        //radio 
        // if(data[0].active == 1){
        //     $("#active_edit_art").prop('checked', true).val(1);
        // }else{
        //     $("#active_edit_art").prop('checked', false).val(0);
        // }
    })
    .catch(function (e) {
        toastr_notify('Error:' +  e, 'danger');
    });
}


let update_contract = () => {
    let url = global_url + '/contract/{idContract}';
    
    var params = {   
        id_contract          :id_contract.value,
        invoice_edit         :invoice_edit.value,
        buyer_name_edit      :buyer_name_edit.value,
        buyer_address_edit   :buyer_address_edit.value,
        buyer_number_edit    :buyer_number_edit.value,
        seller_name_edit     :seller_name_edit.value,
        seller_address_edit  :seller_address_edit.value,
        seller_number_edit   :seller_number_edit.value,
        zone_number_edit     :zone_number_edit.value,
        lot_number_edit      :lot_number_edit.value,
        apple_number_edit    :apple_number_edit.value,
        surface_edit         :surface_edit.value
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
        if(res.status === 200){
            return res.json();
        }else res_status(res.status)
    }).then(data => {         
        setTimeout(function(){ 
            getDataContracts();
            toastr_notify('Datos guardados correctamente', 'success');
        }, 600);
    })
    .catch(function (e) {
        toastr_notify('Ha ocurrido un error, vuelva a intentarlo', 'danger');
    });
}