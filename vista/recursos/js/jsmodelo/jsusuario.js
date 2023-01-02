$(document).ready(function(){
  /*$('#ase').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

   $('#ase2').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});*/

    


   $('#tptipousuario').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

   $('#tptipousuario2').select2({
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
  //consultarcombo2();





  consultar("");



  /*
  if(sessionStorage.getItem('paso1')=='1'){
      html="<button type='button' class='btn btn-warning' onclick='inicio();' >Atras&nbsp;&nbsp;<i class='fa fa-hand-pointer-o' aria-hidden='true'></i></button>";
           $("#btnatras").append(html);
      }*/
	//consultar("");//con esta llamamos a la funcion de consultar que se realizao abajo para que la cargue al iniciar la pagina
//GUARDAR

$('#frmusuario').submit(function(){
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


    /*if($("#txtcodigo").val().length == 0){
                  swal("¡Error al ingresar datos!", "Se debe ingresar un nombre de cliente", "error");
    return false;
  }  */
   

   

  




  if (result.isConfirmed) {
   /*swal("¡Poof, se ha guardado correctamente!", {
				      icon: "success",
				    });*/
      var formData = new FormData(document.getElementById("frmusuario"));
      formData.append("dato", "valor");
 	 	$.ajax({
	            type: "POST",
	            url: "../controlador/controllerusuario.php?btnguardar=guardar", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnGuardar'])?$_GET['btnGuardar']:'';)
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
                  title: '¡Error al ingresar datos!, este correo ya ha sido asignado...',
                  showConfirmButton: false
                }); 
                //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
              }else if (resp=="-3") {
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
                  title: '¡Error al ingresar datos!, este usuario ya ha sido ingresado al sistema...',
                  showConfirmButton: false
                }); 
                //swal("¡Error al ingresar datos!", "Un dato no ha de concordar con el resto, verifique.", "error");  
              }

                   
// PENDIENTE DE VALIDAR LISTAS "ASE" Y TPCLIENTE" ----------------------------
//alert(sessionStorage.getItem('paso1'));
                /*if(sessionStorage.getItem('paso1')=='1'){
                  window.location ='vInicio.php';
                }*/


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
$('#frmusuario2').submit(function(){
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
            /*swal("¡Poof, se ha modificado correctamente!", {
				      icon: "success",
				    });*/
            var formData = new FormData(document.getElementById("frmusuario2"));
            formData.append("dato", "valor");
 	          $.ajax({
                  type: "POST",
                  url: "../controlador/controllerusuario.php?btnmodificar=modificar", //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnModificar'])?$_GET['btnModificar']:'';)
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
                  title: '¡Error al modificar datos!, este usuario ya ha sido ingresado al sistema...',
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

function consultarcombo() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerusuario.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione un tipo de usuario</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tptipousuario").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}
/*function consultarcombo2() {
    $.ajax({
        type: "POST",
            url: "../Controlador/Controllercliente.php?btnConsultar=consultarcb2",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnConsultar=consultarcb2'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value='0'>Seleccione un tipo documento</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tpcliente").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}*/

 function llenarCajas(txt,txt2,txt3,txt4,txt5,txt6,cmb){//funcion para mandar datos de la tabla al segundo modal
    document.frmusuario2.txtid2.value=txt;
    document.frmusuario2.txtcodigo2.value=txt2;
    document.frmusuario2.txtnombre2.value=txt3;
    document.frmusuario2.txtapellido2.value=txt4;
    document.frmusuario2.txtusuarioad2.value=txt5;
    document.frmusuario2.txtcorreo2.value=txt6;


     $.ajax({
        type: "POST",
            url: "../controlador/controllerusuario.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
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

               $("#tptipousuario2").html(html);
            });

            /*document.frmusuario2.txtpoli2.value=txt6;
            document.frmusuario2.txtcert2.value=txt7;
            $.ajax({
               type: "POST",
                   url: "../Controlador/Controllercliente.php?btnConsultar=consultarcb2",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
                   data: 'btnConsultar=consultarcb2'
                   }).done(function(resp) {
                      //alert(resp);
                      var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
                      html="";
                      for (var i = 0; i< valores.length; i++) {

                       if (txt8==valores[i][1]) {
                         html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                       }else{
                         html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                       }

                      }

                      $("#tpcliente2").html(html);
                   });*/
 }

// suspender
function suspender(id,estado,nombre) {
	Swal.fire({
        position: 'top-end',
        title: estado==1?"¿Activar?":"¿Suspender?",
        text: estado==1?"¿Desea activar usuario "+nombre+"?" :"¿Desea suspender usuario "+nombre+"?",
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
            url: "../controlador/controllerusuario.php?btnsuspender=suspender",//esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
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
                  title: estado==1?"¡Excelente!, Usuario activado correctamente":"¡Excelente!, Usuario desactivado correctamente",
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
//CONSULTAR
/*function consultar2(dato) {
    $.ajax({
        type: "POST",
            url: "../Controlador/Controllerempleado.php?btnConsultar=consultar",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'valor='+dato+'&btnConsultar=consultar'
            }).done(function(resp) {
              //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<table class='table'> <thead class='thead' style='background-color:CAAB15;color:#042E3C;''><tr>";
               html+="<th><center>Codigo Empleado</center></th><th><center>Nombre</center></th><th><center>Numero Telefono</center></th><th><center>Cargo</center></th><th><center>Usuario</center></th><th><center>Contraseña</center></th><th><center>Foto</center></th>";
               html+="<th><center>Acci&oacute;n</center></th><th style = 'display: none;'><center>id_cat</center></th></tr> </thead> <tbody class='tbsubcat'>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<tr><td align='center' class='txt'>"+valores[i][0]+"</td><td align='center'>"+valores[i][1]+"</td><td align='center'>"+valores[i][2]+"</td><td align='center'>"+valores[i][3]+"</td><td align='center'>"+valores[i][4]+"</td><td align='center'>"+btoa(valores[i][5])+"";
                   html+="</td><td align='center'><img src='Recursos/images/Empleados/"+valores[i][6]+"' class='foto' id='fototb' name='fototb' height='150' width='150'></td>";
                   html+="<td align='center'><a  height='40' href='"+valores[i][0]+"' class='btn btn-success' data-toggle='modal'";
                   html+="data-target='#modalempleado2' onclick='llenarCajas("+String('"'+valores[i][0]+'"')+","+String('"'+valores[i][1]+'"')+","+String('"'+valores[i][2]+'"')+","+String('"'+valores[i][3]+'"')+","+String('"'+valores[i][4]+'"')+","+String('"'+valores[i][5]+'"')+","+String('"'+valores[i][6]+'"')+");'";
                   html+=">Cargar datos</a>&nbsp;<img src='Recursos/images/sub3.png' id='"+valores[i][0]+"' onclick='suspender("+'"'+valores[i][0]+'"'+");'";
                   html+="widht='34' height='40' class='btn btn-danger btnsuspender' ></td><td style = 'display: none;'>"+valores[i][0]+"</td></tr>";
               }
               html+="</tbody></table>";
               $("#tbempleado").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables
            });
}*/


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
      url: "../controlador/controllerusuario.php?btnconsultar=consultar",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
          "type": "POST"
    },
    "columns": [
      { "data": "codigo" },
      { "data": "nombre" },
      { "data": "apellido" },
      { "data": "usuarioad" },
      { "data": "correo" },
      { "data": "tipo" },
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
  document.getElementById("frmusuario").reset();
  consultarcombo();

}