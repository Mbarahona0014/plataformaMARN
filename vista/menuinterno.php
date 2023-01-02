<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    function changeNumber() {
        $.ajax({
            type: "POST",
            url: "notificaciones.php",
            success: function(data) {
                document.getElementById('input').innerHTML = data ;
                document.getElementById('input2').innerHTML = data ;
            }
        });
    }
    setInterval(changeNumber, 1000);
});
</script>
<?php

require_once "../modelo/daomenu.php";
require_once "../modelo/daosubmenu.php";

  $dat = new daomenu();
  $r=$dat->consultarmenuadmin();

  $r2=$dat->consultarlistanoti();


  $tabla="<ul class='sidebar-menu'><li class='header'>OPCIONES:</li>";
  foreach($r as $c){
if($c["idmenu"]!=7 && $c["idmenu"]!=4){
if($c["idmenu"]==6){
  /*$tabla.='<li class="treeview">
               <a href="#"><i class="fa fa-arrow-circle-right"></i><span>'.$c["valor"].'<span style="color:#32CD32";><b> +'.$r2.'</span></b></span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">';*/
               $tabla.='<li class="treeview">
               <a href="#"><i class="fa fa-arrow-circle-right"></i><span>'.$c["valor"].' <b><span style="color:#32CD32" id="input"></span></b></span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">';
}else{
  //ID DE MANTENIMIENTO MENU ES 4
  $tabla.='<li class="treeview">
               <a href="#"><i class="fa fa-arrow-circle-right"></i> <span>'.$c["valor"].'</span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">';
}
     
               $data = new daosubmenu();
               $re=$data->consultarsubmenu($c["idmenu"]);

               
               foreach($re as $ce){
                //ID 22 SIGNIFICA MENU OPCION APROBACION PARA ADMIN
                if($ce["idsubmenu"]==22){
                  $tabla.='<li><a href="'.$ce["vista"].'">'.$ce["valor"].'<b style="color:#32CD32";> <span id="input2"></span></b></a></li>';
               }else{
                //SI NO HAY REGISTROS PARA APROBAR NO APARECE LA OPCION EN EL MENU AL IGUAL QUE LOS SUBMENUS DE TIPO USUARIO ID2, Y USUARIO INTERNO ID3
                if($ce["idsubmenu"]!=22 && $ce["idsubmenu"]!=2  && $ce["idsubmenu"]!=3){
                  //ID SUBMENU=24 ES EL DEL MAPA DE RESTAURACION Y EL ID 25 ES EL DE INCENDIOS, SE HABRIRA EN OTRA PESTAÑA
                   if($ce["idsubmenu"]==24 || $ce["idsubmenu"]==25){
                    $tabla.='<li><a href="'.$ce["vista"].'" target="_blank">'.$ce["valor"].'</a></li>';
                  }else{
                    $tabla.='<li><a href="'.$ce["vista"].'">'.$ce["valor"].'</a></li>';
                  }

                  
                }
               }
              }
              $tabla.='</ul></li>';
         }
       
       }

  $tabla.='</li></ul>';
  echo $tabla;

?>
