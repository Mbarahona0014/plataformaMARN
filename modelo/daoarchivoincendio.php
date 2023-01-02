<?php
require_once "archivoincendio.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoarchivoincendio
 {

 	function __construct()
 	{

 	}


 	public function ingresararchivoincendio($obj)
 	{
 		$c=conectar();
 		//$idincendio=$obj->getIdincendio();
 		$archivo=$obj->getArchivo();
		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO INCENDIO INSERTADO
		$sentencia = $c->prepare("select max(IdIncendio) as resultado from incendioforestal;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];
		
		$sql="insert into archivoincendio values(0,'$archivo',$resultadoid);";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}






 	public function eliminandoarchivoincendio($obj)
 	{
 		$c=conectar();
 		$idarchivo=$obj->getIdarchivo();
 		$idincendio=$obj->getIdincendio();
 		

		$c->set_charset('utf8');
		//VALIDO SI YA ESTABA INSERTADO ANTES
		
		$sql="delete from archivoincendio where IdIncendio=$idincendio and IdArchivo=$idarchivo;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
		
 	}



 	public function ingresararchivoincendiomodifica($obj)
 	{
 		$c=conectar();
 		$idincendio=$obj->getIdincendio();
 		$archivo=$obj->getArchivo();
		$c->set_charset('utf8');
		
		$sql="insert into archivoincendio values(0,'$archivo',$idincendio);";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}


 	}

 	

 }


 ?>