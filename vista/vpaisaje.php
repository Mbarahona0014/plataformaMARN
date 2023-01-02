<?php 


require_once "header.php"; 


//NO PUEDE VER ESTA VISTA EL USUARIO DE INCENDIOS Y EL USUARIO EXTERNO ID 2 Y 4
  if($_SESSION['idtipousuario']==2 || $_SESSION['idtipousuario']==4)
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
    <script type="text/javascript" src="recursos/js/jsmodelo/jspaisaje.js"></script>
    

    <script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


	<!-- BOTONES DE DATATABLE PARA EXCEL -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> -->








	
	<div class="container">
		
			<div class="row">
				<div class="col-lg-12">
					
					<div class="modal fade bd-example-modal-lg" id="modalpaisaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">
					        											Formulario para áreas de conservación
					   		 </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-center">
					        <form id="formpaisaje" action="#" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
								  <div class="form-group">
								    <label for="txtnombre">
								    					Ingresar nombre de área de conservación
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtnombre" id="txtnombre" placeholder="Nombre de paisaje" required>
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
			<h3><b>Áreas de conservación</b></h3>
			<div class="row">

				<div class="col-md-12">
					<div class="container" style="background-color: white;">
						<br>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalpaisaje" data-backdrop="static" data-keyboard="false">
					  			Ingresar área de conservación&nbsp;&nbsp;<i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
					</button>
						<br>
						<br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				        <thead>
				        <tr>
				            <th>Áreas de conservación</th>
				            <th>Acciones</th>
				        </tr>
				        </thead>
				        <tbody>
				        </tbody>
				        <tfoot>
				        <tr>
				            <th>Áreas de conservación</th>
				            <th>Acciones</th>
				        </tr>
				        </tfoot>
				    </table>        
					</div>	<br>


				<!--OTRO MODAL-->
				<div class="modal fade bd-example-modal-lg" id="modalpaisaje2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">
					        											Formulario para áreas de Conservación
					   		 </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-center">
					        <form name="formpaisaje2" id="formpaisaje2" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
								<div class="form-group">
									<!--input-->
									<input type="hidden" class="form-control text-center" name="txtid2" id="txtid2" placeholder="paisaje">
								</div>

								<div class="form-group">
									<label for="txtnombre2">
								    					Ingresar nombre de área de Conservación
									</label>
									<input type="text" class="form-control form-control-lg text-center" name="txtnombre2" id="txtnombre2" placeholder="Nombre de paisaje" required>
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
	








<!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>


    
</body>
</html>