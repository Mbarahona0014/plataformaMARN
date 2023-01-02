<?php
require_once "relcausaincendio.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daorelcausaincendio
 {

 	function __construct()
 	{

 	}


 	public function ingresarrelcausaincendio($obj)
 	{
 		$c=conectar();
 		//$idincendio=$obj->getIdincendio();
 		$idcausaincendio=$obj->getIdcausaincendio();
		$c->set_charset('utf8');

		//SENTENCIA PARA TRAER EL ID DEL ULTIMO INCENDIO INSERTADO
		$sentencia = $c->prepare("select max(IdIncendio) as resultado from incendioforestal;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$resultadoid=$fila["resultado"];
		
		$sql="insert into relcausaincendioforestal values(0,$resultadoid,$idcausaincendio);";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}

 	}


 	public function modificarrelcausaincendio($obj)
 	{
 		$c=conectar();
 		$idincendio=$obj->getIdincendio();
 		$idcausaincendio=$obj->getIdcausaincendio();

		$c->set_charset('utf8');
		//VALIDO SI YA ESTABA INSERTADO ANTES
		$sentencia = $c->prepare("select count(*) as cantidad from relcausaincendioforestal where IdIncendio=$idincendio and IdCausaIncendio=$idcausaincendio;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$cantidad=$fila["cantidad"];

		if ($cantidad>0) {
			//SI ESTABA INSERTADO
			echo "1";
		}else{
			//NO ESTABA INSERTADO
			$sql="insert into relcausaincendioforestal values(0,$idincendio,$idcausaincendio);";
			if(!$c->query($sql)){
	 			//echo "-1";
	 		}else{
	 			//echo "1";
	 		}
		}
		


		

 	}


 	public function limpiandorelcausaincendio($obj)
 	{
 		$c=conectar();
 		$idincendio=$obj->getIdincendio();
 		//$idcausaincendio=$obj->getIdcausaincendio();

		$c->set_charset('utf8');
		//VALIDO SI YA ESTABA INSERTADO ANTES
		
		$sql="delete from relcausaincendioforestal where IdIncendio=$idincendio;";
		if(!$c->query($sql)){
 			//echo "-1";
 		}else{
 			//echo "1";
 		}
		
 	}

 }


 ?>