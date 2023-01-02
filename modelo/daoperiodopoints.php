<?php

require_once "periodopoints.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoperiodopoints
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select * from periodo_point;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function ingresar($obj){
 		$c=conectar();
 		$ano=str_replace("'","",$obj->getAno());
 		$c->set_charset('utf8');
 		
 		$sql="insert into periodo_point values(0, '$ano', 1);";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}

 	public function modificar($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$ano=str_replace("'","",$obj->getAno());
 		$c->set_charset('utf8');

 		$sql="update periodo_point set ano='$ano' where id_periodo=$id;";
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
 		$sql="update periodo_point set estado=$estado where id_periodo=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>