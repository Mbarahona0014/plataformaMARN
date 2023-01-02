<?php 

  require_once "header.php"; 


  //SOLO USUARIO INTERNO/INCEDNDIOS NO PUEDEN VER ESTA PAGINA
  if($_SESSION['idtipousuario']==4)
  {
    //session_destroy();
    echo "<script>window.location.href='vinicio.php'</script>";
    //header("location:index.php");
  }

  ?>


<link rel="stylesheet" href="recursos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">


<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">
<!--Javascript-->
<script src="recursos/media/js/jquery-1.10.2.js"></script>
<script src="recursos/media/js/bootstrap.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsrestauracionpuntos.js"></script>

<link rel="stylesheet" href="recursos/css/select2.css">
<script  type="text/javascript" src="recursos/js/select2.js"></script>


<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<style type="text/css">
  #mapa {
              margin-left:15px;
              height: 500px;
              width: 97%;

            }
  fieldset 
  {
    border: 1px solid #ddd !important;
    margin: 0;
    xmin-width: 0;
    padding: 10px;       
    position: relative;
    border-radius:4px;
    background-color:#f5f5f5;
    padding-left:10px!important;
  } 
  
    legend
    {
      font-size:14px;
      font-weight:bold;
      margin-bottom: 0px; 
      width: 35%; 
      border: 1px solid #ddd;
      border-radius: 4px; 
      padding: 5px 5px 5px 10px; 
      background-color: #ffffff;
    }




    #files-area{
  width: 30%;
  margin: 0 auto;
}
.file-block{
  border-radius: 10px;
  background-color: rgba(144, 163, 203, 0.2);
  margin: 5px;
  color: initial;
  display: inline-flex;
  & > span.name{
    padding-right: 10px;
    width: max-content;
    display: inline-flex;
  }
}
.file-delete{
  display: flex;
  width: 24px;
  color: initial;
  background-color: #6eb4ff00;
  font-size: large;
  justify-content: center;
  margin-right: 6px;
  cursor: pointer;
  &:hover{
    background-color: rgba(144, 163, 203, 0.2);
    border-radius: 10px;
  }
  & > span{
    transform: rotate(45deg);
  }
</style>


<div class="container" >
    <div class="row" >
        <div class="col-md-offset-1 col-md-10" >
            
            <center><h3>Ingreso de registro de restauración</h3></center><br>
        <!-- <form action="#" method="POST"  > -->
  <form id="formrestauracionpuntos" name="formrestauracionpuntos" enctype="multipart/form-data" method="POST" >        
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="periodo">Período</label>
      <select class="form-control form-control-lg text-center" id="tpperiodo" name="tpperiodo" style="width: 100%" required>
      </select>
    </div>
    <div class="form-group col-md-9">
      <label for="tptecnica">Uso de suelo / Técnica</label>
      <select class="form-control form-control-lg text-center" id="tptecnica" name="tptecnica" style="width: 100%" required>
      </select>
      <!-- <input type="text" class="form-control" required id="txttecnica" name="txttecnica" placeholder="Ingreso de técnica"> -->
    </div>
  </div>
  <div class="form-row col-md-12" id="mapa"></div>
    <!-- <div
        id="line-button"
        class="esri-widget esri-widget--button esri-interactive"
        title="Draw polyline"
      >
        <span class="esri-icon-polyline"></span>

  </div> -->
    <div class="form-row">
      <div class="form-group col-md-12">
          <div class="form-group">
            <!-- <label for="txtcoordenadas">Coordenadas</label> -->
              <input type="hidden"  autocomplete="off"  style="height: 50px;" class="form-control" id="txtcoordenadas" name="txtcoordenadas" >
          </div>
        </div>

        
        <div class="form-group col-md-6">
          <div class="form-group">
            <!-- <label for="txtlongitud">Longitud</label> -->
              <input type="hidden"  autocomplete="off"  class="form-control" id="txtlongitud" name="txtlongitud" >
          </div>
        </div>
        <div class="form-group col-md-6">
          <div class="form-group">
            <!-- <label for="txtlatitud">Latitud</label> -->
            <input type="hidden"  autocomplete="off"  class="form-control" id="txtlatitud" name="txtlatitud">
          </div>
        </div>
    </div>
  <div class="form-row">
    <div class="form-group col-md-4">
        <label for="txtcantidadpersonas">Cantidad de personas</label>
        <input type="number" class="form-control" id="txtcantidadpersonas" name="txtcantidadpersonas" placeholder="Cantidad de personas" min="0" pattern="^[0-9]+" required>
    </div>
    <div class="form-group col-md-4">
        <label for="tpmunicipio">Departamento/Municipio</label>
        <!-- <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Ingrese municipio"> -->
        <select class="form-control form-control-lg text-center" id="tpmunicipio" name="tpmunicipio" style="width: 100%" required>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="txtcanton">Cantón</label>
        <input type="text" class="form-control" id="txtcanton" name="txtcanton" placeholder="Ingrese cantón">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
        <label for="txtubicacion">Ubicación</label>
        <input type="text" class="form-control" id="txtubicacion" name="txtubicacion" placeholder="Ingrese ubicación">
        </div>
    <div class="form-group col-md-8">
        <label for="txtbeneficiarios">Beneficiarios</label>
        <input type="text" class="form-control" id="txtbeneficiarios" name="txtbeneficiarios" placeholder="Ingrese beneficiarios">
    </div>
    
    <div class="form-row">
      <div class="form-group col-md-12">
          <label for="txtarea">Hectáreas</label>
          <input type="number" class="form-control" id="txtarea" name="txtarea" placeholder="Ingrese cantidad de hectáreas" step="0.1" min="0.1" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-12">
          <label for="txtinstituciones">Instituciones</label>
          <input type="text" class="form-control" id="txtinstituciones" name="txtinstituciones" placeholder="Ingrese instituciones">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
          <!-- <label for="txtinstituciones">Especies <button type="button" style="background-color:#293643;border-color: darkblue;" name="btnmas" id="btnmas" class="btn btn-primary">Agregar +</button></label> -->

          <label for="lista">Especies <button type="button" style="background-color:#293643;border-color: darkblue;" name="btnmas" id="btnmas" class="btn btn-primary" data-toggle="modal" data-target="#modalespecie"  data-backdrop="static" data-keyboard="false">Agregar +</button></label>
          <ul class="list-group" id="lista">
            
          </ul>

      </div>

    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
          <label for="txtcomentarios">Comentarios</label>
          <!-- <input type="text" class="form-control" id="txtcomentarios" name="txtcomentarios" style="width:100%; height:75px;" placeholder="Ingrese beneficiarios"> -->
          <textarea class="form-control" id="txtcomentarios" name="txtcomentarios" placeholder="Comentarios" oninput="this.value=this.value.replace(/\n/g,'')"></textarea>
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-12">
          <div class="form-group">

              <p class="mt-5 text-center">
                <label for="attachment">
                  <a class="btn btn-primary text-light" role="button" aria-disabled="false" id='btnfiles'>+ Añadir imagen</a>
                  
                </label>
                <div id="divimagen">
                  <input type="file" name="files[]" accept="image/*" id="attachment" style="visibility: hidden; position: absolute;" multiple/>
              </p>
                  <p id="files-area">
                    <span id="filesList">
                      <span id="files-names"></span>
                    </span>
                  </p>
                  </div>
          </div>
      </div>
  </div> 


  </div>
  <div class="form-row text-right">
    <div class="form-group col-md-12">
  <button type="submit" style="background-color:#293643;border-color: darkblue;" name="btnguardar" id="btnguardar" class="btn btn-primary">Guardar</button>
  </div></div><br><br>
  <!-- <button type="submit" id="btnguardar" class="btn btn-primary">
              Guardar&nbsp;&nbsp;<i class="fa fa-save" aria-hidden="true"></i> -->
</form>


        </div>
    </div>
    
</div>


















          <div class="modal fade bd-example-modal-xs" id="modalespecie"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                                        Agregar detalle especie
                 </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                  <form id="formdetalleespecie" action="#" method="POST"><!--Aqui se le pone el ID para obtener todos los datos -->

                  <div class="form-group">
                    

                    <div class="form-floating text-left"><strong><label>Cantidad:</label></strong><input class= "form-control" type="number" id="txtcantidad" name="txtcantidad" placeholder="Cantidad de árboles" min="1" pattern="^[0-9]+" required/></div>

                    <div class=" text-left"><strong><label>Especie:</label></strong>
                      <select id="tpespecie" name="tpespecie" class="form-control form-control-lg" style="width: 100%"></select>
                    </div>



                  </div>
                    <button type="button" style="background-color:#293643;border-color: darkblue;" onclick="guardardetalleespecie()" class="btn btn-primary">Agregar</button>

              </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncerrar2" name="btncerrar2">
                                                    Cerrar
                  </button>
                </div>
              </div>
            </div>
          </div>




<!-- MAPA ARCGIS -->
<script src="https://js.arcgis.com/4.23/"></script>
<script src="dist/js/app.min.js"></script>






    
<script type="text/javascript">
  
$(document).ready(function() {





/*  require([
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
    center: [-88.94891098379951,13.68419952332114], //Longitude, latitude
    zoom: 8,
    container: "mapa"
 });

 const graphicsLayer = new GraphicsLayer();
 map.add(graphicsLayer);

 const point = { //Create a point
    type: "point",
    longitude: -89.19,
    latitude: 13.69
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
 });
*/

 
 
 
 
 
 
 
 
 
 
 
/*   require([
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
    center: [-89.16097819855285,13.675354279837352], //Longitude, latitude
    zoom: 13,
    container: "mapa"
 });

 const graphicsLayer = new GraphicsLayer();
 map.add(graphicsLayer);

 const point = { //Create a point
    type: "point",
    longitude: -89.16,
    latitude: 13.67
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

    // Create a line geometry, crea las lineas para
 const polyline = {
    type: "polyline",
    paths: [
        [-89.16698634674621, 13.687122297637613], //Longitude, latitude
        [-89.17118251606671, 13.670350378705642], //Longitude, latitude
        [-89.14762675928735, 13.674983623009135],  //Longitude, latitude
        [-89.16698634674621, 13.687122297637613] //Longitude, latitude
    ]
 };
 const simpleLineSymbol = {
    type: "simple-line",
    color: [226, 119, 40], // Orange
    width: 2
 };

 const polylineGraphic = new Graphic({
    geometry: polyline,
    symbol: simpleLineSymbol
 });
 graphicsLayer.add(polylineGraphic);


 //ESTA PARTE ES MAS GRAFICA
 // Create a polygon geometry sombrea el area del poligono
 /*const polygon = {
    type: "polygon",
    rings: [
        [-89.16698634674621, 13.687122297637613], //Longitude, latitude
        [-89.17118251606671, 13.670350378705642], //Longitude, latitude
        [-89.14762675928735, 13.674983623009135],  //Longitude, latitude
        [-89.16698634674621, 13.687122297637613] //Longitude, latitude
        
    ]
 };

 const simpleFillSymbol = {
    type: "simple-fill",
    color: [227, 139, 79, 0.8],  // Orange, opacity 80%
    outline: {
        color: [255, 255, 255],
        width: 1
    }
 };

 const popupTemplate = {
    title: "{Name}",
    content: "{Description}"
 }
 const attributes = {
    Name: "Graphic",
    Description: "I am a polygon"
 }

 const polygonGraphic = new Graphic({
    geometry: polygon,
    symbol: simpleFillSymbol,

    attributes: attributes,
    popupTemplate: popupTemplate

 });
 graphicsLayer.add(polygonGraphic);*/

/* });
 
 
 */
 
/*       require([
        "esri/config",
        "esri/Map",
        "esri/views/MapView",
        "esri/views/draw/Draw",
        "esri/Graphic",
        "esri/geometry/geometryEngine",
        "esri/geometry/support/webMercatorUtils"
      ], (esriConfig, Map, MapView, Draw, Graphic, geometryEngine, webMercatorUtils) => {

        esriConfig.apiKey = "AAPK0ff0f45d5d3e436e997fbe4ec720fbc8pyyCmo9TfLto8VpLoODkR9vzxpSk6Llr_OFL_JbC2u3Mi4pnk589QtBLJVVbIJXu";

        const map = new Map({
          basemap: "gray-vector"
        });

        const view = new MapView({
          container: "mapa",
          map: map,
          zoom: 8,
          center: [-89.16097819855285,13.675354279837352]
        });

        // add the button for the draw tool
      view.ui.add("line-button", "top-left");

      const draw = new Draw({
        view: view
      });

      // draw polyline button
      document.getElementById("line-button").onclick = function() {
        view.graphics.removeAll();

        // creates and returns an instance of PolyLineDrawAction
        const action = draw.create("polygon");

        // focus the view to activate keyboard shortcuts for sketching
        view.focus();

        // listen polylineDrawAction events to give immediate visual feedback
        // to users as the line is being drawn on the view.
        action.on([
          "vertex-add", 
          "vertex-remove", 
          "cursor-update", 
          "redo",
          "undo", 
          "draw-complete"
        ], updateVertices);
      }

      // Checks if the last vertex is making the line intersect itself.
      function updateVertices(event) {
        console.log(event);
        //console.log(webMercatorUtils.webMercatorToGeographic(event.view.graphic.geometry).toJSON());
        // create a polyline from returned vertices
        createGraphic(event);



      }

      // create a new graphic presenting the polyline that is being drawn on the view
      function createGraphic(event) {
        const vertices = event.vertices;
        view.graphics.removeAll();
        //console.log(view);
        // a graphic representing the polyline that is being drawn
        const graphic = new Graphic({
          geometry: {
            type: "polygon",
            rings: vertices,
            spatialReference: view.spatialReference
          },
          symbol: {
            type: "simple-fill", // autocasts as SimpleFillSymbol
            color: [240, 248, 255, 0.6],
            style: "solid",
            outline: {  // autocasts as SimpleLineSymbol
              color: "black",
              width: 1.5
            }}
        });

          //console.log(graphic);
          view.graphics.add(graphic);
          //console.log(vertices);
          //console.log(view.spatialReference.toJSON());
          //console.log(event.vertices);

          //console.log(vertices.toJSON());
          $("#txtlongitud").val(vertices);
        
      }

       
 });*/


 });


</script>



</body>
</html>




