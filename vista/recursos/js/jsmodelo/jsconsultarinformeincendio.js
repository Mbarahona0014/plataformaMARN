$(document).ready(function(){
	
	consultar(null,null);
    consultarpormes(null,null);
	consultarcausa(null,null);

$('#btnconsultarinforme').click(function() {

	consultar($('#txtfechainicio').val(),$('#txtfechafin').val());
    consultarpormes($('#txtfechainicio').val(),$('#txtfechafin').val());
	consultarcausa($('#txtfechainicio').val(),$('#txtfechafin').val());

});

});



function consultar(fechainicio, fechafin) {

  
    $('#example').DataTable( {  
    "responsive": true,
    "bDeferRender": true,     
    "sPaginationType": "full_numbers",
    "bDestroy": true,
    "paging": true,
    "responsive": true,
    "stateSave": true,

    //"dom": 'lfrtipB',
   /* "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-5"i><"col-sm-7"p>>',*/
    "buttons": [{
        //Botón para Excel
        "extend": 'excelHtml5',
        "footer": true,
        "title": 'Incendios forestales',
        "filename": 'InformeincendioCantidad',
        "exportOptions": {
                    "columns": [ 0, 1, 2 ]
                },

        //Aquí es donde generas el botón personalizado
        "text": '<button class="btn-dark" style="color: green;"><i class="fa fa-file-excel-o"></i></button>&nbsp;'
      },
      {
        "extend": 'pdfHtml5',
        "footer": true,
        //"orientation": 'landscape',
        "pageSize": 'LEGAL',
        "title": 'Incendios forestales',
        "filename": 'incendiosForestalesInfo',
        "exportOptions": {
                    "columns": [ 0, 1, 2 ]
                },
        "text": '<button class="btn-dark" style="color: red;"><i class="fa fa-file-pdf-o"></i></button>'
      }],

      "dom": "<'row'<'col-md-3'B><'col-md-6'l><'col-md-3'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",

    "columnDefs": [
    { "width": "100px", "targets": 0 }  ],
     

    "ajax": {
      "url": "../controlador/controllerincendio.php?btnconsultar=consultarinformecantincendio&txtfechainicio="+fechainicio+"&txtfechafin="+fechafin,
          "type": "POST"
    },          
    "columns": [
      { "data": "AreaNaturalProtegida" },
      { "data": "cantHaAfectadas" },
      { "data": "numIncendiosANP" }

      ],
      "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
      //"dom": 'Blftip',
       
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

function consultarpormes(fechainicio, fechafin) {

  
    $('#example3').DataTable( {  
    "responsive": true,
    "bDeferRender": true,     
    "sPaginationType": "full_numbers",
    "bDestroy": true,
    "paging": true,
    "responsive": true,
    "stateSave": true,

    //"dom": 'lfrtipB',
   /* "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-5"i><"col-sm-7"p>>',*/
    "buttons": [{
        //Botón para Excel
        "extend": 'excelHtml5',
        "footer": true,
        "title": 'Incendios forestales',
        "filename": 'InformeincendioCantidadMensual',
        "exportOptions": {
                    "columns": [ 0, 1, 2, 3 ]
                },

        //Aquí es donde generas el botón personalizado
        "text": '<button class="btn-dark" style="color: green;"><i class="fa fa-file-excel-o"></i></button>&nbsp;'
      },
      {
        "extend": 'pdfHtml5',
        "footer": true,
        //"orientation": 'landscape',
        "pageSize": 'LEGAL',
        "title": 'Incendios forestales',
        "filename": 'incendiosForestalesInfo',
        "exportOptions": {
                    "columns": [ 0, 1, 2, 3 ]
                },
        "text": '<button class="btn-dark" style="color: red;"><i class="fa fa-file-pdf-o"></i></button>'
      }],

      "dom": "<'row'<'col-md-3'B><'col-md-6'l><'col-md-3'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",

    "columnDefs": [
    { "width": "100px", "targets": 0 }  ],
     

    "ajax": {
      "url": "../controlador/controllerincendio.php?btnconsultar=consultarinformecantincendiomensual&txtfechainicio="+fechainicio+"&txtfechafin="+fechafin,
          "type": "POST"
    },          
    "columns": [
      { "data": "nombre" },
      { "data": "AreaNaturalProtegida" },
      { "data": "cantHaAfectadas" },
      { "data": "numIncendiosANP" }

      ],
      "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
      //"dom": 'Blftip',
       
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


function consultarcausa(fechainicio, fechafin) {

  
    $('#example2').DataTable( {  
    "responsive": true,
    "bDeferRender": true,     
    "sPaginationType": "full_numbers",
    "bDestroy": true,
    "paging": true,
    "responsive": true,
    "stateSave": true,

    //"dom": 'lfrtipB',
   /* "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-5"i><"col-sm-7"p>>',*/
    "buttons": [{
        //Botón para Excel
        "extend": 'excelHtml5',
        "footer": true,
        "title": 'Incendios forestales',
        "filename": 'InformeincendioCausa',
        "exportOptions": {
                    "columns": [ 0, 1]
                },

        //Aquí es donde generas el botón personalizado
        "text": '<button class="btn-dark" style="color: green;"><i class="fa fa-file-excel-o"></i></button>&nbsp;'
      },
      {
        "extend": 'pdfHtml5',
        "footer": true,
        //"orientation": 'landscape',
        "pageSize": 'LEGAL',
        "title": 'Incendios forestales',
        "filename": 'incendiosForestalesInfo',
        "exportOptions": {
                    "columns": [ 0, 1]
                },
        "text": '<button class="btn-dark" style="color: red;"><i class="fa fa-file-pdf-o"></i></button>'
      }],

      "dom": "<'row'<'col-md-3'B><'col-md-6'l><'col-md-3'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",

    "columnDefs": [
    { "width": "100px", "targets": 0 }  ],
     

    "ajax": {
      "url": "../controlador/controllerincendio.php?btnconsultar=consultarinformecausaincendio&txtfechainicio="+fechainicio+"&txtfechafin="+fechafin,
          "type": "POST"
    },          
    "columns": [
      { "data": "CausaIncendio" },
      { "data": "cantidad" }
      ],
      "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
      //"dom": 'Blftip',
       
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