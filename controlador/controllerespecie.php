<?php
require_once "../modelo/daoespecie.php";

function crearespecie(){
	$obj=new especie();
	$obj->setCodigo($_POST["txtcodigo"]);
	$obj->setGenero($_POST["txtgenero"]);
	$obj->setEspecie($_POST["txtespecie"]);
	$obj->setSubespecie($_POST["txtsubespecie"]);
	$obj->setNombrecomun($_POST["txtnombrecomun"]);
	$obj->setNombrecomun($_POST["txtnombrecomun"]);
	$obj->setCategoria($_POST["txtcategoria"]);
	return $obj;
}

function suspenderespecie(){
	$obj=new especie();
	$obj->setId($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarespecie(){
	$obj=new especie();
	$obj->setId($_POST["txtid2"]);
	$obj->setCodigo($_POST["txtcodigo2"]);
	$obj->setGenero($_POST["txtgenero2"]);
	$obj->setEspecie($_POST["txtespecie2"]);
	$obj->setSubespecie($_POST["txtsubespecie2"]);
	$obj->setNombrecomun($_POST["txtnombrecomun2"]);
	$obj->setCategoria($_POST["txtcategoria2"]);
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daoespecie();
		$dat->ingresar(crearespecie());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daoespecie();
		$dat->suspender(suspenderespecie());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daoespecie();
		$dat->modificar(modificarespecie());
	}

		/*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarnm'){
		$dat = new daoespecie();
         $r=$dat->consultarn();
         foreach($r as $c){
		      echo $c["nume"];
		    }
	}*/
	
	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		 $dat = new daoespecie();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         $id="'".str_replace('"', "",$c["id"])."'";
         $codigo="'".str_replace('"', "",$c["codigo"])."'";
         $genero="'".str_replace('"', "",$c["genero"])."'";
         $especie="'".str_replace('"', "",$c["especie"])."'";
         $subespecie="'".str_replace('"', "",$c["subespecie"])."'";
         $nombrecomun="'".str_replace('"', "",$c["nombrecomun"])."'";
         $categoria="'".str_replace('"', "",$c["categoria"])."'";
         $estado="'".$c["estado"]."'";

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalespecie2\" onclick=\"llenarCajas('.$id.','.$codigo.','.$genero.','.$especie.','.$subespecie.','.$nombrecomun.','.$categoria.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.');\"><i class=\"fa fa-trash\" aria-hidden=\ "true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$nombrecomun.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$nombrecomun.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }
         
         $tabla.='{
         		  "codigo":"'.str_replace('"', "",$c["codigo"]).'",
         		  "genero":"'.str_replace('"', "",$c["genero"]).'",
         		  "especie":"'.str_replace('"', "",$c["especie"]).'",
         		  "subespecie":"'.str_replace('"', "",$c["subespecie"]).'",
				  "nombrecomun":"'.str_replace('"', "",$c["nombrecomun"]).'",
				  "categoria":"'.str_replace('"', "",$c["categoria"]).'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>