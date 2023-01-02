<?php

require_once "indiceisp.php";
include_once "../conexion/conexion.php";
 /**
 *
 */
 class daoindiceisp
 {
 	function __construct()
 	{

 	}

 	public function consultar(){
 		$c=conectar();
 		$sql="select indiceisp.id,ica,iq,ibp,icoe,ics,ita,irv,igp,fechainicio,fechafin, detallepaisaje, indiceisp.estado,idpaisaje,paisaje.nombre as nombrepaisaje from indiceisp
			inner join paisaje on paisaje.id=indiceisp.idpaisaje;";
 		$c->set_charset('utf8');
 		$res= $c->query($sql);

 		return $res;
 	}

 	public function consultarcb(){
		$c = conectar();
		$sql="select * from paisaje where estado=1;";
		$c->set_charset('utf8');
		$res = $c->query($sql);
		$arreglo = array();
		while($re = $res->fetch_array()){
			$arreglo[]=$re;
		}
		return $arreglo;
	}


 	public function ingresar($obj){
 		$c=conectar();
 		$ica=$obj->getIca();
 		$iq=$obj->getIq();
 		$ibp=$obj->getIbp();
 		$icoe=$obj->getIcoe();
 		$ics=$obj->getIcs();
 		$ita=$obj->getIta();
 		$irv=$obj->getIrv();
 		$igp=$obj->getIgp();
 		$fechainicio=$obj->getFechainicio();
 		$fechafin=$obj->getFechafin();
 		$idpaisaje=$obj->getIdpaisaje();
 		$detallepaisaje=str_replace("'","",trim($obj->getDetallepaisaje()));
 		$c->set_charset('utf8');
 		
 		//validacion fecha iniciomenor a fecha fin
 		if($fechainicio<$fechafin)
 		{
 			$sql="Insert into indiceisp(id,ica,iq,ibp,icoe,ics,ita,irv,igp,fechainicio,fechafin, detallepaisaje, idpaisaje,estado)values(0, $ica, $iq, $ibp, $icoe, $ics, $ita, $irv, $igp,'$fechainicio', '$fechafin', '$detallepaisaje', $idpaisaje, 1);";
	 		if(!$c->query($sql)){
	 			echo "-1";
	 		}else{
	 			echo "1";
	 		}
 		}else{
 			echo "-2";
 		}

 		
 	}

 	public function modificar($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$ica=$obj->getIca();
 		$iq=$obj->getIq();
 		$ibp=$obj->getIbp();
 		$icoe=$obj->getIcoe();
 		$ics=$obj->getIcs();
 		$ita=$obj->getIta();
 		$irv=$obj->getIrv();
 		$igp=$obj->getIgp();
 		$fechainicio=$obj->getFechainicio();
 		$fechafin=$obj->getFechafin();
 		$idpaisaje=$obj->getIdpaisaje();
 		$detallepaisaje=str_replace("'","",trim($obj->getDetallepaisaje()));
 		$c->set_charset('utf8');

 		if($fechainicio<$fechafin)
 		{
 			$sql="update indiceisp set ica=$ica, iq=$iq, ibp=$ibp, icoe=$icoe, ics=$ics, ita=$ita, irv=$irv, igp=$igp, fechainicio='$fechainicio', fechafin='$fechafin', detallepaisaje='$detallepaisaje', idpaisaje=$idpaisaje where id=$id;";
	 		if(!$c->query($sql)){
	 			echo "-1";
	 		}else{
	 			echo "1";
	 		}
 		}else{
 			echo "-2";
 		}

 		

 	}

 	public function suspender($obj){
 		$c=conectar();
 		$id=$obj->getId();
 		$estado=$obj->getEstado();
 		$sql="update indiceisp set estado=$estado where id=$id;";
 		if(!$c->query($sql)){
 			echo "-1";
 		}else{
 			echo "1";
 		}
 	}


 }

?>