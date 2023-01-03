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
              <h1>Mantenimiento Área Natural</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Área Natural</li>
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
                <h3 class="card-title"><b>FORMULARIO ÁREA NATURAL</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form id="form_area" class="row">
                  <input type="hidden" name="id_area" id="id_area">

                  <div class="form-group col-md-4 mb-3">
                    <label for="nombre">Nombre área:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del área" />
                  </div>

                  <div class="form-group col-md-4 mb-3">
                    <label for="ubicacion">Ubicación área:</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingrese ubicación del área" />
                  </div>

                  <div class="form-group col-md-4 mb-3">
                    <label for="ext">Extensión de terreno área:</label>
                    <input type="text" class="form-control" id="ext" name="ext" placeholder="Ingrese extensión del área" />
                  </div>

                  <div class="form-group col-md-12 mb-3">
                    <label for="desc">Descripción área:</label>
                    <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Ingrese la descripción del área"></textarea>
                  </div>

                  <div class="form-group col-md-12 mb-3">
                    <label for="obser">Observaciones área:</label>
                    <textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingrese las observaciones del área"></textarea>
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
                <h3 class="card-title"><b>LISTADO ÁREAS NATURALES</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
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
  <script src="./js/area.js"></script>
</body>

</html>