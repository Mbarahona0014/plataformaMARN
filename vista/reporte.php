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
              <h1>Asignacion de puntajes</h1>
              <div name="reporte_subs" id="reporte_subs" >

              </div>
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
          <div class="col-md-12">
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
                <table id="tabla_encabezado" class="table table-bordered display nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 20%;">Tema</th>
                      <th style="width: 35%;">Evidencia</th>
                      <th style="width: 35%;">Calificacion revisada</th>
                      <th style="width: 10%;">Observacion y compromisos</th>
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
  <script src="./js/evaluacion.js"></script>
</body>

</html>