<?php
require_once "../modelo/daosesion.php";

function sesion(){
    $obj=new sesion();
    $obj->setcorreo($_POST["usuario"]);
    $obj->setcontra($_POST["contra"]);
    return $obj;
}

$page = isset($_GET['btnsesion'])?$_GET['btnsesion']:'';
  if($page=='inicio'){
    $dat=new daosesion();
    $dat->iniciarSesion(sesion());
  }

  $page = isset($_GET['btnsesioninterna'])?$_GET['btnsesioninterna']:'';
  if($page=='sesioninterna'){
  	//AQUI IRA EL AD PARA USUARIO INTERNO Y ADMIN
    //echo "PROBANDO";
    //ECHO 1 CONTRASEÑA CORRECTA Y ECHO -1 CONTRASEÑA INCORRECTA
  	//echo "1";
  	//echo "-1"
  	// ejemplo de autenticación
	$ldaprdn  = explode("@", $_POST["usuario"]);   // ldap rdn or dn
	$ldappass = $_POST["contra"];   // associated password


	echo "1";


	//PRUEBA CON CONTRASEÑA SIN AD
	/*if($_POST["contra"]=="1"){
		echo "1";
	}else{
		echo "-1";
	}*/
	//ELIMINA LA ADVERTENCIA DE WARNING SI NO SE PUEDE CONECTAR AL AD DA UN WARNING
	//error_reporting(E_ALL ^ E_WARNING);
	// conexión al servidor LDAP
	/*$ldapconn = ldap_connect("ambiente.gob.sv")
	    or die("Could not connect to LDAP server.");

	if ($ldapconn) {

	    // realizando la autenticación
	    //echo ($ldapconn==true)."-----------".$ldaprdn."-----------".$ldappass;
	    $ldapbind = ldap_bind($ldapconn, "AMBIENTE\\".$ldaprdn[0], $ldappass);

	    // verificación del enlace
	    if ($ldapbind) {
	    	echo "1";
	        //echo "LDAP bind successful...";
	    } else {

	    	echo "-1";
	        //echo "LDAP bind failed...";
	    }
	    //RESETEANDO EL ERROR_REPORTING PARA QUE YA TIRE ADVERTENCIAS
	    //error_reporting(E_ALL);
	    //restore_error_handler();
	    //echo 4/0;

	}*/


  }

?>