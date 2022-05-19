var KTSigninGeneral = (function () {
var t, e, i;
return {
    init: function () {
        (t = document.querySelector("#form_login")),
        (e = document.querySelector("#kt_sign_in_submit")),
        (i = FormValidation.formValidation(t, {
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: "El campo correo electrónico es obligatorio",
                        },
                        emailAddress: {
                            message:
                                "El campo correo electrónico no es una dirección válida.",
                        },
                    },
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: "El campo contraseña es obligatoria",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                }),
            },
        })),
        e.addEventListener("click", function (n) {
            console.log('1-->');
            n.preventDefault(),
            i &&
                i.validate().then(function (i) {
                "Valid" == i  
                ? 
                    (e.setAttribute("data-kt-indicator", "on"),
                    (e.disabled = !0),
                    console.log('2-->'),
                    setTimeout(function () {
                        let email = t.querySelector('[name="email"]').value;
                        let password = t.querySelector('[name="password"]').value;   
                        console.log('3-->' + email);


                        let url = global_url + '/authenticate';
                        let params = {
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
                        .then(res => {
                            console.log('entro aqui')
                            window.location.replace(res.data);
                        })
                        .catch(error => {

                            // let er = error.response.data.errors;
                            // let message = 'Error en el servidor';

                            // if(er.hasOwnProperty('email')){
                            //     message = er.email[0];
                            // }else if(er.hasOwnProperty('password')){
                            //     message = er.password[0];
                            // }else if(er.hasOwnProperty('login')){
                            //     message = er.login[0];
                            // }
                            //  console.log('Mensaje' + message);   
                            // e.removeAttribute("data-kt-indicator"),
                            // (e.disabled = !1),
                            // Swal.fire({
                            //     text: message,
                            //     icon: "error",
                            //     buttonsStyling: !1,
                            //     confirmButtonText: "!OK¡",
                            //     customClass: {
                            //         confirmButton:
                            //             "btn btn-primary",
                            //     },
                            // });

                        });
                    }, 0)
                    )
                : 
                    Swal.fire({
                        text: 'Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo.',
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "!OK¡",
                        customClass: {
                            confirmButton:
                                "btn btn-primary",
                        },
                    });
 
            });
            
        });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});