$(document).ready(function(){


$('#tpinstitucion').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

   $('#tpinstitucion2').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

   //DA ERROR CONSULTARCOMBO
  consultarcombo();


  consultar("");
  //GUARDAR

$('#frmusuarioexterno').submit(function(){
  Swal.fire({
  position: 'top-end',
  title: "¿Guardar?",
  text: "¿Desea guardar los datos ingresados?",
  icon: "warning",
  toast: true,
  showCancelButton: true,
  confirmButtonText: 'Sí, por favor.',
  cancelButtonText: 'Creo que no...',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33'
})
  .then((result) => {


  if (result.isConfirmed) {
   /*swal("¡Poof, se ha guardado correctamente!", {
              icon: "success",
            });*/
      var formData = new FormData(document.getElementById("frmusuarioexterno"));
      formData.append("dato", "valor");
      $.ajax({
              type: "POST",
              url: "../controlador/controllerusuarioexterno.php?btnguardar=guardar", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnGuardar'])?$_GET['btnGuardar']:'';)
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(resp) {
              //swal(resp);
                   
              if (resp=="-1") {
                //alert("xd");
                    Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, un dato no ha de concordar con el resto, verifique.',
                      showConfirmButton: false
                    }); 
                    //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
              }else if(resp=="1"){
                Swal.fire({position: 'top-end',
                  icon: 'success',
                  toast: true,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  },
                  title: '¡Excelente!, Datos ingresados correctamente',
                  showConfirmButton: false
                });
                limpiar();
                consultar("");
                $("[data-dismiss=modal]").trigger({ type: "click" });
                //limpiar();
              }else if (resp=="-2") {

                Swal.fire({position: 'top-end',
                  icon: 'error',
                  toast: true,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  },
                  title: '¡Error al ingresar datos!, este correo ya ha sido asignado...',
                  showConfirmButton: false
                }); 
                //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
              }else if (resp=="-3") {

                Swal.fire({position: 'top-end',
                  icon: 'error',
                  toast: true,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  },
                  title: '¡Error al ingresar datos!, este usuario ya ha sido ingresado al sistema...',
                  showConfirmButton: false
                }); 
                //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
              }

              }

          });
  } 


  else {
    //Swal.fire("Debe de verificar la accion a realizar");
  }
  return false;
  });
  return false;
  });
//MODIFICAR
$('#frmusuarioexterno2').submit(function(){
      Swal.fire({
        position: 'top-end',
        title: "¿Modificar?",
        text: "¿Desea modificar este registro?",
        icon: "warning",
        toast: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, por favor.',
        cancelButtonText: 'Creo que no...',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
          if (result.isConfirmed) {

            var formData = new FormData(document.getElementById("frmusuarioexterno2"));
            formData.append("dato", "valor");
            $.ajax({
                  type: "POST",
                  url: "../controlador/controllerusuarioexterno.php?btnmodificar=modificar", //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnModificar'])?$_GET['btnModificar']:'';)
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(resp) {
                    

                    if (resp=="-1") {
                          Swal.fire({position: 'top-end',
                            icon: 'error',
                            toast: true,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            },
                            title: '¡Error al modificar datos!, un dato no ha de concordar con el resto, verifique.',
                            showConfirmButton: false
                          });
                      
                    }else if(resp=="1"){
                      Swal.fire({position: 'top-end',
                        icon: 'success',
                        toast: true,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        title: '¡Excelente!, Datos modificados correctamente',
                        showConfirmButton: false
                      });
                      consultar("");
                      $("[data-dismiss=modal]").trigger({ type: "click" });
                    }else if (resp=="-2") {
                      //alert("xd");
                      Swal.fire({position: 'top-end',
                        icon: 'error',
                        toast: true,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        title: '¡Error al modificar datos!, este correo ya ha sido asignado...',
                        showConfirmButton: false
                      }); 
                      //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
                    }else if (resp=="-3") {

                        Swal.fire({position: 'top-end',
                          icon: 'error',
                          toast: true,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          },
                          title: '¡Error al ingresar datos!, este usuario ya ha sido ingresado al sistema...',
                          showConfirmButton: false
                        }); 
                        //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
                      }
                  }

            });
  } else {
    //Swal.fire("Debe de verificar la accion a realizar");
  }

  return false;
  });


return false;
});

});

/*function inicio() {
  window.location ='vInicio.php';
}*/

/*function consultarcombo() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerusuarioexterno.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione un tipo de usuario</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tptipousuario").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}*/



function consultarcombo() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerusuarioexterno.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione institución</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tpinstitucion").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

 function llenarCajas(txt,txt2,txt3,txt4,cmb){//funcion para mandar datos de la tabla al segundo modal
    document.frmusuario2.txtid2.value=txt;
    document.frmusuario2.txtnombre2.value=txt2;
    document.frmusuario2.txtapellido2.value=txt3;
    document.frmusuario2.txtcorreo2.value=txt4;


    $.ajax({
        type: "POST",
            url: "../controlador/controllerusuarioexterno.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmb==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }

               $("#tpinstitucion2").html(html);
            });

            
 }

// suspender
function suspender(id,estado,nombre) {
  Swal.fire({
        position: 'top-end',
        title: estado==1?"¿Activar?":"¿Suspender?",
        text: estado==1?"¿Desea activar a "+nombre+"?" :"¿Desea suspender a "+nombre+"?",
        icon: "warning",
        toast: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, por favor.',
        cancelButtonText: 'Creo que no...',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
          if (result.isConfirmed) {
          /*swal("¡Poof, se ha eliminado correctamente!", {
          icon: "success",
        });*/
          var paren = id
          var dataString = 'id='+paren+'&estado='+estado;
           $.ajax({
            type: "POST",
            url: "../controlador/controllerusuarioexterno.php?btnsuspender=suspender",//esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
            //data: dataString,
            data: {id:paren,estado:estado},
            success: function(resp) {
            
              if (resp=="-1") {
                  Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al suspender datos!, un dato no ha de concordar con el resto, verifique.',
                      showConfirmButton: false
                    });
              }else if(resp=="1"){
                Swal.fire({position: 'top-end',
                  icon: 'success',
                  toast: true,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  },
                  title: estado==1?"¡Excelente!, Usuario externo activado correctamente":"¡Excelente!, Usuario externo desactivado correctamente",
                  showConfirmButton: false
                });
                consultar("");
              }
            }
        });
  } else {
    //Swal.fire("Debe de verificar la accion a realizar");
  }
});
}


function notificar(nombre,apellido,correo){


  Swal.fire({
        position: 'top-end',
        title: "¿Notificar contraseña por correo?",
        html: "¿Desea notificar la contraseña temporal a: <b>"+nombre+" "+apellido+"</b> con el correo: <b>"+correo+"</b>?",
        icon: "warning",
        toast: true,
        showCancelButton: true,
        confirmButtonText: 'Sí, por favor.',
        cancelButtonText: 'Creo que no...',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
      if (result.isConfirmed) {

        //let timerInterval
        Swal.fire({
          position: 'top-center',
          title: 'Enviando enlace de recuperación',
          html: 'Espere un momento mientras se envía el correo...',
          toast: false,
          timer: 20000,
          allowOutsideClick: false,
          timerProgressBar: true,
          showConfirmButton: false,
          didOpen: () => {
            Swal.showLoading()
          }
        });

        $.ajax({
          type: "POST",
          url: "send-mailer.php",
          //ACCION 2 SIGNIFICA NOTIFICAR
          data: "correo="+correo+"&accion=2",
          success: function(resp) {

            if(resp=="1")
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
                title: '¡Muy bien!, enlace de recuperación de contraseña enviado correctamente',
                showConfirmButton: false
              });
            }else if(resp=="-1"){
              Swal.fire({position: 'top-end',
                icon: 'error',
                toast: true,
                timer: 2000,
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
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Upps!, este correo no está asociado a ningún usuario...',
                showConfirmButton: false
              });
            }else if(resp=="-4"){
              Swal.fire({position: 'top-end',
                icon: 'error',
                toast: true,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                title: '¡Upps!, debes de activar este usuario para realizar esta acción...',
                showConfirmButton: false
              });
            }
          }
        });
      }
    });

}

function consultar(dato) {

    $('#example').DataTable( {
    "responsive": true,
    "bDeferRender": true,
    "sPaginationType": "full_numbers",
    "bDestroy": true,
    "paging": true,
    "responsive": true,
    "stateSave": true,


    "ajax": {
      url: "../controlador/controllerusuarioexterno.php?btnconsultar=consultar",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
          "type": "POST"
    },
    "columns": [
      { "data": "nombre" },
      { "data": "apellido" },
      { "data": "correo" },
      { "data": "tipo" },
      { "data": "nombreinstitucion" },
      { "data": "acciones" }
      ],
      "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
    "oLanguage": {
            "sProcessing":     "Procesando...",

        "sLengthMenu": 'Mostrar <select>'+
            '<option value="5">5</option>'+
            '<option value="10">10</option>'+
            '<option value="25">25</option>'+
            '<option value="-1">All</option>'+
            '</select> registros',
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando del (_START_ al _END_) de  _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Filtrar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Por favor espere - cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     ">",
            "sPrevious": "<"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        }
  });

}

function limpiar()
{
  document.getElementById("frmusuarioexterno").reset();
  consultarcombo();

}