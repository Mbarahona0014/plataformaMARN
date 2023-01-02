<?php
require_once "../modelo/daotipousuario.php";

function creartipousuario(){
	$obj=new tipousuario();
	$obj->setTipo($_POST["txttipo_usuario"]);
	return $obj;
}

function suspendertipousuario(){
	$obj=new tipousuario();
	$obj->setId($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificartipousuario(){
	$obj=new tipousuario();
	$obj->setId($_POST["txtid2"]);
	$obj->setTipo($_POST["txttipo_usuario2"]);
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daotipousuario();
		$dat->ingresar(creartipousuario());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daotipousuario();
		$dat->suspender(suspendertipousuario());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daotipousuario();
		$dat->modificar(modificartipousuario());
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
		 $dat = new daotipousuario();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         $id="'".$c["id"]."'";
         $tipo="'".str_replace('"', "",$c["tipo"])."'";
         $estado="'".$c["estado"]."'";

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modaltipo_usuario2\" onclick=\"llenarCajas('.$id.','.$tipo.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$tipo.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$tipo.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }
         
         $tabla.='{
				  "tipo":"'.str_replace('"', "",$c["tipo"]).'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>