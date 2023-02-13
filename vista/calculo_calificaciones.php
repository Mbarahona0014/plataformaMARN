<?php
require_once "header.php";
//SOLO ADMIN PUEDE VER ESTA VISTA
if ($_SESSION['idtipousuario'] == 2 || $_SESSION['idtipousuario'] == 3 || $_SESSION['idtipousuario'] == 4 || $_SESSION['idtipousuario'] == 5) {
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

<link rel="stylesheet" href="recursos/css/select2.css">
<script type="text/javascript" src="recursos/js/select2.js"></script>
<script type="text/javascript" src="recursos/plugins/sweetalert2/sweetalert2.js"></script>

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
      <!-- Default box -->
      <div class="form-group col-md-12 mb-3">
        <div class="form-group">
          <label>Area natural</label>
          <select name="area" id="area" class="form-control">
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
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
      <button class="btn btn-primary m-2" onclick="Export2Doc();">Exportar a Word</button><br><br>
      <div class="box" >
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
          <h3 class="box-title"><b>Resumen de puntaje por ambito</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_resumen" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10%;">Ambito</th>
                <th style="width: 10%;">Peso</th>
                <th style="width: 10%;">Puntaje(UCG)</th>
                <th style="width: 10%;">Puntaje(ANP)</th>
                <th style="width: 10%;">Diferencia del puntaje</th>
                <th style="width: 10%;">Porcentaje de avance</th>
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
          <h3 class="box-title"><b>Escala de satisfaccion</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_indicadores" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10%;">Ambito</th>
                <th style="width: 10%;">Indicador</th>
                <th style="width: 10%;">Escala</th>
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
          <h3 class="box-title"><b>Comparacion Sobre la Calidad de Gestión de Manejo Año Anterior y Actual</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_comparacion" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10%;">Ambito</th>
                <th style="width: 10%;">UCG</th>
                <th style="width: 10%;">ANTERIOR</th>
                <th style="width: 10%;">ACTUAL</th>
                <th style="width: 10%;">%CG</th>
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
          <h3 class="box-title"><b>Comparacion temporal sobre la Calidad de Gestión de Manejo Período Cinco Años</b></h3>
        </div>
        <div class="box-body">
          <table id="tabla_comparacion2" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10%;">Ambito</th>
                <th style="width: 10%;">UCG</th>
                <th style="width: 10%;">EV1</th>
                <th style="width: 10%;">EV2</th>
                <th style="width: 10%;">EV3</th>
                <th style="width: 10%;">EV4</th>
                <th style="width: 10%;">EV5</th>
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

    <div>
      <img style="background-color:white; display:none;" id="imgChartLine" width="625" height="315" src="">
    </div>
    <div>
      <img style="background-color:white; display:none;" id="imgChartBar" width="625" height="315" src="">
    </div>
</section>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
<script src="./recursos/js/jsmodelo/calculo.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>