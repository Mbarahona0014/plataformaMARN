<?php
require_once "../modelo/daoinstituciones.php";

function crearinstitucion(){
	$obj=new instituciones();
	$obj->setNombreinstitucion($_POST["txtnombreinstitucion"]);
	$obj->setcorreocontacto($_POST["txtcorreocontacto"]);
	$obj->setContacto($_POST["txtcontacto"]);
	$obj->setTelefono($_POST["txttelefono"]);
	return $obj;
}

function suspenderinstitucion(){
	$obj=new instituciones();
	$obj->setId($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarinstitucion(){
	$obj=new instituciones();
	$obj->setId($_POST["txtid2"]);
	$obj->setNombreinstitucion($_POST["txtnombreinstitucion2"]);
	$obj->setcorreocontacto($_POST["txtcorreocontacto2"]);
	$obj->setContacto($_POST["txtcontacto2"]);
	$obj->setTelefono($_POST["txttelefono2"]);
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daoinstituciones();
		$dat->ingresar(crearinstitucion());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daoinstituciones();
		$dat->suspender(suspenderinstitucion());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daoinstituciones();
		$dat->modificar(modificarinstitucion());
	}

		/*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarnm'){
		$dat = new daotipousuario();
         $r=$dat->consultarn();
         foreach($r as $c){
		      echo $c["nume"];
		    }
	}*/
	
	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		 $dat = new daoinstituciones();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         $id="'".$c["id"]."'";
         $nombreinstitucion="'".str_replace('"', "",$c["nombreinstitucion"])."'";
         $correocontacto="'".str_replace('"', "",$c["correocontacto"])."'";
         $contacto="'".str_replace('"', "",$c["contacto"])."'";
         $telefono="'".str_replace('"', "",$c["telefono"])."'";
         $estado="'".$c["estado"]."'";

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalinstituciones2\" onclick=\"llenarCajas('.$id.','.$nombreinstitucion.','.$correocontacto.','.$contacto.','.$telefono.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.');\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$nombreinstitucion.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$nombreinstitucion.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }
         
         $tabla.='{
				  "nombreinstitucion":"'.str_replace('"', "",$c["nombreinstitucion"]).'",
				  "correocontacto":"'.str_replace('"', "",$c["correocontacto"]).'",
				  "contacto":"'.str_replace('"', "",$c["contacto"]).'",
				  "telefono":"'.str_replace('"', "",$c["telefono"]).'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>