<!-- <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    function changeNumber() {
        $.ajax({
            type: "POST",
            url: "notificaciones.php",
            success: function(data) {
                document.getElementById('input3').innerHTML = data ;
            }
        });
    }
    setInterval(changeNumber, 1000);
});
</script> -->
<?php
session_start();
//DESCOMENTAREAR PARA DESHABILITAR SESIONES
require_once "seguridad.php";

require_once "../modelo/daomenu.php";

  $dat = new daomenu();


  $r2=$dat->consultarlistanoti();
  $impresionnombre= explode(" ", $_SESSION['nombre']);

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Proyecto</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-green.css">
    <link rel="stylesheet" href="recursos/css/lightbox.min.css">

    <!-- agregando referencias de mapa -->
    <!-- <link rel="stylesheet" href="https://js.arcgis.com/4.20/esri/themes/light/main.css"> -->
    <link rel="stylesheet" href="https://js.arcgis.com/4.23/esri/themes/light/main.css">
    

    <!-- SWEETALERT2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      .swal2-container {
        zoom: 1.5;
      }

      #logomenu{
        -webkit-filter:invert(70%);
        filter:invert(70%);
      }
    </style>
    



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header" >

        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg text-center"><!--<b>Renova</b>&nbsp;Autos--><img src="recursos/images/LOGOMARNB.png" width="125" height="42"></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- ESPACIO DEL ICONO DE MENSAJES -->











              



              <!-- NOTIFICACIONES SI ES USER ADMIN -->

              <?php
                /*if ($_SESSION['idtipousuario']==1 || $_SESSION['idtipousuario']==3 || $_SESSION['idtipousuario']==5) {
                  if($r2>0){
                    echo "<li><a href='vaprobacionregistro.php' data-toggle='control-sidebar'><i class='fa fa-bell'><b><span id='input3'></b></i></a></li>";
                  }else{
                    echo "<li><a href='#' data-toggle='control-sidebar'><i class='fa fa-bell'></i></a></li>";
                  }
                  
                
                }else{

                
                }*/
              ?>

              





















              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->

                  <?php
                   echo ' <img src="recursos/images/logouser.png" class="user-image" alt="User Image">';
                  ?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php/* echo "USUARIO";*/echo $_SESSION['nombre'];  ?></span>
                </a>


                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <!--FOTO USUARIO-->
                    <?php
                   //echo ' <img src="recursos/images/Empleados/'.$_SESSION['photo'].'" class="img-circle" alt="User Image">';
                    echo ' <img src="recursos/images/logouser.png" class="img-circle" alt="User Image" height="20px" width="50">';

                    ?>
                    <p>
                      <?php echo $_SESSION['nombre']; 
                      /*echo "USUARIO";*/
                      ?>
                      <small><?php echo $_SESSION['correo']; ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->



                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="vPerfil.php" class="btn btn-default btn-flat">Perfil</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="salir.php" class="btn btn-default btn-flat">Cerrar sesión</a>
                    </div>
                  </li>
                </ul>
              </li>



              <!-- ICONO HERRAMIENTA SLIDE A LA PAR DE USUARIO -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
              <!-- CIERRE -->




            </ul>
          </div>
        </nav>
      </header>






<!-- BARRA LATERAL IZQUIERDA -->

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image" >

              <?php
                   echo ' <img src="recursos/images/logouser.png" class="img-circle text-center" alt="User Image">';
                   //echo ' <img src="recursos/images/logomarn.png">';
              ?>
            </div>
            <div class="pull-left info">
              <p><?php /*echo $impresionnombre[0]." ".$impresionnombre[2];*/ echo $_SESSION['solonombre']; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>



          <!-- Sidebar Menu -->
           <?php require_once "validacioningreso.php"; ?>

          <!-- /.sidebar-menu -->



        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- CONTENIDOS -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
