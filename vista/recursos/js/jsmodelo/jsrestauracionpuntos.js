//ESTA FUNCION ES PARA ABRIR UN MODAL DENTRO DE OTRO Y QUE EL SCROLL DEL PRIMERO MODAL NO SE ARRUINE
$(document).on("hidden.bs.modal", function (event) {
  if ($(".modal:visible").length) {
    $("body").addClass("modal-open");
  }
});

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();

  $("#cajaespecie").select2({
    tags: true,
    tokenSeparators: [","],
  });

  //LLAMANDO TOKRN
  /*consultarcaja();*/

  $("#tpperiodo").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  $("#tpperiodo2").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  $("#tptecnica").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  $("#tptecnica2").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  $("#tpmunicipio").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  //FALTA
  //COMBOS EN MODIFICAR ESTA BUGEADOS A LA HORA DE BUSCAR POR TEXTO

  $("#tpmunicipio2").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  $("#tpespecie").select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      },
    },
  });

  /*$('#tpmenu2').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});*/

  //DA ERROR CONSULTARCOMBO
  mapa();
  consultarcombo();
  consultarcombotecnica();
  consultarcombo2();
  consultarcbespecie();

  consultar(""); //con esta llamamos a la funcion de consultar que se realizao abajo para que la cargue al iniciar la pagina

  var d = () => {
    if (localStorage.getItem("tagsi") != null) {
      localStorage.removeItem("tagsi");
      localStorage.removeItem("tagsv");
      // localStorage.setItem('tagsi',null)
      $("#lista").html(
        '<div class="alert alert-warning">Ninguna especie ingresada aún...</div>'
      );
    } else {
      $("#lista").html(
        '<div class="alert alert-warning">Ninguna especie ingresada aún...</div>'
      );
    }
  };
  d();

  //$('#myTable').DataTable();

  /*$('#btnmas').click(function(){



  alertafrm();

});  */

  //GUARDAR
  $("#formrestauracionpuntos").submit(function () {
    Swal.fire({
      position: "top-end",
      title: "¿Guardar?",
      text: "¿Desea guardar los datos ingresados?",
      icon: "warning",
      toast: true,
      showCancelButton: true,
      confirmButtonText: "Sí, por favor.",
      cancelButtonText: "Creo que no...",
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
    }).then((result) => {
      if (result.isConfirmed) {
        var formData = new FormData(
          document.getElementById("formrestauracionpuntos")
        );
        /////////////////////OBTENIENDO EL ARRAY DE ESPECIE Y GUARDANDOLO EN LA CAJA DE TEXTO ESPECIE
        var tagasmemoria = JSON.parse(localStorage.getItem("tagsv"));
        //ENTRA SI NO VIENE NULO SINO DARA ERROR
        if (tagasmemoria != null) {
          var textlista = "";
          for (var i = 0; i < tagasmemoria.length; i++) {
            textlista += tagasmemoria[i] + ",";
          }
          //ELIMINANDO EL ULTIMO CARACTER
          textlista = textlista.slice(0, -1);
        }
        //////////////////////////////////////
        //alert(textlista);
        $.ajax({
          type: "POST",
          url:
            "../controlador/controllerrestauracionpuntos.php?btnguardar=guardar&txtlistaespecie=" +
            textlista, //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
          data: formData, //se obtienen todos los datos del formulario el cual tiene el id='formmarca'
          cache: false,
          contentType: false,
          processData: false,
          success: function (resp) {
            if (resp == "-1") {
              Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Error al ingresar datos!, un dato no ha de concordar con el resto, verifique.",
                showConfirmButton: false,
              });
              //Console.console.log(resp);
            } else if (resp == "1") {
              document.getElementById("btnguardar").disabled = true;
              document.getElementById("btnfiles").remove();
              $("#files-names").html("");
              Swal.fire({
                position: "top-end",
                icon: "success",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title: "¡Excelente!, Datos ingresados correctamente",
                showConfirmButton: false,
              }).then((result) => {
                window.location.reload();
                $(window).scrollTop(0);
                //$("#divimagen").load(" #divimagen");
              });
              /*$("#divimagen").load(" #divimagen");
                limpiar();*/
              /*consultar("");
                $("[data-dismiss=modal]").trigger({ type: "click" });
                limpiar();*/
            } else if (resp == "2") {
              //SIGNIFICA QUE INSERTO EL USUARIO EXTERNO
              document.getElementById("btnguardar").disabled = true;
              document.getElementById("btnfiles").remove();
              $("#files-names").html("");
              Swal.fire({
                position: "top-end",
                icon: "info",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Excelente, tú registro ha sido enviado!, Registro en proceso de aprobación",
                showConfirmButton: false,
              }).then((result) => {
                window.location.reload();
                $(window).scrollTop(0);
                //$("#divimagen").load(" #divimagen");
              });
            } else if (resp == "-2") {
              Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Error al ingresar datos!, por favor seleccione un punto o dibuje un poligono en el mapa.",
                showConfirmButton: false,
              });
              //limpiar2();
            }
          },
        });
      } else {
        //Swal.fire("Debe de verificar la accion a realizar");
      }
      return false;
    });
    return false;
  });

  //AGREGAR IMAGENES AL MODIFICAR IMAGENES
  $("#formimagenes").submit(function () {
    Swal.fire({
      position: "top-end",
      title: "¿Guardar?",
      text: "¿Desea guardar las imágenes ingresadas?",
      icon: "warning",
      toast: true,
      showCancelButton: true,
      confirmButtonText: "Sí, por favor.",
      cancelButtonText: "Creo que no...",
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
    }).then((result) => {
      if (result.isConfirmed) {
        var formData = new FormData(document.getElementById("formimagenes"));
        //OBTENIENDO ID DE INCENDIO
        var id_restauracion = document.formimagenes.id_restauracion.value;
        //console.log(idincendio);
        $.ajax({
          type: "POST",
          url: "../controlador/controllerrestauracionpuntos.php?btnmodificar=modificandoagregarImagen", //esto es el mismo boton guardar del controlador =>($page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';)
          data: formData, //se obtienen todos los datos del formulario el cual tiene el id='formmarca'
          cache: false,
          contentType: false,
          processData: false,
          success: function (resp) {
            if (resp == "-1") {
              Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Error al ingresar datos!, un dato no ha de concordar con el resto, verifique.",
                showConfirmButton: false,
              });
              console.log(resp);
            } else if (resp == "1") {
              Swal.fire({
                position: "top-end",
                icon: "success",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title: "¡Excelente!, Datos ingresados correctamente",
                showConfirmButton: false,
              });
              consultar("");

              consultarImagenes(id_restauracion);
              limpiar2();
            } else if (resp == "-2") {
              Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Error al ingresar datos!, debe de seleccionar una imagen.",
                showConfirmButton: false,
              });
            }
          },
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
  $("#formrestauracionpuntos2").submit(function () {
    Swal.fire({
      position: "top-end",
      title: "¿Modificar?",
      text: "¿Desea modificar este registro?",
      icon: "warning",
      toast: true,
      showCancelButton: true,
      confirmButtonText: "Sí, por favor.",
      cancelButtonText: "Creo que no...",
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
    }).then((result) => {
      if (result.isConfirmed) {
        /////////////////////OBTENIENDO EL ARRAY DE ESPECIE Y GUARDANDOLO EN LA CAJA DE TEXTO ESPECIE
        var tagasmemoria = JSON.parse(localStorage.getItem("tagsv"));
        //ENTRA SI NO VIENE NULO SINO DARA ERROR
        if (tagasmemoria != null) {
          var textlista = "";
          for (var i = 0; i < tagasmemoria.length; i++) {
            textlista += tagasmemoria[i] + ",";
          }
          //ELIMINANDO EL ULTIMO CARACTER
          textlista = textlista.slice(0, -1);
        }
        //////////////////////////////////////
        $.ajax({
          type: "POST",
          url:
            "../controlador/controllerrestauracionpuntos.php?btnmodificar=modificar&txtlistaespecie=" +
            textlista, //esto es el mismo boton modificar del controlador =>($page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';)
          data: $("#formrestauracionpuntos2").serialize(),
          success: function (resp) {
            if (resp == "-1") {
              Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Error al modificar datos!, un dato no ha de concordar con el resto, verifique.",
                showConfirmButton: false,
              });
            } else if (resp == "1") {
              Swal.fire({
                position: "top-end",
                icon: "success",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title: "¡Excelente!, Datos modificados correctamente",
                showConfirmButton: false,
              });
              consultar("");
              limpiar2();
              $("[data-dismiss=modal]").trigger({ type: "click" });
            } else if (resp == "-2") {
              Swal.fire({
                position: "top-end",
                icon: "error",
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
                title:
                  "¡Error al ingresar datos!, por favor seleccione un punto o dibuje un poligono en el mapa.",
                showConfirmButton: false,
              });
              //limpiar2();
            }
          },
        });
      } else {
        //Swal.fire("Debe de verificar la accion a realizar");
      }

      return false;
    });

    return false;
  });

  const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

  $("#attachment").on("change", function (e) {
    //alert($(this)[0].value);
    var pathImg = $(this)[0].value;
    var extn = pathImg.substring(pathImg.lastIndexOf(".") + 1).toLowerCase();
    //alert(extn);
    if (extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "gif") {
      for (var i = 0; i < this.files.length; i++) {
        let fileBloc = $("<span/>", { class: "file-block" }),
          fileName = $("<span/>", {
            class: "name",
            text: this.files.item(i).name,
          });
        fileBloc
          .append('<span class="file-delete"><span>x</span></span>')
          .append(fileName);
        $("#filesList > #files-names").append(fileBloc);
      }
      // Ajout des fichiers dans l'objet DataTransfer
      for (let file of this.files) {
        dt.items.add(file);
      }
      // Mise à jour des fichiers de l'input file après ajout
      this.files = dt.files;

      // EventListener pour le bouton de suppression créé
      $("span.file-delete").click(function () {
        let name = $(this).next("span.name").text();
        // Supprimer l'affichage du nom de fichier
        $(this).parent().remove();
        for (let i = 0; i < dt.items.length; i++) {
          // Correspondance du fichier et du nom
          if (name === dt.items[i].getAsFile().name) {
            // Suppression du fichier dans l'objet DataTransfer
            dt.items.remove(i);
            continue;
          }
        }
        // Mise à jour des fichiers de l'input file après suppression
        document.getElementById("attachment").files = dt.files;
      });
    } else if (extn != "") {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Formato de archivo no permitido",
      });
    }
  });
});

function mapa() {
  require([
    "esri/config",
    "esri/widgets/Sketch",
    "esri/Map",
    "esri/layers/GraphicsLayer",
    "esri/views/MapView",
    "esri/geometry/support/webMercatorUtils",
  ], (esriConfig, Sketch, Map, GraphicsLayer, MapView, webMercatorUtils) => {
    esriConfig.apiKey =
      "AAPKef9ede26f0c740d193d5c755b343cc6cLsnqlgDd_Brhxyx7Rs0spsNt4lN7m4bYaJjmCyeHv641vljhabvSZ_xd9sxsZ3g2";

    const graphicsLayer = new GraphicsLayer();

    const map = new Map({
      basemap: "osm",
      layers: [graphicsLayer],
    });

    const view = new MapView({
      container: "mapa",
      map: map,
      zoom: 8,
      center: [-89.16097819855285, 13.675354279837352],
    });

    view.when(() => {
      const sketch = new Sketch({
        view: view,
        layer: graphicsLayer,
        availableCreateTools: ["point", "polygon"],
        snappingOptions: {
          featureEnabled: false,
          enabled: false,
          selfEnabled: false,
        },
        visibleElements: {
          createTools: { polyline: false },
          selectionTools: {
            "rectangle-selection": false,
            "lasso-selection": false,
          },
          settingsMenu: false,
        },
        creationMode: "single",
        defaultUpdateOptions: {
          tool: "none",
          enableRotation: false,
          enableScaling: false,
          multipleSelectionEnabled: false,
          toggleToolOnClick: false,
        },
      });

      sketch.on("create", function (event) {
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
          console.log(
            webMercatorUtils
              .webMercatorToGeographic(event.graphic.geometry)
              .toJSON()
          );
          const coordenadas = webMercatorUtils
            .webMercatorToGeographic(event.graphic.geometry)
            .toJSON();

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

//BUG, PUEDE CERRAR EL MODAL SIN QUE SE CIERRE EL SWEETALERT
/*function alertafrm(){

   Swal.fire({position: 'top-end',

            title: 'Detalle de árboles',

            toast: true,

            showCancelButton: true,

            cancelButtonText: "Cancelar",




            html: '<div class="form-floating text-left"><strong><label>Cantidad:</label></strong><input class= "form-control" type="number" id="txtcantidad" name="txtcantidad" placeholder="Cantidad de árboles" min="1" pattern="^[0-9]+"/></div>'+

                '<style>.select2-dropdown {z-index: 1061;}</style><div class=" text-left" ><strong><label>Especie:</label></strong><select id="tpespecie" name="tpespecie" class="form-control" style="width: 280px;">' +localStorage.getItem("cbespecies")+'</select></div><input type="text">',


           confirmButtonText: "Guardar",

           didOpen: function () {

                        $('#tpespecie').select2({
                              language: {
                              noResults: function() {
                                return "No hay resultado";        
                              },
                              searching: function() {
                                return "Buscando..";
                              }
                            }
                          });


                      },

            preConfirm: () => {



                var cantidad = $('#txtcantidad').val() == "" ? "" : $('#txtcantidad').val();

                var especie = $('#tpespecie').val() == -1 ? "" : $('#tpespecie').val();


                if (cantidad == "" || especie == "") {

                    alertafrm();

                } else {
                  //CODIGO PARA TOKEN
                  var tags = [];
                  var recorrer = [];
                  //console.log(localStorage.getItem('tagsi'));
                  var varia = localStorage.getItem('tagsi');
                  if(varia==null){
                    //console.log("IFFFF");
                    //localStorage.setItem('tagsi',tags); //EL DEL DISEÑO
                    var variablearecorrer=cantidad+'-'+especie;
                    recorrer.push(variablearecorrer);
                    localStorage.setItem('tagsv',JSON.stringify(recorrer)); //EL QUE SE VA GUARDAR
                    tags.push({indice:1, tag:'<li class="list-group-item row"><div class="col-xs-10 "><center><b>Cantidad:</b> '+cantidad+'<br><b>Especie:</b> '+especie+'<br></center></div><div class="col-xs-2 text-left"><input class="btn btn-xs btn-danger" type="button" value="x" onclick="eliminarespeciedetalle(1,\''+cantidad+'\',\''+especie+'\')"  /></div></li>'});

                  }
                  else{
                  recorrer = JSON.parse(localStorage.getItem('tagsv'));
                  tags=JSON.parse(localStorage.getItem('tagsi'));
                  tags.sort((a,b)=>{return b.indice-a.indice});
                  //console.log(tags);
                  tags.push({indice:tags[0].indice+1, tag:'<li class="list-group-item row"><div class="col-xs-10"><center><b>Cantidad:</b> '+cantidad+'<br><b>Especie:</b> '+especie+'<br></center></div><div class="col-xs-2 text-left"><input class="btn btn-xs btn-danger" type="button" value="x" onclick="eliminarespeciedetalle('+(tags[0].indice+1)+',\''+cantidad+'\',\''+especie+'\')" /></div></li>'});

                    var variablearecorrer=cantidad+'-'+especie;
                    recorrer.push(variablearecorrer);
                    localStorage.setItem('tagsv',JSON.stringify(recorrer));

                  }

                  //console.log(tags);
                  var html='';
                  localStorage.setItem('tagsi',JSON.stringify(tags));
                  for (var i = 0; i < tags.length; i++) {

                    html+=tags[i].tag;
                  }
                  $("#lista").html(html)
                  
                }



            }

        });



}*/

function guardardetalleespecie() {
  var cantidad = $("#txtcantidad").val() == "" ? "" : $("#txtcantidad").val();

  var especie = $("#tpespecie").val() == -1 ? "" : $("#tpespecie").val();

  if (
    $("#txtcantidad").val().length == 0 ||
    document.getElementById("tpespecie").value == "seleccionar"
  ) {
    Swal.fire({
      position: "top-end",
      icon: "error",
      toast: true,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
      title:
        "¡Error al agregar detalle de especie!, debe de completar todos los datos",
      showConfirmButton: false,
    });
  } else {
    //CODIGO PARA TOKEN
    var tags = [];
    var recorrer = [];
    //console.log(localStorage.getItem('tagsi'));
    var varia = localStorage.getItem("tagsi");
    if (varia == null) {
      //console.log("IFFFF");
      //localStorage.setItem('tagsi',tags); //EL DEL DISEÑO
      var variablearecorrer = cantidad + "-" + especie;
      recorrer.push(variablearecorrer);
      localStorage.setItem("tagsv", JSON.stringify(recorrer)); //EL QUE SE VA GUARDAR
      tags.push({
        indice: 1,
        tag:
          '<li class="list-group-item row"><div class="col-xs-10 "><center><b>Cantidad:</b> ' +
          cantidad +
          "<br><b>Especie:</b> " +
          especie +
          '<br></center></div><div class="col-xs-2 text-left"><input class="btn btn-xs btn-danger" type="button" value="x" onclick="eliminarespeciedetalle(1,\'' +
          cantidad +
          "','" +
          especie +
          "')\"  /></div></li>",
      });
    } else {
      recorrer = JSON.parse(localStorage.getItem("tagsv"));
      tags = JSON.parse(localStorage.getItem("tagsi"));
      tags.sort((a, b) => {
        return b.indice - a.indice;
      });
      //console.log(tags);
      tags.push({
        indice: tags[0].indice + 1,
        tag:
          '<li class="list-group-item row"><div class="col-xs-10"><center><b>Cantidad:</b> ' +
          cantidad +
          "<br><b>Especie:</b> " +
          especie +
          '<br></center></div><div class="col-xs-2 text-left"><input class="btn btn-xs btn-danger" type="button" value="x" onclick="eliminarespeciedetalle(' +
          (tags[0].indice + 1) +
          ",'" +
          cantidad +
          "','" +
          especie +
          "')\" /></div></li>",
      });

      var variablearecorrer = cantidad + "-" + especie;
      recorrer.push(variablearecorrer);
      localStorage.setItem("tagsv", JSON.stringify(recorrer));
    }

    //console.log(tags);
    var html = "";
    localStorage.setItem("tagsi", JSON.stringify(tags));
    for (var i = 0; i < tags.length; i++) {
      html += tags[i].tag;
    }
    $("#lista").html(html);

    $("#modalespecie").modal("hide"); //ocultamos el modal
    $("body").removeClass("modal-open"); //eliminamos la clase del body para poder hacer scroll
    $(".modal-backdrop").remove(); //eliminamos el backdrop del modal
    document.getElementById("formdetalleespecie").reset();
    consultarcbespecie();
  }
}

function eliminarespeciedetalle(indice, cantidad, especie) {
  //alert(indice);
  //html
  var tags = JSON.parse(localStorage.getItem("tagsi"));
  //db
  var tagasmemoria = JSON.parse(localStorage.getItem("tagsv"));
  var recorrer = [];
  /*  tags.sort((a,b)=>{return b.indice-a.indice});
  console.log(tags);*/
  //var myArray = [{id:1, name:'Morty'},{id:2, name:'Rick'},{id:3, name:'Anna'}];

  var newArray = tags.filter((item) => item.indice != indice);
  //console.log(newArray);
  //console.log(tags);
  var html = "";

  // tags.splice(indice, indi);
  // localStorage.setItem('tagsi', JSON.stringify(tags));

  localStorage.setItem("tagsi", JSON.stringify(newArray));
  tags = JSON.parse(localStorage.getItem("tagsi"));
  for (var i = 0; i < tags.length; i++) {
    html += tags[i].tag;
  }

  localStorage.removeItem("tagsv");
  //ELIMINACION EN MOMERIA PENDIENTE
  for (var i = 0; i < tagasmemoria.length; i++) {
    //alert(tagasmemoria[i]);
    if (tagasmemoria[i] != cantidad + "-" + especie) {
      //FALTA ELIIMINACION
      var variablearecorrer = tagasmemoria[i];
      recorrer.push(variablearecorrer);
    }
  }
  //alert(recorrer);
  localStorage.setItem("tagsv", JSON.stringify(recorrer));

  console.log(JSON.parse(localStorage.getItem("tagsv")));

  //

  if (newArray.length == 0) {
    localStorage.removeItem("tagsi");
    localStorage.removeItem("tagsv");
  }

  if (html == "") {
    $("#lista").html(
      '<div class="alert alert-info">Ninguna especie ingresada aún...</div>'
    );
  } else {
    //alert(tagasmemoria);
    $("#lista").html(html);
  }

  //console.log(tags);
}

function consultarcombo() {
  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcb", //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultarcb",
  }).done(function (resp) {
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html = "<option value=''>Seleccione el período</option>";
    for (var i = 0; i < valores.length; i++) {
      html +=
        "<option value='" + valores[i][0] + "'>" + valores[i][1] + "</option>";
    }
    $("#tpperiodo").html(html); //colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables
  });
}

function consultarcombo2() {
  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcb2", //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultarcb2",
  }).done(function (resp) {
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html = "<option value=''>Seleccione el municipio</option>";
    for (var i = 0; i < valores.length; i++) {
      html +=
        "<option value='" +
        valores[i][2] +
        "'>" +
        valores[i][5] +
        "-" +
        valores[i][2] +
        "</option>";
    }
    $("#tpmunicipio").html(html); //colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables
  });
}

function consultarcbespecie() {
  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcbespecie",
    data: "btnconsultar=consultarcbespecie",
  }).done(function (resp) {
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html =
      "<option value='seleccionar'>Seleccione especie/nombre común</option>";
    for (var i = 0; i < valores.length; i++) {
      html +=
        "<option value='" +
        valores[i][3] +
        "/" +
        valores[i][5] +
        "'>" +
        valores[i][3] +
        "/" +
        valores[i][5] +
        "</option>";
    }
    //$("#tpmunicipio").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables
    $("#tpespecie").html(html);
    //localStorage.setItem("cbespecies", html);
  });
}

function consultarcombotecnica() {
  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcbtecnica", //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultarcbtecnica",
  }).done(function (resp) {
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html = "<option value=''>Seleccione técnica</option>";
    for (var i = 0; i < valores.length; i++) {
      html +=
        "<option value='" +
        valores[i][0] +
        "'>" +
        valores[i][1] +
        " / " +
        valores[i][2] +
        "</option>";
    }
    $("#tptecnica").html(html); //colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables
  });
}

function llenarCajas(
  txt,
  cmbperiodo,
  cmbtecnica,
  cmbmunicipio,
  txt7,
  txt8,
  txt9,
  txt10,
  txt11,
  txt12,
  txt13,
  txt14,
  txt15,
  txt16,
  txt17
) {
  //funcion para mandar datos de la tabla al segundo modal
  document.formrestauracionpuntos2.txtid2.value = txt;

  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcb", //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultarcb",
  }).done(function (resp) {
    //alert(resp);
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html = "";
    for (var i = 0; i < valores.length; i++) {
      //REVISAR TXT5
      if (cmbperiodo == valores[i][0]) {
        html +=
          "<option value='" +
          valores[i][0] +
          "' selected>" +
          valores[i][1] +
          "</option>";
      } else {
        html +=
          "<option value='" +
          valores[i][0] +
          "'>" +
          valores[i][1] +
          "</option>";
      }
    }

    $("#tpperiodo2").html(html);
  });

  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcbtecnica", //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultarcbtecnica",
  }).done(function (resp) {
    //alert(resp);
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html = "";
    for (var i = 0; i < valores.length; i++) {
      //REVISAR TXT5
      if (cmbtecnica == valores[i][0]) {
        html +=
          "<option value='" +
          valores[i][0] +
          "' selected>" +
          valores[i][1] +
          " / " +
          valores[i][2] +
          "</option>";
      } else {
        html +=
          "<option value='" +
          valores[i][0] +
          "'>" +
          valores[i][1] +
          " / " +
          valores[i][2] +
          "</option>";
      }
    }

    $("#tptecnica2").html(html);
  });

  //document.formrestauracionpuntos2.txttecnica2.value=txt2;
  document.formrestauracionpuntos2.txtlongitud2.value = txt16;
  document.formrestauracionpuntos2.txtlatitud2.value = txt17;
  /*document.formrestauracionpuntos2.txtarea2.value=txt5;
    document.formrestauracionpuntos2.txtarboles2.value=txt6;*/

  $.ajax({
    type: "POST",
    url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultarcb2", //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultarcb2",
  }).done(function (resp) {
    //alert(resp);
    var valores = eval(resp); //porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
    html = "";
    for (var i = 0; i < valores.length; i++) {
      //REVISAR TXT5
      if (cmbmunicipio == valores[i][2]) {
        html +=
          "<option value='" +
          valores[i][2] +
          "' selected>" +
          valores[i][5] +
          "-" +
          valores[i][2] +
          "</option>";
      } else {
        html +=
          "<option value='" +
          valores[i][2] +
          "'>" +
          valores[i][5] +
          "-" +
          valores[i][2] +
          "</option>";
      }
    }

    $("#tpmunicipio2").html(html);
  });

  document.formrestauracionpuntos2.txtcanton2.value = txt7;
  document.formrestauracionpuntos2.txtubicacion2.value = txt8;
  document.formrestauracionpuntos2.txtbeneficiarios2.value = txt9;
  document.formrestauracionpuntos2.txtinstituciones2.value = txt10;
  document.formrestauracionpuntos2.txtcantidadpersonas2.value = txt12;
  document.formrestauracionpuntos2.txtcomentarios2.value = txt13;
  document.formrestauracionpuntos2.txtarea2.value = txt14;
  document.formrestauracionpuntos2.txtcoordenadas2.value = txt15;

  require([
    "esri/widgets/Sketch",
    "esri/Map",
    "esri/layers/GraphicsLayer",
    "esri/views/MapView",
    "esri/Graphic",
    "esri/geometry/support/webMercatorUtils",
  ], (Sketch, Map, GraphicsLayer, MapView, Graphic, webMercatorUtils) => {
    const graphicsLayer = new GraphicsLayer();

    const map = new Map({
      basemap: "osm",
      layers: [graphicsLayer],
    });

    var centro;

    //TXT15!='' SIGNIFICA QUE ES UN POLIGONO
    if (txt15 != "") {
      var puntos = new Array();
      //SPLIT DE COORDENADAS
      var arregloCoordenadas = txt15.split(",");
      var acu = 0;
      //console.log(arregloCoordenadas);
      //DIVIDO ENTRE DOS EL ARREGLO DE COORDENADAS YA QUE SERA MULTIDIMENSIONAL DE DOS
      for (var i = 0; i < arregloCoordenadas.length / 2; i++) {
        //DENTRO DEL FOR HAGO MULTIDIMENSIONAL EL PRIMER ESPACIO DEL ARRAY
        puntos[i] = new Array(2);
        for (var j = 0; j < 2; j++) {
          //HAGO UN ACUMULADOR PARA QUE SUME CADA QUE ENTRA AL SEGUNDO FOR PARA RECORRER EL ARREGLO COORDENADAS COMPLETO
          if (j == 1) {
            acu++;
          }
          puntos[i][j] = arregloCoordenadas[i + acu];
        }
      }
      //console.log(puntos[1])
      centro = puntos[0];
      //zoom del mapa para poligono
      zoom = 15;
      //console.log(centro);

      //console.log(puntos);
      var polygon = {
        type: "polygon",
        rings: puntos,
      };

      var simpleFillSymbol = {
        type: "simple-fill",
        color: [82, 82, 82, 0.4], // gray, opacity 80%
        outline: {
          color: "black",
          width: 2,
        },
      };

      var polygonGraphic = new Graphic({
        geometry: polygon,
        symbol: simpleFillSymbol,
      });

      graphicsLayer.add(polygonGraphic);
    } else {
      //seteando zoom y centro de view mapa
      centro = [[txt16], [txt17]];
      zoom = 17;
      const point = {
        //Create a point
        type: "point",
        longitude: txt16,
        latitude: txt17,
      };
      const simpleMarkerSymbol = {
        type: "simple-marker",
        color: [226, 119, 40],
        size: 8, // Orange
        outline: {
          color: [255, 255, 255], // White
          width: 1,
        },
      };

      const pointGraphic = new Graphic({
        geometry: point,
        symbol: simpleMarkerSymbol,
      });
      graphicsLayer.add(pointGraphic);
    }

    const view = new MapView({
      container: "mapa",
      map: map,
      zoom: zoom,
      center: centro,
    });

    view.when(() => {
      const sketch = new Sketch({
        view: view,
        layer: graphicsLayer,
        availableCreateTools: ["point", "polygon"],
        snappingOptions: {
          featureEnabled: false,
          enabled: false,
          selfEnabled: false,
        },
        visibleElements: {
          createTools: { polyline: false },
          selectionTools: {
            "rectangle-selection": false,
            "lasso-selection": false,
          },
          settingsMenu: false,
        },
        creationMode: "single",
        defaultUpdateOptions: {
          tool: "none",
          enableRotation: false,
          enableScaling: false,
          multipleSelectionEnabled: false,
          toggleToolOnClick: false,
        },
      });

      sketch.on("create", function (event) {
        //console.log(event);
        if (event.state === "start") {
          graphicsLayer.removeAll();
          $("#txtcoordenadas2").val("");
          $("#txtlongitud2").val("");
          $("#txtlatitud2").val("");
        }
        if (event.state === "active") {
          //IsSelfIntersecting(event.graphic.geometry);
        }
        if (event.state === "complete") {
          // console.log(event.graphic.geometry.toJSON());
          console.log(
            webMercatorUtils
              .webMercatorToGeographic(event.graphic.geometry)
              .toJSON()
          );
          const coordenadas = webMercatorUtils
            .webMercatorToGeographic(event.graphic.geometry)
            .toJSON();
          $("#txtcoordenadas2").val(coordenadas.rings);
          $("#txtlongitud2").val(coordenadas.x);
          $("#txtlatitud2").val(coordenadas.y);
        }
        //
      });

      //sketchWidget.on('update', onSketchUpdated)
      view.ui.add(sketch, "top-right");
    });
  });

  //OJO, LA LISTA SIEMPRE IRA AL FINAL DE LLENAR CAJAS, ES DECIR DEBO DE SETEAR TODOS LOS VALORES DE LA CAJAS ANTES DE LA LISTA ESPECIE
  //AQUI VAMOS A LLENAR LA LISTA

  //CADA QUE ABRAR EL MODAL DE MODIFICAR SE RESETEARA LA LISTA
  if (localStorage.getItem("tagsi") != null) {
    localStorage.removeItem("tagsi");
    localStorage.removeItem("tagsv");
    // localStorage.setItem('tagsi',null)
    $("#lista").html(
      '<div class="alert alert-warning">Ninguna especie ingresada aún...</div>'
    );
  } else {
    $("#lista").html(
      '<div class="alert alert-warning">Ninguna especie ingresada aún...</div>'
    );
  }

  //VALIDAMOS SI LA LISTA VIENE NULA O VACIA
  if (txt11 != "") {
    var tags = [];
    var recorrer = [];
    //SIGNIFICA QUE TRAE VALOR ESPECIE Y DEBEMOS SETEAR LA LISTA

    //VAMOS A HACER UN SPLIT PARA SEPARAR LA CADENA POR MEDIO DEL CARACTER (, COMA)
    const lista = txt11.split(",");

    for (var i = 0; i < lista.length; i++) {
      //HAREMOS OTRO SPLIT PARA SEPARAR LOS GUIONES Y ASI MOSTRAR LAS LISTAS
      var valores = lista[i].split("-");
      var variablearecorrer = valores[0] + "-" + valores[1];
      recorrer.push(variablearecorrer);
      localStorage.setItem("tagsv", JSON.stringify(recorrer)); //EL QUE SE VA GUARDAR
      tags.push({
        indice: i + 1,
        tag:
          '<li class="list-group-item row"><div class="col-xs-10 "><center><b>Cantidad:</b> ' +
          valores[0] +
          "<br><b>Especie:</b> " +
          valores[1] +
          '<br></center></div><div class="col-xs-2 text-left"><input class="btn btn-xs btn-danger" type="button" value="x" onclick="eliminarespeciedetalle(' +
          (i + 1) +
          ",'" +
          valores[0] +
          "','" +
          valores[1] +
          "')\"  /></div></li>",
      });
    }

    var html = "";
    localStorage.setItem("tagsi", JSON.stringify(tags));
    for (var i = 0; i < tags.length; i++) {
      html += tags[i].tag;
    }
    $("#lista").html(html);

    //usuario=txt11;

    //PD: DEJE LA MISMA LISTA YA QUE ASI NOS AHORRAMOS HACER LA VALIDACION DE INGRESO QUE YA ESTA HECHA ADEMAS COMO SON VISTAS SEPARADAS NO HAY PROBLEMA, SI TE TOCA HACERLO DE NUEVO Y EN UNA MISMA VISTA SI TENES QUE HACER DOS VECES LA LISTA UNA PARA MODIFICAR Y OTRA PARA ELIMINAR
  }
}
// suspender
function suspender(id, estado, tecnica) {
  Swal.fire({
    position: "top-end",
    title: estado == 1 ? "¿Activar?" : "¿Suspender?",
    text:
      estado == 1
        ? "¿Desea activar " + tecnica + "?"
        : "¿Desea suspender " + tecnica + "?",
    icon: "warning",
    showCancelButton: true,
    toast: true,
    confirmButtonText: "Sí, por favor.",
    cancelButtonText: "Creo que no...",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      var paren = id;
      var dataString = "id=" + paren + "&estado=" + estado;
      $.ajax({
        type: "POST",
        url: "../controlador/controllerrestauracionpuntos.php?btnsuspender=suspender", //esto es el mismo boton suspender que esta en el controlador =>($page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';)
        //data: dataString,
        data: { id: paren, estado: estado },
        success: function (resp) {
          //alert(resp);
          if (resp == "-1") {
            Swal.fire({
              position: "top-end",
              icon: "error",
              toast: true,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
              title:
                "¡Error al suspender datos!, un dato no ha de concordar con el resto, verifique.",
              showConfirmButton: false,
            });
          } else if (resp == "1") {
            Swal.fire({
              position: "top-end",
              icon: "success",
              toast: true,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
              title:
                estado == 1
                  ? "¡Excelente!,  activada correctamente"
                  : "¡Excelente!,  desactivada correctamente",
              showConfirmButton: false,
            });
            consultar("");
          }
        },
      });
    } else {
      //Swal.fire("Debe de verificar la accion a realizar");
    }
  });
}

function consultarImagenes(id_restauracion) {
  $.ajax({
    type: "POST",
    url:
      "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultararchivomodifica&id_restauracion=" +
      id_restauracion, //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
    data: "btnconsultar=consultararchivomodifica",
  }).done(function (resp) {
    var valores = eval(resp);
    document.formimagenes.id_restauracion.value = id_restauracion;
    ///alert(valores[i][1]);
    //html5="";
    //limpiando lsitado de imagenes en la vista
    $("#files-names").html("");

    html = "<div class='row' >";
    var vals = [];
    for (var i = 0; i < valores.length; i++) {
      html += "<div class='col-md-6' style='margin-bottom: 15px;'>";
      html +=
        "<img src='../vista/recursos/images/restauracion/" +
        valores[i][1] +
        "'  class='img-responsive'><br><button class='btn btn-danger' onclick='eliminarImagen(" +
        valores[i][0] +
        "," +
        valores[i][2] +
        ')\'>ELIMINAR&nbsp;<i class="fa fa-trash"  style="font-size: 15px;" aria-hidden="true"></i></button>';
      html += "</div>";

      //vals[i]=valoresId[i][4];
    }
    html += "</div>";
    $("#imagenesListado").html(html);
  });
}

function eliminarImagen(id_imagen, id_restauracion) {
  Swal.fire({
    position: "top-end",
    title: "¿Eliminar?",
    text: "¿Desea eliminar esta imagen?",
    icon: "warning",
    showCancelButton: true,
    toast: true,
    confirmButtonText: "Sí, por favor.",
    cancelButtonText: "Creo que no...",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url:
          "../controlador/controllerrestauracionpuntos.php?btnModificar=modificandoImagen&id_imagen=" +
          id_imagen +
          "&id_restauracion=" +
          id_restauracion, //hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
        data: "btnModificar=modificandoImagen",
      }).done(function (resp) {
        if (resp == 1) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            toast: true,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
            title: "¡Excelente!, Imagen eliminada correctamente",
            showConfirmButton: false,
          });
          consultarImagenes(id_restauracion);
        }
      });
    }
  });
}

function consultar(dato) {
  $("#example").DataTable({
    responsive: true,
    bDeferRender: true,
    sPaginationType: "full_numbers",
    bDestroy: true,
    paging: true,
    responsive: true,
    stateSave: true,

    buttons: [
      {
        //Botón para Excel
        extend: "excelHtml5",
        footer: true,
        title: "Restauración",
        filename: "restauracion",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
        },

        //Aquí es donde generas el botón personalizado
        text: '<button class="" style="color: green;"><i class="fa fa-file-excel-o"></i></button>&nbsp;',
      },
      {
        extend: "pdfHtml5",
        footer: true,
        orientation: "landscape",
        pageSize: "LEGAL",
        title: "Restauración",
        filename: "restauracionInfo",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
        },
        text: '<button class="" style="color: red;"><i class="fa fa-file-pdf-o"></i></button>',
      },
    ],

    dom: "<'row'<'col-md-3'B><'col-md-6'l><'col-md-3'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",
    //"dom": '<"dt-buttons"Bfli>rtp',

    columnDefs: [{ width: "100px", targets: 0 }],

    ajax: {
      url: "../controlador/controllerrestauracionpuntos.php?btnconsultar=consultar",
      type: "POST",
    },
    columns: [
      { data: "acciones" },
      { data: "fecha" },
      { data: "id_restauracion" },
      { data: "periodo" },
      { data: "Tecnica" },
      { data: "Tipo" },
      { data: "user" },
      { data: "Municipio" },
      { data: "Canton" },
      { data: "Ubicacion" } /*,
      { "data": "Beneficiarios" },
      { "data": "Instituciones" },
      { "data": "cantidadpersonas" },
      { "data": "comentarios" }*/,
    ],
    lengthMenu: [
      [5, 10, 25, -1],
      [5, 10, 25, "Todos"],
    ],
    oLanguage: {
      sProcessing: "Procesando...",

      sLengthMenu:
        "Mostrar <select>" +
        '<option value="5">5</option>' +
        '<option value="10">10</option>' +
        '<option value="25">25</option>' +
        '<option value="-1">All</option>' +
        "</select> registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando del (_START_ al _END_) de  _TOTAL_ registros",
      sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Filtrar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Por favor espere - cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: ">",
        sPrevious: "<",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
}

function limpiar() {
  document.getElementById("formrestauracionpuntos").reset();
  consultarcombo();
  consultarcombo2();
}

//DESHABILITAR ENTER EN TEXTAREA
function pulsar(e) {
  if (e.which === 13 && !e.shiftKey) {
    e.preventDefault();
    //console.log('prevented');
    return false;
  }
}

function fileValidation() {
  var fileInput = document.getElementById("files");
  var filePath = fileInput.value;
  var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
  if (!allowedExtensions.exec(filePath)) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Debe de seleccionar una imagen con formato .jpeg/.jpg/.png",
    });
    //alert('Please upload file having extensions .jpeg/.jpg/.png only.');
    fileInput.value = "";
    return false;
  } /*else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
*/
}

function limpiar2() {
  document.getElementById("formimagenes").reset();
  //AL LIMPIAR HACE COMO QUE LIMIPIA PERO SIMEPRE GUARDA LAS IMAGENES YA INSERTADAS
  /*  document.getElementById("attachment").value = "";
  var real = $("#attachment");
  html="<input type='file' name='files[]' accept='image/*' id='attachment' style='visibility: hidden;'  multiple/>";*/
  //AGREGANDO EL MISMO INPUT FILE DE NUEVO
  $("#prueba").load(" #prueba");
  //LIMPIANDO LISTADO DE IMAGENES EN LA VSITA SE ARRUINA AL INSERTAR MAS IMAGENES NO LAS AGARRA
  /*$("#files-names").html("");*/
}

//EJEMPLO DE TOKEN
/*function consultarcaja() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerrestauracionpuntos.php?btnConsultar=consultarcaja",
            data: 'btnConsultar=consultarcaja'
            }).done(function(resp) {
               //alert(resp);
               var valores = eval(resp);
               html="<option value='0'>Seleccione la especie</option>";  
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][1]+"'>"+valores[i][1]+"</option>"
               }
               $("#cajaespecie").html(html);
               
            });
}*/
