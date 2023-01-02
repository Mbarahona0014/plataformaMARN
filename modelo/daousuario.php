<?php

require_once "usuario.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daousuario
 {

 	function __construct()
 	{

 	}

 	public function consultar(){
		$c = conectar();
		$sql="select usuario.id, codigo, nombre, apellido, usuarioad, correo, tipousuario.tipo, usuario.idtipo, usuario.estado from usuario left outer join tipousuario on usuario.idtipo = tipousuario.id where tipousuario.estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}

	public function consultarcb(){
		$c = conectar();
		//ID !=2 YA QUE EL ID 2 CORRESPONDE A USUARIO EXTERNO, Y NO SE PODRA CREAR UN USUARIO EXTERNO DESDE AQUI
		$sql="select * from tipousuario where estado=1 and id!=2;";
		//$sql="select * from tipousuario where estado=1;";
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
		$codigo=str_replace("'","",$obj->getCodigo());
		$nombre=str_replace("'","",$obj->getNombre());
		$apellido=str_replace("'","",$obj->getApellido());
		$usuarioad=str_replace("'","",$obj->getUsuarioad());
		$correo=str_replace("'","",$obj->getCorreo());
		$idTipo=str_replace("'","",$obj->getIdtipo());

		$c->set_charset('utf8');
		


		$sentencia = $c->prepare("Select concat(nombre, ' ', apellido) as nombrecompleto from usuario where nombre='$nombre' and apellido='$apellido';");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$nombrevalidacion=$fila["nombrecompleto"];

		if($nombrevalidacion==null)
		{
			//$idTipo=$obj->getIdtipo();
			$sentencia = $c->prepare("select correo from usuario where correo='$correo';");
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			$fila = $resultado->fetch_assoc();
			$correovalidacion=$fila["correo"];

			if($correovalidacion==null)
			{
				//$sql="Insert into usuarioexterno values(0,'$nombre','$apellido','$correo','',0,0,1,$idTipo);";
				//ID 2 ES IDTIPO QUE EQUIVALE A TIPO DE USUARIO EXTERNO, NO SE DEBE DE MODIFICAR POR NADA
				$sql="Insert into usuario values(0,'$codigo','$nombre','$apellido','$usuarioad','$correo',1,$idTipo);";
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
			//-3 NOMBRE YA EXISTE
			echo "-3";
		}



		
 	}



 	public function modificar($obj)
 	{
 		$c=conectar();
 		$id=$obj->getId();
 		$codigo=str_replace("'","",$obj->getCodigo());
		$nombre=str_replace("'","",$obj->getNombre());
		$apellido=str_replace("'","",$obj->getApellido());
		$usuarioad=str_replace("'","",$obj->getUsuarioad());
		$correo=str_replace("'","",$obj->getCorreo());
		$idTipo=str_replace("'","",$obj->getIdtipo());
		$c->set_charset('utf8');


		$sentencia = $c->prepare("Select concat(nombre, ' ', apellido) as nombrecompleto from usuario where nombre='$nombre' and apellido='$apellido' and id!=$id;");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila = $resultado->fetch_assoc();
		$nombrevalidacion=$fila["nombrecompleto"];

		if($nombrevalidacion==null)
		{
			$sentencia = $c->prepare("select correo from usuario where correo='$correo' and id!=$id;");
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			$fila = $resultado->fetch_assoc();
			$correovalidacion=$fila["correo"];

			if($correovalidacion==null)
			{
				//$sql="Insert into usuarioexterno values(0,'$nombre','$apellido','$correo','',0,0,1,$idTipo);";
				//ID 2 ES IDTIPO QUE EQUIVALE A TIPO DE USUARIO EXTERNO, NO SE DEBE DE MODIFICAR POR NADA
				$sql="update usuario set codigo='$codigo', nombre='$nombre', apellido='$apellido', usuarioad='$usuarioad', correo='$correo', idTipo=$idTipo where id=$id;";
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
		$sql="update usuario set estado=$estado  where id=$id;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}




 }

?>