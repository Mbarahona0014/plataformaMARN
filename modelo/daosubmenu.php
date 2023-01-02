<?php

require_once "submenu.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daosubmenu
 {

 	function __construct()
 	{

 	}

 	//FUNCION CONSULTA PARA EL MENU DE LA VISTA
 	public function consultarsubmenu($idmenu){
		$c = conectar();
		$sql="select idsubmenu, submenu.valor, vista, submenu.estado, submenu.idmenu, menu.valor as valormenu from submenu inner join menu  on menu.idmenu=submenu.idmenu where menu.idmenu=$idmenu and menu.estado=1 and submenu.estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}


 	public function consultar(){
		$c = conectar();
		$sql="select idsubmenu, submenu.valor, vista, submenu.estado, submenu.idmenu, menu.valor as valormenu from submenu inner join menu  on menu.idmenu=submenu.idmenu;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}

	public function consultarcb(){
		$c = conectar();
		//$sql="select * from menu where estado=1;";
		//CONSULTA PARA SABER EL TIPO DE USUARIO DEL MENU EN EL COMBO
		$sql="select idmenu, valor, tip.tipo from menu
				left join tipousuario tip on tip.id=menu.idtipousuario where menu.estado=1;";
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
		$valor=str_replace("'","",$obj->getValor());
		$vista=str_replace("'","",$obj->getVista());
		$idmenu=str_replace("'","",$obj->getIdmenu());
		$c->set_charset('utf8');

		$sql="Insert into submenu(idsubmenu, valor, vista, estado, idmenu) values(0,'$valor','$vista',1,$idmenu);";
		if(!$c->query($sql)){
 			//echo "-1".$sql;
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}



 	public function modificar($obj)
 	{
 		$c=conectar();
 		$idsubmenu=$obj->getIdsubmenu();
 		$valor=str_replace("'","",$obj->getValor());
		$vista=str_replace("'","",$obj->getVista());
		$idmenu=str_replace("'","",$obj->getIdmenu());
		$c->set_charset('utf8');
		
		$sql="update submenu set valor='$valor', vista='$vista', idmenu=$idmenu where idsubmenu=$idsubmenu;";
		if(!$c->query($sql)){
 			//echo "-1";
 			echo "-1".$sql;
 		}else{
 			echo "1";
 		}
 	}


 	public function suspender($obj)
 	{
 		$c=conectar();
 		$idsubmenu=$obj->getIdsubmenu();
 		$estado=$obj->getEstado();
		$sql="update submenu set estado=$estado where idsubmenu=$idsubmenu;";
		if(!$c->query($sql)){
 			//echo "-1".$sql;
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}




 }

?>