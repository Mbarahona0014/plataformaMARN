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

      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mantenimiento Ámbito</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Ámbito</li>
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
                <h3 class="card-title"><b>FORMULARIO ÁMBITO</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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
              <!-- /.card-body -->
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>LISTADO ÁMBITOS</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
  <script src="./js/ambito.js"></script>
  <script src="./dist/js/app.min.js"></script>
</body>

</html>