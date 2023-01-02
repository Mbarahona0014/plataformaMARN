$(document).ready(function(){

  
  $('[data-toggle="tooltip"]').tooltip(); 

   $('#tpareanatural').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});



$('#tpequipotecnico').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});




   $('#tpformaaviso').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});





   $('#tptopografia').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});




   $('#tptenenciapropiedad').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});



  mapa();
  consultarcombo();
  consultarcombo2();
  consultarcombo3();
  consultarcombo4();
  consultarcombo5();
  consultarcheckbox();
  consultartablavegetacion();
  consultartablaextinsion();


  consultar("");




  
//GUARDAR
$('#formregistroincendio').submit(function(){
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
        document.getElementById('btnguardar').disabled = true;
        //let timerInterval
        Swal.fire({
          position: 'top-center',
          title: 'Procesando información',
          html: '<b>Espere un momento mientras se procesa la información...</b>',
          toast: false,
          timer: 6000,
          allowOutsideClick: false,
          timerProgressBar: true,
          showConfirmButton: false,
          didOpen: () => {
            Swal.showLoading()
          }
        });
    var formData = new FormData(document.getElementById("formregistroincendio"));
    $.ajax({
              type: "POST",
              url: "../controlador/controllerincendio.php?btnguardar=guardar", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
              data: formData,//se obtienen todos los datos del formulario el cual tiene el id='formmarca'
              cache: false,
              contentType: false,
              processData: false,
              success: function(resp) {   
                   
              if (resp=="-1") {
                document.getElementById('btnguardar').disabled = false;
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

                document.getElementById('btnfiles').remove();
                $("#files-names").html("");
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
                }).then((result) => {
                  window.location.reload();
                  $(window).scrollTop(0);
                  /*$("#divimagen").load(" #divimagen");
                  limpiar();*/

                });
                /*$("#divimagen").load(" #divimagen");
                  limpiar();*/
                //reload();
                //$("[data-dismiss=modal]").trigger({ type: "click" });


                //LIMPIANDO ARRAY DE IMAGENES AL INSERTAR
                //$("#files-names").html("");
                //limpiar();
              }else if(resp=="-2") {
                document.getElementById('btnguardar').disabled = false;
                  Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, la fecha de inicio del incendio debe de ser menor o igual a la fecha de aviso.',
                      showConfirmButton: false
                    }); 
                  //console.log(resp);
              }
              else if(resp=="-3") {
                document.getElementById('btnguardar').disabled = false;
                  Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, la fecha de finalización del incendio debe de ser mayor a  la fecha de inicio.',
                      showConfirmButton: false
                    }); 
                  //console.log(resp);
              }else if(resp=="-4"){
                document.getElementById('btnguardar').disabled = false;
                Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, por favor seleccione un punto o dibuje un poligono en el mapa.',
                      showConfirmButton: false
                    });
                //limpiar2();
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
//EL BTNMODIFCAR HACE REFERENCIA AL DARLE CLIC YA QUE LE FORMULARIO TIENE EL MISMO NOMBRE PARA MODIFICAR Y ELIMINAR
//PORQUE ASI NO DA ERROR CON TXTNUM Y TXTNUM2
$('#btnmodificar').click(function(){
  $('#formregistroincendio').submit(function(){
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
    Swal.fire({
          position: 'top-center',
          title: 'Procesando información',
          html: '<b>Espere un momento mientras se procesa la información...</b>',
          toast: false,
          timer: 6000,
          allowOutsideClick: false,
          timerProgressBar: true,
          showConfirmButton: false,
          didOpen: () => {
            Swal.showLoading()
          }
        });
 	$.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnmodificar=modificar", //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';)
            data: $("#formregistroincendio").serialize(),
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
                      title: '¡Error al modificar datos!, la fecha de inicio del incendio debe de ser menor o igual a la fecha de aviso.',
                      showConfirmButton: false
                    }); 
                  //console.log(resp);
              }
              else if(resp=="-3") {
                  Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al modificar datos!, la fecha de finalización del incendio debe de ser mayor a  la fecha de inicio.',
                      showConfirmButton: false
                    }); 
                  //console.log(resp);
              }else if(resp=="-4"){
                Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, por favor seleccione un punto o dibuje un poligono en el mapa.',
                      showConfirmButton: false
                    });
                //limpiar2();
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





//AGREGAR IMAGENES AL MODIFICAR IMAGENES
$('#formimagenes').submit(function(){
  Swal.fire({
  position: 'top-end',
  title: "¿Guardar?",
  text: "¿Desea guardar las imágenes ingresadas?",
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
    var formData = new FormData(document.getElementById("formimagenes"));
    //OBTENIENDO ID DE INCENDIO
    var id_incendio=document.formimagenes.id_incendio.value;
    //console.log(idincendio);
    $.ajax({
              type: "POST",
              url: "../controlador/controllerincendio.php?btnmodificar=modificandoagregarImagen", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
              data: formData,//se obtienen todos los datos del formulario el cual tiene el id='formmarca'
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
                  title: '¡Excelente!, Datos ingresados',
                  showConfirmButton: false
                });
                consultar("");
                

                consultarImagenes(id_incendio);
                limpiar2();
              }else if(resp=="-2"){
                Swal.fire({position: 'top-end',
                      icon: 'error',
                      toast: true,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      title: '¡Error al ingresar datos!, debe de seleccionar una imagen.',
                      showConfirmButton: false
                    }); 
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

const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

$("#attachment").on('change', function(e){
  //alert($(this)[0].value);
    var pathImg = $(this)[0].value;
    var extn = pathImg.substring(pathImg.lastIndexOf('.') + 1).toLowerCase();
    //alert(extn);
    if (extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "gif") 
    {

      for(var i = 0; i < this.files.length; i++){
        let fileBloc = $('<span/>', {class: 'file-block'}),
           fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
        fileBloc.append('<span class="file-delete"><span>x</span></span>')
          .append(fileName);
        $("#filesList > #files-names").append(fileBloc);
      };
      // Ajout des fichiers dans l'objet DataTransfer
      for (let file of this.files) {
        dt.items.add(file);
      }
      // Mise à jour des fichiers de l'input file après ajout
      this.files = dt.files;

      // EventListener pour le bouton de suppression créé
      $('span.file-delete').click(function(){
        let name = $(this).next('span.name').text();
        // Supprimer l'affichage du nom de fichier
        $(this).parent().remove();
        for(let i = 0; i < dt.items.length; i++){
          // Correspondance du fichier et du nom
          if(name === dt.items[i].getAsFile().name){
            // Suppression du fichier dans l'objet DataTransfer
            dt.items.remove(i);
            continue;
          }
        }
        // Mise à jour des fichiers de l'input file après suppression
        document.getElementById('attachment').files = dt.files;
      });
    }else if(extn!=""){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Formato de archivo no permitido',
      })
    }
  
});







});




function mapa(){
   require([
        "esri/config",
        "esri/widgets/Sketch",
        "esri/Map",
        "esri/layers/GraphicsLayer",
        "esri/views/MapView",
        "esri/geometry/support/webMercatorUtils"
      ], (esriConfig,Sketch, Map, GraphicsLayer, MapView, webMercatorUtils) => {

        esriConfig.apiKey = "AAPKef9ede26f0c740d193d5c755b343cc6cLsnqlgDd_Brhxyx7Rs0spsNt4lN7m4bYaJjmCyeHv641vljhabvSZ_xd9sxsZ3g2";

        const graphicsLayer = new GraphicsLayer();

        const map = new Map({
          basemap: "osm",
          layers: [graphicsLayer]
        });

        const view = new MapView({
          container: "mapa",
          map: map,
          zoom: 8,
          center: [-89.16097819855285,13.675354279837352]
        });

        view.when(() => {
          const sketch = new Sketch({
            view: view,
            layer: graphicsLayer,
            availableCreateTools: ["point","polygon"],
            snappingOptions: {
            featureEnabled: false,
            enabled: false,
            selfEnabled: false,
            },
          visibleElements: {
            createTools: { polyline: false },
            selectionTools: { "rectangle-selection": false, "lasso-selection": false },
            settingsMenu: false,
          },
            creationMode: "single",
            defaultUpdateOptions: {
              tool: "none",
              enableRotation : false,
              enableScaling: false,
              multipleSelectionEnabled: false,
              toggleToolOnClick: false,
            }
            
          });
          
          sketch.on("create", function(event) {
            //console.log(event);
            if (event.state === "start") {


               //graphicsLayer.remove(event.graphic);
              $("#txtcoordenadas").val("");
              $("#txtlongitud").val("");
              $("#txtlatitud").val("");
              graphicsLayer.removeAll();


            }



            if (event.state === "complete") {

              //$("#txtlongitud").val("");
              // console.log(event.graphic.geometry.toJSON());
              console.log(webMercatorUtils.webMercatorToGeographic(event.graphic.geometry).toJSON());
              const coordenadas = webMercatorUtils.webMercatorToGeographic(event.graphic.geometry).toJSON();

              $("#txtcoordenadas").val(coordenadas.rings);
              //LLENANDO LATITUD Y LONGITUD EN CAJAS DE TEXTO
              $("#txtlongitud").val(coordenadas.x);
              $("#txtlatitud").val(coordenadas.y);

                // for (var key in coordenadas.rings) {
                //     //console.log(coordenadas.rings[key]);
                //     //$("#txtlongitud").val(coordenadas.rings[key]);
                // }

              

              sketch.isFulfilled();

            }
            //
          });

          //sketchWidget.on('update', onSketchUpdated)
          view.ui.add(sketch, "top-right");
        });
      });
 
}







function consultarcombo() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione área natural protegida</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tpareanatural").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

function consultarcombo2() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb2",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb2'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione equipo técnico</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tpequipotecnico").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

function consultarcombo3() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb3",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb3'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value=''>Seleccione forma de aviso</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tpformaaviso").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

function consultarcombo4() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb4",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb4'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value='NULL'>Seleccione topografía</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tptopografia").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

function consultarcombo5() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb5",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb5'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value='NULL'>Seleccione tenencia de la propiedad</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
               }
               $("#tptenenciapropiedad").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

function consultarcheckbox() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcheckbox",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcheckbox'
            }).done(function(resp) {
               var valores = eval(resp);
               html="";
               for (var i = 0; i< valores.length; i++) {
                html+="<label class='checkbox-inline'><div class='checkbox'>";
                html+="<input type='checkbox' id='checkboxca' name='checkboxca[]' value='"+valores[i][0]+"'>"+valores[i][1];
                html+="</div></label>";
                /*if(i>0 && i%3==0){
                    html+="<br>";
                  }*/

               }
               
               $("#checkbox").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}


function consultartablavegetacion() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultartablavegetacion",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultartablavegetacion'
            }).done(function(resp) {
               var valores = eval(resp);
               html="<div class='row' >";

               html+="<div class='col-md-12 text-center' style='margin-bottom: 15px;'><b>Área protegida/  Zona de amortiguamiento</b></div>";
               //caja de texto con valor de length
               document.formregistroincendio.txtnum.value=valores.length;
               for (var i = 0; i< valores.length; i++) {
                
                  html+="<div class='col-md-6' style='margin-bottom: 15px;'>";

                  html+="<div class='text-left col-md-6'>"+valores[i][1]+"</div><div class='text-center col-md-6 '><input type='number' min='0' step='.01' class='form-inline' id='txttipovegareaprot["+(i+1)+"]' name='txttipovegareaprot["+(i+1)+"]' placeholder='' style='width: 60px;'>";
                  html+="<input type='number' min='0' step='.01' class='form-inline' id='txttipovegzonaamort["+(i+1)+"]' name='txttipovegzonaamort["+(i+1)+"]' placeholder='' style='width: 60px;'>";
                  html+="<input type='hidden' class='form-control text-center' id='txtidtipovege' name='txtidtipovege["+(i+1)+"]'' value='"+valores[i][0]+"'></div>";

                  html+="</div>";
                  
                  
              
              }
              html+="</div>";
               $("#tablavegetacion").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}


function consultartablaextinsion() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultartablaextinsion",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultartablaextinsion'
            }).done(function(resp) {
               var valores = eval(resp);
               html="<div class='row' >";
               //caja de texto con valor de length
               document.formregistroincendio.txtnum2.value=valores.length;
               for (var i = 0; i< valores.length; i++) {
                
                  html+="<div class='col-md-6' style='margin-bottom: 15px;'>";
                    
                  html+="<div class='text-left col-md-6'>"+valores[i][1]+"&nbsp;</div><div class='text-left col-md-6 '><input type='number' min='0' class='form-inline' id='txtmedioextcant["+(i+1)+"]' name='txtmedioextcant["+(i+1)+"]' placeholder='' style='width: 60px;'>";
                  html+="<input type='hidden' class='form-control text-center' id='txtidmedioext' name='txtidmedioext["+(i+1)+"]'' value='"+valores[i][0]+"'></div>";

                  html+="</div>";
                  
                  
              
              }
              html+="</div>";
               /*for (var i = 0; i< valores.length; i++) {
                
                  html+="<tr>";
                    
                
                html+="<th><input type='number' class='form-inline' id='"+valores[i][0]+"' name='"+valores[i][0]+"' placeholder='' style='width: 60px;'>&nbsp;"+valores[i][1];

                html+="</tr>";
                  
                  
              
              }*/
               $("#tablaextinsion").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}



 function llenarCajas(txt, cmbareanatural, cmbequipotec, txt4, txt5, txt6, cmbformaaviso, txt7, cmbtopografia, cmbtenencia, txt8, txt9, txt10, txt11){//funcion para mandar datos de la tabla al segundo modal
    document.formregistroincendio.txtid2.value=txt;

    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmbareanatural==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }

               $("#tpareanatural").html(html);
            });

      $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb2",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb2'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmbequipotec==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }

               $("#tpequipotecnico").html(html);
            });
            //alert(txt4.toISOString().slice(0, 16));
    const fechaaviso = new Date(txt4);
    fechaaviso.setMinutes(fechaaviso.getMinutes() - fechaaviso.getTimezoneOffset());

    const fechainicio = new Date(txt5);
    fechainicio.setMinutes(fechainicio.getMinutes() - fechainicio.getTimezoneOffset());

    const fechafin = new Date(txt6);
    fechafin.setMinutes(fechafin.getMinutes() - fechafin.getTimezoneOffset());

    //SI  LA FECHA NO ES REQUIRED SE ARRUINA
    document.formregistroincendio.txtfechaaviso.value=fechaaviso.toISOString().slice(0, 16);
    document.formregistroincendio.txtfechainicio.value=fechainicio.toISOString().slice(0, 16);
    document.formregistroincendio.txtfechafin.value=fechafin.toISOString().slice(0, 16);


    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb3",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb3'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmbformaaviso==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }



               $("#tpformaaviso").html(html);
            });

      document.formregistroincendio.txtubicacionacceso.value=txt7;

        $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb3",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb3'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmbformaaviso==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }



               $("#tpformaaviso").html(html);
            });


          $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb4",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb4'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value='NULL'>Seleccione topografía</option>";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmbtopografia==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }



               $("#tptopografia").html(html);
            });
            

          $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcb5",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcb5'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value='NULL'>Seleccione tenencia de la propiedad</option>";
               for (var i = 0; i< valores.length; i++) {

                //REVISAR TXT5
                if (cmbtenencia==valores[i][0]) {
                  html+="<option value='"+valores[i][0]+"' selected>"+valores[i][1]+"</option>"
                }else{
                  html+="<option value='"+valores[i][0]+"'>"+valores[i][1]+"</option>"
                }

               }



               $("#tptenenciapropiedad").html(html);
            });
      //MODIFICANO
      //alert("xd");
      
      $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcheckboxModifica&IdIncendio="+txt,//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcheckboxModifica'
            }).done(function(resp) {
               var valoresId = eval(resp);
               html2="";
               var vals=[];
               for (var i = 0; i< valoresId.length; i++) {
                  vals[i]=valoresId[i][2];
               }
                //alert(valoresId[i][2]);
                  $.ajax({
                    type: "POST",
                        url: "../controlador/controllerincendio.php?btnconsultar=consultarcheckbox",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
                        data: 'btnconsultar=consultarcheckbox'
                        }).done(function(resp2) {
                          var valores = eval(resp2);
                          //TRAE VALORES PORQUE SELECCIONARON AL MENOS UN VALOR


                          for (var j = 0; j< valores.length; j++) {
                            if (vals.includes(valores[j][0])) {
                                html2+="<label class='checkbox-inline'><div class='checkbox'>";
                                html2+="<input type='checkbox' checked id='checkboxca' name='checkboxca[]' value='"+valores[j][0]+"'>"+valores[j][1];
                                html2+="</div></label>";
                              }else{
                                html2+="<label class='checkbox-inline'><div class='checkbox'>";
                                html2+="<input type='checkbox' id='checkboxca' name='checkboxca[]' value='"+valores[j][0]+"'>"+valores[j][1];
                                html2+="</div></label>";
                              }

                          }

                          
                           
                          //alert(html2);
                          $("#checkbox").html(html2);

                        });
                

            });

      $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultartablavegetacionModifica&IdIncendio="+txt,//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultartablavegetacionModifica'
            }).done(function(resp) {
               var valoresId = eval(resp);
               html3="<div class='row' >";
               html3+="<div class='col-md-12 text-center' style='margin-bottom: 15px;'><b>Área protegida/  Zona de amortiguamiento</b></div>";
               var vals=[];
               for (var i = 0; i< valoresId.length; i++) {
                  html3+="<div class='col-md-6' style='margin-bottom: 15px;'>";
                  html3+="<div class='text-left col-md-6'>"+valoresId[i][5]+"</div><div class='text-center col-md-6 '><input type='number' min='0' step='.01' class='form-inline' id='txttipovegareaprot["+(i+1)+"]' name='txttipovegareaprot["+(i+1)+"]' placeholder='' style='width: 60px;' value="+valoresId[i][3]+">";
                  html3+="<input type='number' min='0' step='.01' class='form-inline' id='txttipovegzonaamort["+(i+1)+"]' name='txttipovegzonaamort["+(i+1)+"]' placeholder='' style='width: 60px;' value="+valoresId[i][4]+">";
                  html3+="<input type='hidden' class='form-control text-center' id='txtidtipovege["+(i+1)+"]' name='txtidtipovege["+(i+1)+"]'' value='"+valoresId[i][1]+"'>";
                  html3+="<input type='hidden' class='form-control text-center' id='txtidreltipovege["+(i+1)+"]' name='txtidreltipovege["+(i+1)+"]'' value='"+valoresId[i][0]+"'></div>";
                  html3+="</div>";
        
                  //vals[i]=valoresId[i][4];
               }
               html3+="</div>";
               $("#tablavegetacion").html(html3); 

      });



      $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultartablamedioextincion&IdIncendio="+txt,//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultartablamedioextincion'
            }).done(function(resp) {
               var valoresId = eval(resp);
               html4="<div class='row' >";
               var vals=[];
               for (var i = 0; i< valoresId.length; i++) {
                  html4+="<div class='col-md-6' style='margin-bottom: 15px;'>";
                  html4+="<div class='text-left col-md-6'>"+valoresId[i][4]+"&nbsp;</div><div class='text-left col-md-6 '><input type='number' min='0' class='form-inline' id='txtmedioextcant["+(i+1)+"]' name='txtmedioextcant["+(i+1)+"]' placeholder='' style='width: 60px;' value="+valoresId[i][3]+">";
                  html4+="<input type='hidden' class='form-control text-center' id='txtidmedioext["+(i+1)+"]' name='txtidmedioext["+(i+1)+"]'' value='"+valoresId[i][1]+"'>";
                  html4+="<input type='hidden' class='form-control text-center' id='txtidrelmedioext["+(i+1)+"]' name='txtidrelmedioext["+(i+1)+"]'' value='"+valoresId[i][0]+"'></div>";
                  html4+="</div>";
        
                  //vals[i]=valoresId[i][4];
               }
               //DA ERROR AL DESCOMENTAR ESTE DIV
                //$html4+="</div>";
                $("#tablaextinsion").html(html4); 

      });


      /*$.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultararchivomodifica&IdIncendio="+txt,//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultararchivomodifica'
            }).done(function(resp) {
               var valores = eval(resp);
               ///alert(valores);
               //html5="";
               const dt = new DataTransfer();
               console.log(valores);
               var vals=[];
               var lista=[];


                  for(var i = 0; i < valores.length; i++){
                    lista[i]=valores[i][1];
                    let fileBloc = $('<span/>', {class: 'file-block'}),
                       fileName = $('<span/>', {class: 'name', text: valores[i][1]});
                    fileBloc.append('<span class="file-delete"><span>x</span></span>')
                      .append(fileName);
                    $("#filesList > #files-names").append(fileBloc);
                  };
                  //console.log(lista);
                  // Ajout des fichiers dans l'objet DataTransfer
                  for (let file of lista) {
                    console.log(file);
                    dt.items.add(file);
                  }
                  // Mise à jour des fichiers de l'input file après ajout
                  this.files = dt.files;

                  // EventListener pour le bouton de suppression créé
                  $('span.file-delete').click(function(){
                    let name = $(this).next('span.name').text();
                    // Supprimer l'affichage du nom de fichier
                    $(this).parent().remove();
                    for(let i = 0; i < dt.items.length; i++){
                      // Correspondance du fichier et du nom
                      if(name === dt.items[i].getAsFile().name){
                        // Suppression du fichier dans l'objet DataTransfer
                        dt.items.remove(i);
                        continue;
                      }
                    }
                    // Mise à jour des fichiers de l'input file après suppression
                    document.getElementById('attachment').files = dt.files;
                  });
 

      });*/


      document.formregistroincendio.txtvelocidadpropagacion.value=txt8;
      document.formregistroincendio.txtcomentarios.value=txt9;
      
      //GOPOSICION=TXT10, SPLIT ES PARA SERARA EL CAMPO DE LA BASE DE DATOS EN CUAL LATITUD Y LONGITUD ESTAN EN EL MISMO CAMPOS
      let geopos = txt10.split(',');
      //console.log(geopos);

      document.formregistroincendio.txtlatitud.value=geopos[0];
      document.formregistroincendio.txtlongitud.value=geopos[1];



      /*require([
        "esri/config",
        "esri/Map",
        "esri/views/MapView",

        "esri/Graphic",
        "esri/layers/GraphicsLayer"

        ], function(esriConfig,Map, MapView, Graphic, GraphicsLayer) {

      esriConfig.apiKey = "AAPKef9ede26f0c740d193d5c755b343cc6cLsnqlgDd_Brhxyx7Rs0spsNt4lN7m4bYaJjmCyeHv641vljhabvSZ_xd9sxsZ3g2";

      const map = new Map({
        basemap: "osm" //Basemap layer service
      });

      const view = new MapView({
        map: map,
        center: [$("#txtlongitud").val(),$("#txtlatitud").val()], //Longitude, latitude
        zoom: 15,
        container: "mapa"
     });

     const graphicsLayer = new GraphicsLayer();
     map.add(graphicsLayer);

     const point = { //Create a point
        type: "point",
        longitude: geopos[1],
        latitude: geopos[0]
     };
     const simpleMarkerSymbol = {
        type: "simple-marker",
        color: [226, 119, 40],  // Orange
        outline: {
            color: [255, 255, 255], // White
            width: 1
        }
     };

     const pointGraphic = new Graphic({
        geometry: point,
        symbol: simpleMarkerSymbol
     });
     graphicsLayer.add(pointGraphic);

     view.on("click", function (event) {
        graphicsLayer.removeAll();
        //console.log(event.x+"-----"+event.y); 
        point.longitude = event.mapPoint.longitude;
        point.latitude = event.mapPoint.latitude;
        console.log(point);
        
        const pointGraphic = new Graphic({
                geometry: point,
                symbol: simpleMarkerSymbol
             });

        graphicsLayer.add(pointGraphic);
        $("#txtlongitud").val(event.mapPoint.longitude);
        $("#txtlatitud").val(event.mapPoint.latitude);
    });


     });*/

     document.formregistroincendio.txtcoordenadas.value=txt11;


          
      


      require([
        "esri/widgets/Sketch",
        "esri/Map",
        "esri/layers/GraphicsLayer",
        "esri/views/MapView",
        "esri/Graphic",
        "esri/geometry/support/webMercatorUtils"
      ], (Sketch, Map, GraphicsLayer, MapView, Graphic, webMercatorUtils) => {
        const graphicsLayer = new GraphicsLayer();

        const map = new Map({
          basemap: "osm",
          layers: [graphicsLayer]
        });

        var centro;

        //TXT11!='' SIGNIFICA QUE ES UN POLIGONO
        if(txt11!='')
        {
          var puntos= new Array();
          //SPLIT DE COORDENADAS
          var arregloCoordenadas=txt11.split(",");
          var acu=0;
          //console.log(arregloCoordenadas);
          //DIVIDO ENTRE DOS EL ARREGLO DE COORDENADAS YA QUE SERA MULTIDIMENSIONAL DE DOS
          for (var i = 0; i < (arregloCoordenadas.length/2); i++) {
            //DENTRO DEL FOR HAGO MULTIDIMENSIONAL EL PRIMER ESPACIO DEL ARRAY
            puntos[(i)]= new Array(2);
            for (var j = 0; j < 2; j++) {
              //HAGO UN ACUMULADOR PARA QUE SUME CADA QUE ENTRA AL SEGUNDO FOR PARA RECORRER EL ARREGLO COORDENADAS COMPLETO
              if (j==1) {
                acu++;
              }
              puntos[i][j]= arregloCoordenadas[(i+acu)];

            }         
          }
          //console.log(puntos[1])
          centro=puntos[0];
          //zoom del mapa para poligono
          zoom=16;
          //console.log(centro);

          //console.log(puntos);
          var polygon = {
            type: "polygon",
            rings: puntos
          };

          var simpleFillSymbol = {
            type: "simple-fill",
            color: [82, 82, 82, 0.4], // gray, opacity 80%
            outline: {
              color: "black",
              width: 2
            }
          };

          var polygonGraphic = new Graphic({
            geometry: polygon,
            symbol: simpleFillSymbol
          });

          graphicsLayer.add(polygonGraphic);
        }else{
          //seteando zoom y centro de view mapa
          centro=[[geopos[1]], [geopos[0]]];
          zoom=18;
          const point = { //Create a point
            type: "point",
            longitude: geopos[1],
            latitude: geopos[0]
         };
           const simpleMarkerSymbol = {
              type: "simple-marker",
              color: [226, 119, 40],
              size: 8,  // Orange
              outline: {
                  color: [255, 255, 255], // White
                  width: 1
              }
           };

           const pointGraphic = new Graphic({
              geometry: point,
              symbol: simpleMarkerSymbol
           });
           graphicsLayer.add(pointGraphic);


        }


        const view = new MapView({
          container: "mapa",
          map: map,
          zoom: zoom,
          center: centro
        });
        
        view.when(() => {
          const sketch = new Sketch({
            view: view,
            layer: graphicsLayer,
            availableCreateTools: ["point","polygon"],
            snappingOptions: {
            featureEnabled: false,
            enabled: false,
            selfEnabled: false,
            },
          visibleElements: {
            createTools: { polyline: false },
            selectionTools: { "rectangle-selection": false, "lasso-selection": false },
            settingsMenu: false,
          },
            creationMode: "single",
            defaultUpdateOptions: {
              tool: "none",
              enableRotation : false,
              enableScaling: false,
              multipleSelectionEnabled: false,
              toggleToolOnClick: false,
            },
            
            
          });

          sketch.on("create", function(event) {
            //console.log(event);
            if (event.state === "start") {

              graphicsLayer.removeAll();
              $("#txtcoordenadas").val("");
              $("#txtlongitud").val("");
              $("#txtlatitud").val("");


            }
            if (event.state === "active") {

              //IsSelfIntersecting(event.graphic.geometry);


            }
            if (event.state === "complete") {

              // console.log(event.graphic.geometry.toJSON());
              console.log(webMercatorUtils.webMercatorToGeographic(event.graphic.geometry).toJSON());
              const coordenadas = webMercatorUtils.webMercatorToGeographic(event.graphic.geometry).toJSON();
              $("#txtcoordenadas").val(coordenadas.rings);
              $("#txtlongitud").val(coordenadas.x);
              $("#txtlatitud").val(coordenadas.y);


            }
            //
          });
          
        
          

          //sketchWidget.on('update', onSketchUpdated)
          view.ui.add(sketch, "top-right");
          });
      });


    
 }
// suspender
function suspender(id,estado,tecnica) {
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
          var paren = id
          var dataString = 'id='+paren+'&estado='+estado;
           $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnsuspender=suspender",//esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
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
                  title: estado==1?"¡Excelente!,  activada correctamente":"¡Excelente!,  desactivado correctamente",
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

function consultarImagenes(IdIncendio){
  $.ajax({
            type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultararchivomodifica&IdIncendio="+IdIncendio,//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultararchivomodifica'
            }).done(function(resp) {
               var valores = eval(resp);
               document.formimagenes.id_incendio.value=IdIncendio;
               ///alert(valores[i][1]);
               //html5="";
               //limpiando lsitado de imagenes en la vista
               $("#files-names").html("");

               html="<div class='row' >";
               
               var vals=[];
               for (var i = 0; i< valores.length; i++) {
                  html+="<div class='col-md-6' style='margin-bottom: 15px;'>";
                  html+="<img src='../vista/recursos/images/incendios/"+valores[i][1]+"'  class='img-responsive'><br><button class='btn btn-danger' onclick='eliminarImagen("+valores[i][0]+","+valores[i][2]+")'>ELIMINAR&nbsp;<i class=\"fa fa-trash\"  style=\"font-size: 15px;\" aria-hidden=\"true\"></i></button>";
                  html+="</div>";
        
                  //vals[i]=valoresId[i][4];
               }
               html+="</div>";
              $("#imagenesListado").html(html); 
               

      });
}

function eliminarImagen(id_imagen,id_incendio){

  Swal.fire({
        position: 'top-end',
        title: "¿Eliminar?",
        text: "¿Desea eliminar esta imagen?",
        icon: "warning",
        showCancelButton: true,
        toast: true,
        confirmButtonText: 'Sí, por favor.',
        cancelButtonText: 'Creo que no...',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
                    type: "POST",
                    url: "../controlador/controllerincendio.php?btnModificar=modificandoImagen&id_imagen="+id_imagen+"&IdIncendio="+id_incendio,//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
                    data: 'btnModificar=modificandoImagen'
                    }).done(function(resp) {
                        if (resp==1) {
                          Swal.fire({position: 'top-end',
                          icon: 'success',
                          toast: true,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          },
                          title: '¡Excelente!, Imagen eliminada correctamente',
                          showConfirmButton: false
                        });
                          consultarImagenes(id_incendio);
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

    //"dom": 'lfrtipB',
   /* "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-5"i><"col-sm-7"p>>',*/
    "buttons": [{
        //Botón para Excel
        "extend": 'excelHtml5',
        "footer": true,
        "title": 'Incendios forestales',
        "filename": 'incendiosForestales',
        "exportOptions": {
                    "columns": [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                },

        //Aquí es donde generas el botón personalizado
        "text": '<button class="btn-dark" style="color: green;"><i class="fa fa-file-excel-o"></i></button>&nbsp;'
      },
      {
        "extend": 'pdfHtml5',
        "footer": true,
        "orientation": 'landscape',
        "pageSize": 'LEGAL',
        "title": 'Incendios forestales',
        "filename": 'incendiosForestalesInfo',
        "exportOptions": {
                    "columns": [ 1, ,2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                },
        "text": '<button class="btn-dark" style="color: red;"><i class="fa fa-file-pdf-o"></i></button>'
      }],

      "dom": "<'row'<'col-md-3'B><'col-md-6'l><'col-md-3'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",

    "columnDefs": [
    { "width": "100px", "targets": 0 }  ],
     

    "ajax": {
      "url": "../controlador/controllerincendio.php?btnconsultar=consultar",
          "type": "POST"
    },          
    "columns": [
      { "data": "acciones" },
      { "data": "IdIncendio"},
      { "data": "AreaNaturalProtegida" },
      { "data": "FechaIncendio" },
      { "data": "hectareasanp" },
      { "data": "hectareasafueraanp" },
      { "data": "VelocidadPropagacion" },
      { "data": "Topografia" },
      { "data": "Tenencia" },
      { "data": "IdInicioFuego" },
      { "data": "nombre" }

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

function limpiar()
{
  document.getElementById("formregistroincendio").reset();
  consultarcombo();
  consultarcombo2();
  consultarcombo3();
  consultarcombo4();
  consultarcombo5();
  consultarcheckbox();
  consultartablavegetacion();
  consultartablaextinsion();
  /*var real = $("#attachment");
  html="<input type='file' name='files[]' accept='image/*' id='attachment'  multiple/>";*/
}

function limpiar2(){
  document.getElementById("formimagenes").reset();
  //AL LIMPIAR HACE COMO QUE LIMIPIA PERO SIMEPRE GUARDA LAS IMAGENES YA INSERTADAS
  //document.getElementById("attachment").value = "";
  //var real = $("#attachment");
  //html="<input type='file' name='files' accept='image/*' id='attachment' style='visibility: hidden;'  multiple/>";
  //AGREGANDO EL MISMO INPUT FILE DE NUEVO
  $("#prueba").load(" #prueba"); 
  //LIMPIANDO LISTADO DE IMAGENES EN LA VSITA SE ARRUINA AL INSERTAR MAS IMAGENES NO LAS AGARRA
  //$("#files-names").html("");
}

function fileValidation(){
    var fileInput = document.getElementById('files');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Debe de seleccionar una imagen con formato .jpeg/.jpg/.png',
        })
        //alert('Please upload file having extensions .jpeg/.jpg/.png only.');
        fileInput.value = '';
        return false;
    }/*else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
*/}



