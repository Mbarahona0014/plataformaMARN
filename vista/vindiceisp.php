<?php 

require_once "header.php"; 

  //SOLO USUARIO EXTERNO Y USUARIO INTERNO/INCEDNDIOS NO PUEDEN VER ESTA PAGINA
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
    <script type="text/javascript" src="recursos/js/jsmodelo/jsindiceisp.js"></script>
    
    <link rel="stylesheet" href="recursos/css/select2.css">
	<script  type="text/javascript" src="recursos/js/select2.js"></script>


    <script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


	<!-- BOTONES DE DATATABLE PARA EXCEL -->
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>


<div class="container">

 <div class="row">
  <div class="col-lg-12">
   <!--AQUI ESTABA EL BOTON Y LO PASE ABAJO ANTES DE LA TABLA -->
   <div class="modal fade bd-example-modal-md" id="modalindiceisp"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">
					        Formulario Índice de Sustentabilidad para la Restauración de Paisajes(ISP)
					   		 </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-center">
					        <form id="formindiceisp" action="#" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
					        	<div class="form-group">
					              <label for="txt">
					                Seleccionar paisaje
					              </label>
					              <!--input-->
					              <select class="form-control form-control-lg text-center" id="tppaisaje" name="tppaisaje" style="width: 100%" required>

					              </select>
					              <!------------------------------------->
					              <input type="text" class="form-control form-control-lg text-center" name="miinputotros" id="miinputotros" placeholder="Nombre de área de conservación" disabled>

					              <div id="miinputotros" name="miinputotros">
					              </div>

					            </div>
								 <div class="form-group col-md-6">
								    <label for="txtica">
								    					Ingresar ICA
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtica" id="txtica" placeholder="Índice de Calidad del Agua" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtiq">
								    					Ingresar IQ
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtiq" id="txtiq" placeholder="Índice de Caudales" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtibp">
								    					Ingresar IBP
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtibp" id="txtibp" placeholder="Índice de Biodiversidad del paisaje" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txticoe">
								    					Ingresar ICOE
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txticoe" id="txticoe" placeholder="Índice de Carbono Adicional" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtics">
								    					Ingresar ICS
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtics" id="txtics" placeholder="Índice de Calidad de Suelos" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtita">
								    					Ingresar ITA
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtita" id="txtita" placeholder="Índice de Jornales Adicionales" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtirv">
								    					Ingresar IRV
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtirv" id="txtirv" placeholder="Índice de Reducción de Vulnerabilidad" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtigp">
								    					Ingresar IGP
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtigp" id="txtigp" placeholder="Índice de Gobernanza de Paisajes" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtfechainicio">
								    					Fecha de inicio
									</label>
									<!--input-->
								    <input type="date" class="form-control form-control-lg text-center" name="txtfechainicio" id="txtfechainicio" placeholder="Índice de Gobernanza de Paisajes" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtfechafin">
								    					Fecha de finalización
									</label>
									<!--input-->
								    <input type="date" class="form-control form-control-lg text-center" name="txtfechafin" id="txtfechafin" placeholder="Índice de Gobernanza de Paisajes" required>
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
			<h3><b>Índice de Sustentabilidad para la Restauración de Paisajes(ISP)</b></h3>
			<div class="row">

				<div class="col-md-12">
					<div class="container" style="background-color: white;">
						<br>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalindiceisp" data-backdrop="static" data-keyboard="false">
					  			Cálcular Índice ISP&nbsp;&nbsp;<i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
					</button>
						<br>
						<br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					        <thead>
					        	<tr>
					        		<th>Paisaje</th>
					            	<th>ICA</th>
					            	<th>IQ</th>
					            	<th>IBP</th>
					            	<th>ICOE</th>
					            	<th>ICS</th>
					            	<th>ITA</th>
					            	<th>IRV</th>
					            	<th>IGP</th>
					            	<th>Cálculo ISP</th>
					            	<th>Fecha de inicio</th>
					            	<th>Fecha de finalización</th>
					            	<th>Acciones</th>
					        	</tr>
					        </thead>
					        <tbody>
					        </tbody>
					        <tfoot>
					        	<tr>
					        		<th>Paisaje</th>
					            	<th>ICA</th>
					            	<th>IQ</th>
					            	<th>IBP</th>
					            	<th>ICOE</th>
					            	<th>ICS</th>
					            	<th>ITA</th>
					            	<th>IRV</th>
					            	<th>IGP</th>
					            	<th>Cálculo ISP</th>
					            	<th>Fecha de inicio</th>
					            	<th>Fecha de finalización</th>
					            	<th>Acciones</th>
					        	</tr>
					        </tfoot>
					    </table>        
					</div>	
					<br>

				<!--OTRO MODAL-->
				<div class="modal fade bd-example-modal-lg" id="modalindiceisp2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">
					        											Formulario Índice de Sustentabilidad para la Restauración de Paisajes(ISP)
					   		 </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-center">
					        <form name="formindiceisp2" id="formindiceisp2" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
								<div class="form-group">
									<input type="hidden" class="form-control text-center" name="txtid2" id="txtid2" placeholder="indiceisp">
								</div>
								<div class="form-group">
					              <label for="txt">
					                Seleccionar paisaje
					              </label>
					              <!--input-->
					              <select class="form-control form-control-lg text-center" id="tppaisaje2" name="tppaisaje2" style="width: 100%" required>

					              </select>
					              <input type="text" class="form-control form-control-lg text-center" name="miinputotros2" id="miinputotros2" placeholder="Nombre de área de conservación" disabled>
					              <!------------------------------------->
					            </div>
								<div class="form-group col-md-6">
								    <label for="txtica2">
								    					Ingresar ICA
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtica2" id="txtica2" placeholder="Índice de Calidad del Agua" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtiq2">
								    					Ingresar IQ
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtiq2" id="txtiq2" placeholder="Índice de Caudales" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtibp2">
								    					Ingresar IBP
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtibp2" id="txtibp2" placeholder="Índice de Biodiversidad del paisaje" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txticoe2">
								    					Ingresar ICOE
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txticoe2" id="txticoe2" placeholder="Índice de Carbono Adicional" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtics2">
								    					Ingresar ICS
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtics2" id="txtics2" placeholder="Índice de Calidad de Suelos" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtita2">
								    					Ingresar ITA
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtita2" id="txtita2" placeholder="Índice de Jornales Adicionales" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtirv2">
								    					Ingresar IRV
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtirv2" id="txtirv2" placeholder="Índice de Reducción de Vulnerabilidad" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtigp2">
								    					Ingresar IGP
									</label>
									<!--input-->
								    <input type="number" class="form-control form-control-lg text-center" name="txtigp2" id="txtigp2" placeholder="Índice de Gobernanza de Paisajes" step=".01" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtfechainicio2">
								    					Fecha de inicio
									</label>
									<!--input-->
								    <input type="date" class="form-control form-control-lg text-center" name="txtfechainicio2" id="txtfechainicio2" placeholder="Índice de Gobernanza de Paisajes" required>
								</div>
								<div class="form-group col-md-6">
								    <label for="txtfechafin2">
								    					Fecha de finalización
									</label>
									<!--input-->
								    <input type="date" class="form-control form-control-lg text-center" name="txtfechafin2" id="txtfechafin2" placeholder="Índice de Gobernanza de Paisajes" required>
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