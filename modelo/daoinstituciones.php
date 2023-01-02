<?php

require_once "instituciones.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoinstituciones
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select * from instituciones;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function ingresar($obj){
 		$c=conectar();
 		$nombreinstitucion=str_replace("'","",$obj->getNombreinstitucion());
 		$correocontacto=str_replace("'","",$obj->getCorreocontacto());
 		$contacto=str_replace("'","",$obj->getContacto());
 		$telefono=str_replace("'","",$obj->getTelefono());
 		$c->set_charset('utf8');


 		$sentencia = $c->prepare("select correocontacto from instituciones where correocontacto='$correocontacto';");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$correovalidacion=$fila["correocontacto"];

		if($correovalidacion==null)
		{
			$sql="insert into instituciones values(0, '$nombreinstitucion','$correocontacto', '$contacto','$telefono', 1);";
			if(!$c->query($sql)){
	 			echo "-1";
	 		}else{
	 			echo "1";
	 		}
		}else{
			//-2 ES PORQUE YA EXISTE EL CORREO EN LA BASE
			echo "-2";
		}

 	}

 	public function modificar($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$nombreinstitucion=str_replace("'","",$obj->getNombreinstitucion());
 		$correocontacto=str_replace("'","",$obj->getCorreocontacto());
 		$contacto=str_replace("'","",$obj->getContacto());
 		$telefono=str_replace("'","",$obj->getTelefono());
 		$c->set_charset('utf8');

 		$sentencia = $c->prepare("select correocontacto from instituciones where correocontacto='$correocontacto' and id!=$id;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$correovalidacion=$fila["correocontacto"];

		if($correovalidacion==null)
		{
			$sql="update instituciones set nombreinstitucion='$nombreinstitucion',  correocontacto='$correocontacto', contacto='$contacto', telefono='$telefono' where id=$id;";
	 		if(!$c->query($sql)){
	 			echo "-1";
	 		}else{
	 			echo "1";
	 		}
		}else{
			//-2 ES PORQUE YA EXISTE EL CORREO EN LA BASE
			echo "-2";
		}

 		

 	}

 	public function suspender($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$estado=$obj->getEstado();
 		$sql="update instituciones set estado=$estado where id=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>