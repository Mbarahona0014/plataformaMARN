<?php 
  require_once "header.php"; 
  //SOLO ADMIN PUEDE VER ESTA VISTA
  if($_SESSION['idtipousuario']==2 || $_SESSION['idtipousuario']==3 || $_SESSION['idtipousuario']==4 || $_SESSION['idtipousuario']==5)
  {
    //session_destroy();
    echo "<script>window.location.href='vinicio.php'</script>";
    //header("location:index.php");
  }
?>
<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">
<!--Javascript-->

<script src="recursos/media/js/jquery-1.10.2.js"></script>
<script src="recursos/media/js/bootstrap.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsusuario.js"></script>

<link rel="stylesheet" href="recursos/css/select2.css">
<script  type="text/javascript" src="recursos/js/select2.js"></script>


<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ingreso de datos</h1>
              <h5 name="evaluacion_subs" id="temaSubs">No ha seleccionado evaluacion</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Evaluacion</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- Default box -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Ingresar/Actualizar evaluacion</b></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Agregar evaluadores</b></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form id="form_evaluador" class="row">
                  <input type="hidden" name="id_encabezado" id="id_encabezado">
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
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Lista de Evaluaciones</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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
              <!-- /.card-body -->
            </div>
          </div>

          <!-- /.card -->
          <div class="col-md-12" id="div_reporte">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>REPORTE DE MONITOREO DE AREAS PROTEGIDAS</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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
                    <label for="obser_deta">Observaciones reporte:</label>
                    <textarea class="form-control" name="obser_deta" id="obser_deta" rows="5" placeholder="Ingrese las observaciones"></textarea>
                  </div>
                  <div class="form-group col-md-6 mb-3" id="div_evidencias">
                    <label for="evi_deta">Evidencia reporte:</label>
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
                      <th style="width: 45%;">Tema</th>
                      <th style="width: 45%;">Evidencia</th>
                      <th style="width: 20%;">Calificacion revisada</th>
                      <th style="width: 20%;">Observacion y compromisos</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="width: 10%;">Ámbito</th>
                      <th style="width: 45%;">Tema</th>
                      <th style="width: 45%;">Evidencia</th>
                      <th style="width: 20%;">Calificacion revisada</th>
                      <th style="width: 20%;">Observacion y compromisos</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </section>
  <script src="./js/evaluacion.js"></script>
  <script src="./dist/js/app.min.js"></script>
</body>

</html>