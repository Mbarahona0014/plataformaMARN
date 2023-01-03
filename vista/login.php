<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("./layout/head.php"); ?>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="./login" class="h1"><b>Áreas</b>Naturales</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Inicia sesión</p>

        <form id="form-login" action="" method="post">
          <div class="input-group mb-3">
            <input name="user" type="text" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="pass" type="password" class="form-control" placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-6">
              <button id="btn-login" type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <!-- /.col -->
          </div>
          <div class="progress active mt-3" style="display: none;">
            <div class="progress-bar bg-primary progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">0%</div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <?php require_once("./layout/scripts.php"); ?>
  <script src="./js/usuario.js"></script>
</body>

</html>