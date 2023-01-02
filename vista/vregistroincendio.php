<?php 

  require_once "header.php"; 



  //SOLO PUEDE VER ESTA VISTA EL USUARIO DE INCENDIOS Y ADMINISTRADOR
  if($_SESSION['idtipousuario']==2 || $_SESSION['idtipousuario']==3 || $_SESSION['idtipousuario']==5)
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
<script type="text/javascript" src="recursos/js/jsmodelo/jsincendio.js"></script>

<link rel="stylesheet" href="recursos/css/select2.css">
<script  type="text/javascript" src="recursos/js/select2.js"></script>


<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<style type="text/css">
  #mapa {
        margin-left:15px;
        height: 550px;
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
}
</style>

<div class="container">
  <br/>
  <div class="panel panel-default">
    <div class="panel-heading"><center><h3>Registro de incendios forestales</h3></center></div>
        <div class="panel-body">
             <form id="formregistroincendio" name="formregistroincendio" enctype="multipart/form-data" method="POST" >   
            <fieldset class="col-md-12">     
              <legend>Detección y Localización</legend>
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="tpareanatural">Área Natural Protegida</label>
                      <select class="form-control form-control-lg text-center" id="tpareanatural" name="tpareanatural" style="width: 100%" required>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="tpequipotecnico">Equipo Técnico</label>
                      <select class="form-control form-control-lg text-center" id="tpequipotecnico" name="tpequipotecnico" style="width: 100%" required>
                      </select>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="txtfechaaviso">Fecha y hora del aviso de incendio</label>
                      <input type="datetime-local" id="txtfechaaviso" name="txtfechaaviso" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtfechainicio">Fecha y hora de inicio de incendio</label>
                      <input type="datetime-local" id="txtfechainicio" name="txtfechainicio" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="txtfechafin">Fecha y hora de fin de incendio</label>
                      <input type="datetime-local" id="txtfechafin" name="txtfechafin" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="tpformaaviso">Forma del aviso</label>
                      <select class="form-control form-control-lg text-center" id="tpformaaviso" name="tpformaaviso" style="width: 100%" required>
                      </select>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="txtubicacionacceso">Ubicación y acceso</label>
                      <textarea class="form-control" id="txtubicacionacceso" name="txtubicacionacceso" placeholder="Ubicación y acceso" oninput="this.value=this.value.replace(/\n/g,'')"></textarea>
                    </div>
                  </div>
                </div>
                <!-- cierrer del panel body -->
              </div>
            </fieldset>

            <fieldset class="col-md-12">     
              <legend>Verificación y control</legend>
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="tptopografia">Topografía</label>
                      <select class="form-control form-control-lg text-center" id="tptopografia" name="tptopografia" style="width: 100%">
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="tptenenciapropiedad">Tenencia de la propiedad</label>
                      <select class="form-control form-control-lg text-center" id="tptenenciapropiedad" name="tptenenciapropiedad" style="width: 100%">
                      </select>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="chcausasincendio">Causas del Incendio</label>
                    </div>
                  </div>
                    <div class="form-group col-md-8">
                      
                      <label class="checkbox-inline">
                        <div class="checkcontainer">
                          <!-- DIV QUE IMPRIME LOS CHECKBOX -->
                          <div id="checkbox" name="checkbox"></div>
                        </div>
                      </label>


                  </div>


                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="hectareas">Hectáreas afectadas por tipo de vegetación</label>
                    </div>

                    <!-- CAJA PARA SABER LOS REGITROS QUE SE HAN INSERTADO -->
                    <!--input hidden-->
                    <input type="hidden" class="form-control text-center" name="txtnum" id="txtnum" placeholder="">

                    <div class="form-group col-md-8">
                      <div id="tablavegetacion" name="tablavegetacion">
                        <!-- <tr>
                           <th>Coníferas&nbsp;<input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtconiferas2" name="txtconiferas2" placeholder="" style="width: 60px">
                           </th> 
                           <th>Bosque tropical&nbsp;<input type="number" class="form-inline" id="txtbosquetropical" name="txtbosquetropical" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtbosquetropical2" name="txtbosquetropical2" placeholder="" style="width: 60px">
                           </th> 
                        </tr>

                        <tr>
                           <th>Coníferas&nbsp;<input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtconiferas2" name="txtconiferas2" placeholder="" style="width: 60px">
                           </th> 
                           <th>Bosque tropical&nbsp;<input type="number" class="form-inline" id="txtbosquetropical" name="txtbosquetropical" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtbosquetropical2" name="txtbosquetropical2" placeholder="" style="width: 60px">
                           </th> 
                        </tr>

                        <tr>
                           <th>Coníferas&nbsp;<input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtconiferas2" name="txtconiferas2" placeholder="" style="width: 60px">
                           </th> 
                           <th>Bosque tropical&nbsp;<input type="number" class="form-inline" id="txtbosquetropical" name="txtbosquetropical" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtbosquetropical2" name="txtbosquetropical2" placeholder="" style="width: 60px">
                           </th> 
                        </tr>


                        <tr>
                           <th>Coníferas&nbsp;<input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtconiferas2" name="txtconiferas2" placeholder="" style="width: 60px">
                           </th> 
                           <th>Bosque tropical&nbsp;<input type="number" class="form-inline" id="txtbosquetropical" name="txtbosquetropical" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtbosquetropical2" name="txtbosquetropical2" placeholder="" style="width: 60px">
                           </th> 
                        </tr>

                        <tr>
                           <th>Coníferas&nbsp;<input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtconiferas2" name="txtconiferas2" placeholder="" style="width: 60px">
                           </th> 
                           <th>Bosque tropical&nbsp;<input type="number" class="form-inline" id="txtbosquetropical" name="txtbosquetropical" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtbosquetropical2" name="txtbosquetropical2" placeholder="" style="width: 60px">
                           </th> 
                        </tr>

                        <tr>
                           <th>Coníferas&nbsp;<input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="" style="width: 60px"><input type="number" class="form-inline" id="txtconiferas2" name="txtconiferas2" placeholder="" style="width: 60px">
                           </th> 
                        </tr>
 -->





                      </div>
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="instituciones">Instituciones y números de personas participantes</label>
                    </div>
                    <div class="form-group col-md-8">
                      <!-- CAJA PARA SABER LOS REGITROS QUE SE HAN INSERTADO -->
                        <!--input hidden-->
                        <input type="hidden" class="form-control text-center" name="txtnum2" id="txtnum2" placeholder="">

                      <div id="tablaextinsion" name="tablaextinsion">
                        
<!--                         <tr>
                           <th><input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="0" style="width: 35px">&nbsp;Técnicos ANP
                           </th> 
                           <th><input type="number" class="form-inline" id="txtguardarecursos" name="txtguardarecursos" placeholder="0" style="width: 35px">&nbsp;Guarda recursos
                           </th> 
                           <th><input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="0" style="width: 35px">&nbsp;Fuerza armada
                           </th>
                        </tr>

                        <tr>
                           <th><input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="0" style="width: 35px">&nbsp;Técnicos ANP
                           </th> 
                           <th><input type="number" class="form-inline" id="txtguardarecursos" name="txtguardarecursos" placeholder="0" style="width: 35px">&nbsp;Guarda recursos
                           </th> 
                           <th><input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="0" style="width: 35px">&nbsp;Fuerza armada
                           </th>
                        </tr>

                        <tr>
                           <th><input type="number" class="form-inline" id="txtconiferas" name="txtconiferas" placeholder="0" style="width: 35px">&nbsp;Técnicos ANP
                           </th> 
                           <th><input type="number" class="form-inline" id="txtguardarecursos" name="txtguardarecursos" placeholder="0" style="width: 35px">&nbsp;Guarda recursos
                           </th> 
                        </tr>
 -->




                        
                      </div>
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtvelocidadpropagacion">Velocidad de propagación</label>
                        <input type="number" class="form-control" id="txtvelocidadpropagacion" name="txtvelocidadpropagacion" placeholder="Velocidad de propagación" step=".01" min="0.01">
                    </div>
<!--                   </div>

                  <div class="form-row"> -->
                    <div class="form-group col-md-6">
                      <label for="txtcomentarios">Comentarios</label>
                      <textarea class="form-control" id="txtcomentarios" name="txtcomentarios" placeholder="Comentarios" oninput="this.value=this.value.replace(/\n/g,'')"></textarea>
                    </div>
                  </div>



                  <!-- cierre de panel body -->
                </div>
                <!-- cierrer de panel default -->
              </div>
            </fieldset>   

            <fieldset class="col-md-12">     
              <legend>Geoposición</legend>
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-row col-md-12" id="mapa"></div>
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
                    <!-- <div class="form-row">
                        <div class="form-group col-md-6">
                          <div class="form-group">
                            <label for="txtlongitud">Longitud</label>
                              <input type="text" required autocomplete="off"  class="form-control" id="txtlongitud" name="txtlongitud" >
                          </div>
                        </div>
                        <div class="form-group col-md-6">
                          <div class="form-group">
                            <label for="txtlatitud">Latitud</label>
                            <input type="text" required autocomplete="off"  class="form-control" id="txtlatitud" name="txtlatitud">
                          </div>
                        </div> -->
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">

                                <p class="mt-5 text-center">
                                  <label for="attachment">
                                    <br>
                                    <a class="btn btn-primary text-light" role="button" aria-disabled="false" id="btnfiles">+ Añadir imagen</a>
                                    
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

                <!-- INPUT FILE AQUI -->


              </div>
              <div class="form-row text-center">
                <div class="form-group col-md-12 ">
                  <button type="submit" style="background-color:#293643;border-color: darkblue;" name="btnguardar" id="btnguardar" class="btn btn-primary">Guardar</button>
                </div>
              </div><br><br>
              
            </fieldset> 
            </form>
          
          <div class="clearfix"></div>

<script src="dist/js/app.min.js"></script>
    <script src="https://js.arcgis.com/4.23/"></script>
<script type="text/javascript">










//alert($(this)[0].value);
/*https://codepen.io/scarulli/pen/bGGXdEZ*/

/*para validar
https://programmierfrage.com/items/remove-name-input-multiple-uploads-image-after-pressing-the-delete-button*/


  
/*$(document).ready(function() {


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











  require([
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

});
*/

</script>



</body>
</html>




