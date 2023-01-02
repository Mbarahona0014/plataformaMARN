<?php
 	
if(empty($_SESSION['nombre']) || empty($_SESSION['idtipousuario']))
{
  
   session_destroy();
   header("location:index.php");
}

?>