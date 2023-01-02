<?php
require_once "relmedioextincion.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daorelmedioextincion
 {

 	function __construct()
 	{

 	}


 	public function ingresarmedioextincion($obj)
 	{
 		$c=conectar();
 		$idmedioextincion=$obj->getIdmedioextincion();
 		$cantidad=$obj->getCantidad();

		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO INCENDIO INSERTADO
		$sentencia = $c->prepare("select max(IdIncendio) as resultado from incendioforestal;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];
		
		$sql="insert into relmedioextincendioforestal values(0,$idmedioextincion,$resultadoid,$cantidad);";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}


 	public function modificarmedioextincion($obj)
 	{
 		$c=conectar();
 		$idrelmedioextincendioforestal=$obj->getIdrelmedioextincendioforestal();
 		$idmedioextincion=$obj->getIdmedioextincion();
 		$cantidad=$obj->getCantidad();

		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO INCENDIO INSERTADO
		/*$sentencia = $c->prepare("select max(IdIncendio) as resultado from IncendioForestal;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];*/
		
		$sql="update relmedioextincendioforestal set Cantidad=$cantidad where IdRelMedioExtIncendioForestal=$idrelmedioextincendioforestal;";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}

 }


 ?>