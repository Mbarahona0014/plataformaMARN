$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 



  consultar("");//con esta llamamos a la funcion de consultar que se realizao abajo para que la cargue al iniciar la pagina

     //$('#myTable').DataTable();
  
//GUARDAR
$('#formtecnica').submit(function(){
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
 	 	$.ajax({
	            type: "POST",
	            url: "../controlador/controllertecnica.php?btnguardar=guardar", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
	            data: $("#formtecnica").serialize(),//se obtienen todos los datos del formulario el cual tiene el id='formmarca'
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
                      title: '¡Error al ingresar datos!, un dato no ha de concordar con el resto, verifique.',
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
                  title: '¡Excelente!, Datos ingresados correctamente',
                  showConfirmButton: false
                });
                consultar("");
                $("[data-dismiss=modal]").trigger({ type: "click" });
                limpiar();
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


//MODIFICAR
//$('#btnmodificar').click(function(){
  $('#formtecnica2').submit(function(){
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
      })
.then((result) => {
  if (result.isConfirmed) {
 	$.ajax({
            type: "POST",
            url: "../controlador/controllertecnica.php?btnmodificar=modificar", //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';)
            data: $("#formtecnica2").serialize(),
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

 function llenarCajas(txt,txt2,txt3){//funcion para mandar datos de la tabla al segundo modal
    document.formtecnica2.txtidtecnica2.value=txt;
    document.formtecnica2.txtusosuelo2.value=txt2;
    document.formtecnica2.txttecnica2.value=txt3;
 }
// suspender
function suspender(idtecnica,estado, tecnica) {
  Swal.fire({
        position: 'top-end',
        title: estado==1?"¿Activar?":"¿Suspender?",
        text: estado==1?"¿Desea activar "+tecnica+"?" :"¿Desea suspender "+tecnica+"?",
        icon: "warning",
        showCancelButton: true,
        toast: true,
        confirmButtonText: 'Sí, por favor.',
        cancelButtonText: 'Creo que no...',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
          if (result.isConfirmed) {
          var paren = idtecnica
          var dataString = 'idtecnica='+paren+'&estado='+estado;
           $.ajax({
            type: "POST",
            url: "../controlador/controllertecnica.php?btnsuspender=suspender",//esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
            //data: dataString,
            data: {id:paren,estado:estado},
            success: function(resp) {            
                //alert(resp);
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
                  title: estado==1?"¡Excelente!, tecnica activada correctamente":"¡Excelente!, tecnica desactivada correctamente",
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
      "url": "../controlador/controllertecnica.php?btnconsultar=consultar",
          "type": "POST"
    },          
    "columns": [
      { "data": "UsoSuelo" },
      { "data": "Tecnica" },
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
  document.getElementById("formtecnica").reset();
}