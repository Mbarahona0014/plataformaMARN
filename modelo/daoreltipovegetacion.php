<?php
require_once "reltipovegetacion.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoreltipovegetacion
 {

 	function __construct()
 	{

 	}


 	public function ingresarreltipoveg($obj)
 	{
 		$c=conectar();
 		$idtipovegetacion=$obj->getIdtipovegetacion();
 		$areraprotegida=$obj->getAreraprotegida();
 		$zonaamortiguamiento=$obj->getZonaamortiguamiento();

		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO INCENDIO INSERTADO
		$sentencia = $c->prepare("select max(IdIncendio) as resultado from incendioforestal;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];
		
		$sql="insert into reltipovegeincendioforestal values(0,$idtipovegetacion,$resultadoid,$areraprotegida,$zonaamortiguamiento);";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}



 	public function modificarreltipoveg($obj)
 	{
 		$c=conectar();
 		$idreltipovegeincendioforestal=$obj->getIdreltipovegeincendioforestal();
 		$idtipovegetacion=$obj->getIdtipovegetacion();
 		$areraprotegida=$obj->getAreraprotegida();
 		$zonaamortiguamiento=$obj->getZonaamortiguamiento();

		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO INCENDIO INSERTADO
		/*$sentencia = $c->prepare("select max(IdIncendio) as resultado from IncendioForestal;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];*/
		
		$sql="update reltipovegeincendioforestal set AreaProtegida=$areraprotegida, ZonaAmortiguamiento=$zonaamortiguamiento where IdRelTipoVegeIncendioForestal=$idreltipovegeincendioforestal;";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}

 }


 ?>