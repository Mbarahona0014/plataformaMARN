$(document).ready(function(){


$('#tpfechaincendio').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

$('#tpmostrar').select2({
    language: {

    noResults: function() {

      return "No hay resultado";        
    },
    searching: function() {

      return "Buscando..";
    }
  }
});

$( "#bajar" ).click(function(event) {
  event.preventDefault();
  //Creamos el string del enlace ancla
  var codigo = "#" + $(this).data("ancla");
  //Funcionalidad de scroll lento para el enlace ancla en 3 segundos
  $("html,body").animate({scrollTop: $(codigo).offset().top}, 3000);
});


consultarpoints();
consultarcombofechaincendio();
consultarpointscoordenadas();
vmapa();


});

function consultarcombofechaincendio() {
    $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarcbfechaincendio",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarcbfechaincendio'
            }).done(function(resp) {
               var valores = eval(resp);//porque eval? eval sirve para desconponer un JSON en una matriz totalmente manejable
               html="<option value='all'>Todos</option>";
               for (var i = 0; i< valores.length; i++) {
                   html+="<option value='"+valores[i][0]+"'>"+valores[i][0]+"</option>"
               }
               $("#tpfechaincendio").html(html);//colocamos todo nuestro codigo HTML en nuestra pagina con esta linea, aunque si se fijan concatenamos un par de variables

            });
}

function consultarpoints()
{

  $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarpoints",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarpoints'
            }).done(function(resp) {
              

            });

}

function consultarpointscoordenadas()
{

  $.ajax({
        type: "POST",
            url: "../controlador/controllerincendio.php?btnconsultar=consultarpointscoordenadas",//hasta para consultar tenemos un boton imaginario en el controlador  => ($page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';)
            data: 'btnconsultar=consultarpointscoordenadas'
            }).done(function(resp) {
              

            });

}

var kml=[];

function vmapa(){
  
      //var map;
      require([
        "esri/Map",
        "esri/layers/FeatureLayer",
        "esri/layers/GeoJSONLayer",
/*        "esri/layers/KMLLayer",*/
        "esri/views/MapView",
        "esri/widgets/Legend",
        "esri/widgets/Expand",
        "esri/widgets/Home",
        "esri/renderers/SimpleRenderer",
      ], (Map, FeatureLayer, GeoJSONLayer, MapView, Legend, Expand, Home, SimpleRenderer) => {
        // Configures clustering on the layer. A cluster radius
        // of 100px indicates an area comprising screen space 100px
        // in length from the center of the cluster

        const clusterConfig = {
          type: "cluster",
          clusterRadius: "100px",
          // {cluster_count} is an aggregate field containing
          // the number of features comprised by the cluster
          popupTemplate: {
            title: "Incendios",
            content: "Una cantidad de {cluster_count} Incendios en este punto.",
            fieldInfos: [
              {
                fieldName: "cluster_count",
                format: {
                  places: 0,
                  digitSeparator: true
                }
              }
            ]
          },
          clusterMinSize: "24px",
          clusterMaxSize: "60px",
          labelingInfo: [
            {
              deconflictionStrategy: "none",
              labelExpressionInfo: {
                expression: "Text($feature.cluster_count, '#,###')"
              },
              symbol: {
                type: "text",
                color: "white",
                font: {
                  weight: "bolder",
                  family: "Arial",
                  size: "16px"
                }
              },
              labelPlacement: "center-center"
            }
          ]
        };

        const renderer = new SimpleRenderer({
          symbol: {
            type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
            color: "#DC352F",
            outline: {
              color: "black",
              width: 0
            },
            size: 6.5
          }
        });

      const renderer2 = {
        type : "simple",
        symbol : {
            type : "simple-fill",
            color: [82, 82, 82, 0.9], // gray, opacity 80%
            outline: {
              color: "black",
              width: 4
            }
        }};

        const layer = new GeoJSONLayer({
          title: "mapa",
          url:"../controlador/controllerincendio.php?btnconsultar=consultarpoints",
          //url:"points.php",

          featureReduction: clusterConfig,
          renderer : renderer,
        });
        //

        const layer2 = new GeoJSONLayer({
          title: "mapa",
          url:"../controlador/controllerincendio.php?btnconsultar=consultarpointscoordenadas",

          //url:"points.php",

          //featureReduction: clusterConfig,
          renderer : renderer2, 
            opacity : 0.70,
            geometryType : "polygon",
        });

        /*var simpleFillSymbol = {
            type: "simple-fill",
            color: [82, 82, 82, 0.4], // gray, opacity 80%
            outline: {
              color: "black",
              width: 2
            }
          };*/

        $( "#tpfechaincendio" ).change(function() {
          if(!($( "#tpfechaincendio" ).val()=='all')){
            var fecha="'%"+$( "#tpfechaincendio" ).val()+"%'";
            layer.definitionExpression = "fecha like "+fecha;
            layer2.definitionExpression = "fecha like "+fecha;
          }else{
            layer.definitionExpression = null;
            layer2.definitionExpression = null;
          }
        });

        $( "#tpmostrar" ).change(function() {
          //FILTRANDO TIPO DE GRAFICO POR POLIGONO O PUNTOS
          if(!($( "#tpmostrar" ).val()=='all')){

            if(cod = document.getElementById("tpmostrar").value=="poligonos")
            {
              map.remove(layer);
              map.add(layer2);
            }
            else if(cod = document.getElementById("tpmostrar").value=="puntos")
            {
              map.remove(layer2);
              map.add(layer);
            }else if(cod = document.getElementById("tpmostrar").value=="todos")
            {
              map.remove(layer);
              map.remove(layer2);
              map.add(layer);
              map.add(layer2);
            }
              //map.removeAll();
            /*alert("xd")
            map.remove(layer);
            //map.removeAll();
            //layer.removeAll();

            //map.remove(layer2);
            alert("xd2222")
            graphicsLayer.removeAll();*/
          
            
          }
        });
        

        layer.popupTemplate = {
            title: "<b>{nombre}</b>",
            content: "<p>Dentro de la fecha {fecha}, ocurrió un incendio, con base al siguiente detalle:</p><ul><li><b>Área Natural Protegida: </b>{AreaNaturalProtegida}</li><li><b>Hectáreas afectadas en ANP: </b>{hectareasanp}</li><li><b>Hectáreas afectadas fuera de ANP: </b>{hectareasafueraanp}</li><li><b>Finalización de incendio: </b>{FechaFinalizacion}</li><ul>"
            };

        layer2.popupTemplate = {
            title: "<b>{nombre}</b>",
            content: "<p>Dentro de la fecha {fecha}, ocurrió un incendio, con base al siguiente detalle:</p><ul><li><b>Área Natural Protegida: </b>{AreaNaturalProtegida}</li><li><b>Hectáreas afectadas en ANP: </b>{hectareasanp}</li><li><b>Hectáreas afectadas fuera de ANP: </b>{hectareasafueraanp}</li><li><b>Finalización de incendio: </b>{FechaFinalizacion}</li><ul>"
            };

        /*var layer1 = new KMLLayer({
          url:
            "http://apps3.marn.gob.sv/geocumplimiento/restauracion/registro/SitiosRamsar.kmz"            
        });*/

       

        const map = new Map({
          basemap: "osm",
          layers: [layer, layer2],
        });


        const view = new MapView({
          container: "viewDiv",
          map: map
        });

        view.center = [-88.2,13.70];  // Sets the center point of the view at a specified lon/lat
        view.zoom = 9; 

        view.ui.add(
          new Home({
            view: view
          }),
          "top-left"
        );

        const legend = new Legend({
          view: view,
          container: "legendDiv"
        });

        const infoDiv = document.getElementById("infoDiv");
        view.ui.add(
          new Expand({
            view: view,
            content: infoDiv,
            expandIconClass: "esri-icon-layer-list",
            expanded: false
          }),
          "top-left"
        );

         view.ui.add("btnAbajo", "top-right");

        


        const toggleButton = document.getElementById("cluster");

        html='';
        for (var i = 1; i < 5; i++) {
          if(i== 1){
            html+='<input type="checkbox" name="option1" onclick="DATOS('+i+');" id="option1" value="Yes"> <span class="opcion">Sitios Ramsar</span><br>';
          }
          if(i== 2){
            html+='<input type="checkbox" name="option2" onclick="DATOS('+i+');" id="option2" value="Yes"> <span class="opcion">Areas Naturales Protegidas</span> <br>';
          }
          if(i== 3){
            html+='<input type="checkbox" name="option3" onclick="DATOS('+i+');" id="option3" value="Yes"> <span class="opcion">Areas de conservación</span> <br>';
          }
          if(i== 4){
            html+='<input type="checkbox" name="option4" onclick="DATOS('+i+');" id="option4" value="Yes"> <span class="opcion">Reserva biosfera</span> <br>';
          }
        }
        $("#menuchecks").html(html);
        

        // To turn off clustering on a layer, set the
        // featureReduction property to null
        toggleButton.addEventListener("click", () => {
          let fr = layer.featureReduction;
          layer.featureReduction =
            fr && fr.type === "cluster" ? null : clusterConfig;
          toggleButton.innerText =
            toggleButton.innerText === "Habilitar agrupamiento"
              ? "Deshabilitar agrupamiento"
              : "Habilitar agrupamiento";
        });
      });
        

      
}

var DATOS = (i)=>{

        //alert(i);
        require([
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/KMLLayer",
        "esri/widgets/ScaleBar"
      ], function(Map, MapView, KMLLayer, ScaleBar) {
        var layer1 = new KMLLayer({
          url:
            "http://apps3.marn.gob.sv/geocumplimiento/restauracion/registro/SitiosRamsar.kmz"            
        });
        var layer2 = new KMLLayer({
          url:
            "http://apps3.marn.gob.sv/geocumplimiento/restauracion/registro/AnpProtegidasDeclaradas.kmz"
        });
        var layer3 = new KMLLayer({
          url:
            "http://apps3.marn.gob.sv/geocumplimiento/restauracion/registro/AreasConservacion.kmz"   
        });
        var layer4 = new KMLLayer({
          url:
            "http://apps3.marn.gob.sv/geocumplimiento/restauracion/registro/ReservaBiosfera.kmz"
        });

        if (i==1) {
            kml.push(layer1);
            console.log(kml);
            $("#option1").prop( "disabled", true );          
        }else if (i==2) {
            kml.push(layer2);
            $("#option2").prop( "disabled", true );            
        }else if (i==3) {
            kml.push(layer3);
            $("#option3").prop( "disabled", true );   
        }else if (i==4) {
            kml.push(layer4);
            $("#option4").prop( "disabled", true );   
        }

        $("#opciones").on('click', function() {
          window.location.reload();
          });

        console.log(kml);
        
        
        //kml.push(layer2);
        map = new Map({
          basemap: "osm",
          layers: kml
        });


        var view = new MapView({
          container: "viewDiv",
          map: map,
          center: [-88.2,13.70], //Longitude, latitude
          zoom: 8
        });

        var scalebar = new ScaleBar({
          view: view
        });
        view.ui.add(scalebar, "bottom-left");
        view.ui.add("btnAbajo", "top-right");

      });
      }

