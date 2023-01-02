<?php
require_once "sesion.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daosesion
 {

 	function __construct()
 	{

 	}


	public function iniciarSesion($obj){
		
		$c= conectar();
		$c->set_charset('utf8');
		$correo= $obj->getCorreo();
		$contra=$obj->getContra();
		$sentencia = $c->prepare("select correo from usuarioexterno where correo='$correo';");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila2 = $resultado->fetch_assoc();

		if(isset($fila2["correo"])){
			$exis=$fila2["correo"];
		}else{
			$exis=null;
		}


		$sentencia = $c->prepare("select correo from usuario where correo='$correo';");
		$sentencia->execute();
		$resultado = $sentencia->get_result();
		$fila3 = $resultado->fetch_assoc();
		$exis2=$fila3["correo"];
		//VERFIFICANDO SI EL CORREO EXISTE EN TABLA USUARIO EXTERNO O TABLA USUARIO QUE HACE REFERENCIA A USUARIO INTERNO
		if ($exis!=null || $exis2!=null) {

			if($exis2!=null){
				//SI ENTRA AQUI ES USUARIO INTERNO
				//ID 1 ES ADMINISTRADOR Y ID 3 ES USUARIO INTERNO 

				$sentencia5 = $c->prepare("select idtipo from usuario where correo='$correo';");
				$sentencia5->execute();
				$resultado5 = $sentencia5->get_result();
				$fila5 = $resultado5->fetch_assoc();
				$idtipousuario=$fila5["idtipo"];

				$sentencia3 = $c->prepare("select nombre from usuario where correo='$correo';");
				$sentencia3->execute();
				$resultado3 = $sentencia3->get_result();
				$fila3 = $resultado3->fetch_assoc();
				$nombre=$fila3["nombre"];

				$sentencia4 = $c->prepare("select apellido from usuario where correo='$correo';");
				$sentencia4->execute();
				$resultado4 = $sentencia4->get_result();
				$fila4 = $resultado4->fetch_assoc();
				$apellido=$fila4["apellido"];

				$sentencia = $c->prepare("select correo from usuario where correo='$correo';");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$correo=$fila["correo"];

				$sentencia5 = $c->prepare("select id from usuario where correo='$correo';");
				$sentencia5->execute();
				$resultado5 = $sentencia5->get_result();
				$fila5 = $resultado5->fetch_assoc();
				$idusuario=$fila5["id"];

				$sentencia = $c->prepare("select estado from usuario where correo='$correo';");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estado=$fila["estado"];

				$sentencia = $c->prepare("select tp.estado as estadotp from usuario u inner join tipousuario tp on tp.id=u.idtipo  where correo='$correo';");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estadotp=$fila["estadotp"];
				
				if($estado=='0' || $estadotp=='0') {
       				echo "9";
					//deshabilitado
				}else{
					if ($idtipousuario=='1') {
					session_start();
       				$_SESSION['nombre']=$nombre.' '.$apellido;
       				$_SESSION['correo']=$correo;
       				$_SESSION['idtipousuario']=$idtipousuario;
       				$_SESSION['id']=$idusuario;
       				$_SESSION['solonombre']=$nombre;
       				//si imprime 1 es admin
       				echo "1";
					}else if ($idtipousuario=='3' || $idtipousuario=='4' || $idtipousuario=='5') {
						session_start();
	       				$_SESSION['nombre']=$nombre.' '.$apellido;
	       				$_SESSION['correo']=$correo;
	       				$_SESSION['idtipousuario']=$idtipousuario;
	       				$_SESSION['id']=$idusuario;
	       				$_SESSION['solonombre']=$nombre;
	       				//si imprime 6 es usuario interno, puede tener 3 roles diferentes
	       				echo "6";
					}

				}

			}else{
				//SI ENTRA AQUI ES USUARIO EXTERNO
				//CREANDO SENTENCIA PREPARADA PARA OBTENER NOMBRE DE LA BASE
				$sentencia3 = $c->prepare("select nombre from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia3->execute();
				$resultado3 = $sentencia3->get_result();
				$fila3 = $resultado3->fetch_assoc();
				$nombre=$fila3["nombre"];

	        	$sentencia4 = $c->prepare("select apellido from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia4->execute();
				$resultado4 = $sentencia4->get_result();
				$fila4 = $resultado4->fetch_assoc();
				$apellido=$fila4["apellido"];
				

				$sentencia = $c->prepare("select correo from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$correo=$fila["correo"];

				$sentencia = $c->prepare("select estadocontra from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estadocontra=$fila["estadocontra"];

				$sentencia = $c->prepare("select estadocambiocontra from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estadocambiocontra=$fila["estadocambiocontra"];

				$sentencia = $c->prepare("select estado from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estado=$fila["estado"];

				$sentencia = $c->prepare("select tp.estado as estadotp from usuarioexterno ue inner join tipousuario tp on tp.id=ue.idtipo where correo='$correo' and contra=md5('$contra');");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estadotp=$fila["estadotp"];

				$sentencia = $c->prepare("select inst.estado as estadoinst from usuarioexterno ue inner join instituciones inst on inst.id=ue.id where correo='$correo' and contra=md5('$contra');");
				$sentencia->execute();
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				$estadoinst=$fila["estadoinst"];

				$sentencia5 = $c->prepare("select idtipo from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia5->execute();
				$resultado5 = $sentencia5->get_result();
				$fila5 = $resultado5->fetch_assoc();
				$idtipousuario=$fila5["idtipo"];

				$sentencia5 = $c->prepare("select id from usuarioexterno where correo='$correo' and contra=md5('$contra');");
				$sentencia5->execute();
				$resultado5 = $sentencia5->get_result();
				$fila5 = $resultado5->fetch_assoc();
				$idusuario=$fila5["id"];


				if ($idtipousuario==null) {

					echo "3";
					//constraseña incorrecta
					//SI IDTIPO USUARIO ES 2 ES USUARIO EXTERNO
				} else if ($idtipousuario=='2') {
					if ($estado=='0' || $estadotp=='0' || $estadoinst=='0') {

						echo "4";
						//deshabilitado
					}else{
						session_start();
	       				$_SESSION['nombre']=$nombre.' '.$apellido;
       					$_SESSION['correo']=$correo;
       					$_SESSION['idtipousuario']=$idtipousuario;
       					$_SESSION['id']=$idusuario;
       					$_SESSION['solonombre']=$nombre;

       					$sentencia5 = $c->prepare("select idtipo, estadocambiocontra from usuarioexterno where correo='$correo' and contra=md5('$contra');");
						$sentencia5->execute();
						$resultado5 = $sentencia5->get_result();
						$fila5 = $resultado5->fetch_assoc();
						$estadocambiocontra=$fila5["estadocambiocontra"];

						if($estadocambiocontra=="1"){
							//TIENE PENDIENTE CAMBIO DE CONTRASEÑA
							echo "5";

						}else if($estadocambiocontra=="0"){
							//SI YA CAMBIO CONTRA IMPRIME 2
       						echo "2";
						}
    
					}

				}

			}

		}else{
			echo "0";
			//uno existe usuario
		}

		mysqli_close($c);
	}

 }

?>