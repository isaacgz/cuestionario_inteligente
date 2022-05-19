"use strict";
var KTSignupGeneral = function () {
    var e, t, a, s, r = function () {
        return 100 === s.getScore()
    };
    return {
        init: function () {
            e = document.querySelector("#kt_sign_up_form"), t = document.querySelector("#kt_sign_up_submit"), s = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]')), a = FormValidation.formValidation(e, {
                fields: {
                    "first-name": {
                        validators: {
                            notEmpty: {
                                message: "Nombre(s) requerido(s)"
                            }
                        }
                    },
                    "last-name": {
                        validators: {
                            notEmpty: {
                                message: "Apellido(s) requerido(s)"
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "Correo requerido"
                            },
                            emailAddress: {
                                message: "No es un email valido"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "La contraseña es requerida"
                            },
                            callback: {
                                message: "Ingresa una contraseña valida",
                                callback: function (e) {
                                    if (e.value.length > 0) return r()
                                }
                            }
                        }
                    },
                    "confirm-password": {
                        validators: {
                            notEmpty: {
                                message: "Se requiere confirmar la contraseña"
                            },
                            identical: {
                                compare: function () {
                                    return e.querySelector('[name="password"]').value
                                },
                                message: "La contraseña y la confirmación no son similares"
                            }
                        }
                    },
                    toc: {
                        validators: {
                            notEmpty: {
                                message: "Terminos y condiciones requeridos"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: !1
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function (r) {

                r.preventDefault(), a.revalidateField("password"), a.validate().then((function (a) {
                    "Valid" == a ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {

                                let fsname = e.querySelector('[name="first-name"]').value;
                                let lsname = e.querySelector('[name="last-name"]').value;
                                let email = e.querySelector('[name="email"]').value;
                                let password = e.querySelector('[name="password"]').value;   
                                let url = global_url + '/register/new';
                                let params = {
                                    fsname: fsname,
                                    lsname: lsname,
                                    email: email,
                                    password: password
                                };
                               
                                fetch(url , {
                                    method: 'POST',
                                    body: JSON.stringify(params),
                                    credentials: "same-origin",
                                    headers:{
                                        'Contet-Type': 'aplication/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    } 
                                })
                                .then(function (res) {
                                    if (res.status == 200) {                                        
                                        return res.json();
                                    }else if(res.status ==  401 || res.status ==  419){
                                        (e.reset(), s.reset())
                                    }else if(res.status == 422){
                                        (e.reset(), s.reset())
                                    };
                                })
                                .then(data => {                                    
                                    if(data){
                                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                                            text: "¡Alta exitosa, ya puedes ingresar!",
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, vamos!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then((function (t) {
                                            t.isConfirmed && (e.reset(), s.reset())
                                            window.location.replace(data); 
                                        }))
                                    }
                                })
                                .catch(error => {                                    
                                    let message = 'Ha ocurrido un error en el servidor.';
                                    (btn.disabled = !1),
                                    Swal.fire({
                                        text: message,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "!OK¡",
                                        customClass: {
                                            confirmButton:
                                                "btn btn-primary",
                                        },
                                    });
        
                                });
                        
                    }), 0)) : Swal.fire({
                        text: "Lo sentimos, detectamos algún error, intenta de nuevo.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, vamos!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })), e.querySelector('input[name="password"]').addEventListener("input", (function () {
                this.value.length > 0 && a.updateFieldStatus("password", "NotValidated")
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSignupGeneral.init()
}));