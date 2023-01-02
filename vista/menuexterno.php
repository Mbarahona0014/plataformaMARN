<!-- <ul class="sidebar-menu">
            <li class="header">OPCIONES:</li>
             <li class="treeview">
              <a href="#"><i class="fa fa-arrow-circle-right"></i> <span>MANTENIMIENTO USUARIO</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="vtipousuario.php">TIPO USUARIO</a></li>
                <li><a href="vusuario.php">USUARIO </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-arrow-circle-right"></i> <span>MANTENIMIENTO MENU</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="vmenu.php">MENU</a></li>
                <li><a href="vsubmenu.php">SUBMENU </a></li>
              </ul>
            </li>
            </ul> -->

<?php

require_once "../modelo/daomenu.php";
require_once "../modelo/daosubmenu.php";
                    $dat = new daomenu();
  $r=$dat->consultarmenuexterno();
  $tabla="<ul class='sidebar-menu'><li class='header'>OPCIONES:</li>";
  foreach($r as $c){
      $tabla.='<li class="treeview">
               <a href="#"><i class="fa fa-arrow-circle-right"></i> <span>'.$c["valor"].'</span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">';
               $data = new daosubmenu();
               $re=$data->consultarsubmenu($c["idmenu"]);
               foreach($re as $ce){
                  if($ce["idsubmenu"]==26){
                    $tabla.='<li><a href="'.$ce["vista"].'" target="_blank">'.$ce["valor"].'</a></li>';
                  }else{
                    $tabla.='<li><a href="'.$ce["vista"].'">'.$ce["valor"].'</a></li>';
                  }
              }
              $tabla.='</ul></li>';
         }
  $tabla.='</li></ul>';
  echo $tabla;

?>