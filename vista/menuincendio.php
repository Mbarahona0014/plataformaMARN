<?php

require_once "../modelo/daomenu.php";
require_once "../modelo/daosubmenu.php";

  $dat = new daomenu();
  $r=$dat->consultarmenuadmin();


  $tabla="<ul class='sidebar-menu'><li class='header'>OPCIONES:</li>";
  foreach($r as $c){

//ID MENU=7 HACE REFERENCIA AL MENU DE INCENDIOS
if($c["idmenu"]==7){

  $tabla.='<li class="treeview">
               <a href="#"><i class="fa fa-arrow-circle-right"></i> <span>'.$c["valor"].'</span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">';

      
               $data = new daosubmenu();
               $re=$data->consultarsubmenu($c["idmenu"]);

               
               foreach($re as $ce){
                  //ID 25 ES EL DE INCENDIOS, SE HABRIRA EN OTRA PESTAÑA
                   if($ce["idsubmenu"]==25){
                    $tabla.='<li><a href="'.$ce["vista"].'" target="_blank">'.$ce["valor"].'</a></li>';
                  }else{
                    $tabla.='<li><a href="'.$ce["vista"].'">'.$ce["valor"].'</a></li>';
                  }
              }
              $tabla.='</ul></li>';
         }
       }

  $tabla.='</li></ul>';
  echo $tabla;

?>
