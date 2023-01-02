$(document).ready(function(){
  

$('#frmsesion').submit(function(){
//$('#btnsesion').click(function(){
  
var formData = new FormData(document.getElementById("frmsesion"));
      formData.append("dato", "valor");

    $.ajax({
              type: "POST",
              url: "../controlador/controllersesion.php?btnsesion=inicio", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnGuardar'])?$_GET['btnGuardar']:'';)
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              
              success: function(resp) {
                
                
               // alert(resp);
                if (resp=="0") {
                  Swal.fire({position: 'top-end',
                    icon: 'error',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                    title: '¡Error al iniciar sesión!, El usuario ingresado no existe',
                    showConfirmButton: false
                  });
                }else if(resp=="1" || resp=="6"){
                  //ROL ADMINISTRADOR=1
                  //ROL INTERNO/INCENDIO/RESTAURACION=6
                  $.ajax({
                        type: "POST",
                        url: "../controlador/controllersesion.php?btnsesioninterna=sesioninterna", 
                        data: $("#frmsesion").serialize(),
                        success: function(resp) {

                          if(resp=="1"){
                            Swal.fire({position: 'top-end',
                              icon: 'success',
                              toast: true,
                              timer: 2000,
                              timerProgressBar: true,
                              didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                              },

                              title: '¡Inicio de sesión correcto!, Un gusto saber de tí.',
                              //title: '¡Bienvenido!',
                              showConfirmButton: false
                            }).then((value) => {
                              location.assign("vinicio.php");
                            });
                          }else{
                              Swal.fire({position: 'top-end',
                                icon: 'error',
                                toast: true,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                  toast.addEventListener('mouseenter', Swal.stopTimer)
                                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                                },
                                title: '¡Error al iniciar sesión!, La contraseña del usuario ingresado es incorrecta.',
                                showConfirmButton: false
                              });
                            }

                        }
                  });

                }else if(resp=="2"){

                  //ROL USUARIO EXTERNO
                  Swal.fire({position: 'top-end',
                    icon: 'success',
                    toast: true,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },

                    title: '¡Inicio de sesión correcto!, Un gusto saber de tí.',
                    //title: '¡Bienvenido!',
                    showConfirmButton: false
                  }).then((value) => {
                    location.assign("vdetallepuntoexterno.php");
                  });
                  
                }else if(resp=="3"){
                  Swal.fire({position: 'top-end',
                    icon: 'error',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                    title: '¡Error al iniciar sesión!, La contraseña del usuario ingresado es incorrecta.',
                    showConfirmButton: false
                  });
                }else if(resp=="4" || resp=="9"){
                  Swal.fire({position: 'top-end',
                    icon: 'error',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                    title: '¡Error al iniciar sesión!, Usuario deshabilitado. Contacta con un Administrador.',
                    showConfirmButton: false
                  });

                }//PENDEINTE DE CAMBIAR CONTRASEÑA
                else if(resp=="5"){
                  
                  var correo=$('#usuario').val();
                  alertarcambiocontra(correo);
                }
              }

          });
      return false;
    });



  $('#btnrecuperarcontra').click(function(){
      
    //alertarecuperacion();
    Swal.fire({
        title: "¿Olvidaste tú contraseña?",
        input: "email",
        toast: true,
        showCancelButton: true,
        inputLabel: 'Digita el correo asociado a tú cuenta',
        inputPlaceholder: 'Correo electrónico',
        cancelButtonText: "Cancelar",
        confirmButtonText: "Enviar enlace de recuperación.",
        /*inputValidator: correo => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!correo) {
                return "Por favor ingrese el correo electrónico...";
            } else {
                return undefined;
            }
        },*/
        validationMessage:"Por favor ingrese un correo electrónico válido..."
    })
    .then(resultado => {
      if (resultado.value) {
        let correo = resultado.value;
          //SWAL TEMPORAL MIENTRAS SE ENVIA CORREO
          /*Swal.fire({position: 'top-end',
                icon: 'info',
                toast: true,
                timer: 3500,
                //timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: 'Enviando correo...',
                showConfirmButton: false
              });*/
        /*console.log("Hola, " + correo);*/

        //let timerInterval
        Swal.fire({
          title: 'Enviando enlace de recuperación',
          html: '<b>Espere un momento mientras se envía el correo...</b>',
          timer: 20000,
          allowOutsideClick: false,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
          }
        });

        //1 = RECUPERAR, 2=NOTIFICAR, EN ESTE CASO ACCION=1

          //alert(correo);
        $.ajax({
          type: "POST",
          url: "send-mailer.php",
          //data: "correo="+correo+"&accion=1",
          data: {correo:correo,accion:1},
          success: function(resp){
            //alert(resp);

            if(resp=="1")
            {
              Swal.fire({position: 'top-end',
                icon: 'success',
                toast: true,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Muy bien!, enlace de recuperación de contraseña enviado correctamente, por favor revise su correo...',
                showConfirmButton: false
              });
            }else if(resp=="-1"){
              Swal.fire({position: 'top-end',
                icon: 'error',
                toast: true,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Upps!, no se pudo enviar el enlace de recuperación...',
                showConfirmButton: false
              });
            }else if(resp=="-2"){
              Swal.fire({position: 'top-end',
                icon: 'error',
                toast: true,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Upps!, este correo no está asociado a ningún usuario...',
                showConfirmButton: false
              });
            }else if(resp=="-3"){
              Swal.fire({position: 'top-end',
                icon: 'error',
                toast: true,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Upps!, el correo ingresado es interno del MARN',
                showConfirmButton: false
              });
            }else if(resp=="-4"){
              Swal.fire({position: 'top-end',
                icon: 'error',
                toast: true,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Upps!, Usuario deshabilitado. Contacta con un Administrador.',
                showConfirmButton: false
              });
            }
          }
        });//FIN DE AJAX
      }
    });
  });
});


async function alertarcambiocontra(correo){
  const { value: formValues } = await Swal.fire({
          title: 'CAMBIO DE CONTRASEÑA',
          toast: true,
          cancelButtonText: "Cancelar",
          html:
            '<b>Ingrese su nueva contraseña... </b><br><b><br>La contraseña '+
            'debería cumplir con los siguientes requerimientos:</b><br>'+
            '<ul><li id="letter">Al menos debería tener <strong>una letra</strong></li>'+
            '<li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong></li>'+
            '<li id="number">Al menos debería tener <strong>un número</strong></li>'+
            '<li id="length">Debería tener <strong>6 carácteres</strong> como mínimo</li></ul><br>'+
            '<input id="swal-input1" type="password" placeholder="Nueva contraseña" class="swal2-input">' +
            '<input id="swal-input2" type="password" placeholder="Confirmar contraseña" class="swal2-input">',
          focusConfirm: false,
          preConfirm: () => {
            return [
              document.getElementById('swal-input1').value,
              document.getElementById('swal-input2').value
            ]
          }
        })

        if (formValues) {


          if (formValues[0]==formValues[1]) {

            //Swal.fire("se pudo");
            var pswd = formValues[0];
            var pdt='';
            if(pswd=='')
            {
              pdt+=" Contraseña no debe ir vacía.\n";
              pswd='vacio';
            }

            if ( pswd.length <= 6  && pswd!='vacio') {
              pdt+=" La contraseña debe contener al menos 6 caracteres.\n";
            }
            if ( !(pswd.match(/[A-z]/)) && pswd!='vacio') 
            {
              pdt+=" La contraseña debe contener al menos un carácter.\n";
            }
            if ( !(pswd.match(/[A-Z]/)) && pswd!='vacio') {
              pdt+=" La contraseña debe contener al menos una mayúscula.\n";
            }
            if ( !(pswd.match(/\d/)) && pswd!='vacio') {
              pdt+=" La contraseña debe contener al menos un número.\n";
            }

            if(pdt!=''){
              var concat='Error:\n';
              Swal.fire({//position: 'top-end',
                    icon: 'warning',
                    toast: true,
                    /*timer: 1500,
                    timerProgressBar: true,*/
                    /*didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },*/
                    title: concat+pdt,
                    showConfirmButton: true
                  }).then(resultado => {
                    alertarcambiocontra(correo);
                  });
              }else{

                  //SWAL PARA ALERTA DE CARGA
                  //let timerInterval
                  Swal.fire({
                    position: 'top-center',
                    title: 'Cargando...',
                    html: '<b>Espere un momento, por favor.</b>',
                    toast: false,
                    timer: 20000,
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    didOpen: () => {
                      Swal.showLoading()
                    }
                  });

                //alert("todo bien");
                $.ajax({
                  type: "POST",
                  url: "send-mailer.php",
                  //ACCION 3 SIGNIFICA QUE YA CAMBIO CONTRASEÑA
                  //data: "correo="+correo+"&cambiocontra="+pswd+"&accion=3",
                  data: {correo:correo,cambiocontra:pswd,accion:3},
                  
                  success: function(resp) {

                    if(resp=="3")
                    {
                        Swal.fire({position: 'top-end',
                          icon: 'success',
                          toast: true,
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          },

                          title: '¡Inicio de sesión correcto!',
                          //title: '¡Bienvenido!',
                          showConfirmButton: false
                        }).then((value) => {
                          location.assign("vdetallepuntoexterno.php");
                        });
                    }

                  }
                });//FIN AJAX

              }

          }else{
            //Swal.fire("la contra no coincide");

            Swal.fire({//position: 'top-end',
              icon: 'error',
              toast: true,
              //timer: 1500,
              //timerProgressBar: true,
              /*didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              },*/
              title: 'Error: ¡Las contraseñas no coinciden!',
              showConfirmButton: true
            }).then(resultado => {
              alertarcambiocontra(correo);
            });
          }

        }
      
}

