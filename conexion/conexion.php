<?php
require_once 'parametros.php';

function conectar(){ 
$con = new mysqli("localhost","root","","mapas");
	if($con->connect_errno){
		print "Ocurrio este error: ". $con->connect_error;
	}
	return $con;
}


?>