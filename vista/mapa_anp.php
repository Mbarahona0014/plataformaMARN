<?php 
if ($_SESSION['idtipousuario'] != 1 || $_SESSION['idtipousuario'] != 7) {
  //session_destroy();
  echo "<script>window.location.href='vinicio.php'</script>";
  //header("location:index.php");
}
  //require_once "header.php"; 
require_once "../modelo/daorestauracionpuntos.php";

$dat = new daorestauracionpuntos();
$r=$dat->consultarsumahectareas();

foreach($r as $c){
  $cantidad=$c["contador"];
  }
  ?>
<meta charset="utf-8" />
    <meta
      name="viewport"
      content="initial-scale=1,maximum-scale=1,user-scalable=no"
    />

<link rel="stylesheet" href="recursos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsconsultarpoints.js"></script>

<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


<link rel="stylesheet" href="recursos/css/select2.css">

<!-- agregando referencias de mapa -->
<link rel="stylesheet" href="https://js.arcgis.com/4.23/esri/themes/dark/main.css">

<style>
      html,
      body,
      #viewDiv {
        padding: 0;
        margin: 0;
        height: 100vh !important;
        width: 100vw !important;
        overflow-x: hidden;
        overflow-y: initial !important;
      }
      #infoDiv {
        padding: 10px;
      }
      @media only screen and (min-width: 600px) {
        #bajar{
            visibility: hidden;
        }
    }
</style>

  <body>
    
<!-- <div class="container-fluid">


</div> -->





<div class="row">
    <div class="col-md-9" >
      <div id="infoDiv" class="esri-widget">
        Filtrar Período: 
        <select class="form-control form-control-lg text-center" id="tpperiodo3" name="tpperiodo3" style="width: 100%" required>

        </select>
        Bosquejo de mapa: 
        <select class="form-control form-control-lg text-center" id="tpmostrar" name="tpmostrar" style="width: 100%" required>
          <option value="todos" selected>Todos</option>
          <option value="poligonos">Poligonos</option>
          <option value="puntos">Puntos</option>

         </select>
        <hr style="background-color:white;">
        <button id="cluster" class="esri-button">Agrupamiento</button>
        <div id="legendDiv"></div>
        
         
      </div>

      
    
        
     
      
      <div id="viewDiv"></div>
      <div id="btnAbajo" ><button id="bajar" data-ancla="accordion" class="btn btn-secondary">Bajar</button></div>

    </div>

    <div class="col-md-3 " id="panel">
      <div>
      <div id="accordion" >
        <div class="card">
    <!-- <h1>XDD</h1> -->
    
    <div class="card ">
  
      <div class="card-header bg-dark" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn collapsed" style="color:whitesmoke;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            INFORMACION
          </button>
        </h5>
      </div>

      <div id="collapseTwo" class="collapse bg-secondary" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">

          <p style='color:white; font-weight: bolder; font-size: xx-large;text-align: center;'>
              EVALUACION DE EFECTIVIDAD DE MANEJO
          </p>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header bg-dark" id="headingThree">
        <h5 class="mb-0">
          <button class="btn collapsed" style="color:whitesmoke;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            CAPAS
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse bg-secondary"  aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          <center><button id="opciones" class="btn btn-primary">Limpiar capas</button></center>
          <div id="menuchecks" style="color: whitesmoke;">
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="card">
      <div class="card-header bg-dark" id="headingThree">
        <h5 class="mb-0">
          <button class="btn collapsed" style="color:whitesmoke;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Documentación pertinente
          </button>
        </h5>
      </div>
      <div id="collapseThree" class="collapse bg-secondary" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          <p style='text-align:justify;color: whitesmoke;'>A continuación se proporciona documentación de apoyo a tomar en consideración en el registro de esfuerzos y avances realizados por el gobierno central, municipalidades, instituciones autónomas, entidades no gubernamentales y sector privado del proceso de Restauración de Ecosistemas y Paisajes en El Salvador.</p>
          <a href='./docs.php' class="btn btn-primary" target='_blank'>Ir allá...</a>
        </div>
      </div>
    </div> -->











<!--     <div class="card">
      <div class="card-header" id="headingFour">
        <h5 class="mb-0">
          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Especies a Restaurar
          </button>
        </h5>
      </div>
      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
        <div class="card-body">
          <p style='text-align:justify;'>Para conocer sobre las especies de flora (árboles) que se pueden sembrar en el país, se dispone del siguiente listado</p>
          <a href='../docs/ListaEspeciesRestaurar.pdf' target='_blank'>Listado Especies a Restaurar</a>
        </div>
      </div>
    </div> -->
  </div>
</div>  
</div>
</div>






<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script  type="text/javascript" src="recursos/js/select2.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsconsultarpointsanp.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollup/2.4.1/jquery.scrollUp.js" integrity="sha512-wGSqIPlojEqG8khYguoHUx1nfYeECuZ2+fQhEn+O++QYp4Lc86lk49X7TsZcmFmac2GEJXZx8I47XBHxsF6rfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollup/2.4.1/jquery.scrollUp.min.js" integrity="sha512-gAHP1RIzRzolApS3+PI5UkCtoeBpdxBAtxEPsyqvsPN950Q7oD+UT2hafrcFoF04oshCGLqcSgR5dhUthCcjdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.arcgis.com/4.23/"></script>
  </body>
</html>



