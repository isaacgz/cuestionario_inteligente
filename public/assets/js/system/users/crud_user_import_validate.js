var import_employee = (function () {
    var o, s, n;
    
    return {
        init: function () {
            (o = document.querySelector("#form_imp")),
            (s = document.querySelector("#btn_import_all_submit")),
            (n = FormValidation.formValidation(o, {
                    fields: { 
                        date_request_imp: {
                            validators: {
                                notEmpty: {
                                    message:
                                        "El campo fecha es requerido.",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })
            )
    
            s.addEventListener("click", function (e) {
                e.preventDefault(),
                n && n.validate().then(function (e) {                
                    "Valid" == e
                        ? 
                        (
                            document.getElementsByName('id_employees_imp[]').length > 0 
                            ? (
                                s.setAttribute("data-kt-indicator", "on"),
                                s.disabled = !0,
                                setTimeout(function () {
                                    store_imp();
                                    s.removeAttribute("data-kt-indicator");
                                    s.disabled = !1;
                                }, 2e3)
                            ) : (
                                Swal.fire({
                                    text: "Lo sentimos, debe añadir empleados previamente.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "¡OK!",
                                    customClass: { confirmButton: "btn btn-primary" },
                                })
                            )
                        )
                        : Swal.fire({
                            text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo..",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "¡OK!",
                            customClass: { confirmButton: "btn btn-primary" },
                        }).then(function () {
                            KTUtil.scrollTop();
                        });
                });
            })
        },
    };
})();


KTUtil.onDOMContentLoaded(function () {
    import_employee.init();
});
