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
    <h1><b>Mantenimiento Tema</b></h1>
  </h1>
  <ol class="breadcrumb">
    <li><span><i class="fa fa-home"></i> Inicio</a></span></li>
    <li class="active"><span>Temas</span></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>FORMULARIO TEMA</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_tema" class="row">
            <input type="hidden" name="id_tema" id="id_tema">

            <div class="form-group col-md-12 mb-3">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del tema" />
            </div>

            <div class="form-group col-md-12 mb-3">
              <label for="desc">Descripción:</label>
              <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Ingrese la descripción del tema"></textarea>
            </div>

            <div class="form-group col-md-12 mb-3">
              <label for="obser">Observaciones:</label>
              <textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingrese las observaciones del tema"></textarea>
            </div>

            <div class="form-group col-md-12 mb-3">
              <div class="form-group">
                <label>Selecciona el ambito relacionado</label>
                <select name="ambito" id="ambito" class="form-control">

                </select>
              </div>
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

    <div class="col-md-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>FORMULARIO PUNTAJE</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form id="form_puntaje" class="row">
            <input type="hidden" name="id_tema" id="id_tema">
            <input type="hidden" name="id_puntaje" id="id_puntaje">
            <div class="form-group col-md-12 mb-3">
              <div class="form-group">
                <label>Selecciona el puntaje</label>
                <select name="pts" id="pts" class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
            </div>
            <div class="form-group col-md-12 mb-3">
              <label for="desc">Descripcion</label>
              <textarea class="form-control" name="ptsDesc" id="ptsDesc" rows="5" placeholder="Puntaje no ingresado, ingrese la descripcion"></textarea>
            </div>

            <div class="form-group col-md-12">
              <button type="submit" id="btn_enviar_puntaje" class="btn btn-primary float-right mr-2">Guardar</button>
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
          <h3 class="box-title"><b>LISTADO TEMAS</b></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="tabla_temas" class="table table-bordered display nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 20%;">Nombre</th>
                <th style="width: 35%;">Descripción</th>
                <th style="width: 35%;">Observaciones</th>
                <th style="width: 10%;">Acción</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <tr>
                <th style="width: 20%;"></th>
                <th style="width: 35%;"></th>
                <th style="width: 35%;"></th>
                <th style="width: 10%;"></th>
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

<script src="./js/tema.js"></script>
<script src="./dist/js/app.min.js"></script>
</body>

</html>