
/* 
|--------------------------------------------------------------------------
| Declaration of variables and constants.
|--------------------------------------------------------------------------
*/
const sel_files = document.querySelector("#sel_files");
const sel_module = document.querySelector("#sel_module");


/*
|--------------------------------------------------------------------------
| Select [module]
|--------------------------------------------------------------------------
|
| Capture event.
|
*/
$('#sel_module').on('select2:select', function (e) {
    var data = e.params.data;
    sel_files.disabled = true;
    clearTable();
    // console.log(e);
    getFiles(data.id, e)
});


/*
|--------------------------------------------------------------------------
| Select [file]
|--------------------------------------------------------------------------
|
| Capture event.
|
*/
$('#sel_files').on('select2:select', function (e) {
    var data = e.params.data;
    getData(e, data.id, sel_module.value);
});


/* 
|--------------------------------------------------------------------------
| Get files
|--------------------------------------------------------------------------
*/
let getFiles = (module_id, event) => {
    event.preventDefault();
    let url = global_url + '/log/getFiles/' + module_id;

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
        if(res.status==200){
            return res.json();
        }else res_status(res.status)
    })
    .then(data => {
        // console.log("acaaa: "+data);
        clear_select(sel_files); 
        for(let option in data){
            let dataArray = data[option].split('/');
            let file = dataArray[(dataArray.length)-1];    
            let newOption = document.createElement('option');
                            newOption.value = file;
                            newOption.text = file;
                            sel_files.add(newOption);
        }
        if(data) sel_files.disabled = false;
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}



/* 
|--------------------------------------------------------------------------
| Clear option elements
|--------------------------------------------------------------------------
*/
let clear_select = (select) => {
    var length = select.options.length;
    for (i = length-1; i >= 1; i--) {
        select.options[i] = null;
    }
} 



/* 
|--------------------------------------------------------------------------
| Get Data
|--------------------------------------------------------------------------
*/
let getData = (event, sel_files, sel_module) => {
    event.preventDefault();
    let url = global_url + '/log/getData';
    let t = $('#kt_datatable_log').DataTable();

    var params = {   
        fileName: sel_files,
        module: sel_module,        	
    };

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
        if(res.status==200){
            return res.json();
        }else res_status(res.status)
    })
    .then(data => {
        clearTable();
        t.rows.add(data).draw();
    })
    .catch(function (e) {
        toastr_notify('Error: ' + e, 'danger');
    });
}




let clearTable = () => {
    let t = $('#kt_datatable_log').DataTable();
    t.rows().remove().draw();
}