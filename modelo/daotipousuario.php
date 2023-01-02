<?php

require_once "tipousuario.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daotipousuario
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select * from tipousuario;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function ingresar($obj){
 		$c=conectar();
 		$tipo=str_replace("'","",$obj->getTipo());
 		$c->set_charset('utf8');
 		
 		$sql="insert into tipousuario values(0, '$tipo', 1);";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}

 	public function modificar($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$tipo=str_replace("'","",$obj->getTipo());
 		$c->set_charset('utf8');

 		$sql="update tipousuario set tipo='$tipo' where id=$id;";
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
 		$sql="update tipousuario set estado=$estado where id=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>