<?php
session_start();
require_once "restauracionpuntos.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daorestauracionpuntos
 {
 	function __construct()
 	{

 	}

 	public function consultarsumahectareas(){
 		$c=conectar();
 		/*$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		inner join usuario u on r.id_usuario=u.id
		left join tecnica t on r.idtecnicas= t.IdTecnica order by r.id_restauracion desc;";*/
		//LEFT JOIN EN USUARIO YA QUE SI LO INSERTA UN USUARIO EXTERNO EL CAMPO DE ID_USUARIO SERA 0
		$sql="select sum(area) as contador from restauracion_points where estado=1;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function consultar(){
 		$c=conectar();
 		/*$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		inner join usuario u on r.id_usuario=u.id
		left join tecnica t on r.idtecnicas= t.IdTecnica order by r.id_restauracion desc;";*/
		//LEFT JOIN EN USUARIO YA QUE SI LO INSERTA UN USUARIO EXTERNO EL CAMPO DE ID_USUARIO SERA 0
		$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, ue.nombre as nombreexterno, ue.apellido as apellidoexterno, u.nombre as nombreinterno, u.apellido as apellidointerno, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		left join usuario u on r.id_usuario=u.id
        left join usuarioexterno ue on r.id_usuario=ue.id
		left join tecnica t on r.idtecnicas= t.IdTecnica and t.estado=1 where r.estado=0 or r.estado=1 order by r.id_restauracion desc;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);
 		return $res;
 	}

 	public function consultaraprobacion(){
 		$c=conectar();
 		/*$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		inner join usuario u on r.id_usuario=u.id
		left join tecnica t on r.idtecnicas= t.IdTecnica order by r.id_restauracion desc;";*/
		//LEFT JOIN EN USUARIO YA QUE SI LO INSERTA UN USUARIO EXTERNO EL CAMPO DE ID_USUARIO SERA 0
		//ESTADO 3 SIGNIFICA QUE NO HA SIDO APROBADO
		$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, ue.nombre as nombreexterno, ue.apellido as apellidoexterno, ue.correo, u.nombre as nombreinterno, u.apellido as apellidointerno, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		left join usuario u on r.id_usuario=u.id
        left join usuarioexterno ue on r.id_usuario=ue.id
		left join tecnica t on r.idtecnicas= t.IdTecnica and t.estado=1 where banderausuario=2 and r.estado=3 and ue.estado=1 order by r.id_restauracion desc;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function consultarregistroexterno($idusuario){
 		$c=conectar();
 		/*$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		inner join usuario u on r.id_usuario=u.id
		left join tecnica t on r.idtecnicas= t.IdTecnica order by r.id_restauracion desc;";*/
		//LEFT JOIN EN USUARIO YA QUE SI LO INSERTA UN USUARIO EXTERNO EL CAMPO DE ID_USUARIO SERA 0
		//ESTADO 3 SIGNIFICA QUE NO HA SIDO APROBADO
		$sql="select r.*, p.id_periodo,p.ano, u.usuarioad, ue.nombre as nombreexterno, ue.apellido as apellidoexterno, ue.correo, u.nombre as nombreinterno, u.apellido as apellidointerno, t.Tecnica from restauracion_points r
		inner join periodo_point p on p.id_periodo=r.id_periodo
		left join usuario u on r.id_usuario=u.id
        left join usuarioexterno ue on r.id_usuario=ue.id
		left join tecnica t on r.idtecnicas= t.IdTecnica and t.estado=1 where banderausuario=2 and r.id_usuario=$idusuario order by r.id_restauracion desc;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function consultarcontador(){
		$c = conectar();
		$sql="select sum(area) as contador FROM restauracion_points where estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();

		$cantidad=0;
	  	while($re = mysql_fetch_array($res)){
	    	$cantidad=$re["contador"]+4388.70;
	  	}

	  	/*while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}*/
		return $cantidad;
	}

	public function consultarcbtecnica(){
		$c = conectar();
		$sql="select * from tecnica where estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}		


	public function consultarpoints(){
 		$c=conectar();
 		$sql="select p.ano as periodo,rp.id_restauracion as codigo, rp.longitud, rp.latitud, rp.tecnica as nombre, rp.area as descripcion,rp.arboles,rp.Municipio,rp.Canton,rp.Instituciones,rp.Beneficiarios from restauracion_points rp inner join periodo_point p on rp.id_periodo=p.id_periodo where rp.latitud>0 and rp.estado=1;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);
 		return $res;
 	}

 	public function consultarpointscoordenadas(){
 		$c=conectar();
 		$sql="select p.ano as periodo,rp.id_restauracion as codigo, rp.longitud, rp.latitud, rp.coordenadas, rp.tecnica as nombre, rp.area as descripcion,rp.arboles,rp.Municipio,rp.Canton,rp.Instituciones,rp.Beneficiarios from restauracion_points rp inner join periodo_point p on rp.id_periodo=p.id_periodo where rp.coordenadas!=0 and rp.estado=1 order by id_restauracion desc;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);
 		return $res;
 	}

 	 //CONSULTA SI EL REGISTRO YA FUE PROCESADO POR OTRO USUARIO
	public function consultarestado($id_restauracion)
 	{
 		$c=conectar();
		$sql="select estado from restauracion_points where id_restauracion=$id_restauracion;";
		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


	
	public function consultarcb(){
		$c = conectar();
		$sql="select * from periodo_point where estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}


	public function consultarcb2(){
		$c = conectar();
		$sql="select * from municipioss m inner join depto d on m.Iddepto=d.Id order by d.Depto;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultarcb3(){
		$c = conectar();
		$sql="select ano from periodo_point p where p.estado=1 order by p.ano desc;";
		//$sql="select * from periodo_point p where p.estado=1 order by p.ano desc;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultarcbespecie(){
		$c = conectar();
		$sql="select * from especie where estado=1;";
		//$sql="select * from periodo_point p where p.estado=1 order by p.ano desc;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultararchivomodifica($id_restauracion){
		$c = conectar();
		//$sql="select * from RelTipoVegeIncendioForestal where IdIncendio=$id_restauracion;";
		$sql="select * from archivorestauracion where id_restauracion=$id_restauracion;";
		//echo $sql;
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
		$idperiodo=$obj->getIdperiodo();
		$tecnica=str_replace("'","",$obj->getTecnica());

		$longitud=str_replace("'","",trim($obj->getLongitud()));
		$latitud=str_replace("'","",trim($obj->getLatitud()));

		$area=str_replace("'","",$obj->getArea());
		//$arboles=str_replace("'","",$obj->getArboles());
		$municipio=$obj->getMunicipio();
		$canton=str_replace("'","",$obj->getCanton());
		$ubicacion=str_replace("'","",$obj->getUbicacion());
		$beneficiarios=str_replace("'","",$obj->getBeneficiarios());
		$instituciones=str_replace("'","",$obj->getInstituciones());
		$especie=$obj->getEspecie() == "undefined"? null :  $obj->getEspecie();
		$cantidadpersonas=$obj->getCantidadpersonas();
		$comentarios=str_replace("'","",$obj->getComentarios());
		$idtecnicas=$obj->getIdtecnicas();
		$coordenadas=str_replace("'","",$obj->getCoordenadas());
		$idusuario=$_SESSION['id'];
		$idtipousuario=$_SESSION['idtipousuario'];
		$c->set_charset('utf8');

		//DEBO DE CREAR UN NUEVO CAMPO EN LA BASE DE DATOS DE LA TABLA RESTAURACION_POINTS Y ENLAZARLO CON LA TABLA USUARIOEXTERNO, PARA LA CONSULTA DEL DAO HACER UN LEFT JOIN

		//SI NO HA INSERTADO UN PUNTO O POLIGONO IMPRIME -2
		if(empty($coordenadas) && $latitud==0)
		{
			echo "-2";
			//CON EXIT EVITO QUE SUBA LAS IMAGENES SI NO SE INSERTO EL REGISTRO
			exit();
			
		}else{

			if($idtipousuario=='2'){
				//SI INSERTA UN USUARIO EXTERNO LA VARIABLE DE SESION IDTIPOUSUARIO ES 2
				//SIEMPRE SE INSERTARA ID_USUARIO SOLO QUE LA BANDERA USUARARIO AQUI SERA 2
				//EL ULTIMO VALOR DEL INSERT ES LA BANDERAUSUARIO
				//EL 3 DEL INSERT SIGNIFICA QUE NO HA SIDO APROBADO EL REGISTRO POR EL AADMIN

				//$idusuarioexterno=$_SESSION['id'];

				/*$sql="insert into restauracion_points values(0,'','',$latitud,$longitud,$area,0,'$municipio','$canton','$ubicacion','$beneficiarios','$instituciones','',null,now(),1,$idperiodo,'$especie',$cantidadpersonas,'$comentarios',$idtecnicas,'$coordenadas',$idusuarioexterno);";*/

				$sql="insert into restauracion_points values(0,'','',$latitud,$longitud,$area,0,'$municipio','$canton','$ubicacion','$beneficiarios','$instituciones','',$idusuario,now(),3,$idperiodo,'$especie',$cantidadpersonas,'$comentarios',$idtecnicas,'$coordenadas',2);";

				if(!$c->query($sql)){
		 			echo "-1";
		 			//CON EXIT EVITO QUE SUBA LAS IMAGENES SI NO SE INSERTO EL REGISTRO
		 			exit();
		 		}else{
		 			//SI IMPRIME ECHO 2 SIGNIFICA QUE INSERTO EL USUARIO EXTERNO Y ASI ENVIO UNA ALERTA DIFERENTE EN EL JS
		 			echo "2";
		 		}
			
			}else{
				//ES UN USUARIO INTERNO
				//EL ULTIMO null HACE REFERENCIA A QUE NO ES UN USUARIO EXTERNO
				$sql="insert into restauracion_points values(0,'','',$latitud,$longitud,$area,0,'$municipio','$canton','$ubicacion','$beneficiarios','$instituciones','',$idusuario,now(),1,$idperiodo,'$especie',$cantidadpersonas,'$comentarios',$idtecnicas,'$coordenadas',1);";
				/*$sql="insert into restauracion_points values(0,'','',$latitud,$longitud,$area,0,'$municipio','$canton','$ubicacion','$beneficiarios','$instituciones','',0,now(),1,$idperiodo,'$especie',$cantidadpersonas,'$comentarios',$idtecnicas,'$coordenadas');";*/

				if(!$c->query($sql)){
		 			echo "-1";
		 			//CON EXIT EVITO QUE SUBA LAS IMAGENES SI NO SE INSERTO EL REGISTRO
		 			exit();
		 		}else{
		 			echo "1";
		 		}

			}
			
			
		}

		


 	}



 	public function modificar($obj)
 	{
 		$c=conectar();
 		$idrestauracion=$obj->getIdrestauracion();
 		$idperiodo=$obj->getIdperiodo();
		$tecnica=str_replace("'","",$obj->getTecnica());
		$longitud=str_replace("'","",trim($obj->getLongitud()));
		$latitud=str_replace("'","",trim($obj->getLatitud()));
		$area=str_replace("'","",$obj->getArea());
		//$arboles=str_replace("'","",$obj->getArboles());
		$municipio=$obj->getMunicipio();
		$canton=str_replace("'","",$obj->getCanton());
		$ubicacion=str_replace("'","",$obj->getUbicacion());
		$beneficiarios=str_replace("'","",$obj->getBeneficiarios());
		$instituciones=str_replace("'","",$obj->getInstituciones());
		$especie=$obj->getEspecie() == "undefined"? null :  $obj->getEspecie();
		$cantidadpersonas=$obj->getCantidadpersonas();
		$comentarios=str_replace("'","",$obj->getComentarios());
		$idtecnicas=$obj->getIdtecnicas();
		$coordenadas=str_replace("'","",$obj->getCoordenadas());
		$idtipousuario=$_SESSION['idtipousuario'];
		//$idtipousuario=$_SESSION['idtipousuario'];
		//$idusuario=$_SESSION['id'];
		$c->set_charset('utf8');

		if(empty($coordenadas) && $latitud==0)
		{
			echo "-2";
			//CON EXIT EVITO QUE SUBA LAS IMAGENES SI NO SE INSERTO EL REGISTRO
			exit();
			
		}else{
			if($idtipousuario=='2'){

			//EL ESTADO VUELVE A SER 3 Y QUEDA PENDIENTE DE APROBACION
			$sql="update restauracion_points set id_periodo=$idperiodo,tecnica='$tecnica',latitud=$latitud,longitud=$longitud, area=$area, municipio='$municipio',canton='$canton',ubicacion='$ubicacion',beneficiarios='$beneficiarios',instituciones='$instituciones', especies='$especie', cantidadpersonas=$cantidadpersonas, comentarios='$comentarios', idtecnicas=$idtecnicas, coordenadas='$coordenadas', estado=3 where id_restauracion=$idrestauracion;";
			if(!$c->query($sql)){
	 			echo "-1";
	 			//CON EXIT EVITO QUE SUBA LAS IMAGENES SI NO SE INSERTO EL REGISTRO
	 			exit();
	 		}else{
	 			echo "1";
	 		}


		}else{
			$sql="update restauracion_points set id_periodo=$idperiodo,tecnica='$tecnica',latitud=$latitud,longitud=$longitud, area=$area, municipio='$municipio',canton='$canton',ubicacion='$ubicacion',beneficiarios='$beneficiarios',instituciones='$instituciones', especies='$especie', cantidadpersonas=$cantidadpersonas, comentarios='$comentarios', idtecnicas=$idtecnicas, coordenadas='$coordenadas' where id_restauracion=$idrestauracion;";
			if(!$c->query($sql)){
	 			echo "-1";
	 			//CON EXIT EVITO QUE SUBA LAS IMAGENES SI NO SE INSERTO EL REGISTRO
	 			exit();
	 		}else{
	 			echo "1";
	 		}
		}
		}

		
		
	

		
 	}


 	public function suspender($obj)
 	{
 		$c=conectar();
 		$idrestauracion=$obj->getIdrestauracion();
 		$estado=$obj->getEstado();
		$sql="update restauracion_points set estado=$estado  where id_restauracion=$idrestauracion;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


  	

 }

?>