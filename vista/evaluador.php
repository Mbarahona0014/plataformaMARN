<?php
require_once "header.php";
//SOLO ADMIN PUEDE VER ESTA VISTA
if ($_SESSION['idtipousuario'] != 1 || $_SESSION['idtipousuario'] != 7) {
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
    <h1><b>Mantenimiento Evaluador</b></h1>
  </h1>
  <ol class="breadcrumb">
    <li><span><i class="fa fa-home"></i>Inicio</a></span></li>
    <li class="active"><span>Evaluadores</span></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Formulario de evaluador</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_evaluador" class="row">
            <input type="hidden" name="id_evaluador" id="id_evaluador">

            <div class="form-group col-md-6 mb-3">
              <label for="nombres">Nombres:</label>
              <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese los nombres del evaluador" />
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="apellidos">Apellidos:</label>
              <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese los apellidos del evaluador" />
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="correo">Correo:</label>
              <input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese el correo del evaluador" />
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="telefono">Telefono:</label>
              <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese el telefono"></textarea>
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="telefono">Institucion:</label>
              <input type="text" class="form-control" name="institucion" id="institucion" placeholder="Ingrese el telefono"></textarea>
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="telefono">Cargo:</label>
              <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Ingrese el telefono"></textarea>
            </div>

            <div class="form-group col-md-12">
              <button type="button" id="btn_cancelar" class="btn btn-danger float-right">Cancelar</button>
              <button type="submit" id="btn_enviar" class="btn btn-primary float-right mr-2">Guardar</button>
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
          <h3 class="box-title"><b>Lista de evaluadores</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="tabla_evaluadores" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Institucion</th>
                <th>Cargo</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Institucion</th>
                <th>Cargo</th>
                <th>Acción</th>
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
<!-- /.content -->

<script src="./recursos/js/jsmodelo/evaluador.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>