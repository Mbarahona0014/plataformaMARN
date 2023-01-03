<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once './layout/head.php'; ?>
</head>
<!-- Instanciar clases -->

<body class="hold-transition layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php require_once './layout/nav.php'; ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php require_once './layout/aside.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mantenimiento Evaluador</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Evaluador</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- Default box -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Formulario Evaluador</b></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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

                  <div class="form-group col-md-3 mb-3">
                    <label for="correo">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese el correo del evaluador" />
                  </div>

                  <div class="form-group col-md-3 mb-3">
                    <label for="telefono">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese el telefono"></textarea>
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
                <h3 class="card-title"><b>Listado de evaluadores</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="tabla_evaluadores" class="table table-bordered display nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Correo</th>
                      <th>Telefono</th>
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
                      <th>Acción</th>
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
    </div>
    <!-- /.content-wrapper -->

    <?php require_once './layout/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php require_once './layout/scripts.php'; ?>
  <script src="./js/evaluador.js"></script>
</body>

</html>