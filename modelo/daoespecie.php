<?php

require_once "especie.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoespecie
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select * from especie;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function ingresar($obj){
 		$c=conectar();
 		$codigo=str_replace("'","",trim($obj->getCodigo()));
 		$genero=str_replace("'","",trim($obj->getGenero()));
 		$especie=str_replace("'","",trim($obj->getEspecie()));
 		$subespecie=str_replace("'","",trim($obj->getSubEspecie()));
 		$nombrecomun=str_replace("'","",trim($obj->getNombrecomun()));
 		$categoria=str_replace("'","",trim($obj->getCategoria()));
 		$c->set_charset('utf8');
 		
 		$sql="insert into especie values(0, '$codigo', '$genero', '$especie', '$subespecie','$nombrecomun', '$categoria', 1);";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}

 	public function modificar($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$codigo=str_replace("'","",trim($obj->getCodigo()));
 		$genero=str_replace("'","",trim($obj->getGenero()));
 		$especie=str_replace("'","",trim($obj->getEspecie()));
 		$subespecie=str_replace("'","",trim($obj->getSubEspecie()));
 		$nombrecomun=str_replace("'","",trim($obj->getNombrecomun()));
 		$categoria=str_replace("'","",trim($obj->getCategoria()));
 		$c->set_charset('utf8');

 		$sql="update especie set codigo='$codigo', genero='$genero', especie='$especie', subespecie='$subespecie', nombrecomun='$nombrecomun', categoria='$categoria' where id=$id;";
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
 		$sql="update especie set estado=$estado where id=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>