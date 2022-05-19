/** Datatable */
const datatable_cont = $("#kt_datatable_contract");
/** Fields */
const date_or_rp = document.getElementById("date_or_rp");
const name_sr = document.querySelector("#name_sr");
const lot_num = document.querySelector("#lot_num");
const apple_num = document.querySelector("#apple_num");
const status_or_rp = document.getElementById("status_or_rp");

/** Fields Details*/
const status_details = document.getElementById("status_details");
const invoice_txt_det = document.getElementById("invoice_txt_det");
const buyer_name_txt_det = document.getElementById("buyer_name_txt_det");
const buyer_tel_number_txt_det = document.getElementById("buyer_tel_number_txt_det");
const buyer_address_txt_det = document.getElementById("buyer_address_txt_det");
const seller_name_txt_det = document.getElementById("seller_name_txt_det");
const seller_tel_number_txt_det = document.getElementById("seller_tel_number_txt_det");
const seller_address_txt_det = document.getElementById("seller_address_txt_det");
const zone_number_txt_det = document.getElementById("zone_number_txt_det");
const lot_number_txt_det = document.getElementById("lot_number_txt_det");
const apple_number_txt_det = document.getElementById("apple_number_txt_det");
const surface_txt_det = document.getElementById("surface_txt_det");

/** buttom */
const btn_svg_order = document.getElementById("btn_svg");
const btn_spinner_order = document.getElementById("btn_spinner");
//Container order block
const container_OR = document.querySelector("#kt_contract_container");
const blockOR = new KTBlockUI(container_OR);

/** Get data report */
const getDataContracts = () =>{
    
    disableAllOrder(true);
    let t = datatable_cont.DataTable();
    let url = global_url + "/contract/getContracts";
    let dateArray = date_or_rp.value.split("-", 2);

    let params = {
        startDay    :dateArray[0].trim().replaceAll("/", "-") + " 00:00:00",
        endDay      :dateArray[1].trim().replaceAll("/", "-") + " 23:59:59",        
        name        :name_sr.value,
        lot_num     :lot_num.value,
        apple_num   :apple_num.value,
        active      :status_or_rp.value
    };
    fetch(url, {
        method: "POST",
        body: JSON.stringify(params),
        credentials: "same-origin",
        headers: {
            "Contet-Type": "aplication/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
    .then(function (res) {
        if(res.status === 200){
            return res.json();
        }else res_status(res.status)
    })
    .then(function(data) {
        t.rows().remove().draw();
        t.rows.add(data).draw();
        disableAllOrder(false);
    })
    .catch(function (e) {
        toastr_notify("Error :" + e, "danger");
        disableAllOrder(false);
    });
}

//Obtener los detalles de la orden
var getDetails = function(idContract){
    let url = global_url + "/contract/getContractsDetails/" + idContract;
        
    fetch(url, {
        method: "GET",
        credentials: "same-origin",
        headers: {
            "Contet-Type": "aplication/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
    .then(function (res) {
        if(res.status === 200){
            return res.json();
        }else res_status(res.status)
    })
    .then(function(data) {        
        //Mostrar datos generales
        console.log(data[0].name);
        var html = '';
        var status = {
            1: { 'title': 'En validación', 'class': 'light-success' },
            2: { 'title': 'Activo', 'class': 'light-primary' },
            3: { 'title': 'Inactivo', 'class': 'light-danger' },
        };
        if (typeof status[data[0].active] === 'undefined') {
            return data;
        }
        html = '<span class=" fs-12 badge badge-' + status[data[0].active].class + ' label-inline">' + status[data[0].active].title + '</span>';
        
        status_details.innerHTML            = html;        
        invoice_txt_det.innerHTML           = data[0].invoice;
        buyer_name_txt_det.innerHTML        = data[0].buyer_name;
        buyer_tel_number_txt_det.innerHTML  = data[0].buyer_address;
        buyer_address_txt_det.innerHTML     = data[0].buyer_number;
        seller_name_txt_det.innerHTML       = data[0].seller_name;
        seller_tel_number_txt_det.innerHTML = data[0].seller_address;
        seller_address_txt_det.innerHTML    = data[0].seller_number;
        zone_number_txt_det.innerHTML       = data[0].zone_number;      
        lot_number_txt_det.innerHTML        = data[0].lot_number;      
        apple_number_txt_det.innerHTML      = data[0].apple_number;      
        surface_txt_det.innerHTML           = data[0].surface;     
    })
    .catch(function (e) {
        toastr_notify("Error :" + e, "danger");
    });
}

//Obtener los detalles de la orden
var show_documents = function(idContract, event){    
    event.preventDefault();
    let url = global_url + "/contract/getContractsDocs/" + idContract;
    let publicurl = global_url + "/storage/"
    let htmlTags = '';

    fetch(url, {
        method: "GET",
        credentials: "same-origin",
        headers: {
            "Contet-Type": "aplication/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
    .then(function (res) {
        if(res.status === 200){
            return res.json();
        }else res_status(res.status)
    })
    .then(function(data) {        
        //Mostrar datos generales
        // console.log(data);
        $("#documents").empty();        

        for(let option in data){

            let path = data[option].path;
            // console.log("acaa "+ path);
             htmlTags  += 
            '<li class="list-group-item">'
            +'<div class="row">'
            +'<div class="col-1">'
            +'<span class="svg-icon svg-icon-muted svg-icon-2hx">'
            +'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">'
            +'<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black"/>'
            +'<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>'
            +'</svg>'
            +'</span>'
            +'</div>'
            +'<div class="col-5 lh-xl">'
            + data[option].docName
            +'</div>'
            +'<div class="col-6 lh-xl">'

            if (path != "") {
                
                htmlTags += '<a title="Bajar Documento" target="_blank" download="' + data[option].docName +'" href="' + publicurl + path + '" class="btn btn-active-white">'
                +'<img src="assets/media/icons/duotune/files/fil009.svg"/>'
                +'</a>'                
                +'<a title="Subir Documento" href="#" onclick="show_add_documents(' + idContract + "," + data[option].idDocument +')" data-bs-toggle="modal" data-bs-target="#modal_add_doc" class="btn btn-active-white">'
                +'<img src="assets/media/icons/duotune/files/fil010.svg"/>'
                +'</a>'

            }else{
                htmlTags += '<a title="Subir Documento" href="#" onclick="show_add_documents(' + idContract + "," + data[option].idDocument +')" data-bs-toggle="modal" data-bs-target="#modal_add_doc" class="btn btn-active-white">'
                +'<img src="assets/media/icons/duotune/files/fil010.svg"/>'
                +'</a>'
                // console.log("entre acaaaa");
            }

            htmlTags += '</div>'
            +'</div>'
            +'</li>'
            // console.log(htmlTags);
        }
        $("#documents").html(htmlTags);
    })
    .catch(function (e) {
        toastr_notify("Error :" + e, "danger");
    });
}

/** Disable Order */
const disableAllOrder = (x) => {
    x == true 
    ? (blockOR.block())
    : (blockOR.release());
};

/** Date picker */ 
const start = moment().startOf("month");
const end = moment().endOf("month");
const cb = (start, end) => {
    $("#date_or_rp").html(
        start.format("YYYY,MMMM, D") + " - " + end.format("YYYY, MMMM, D")
    );
};

$("#date_or_rp").daterangepicker(
    {
        locale: {
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            customRangeLabel: "Personalizado",
            daysOfWeek: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sáb"],
            monthNames: ["Enero", "Febrero", "Mazo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            dayNames: ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"],
            dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
            format: "YYYY/MM/DD",
        },
        startDate: start,
        endDate: end,
        ranges: {
            Hoy: [moment(), moment()],
            Ayer: [
                moment().subtract(1, "days"),
                moment().subtract(1, "days"),
            ],
            "Ultimos 7 Días": [moment().subtract(6, "days"), moment()],
            "Ultimos 30 Días": [moment().subtract(29, "days"), moment()],
            "Este mes": [
                moment().startOf("month"),
                moment().endOf("month"),
            ],
        },
    },
    cb
);