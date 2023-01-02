<?php
require_once "../modelo/daousuarioexterno.php";

function crearusuarioexterno(){
	$obj=new usuarioexterno();
	$obj->setNombre($_POST["txtnombre"]);
	$obj->setApellido($_POST["txtapellido"]);
	$obj->setCorreo($_POST["txtcorreo"]);
  $obj->setIdinstitucion($_POST["tpinstitucion"]);
  //$obj->setIdtipo($_POST["tptipousuario"]);
  return $obj;
}
function suspenderusuarioexterno(){
	$obj=new usuarioexterno();
	$obj->setId($_POST["id"]);
  $obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarusuarioexterno(){
	$obj=new usuarioexterno();
  $obj->setId($_POST["txtid2"]);
  $obj->setNombre($_POST["txtnombre2"]);
  $obj->setApellido($_POST["txtapellido2"]);
  $obj->setCorreo($_POST["txtcorreo2"]);
  $obj->setIdinstitucion($_POST["tpinstitucion2"]);
  //$obj->setIdtipo($_POST["tptipousuario2"]);
  return $obj;
}


	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daousuarioexterno();
		$dat->ingresar(crearusuarioexterno());
	}
	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daousuarioexterno();
		$dat->suspender(suspenderusuarioexterno());
	}

	/*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarcb'){
		$dat=new daousuarioexterno();
		echo json_encode($dat->consultarcb());
	}*/
    $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb'){
    $dat=new daousuarioexterno();
    echo json_encode($dat->consultarcb());
  }

	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat = new daousuarioexterno();
          $dat->modificar(modificarusuarioexterno());
	}


	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		$dat = new daousuarioexterno();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){

         $id="'".$c["id"]."'";
         $nombre="'".str_replace('"', "",$c["nombre"])."'";
         $apellido="'".str_replace('"', "",$c["apellido"])."'";
         $correo="'".str_replace('"', "",$c["correo"])."'";
         $idtipo="'".str_replace('"', "",$c["tipo"])."'";
         $idinstitucion="'".$c["idinstitucion"]."'";
         $estado="'".$c["estado"]."'";


         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalusuarioexterno2\"';
         $editar.='onclick=\"llenarCajas('.$id.','.$nombre.','.$apellido.','.$correo.','.$idinstitucion.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"> </i></a>';

         $notificar='&nbsp;<a height=\"40\" class=\"btn btn-warning btnnotificar btn-sm\" data-toggle=\"modal\" onclick=\"notificar('.$nombre.','.$apellido.','.$correo.');\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i></a>';

         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',0,'.$nombre.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$id.',1,'.$nombre.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }

         $tabla.='{
                  "nombre":"'.str_replace('"', "",$c["nombre"]).'",
                  "apellido":"'.str_replace('"', "",$c["apellido"]).'",
                  "correo":"'.str_replace('"', "",$c["correo"]).'",
                  "tipo":"'.str_replace('"', "",$c["tipo"]).'",
                  "nombreinstitucion":"'.str_replace('"', "",$c["nombreinstitucion"]).'",
                  "acciones":"'.$editar.$suspender.$notificar.'"
                },';
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
	}

  
?>