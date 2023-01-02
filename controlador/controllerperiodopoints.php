<?php
require_once "../modelo/daoperiodopoints.php";

function crearperiodopoints(){
	$obj=new periodopoints();
	$obj->setAno($_POST["txtano"]);
	return $obj;
}

function suspenderperiodopoints(){
	$obj=new periodopoints();
	$obj->setId($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarperiodopoints(){
	$obj=new periodopoints();
	$obj->setId($_POST["txtid2"]);
	$obj->setAno($_POST["txtano2"]);
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daoperiodopoints();
		$dat->ingresar(crearperiodopoints());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daoperiodopoints();
		$dat->suspender(suspenderperiodopoints());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daoperiodopoints();
		$dat->modificar(modificarperiodopoints());
	}

	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		 $dat = new daoperiodopoints();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         $id="'".$c["id_periodo"]."'";
         $ano="'".str_replace('"', "",$c["ano"])."'";
         $estado="'".$c["estado"]."'";

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalperiodopoints2\" onclick=\"llenarCajas('.$id.','.$ano.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$ano.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$ano.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }
         
         $tabla.='{
				  "ano":"'.str_replace('"', "",$c["ano"]).'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>