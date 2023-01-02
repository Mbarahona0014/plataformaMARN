<?php
require_once "../modelo/daotecnica.php";

function creartecnica(){
	$obj=new tecnica();
	$obj->setUsosuelo($_POST["txtusosuelo"]);
	$obj->setTecnica($_POST["txttecnica"]);
	return $obj;
}

function suspendertecnica(){
	$obj=new tecnica();
	$obj->setIdtecnica($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificartecnica(){
	$obj=new tecnica();
	$obj->setIdtecnica($_POST["txtidtecnica2"]);
	$obj->setUsosuelo($_POST["txtusosuelo2"]);
	$obj->setTecnica($_POST["txttecnica2"]);
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daotecnica();
		$dat->ingresar(creartecnica());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daotecnica();
		$dat->suspender(suspendertecnica());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daotecnica();
		$dat->modificar(modificartecnica());
	}

		/*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarnm'){
		$dat = new daotecnica();
         $r=$dat->consultarn();
         foreach($r as $c){
		      echo $c["nume"];
		    }
	}*/
	
	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		 $dat = new daotecnica();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         $IdTecnica="'".$c["IdTecnica"]."'";
         $UsoSuelo="'".str_replace('"', "",$c["UsoSuelo"])."'";
         $Tecnica="'".str_replace('"', "",$c["Tecnica"])."'";
         $estado="'".$c["estado"]."'";

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modaltecnica2\" onclick=\"llenarCajas('.$IdTecnica.','.$UsoSuelo.','.$Tecnica.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$IdTecnica.',0,'.$Tecnica.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$IdTecnica.',1,'.$Tecnica.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }
         
         $tabla.='{
				  "UsoSuelo":"'.str_replace('"', "",$c["UsoSuelo"]).'",
				  "Tecnica":"'.str_replace('"', "",$c["Tecnica"]).'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>