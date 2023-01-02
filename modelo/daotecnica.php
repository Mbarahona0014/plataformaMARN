<?php

require_once "tecnica.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daotecnica
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select * from tecnica;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function ingresar($obj){
 		$c=conectar();
 		$UsoSuelo=str_replace("'","",$obj->getUsosuelo());
 		$Tecnica=str_replace("'","",$obj->getTecnica());
 		$c->set_charset('utf8');
 		
 		$sql="insert into tecnica values(0, '$UsoSuelo', '$Tecnica', 1);";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}

 	public function modificar($obj){
 		$c=conectar();
 		$IdTecnica=$obj->getIdtecnica();
 		$UsoSuelo=str_replace("'","",$obj->getUsosuelo());
 		$Tecnica=str_replace("'","",$obj->getTecnica());
 		$c->set_charset('utf8');

 		$sql="update tecnica set UsoSuelo='$UsoSuelo', Tecnica='$Tecnica' where IdTecnica=$IdTecnica;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}

 	}

 	public function suspender($obj){
 		$c=conectar();
 		$IdTecnica=$obj->getIdtecnica();
 		$estado=$obj->getEstado();
 		$sql="update tecnica set estado=$estado where IdTecnica=$IdTecnica;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>