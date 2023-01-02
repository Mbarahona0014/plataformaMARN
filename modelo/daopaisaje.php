<?php

require_once "paisaje.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daopaisaje
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select * from paisaje;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function ingresar($obj){
 		$c=conectar();
 		$nombre=str_replace("'","",$obj->getNombre());
 		$c->set_charset('utf8');
 		
 		$sql="insert into paisaje values(0, '$nombre', 1);";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}

 	public function modificar($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$nombre=str_replace("'","",$obj->getNombre());
 		$c->set_charset('utf8');

 		$sql="update paisaje set nombre='$nombre' where id=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}

 	}

 	public function suspender($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$estado=$obj->getEstado();
 		$sql="update paisaje set estado=$estado where id=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>