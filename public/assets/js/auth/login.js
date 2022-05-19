
var KTSigninGeneral = (function () {
    var t, e, i, r, s, x, c, z, inputs, form, inputs, btn;
    //Reglas de validacion
    const exp = {
        email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        password: /^.{1,50}$/, // 1 a 50 digitos.
    }
    //Campos a validar
    const fields = {
        email: false,
        password: false,
    }
    //Funcion para elegir validacion
    const validate_expr = (e) => {
         switch(e.target.name){
             case 'email': validator(exp.email, e.target)
             break;
             case 'password': validator(exp.password, e.target)
             break;
         }
    }
    //Validador
    const validator = (expresion, input) => {
        let x = document.getElementById(input.name);

        if(expresion.test(input.value) == false){
            x.classList.add('is-invalid');
            fields[input.name] = false;
        }else{
            x.classList.remove('is-invalid');
            fields[input.name] = true;
        }
    }

    return {
        init: function () {
            //Form
            (form = document.querySelector("#form_login")),
            (inputs = document.querySelector("#form_login")),
            (btn = document.querySelector("#kt_sign_in_submit")),
            //Spinner
            (r = document.querySelector(".login-text")),
            (s = document.querySelector(".spinner")),
            //Alerts
            (x = document.querySelector(".al_inf")),
            (c = document.querySelector(".al_error")),
            (z = document.querySelector(".al_success")),

           (inputs.forEach((input) => {
                input.addEventListener('keyup', validate_expr);
                input.addEventListener('blur', validate_expr);
            }));

            btn.addEventListener("click", function (n) {
                n.preventDefault();
                if(fields.email == true && fields.password == true){
                    (r.classList.add('d-none')),
                    (x.classList.add('d-none')),
                    (s.classList.remove('d-none')),
                    (btn.disabled = !0),
                    setTimeout(function () {
                        let email = form.querySelector('[name="email"]').value;
                        let password = form.querySelector('[name="password"]').value;   
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
                        .then(function (res) {
                            if (res.status == 200) {
                                return res.json();
                            }else if(res.status ==  401 || res.status ==  419){
                                (
                                (s.classList.add('d-none')),
                                (r.classList.remove('d-none')),
                                (btn.disabled = !1)
                                )
                            }else if(res.status == 422){
                                (
                                (s.classList.add('d-none')),
                                (r.classList.remove('d-none')),
                                (btn.disabled = !1),
                                (c.classList.remove('d-none')),
                                (c.classList.toggle("animate__headShake"))
                                )
                            };
                        })
                        .then(data => {
                            if(data){
                                x.classList.add('d-none');
                                c.classList.add('d-none');
                                z.classList.remove('d-none');
                                window.location.replace(data); 
                            }
                        })
                        .catch(error => {
                            let er = error.response.data.errors;
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
                    }, 0)
                }else{
                    c.classList.add('d-none');                
                    x.classList.remove('d-none');                
                    x.classList.toggle("animate__headShake");
                }
            });
           
        }
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});