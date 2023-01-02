$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 

   $('#tppaisaje').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

   $('#tppaisaje2').select2({
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


  consultar("");//con esta llamamos a la funcion de consultar que se realizao abajo para que la cargue al iniciar la pagina

     //$('#myTable').DataTable();
  
//GUARDAR
$('#formindiceisp').submit(function(){
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
	            url: "../controlador/controllerindiceisp.php?btnguardar=guardar", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
	            data: $("#formindiceisp").serialize(),//se obtienen todos los datos del formulario el cual tiene el id='formmarca'
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
                  console.log(resp);
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
              }else if(resp=="-2") {
                  Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, la fecha de inicio debe de ser menor a fecha de finalización.',
                      showConfirmButton: false
                    }); 
                  console.log(resp);
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
  $('#formindiceisp2').submit(function(){
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
            url: "../controlador/controllerindiceisp.php?btnmodificar=modificar", //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';)
            data: $("#formindiceisp2").serialize(),
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
              }else if(resp=="-2") {
                  Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al modificar datos!, la fecha de inicio debe de ser menor a fecha de finalización.',
                      showConfirmButton: false
                    }); 
                  console.log(resp);
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

function consultarcombo() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerindiceisp.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione paisaje</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tppaisaje").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables
               //habilitar caja de texto para escribir nombre del paisaje, la opcion otros tiene id=16
               $('#tppaisaje').change(function (e) {
                  if ($(this).val() === "16") {
                    //$('#miinputotros').html("<input type='text' name='miinputotros' id='miinputotros'");
                    $('#miinputotros').prop("disabled", false);
                  } else {
                    $('#miinputotros').prop("disabled", true);
                    $('#miinputotros').val('');
                    //$('#miinputotros').html("<input type='hidden' name='miinputotros' id='miinputotros'");
                  }
                })

            });
}

 function llenarCajas(txt,txt2,txt3,txt4,txt5,txt6,txt7,txt8,txt9,txt10,txt11,cmb,txt12){//funcion para mandar datos de la tabla al segundo modal
    document.formindiceisp2.txtid2.value=txt;
    document.formindiceisp2.txtica2.value=txt2;
    document.formindiceisp2.txtiq2.value=txt3;
    document.formindiceisp2.txtibp2.value=txt4;
    document.formindiceisp2.txticoe2.value=txt5;
    document.formindiceisp2.txtics2.value=txt6;
    document.formindiceisp2.txtita2.value=txt7;
    document.formindiceisp2.txtirv2.value=txt8;
    document.formindiceisp2.txtigp2.value=txt9;
    document.formindiceisp2.txtfechainicio2.value=txt10;
    document.formindiceisp2.txtfechafin2.value=txt11;
    document.formindiceisp2.miinputotros2.value=txt12;

    $.ajax({
        type: "POST",
            url: "../controlador/controllerindiceisp.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
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


               $("#tppaisaje2").html(html);

               //habilitar caja de texto para escribir nombre del paisaje, la opcion otros tiene id=16

               if(cmb==16){
                //deshabilitando bloqueo de caja si el cmb es otros
                $('#miinputotros2').prop("disabled", false);
               }

               $('#tppaisaje2').change(function (e) {
                  if ($(this).val() === "16") {
                    //$('#miinputotros').html("<input type='text' name='miinputotros' id='miinputotros'");
                    $('#miinputotros2').prop("disabled", false);
                    $('#miinputotros2').val(txt12);
                  } else {
                    $('#miinputotros2').prop("disabled", true);
                    $('#miinputotros2').val('');
                    //$('#miinputotros').html("<input type='hidden' name='miinputotros' id='miinputotros'");
                  }
                })
            });
 }
// suspender
function suspender(id,estado,nombreimpresion) {
  Swal.fire({
        position: 'top-end',
        title: estado==1?"¿Activar?":"¿Suspender?",
        text: estado==1?"¿Desea activar el ISP "+nombreimpresion+"?":"¿Desea suspender el ISP "+nombreimpresion+"?",
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
            url: "../controlador/controllerindiceisp.php?btnsuspender=suspender",//esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
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
                  title: estado==1?"¡Excelente!, índice ISP activado correctamente":"¡Excelente!, índice ISP desactivado correctamente",
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
     
     "buttons": [{
        //Botón para Excel
        "extend": 'excelHtml5',
        "footer": true,
        "title": 'Índice de Sustentabilidad para la Restauración de Paisajes(ISP)',
        "filename": 'indiceISP',
        "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]

                },

        //Aquí es donde generas el botón personalizado
        "text": '<button class="" style="color: green;"><i class="fa fa-file-excel-o"></i></button>&nbsp;'
      },
      {
        "extend": 'pdfHtml5',
        "footer": true,
        //"orientation": 'landscape',
        "pageSize": 'LEGAL',
        "title": 'Índice de Sustentabilidad para la Restauración de Paisajes(ISP)',
        "filename": 'indiceISPInfo',
        "exportOptions": {
                    "columns": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                },
        "text": '<button class="" style="color: red;"><i class="fa fa-file-pdf-o"></i></button>'
      }],

      "dom": "<'row'<'col-md-3'B><'col-md-6'l><'col-md-3'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",

    "ajax": {
      "url": "../controlador/controllerindiceisp.php?btnconsultar=consultar",
          "type": "POST"
    },          
    "columns": [
      { "data": "nombrepaisaje" },
      { "data": "ica" },
      { "data": "iq" },
      { "data": "ibp" },
      { "data": "icoe" },
      { "data": "ics" },
      { "data": "ita" },
      { "data": "irv" },
      { "data": "igp" },
      { "data": "isp" },
      { "data": "fechainicio" },
      { "data": "fechafin" },
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
  document.getElementById("formindiceisp").reset();
  consultarcombo();
}