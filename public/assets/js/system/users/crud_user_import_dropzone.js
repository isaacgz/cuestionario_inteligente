const id_imp_all = "#kt_dropzonejs_employee_import"; //contenedor de dropzone
let csrf_all = document.querySelector('meta[name="csrf-token"]').getAttribute("content"); //token
let url_all = global_url + "/users/importAllEmployee";
const btn_import_all = document.getElementById("btn_import_all_submit");
const dropzone_import = document.querySelector(id_imp_all); //selector container


// set the preview element template
var previewNode = dropzone_import.querySelector(".dropzone-item");
    previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);


var myDropzone = new Dropzone(id_imp_all, { // Make the whole body a dropzone
    url: url_all, // Set the url for your upload script location
    acceptedFiles: ".xlsx, .xls",
    parallelUploads: 1,
    maxFilesize: 5, // Max filesize in MB
    previewTemplate: previewTemplate,
    previewsContainer: id_imp_all + " .dropzone-items", // Define the container to display the previews
    clickable: id_imp_all + " .dropzone-select", // Define the element that should be used as click trigger to select files.
    dictInvalidFileType: "No puedes subir archivos de este tipo",
    dictFileTooBig: 'El archivo es demasiado grande ({{filesize}}MiB). Tamaño maximo: {{maxFilesize}}MiB.', 
    dictResponseError: 'El servidor respondió con {{statusCode}} código.' ,
    dictCancelUpload: 'Cancelar carga', 
    dictCancelUploadConfirmation : '¿Deseas cancelar esta carga?', 
    dictRemoveFile  : 'Remover archivo', 
    dictMaxFilesExceeded : 'No puede cargar más archivos.', 
    headers: {
        "Contet-Type": "aplication/json",
        "X-CSRF-TOKEN": csrf_all
    },
    init: function() {
        this.on("sending", function(file, xhr) {
            btn_import_all.setAttribute("data-kt-indicator", "on");
            btn_import_all.disabled = !0;
            // formData.append("id_client", id_client_imp.value);
            // formData.append("id_warehouse", id_wh_provider_imp.value);
        });
        this.on("success", function(file, response){
            // console.log("Errores" + response.data_noExists);

            if(response.data_noExists.length>0){
                /**El archivo contiene datos que no pueden ser procesados */
                // console.log("Con Errores" + response.data_noExists.length);
                modal_errors(response.employees, response.data_noExists);
            }else{
                /**Todos los datos estan OK */
                // console.log("Sin Errores" + response.employees);
                buildEmployees(response.employees, response.data_noExists);
            }
            btn_import_all.disabled = !1;
            btn_import_all.removeAttribute("data-kt-indicator");
        });
    },
});

myDropzone.on("addedfile", function (file) {
    // Hookup the start button
    const dropzoneItems_all = dropzone_import.querySelectorAll('.dropzone-item');
    dropzoneItems_all.forEach(dropzoneItem => {
        dropzoneItem.style.display = '';
    });
});


// Update the total progress bar
myDropzone.on("totaluploadprogress", function (progress) {
    const progressBars_all = dropzone_import.querySelectorAll('.progress-bar');
    progressBars_all.forEach(progressBar => {
        progressBar.style.width = progress + "%";
    });
});

myDropzone.on("sending", function (file) {
    // Show the total progress bar when upload starts
    const progressBars_all = dropzone_import.querySelectorAll('.progress-bar');
    progressBars_all.forEach(progressBar => {
        progressBar.style.opacity = "1";
    });
   
});

// Hide the total progress bar when nothing"s uploading anymore
myDropzone.on("complete", function (progress) {
    const progressBars_all = dropzone_import.querySelectorAll('.dz-complete');
                            myDropzone.removeFile(progress); //quita el archivo cargado
    setTimeout(function () {
        progressBars_all.forEach(progressBar => {
            progressBar.querySelector('.progress-bar').style.opacity = "0";
            progressBar.querySelector('.progress').style.opacity = "0";
        });
    }, 300);
});