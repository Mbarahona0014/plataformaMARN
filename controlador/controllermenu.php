<?php
require_once "../modelo/daomenu.php";

function crearmenu(){
	$obj=new menu();
  $obj->setValor($_POST["txtvalor"]);
  $obj->setIdtipousuario($_POST["tptipousuario"]);
  return $obj;
}
function suspendermenu(){
	$obj=new menu();
	$obj->setIdmenu($_POST["idmenu"]);
  $obj->setEstado($_POST["estado"]);
	return $obj;
}

function modificarmenu(){
	$obj=new menu();
  $obj->setIdmenu($_POST["txtidmenu2"]);
  $obj->setValor($_POST["txtvalor2"]);
  $obj->setIdtipousuario($_POST["tptipousuario2"]);
  return $obj;
}
	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daomenu();
		$dat->ingresar(crearmenu());
	}
	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daomenu();
		$dat->suspender(suspendermenu());
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
		$dat=new daomenu();
		echo json_encode($dat->consultarcb());
	}
  /*$page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';
  if($page=='consultarcb2'){
    $dat=new DAOCliente();
    echo json_encode($dat->consultarcb2());
  }*/
	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat = new daomenu();
          $dat->modificar(modificarmenu());
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
		$dat = new daomenu();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){

         $idmenu="'".$c["idmenu"]."'";
         $valor="'".str_replace('"', "",$c["valor"])."'";
         $idtipousuario="'".$c["tipo"]."'";
         $estado="'".$c["estado"]."'";


         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalmenu2\"';
         $editar.='onclick=\"llenarCajas('.$idmenu.','.$valor.','.$idtipousuario.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"> </i></a>';
         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$idmenu.',0,'.$valor.');\"><i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\" data-toggle=\"modal\" onclick=\"suspender('.$idmenu.',1,'.$valor.');\"><i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i></a>';
         }



         $tabla.='{
                  "valor":"'.str_replace('"', "",$c["valor"]).'",
                  "tipo":"'.$c["tipo"].'",
                  "acciones":"'.$editar.$suspender.'"
                },';
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
	}

?>