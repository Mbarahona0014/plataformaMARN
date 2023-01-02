<?php
require_once "../modelo/daoincendio.php";
require_once "../modelo/daorelcausaincendio.php";
require_once "../modelo/daoreltipovegetacion.php";
require_once "../modelo/daorelmedioextincion.php";
require_once "../modelo/daoarchivoincendio.php";


function crearincendio(){

}


function suspenderincendio(){
	$obj=new incendio();
	$obj->setIdIncendio($_POST["id"]);
  $obj->setEstatusincendio($_POST["estado"]);
	return $obj;
}

/*function modificarincendio(){
	$obj=new incendio();
  $obj->setIdrestauracion($_POST["txtid2"]);
  $obj->setIdperiodo($_POST["tpperiodo2"]);
  $obj->setTecnica($_POST["txttecnica2"]);
  $obj->setLongitud($_POST["txtlongitud2"]);
  $obj->setLatitud($_POST["txtlatitud2"]);
  $obj->setArea($_POST["txtarea2"]);
  $obj->setArboles($_POST["txtarboles2"]);
  $obj->setMunicipio($_POST["tpmunicipio2"]);
  $obj->setCanton($_POST["txtcanton2"]);
  $obj->setUbicacion($_POST["txtubicacion2"]);
  $obj->setBeneficiarios($_POST["txtbeneficiarios2"]);
  $obj->setInstituciones($_POST["txtinstituciones2"]);
  $obj->setEspecie($_REQUEST["txtlistaespecie"]);
  $obj->setCantidadpersonas($_POST["txtcantidadpersonas2"]);
  $obj->setComentarios($_POST["txtcomentarios2"]);
  $obj->setIdTecnicas($_POST["tptecnica2"]);

  return $obj;
}*/

  $page = isset($_GET['btnModificar'])?$_GET['btnModificar']:'';
  if($page=='modificandoImagen'){
    $obj=new archivoincendio();
    $obj->setIdarchivo($_REQUEST["id_imagen"]);
    $obj->setIdincendio($_REQUEST["IdIncendio"]);


    $obj2=new daoarchivoincendio();
    $obj2->eliminandoarchivoincendio($obj);
  }

  $page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
  if($page=='modificandoagregarImagen'){

    if(isset($_FILES['files']))
    {
      

        $error=array();
        $extension=array("jpeg","jpg","png","gif");

        $obj5=new archivoincendio();
        $obj5->setIdIncendio($_POST["id_incendio"]);

        $file_name=$_FILES["files"]["name"];
        $file_tmp=$_FILES["files"]["tmp_name"];

        if($file_name==null || $file_tmp=$_FILES["files"]["tmp_name"]==null)
        {
          echo "-2";
          //NO AGREGO NINGUNA IMAGEN

        }else{
          $ext=pathinfo($file_name,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)) {
            if(!file_exists("../vista/recursos/images/incendios/".$file_name)) {
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"],"../vista/recursos/images/incendios/".$file_name);
                $obj5->setArchivo($file_name);
            }


            else {
                $filename=basename($file_name,$ext);
                $newFileName=$filename.time().".".$ext;
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"],"../vista/recursos/images/incendios/".$newFileName);
                $obj5->setArchivo($newFileName);
            }

            $dat5=new daoarchivoincendio();
            $dat5->ingresararchivoincendiomodifica($obj5);


            }
            else {
                array_push($error,"$file_name, ");
            }

        }

        
        
      }




  }



	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$obj=new incendio();
    $obj->setIdareanaturalprotegida($_POST["tpareanatural"]);
    $obj->setIdequipotec($_POST["tpequipotecnico"]);
    $obj->setFechaavisoincendio($_POST["txtfechaaviso"]);
    $obj->setFechaincendio($_POST["txtfechainicio"]);
    $obj->setFechafinalizacion($_POST["txtfechafin"]);
    $obj->setIdformarecepcion($_POST["tpformaaviso"]);
    $obj->setRutaacceso($_POST["txtubicacionacceso"]);
    $obj->setIdtopografia($_POST["tptopografia"]);
    $obj->setIdtenenciapropiedad($_POST["tptenenciapropiedad"]);
    
    if($_POST["txtvelocidadpropagacion"]==null){
      $obj->setVelocidadpropagacion(0);
    }else{
      $obj->setVelocidadpropagacion($_POST["txtvelocidadpropagacion"]);
    }
    $obj->setComentarios($_POST["txtcomentarios"]);

    //SI NO INGRESA PUNTO EN EL MAPA GEOPOSISCION SERA VACIO    
    if($_POST["txtlongitud"]==null || $_POST["txtlatitud"]==null ){
      $obj->setGeoposicion("");
    }else{
      $obj->setGeoposicion($_POST["txtlatitud"].",".$_POST["txtlongitud"]);
    }

    if($_POST["txtcoordenadas"]!=null){
      $explo = explode(",", $_POST["txtcoordenadas"]);
      if($explo[0]!=$explo[2]){
        //SIGNIFICA QUE EL POLIGONO TIENE COORDENADAS IGUALES
        $obj->setCoordenadas($_POST["txtcoordenadas"]);
      }
    }
    //$obj->setCoordenadas($_POST["txtcoordenadas"]);

    

    $dat=new daoincendio();
    $dat->ingresar($obj);

  //INGRESANDO DATOS A TABLA RELCAUSAINCENDIO
  if(!empty($_POST["checkboxca"]))
    {
      
      $obj2=new relcausaincendio();
      foreach($_POST['checkboxca'] as $selected){

        $obj2->setIdcausaincendio($selected);
        $dat2=new daorelcausaincendio();
        $dat2->ingresarrelcausaincendio($obj2);

      }
      
    }

    //INGRESANDO DATOS A TABLA RELTIPOVEGE
    $obj3=new reltipovegetacion();
    $num=$_POST["txtnum"];
    for ($i=1; $i <= $num; $i++) { 


        $obj3->setIdtipovegetacion($_POST["txtidtipovege"][$i]);
        if($_POST["txttipovegareaprot"][$i]!=null){
          $obj3->setAreraprotegida($_POST["txttipovegareaprot"][$i]);
        }else if(($_POST["txttipovegareaprot"][$i]==null)){
          $obj3->setAreraprotegida(0.00);
        }

        if($_POST["txttipovegzonaamort"][$i]!=null){
          $obj3->setZonaamortiguamiento($_POST["txttipovegzonaamort"][$i]);
        }else if(($_POST["txttipovegzonaamort"][$i]==null)){
          $obj3->setZonaamortiguamiento(0.00);
        }
        $dat3=new daoreltipovegetacion();
        $dat3->ingresarreltipoveg($obj3);
    }


    //INGRESANDO DATOS A TABLA RELMEDIOEXT
    $obj4=new relmedioextincion();
    $num2=$_POST["txtnum2"];
    for ($i=1; $i <= $num2; $i++) { 


        $obj4->setIdmedioextincion($_POST["txtidmedioext"][$i]);
        if($_POST["txtmedioextcant"][$i]!=null){
          $obj4->setCantidad($_POST["txtmedioextcant"][$i]);
        }else if(($_POST["txtmedioextcant"][$i]==null)){
          $obj4->setCantidad(0);
        }

        $dat4=new daorelmedioextincion();
        $dat4->ingresarmedioextincion($obj4);
    }

    //INGRESANDO IMAGEN

/*$formatos=array('.jpg','.png','.gif','.jpeg','.JPG','.PNG','.GIF','.JPEG');
  $nombreArchivo=$_FILES["file"]["name"];
  $nombreTmpArchivo=$_FILES["file"]["tmp_name"];
  $ext=substr($nombreArchivo, strrpos($nombreArchivo, "."));
    echo $ext;
    if (in_array($ext, $formatos)) {
      if (move_uploaded_file($nombreTmpArchivo, "../vista/recursos/images/Empleados/$nombreArchivo")) {

      }
      else{
        echo "<h1><center>Ocurrio un error al cargar la foto, ASEGURESE QUE SEA UNA IMAGEN O QUE SEA UN FORMATO RECONOCIBLE 1('JPG','GIF','PNG')</h1></center>";
      }
    }
    else
    {
      echo "<h1><center>Ocurrio un error al cargar la foto, ASEGURESE QUE SEA UNA IMAGEN O QUE SEA UN FORMATO RECONOCIBLE 2('JPG','GIF','PNG')</h1></center>";
    }*/




if(isset($_FILES['files']))
{


  




    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {

        $obj5=new archivoincendio();

        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];

        $ext=pathinfo($file_name,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)) {
            if(!file_exists("../vista/recursos/images/incendios/".$file_name)) {
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../vista/recursos/images/incendios/".$file_name);
                $obj5->setArchivo($file_name);
            }


            else {
                $filename=basename($file_name,$ext);
                $newFileName=$filename.time().".".$ext;
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../vista/recursos/images/incendios/".$newFileName);
                $obj5->setArchivo($newFileName);
            }

            $dat5=new daoarchivoincendio();
        $dat5->ingresararchivoincendio($obj5);


        }
        else {
            array_push($error,"$file_name, ");
        }
    }

}


// File upload configuration 

          
        


/*foreach ($_FILES['files']['name'] as $key => $value) {
  $rand=rand('111111111','999999999');
  $file=$rand.'_'.$val;
  move_uploaded_file($_FILES['files']['tmp_name'][$key],'../uploads/'.$val);
}*/



      
    }

    

    /*//PRIMER INSERT QUE CORRESPONDE A CONIFERAS
    $obj3->setIdtipovegetacion(1);
    $obj3->setAreraprotegida($_POST["txt/1"]);
    $obj3->setZonaamortiguamiento($_POST["txt/1/2"]);
    $dat3=new daoreltipovegetacion();
    $dat3->ingresarreltipoveg($obj3);

    //SEGUNDO INSERT QUE CORRESPONDE A BOSQUE TROPICAL
    $obj3->setIdtipovegetacion(2);
    $obj3->setAreraprotegida($_POST["txt/2"]);
    $obj3->setZonaamortiguamiento($_POST["txt/2/2"]);
    $dat3=new daoreltipovegetacion();
    $dat3->ingresarreltipoveg($obj3);*/
    
    

	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daoincendio();
		$dat->suspender(suspenderincendio());
	}

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcb());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb2'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcb2());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb3'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcb3());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb4'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcb4());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb5'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcb5());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcbfechaincendio'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcbfechaincendio());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcheckbox'){
    $dat=new daoincendio();
    echo json_encode($dat->consultarcheckbox());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcheckboxModifica'){
    $dat=new daoincendio();
    $id= $_REQUEST['IdIncendio'];
    echo json_encode($dat->consultarcheckboxModifica($id));
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultartablavegetacion'){
    $dat=new daoincendio();
    echo json_encode($dat->consultartablavegetacion());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultartablavegetacionModifica'){
    $dat=new daoincendio();
    $id= $_REQUEST['IdIncendio'];
    echo json_encode($dat->consultartablavegetacionModifica($id));
  }


  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultartablaextinsion'){
    $dat=new daoincendio();
    echo json_encode($dat->consultartablaextinsion());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultartablamedioextincion'){
    $dat=new daoincendio();
    $id= $_REQUEST['IdIncendio'];
    echo json_encode($dat->consultartablamedioextincion($id));
  }


  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultararchivomodifica'){
    $dat=new daoincendio();
    $id= $_REQUEST['IdIncendio'];
    echo json_encode($dat->consultararchivomodifica($id));
  }


	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){

    $obj=new incendio();
    $obj->setIdIncendio($_POST["txtid2"]);
    $obj->setIdareanaturalprotegida($_POST["tpareanatural"]);
    $obj->setIdequipotec($_POST["tpequipotecnico"]);
    $obj->setFechaavisoincendio($_POST["txtfechaaviso"]);
    $obj->setFechaincendio($_POST["txtfechainicio"]);
    $obj->setFechafinalizacion($_POST["txtfechafin"]);
    $obj->setIdformarecepcion($_POST["tpformaaviso"]);
    $obj->setRutaacceso($_POST["txtubicacionacceso"]);
    $obj->setIdtopografia($_POST["tptopografia"]);
    $obj->setIdtenenciapropiedad($_POST["tptenenciapropiedad"]);
    if($_POST["txtvelocidadpropagacion"]==null){
       $obj->setVelocidadpropagacion(0);
    }else{
      $obj->setVelocidadpropagacion($_POST["txtvelocidadpropagacion"]);
    }
    $obj->setComentarios($_POST["txtcomentarios"]);
    
    //SI NO INGRESA PUNTO EN EL MAPA GEOPOSISCION SERA VACIO    
    if($_POST["txtlongitud"]==null || $_POST["txtlatitud"]==null ){
      $obj->setGeoposicion("");
    }else{
      $obj->setGeoposicion($_POST["txtlatitud"].",".$_POST["txtlongitud"]);
    }

    if($_POST["txtcoordenadas"]!=null){
      $explo = explode(",", $_POST["txtcoordenadas"]);
      if($explo[0]!=$explo[2]){
        //SIGNIFICA QUE EL POLIGONO TIENE COORDENADAS IGUALES, ES DECIR DIBUJO UN PUNTO COMO POLIGONO Y NO SE MOSTRARA EN EL MAPA
        $obj->setCoordenadas($_POST["txtcoordenadas"]);
      }
    }
    //$obj->setCoordenadas($_POST["txtcoordenadas"]);

    $dat = new daoincendio();
    $dat->modificar($obj);

  //INGRESANDO DATOS A TABLA RELCAUSAINCENDIO
  if(!empty($_POST["checkboxca"]))
    {
      
      $obj2=new relcausaincendio();
      $obj2->setIdincendio($_POST["txtid2"]);
      $dat2=new daorelcausaincendio();
      //LIMPIO LOS REGISTROS Y HAGO UN NUEVO INSERTAR PARA EL IDINCENDIO
      $dat2->limpiandorelcausaincendio($obj2);
      

      foreach($_POST['checkboxca'] as $selected){
        
        $obj2->setIdcausaincendio($selected);
        //INSERTO LAS MODIFICACIONES
        $dat2->modificarrelcausaincendio($obj2);

      }
      
    }else{
      //SI NO SELECCIONA UN CHECKBOS LIMPIA TODO
      $obj2=new relcausaincendio();
      $obj2->setIdincendio($_POST["txtid2"]);
      $dat2=new daorelcausaincendio();
      $dat2->limpiandorelcausaincendio($obj2);
    }

    //MODIFICANDO DATOS A TABLA RELTIPOVEGE
    $obj3=new reltipovegetacion();
    $num=$_POST["txtnum"];
    for ($i=1; $i <= $num; $i++) { 


        $obj3->setIdreltipovegeincendioforestal($_POST["txtidreltipovege"][$i]);

        $obj3->setIdtipovegetacion($_POST["txtidtipovege"][$i]);
        if($_POST["txttipovegareaprot"][$i]!=null){
          $obj3->setAreraprotegida($_POST["txttipovegareaprot"][$i]);
        }else if(($_POST["txttipovegareaprot"][$i]==null)){
          $obj3->setAreraprotegida(0.00);
        }

        if($_POST["txttipovegzonaamort"][$i]!=null){
          $obj3->setZonaamortiguamiento($_POST["txttipovegzonaamort"][$i]);
        }else if(($_POST["txttipovegzonaamort"][$i]==null)){
          $obj3->setZonaamortiguamiento(0.00);
        }
        $dat3=new daoreltipovegetacion();
        $dat3->modificarreltipoveg($obj3);
    }


    //INGRESANDO DATOS A TABLA RELMEDIOEXT
    $obj4=new relmedioextincion();
    $num2=$_POST["txtnum2"];
    for ($i=1; $i <= $num2; $i++) { 

        $obj4->setIdrelmedioextincendioforestal($_POST["txtidrelmedioext"][$i]);
        $obj4->setIdmedioextincion($_POST["txtidmedioext"][$i]);
        if($_POST["txtmedioextcant"][$i]!=null){
          $obj4->setCantidad($_POST["txtmedioextcant"][$i]);
        }else if(($_POST["txtmedioextcant"][$i]==null)){
          $obj4->setCantidad(0);
        }

        $dat4=new daorelmedioextincion();
        $dat4->modificarmedioextincion($obj4);
    }

	}


	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		$dat = new daoincendio();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){

         $IdIncendio="'".str_replace('"', "",$c["IdIncendio"])."'";
         $IdAreaNaturalProtegida ="'".str_replace('"', "",$c["IdAreaNaturalProtegida"])."'";
         $IdEquipoTec ="'".str_replace('"', "",$c["IdEquipoTec"])."'";
         $FechaIncendio="'".str_replace('"', "",$c["FechaIncendio"])."'";
         $FechaAvisoIncendio ="'".str_replace('"', "",$c["FechaAvisoIncendio"])."'";
         $FechaFinalizacion ="'".str_replace('"', "",$c["FechaFinalizacion"])."'";  
         $IdFormaRecepcion ="'".str_replace('"', "",$c["IdFormaRecepcion"])."'";
         $RutaAcceso ="'".str_replace('"', "",$c["RutaAcceso"])."'";
         //MUESTRE O NO MUESTRE LOS DATOS AQUI DEBE DE HACERCE EL STR_REPLACE NO EN LA TABLA
         $IdTopografia="'".$c["IdTopografia"]."'";
         $IdTenenciaPropiedad="'".$c["IdTenenciaPropiedad"]."'";


         $hectareasanp="'".$c["hectareasanp"]."'";
         $hectareasafueraanp="'".$c["hectareasafueraanp"]."'";


         $VelocidadPropagacion="'".$c["VelocidadPropagacion"]."'";
         $Comentarios="'".$c["Comentarios"]."'";
         $Geoposicion="'".$c["Geoposicion"]."'";
         $AreaNaturalProtegidaNombre="'".$c["AreaNaturalProtegida"]."'";
         
         
         $IdInicioFuego="'".$c["IdInicioFuego"]."'";
         $UsuarioCreacion="'".$c["UsuarioCreacion"]."'";
         $estado="'".$c["EstatusIncendio"]."'";
         $coordenadas="'".$c["coordenadas"]."'";



        //CAMBIAR PARAMETROS DE EDITAR
         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalincendio2\"';
         $editar.='onclick=\"llenarCajas('.$IdIncendio.','.$IdAreaNaturalProtegida.','.$IdEquipoTec.','.$FechaAvisoIncendio.','.$FechaIncendio.','.$FechaFinalizacion.','.$IdFormaRecepcion.','.$RutaAcceso.','.$IdTopografia.','.$IdTenenciaPropiedad.','.$VelocidadPropagacion.','.$Comentarios.','.$Geoposicion.','.$coordenadas.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';


         $imagen='&nbsp;<a height=\"40\" class=\"btn btn-warning btn-sm\" data-toggle=\"modal\" data-target=\"#modalimagenes\"';
         $imagen.='onclick=\"consultarImagenes('.$IdIncendio.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-image\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';

         if($c["EstatusIncendio"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\"  onclick=\"suspender('.$IdIncendio.',0,'.$AreaNaturalProtegidaNombre.');\"><i class=\"fa fa-toggle-on\" style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["EstatusIncendio"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\"  onclick=\"suspender('.$IdIncendio.',1,'.$AreaNaturalProtegidaNombre.');\"><i class=\"fa fa-toggle-off\"  style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';
         }

         $tabla.='{
                  "acciones":"'.$editar.$suspender.$imagen.'",
                  "IdIncendio":"'.str_replace('"', "",$c["IdIncendio"]).'",
                  "AreaNaturalProtegida":"'.str_replace('"', "",$c["AreaNaturalProtegida"]).'",
                  "FechaIncendio":"'.str_replace('"', "",$c["FechaIncendio"]).'",
                  "hectareasanp":"'.str_replace('"', "",number_format($c["hectareasanp"], 2)).'",
                  "hectareasafueraanp":"'.str_replace('"', "",number_format($c["hectareasafueraanp"], 2)).'",
                  "VelocidadPropagacion":"'.str_replace('"', "",$c["VelocidadPropagacion"]).'",
                  "Topografia":"'.str_replace('"', "",$c["Topografia"]).'",
                  "Tenencia":"'.str_replace('"', "",$c["Tenencia"]).'",
                  "IdInicioFuego":"'.str_replace('"', "",$c["IdInicioFuego"]).'",
                  "nombre":"'.str_replace('"', "",$c["nombre"]).'"

                  
                },';
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
	}


















$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarinformecantincendio'){
    $dat = new daoincendio();

        $fechaini=$_REQUEST["txtfechainicio"];
          $fechafin=$_REQUEST["txtfechafin"];
         $r=$dat->consultarinformecantincendio($fechaini,$fechafin);
         $tabla="";
         foreach($r as $c){

         //$IdIncendio="'".str_replace('"', "",$c["IdIncendio"])."'";

         $numIncendiosANP="'".str_replace('"', "",$c["numIncendiosANP"])."'";

         $cantHaAfectadas="'".str_replace('"', "",$c["cantHaAfectadas"])."'";

         //$AreaNaturalProtegidaNombre="'".str_replace('"', "",$c["AreaNaturalProtegida"])."'";
         



         $tabla.='{

                  "AreaNaturalProtegida":"'.str_replace('"', "",$c["AreaNaturalProtegida"]).'",
                  "cantHaAfectadas":"'.str_replace('"', "",number_format($c["cantHaAfectadas"], 2)).'",
                  "numIncendiosANP":"'.str_replace('"', "",$c["numIncendiosANP"]).'"

                  
                },';
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
  }


$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarinformecantincendiomensual'){
    $dat = new daoincendio();

        $fechaini=$_REQUEST["txtfechainicio"];
          $fechafin=$_REQUEST["txtfechafin"];
         $r=$dat->consultarinformecantincendiomensual($fechaini,$fechafin);
         $tabla="";
         foreach($r as $c){

         //$IdIncendio="'".str_replace('"', "",$c["IdIncendio"])."'";

         //NOMBRE DEL MES
         $nombre="'".str_replace('"', "",$c["nombre"])."'";

         $numIncendiosANP="'".str_replace('"', "",$c["numIncendiosANP"])."'";

         $cantHaAfectadas="'".str_replace('"', "",$c["cantHaAfectadas"])."'";

         //$AreaNaturalProtegidaNombre="'".str_replace('"', "",$c["AreaNaturalProtegida"])."'";
         



         $tabla.='{
                  "nombre":"'.str_replace('"', "",$c["nombre"]).'",
                  "AreaNaturalProtegida":"'.str_replace('"', "",$c["AreaNaturalProtegida"]).'",
                  "cantHaAfectadas":"'.str_replace('"', "",number_format($c["cantHaAfectadas"], 2)).'",
                  "numIncendiosANP":"'.str_replace('"', "",$c["numIncendiosANP"]).'"

                  
                },';
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
  }



$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarinformecausaincendio'){
    $dat = new daoincendio();
          $fechaini=$_REQUEST["txtfechainicio"];
          $fechafin=$_REQUEST["txtfechafin"];
          //agarrando parametro de fechas
         $r=$dat->consultarinformecausaincendio($fechaini,$fechafin);
         $tabla="";
         foreach($r as $c){

         //$IdIncendio="'".str_replace('"', "",$c["IdIncendio"])."'";

         $CausaIncendio="'".str_replace('"', "",$c["CausaIncendio"])."'";

         $cantidad="'".str_replace('"', "",$c["cantidad"])."'";

         //$AreaNaturalProtegidaNombre="'".str_replace('"', "",$c["AreaNaturalProtegida"])."'";
         



         $tabla.='{

                  "CausaIncendio":"'.str_replace('"', "",$c["CausaIncendio"]).'",
                  "cantidad":"'.str_replace('"', "",$c["cantidad"]).'"

                  
                },';
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
  }


















  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarpoints'){
     $dat = new daoincendio();
         $r=$dat->consultarpoints();

         $geojson = array(
             'type'      => 'FeatureCollection',
             'features'  => array()
          );
         
         foreach($r as $c){
          $geoposicion=explode(",",$c['Geoposicion']);
          $longitud=$geoposicion[1];
          $latitud=$geoposicion[0];


      $feature = array(
        'type' => 'Feature', 

        # Pass other attribute columns here
        'properties' => array(
            'codigo' => ($c['codigo']),
            'fecha' => ($c['fecha']),
            'Geoposicion' => $c['Geoposicion'],
            'AreaNaturalProtegida' =>($c['AreaNaturalProtegida']),
            'FechaFinalizacion' =>($c['FechaFinalizacion']),
            'hectareasanp' =>($c['hectareasanp']),
            'hectareasafueraanp' =>($c['hectareasafueraanp'])       
            ),
        'geometry' => array(
            'type' => 'Point',
            # Pass Longitude and Latitude Columns here
            'coordinates' => [$longitud,$latitud],
          'id' => $c['codigo'])
        );
    # Add feature arrays to feature collection array
     array_push($geojson['features'], $feature);
         }   
         echo json_encode($geojson);

  }




  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarpointscoordenadas'){
      $dat = new daoincendio();
         $r=$dat->consultarpointscoordenadas();

         $geojson = array(
             'type'      => 'FeatureCollection',
             'features'  => array()
          );
         $cont=0;
         foreach($r as $c){
          $puntos= array();
          //SPLIT DE COORDENADAS
          $arregloCoordenadas=explode(",", $c['coordenadas']);


          $acu=0;
          for ($i = 0; $i < (count($arregloCoordenadas))/2; $i++) {
            //DENTRO DEL FOR HAGO MULTIDIMENSIONAL EL PRIMER ESPACIO DEL ARRAY

            //puntos[(i)]= new Array(2);
            $puntos[($i)]= [[]];

            for ($j = 0; $j < 2; $j++) {
              //HAGO UN ACUMULADOR PARA QUE SUME CADA QUE ENTRA AL SEGUNDO FOR PARA RECORRER EL ARREGLO COORDENADAS COMPLETO
              if ($j==1) {
                $acu++;
              }
              $puntos[$i][$j]= $arregloCoordenadas[($i+$acu)];

            }         
          }

          $feature = array(
        'type' => 'Feature', 

        # Pass other attribute columns here
        'properties' => array(
            'codigo' =>($c['codigo']),
            'fecha' =>($c['fecha']),
            'Geoposicion' => $c['Geoposicion'],
            'AreaNaturalProtegida' =>($c['AreaNaturalProtegida']),
            'FechaFinalizacion' =>($c['FechaFinalizacion']),
            'hectareasanp' =>($c['hectareasanp']),
            'hectareasafueraanp' =>($c['hectareasafueraanp'])   
            ),
        'geometry' => array(
            'type' => 'Polygon',
            # Pass Longitude and Latitude Columns here
            'coordinates' => [$puntos],
          'id' => $c['codigo'])
        );
    # Add feature arrays to feature collection array
     array_push($geojson['features'], $feature);
         }   
         echo json_encode($geojson);

  }


?>