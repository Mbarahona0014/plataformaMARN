<?php
require_once "archivorestauracion.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoarchivorestauracion
 {

 	function __construct()
 	{

 	}


 	public function ingresararchivorestauracion($obj)
 	{
 		$c=conectar();
 		//$idrestauracion=$obj->getIdrestauracion();
 		$archivo=$obj->getArchivo();
		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO restauracion INSERTADO
		$sentencia = $c->prepare("select max(id_restauracion) as resultado from restauracion_points;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];
		
		$sql="insert into archivorestauracion values(0,'$archivo',$resultadoid);";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}






 	public function eliminandoarchivorestauracion($obj)
 	{
 		$c=conectar();
 		$idarchivo=$obj->getIdarchivo();
 		$id_restauracion=$obj->getIdrestauracion();
 		

		$c->set_charset('utf8');
		//VALIDO SI YA ESTABA INSERTADO ANTES
		
		$sql="delete from archivorestauracion where id_restauracion=$id_restauracion and IdArchivo=$idarchivo;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
		
 	}



 	public function ingresararchivorestauracionmodifica($obj)
 	{
 		$c=conectar();
 		$id_restauracion=$obj->getIdrestauracion();
 		$archivo=$obj->getArchivo();
		$c->set_charset('utf8');
		
		$sql="insert into archivorestauracion values(0,'$archivo',$id_restauracion);";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}


 	}

 	

 }


 ?>