<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio de sesión</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->

    <!-- SWEETALERT2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <script src="recursos/media/js/jquery-1.10.2.js"></script>

    <script type="text/javascript" src="recursos/js/jsmodelo/jssesion.js"></script>
    <style type="text/css">
      body {background-color:#313945 !important; }
      .login-box-body{ background-color: #d2d2d2d2  !important }
      p{ color:#1c1e4d; }
      #logologin{
        -webkit-filter:invert(80%);
        filter:invert(80%);
      }
      .swal2-container {
        zoom: 1.5;
      }


    </style>
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page" >
    <div class="login-box">
      <div class="login-logo">
        
      </div><!-- /.login-logo -->
      <br>
      <div class="login-box-body">
        <center><a href="#"><!--<b>Admin</b>LTE--><img src="recursos/images/LOGOMARNB.png" id="logologin" width="270" height="90"></center><br></a>
        <p class="login-box-msg"><b>¡BIENVENIDO/A!</b></p>
        <p class="login-box-msg">Loguéate para poder iniciar sesión.</p>
        <!-- <form id="frmsesion" method="POST" action="../modelo/login.php"> -->
          <form id="frmsesion" method="POST">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="usuario" placeholder="Correo" id="usuario" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="contra" placeholder="Contraseña" id="contra" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" id="btnsesion" name="btnsesion" class="btn btn-primary btn-block btn-flat">Iniciar sesión</button>
              <a id="btnrecuperarcontra" name="btnrecuperarcontra" class="btn btn-link btn-block btn-flat">Olvidé mi contraseña...</a>
            </div><!-- /.col -->
            
          </div>
        </form>

        

        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    
   
  </body>
</html>
