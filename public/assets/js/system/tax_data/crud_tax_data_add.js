/**const, variables */
const nit_add = document.querySelector("#nit_add");
const business_name_add = document.querySelector("#business_name_add");
const email_add = document.querySelector("#email_add");
const street_add = document.querySelector("#street_add");
const numex_add = document.querySelector("#numex_add");
const numint_add = document.querySelector("#numint_add");
const depa_add = document.querySelector("#depa_add");
const muni_add = document.querySelector("#muni_add");
const colo_add = document.querySelector("#colo_add");
const cp_add = document.querySelector("#cp_add");
const id_doctype_add = document.querySelector("#id_doctype_add");
const numdoc_add = document.querySelector("#numdoc_add");
 
let store_tax_data = () => {
    let url = global_url + '/TaxData';
    
    var params = {   
        nit             :nit_add.value,
        name            :business_name_add.value,
        email           :email_add.value,
        street          :street_add.value,
        numext          :numex_add.value,
        numint          :numint_add.value,
        department      :depa_add.value,
        municipio       :muni_add.value,
        colony          :colo_add.value,
        cp              :cp_add.value,
        id_doctype      :id_doctype_add.value,
        numdoc          :numdoc_add.value
    };
    console.log(params);
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
        if(res.status === 200){
            return res.json();
        }else res_status(res.status)
    }).then(data => {         
        setTimeout(function(){ 
            getTaxData();
            toastr_notify('Datos guardados correctamente', 'success');
        }, 600);
    })
    .catch(function (e) {
        toastr_notify('Ha ocurrido un error, vuelva a intentarlo', 'danger');
    });
}