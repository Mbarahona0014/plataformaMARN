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
<section class="content">
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
  </div>
  <div class="row">
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
  </div>
  <div class="row">
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
  </div>
</section>
<script src="./recursos/js/jsmodelo/calculo.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>