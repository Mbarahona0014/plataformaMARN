<?php
require_once "../modelo/daopaisaje.php";

function crearpaisaje(){
	$obj=new paisaje();
	$obj->setNombre($_POST["txtnombre"]);
	return $obj;
}

function suspenderpaisaje(){
	$obj=new paisaje();
	$obj->setId($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarpaisaje(){
	$obj=new paisaje();
	$obj->setId($_POST["txtid2"]);
	$obj->setNombre($_POST["txtnombre2"]);
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daopaisaje();
		$dat->ingresar(crearpaisaje());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daopaisaje();
		$dat->suspender(suspenderpaisaje());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daopaisaje();
		$dat->modificar(modificarpaisaje());
	}

		/*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarnm'){
		$dat = new daopaisaje();
         $r=$dat->consultarn();
         foreach($r as $c){
		      echo $c["nume"];
		    }
	}*/
	
	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		 $dat = new daopaisaje();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         $id="'".$c["id"]."'";
         $nombre="'".str_replace('"', "",$c["nombre"])."'";
         $estado="'".$c["estado"]."'";

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalpaisaje2\" onclick=\"llenarCajas('.$id.','.$nombre.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$nombre.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$nombre.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }
         
         $tabla.='{
				  "nombre":"'.str_replace('"', "",$c["nombre"]).'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>