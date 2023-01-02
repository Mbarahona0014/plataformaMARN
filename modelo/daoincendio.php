<?php
session_start();
require_once "incendio.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoincendio
 {


 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		/*$sql="select i.*, a.AreaNaturalProtegida, f.FormaRecepcion, t.Topografia, te.Tenencia, ifu.InicioFuego, et.EquipoTecnico from IncendioForestal i
		left join AreaNaturalProtegida a on a.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida
		left join FormaRecepcion f on f.IdFormaRecepcion=i.IdFormaRecepcion
        left join Topografia t on t.IdTopografia= i.IdTopografia
        left join Tenencia te on te.IdTenenciaPropiedad=i.IdTenenciaPropiedad
        left join InicioFuego ifu on ifu.IdInicioFuego=i.IdInicioFuego
        left join EquipoTecnico et on et.IdEquipoTec=i.IdEquipoTec order by i.IdIncendio desc;";*/
        $sql="select i.*, relv.*, sum(relv.AreaProtegida) as hectareasanp, sum(relv.ZonaAmortiguamiento) as hectareasafueraanp, tv.TipoVegetacion, us.nombre, ar.AreaNaturalProtegida, topo.Topografia, ten.Tenencia, tec.EquipoTecnico, forec.FormaRecepcion from incendioforestal i 
			left join reltipovegeincendioforestal relv on relv.IdIncendio=i.IdIncendio  
			left join tipovegetacion tv on tv.IdTipoVegetacion= relv.IdTipoVegetacion
			left join areanaturalprotegida ar on ar.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida
			left join topografia topo on topo.IdTopografia=i.IdTopografia
			left join tenencia ten on ten.IdTenenciaPropiedad=i.IdTenenciaPropiedad
			left join equipotecnico tec on tec.IdEquipoTec=i.IdEquipoTec
			left join formarecepcion forec on forec.IdFormaRecepcion=i.IdFormaRecepcion
			left join usuario us on us.id=i.UsuarioCreacion  GROUP BY i.IdIncendio order by i.IdIncendio desc;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function consultarinformecantincendio($fechainicio, $fechafin){
 		$c=conectar();
        $sql="select a.AreaNaturalProtegida, sum(r.AreaProtegida) cantHaAfectadas, 
				(select count(*) from incendioforestal iif where iif.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida and iif.FechaIncendio between '$fechainicio' and '$fechafin') numIncendiosANP
				from reltipovegeincendioforestal r
				inner join incendioforestal i on r.IdIncendio=i.IdIncendio
				inner join areanaturalprotegida a on i.IdAreaNaturalProtegida=a.IdAreaNaturalProtegida
				where i.FechaIncendio between '$fechainicio' and '$fechafin'
				group by i.IdAreaNaturalProtegida;";

		//CONSULTA POR MESES
				/*select i.*, m.nombre as nombre, a.AreaNaturalProtegida as area, sum(r.AreaProtegida) cantHaAfectadas,
				(select count(*) from incendioforestal iif inner join meses me on me.id_mes= MONTH(iif.fechaIncendio) 
				where iif.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida 
				and MONTH(iif.FechaIncendio)=m.id_mes
				and iif.FechaIncendio between '2017-01-01' and '2017-05-30' group by me.id_mes) as numIncendiosANP
				from reltipovegeincendioforestal r
				inner join incendioforestal i on r.IdIncendio=i.IdIncendio
				inner join areanaturalprotegida a on i.IdAreaNaturalProtegida=a.IdAreaNaturalProtegida
				inner join meses m on m.id_mes = MONTH(i.FechaIncendio) and MONTH(i.FechaIncendio) = id_mes
				where i.FechaIncendio between '2017-01-01' and '2017-05-30' 
				group by a.IdAreaNaturalProtegida, m.id_mes*/

 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function consultarinformecantincendiomensual($fechainicio, $fechafin){
 		$c=conectar();
        $sql="select m.nombre, a.AreaNaturalProtegida, sum(r.AreaProtegida) cantHaAfectadas,
			(select count(*) from incendioforestal iif inner join meses me on me.id_mes= MONTH(iif.fechaIncendio) 
			where iif.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida 
			and MONTH(iif.FechaIncendio)=m.id_mes
			and iif.FechaIncendio between '$fechainicio' and '$fechafin' group by me.id_mes) as numIncendiosANP
			from reltipovegeincendioforestal r
			inner join incendioforestal i on r.IdIncendio=i.IdIncendio
			inner join areanaturalprotegida a on i.IdAreaNaturalProtegida=a.IdAreaNaturalProtegida
			inner join meses m on m.id_mes = MONTH(i.FechaIncendio) and MONTH(i.FechaIncendio) = id_mes
			where i.FechaIncendio between '$fechainicio' and '$fechafin' 
			group by a.IdAreaNaturalProtegida, m.id_mes;";

 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function consultarinformecausaincendio($fechainicio, $fechafin){
 		$c=conectar();
 		/*$sql="select i.*, a.AreaNaturalProtegida, f.FormaRecepcion, t.Topografia, te.Tenencia, ifu.InicioFuego, et.EquipoTecnico from IncendioForestal i
		left join AreaNaturalProtegida a on a.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida
		left join FormaRecepcion f on f.IdFormaRecepcion=i.IdFormaRecepcion
        left join Topografia t on t.IdTopografia= i.IdTopografia
        left join Tenencia te on te.IdTenenciaPropiedad=i.IdTenenciaPropiedad
        left join InicioFuego ifu on ifu.IdInicioFuego=i.IdInicioFuego
        left join EquipoTecnico et on et.IdEquipoTec=i.IdEquipoTec order by i.IdIncendio desc;";*/
        $sql="select c.CausaIncendio, count(rc.IdCausaIncendio) cantidad from relcausaincendioforestal rc
				inner join incendioforestal i on rc.IdIncendio=i.IdIncendio
				inner join causaincendio c on rc.IdCausaIncendio=c.IdCausaIncendio
				where i.FechaIncendio between '$fechainicio' and '$fechafin'
				group by rc.IdCausaIncendio;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


	public function consultarpoints(){
 		$c=conectar();
 		//$sql="select p.ano as periodo,rp.id_restauracion as codigo, rp.longitud, rp.latitud, rp.tecnica as nombre, rp.area as descripcion,rp.arboles,rp.Municipio,rp.Canton,rp.Instituciones,rp.Beneficiarios from restauracion_points rp inner join periodo_point p on rp.id_periodo=p.id_periodo where rp.latitud>0 and rp.estado=1;";
 		$sql="select date_format(FechaIncendio,'%d/%m/%Y') as fecha, i.IdIncendio as codigo, i.Geoposicion, ar.AreaNaturalProtegida, 
			date_format(i.FechaFinalizacion,'%d/%m/%Y') as FechaFinalizacion, round(sum(relv.AreaProtegida), 2) as hectareasanp, round(sum(relv.ZonaAmortiguamiento), 2) as hectareasafueraanp from incendioforestal i 
			inner join areanaturalprotegida ar on ar.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida 
			inner join reltipovegeincendioforestal relv on relv.IdIncendio=i.IdIncendio
			where i.EstatusIncendio=1 and  i.Geoposicion!=0 group by i.IdIncendio;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


 	public function consultarpointscoordenadas(){
 		$c=conectar();

 		$sql="select date_format(FechaIncendio,'%d/%m/%Y') AS fecha, i.IdIncendio as codigo, i.Geoposicion, i.coordenadas, ar.AreaNaturalProtegida, date_format(i.FechaFinalizacion,'%d/%m/%Y') as FechaFinalizacion, round(sum(relv.AreaProtegida), 2) as hectareasanp, round(sum(relv.ZonaAmortiguamiento), 2) as hectareasafueraanp from incendioforestal i 
			inner join areanaturalprotegida ar on ar.IdAreaNaturalProtegida=i.IdAreaNaturalProtegida 
			inner join reltipovegeincendioforestal relv on relv.IdIncendio=i.IdIncendio
			where i.EstatusIncendio=1 and  i.coordenadas!=0;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}


	
	public function consultarcb(){
		$c = conectar();
		$sql="select * from areanaturalprotegida where activo=1;";
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
		$sql="select * from equipotecnico where activo=1;";
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
		$sql="select * from formarecepcion where activo=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultarcb4(){
		$c = conectar();
		$sql="select * from topografia where activo=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultarcb5(){
		$c = conectar();
		$sql="select * from tenencia where activo=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultarcheckbox(){
		$c = conectar();
		$sql="select * from causaincendio where activo=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultarcheckboxModifica($id_incendio){
		$c = conectar();
		$sql="select * from relcausaincendioforestal where IdIncendio=$id_incendio;";
		//echo $sql;
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	public function consultartablavegetacionModifica($id_incendio){
		$c = conectar();
		//$sql="select * from RelTipoVegeIncendioForestal where IdIncendio=$id_incendio;";
		$sql="select rel.*, tpv.TipoVegetacion from reltipovegeincendioforestal rel
			inner join tipovegetacion tpv on tpv.IdTipoVegetacion = rel.IdTipoVegetacion where IdIncendio=$id_incendio;";
		//echo $sql;
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}


	public function consultararchivomodifica($id_incendio){
		$c = conectar();
		//$sql="select * from RelTipoVegeIncendioForestal where IdIncendio=$id_incendio;";
		$sql="select * from archivoincendio where IdIncendio=$id_incendio;";
		//echo $sql;
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	

	public function consultartablamedioextincion($id_incendio){
		$c = conectar();
		//$sql="select * from RelTipoVegeIncendioForestal where IdIncendio=$id_incendio;";
		$sql="select rel.*, mext.MedioExtincion from relmedioextincendioforestal rel
			inner join medioextincion mext on mext.IdMedioExtincion=rel.IdMedioExtincion where IdIncendio=$id_incendio;";
		//echo $sql;
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	//en vista es la primera tabla (Hectáreas afectadas por tipo de vegetación)
	public function consultartablavegetacion(){
		$c = conectar();
		$sql="select * from tipovegetacion where activo=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}

	//en vista es la segunda tabla (Instituciones y números de personas participantes)
	public function consultartablaextinsion(){
		$c = conectar();
		$sql="select * from medioextincion where activo=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}


	public function consultarcbfechaincendio(){
		$c = conectar();
		$sql="select distinct date_format(FechaIncendio,'%d/%m/%Y') as fecha from incendioforestal i where i.EstatusIncendio=1 order by i.FechaIncendio desc;";
		//$sql="select * from periodo_point p where p.estado=1 order by p.ano desc;";
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
		$idareanaturalprotegida=$obj->getIdareanaturalprotegida();
		$idequipotec=$obj->getIdequipotec();
		$fechaavisoincendio=$obj->getFechaavisoincendio();
		$fechaincendio=$obj->getFechaincendio();
		$fechafinalizacion=$obj->getFechafinalizacion();
		//FECHAREPORTE PUEDE SER FECHA DEL SISTEMA NO ESTOY SEGURO
		$idformarecepcion=$obj->getIdformarecepcion();
		$rutaacceso=str_replace("'","",$obj->getRutaacceso());
		$idtopografia=$obj->getIdtopografia();
		$idtenenciapropiedad=$obj->getIdtenenciapropiedad();


		$velocidadpropagacion=str_replace("'","",trim($obj->getVelocidadpropagacion()));
		$comentarios=str_replace("'","",$obj->getComentarios());
		//GEOGRAFIA ES LATITUD Y LONGITUD
		$geoposicion=str_replace("'","",trim($obj->getGeoposicion()));
		$coordenadas=str_replace("'","",$obj->getCoordenadas());
		$idusuario=$_SESSION['id'];

		$c->set_charset('utf8');

		

		//SI NO HA INSERTADO UN PUNTO O POLIGONO IMPRIME -4
		if(empty($coordenadas) && empty($geoposicion))
		{
			echo "-4";
			exit();
		}else{

			//FECHA INCENDIO NO PUEDE SER MAYOR A LA FECHA DE AVISO
	 		//FIN DE INCENDIO NO PUEDE SER MENOR A LA FECHA DE INICIO Y VICEVERSA

	 		//VALIDANDO FECHAS
	 		if($fechaincendio<=$fechaavisoincendio)
	 		{
	 			if($fechaincendio<=$fechafinalizacion)
	 			{
	 				//EL PRIMER 1 ES DEL CAMPO ESTATUSINCENDIO
					//EL 2 EN EL INSERT HACE REFERENECIA A QUE LO INSERTA EL USUARIO CRIVERA CON ID2
					//EL ULTIMO 1 ES DEL CAMPO ELIMINADO
					$sql="insert into incendioforestal values(0,$idareanaturalprotegida,now(),'$fechaincendio','$fechaavisoincendio',$idformarecepcion,$idtopografia,$idtenenciapropiedad,null,1,null,null,null,null,'$velocidadpropagacion','$rutaacceso','$comentarios',null,null,'$geoposicion','$fechafinalizacion',$idusuario,$idequipotec,null,1,'$coordenadas');";
					if(!$c->query($sql)){
			 			echo "-1".$sql;
			 			exit();
			 		}else{
			 			echo "1";
			 		}
	 			}else{
	 				//ERROR FECHA FIN DE INCENDIO NO PUEDE SER MENOR A LA FECHA DE INICIO DEL INCENDIO
	 				echo "-3";
	 				//COLOCO EXIT() PARA QUE SE DETENGA EL CODIGO DEL CONTROLLER, YQ EU SI NO DARIA ERROR POR LA FECHA PERO SIMPERE INSRTARIA EN LA DEMAS TABLAS RELACIONES
	 				exit();
	 			}
	 			
	 		}else{
	 			//ERROR FECHA DE INCENDIO NO PUEDE SER MAYOR A LA FECHA DE AVISO
	 			echo "-2";
	 			//COLOCO EXIT() PARA QUE SE DETENGA EL CODIGO DEL CONTROLLER, YQ EU SI NO DARIA ERROR POR LA FECHA PERO SIMPERE INSRTARIA EN LA DEMAS TABLAS RELACIONES
	 			exit();
	 		}

		}

 		




 	}








 	public function modificar($obj)
 	{
 		$c=conectar();
 		$idincendio=$obj->getIdincendio();
		$idareanaturalprotegida=$obj->getIdareanaturalprotegida();
		$idequipotec=$obj->getIdequipotec();
		$fechaavisoincendio=$obj->getFechaavisoincendio();
		$fechaincendio=$obj->getFechaincendio();
		$fechafinalizacion=$obj->getFechafinalizacion();
		//FECHAREPORTE PUEDE SER FECHA DEL SISTEMA NO ESTOY SEGURO
		$idformarecepcion=$obj->getIdformarecepcion();
		$rutaacceso=str_replace("'","",$obj->getRutaacceso());
		$idtopografia=$obj->getIdtopografia();
		$idtenenciapropiedad=$obj->getIdtenenciapropiedad();


		$velocidadpropagacion=str_replace("'","",trim($obj->getVelocidadpropagacion()));
		$comentarios=str_replace("'","",$obj->getComentarios());
		//GEOGRAFIA ES LATITUD Y LONGITUD
		$geoposicion=str_replace("'","",trim($obj->getGeoposicion()));
		$coordenadas=str_replace("'","",$obj->getCoordenadas());
		//$idusuario=$_SESSION['id'];

		$c->set_charset('utf8');


		//SI NO HA INSERTADO UN PUNTO O POLIGONO IMPRIME -4
		if(empty($coordenadas) && empty($geoposicion))
		{
			echo "-4";
			exit();
		}else{
			//FECHA INCENDIO NO PUEDE SER MAYOR A LA FECHA DE AVISO
	 		//FIN DE INCENDIO NO PUEDE SER MENOR A LA FECHA DE INICIO Y VICEVERSA

	 		//VALIDANDO FECHAS
	 		if($fechaincendio<=$fechaavisoincendio)
	 		{
	 			if($fechaincendio<=$fechafinalizacion)
	 			{
	 				//EL PRIMER 1 ES DEL CAMPO ESTATUSINCENDIO
					//EL 2 EN EL INSERT HACE REFERENECIA A QUE LO INSERTA EL USUARIO CRIVERA CON ID2
					//EL ULTIMO 1 ES DEL CAMPO ELIMINADO
					$sql="update incendioforestal set IdAreaNaturalProtegida=$idareanaturalprotegida, FechaIncendio='$fechaincendio', FechaAvisoIncendio='$fechaavisoincendio', IdFormaRecepcion=$idformarecepcion, IdTopografia=$idtopografia, IdTenenciaPropiedad=$idtenenciapropiedad, VelocidadPropagacion='$velocidadpropagacion', RutaAcceso='$rutaacceso', Comentarios='$comentarios', Geoposicion='$geoposicion', FechaFinalizacion='$fechafinalizacion', IdEquipoTec=$idequipotec, coordenadas='$coordenadas' where IdIncendio=$idincendio;";
					if(!$c->query($sql)){
			 			echo "-1";
			 			exit();
			 		}else{
			 			echo "1";
			 		}
	 			}else{
	 				//ERROR FECHA FIN DE INCENDIO NO PUEDE SER MENOR A LA FECHA DE INICIO DEL INCENDIO
	 				echo "-3";
	 				//COLOCO EXIT() PARA QUE SE DETENGA EL CODIGO DEL CONTROLLER, YQ EU SI NO DARIA ERROR POR LA FECHA PERO SIMPERE INSRTARIA EN LA DEMAS TABLAS RELACIONES
	 				exit();
	 			}
	 			
	 		}else{
	 			//ERROR FECHA DE INCENDIO NO PUEDE SER MAYOR A LA FECHA DE AVISO
	 			echo "-2";
	 			//COLOCO EXIT() PARA QUE SE DETENGA EL CODIGO DEL CONTROLLER, YQ EU SI NO DARIA ERROR POR LA FECHA PERO SIMPERE INSRTARIA EN LA DEMAS TABLAS RELACIONES
	 			exit();
	 		}

		}
 	}


 	public function suspender($obj)
 	{
 		$c=conectar();
 		$idincendio=$obj->getIdincendio();
 		$estado=$obj->getEstatusincendio();
 		//NO SE CON CUAL CAMPO ELIMINA EN LA BASE SI CON ESTATUSINCENDIO O CON ELIMINADO
		$sql="update incendioforestal set EstatusIncendio=$estado  where IdIncendio=$idincendio;";
		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}

 }

?>