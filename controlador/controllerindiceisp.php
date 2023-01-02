<?php
require_once "../modelo/daoindiceisp.php";

function crearindiceisp(){
	$obj=new indiceisp();
	$obj->setIca($_POST["txtica"]);
	$obj->setIq($_POST["txtiq"]);
	$obj->setIbp($_POST["txtibp"]);
	$obj->setIcoe($_POST["txticoe"]);
	$obj->setIcs($_POST["txtics"]);
	$obj->setIta($_POST["txtita"]);
	$obj->setIrv($_POST["txtirv"]);
	$obj->setIgp($_POST["txtigp"]);
	$obj->setFechainicio($_POST["txtfechainicio"]);
	$obj->setFechafin($_POST["txtfechafin"]);
	$obj->setIdpaisaje($_POST["tppaisaje"]);
	
	if(isset($_POST["miinputotros"]))
	{
		$obj->setDetallepaisaje($_POST["miinputotros"]);
	}else{
		$obj->setDetallepaisaje(null);
	}
	return $obj;
}

function suspenderindiceisp(){
	$obj=new indiceisp();
	$obj->setId($_POST["id"]);
	$obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarindiceisp(){
	$obj=new indiceisp();
	$obj->setId($_POST["txtid2"]);
	$obj->setIca($_POST["txtica2"]);
	$obj->setIq($_POST["txtiq2"]);
	$obj->setIbp($_POST["txtibp2"]);
	$obj->setIcoe($_POST["txticoe2"]);
	$obj->setIcs($_POST["txtics2"]);
	$obj->setIta($_POST["txtita2"]);
	$obj->setIrv($_POST["txtirv2"]);
	$obj->setIgp($_POST["txtigp2"]);
	$obj->setFechainicio($_POST["txtfechainicio2"]);
	$obj->setFechafin($_POST["txtfechafin2"]);
	$obj->setIdpaisaje($_POST["tppaisaje2"]);
	if(isset($_POST["miinputotros2"]))
	{
		$obj->setDetallepaisaje($_POST["miinputotros2"]);
	}else{
		$obj->setDetallepaisaje(null);
	}
	return $obj;
}

	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daoindiceisp();
		$dat->ingresar(crearindiceisp());
	}

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daoindiceisp();
		$dat->suspender(suspenderindiceisp());
	}

	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarcb'){
		$dat=new daoindiceisp();
		echo json_encode($dat->consultarcb());
	}
	
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat=new daoindiceisp();
		$dat->modificar(modificarindiceisp());
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
		 $dat = new daoindiceisp();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){
         //$p="lala";
         //TOTAL DE ISP
         $total=($c["ica"]+$c["iq"]+$c["ibp"]+$c["icoe"]+$c["ics"]+$c["ita"]+$c["irv"]+$c["igp"])/8;

         $id="'".$c["id"]."'";
         $ica="'".$c["ica"]."'";
         $iq="'".$c["iq"]."'";
         $ibp="'".$c["ibp"]."'";
         $icoe="'".$c["icoe"]."'";
         $ics="'".$c["ics"]."'";
         $ita="'".$c["ita"]."'";
         $irv="'".$c["irv"]."'";
         $igp="'".$c["igp"]."'";
         $idpaisaje="'".$c["idpaisaje"]."'";
         $detallepaisaje="'".str_replace('"', "",$c["detallepaisaje"])."'";

         

         $isp=$total;

         $fechainicio="'".$c["fechainicio"]."'";
         $fechafin="'".$c["fechafin"]."'";
         $idpaisaje="'".$c["idpaisaje"]."'";
         //sirve para pasar el nombre al suspender o activar un registro
         $nombreimpresion="'".$c["nombrepaisaje"]."'";
         $estado="'".$c["estado"]."'";
/*
         if($c["idpaisaje"]==16){
         	$nombrepaisaje="".$c["nombrepaisaje"]."/".$detallepaisaje="".str_replace('"', "",$c["detallepaisaje"])."";
         }else{
         	$nombrepaisaje="".$c["nombrepaisaje"]."";
         }*/

         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalindiceisp2\" onclick=\"llenarCajas('.$id.','.$ica.','.$iq.','.$ibp.','.$icoe.','.$ics.','.$ita.','.$irv.','.$igp.','.$fechainicio.','.$fechafin.','.$idpaisaje.','.$detallepaisaje.');\"  data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
         
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$nombreimpresion.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$nombreimpresion.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }

         /*"nombrepaisaje":"'.$nombrepaisaje.'",*/
         
         $tabla.='{      		  
         		  "nombrepaisaje":"'.$c["nombrepaisaje"].'",
				  "ica":"'.$c["ica"].'",
				  "iq":"'.$c["iq"].'",
				  "ibp":"'.$c["ibp"].'",
				  "icoe":"'.$c["icoe"].'",
				  "ics":"'.$c["ics"].'",
				  "ita":"'.$c["ita"].'",
				  "irv":"'.$c["irv"].'",
				  "igp":"'.$c["igp"].'",
				  "isp":"'.number_format($total, 2).'",
				  "fechainicio":"'.$c["fechainicio"].'",
				  "fechafin":"'.$c["fechafin"].'",
				  "acciones":"'.$editar.$suspender.'"
				},';	
     }
		$tabla = substr($tabla,0, strlen($tabla) - 1);
		echo '{"data":['.$tabla.']}';	
	}

?>