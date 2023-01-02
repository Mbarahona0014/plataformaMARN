<?php

require_once "menu.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daomenu
 {

 	function __construct()
 	{

 	}

 	public function consultarmenuadmin(){
		$c = conectar();
		$sql="select idmenu, valor, menu.estado, idtipousuario, tipo.tipo from menu inner join tipousuario tipo on menu.idtipousuario=tipo.id and menu.estado=1 and menu.idtipousuario=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}

	public function consultarmenuexterno(){
		$c = conectar();
		$sql="select idmenu, valor, menu.estado, idtipousuario, tipo.tipo from menu inner join tipousuario tipo on menu.idtipousuario=tipo.id and menu.estado=1 and menu.idtipousuario=2;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}

 	public function consultar(){
		$c = conectar();
		$sql="select idmenu, valor, menu.estado, idtipousuario, tipo.tipo from menu inner join tipousuario tipo on menu.idtipousuario=tipo.id;";
		$c->set_charset('utf8');
		$res = $c->query($sql);	
		
		return $res;
	}

	public function consultarcb(){
		$c = conectar();
		$sql="select * from tipousuario where estado=1;";
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
		$idtipousuario=$obj->getIdtipousuario();
		$c->set_charset('utf8');

		$sql="Insert into menu values(0,'$valor',1,$idtipousuario);";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}



 	public function modificar($obj)
 	{
 		$c=conectar();
 		$idmenu=$obj->getIdmenu();
 		$valor=str_replace("'","",$obj->getValor());
		$idtipousuario=$obj->getIdtipousuario();
		$c->set_charset('utf8');
		
		$sql="update menu set valor='$valor', idtipousuario=$idtipousuario where idmenu=$idmenu;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 	public function suspender($obj)
 	{
 		$c=conectar();
 		$idmenu=$obj->getIdmenu();
 		$estado=$obj->getEstado();
		$sql="update menu set estado=$estado  where idmenu=$idmenu;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


	public function consultarlistanoti(){
	    $c = conectar();
	    
	    //CONSULTANDO LA CANTIDAD DE REGISTROS CON ESTADO 3

	    /*$sentencia5 = $c->prepare("select count(id_restauracion) as cantidad from restauracion_points where estado=3 and ue.estado=1
        order by id_restauracion desc");
*/        
       $sentencia5 = $c->prepare(" select count(id_restauracion) as cantidad from restauracion_points r 
					left join usuarioexterno ue on ue.id= r.id_usuario where r.estado=3 and ue.estado=1 order by id_restauracion desc;");
        $sentencia5->execute();
        $resultado5 = $sentencia5->get_result();
        $fila5 = $resultado5->fetch_assoc();
        $cantidad=$fila5["cantidad"];
	    
	    return $cantidad;
	}

 }

?>