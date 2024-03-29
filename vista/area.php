<?php
require_once "header.php";
//SOLO ADMIN PUEDE VER ESTA VISTA
if ($_SESSION['idtipousuario'] != 1) {
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

<section class="content-header">
  <h1>
    <h1><b>Mantenimiento Área natural protegida</b></h1>
  </h1>
  <ol class="breadcrumb">
    <li><span><i class="fa fa-home"></i>Inicio</a></span></li>
    <li class="active"><span>Áreas naturales protegidas</span></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Formulario Área natural protegida</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_area" class="row">
            <input type="hidden" name="id_area" id="id_area">

            <div class="form-group col-md-4 mb-3">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del área" />
            </div>

            <div class="form-group col-md-4 mb-3">
              <label for="ubicacion">Ubicación:</label>
              <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingrese ubicación del área" />
            </div>

            <div class="form-group col-md-4 mb-3">
              <label for="ext">Extensión de terreno:</label>
              <input type="text" class="form-control" id="ext" name="ext" placeholder="Ingrese extensión del área" />
            </div>

            <div class="form-group col-md-12 mb-3">
              <label for="desc">Descripción:</label>
              <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Ingrese la descripción del área"></textarea>
            </div>

            <div class="form-group col-md-12 mb-3">
              <label for="obser">Observaciones:</label>
              <textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingrese las observaciones del área"></textarea>
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
          <h3 class="box-title"><b>Lista de areas naturales protegidas</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="tabla_areas" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Extensión</th>
                <th>Descripción</th>
                <th>Observaciones</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Extensión</th>
                <th>Descripción</th>
                <th>Observaciones</th>
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
<script src="./recursos/js/jsmodelo/area.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>