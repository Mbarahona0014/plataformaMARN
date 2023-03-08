<?php
require_once "header.php";
//SOLO ADMIN PUEDE VER ESTA VISTA
if ($_SESSION['idtipousuario'] != 1 ) {
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
    <h1><b>Mantenimiento Coordenada</b></h1>
  </h1>
  <ol class="breadcrumb">
    <li><span><i class="fa fa-home"></i>Inicio</a></span></li>
    <li class="active"><span>Coordenadas</span></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Formulario de Coordenada</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_cord" class="row">
            <input type="hidden" name="id_cord" id="id_cord">
            <div class="form-group col-md-12 mb-3">
              <label>Area natural</label>
              <select class="form-control select2" name="area" id="area" style="width: 100%;"></select>
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="apellidos">Latitud:</label>
              <input type="text" class="form-control" id="lat" name="lat" placeholder="Ingrese la latitud"/>
            </div>

            <div class="form-group col-md-6 mb-3">
              <label for="correo">Longitud:</label>
              <input type="text" class="form-control" id="lon" name="lon" placeholder="Ingrese la longitud"/>
            </div>

            <div class="form-group col-md-12">
              <button type="submit" id="btn_agregar" class="btn btn-primary float-right mr-2">Guardar</button>
              <button type="submit" id="btn_cancelar" class="btn btn-danger float-right mr-2">Cancelar</button>
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
          <h3 class="box-title"><b>Lista de Coordenadas</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="tabla_cord" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ANP</th>
                <th>Latitud</th>
                <th>Longitud</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th>ANP</th>
                <th>Latitud</th>
                <th>Longitud</th>
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

<script src="./recursos/js/jsmodelo/coordenadas.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>