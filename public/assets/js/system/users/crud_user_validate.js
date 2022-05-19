var add = (function () {
    var t, n, form_add, i, r;

    const p_add = function () {
        form_add.reset(); 
        $('#roles_user_add') .val(null).trigger('change');
    }
    
    return {
      add_user: function () {
        (r = document.querySelector("#kt_modal_new_user")) &&
          ((i = new bootstrap.Modal(r)),
          (form_add = document.querySelector("#form_add")),
          (t = document.getElementById("btn_modal_user_add")),
          (n = FormValidation.formValidation(form_add, {
            fields: {
                user_image_add: {
                    validators: {
                        file: {
                            extension: 'jpg,jpeg,png',
                            type: 'image/jpeg,image/png',
                            message: 'Formato no permitido.'
                        },
                    }
                },
                name_user_add: {
                    validators: {
                        notEmpty: {
                            message: 'El campo nombre es requerido.'
                        }
                    }
                },
                email_user_add: {
                    validators: {
                        notEmpty: {
                            message: "El campo correo es requerido."
                        },
                        emailAddress: {
                            message: 'El campo correo no es un correo valido'
                        },
                    }
                },
                password_user_add: {
                    validators: {
                        notEmpty: {
                            message: 'El campo contraseña es requerido.'
                        }
                    }
                },
                roles_user_add: {
                    validators: {
                        notEmpty: {
                            message: 'El campo rol es requerido.'
                        }
                    }
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
          })),
          
          t.addEventListener("click", function (e) {
            e.preventDefault(),
              n &&
                n.validate().then(function (e) {                
                    "Valid" == e
                      ? 
                      (t.setAttribute("data-kt-indicator", "on"),
                        (t.disabled = !0),
                          setTimeout(function () {
                              store_user();
                              t.removeAttribute("data-kt-indicator"),
                              (t.disabled = !1),
                              i.hide(),
                              p_add();
                            }, 2e3)
                      )  
                      : Swal.fire({
                          text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo..",
                          icon: "error",
                          buttonsStyling: !1,
                          confirmButtonText: "¡OK!",
                          customClass: { confirmButton: "btn btn-primary" },
                        });
                });
          }) 
          );
      } 
    };
})();

var edit = (function () {
    var t, n, form_edit, i, r;

    const p_edit = function () {
        form_edit.reset(); 
        $('#roles_user_edit') .val(null).trigger('change');
    }
    return {
      edit_user: function () {
        (r = document.querySelector("#kt_modal_edit_user")) &&
          ((i = new bootstrap.Modal(r)),
          (form_edit = document.querySelector("#form_edit")),
          (t = document.getElementById("btn_modal_users_edit")),
          (n = FormValidation.formValidation(form_edit, {
            fields: {
                user_image_edit: {
                    validators: {
                        file: {
                            extension: 'jpg,jpeg,png',
                            type: 'image/jpeg,image/png',
                            message: 'Formato no permitido.'
                        },
                    }
                },
                name_user_edit: {
                    validators: {
                        notEmpty: {
                            message: 'El campo nombre es requerido.'
                        }
                    }
                },
                email_user_edit: {
                    validators: {
                        notEmpty: {
                            message: "El campo correo es requerido."
                        },
                        emailAddress: {
                            message: 'El campo correo no es un correo valido'
                        },
                    }
                },
                roles_user_edit: {
                    validators: {
                        notEmpty: {
                            message: 'El campo rol es requerido.'
                        }
                    }
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
          })),
          
          t.addEventListener("click", function (e) {
            e.preventDefault(),
              n &&
                n.validate().then(function (e) {                
                    "Valid" == e
                      ? 
                      (t.setAttribute("data-kt-indicator", "on"),
                        (t.disabled = !0),
                          setTimeout(function () {
                              update_user();
                              t.removeAttribute("data-kt-indicator"),
                              (t.disabled = !1),
                              i.hide(),
                              p_edit()
                            }, 2e3)
                      )  
                      : Swal.fire({
                          text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo..",
                          icon: "error",
                          buttonsStyling: !1,
                          confirmButtonText: "¡OK!",
                          customClass: { confirmButton: "btn btn-primary" },
                        });
                });
          }) 
          );
      },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    add.add_user();
    edit.edit_user();
});