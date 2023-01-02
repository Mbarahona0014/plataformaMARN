<?php
require_once "../modelo/daosubmenu.php";

function crearsubmenu(){
	$obj=new submenu();
  $obj->setValor($_POST["txtvalor"]);
  $obj->setVista($_POST["txtvista"]);
  $obj->setIdmenu($_POST["tpmenu"]);
  return $obj;
}
function suspendersubmenu(){
	$obj=new submenu();
	$obj->setIdsubmenu($_POST["idsubmenu"]);
  $obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarsubmenu(){
	$obj=new submenu();
  $obj->setIdsubmenu($_POST["txtidsubmenu2"]);
  $obj->setValor($_POST["txtvalor2"]);
  $obj->setVista($_POST["txtvista2"]);
  $obj->setIdmenu($_POST["tpmenu2"]);
  return $obj;
}
	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daosubmenu();
		$dat->ingresar(crearsubmenu());
	}
	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daosubmenu();
		$dat->suspender(suspendersubmenu());
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
		$dat=new daosubmenu();
		echo json_encode($dat->consultarcb());
	}
  /*$page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';
  if($page=='consultarcb2'){
    $dat=new DAOCliente();
    echo json_encode($dat->consultarcb2());
  }*/
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat = new daosubmenu();
          $dat->modificar(modificarsubmenu());
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
		$dat = new daosubmenu();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){

         $idsubmenu="'".$c["idsubmenu"]."'";
         $valor="'".str_replace('"', "",$c["valor"])."'";
         $vista="'".str_replace('"', "",$c["vista"])."'";
         $idmenu="'".str_replace('"', "",$c["idmenu"])."'";
         $estado="'".$c["estado"]."'";


         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalsubmenu2\"';
         $editar.='onclick=\"llenarCajas('.$idsubmenu.','.$valor.','.$vista.','.$idmenu.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"> </i></a>';
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$idsubmenu.',0,'.$valor.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$idsubmenu.',1,'.$valor.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }



         $tabla.='{
                  "valor":"'.str_replace('"', "",$c["valor"]).'",
                  "vista":"'.str_replace('"', "",$c["vista"]).'",
                  "valormenu":"'.str_replace('"', "",$c["valormenu"]).'",
                  "acciones":"'.$editar.$suspender.'"
                },';
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
	}

?>