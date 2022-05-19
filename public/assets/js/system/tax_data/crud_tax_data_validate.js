"use strict";
 var KTModalArticuleAdd = (function () {
  var e, t, o, n, i, r, s, l, d, c, u, m, f, 
       i1_add, i2_add, 
       a1_add, a2_add, 
       r1_add, 
       s2_add, sbt2_add, modal_add, 
       a_add = [], 

       i1_edit, i2_edit, 
       a1_edit, a2_edit, 
       r1_edit,
       s2_edit, sbt2_edit, modal_edit, 
       a_edit = [], p_add, btn_open;


      p_add = function () {
          i1_add.classList.remove("d-none"),
          i2_add.classList.add("d-none"),

          a1_add.reset(); a2_add.reset();

      }

      //Input mask currency
      Inputmask.extendAliases({
        priceMask: {
                  prefix: "$ ",
                  groupSeparator: ".",
                  alias: "numeric",
                  placeholder: "0",
                  autoGroup: true,
                  digits: 2,
                  digitsOptional: false,
                  clearMaskOnLostFocus: true
        }
      });
      Inputmask({alias:'priceMask' }).mask(".currency_mask");

      //Validators form validation
      const validatorCurrency = function() {
        return {
            validate: function (input) {
              let value = input.value;
              if(value == '$ 0.00' || value == ''){
                return { valid: false };
              }else{
                return { valid: true };
              }  
            }
        } 
      }
      
  return {
    init_add: function () {
      (e = document.querySelector("#kt_modal_new_td")) &&
        ((modal_add = new bootstrap.Modal(e)),
        (btn_open = document.querySelector('[data-kt-element="modal-open"]')),
        (i1_add = e.querySelector('[data-kt-element="step-1-add"]')),
        (a1_add = e.querySelector('[data-kt-element="step-1-form-add"]')),
        (r1_add = e.querySelector('[data-kt-element="step-1-btn-next-add"]')),
   
        (i2_add = e.querySelector('[data-kt-element="step-2-add"]')),
        (a2_add = e.querySelector('[data-kt-element="step-2-form-add"]')),
        // (r2_add = e.querySelector('[data-kt-element="step-2-btn-next-add"]')),
        (sbt2_add = e.querySelector('[data-kt-element="step-2-submit-add"]')),
        (s2_add = e.querySelector('[data-kt-element="step-2-cancel-add"]')),

        //Form validation   
        (FormValidation.validators.checkCurrency = validatorCurrency),    
        a_add.push(
            FormValidation.formValidation(a1_add, {
              fields: {
                nit_add: {
                  validators: {
                      notEmpty: {
                          message:
                              "El campo nit es requerido.",
                      },
                  },
                },
                business_name_add: {
                  validators: {
                      notEmpty: {
                          message:
                              "El campo de razon social es requerido.",
                      },
                  },
                },
                email_add: {
                  validators: {
                      notEmpty: {
                          message:
                              "El campo de correo es requerido.",
                      },
                  },
                },
                street_add: {
                  validators: {
                      notEmpty: {
                          message:
                              "El campo calle es requerido.",
                      },
                  },
                },
                numex_add: {
                  validators: {
                      notEmpty: {
                          message:
                              "El campo número exterior es requerido.",
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
        ),
        a_add.push(
            FormValidation.formValidation(a2_add, {
              fields: {
                depa_add: {
                  validators: {
                    notEmpty: { message: "El campo departamento es requerido." },
                  },
                },
                muni_add: {
                    validators: {
                      notEmpty: { message: "El campo municipio es requerido." },
                    },
                },
                colo_add: {
                  validators: {
                    notEmpty: { message: "El campo colonia es requerido." },
                  },
                },
                cp_add: {
                  validators: {
                    notEmpty: { message: "El campo codigo postal es requerido." },
                  },
                },
                id_doctype_add: {
                  validators: {
                    notEmpty: { message: "El campo tipo de documento es requerido." },
                  },
                },
                numdoc_add: {
                  validators: {
                    notEmpty: { message: "El campo numero de documento es requerido." },
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
        ),  
        // Open modal
        btn_open.addEventListener("click", function (e) {
           /// No se hace nada
        }),  
        // Step 1 @ 2
        r1_add.addEventListener("click", function (e) {
          a_add[0].validate().then(function (t) {
              "Valid" == t 
                ? (    
                    (i1_add.classList.add("d-none"), i2_add.classList.remove("d-none"))
                  )
                : Swal.fire({
                    text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "¡OK!",
                    customClass: { confirmButton: "btn btn-primary" },
                  }).then(function () {
                    KTUtil.scrollTop();
                  });
          });
        }),   
        //Return
        s2_add.addEventListener("click", function (e) {
            e.preventDefault();
            i2_add.classList.add("d-none"),
            i1_add.classList.remove("d-none");
        }),
        // Submit Advance                                          
        sbt2_add.addEventListener("click", function (e) {
            e.preventDefault();     
            a_add[1].validate().then(function (t) {
              "Valid" == t 
                ? (    
                  //Si entra, se pasaron todas las validaciones
                    (sbt2_add.setAttribute("data-kt-indicator", "on"),
                    (sbt2_add.disabled = !0),
                        setTimeout(function () {
                          sbt2_add.removeAttribute("data-kt-indicator"),
                            (sbt2_add.disabled = !1),
                              store_tax_data(), modal_add.hide();
                                setTimeout(function () {
                                  p_add();
                                }, 500) 
                        }, 2e3)
                    )  
                )
                : Swal.fire({
                    text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "¡OK!",
                    customClass: { confirmButton: "btn btn-primary" },
                  }).then(function () {
                    KTUtil.scrollTop();
                  });
          });         
        })
 
        );
    },
    init_edit: function () {
      (e = document.querySelector("#kt_modal_edit_contract")) &&
        ((modal_edit = new bootstrap.Modal(e)),
    
        (i1_edit = e.querySelector('[data-kt-element="step-1-edit"]')),
        (a1_edit = e.querySelector('[data-kt-element="step-1-form-edit"]')),
        (r1_edit = e.querySelector('[data-kt-element="step-1-btn-next-edit"]')),
   
        (i2_edit = e.querySelector('[data-kt-element="step-2-edit"]')),
        (a2_edit = e.querySelector('[data-kt-element="step-2-form-edit"]')),
        // (r2_edit = e.querySelector('[data-kt-element="step-2-btn-next-edit"]')),
        (sbt2_edit = e.querySelector('[data-kt-element="step-2-submit-edit"]')),
        (s2_edit = e.querySelector('[data-kt-element="step-2-cancel-edit"]')),

        //Form validation
        (FormValidation.validators.checkCurrency = validatorCurrency), 
        a_edit.push(
          FormValidation.formValidation(a1_edit, {
            fields: {
              name_edit: {
                validators: {
                    notEmpty: {
                        message:
                            "El campo nombre es requerido.",
                    },
                },
              },
              tel_number_edit: {
                validators: {
                    notEmpty: {
                        message:
                            "El campo de numero es requerido.",
                    },
                },
              },
              address_edit: {
                validators: {
                    notEmpty: {
                        message:
                            "El campo dirección es requerido.",
                    },
                },
              },
              civil_status_edit: {
                validators: {
                    notEmpty: {
                        message:
                            "El campo estado civil es requerido.",
                    },
                },
              },
              ocupation_edit: {
                validators: {
                    notEmpty: {
                        message:
                            "El campo ocupación es requerido.",
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
        ),
        a_edit.push(
          FormValidation.formValidation(a2_edit, {
            fields: {
              'zone_number_edit': {
                validators: {
                  notEmpty: { message: "El campo número de zona es requerido." },
                },
              },
              'lot_number_edit': {
                  validators: {
                    notEmpty: { message: "El campo número de lote es requerido." },
                  },
              },
              'apple_number_edit': {
                validators: {
                  notEmpty: { message: "El campo número de lote es requerido." },
                },
              },
              'surface_edit': {
                validators: {
                  notEmpty: { message: "El campo superficie es requerido." },
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
        ),
        // Open modal
        btn_open.addEventListener("click", function (e) {
          /// No se hace nada
        }),  
       // Step 1 @ 2
       r1_edit.addEventListener("click", function (e) {
         a_edit[0].validate().then(function (t) {
             "Valid" == t 
               ? (    
                   (i1_edit.classList.add("d-none"), i2_edit.classList.remove("d-none"))
                 )
               : Swal.fire({
                   text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo.",
                   icon: "error",
                   buttonsStyling: !1,
                   confirmButtonText: "¡OK!",
                   customClass: { confirmButton: "btn btn-primary" },
                 }).then(function () {
                   KTUtil.scrollTop();
                 });
         });
       }),   
       //Return
       s2_edit.addEventListener("click", function (e) {
           e.preventDefault();
           i2_edit.classList.add("d-none"),
           i1_edit.classList.remove("d-none");
       }),
       // Submit Advance                                          
       sbt2_edit.addEventListener("click", function (e) {
           e.preventDefault();     
           a_edit[1].validate().then(function (t) {
             "Valid" == t 
               ? (    
                 //Si entra, se pasaron todas las validaciones
                   (sbt2_edit.setAttribute("data-kt-indicator", "on"),
                   (sbt2_edit.disabled = !0),
                       setTimeout(function () {
                         sbt2_edit.removeAttribute("data-kt-indicator"),
                           (sbt2_edit.disabled = !1),
                              update_contract(), modal_edit.hide();
                              setTimeout(function () {
                                 p_add();
                               }, 500) 
                       }, 2e3)
                   )  
               )
               : Swal.fire({
                   text: "Lo sentimos, parece que se han detectado algunos errores. Vuelve a intentarlo.",
                   icon: "error",
                   buttonsStyling: !1,
                   confirmButtonText: "¡OK!",
                   customClass: { confirmButton: "btn btn-primary" },
                 }).then(function () {
                   KTUtil.scrollTop();
                 });
         });         
       })
  
        );
    },
  };

})();
KTUtil.onDOMContentLoaded(function () {
  KTModalArticuleAdd.init_add();
  KTModalArticuleAdd.init_edit();
});