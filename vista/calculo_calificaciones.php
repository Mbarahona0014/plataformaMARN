<?php
require_once "header.php";
//SOLO ADMIN PUEDE VER ESTA VISTA
if ($_SESSION['idtipousuario'] !=1 || $_SESSION['idtipousuario'] != 7) {
  //session_destroy();
  echo "<script>window.location.href='vinicio.php'</script>";
  //header("location:index.php");
}
?>
<style>
  #files-area {
    width: 100%;
    margin: 0 auto;
  }

  #files-names {
    display: flex;
    flex-wrap: wrap;
  }

  .file-block {
    width: 40%;
    border-radius: 10px;
    background-color: rgba(144, 163, 203, 0.2);
    margin-right: 5px;
    padding: 5px;
    color: initial;
    align-items: center;
  }

  .file-block span {
    width: 100%;
  }

  .file-delete {
    width: 24px;
    color: initial;
    background-color: #6eb4ff00;
    font-size: large;
    margin-right: 6px;
    cursor: pointer;

    /* &:hover {
      background-color: rgba(144, 163, 203, 0.2);
      border-radius: 10px;
    }

    &>span {
      transform: rotate(45deg);
    } */
  }
</style>

<link rel="stylesheet" href="recursos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">
<!--Javascript-->

<script src="recursos/media/js/jquery-1.10.2.js"></script>
<script src="recursos/media/js/bootstrap.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsusuario.js"></script>
<!-- agregando referencias de mapa -->
<link rel="stylesheet" href="https://js.arcgis.com/4.23/esri/themes/dark/main.css">
<link rel="stylesheet" href="recursos/css/select2.css">
<script type="text/javascript" src="recursos/js/select2.js"></script>
<script type="text/javascript" src="recursos/plugins/sweetalert2/sweetalert2.js"></script>
<!-- links para exportar a excel -->
<script src="./recursos/js/toExcel/xlsx.full.min.js"></script>
<script src="./recursos/js/toExcel/FileSaver.min.js"></script>
<script src="./recursos/js/toExcel/tableexport.min.js"></script>

<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">

  <h1>
    <h1><b>Ingreso de datos de evaluación</b></h1>
  </h1>
  <ol class="breadcrumb">
    <li><span><i class="fa fa-home"></i> Inicio</a></span></li>
    <li class="active"><span>Evaluaciones</span></li>
  </ol>
</section>
<!-- Main content -->
<section id="content" class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ingreso de datos de evaluación</h3>
        </div>
        <div class="box-body">
          <div class="form-group col-md-12">
            <label>Area natural</label>
            <select name="area" id="area" class="form-control select2"></select>
          </div>
          <div class="form-group col-md-6">
            <label>Evaluacion de referencia</label>
            <select name="evaluacionRef" id="evaluacionRef" class="form-control select2"></select>
          </div>
          <div class="form-group col-md-6">
            <label>Evaluacion de comparacion</label>
            <select name="evaluacionComp" id="evaluacionComp" class="form-control select2"></select>
          </div>
        </div>
        <div class="box-footer">
          <button id="btnCalc" class="btn btn-primary pull-right">Ir a evaluacion</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 hide">
    <!-- <div class="col-md-12"> -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Listado de evaluaciones</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="tabla_encabezado" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 20%;">Numero</th>
                <th style="width: 35%;">Area natural</th>
                <th style="width: 35%;">Fecha de evaluacion</th>
                <th style="width: 10%;">Acción</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th style="width: 20%;">Numero</th>
                <th style="width: 35%;">Area natural</th>
                <th style="width: 35%;">Fecha de evaluacion</th>
                <th style="width: 10%;">Acción</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-12" id="box_encabezado">
      <!-- Default box -->
      <!-- <button class="btn btn-primary m-2" onclick="Export2Doc();">Exportar a Word</button><br><br> -->
      <div class="box">
        <button class="btn bg-maroon" onclick="Export2PDF('reporteANP.pdf');"><i class="fa fa-file-pdf-o"></i></button>
        <div class="box-header with-border" id="box_encabezado_header">
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" onclick="exportToExcel('tabla_resumen');"><i class="fa fa-file-excel-o"></i></button>
          <h3 class="box-title"><b>Resumen de puntaje por ambito</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_resumen" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10%;">AMBITO</th>
                <th style="width: 10%;">PESO</th>
                <th style="width: 10%;">UCG</th>
                <th style="width: 10%;">PUNTAJE</th>
                <th style="width: 20%;">DIFERENCIA</th>
                <th style="width: 20%;">PORCENTAJE</th>
              </tr>
            </thead>
            <tbody>

            </tbody>

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" onclick="exportToExcel('tabla_indicadores');"><i class="fa fa-file-excel-o"></i></button>
          <h3 class="box-title"><b>Resultados de indicadores</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_indicadores" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 40%;">AMBITO</th>
                <th style="width: 30%;">INDICADOR</th>
                <th style="width: 30%;">ESCALA</th>
              </tr>
            </thead>
            <tbody>

            </tbody>

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Gráfico Estadístico Escala de Satisfacción</b></h3>
        </div>
        <div class="box-body">
          <canvas height="120" id="chartBar"></canvas>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" onclick="exportToExcel('tabla_comparacion');"><i class="fa fa-file-excel-o"></i></button>
          <h3 class="box-title"><b>Comparacion Sobre la Calidad de Gestión de Manejo Anterior y Actual</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_comparacion" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 20%;">AMBITO</th>
                <th style="width: 20%;">UCG</th>
                <th style="width: 20%;">ANTERIOR</th>
                <th style="width: 20%;">ACTUAL</th>
                <th style="width: 20%;">%CG</th>
              </tr>
            </thead>
            <tbody>

            </tbody>

          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success" onclick="exportToExcel('tabla_comparacion2');"><i class="fa fa-file-excel-o"></i></button>
          <h3 class="box-title"><b>Comparacion temporal sobre la Calidad de Gestión de Manejo Período Cinco Años</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_comparacion2" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 30%;">AMBITO</th>
                <th style="width: 10%;">UCG</th>
                <th style="width: 10%;">-5 EV</th>
                <th style="width: 10%;">-4 EV</th>
                <th style="width: 10%;">-3 EV</th>
                <th style="width: 10%;">-2 EV</th>
                <th style="width: 10%;">-1 EV</th>
                <th style="width: 10%;">ACTUAL</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Gráfico Estadístico Comparacion Temporal</b></h3>
        </div>
        <div class="box-body">
          <canvas height="120" id="chartLine"></canvas>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <img style="display:none;" id="imgLogo" width="165" height="45" src="recursos/images/logomarn.png">
    <div>
      <img style="background-color:white; display:none;" id="imgChartLine" width="525" height="245" src="">
    </div>
    <div>
      <img style="background-color:white; display:none;" id="imgChartBar" width="525" height="245" src="">
    </div>
  </div>
</section>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
<!-- JSPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://js.arcgis.com/4.23/"></script>
<!-- <script src="./recursos/js/table2CSV.js"></script> -->
<script src="./recursos/js/jsmodelo/calculo.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>