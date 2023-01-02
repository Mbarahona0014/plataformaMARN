<?php

if ($_SESSION['idtipousuario']==1) {
	require_once "menuadmin.php";
}else if ($_SESSION['idtipousuario']==2) {
	require_once "menuexterno.php"; 
}else if ($_SESSION['idtipousuario']==3) {
	require_once "menuinterno.php"; 
}else if ($_SESSION['idtipousuario']==4) {
	require_once "menuincendio.php"; 
}else if ($_SESSION['idtipousuario']==5) {
	require_once "menurestauracion.php"; 
}


?>