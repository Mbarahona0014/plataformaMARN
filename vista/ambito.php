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


<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <h1><b>Mantenimiento Ámbito</b></h1>
  </h1>
  <ol class="breadcrumb">
    <li><span><i class="fa fa-home"></i> Inicio</a></span></li>
    <li class="active"><span>Ámbitos</span></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>FORMULARIO AGENCIAS</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_ambito" class="row">
            <input type="hidden" name="id_ambito" id="id_ambito">

            <div class="form-group col-md-12 mb-3">
              <label for="nombre">Nombre ámbito:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del ámbito" />
            </div>

            <div class="form-group col-md-12 mb-3">
              <label for="desc">Descripción ámbito:</label>
              <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Ingrese la descripción del ámbito"></textarea>
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
          <h3 class="box-title"><b>LISTADO ÁMBITOS</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="tabla_ambitos" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 20%;">Nombre</th>
                <th style="width: 60%;">Descripción</th>
                <th style="width: 20%;">Acción</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th style="width: 20%;">Nombre</th>
                <th style="width: 60%;">Descripción</th>
                <th style="width: 20%;">Acción</th>
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
<script src="./js/ambito.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>