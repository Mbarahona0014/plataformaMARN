$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 



  consultar("");//con esta llamamos a la funcion de consultar que se realizao abajo para que la cargue al iniciar la pagina

     //$('#myTable').DataTable();
  
//GUARDAR
$('#formespecie').submit(function(){
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
	            url: "../controlador/controllerespecie.php?btnguardar=guardar", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
	            data: $("#formespecie").serialize(),//se obtienen todos los datos del formulario el cual tiene el id='formmarca'
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
  $('#formespecie2').submit(function(){
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
            url: "../controlador/controllerespecie.php?btnmodificar=modificar", //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';)
            data: $("#formespecie2").serialize(),
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

 function llenarCajas(txt,txt2,txt3,txt4,txt5,txt6,txt7){//funcion para mandar datos de la tabla al segundo modal
    document.formespecie2.txtid2.value=txt;
    document.formespecie2.txtcodigo2.value=txt2;
    document.formespecie2.txtgenero2.value=txt3;
    document.formespecie2.txtespecie2.value=txt4;
    document.formespecie2.txtsubespecie2.value=txt5;
    document.formespecie2.txtnombrecomun2.value=txt6;
    document.formespecie2.txtcategoria2.value=txt7;
 }
// suspender
function suspender(id,estado, nombre) {
  Swal.fire({
        position: 'top-end',
        title: estado==1?"¿Activar?":"¿Suspender?",
        text: estado==1?"¿Desea activar la especie "+nombre+"?" :"¿Desea suspender la especie "+nombre+"?",
        icon: "warning",
        showCancelButton: true,
        toast: true,
        confirmButtonText: 'Sí, por favor.',
        cancelButtonText: 'Creo que no...',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
          if (result.isConfirmed) {
          var paren = id
          var dataString = 'id='+paren+'&estado='+estado;
           $.ajax({
            type: "POST",
            url: "../controlador/controllerespecie.php?btnsuspender=suspender",//esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
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
                  title: estado==1?"¡Excelente!, especie activada correctamente":"¡Excelente!, especie desactivada correctamente",
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
      "url": "../controlador/controllerespecie.php?btnconsultar=consultar",
          "type": "POST"
    },          
    "columns": [
      { "data": "codigo" },
      { "data": "genero" },
      { "data": "especie" },
      { "data": "subespecie" },
      { "data": "nombrecomun" },
      { "data": "categoria" },
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
  document.getElementById("formespecie").reset();
}