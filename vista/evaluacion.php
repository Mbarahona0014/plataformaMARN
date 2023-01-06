<?php
require_once "header.php";
//SOLO ADMIN PUEDE VER ESTA VISTA
if ($_SESSION['idtipousuario'] == 2 || $_SESSION['idtipousuario'] == 3 || $_SESSION['idtipousuario'] == 4 || $_SESSION['idtipousuario'] == 5) {
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
    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Formulario área natural protegida</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_encabezado" class="row">
            <input type="hidden" name="id_encabezado" id="id_encabezado">
            <div class="form-group col-md-12 mb-3">
              <div class="form-group">
                <label>Area natural</label>
                <select name="area" id="area" class="form-control">

                </select>
              </div>
            </div>

            <div class="form-group col-md-12 mb-3">
              <label for="fecha">Fecha de evaluacion</label>
              <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Ingrese la descripción del tema"></textarea>
            </div>
            <div class="form-group col-md-12">
              <button type="submit" id="btn_agregar_encabezado" class="btn btn-primary float-right mr-2">Guardar</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Asignar evaluadores</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>


        <div class="box-body">
          <form id="form_evaluador" class="row">
            <input type="hidden" name="id_encabezado" id="id_encabezado">

            <div class="callout callout-warning" id="calloutEvaluacion" name="calloutEvaluacion">
              <p id="calloutText" name="calloutText">No se ha seleccionado evaluacion!</p>
            </div>

            <div class="form-group col-md-12 mb-3">
              <div class="form-group">
                <label for="listaEvaluadores">Evaluadores</label>
                <div name="listaEvaluadores" id="listaEvaluadores">

                </div>
              </div>
            </div>
            <div class="form-group col-md-12 mb-3">
              <div class="form-group">
                <label>Selecciona el evaluador</label>
                <select name="evaluador" id="evaluador" class="form-control">

                </select>
              </div>
            </div>
            <div class="form-group col-md-12">
              <button type="submit" id="btn_agregar_evaluador" class="btn btn-primary float-right mr-2">Agregar</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
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

    <div class="col-md-12" id="div_reporte">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="card-title"><b>Reporte de monitoreo de áreas naturales protegidas</b></h3>
          <!-- Estado de temas -->
          <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-navy"><i class="fa fa-pencil"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Temas pendientes de evaluar</span>
                  <span class="info-box-number" name="temasPendientes" id="temasPendientes"></span>
                </div>
            </div>
        </div>
        
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_detalle" class="row">
            <input type="hidden" name="id_encabezado_detalle" id="id_encabezado_detalle">
            <div class="col-md-12">
              <h5><b>Evaluación:</b> <span id="span_eva"></span></h5>
            </div>
            <div class="col-md-12">
              <h5><b>Fecha Evaluación:</b> <span id="span_fecha"></span></h5>
            </div>
            <div class="col-md-12 mb-3">
              <h5><b>Área Natural:</b> <span id="spa_area"></span></h5>
            </div>
            <div class="form-group col-md-4 mb-3">
              <div class="form-group">
                <label>Selecciona el ámbito</label>
                <select name="id_ambito" id="id_ambito" class="form-control">

                </select>
              </div>
            </div>
            <div class="form-group col-md-4 mb-3" id="div_tema">
              <div class="form-group">
                <label>Selecciona el tema</label>
                <select name="id_tema" id="id_tema" class="form-control">

                </select>
              </div>
            </div>
            <div class="form-group col-md-4 mb-3" id="div_puntaje">
              <div class="form-group">
                <label>Selecciona el puntaje</label>
                <select name="id_puntaje" id="id_puntaje" class="form-control">

                </select>
              </div>
            </div>
            <div class="form-group col-md-6 mb-3" id="div_observaciones">
              <label for="obser_deta">Observaciones:</label>
              <textarea class="form-control" name="obser_deta" id="obser_deta" rows="5" placeholder="Ingrese las observaciones"></textarea>
            </div>
            <div class="form-group col-md-6 mb-3" id="div_evidencias">
              <label for="evi_deta">Evidencia:</label>
              <textarea class="form-control" name="evi_deta" id="evi_deta" rows="5" placeholder="Ingrese las evidencias"></textarea>
            </div>
            <div class="form-group col-md-12">
              <button type="button" id="btn_cancelar_detalle" class="btn btn-danger float-right mr-2" onclick="cancel()">Cancelar</button>
              <button type="submit" id="btn_agregar_detalle" class="btn btn-primary float-right mr-2">Agregar</button>
            </div>
          </form>
          <table id="tabla_reporte" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10%;">Ámbito</th>
                <th style="width: 25%;">Tema</th>
                <th style="width: 25%;">Calificacion revisada</th>
                <th style="width: 45%;">Evidencia</th>
                <th style="width: 20%;">Observacion y compromisos</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th style="width: 10%;">Ámbito</th>
                <th style="width: 25%;">Tema</th>
                <th style="width: 25%;">Calificacion revisada</th>
                <th style="width: 45%;">Evidencia</th>
                <th style="width: 20%;">Observacion y compromisos</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<script src="./js/evaluacion.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>