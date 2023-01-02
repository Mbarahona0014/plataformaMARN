<?php 

  //require_once "header.php"; 

  ?>
<meta charset="utf-8" />
    <meta
      name="viewport"
      content="initial-scale=1,maximum-scale=1,user-scalable=no"
    />

<link rel="stylesheet" href="recursos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<!-- REFERENCIA JS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsconsultarpointsincendio.js"></script>


<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


<link rel="stylesheet" href="recursos/css/select2.css">

<!-- agregando referencias de mapa -->
<link rel="stylesheet" href="https://js.arcgis.com/4.20/esri/themes/dark/main.css">





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
        Filtrar Fecha Incendio: 
        <select class="form-control form-control-lg text-center" id="tpfechaincendio" name="tpfechaincendio" style="width: 100%" required>

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

    <div class="col-md-3 " id="panel" >
      <div>
      <div id="accordion" >
    <div class="card ">
  
      <div class="card-header bg-dark" id="headingOne">
        <h5 class="mb-0">
          <button class="btn" style="color:whitesmoke;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Información
          </button>
        </h5>
      </div>

      <div id="collapseOne" class="collapse bg-secondary show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">

          <p style='color:white; font-weight: bolder; font-size: xx-large;text-align: center;'>
              INCENDIOS FORESTALES
          </p>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header bg-dark" id="headingTwo">
        <h5 class="mb-0">
          <button class="btn collapsed" style="color:whitesmoke;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Capas
          </button>
        </h5>
      </div>
      <div id="collapseTwo" class="collapse bg-secondary"  aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <center><button id="opciones" class="btn btn-primary">Limpiar capas</button></center>
          <div id="menuchecks" style="color: whitesmoke;">
          </div>
        </div>
      </div>
    </div>

  </div>
      </div>  
    </div>
  </div>






<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script  type="text/javascript" src="recursos/js/select2.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsconsultarpointsincendio.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollup/2.4.1/jquery.scrollUp.js" integrity="sha512-wGSqIPlojEqG8khYguoHUx1nfYeECuZ2+fQhEn+O++QYp4Lc86lk49X7TsZcmFmac2GEJXZx8I47XBHxsF6rfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollup/2.4.1/jquery.scrollUp.min.js" integrity="sha512-gAHP1RIzRzolApS3+PI5UkCtoeBpdxBAtxEPsyqvsPN950Q7oD+UT2hafrcFoF04oshCGLqcSgR5dhUthCcjdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://js.arcgis.com/4.23/"></script>


  </body>
</html>



