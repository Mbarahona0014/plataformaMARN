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
    <script type="text/javascript" src="recursos/js/jsmodelo/jsespecie.js"></script>
    

     <script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>







	
	<div class="container">
		
			<div class="row">
				<div class="col-lg-12">
					
					<div class="modal fade bd-example-modal-lg" id="modalespecie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">
					        											Formulario para especie de árbol
					   		 </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-center">
					        <form id="formespecie" action="#" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
								<div class="form-group">
								    <label for="txtcodigo">
								    					Ingresar código
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtcodigo" id="txtcodigo" placeholder="Código" required>
								</div>
								<div class="form-group">
								    <label for="txtgenero">
								    					Ingresar género
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtgenero" id="txtgenero" placeholder="Género" required>
								</div>
								<div class="form-group">
								    <label for="txtespecie">
								    					Ingresar nombre de especie
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtespecie" id="txtespecie" placeholder="Nombre de especie" required>
								</div>
								<div class="form-group">
								    <label for="txtsubespecie">
								    					Ingresar nombre de subespecie
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtsubespecie" id="txtsubespecie" placeholder="Nombre de subespecie">
								</div>
								<div class="form-group">
								    <label for="txtnombrecomun">
								    					Ingresar nombre común
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtnombrecomun" id="txtnombrecomun" placeholder="Nombre común">
								</div>
								<div class="form-group">
								    <label for="txtcategoria">
								    					Ingresar categoria
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtcategoria" id="txtcategoria" placeholder="Categoria">
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
			<h3><b>Especies de árboles</b></h3>
			<div class="row">

				<div class="col-md-12">
					<div class="container" style="background-color: white;">
						<br>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalespecie" data-backdrop="static" data-keyboard="false">
					  			Ingresar especie&nbsp;&nbsp;<i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
					</button>
						<br>
						<br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				        <thead>
				        <tr>
				            <th>Código</th>
				            <th>Género</th>
				            <th>Especie</th>
				            <th>Subespecie</th>
				            <th>Nombre común</th>
				            <th>Categoria</th>
				            <th>Acciones</th>
				        </tr>
				        </thead>
				        <tbody>
				        </tbody>
				        <tfoot>
				        <tr>
				            <th>Código</th>
				            <th>Género</th>
				            <th>Especie</th>
				            <th>Subespecie</th>
				            <th>Nombre común</th>
				            <th>Categoria</th>
				            <th>Acciones</th>
				        </tr>
				        </tfoot>
				    </table>        
					</div>	<br>


				<!--OTRO MODAL-->
				<div class="modal fade bd-example-modal-lg" id="modalespecie2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">
					        											Formulario para especie de árbol
					   		 </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-center">
					        <form name="formespecie2" id="formespecie2" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
								<div class="form-group">
									<!--input-->
									<input type="hidden" class="form-control text-center" name="txtid2" id="txtid2" placeholder="especie">
								</div>

								<div class="form-group">
								    <label for="txtcodigo2">
								    					Ingresar código
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtcodigo2" id="txtcodigo2" placeholder="Código" required>
								</div>
								<div class="form-group">
								    <label for="txtgenero2">
								    					Ingresar género
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtgenero2" id="txtgenero2" placeholder="Género" required>
								</div>
								<div class="form-group">
								    <label for="txtespecie2">
								    					Ingresar nombre de especie
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtespecie2" id="txtespecie2" placeholder="Nombre de especie" required>
								</div>
								<div class="form-group">
								    <label for="txtsubespecie2">
								    					Ingresar nombre de subespecie
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtsubespecie2" id="txtsubespecie2" placeholder="Nombre de subespecie">
								</div>
								<div class="form-group">
								    <label for="txtnombrecomun2">
								    					Ingresar nombre común
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtnombrecomun2" id="txtnombrecomun2" placeholder="Nombre común">
								</div>
								<div class="form-group">
								    <label for="txtcategoria2">
								    					Ingresar categoria
									</label>
									<!--input-->
								    <input type="text" class="form-control form-control-lg text-center" name="txtcategoria2" id="txtcategoria2" placeholder="Categoria">
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