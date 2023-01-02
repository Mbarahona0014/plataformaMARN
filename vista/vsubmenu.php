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


<link rel="stylesheet" href="recursos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">


<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">
<!--Javascript-->
<script src="recursos/media/js/jquery-1.10.2.js"></script>
<script src="recursos/media/js/bootstrap.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jssubmenu.js"></script>

<link rel="stylesheet" href="recursos/css/select2.css">
<script  type="text/javascript" src="recursos/js/select2.js"></script>


<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>








<div class="container">

 <div class="row">
  <div class="col-lg-12">
   <!--AQUI ESTABA EL BOTON Y LO PASE ABAJO ANTES DE LA TABLA -->
   <div class="modal fade bd-example-modal-md" id="modalsubmenu"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">
            Formulario Sub-menu
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form id="frmsubmenu" name="frmsubmenu" enctype="multipart/form-data" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
            <div class="form-group">
              <label for="txt">
                Ingresar Nombre del Sub-menu
              </label>
              <input type="text" class="form-control form-control-lg text-center" name="txtvalor" id="txtvalor" placeholder="menu" required>
              <!------------------------------------->
            </div>
            <div class="form-group">
              <label for="txt">
                Ingresar Nombre de la vista del Sub-menu
              </label>
              <input type="text" class="form-control form-control-lg text-center" name="txtvista" id="txtvista" placeholder="menu" required>
              <!------------------------------------->
            </div>
            <div class="form-group">
              <label for="txt">
                Seleccionar el menu
              </label>
              <!--input-->
              <select class="form-control form-control-lg text-center" id="tpmenu" name="tpmenu" style="width: 100%" required>

              </select>
              <!------------------------------------->
            </div>
            
            <button type="submit" id="btnguardar" class="btn btn-primary">
              Guardar&nbsp;&nbsp;<i class="fa fa-save" aria-hidden="true"></i>
            </button>
          </form>


      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Cerrar
      </button>
    </div>
  </div>
</div>
</div>
</div>

</div>
<hr>
<!--AQUI IRA LA TABLA DE DATOS QUE IMPRIMIREMOS EN JS-->
<h3><b>Sub-menu</b></h3><div id="btnatras"></div>
<div class="row">
  <div class="col-md-12">
    <div class="container" style="background-color: white;">
      <br>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalsubmenu" data-backdrop="static" data-keyboard="false">
        Ingresar SubMenu&nbsp;&nbsp;<i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
      </button>
      <br><br>
      <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Valor Sub-menu</th>
            <th>Vista</th>
            <th>Tipo de menu</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th>Valor Sub-menu</th>
            <th>Vista</th>
            <th>Tipo de menu</th>
            <th>Accion</th>
          </tr>
        </tfoot>
      </table>
    </div><br>

    <!--OTRO MODAL-->
    <div class="modal fade bd-example-modal-md" id="modalsubmenu2"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">
            Formulario Sub-menu
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body text-center">
        <form id="frmsubmenu2" enctype="multipart/form-data" name="frmsubmenu2" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
          <input type="hidden" class="form-control form-control-lg text-center" name="txtidsubmenu2" id="txtidsubmenu2" placeholder="txtidsubmenu2">
          <div class="form-group">
              <label for="txt">
                Ingresar Nombre el Sub-menu
              </label>
              <input type="text" class="form-control form-control-lg text-center" name="txtvalor2" id="txtvalor2" placeholder="menu" required>
              <!------------------------------------->
            </div>
          <div class="form-group">
              <label for="txt">
                Ingresar Nombre de la vista del Sub-menu
              </label>
              <input type="text" class="form-control form-control-lg text-center" name="txtvista2" id="txtvista2" placeholder="menu" required>
              <!------------------------------------->
            </div>
            <div class="form-group">
              <label for="txt">
                Seleccionar el menu
              </label>
              <!--input-->
              <select class="form-control form-control-lg text-center" id="tpmenu2" name="tpmenu2" style="width: 100%" required>

              </select>
              <!------------------------------------->
            </div>

          <button type="submit" id="btnmodificar" class="btn btn-primary">
           Modificar&nbsp;&nbsp;<i class="fa fa-edit" aria-hidden="true"></i>
         </button>
       </form>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Cerrar
      </button>
    </div>
  </div>
</div>
</div>
</div>
</div>




<script src="dist/js/app.min.js"></script>



</body>
</html>