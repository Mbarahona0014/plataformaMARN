<?php
require_once "../modelo/daousuario.php";

function crearusuario(){
	$obj=new usuario();
  $obj->setCodigo($_POST["txtcodigo"]);
	$obj->setNombre($_POST["txtnombre"]);
	$obj->setApellido($_POST["txtapellido"]);
  $obj->setUsuarioad($_POST["txtusuarioad"]);
	$obj->setCorreo($_POST["txtcorreo"]);
  $obj->setIdtipo($_POST["tptipousuario"]);
  return $obj;
}
function suspenderusuario(){
	$obj=new usuario();
	$obj->setId($_POST["id"]);
  $obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarusuario(){
	$obj=new usuario();
  $obj->setId($_POST["txtid2"]);
  $obj->setCodigo($_POST["txtcodigo2"]);
  $obj->setNombre($_POST["txtnombre2"]);
  $obj->setApellido($_POST["txtapellido2"]);
  $obj->setUsuarioad($_POST["txtusuarioad2"]);
  $obj->setCorreo($_POST["txtcorreo2"]);
  $obj->setIdtipo($_POST["tptipousuario2"]);
  return $obj;
}
	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daousuario();
		$dat->ingresar(crearusuario());
	}
	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daousuario();
		$dat->suspender(suspenderusuario());
	}

    /*$page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';
  if($page=='consultarnc'){
    $dat = new DAOCliente();
         $r=$dat->consultarnc();
         foreach($r as $c){
          echo $c["nume"];
        }
  }*/

	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarcb'){
		$dat=new daousuario();
		echo json_encode($dat->consultarcb());
	}
  /*$page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';
  if($page=='consultarcb2'){
    $dat=new DAOCliente();
    echo json_encode($dat->consultarcb2());
  }*/
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat = new daousuario();
          $dat->modificar(modificarusuario());
	}

  /*$page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';
if($page=='consultarcliini'){
    $dat = new DAOCliente();
    $r = $dat->consultarclienteinicial($_POST["iddatos"]);
    foreach($r as $c){
      echo $c["nombre"].",";
      echo $c["correo"].",";
      echo $c["nombrease"].",";
      echo $c["poliza"].",";
      echo $c["cert"].",";
      echo $c["tele"].",";
      echo $c["tipo"];
    }
}*/

	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		$dat = new daousuario();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){

         $id="'".$c["id"]."'";
         $codigo="'".str_replace('"', "",$c["codigo"])."'";
         $nombre="'".str_replace('"', "",$c["nombre"])."'";
         $apellido="'".str_replace('"', "",$c["apellido"])."'";
         $usuarioad="'".str_replace('"', "",$c["usuarioad"])."'";
         $correo="'".str_replace('"', "",$c["correo"])."'";
         $idtipo="'".$c["idtipo"]."'";
         $estado="'".$c["estado"]."'";


         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalusuario2\"';
         $editar.='onclick=\"llenarCajas('.$id.','.$codigo.','.$nombre.','.$apellido.','.$usuarioad.','.$correo.','.$idtipo.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"> </i></a>';
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$nombre.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$nombre.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }



         $tabla.='{
                  "codigo":"'.str_replace('"', "",$c["codigo"]).'",
                  "nombre":"'.str_replace('"', "",$c["nombre"]).'",
                  "apellido":"'.str_replace('"', "",$c["apellido"]).'",
                  "usuarioad":"'.str_replace('"', "",$c["usuarioad"]).'",
                  "correo":"'.str_replace('"', "",$c["correo"]).'",
                  "tipo":"'.str_replace('"', "",$c["tipo"]).'",
                  "acciones":"'.$editar.$suspender.'"
                },';
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
	}

?>