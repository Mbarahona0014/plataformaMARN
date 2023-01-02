<?php 

require_once "header.php"; 

//SOLO USUARIO DE RESTAURACION Y EXTERNO NO PUEDEN VER ESTA VISTA
  if($_SESSION['idtipousuario']==2 || $_SESSION['idtipousuario']==5)
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
    <script type="text/javascript" src="recursos/js/jsmodelo/jsconsultarinformeincendio.js"></script>
    

	<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


    <!-- BOTONES DE DATATABLE PARA EXCEL -->
	<!-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	 -->
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>






	
	<div class="container">
		
			<hr>
			<div class="row">
				<form id="formconsultarinforme" action="#" method="POST" >
				<div class="col-md-12">
					<div class="form-group col-md-5">
					    <label for="txtfechainicio">
					    					Fecha de inicio
						</label>
						<!--input-->
					    <input type="date" class="form-control form-control-lg text-center" name="txtfechainicio" id="txtfechainicio" placeholder="" required>
					</div>
					<div class="form-group col-md-5">
					    <label for="txtfechafin">
					    					Fecha de finalización
						</label>
						<!--input-->
					    <input type="date" class="form-control form-control-lg text-center" name="txtfechafin" id="txtfechafin" placeholder="" required>
					</div>

					<div class="form-group col-md-2">
						<br>
						<button type="button" id="btnconsultarinforme" class="btn btn-primary">
								  Consultar&nbsp;&nbsp;<i class="fa fa-info" aria-hidden="true"></i>
						</button>
					</div>


					
				</div>
			</form>
			</div>
			<hr>

			<!--AQUI IRA LA TABLA DE DATOS QUE IMPRIMIREMOS EN JS-->
			<h3><b>Informe de incendios</b></h3>
			<div class="row">

				<div class="col-md-12">
					<div class="container" style="background-color: white;">
						<br>
						<br>
						<br>
						<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				        <thead>
				        <tr>
				            <th>Área Natural Protegida</th>
				            <th>Hectáreas afectadas</th>
				            <th>Número de incendios</th>
				        </tr>
				        </thead>
				        <tbody>
				        </tbody>
				        <tfoot>
				        <tr>
				            <th>Área Natural Protegida</th>
				            <th>Hectáreas afectadas</th>
				            <th>Número de incendios</th>
				        </tr>
				        </tfoot>
				    </table>        
					</div>	<br>



				<h3><b>Informe de incendios por mes</b></h3>
				<div class="row">

				<div class="col-md-12">
					<div class="container" style="background-color: white;">
						<br>
						<br>
						<br>
						<table id="example3" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				        <thead>
				        <tr>
				            <th>Mes</th>
				            <th>Área Natural Protegida</th>
				            <th>Hectáreas afectadas</th>
				            <th>Número de incendios</th>
				        </tr>
				        </thead>
				        <tbody>
				        </tbody>
				        <tfoot>
				        <tr>
				        	<th>Mes</th>
				            <th>Área Natural Protegida</th>
				            <th>Hectáreas afectadas</th>
				            <th>Número de incendios</th>
				        </tr>
				        </tfoot>
				    </table>        
					</div>	<br>


		
			</div>



				<h3><b>Informe sobre causas de incendios</b></h3>
				<div class="row">

				<div class="col-md-12">
					<div class="container" style="background-color: white;">
						<br>
						<br>
						<br>
						<table id="example2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				        <thead>
				        <tr>
				            <th>Causa de incendio</th>
				            <th>Cantidad</th>
				        </tr>
				        </thead>
				        <tbody>
				        </tbody>
				        <tfoot>
				        <tr>
				            <th>Causa de incendio</th>
				            <th>Cantidad</th>
				        </tr>
				        </tfoot>
				    </table>        
					</div>	<br>


		
			</div>



		
			</div>
	</div>
	








<!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>


    
</body>
</html>