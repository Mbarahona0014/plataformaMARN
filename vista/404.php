<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("./layout/head.php"); ?>
</head>

<body class="hold-transition layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php require_once("./layout/nav.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php require_once("./layout/aside.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Página de error 404</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Página de error 404</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="error-page">
          <h2 class="headline text-warning"> 404</h2>

          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> ¡Ups! Página no encontrada.</h3>

            <p>
              No pudimos encontrar la página que estabas buscando.
              Mientras tanto, puedes <a href="./dashboard">volver al inicio.</a>
            </p>
          </div>
          <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require_once("./layout/footer.php"); ?>
  </div>
  <!-- ./wrapper -->

  <?php require_once("./layout/scripts.php"); ?>
</body>

</html>