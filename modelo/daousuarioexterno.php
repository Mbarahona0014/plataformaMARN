<?php

require_once "usuarioexterno.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daousuarioexterno
 {

 	function __construct()
 	{

 	}

 	public function consultar(){
		$c = conectar();
		$sql="select usuarioexterno.id, nombre, apellido, correo, contra, estadocontra, estadocambiocontra, tipousuario.tipo, usuarioexterno.idtipo, usuarioexterno.estado, usuarioexterno.idinstitucion, instituciones.nombreinstitucion from usuarioexterno 
			left join tipousuario on usuarioexterno.idtipo = tipousuario.id  and tipousuario.estado=1
			left join instituciones on usuarioexterno.idinstitucion = instituciones.id and instituciones.estado=1 where instituciones.estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}

	/*public function consultarcb(){
		$c = conectar();
		$sql="select * from tipousuario where estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}*/

	public function consultarcb(){
		$c = conectar();
		$sql="select * from instituciones where estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	

 	public function ingresar($obj)
 	{
 		$c=conectar();
		$nombre=str_replace("'","",$obj->getNombre());
		$apellido=str_replace("'","",$obj->getApellido());
		$correo=str_replace("'","",$obj->getCorreo());
		$idinstitucion=$obj->getIdinstitucion();
		$c->set_charset('utf8');

		$sentencia = $c->prepare("Select concat(nombre, ' ', apellido) as nombrecompleto from usuarioexterno where nombre='$nombre' and apellido='$apellido';");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$nombrevalidacion=$fila["nombrecompleto"];

		if($nombrevalidacion==null)
		{

			//$idTipo=$obj->getIdtipo();
			$sentencia = $c->prepare("select correo from usuarioexterno where correo='$correo';");
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			$fila = $resultado->fetch_assoc();
			$correovalidacion=$fila["correo"];

			if($correovalidacion==null)
			{
				//$sql="Insert into usuarioexterno values(0,'$nombre','$apellido','$correo','',0,0,1,$idTipo);";
				//ID 2 ES IDTIPO QUE EQUIVALE A TIPO DE USUARIO EXTERNO, NO SE DEBE DE MODIFICAR POR NADA
				$sql="Insert into usuarioexterno values(0,'$nombre','$apellido','$correo','',0,0,1,2,$idinstitucion);";
				if(!$c->query($sql)){
		 			echo "-1";
		 		}else{
		 			echo "1";
		 		}
			}else{
				//-2 ES PORQUE YA EXISTE EL CORREO EN LA BASE
				echo "-2";
			}
		}else{
			echo "-3";
		}
	
 	}



 	public function modificar($obj)
 	{
 		$c=conectar();
 		$id=$obj->getId();
 		$nombre=str_replace("'","",$obj->getNombre());
		$apellido=str_replace("'","",$obj->getApellido());
		$correo=str_replace("'","",$obj->getCorreo());
		$idinstitucion=$obj->getIdinstitucion();
		$c->set_charset('utf8');
		//$idTipo=$obj->getIdtipo();


		$sentencia = $c->prepare("Select concat(nombre, ' ', apellido) as nombrecompleto from usuarioexterno where nombre='$nombre' and apellido='$apellido' and id!=$id;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$nombrevalidacion=$fila["nombrecompleto"];

		if($nombrevalidacion==null)
		{
			//sentencia preparada que verfifica que no se encuentre otro correo similar en la base
			$sentencia = $c->prepare("select correo from usuarioexterno where correo='$correo' and id!=$id;");
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			$fila = $resultado->fetch_assoc();
			$correovalidacion=$fila["correo"];

			if($correovalidacion==null)
			{
				//$sql="Insert into usuarioexterno values(0,'$nombre','$apellido','$correo','',0,0,1,$idTipo);";
				//ID 2 ES IDTIPO QUE EQUIVALE A TIPO DE USUARIO EXTERNO, NO SE DEBE DE MODIFICAR POR NADA
				$sql="update usuarioexterno set nombre='$nombre', apellido='$apellido', correo='$correo', idinstitucion=$idinstitucion where id=$id;";
				if(!$c->query($sql)){
		 			echo "-1";
		 		}else{
		 			echo "1";
		 		}
			}else{
				//-2 ES PORQUE YA EXISTE EL CORREO EN LA BASE
				echo "-2";
			}
		}else{
			echo "-3";
		}

		

		
 	}


 	public function suspender($obj)
 	{
 		$c=conectar();
 		$id=$obj->getId();
 		$estado=$obj->getEstado();
		$sql="update usuarioexterno set estado=$estado  where id=$id;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}



 	

 }

?>