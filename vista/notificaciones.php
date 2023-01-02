<?php

require_once "../modelo/daomenu.php";

  $dat = new daomenu();
  $r=$dat->consultarmenuadmin();

  $r2=$dat->consultarlistanoti();

  if($r2>0){
  	echo "[+".$r2."]";
  }
  
?>