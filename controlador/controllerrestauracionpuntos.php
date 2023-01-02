<?php
require_once "../modelo/daorestauracionpuntos.php";
require_once "../modelo/daoarchivorestauracion.php";

function crearrestauracionpuntos(){
	$obj=new restauracionpuntos();
	$obj->setIdperiodo($_POST["tpperiodo"]);
	//$obj->setTecnica($_POST["txttecnica"]);
  if($_POST["txtlongitud"]==null){
    $obj->setLongitud(0);
  }else{
    $obj->setLongitud($_POST["txtlongitud"]);
  }
  if($_POST["txtlatitud"]==null){
    $obj->setLatitud(0);
  }else{
    $obj->setLatitud($_POST["txtlatitud"]);
  }
	
  if($_POST["txtcoordenadas"]!=null){
    $explo = explode(",", $_POST["txtcoordenadas"]);
    if($explo[0]!=$explo[2]){
      //SIGNIFICA QUE EL POLIGONO TIENE COORDENADAS IGUALES
      $obj->setCoordenadas($_POST["txtcoordenadas"]);
    }
  }
  
  $obj->setArea($_POST["txtarea"]);
  //$obj->setArboles($_POST["txtarboles"]);
  $obj->setMunicipio($_POST["tpmunicipio"]);
  $obj->setCanton($_POST["txtcanton"]);
  $obj->setUbicacion($_POST["txtubicacion"]);
  $obj->setBeneficiarios($_POST["txtbeneficiarios"]);
  $obj->setInstituciones($_POST["txtinstituciones"]);
  $obj->setEspecie($_REQUEST["txtlistaespecie"]);
  $obj->setCantidadpersonas($_POST["txtcantidadpersonas"]);
  $obj->setComentarios($_POST["txtcomentarios"]);
  $obj->setIdTecnicas($_POST["tptecnica"]);
  //$obj->setCoordenadas($_POST["txtcoordenadas"]);

  return $obj;
}
function suspenderrestauracionpuntos(){
	$obj=new restauracionpuntos();
	$obj->setIdrestauracion($_POST["id"]);
  $obj->setEstado($_POST["estado"]);
	return $obj;
}


function modificarrestauracionpuntos(){
	$obj=new restauracionpuntos();
  $obj->setIdrestauracion($_POST["txtid2"]);
  $obj->setIdperiodo($_POST["tpperiodo2"]);
  //$obj->setTecnica($_POST["txttecnica2"]);
  if($_POST["txtlongitud2"]==null){
    $obj->setLongitud(0);
  }else{
    $obj->setLongitud($_POST["txtlongitud2"]);
  }
  if($_POST["txtlatitud2"]==null){
    $obj->setLatitud(0);
  }else{
    $obj->setLatitud($_POST["txtlatitud2"]);
  }

  if($_POST["txtcoordenadas2"]!=null){
    $explo = explode(",", $_POST["txtcoordenadas2"]);
    if($explo[0]!=$explo[2]){
      //SIGNIFICA QUE EL POLIGONO TIENE COORDENADAS IGUALES
      $obj->setCoordenadas($_POST["txtcoordenadas2"]);
    }
  }
  $obj->setArea($_POST["txtarea2"]);
  //$obj->setArboles($_POST["txtarboles2"]);
  $obj->setMunicipio($_POST["tpmunicipio2"]);
  $obj->setCanton($_POST["txtcanton2"]);
  $obj->setUbicacion($_POST["txtubicacion2"]);
  $obj->setBeneficiarios($_POST["txtbeneficiarios2"]);
  $obj->setInstituciones($_POST["txtinstituciones2"]);
  $obj->setEspecie($_REQUEST["txtlistaespecie"]);
  $obj->setCantidadpersonas($_POST["txtcantidadpersonas2"]);
  $obj->setComentarios($_POST["txtcomentarios2"]);
  $obj->setIdTecnicas($_POST["tptecnica2"]);
  //$obj->setCoordenadas($_POST["txtcoordenadas2"]);

  return $obj;
}

//SIGNIFICA QUE UN USUARIO ETERNO MODIFICA UN REGISTRO RECHAZADO
function modificarrestauracionusuarioexterno(){
  $obj=new restauracionpuntos();
  $obj->setIdrestauracion($_POST["txtid3"]);
  $obj->setIdperiodo($_POST["tpperiodo3"]);
  //$obj->setTecnica($_POST["txttecnica2"]);
  if($_POST["txtlongitud3"]==null){
    $obj->setLongitud(0);
  }else{
    $obj->setLongitud($_POST["txtlongitud3"]);
  }
  if($_POST["txtlatitud3"]==null){
    $obj->setLatitud(0);
  }else{
    $obj->setLatitud($_POST["txtlatitud3"]);
  }
  $obj->setArea($_POST["txtarea3"]);
  //$obj->setArboles($_POST["txtarboles2"]);
  $obj->setMunicipio($_POST["tpmunicipio3"]);
  $obj->setCanton($_POST["txtcanton3"]);
  $obj->setUbicacion($_POST["txtubicacion3"]);
  $obj->setBeneficiarios($_POST["txtbeneficiarios3"]);
  $obj->setInstituciones($_POST["txtinstituciones3"]);
  $obj->setEspecie($_REQUEST["txtlistaespecie"]);
  $obj->setCantidadpersonas($_POST["txtcantidadpersonas3"]);
  $obj->setComentarios($_POST["txtcomentarios3"]);
  $obj->setIdTecnicas($_POST["tptecnica3"]);
  $obj->setCoordenadas($_POST["txtcoordenadas3"]);

  return $obj;
}


	$page = isset($_GET['btnguardar'])?$_GET['btnguardar']:'';
	if($page=='guardar'){
		$dat=new daorestauracionpuntos();
		$dat->ingresar(crearrestauracionpuntos());

    if(isset($_FILES['files']))
    {


        $error=array();
        $extension=array("jpeg","jpg","png","gif");
        foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {

            $obj5=new archivorestauracion();

            $file_name=$_FILES["files"]["name"][$key];
            $file_tmp=$_FILES["files"]["tmp_name"][$key];

            $ext=pathinfo($file_name,PATHINFO_EXTENSION);

            if(in_array($ext,$extension)) {
                if(!file_exists("../vista/recursos/images/restauracion/".$file_name)) {
                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../vista/recursos/images/restauracion/".$file_name);
                    $obj5->setArchivo($file_name);
                }


                else {
                    $filename=basename($file_name,$ext);
                    $newFileName=$filename.time().".".$ext;
                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../vista/recursos/images/restauracion/".$newFileName);
                    $obj5->setArchivo($newFileName);
                }

                $dat5=new daoarchivorestauracion();
            $dat5->ingresararchivorestauracion($obj5);


            }
            else {
                array_push($error,"$file_name, ");
            }
        }

    }





	}

  //CONSULTA SI EL REGISTRO YA FUE PROCESADO POR OTRO USUARIO
  $page = isset($_GET['btnconsultarestado'])?$_GET['btnconsultarestado']:'';
  if($page=='consultarestado'){
    $dat=new daorestauracionpuntos();
    $id_restauracion=$_POST["id"];
    $r=$dat->consultarestado($id_restauracion);
    foreach($r as $c){
      $estado="".$c["estado"]."";
      echo $estado;
    }
    

  }


	$page = isset($_GET['btnsuspender'])?$_GET['btnsuspender']:'';
	if($page=='suspender'){
		$dat=new daorestauracionpuntos();
		$dat->suspender(suspenderrestauracionpuntos());
	}

	/*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultarcb'){
		$dat=new daousuarioexterno();
		echo json_encode($dat->consultarcb());
	}*/
  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb'){
    $dat=new daorestauracionpuntos();
    echo json_encode($dat->consultarcb());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb2'){
    $dat=new daorestauracionpuntos();
    echo json_encode($dat->consultarcb2());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb3'){
    $dat=new daorestauracionpuntos();
    echo json_encode($dat->consultarcb3());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcbespecie'){
    $dat=new daorestauracionpuntos();
    echo json_encode($dat->consultarcbespecie());
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcbtecnica'){
    $dat=new daorestauracionpuntos();
    echo json_encode($dat->consultarcbtecnica());
  }

  $page = isset($_GET['btnModificar'])?$_GET['btnModificar']:'';
  if($page=='modificandoImagen'){
    $obj=new archivorestauracion();
    $obj->setIdarchivo($_REQUEST["id_imagen"]);
    $obj->setIdrestauracion($_REQUEST["id_restauracion"]);


    $obj2=new daoarchivorestauracion();
    $obj2->eliminandoarchivorestauracion($obj);
  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultararchivomodifica'){
    $dat=new daorestauracionpuntos();
    $id= $_REQUEST['id_restauracion'];
    echo json_encode($dat->consultararchivomodifica($id));
  }


  /*$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarcb2'){
    $dat=new restauracionpuntos();
    echo json_encode($dat->consultarcb2());
  }*/



	$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
	if($page=='modificar'){
		$dat = new daorestauracionpuntos();
          $dat->modificar(modificarrestauracionpuntos());
	}

//SIGNIFICA QUE UN USUARIO ETERNO MODIFICA UN REGISTRO RECHAZADO
$page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
  if($page=='modificarrestauracionusuarioexterno'){
    $dat = new daorestauracionpuntos();
          $dat->modificar(modificarrestauracionusuarioexterno());
  }


  $page = isset($_GET['btnConsultar'])?$_GET['btnConsultar']:'';
    if($page=='consultarcaja'){
        $dat=new daorestauracionpuntos();
        echo json_encode($dat->consultarcaja());
    }


  $page = isset($_GET['btnmodificar'])?$_GET['btnmodificar']:'';
  if($page=='modificandoagregarImagen'){

    if(isset($_FILES['files']))
    {
      

        $error=array();
        $extension=array("jpeg","jpg","png","gif");

        $obj5=new archivorestauracion();
        $obj5->setIdrestauracion($_POST["id_restauracion"]);

        $file_name=$_FILES["files"]["name"];
        $file_tmp=$_FILES["files"]["tmp_name"];

        if($file_name==null || $file_tmp=$_FILES["files"]["tmp_name"]==null)
        {
          echo "-2";
          //NO AGREGO NINGUNA IMAGEN

        }else{
          $ext=pathinfo($file_name,PATHINFO_EXTENSION);

          if(in_array($ext,$extension)) {
              if(!file_exists("../vista/recursos/images/restauracion/".$file_name)) {
                  move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"],"../vista/recursos/images/restauracion/".$file_name);
                  $obj5->setArchivo($file_name);
              }


              else {
                  $filename=basename($file_name,$ext);
                  $newFileName=$filename.time().".".$ext;
                  move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"],"../vista/recursos/images/restauracion/".$newFileName);
                  $obj5->setArchivo($newFileName);
              }

              $dat5=new daoarchivorestauracion();
              $dat5->ingresararchivorestauracionmodifica($obj5);


              }
              else {
                  array_push($error,"$file_name, ");
              }
        }


      }
    }


	$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
	if($page=='consultar'){
		$dat = new daorestauracionpuntos();
         $r=$dat->consultar();
         $tabla="";
         foreach($r as $c){

         $id_restauracion="'".$c["id_restauracion"]."'";
         $idperiodo="'".str_replace('"', "",$c["id_periodo"])."'";
         $idtecnicas="'".str_replace('"', "",$c["idtecnicas"])."'";
         $longitud="'".str_replace('"', "",$c["longitud"])."'";
         $latitud="'".str_replace('"', "",$c["latitud"])."'";
         $area="'".str_replace('"', "",$c["area"])."'";
         
         //$arboles="'".$c["arboles"]."'";
         $Municipio="'".str_replace('"', "",$c["Municipio"])."'";
         $Canton="'".str_replace('"', "",$c["Canton"])."'";
         $Ubicacion="'".str_replace('"', "",$c["Ubicacion"])."'";
         $Beneficiarios="'".str_replace('"', "",$c["Beneficiarios"])."'";
         $Instituciones="'".str_replace('"', "",$c["Instituciones"])."'";
         $especies="'".str_replace('"', "",$c["especies"])."'";
         $cantidadpersonas="'".str_replace('"', "",$c["cantidadpersonas"])."'";
         $comentarios="'".str_replace('"', "",$c["comentarios"])."'";
         $coordenadas="'".str_replace('"', "",$c["coordenadas"])."'";
         $date = date_create($c["fecha"]);
         $fecha=date_format($date, 'd-m-Y');
         $estado="'".$c["estado"]."'";

         if(str_replace('"', "",$c["banderausuario"])==2){
            $user="Externo: ".$c["nombreexterno"]." ".$c["apellidoexterno"];
         }else{
          //SI ENTRA AQUI INSERTO EL REGISTRO UN USUARIO INTERNO
            $user="Interno: ".$c["nombreinterno"]." ".$c["apellidointerno"];
         }
         //$user=$c["banderausuario"];
       
         //SIRVE PARA VER SI ES POLIGONO O PUNTO
         if($c["latitud"]==0 && $c["longitud"]==0){
          $tipo="Poligono";
         }else{
          $tipo="Punto";
         }
         

         $nombretecnica="'".$c["Tecnica"]."'";

        //CAMBIAR PARAMETROS DE EDITAR
         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalrestauracionpuntos2\"';
         $editar.='onclick=\"llenarCajas('.$id_restauracion.','.$idperiodo.','.$idtecnicas.','.$Municipio.','.$Canton.','.$Ubicacion.','.$Beneficiarios.','.$Instituciones.','.$especies.','.$cantidadpersonas.','.$comentarios.','.$area.','.$coordenadas.','.$longitud.','.$latitud.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';
         $imagen='&nbsp;<a height=\"40\" class=\"btn btn-warning btn-sm\" data-toggle=\"modal\" data-target=\"#modalimagenes\"';
         $imagen.='onclick=\"consultarImagenes('.$id_restauracion.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-image\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';

         if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\"  onclick=\"suspender('.$id_restauracion.',0,'.$nombretecnica.');\"><i class=\"fa fa-toggle-on\" style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';
         }
         else if($c["estado"]==0)
         {
          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\"  onclick=\"suspender('.$id_restauracion.',1,'.$nombretecnica.');\"><i class=\"fa fa-toggle-off\"  style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';
         }

         $tabla.='{
                  "acciones":"'.$editar.$suspender.$imagen.'",
                  "fecha":"'.$fecha.'",
                  "id_restauracion":"'.str_replace('"', "",$c["id_restauracion"]).'",
                  "periodo":"'.str_replace('"', "",$c["ano"]).'",
                  "Tecnica":"'.str_replace('"', "",$c["Tecnica"]).'",
                  "Tipo":"'.$tipo.'",
                  "user":"'.str_replace('"', "",$user).'",
                  "Municipio":"'.str_replace('"', "",$c["Municipio"]).'",
                  "Canton":"'.str_replace('"', "",$c["Canton"]).'",
                  "Ubicacion":"'.str_replace('"', "",$c["Ubicacion"]).'"
                },';

               /* ,
                  "Beneficiarios":"'.str_replace('"', "",$c["Beneficiarios"]).'",
                  "Instituciones":"'.str_replace('"', "",$c["Instituciones"]).'",
                  "cantidadpersonas":"'.str_replace('"', "",$c["cantidadpersonas"]).'",
                  "comentarios":"'.str_replace('"', "",$c["comentarios"]).'"*/
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
	}


//METODO PARA EL JSAPROBACIONRESTAURACION
$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultaraprobacion'){
    $dat = new daorestauracionpuntos();
         $r=$dat->consultaraprobacion();
         $tabla="";
         foreach($r as $c){

         $id_restauracion="'".$c["id_restauracion"]."'";
         $idperiodo="'".str_replace('"', "",$c["id_periodo"])."'";
         $idtecnicas="'".str_replace('"', "",$c["idtecnicas"])."'";
         $longitud="'".str_replace('"', "",$c["longitud"])."'";
         $latitud="'".str_replace('"', "",$c["latitud"])."'";
         $area="'".str_replace('"', "",$c["area"])."'";
         
         //$arboles="'".$c["arboles"]."'";
         $Municipio="'".str_replace('"', "",$c["Municipio"])."'";
         $Canton="'".str_replace('"', "",$c["Canton"])."'";
         $Ubicacion="'".str_replace('"', "",$c["Ubicacion"])."'";
         $Beneficiarios="'".str_replace('"', "",$c["Beneficiarios"])."'";
         $Instituciones="'".str_replace('"', "",$c["Instituciones"])."'";
         $especies="'".str_replace('"', "",$c["especies"])."'";
         $cantidadpersonas="'".str_replace('"', "",$c["cantidadpersonas"])."'";
         $comentarios="'".str_replace('"', "",$c["comentarios"])."'";
         $coordenadas="'".str_replace('"', "",$c["coordenadas"])."'";
         $date = date_create($c["fecha"]);
         $fecha=date_format($date, 'd-m-Y');
         $estado="'".$c["estado"]."'";

         if(str_replace('"', "",$c["banderausuario"])==2){
            $user=$c["nombreexterno"]." ".$c["apellidoexterno"];
            $nombreexterno="'".$c["nombreexterno"]."'";
            $apellidoexterno="'".$c["apellidoexterno"]."'";
            $correo="'".$c["correo"]."'";
         }else{
          //SI ENTRA AQUI INSERTO EL REGISTRO UN USUARIO INTERNO
            $user="Interno: ".$c["nombreinterno"]." ".$c["apellidointerno"];
         }
         //$user=$c["banderausuario"];
       
         //SIRVE PARA VER SI ES POLIGONO O PUNTO
         if($c["latitud"]==0 && $c["longitud"]==0){
          $tipo="Poligono";
         }else{
          $tipo="Punto";
         }
         

         $nombretecnica="'".$c["Tecnica"]."'";

        //CAMBIAR PARAMETROS DE EDITAR
         $editar='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalrestauracionpuntos2\"';
         $editar.='onclick=\"llenarCajas('.$id_restauracion.','.$idperiodo.','.$idtecnicas.','.$Municipio.','.$Canton.','.$Ubicacion.','.$Beneficiarios.','.$Instituciones.','.$especies.','.$cantidadpersonas.','.$comentarios.','.$area.','.$coordenadas.','.$longitud.','.$latitud.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';
         $imagen='&nbsp;<a height=\"40\" class=\"btn btn-warning btn-sm\" data-toggle=\"modal\" data-target=\"#modalimagenes\"';
         $imagen.='onclick=\"consultarImagenes('.$id_restauracion.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-image\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';

         /*if($c["estado"]==1){

          $suspender = '&nbsp;<a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\"  onclick=\"suspender('.$id_restauracion.',0,'.$nombretecnica.');\"><i class=\"fa fa-toggle-on\" style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';
         }
         else */

        //ESTADO 3 SIGNIFICA QUE NO ESTA APROBADO
        if($c["estado"]==3)
         {
          //SI SE APRUEBA EL ESTADO PASARA A SER 1
          $aprobar = '&nbsp;<br><a height=\"40\" class=\"btn btn-success btnsuspender btn-sm\"  onclick=\"aprobarregistro('.$id_restauracion.',1,'.$nombretecnica.','.$nombreexterno.','.$apellidoexterno.','.$correo.');\"><i class=\"fa fa-check-square-o\"  style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';

          //SI UN REGISTRO SE RECHAZA SU ESTADO SERA 2
          $rechazar = '&nbsp;<a height=\"40\" class=\"btn btn-danger btnsuspender btn-sm\"  onclick=\"rechazarregistro('.$id_restauracion.',2,'.$nombretecnica.','.$nombreexterno.','.$apellidoexterno.','.$correo.');\"><i class=\"fa fa-trash\"  style=\"font-size: 10px;\" aria-hidden=\"true\"></i></a>';
         }

         $tabla.='{
                  "acciones":"'.$editar.$imagen.$aprobar.$rechazar.'",
                  "fecha":"'.$fecha.'",
                  "id_restauracion":"'.str_replace('"', "",$c["id_restauracion"]).'",
                  "periodo":"'.str_replace('"', "",$c["ano"]).'",
                  "Tecnica":"'.str_replace('"', "",$c["Tecnica"]).'",
                  "Tipo":"'.$tipo.'",
                  "user":"'.str_replace('"', "",$user).'",
                  "Municipio":"'.str_replace('"', "",$c["Municipio"]).'",
                  "Canton":"'.str_replace('"', "",$c["Canton"]).'",
                  "Ubicacion":"'.str_replace('"', "",$c["Ubicacion"]).'"
                  
                },';

                //ANTES MOSTRABA ESTOS DATOS EN TABLA
                /*"Beneficiarios":"'.str_replace('"', "",$c["Beneficiarios"]).'",
                  "Instituciones":"'.str_replace('"', "",$c["Instituciones"]).'",
                  "cantidadpersonas":"'.str_replace('"', "",$c["cantidadpersonas"]).'",
                  "comentarios":"'.str_replace('"', "",$c["comentarios"]).'"*/
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
  }


  //METODO PARA EL JSDETALLEEXTERNO
$page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarregistroexterno'){
    $dat = new daorestauracionpuntos();
         //SABER EL ID DEL USUARIO PARA MOSTRAR LA TABLA CON LOS DATOS QUE EL HA INSERTADO
         $idusuario=$_SESSION['id'];
         $r=$dat->consultarregistroexterno($idusuario);
         $tabla="";
         foreach($r as $c){

         $id_restauracion="'".$c["id_restauracion"]."'";
         $idperiodo="'".str_replace('"', "",$c["id_periodo"])."'";
         $idtecnicas="'".str_replace('"', "",$c["idtecnicas"])."'";
         $longitud="'".str_replace('"', "",$c["longitud"])."'";
         $latitud="'".str_replace('"', "",$c["latitud"])."'";
         $area="'".str_replace('"', "",$c["area"])."'";
         
         //$arboles="'".$c["arboles"]."'";
         $Municipio="'".str_replace('"', "",$c["Municipio"])."'";
         $Canton="'".str_replace('"', "",$c["Canton"])."'";
         $Ubicacion="'".str_replace('"', "",$c["Ubicacion"])."'";
         $Beneficiarios="'".str_replace('"', "",$c["Beneficiarios"])."'";
         $Instituciones="'".str_replace('"', "",$c["Instituciones"])."'";
         $especies="'".str_replace('"', "",$c["especies"])."'";
         $cantidadpersonas="'".str_replace('"', "",$c["cantidadpersonas"])."'";
         $comentarios="'".str_replace('"', "",$c["comentarios"])."'";
         $coordenadas="'".str_replace('"', "",$c["coordenadas"])."'";
         $date = date_create($c["fecha"]);
         $fecha=date_format($date, 'd-m-Y');
         $estado="'".$c["estado"]."'";




         if($c["estado"]==3){
          $estadoaprobacion="<p style='color:#0000FF';><b>PENDIENTE</b></p>";

         }else if($c["estado"]==1){
          $estadoaprobacion="<p style='color:#32CD32';><b>APROBADO</b></p>";
         }else if($c["estado"]==0){
          $estadoaprobacion="<p style='color:#E5BE01';><b>SUSPENDIDO</b></p>";
         }else if($c["estado"]==2){
          $estadoaprobacion="<p style='color:#FF0000';><b>RECHAZADO</b></p>";
         }

         

         if(str_replace('"', "",$c["banderausuario"])==2){
            $user="Externo: ".$c["nombreexterno"]." ".$c["apellidoexterno"];
            $nombreexterno="'".$c["nombreexterno"]."'";
            $apellidoexterno="'".$c["apellidoexterno"]."'";
            $correo="'".$c["correo"]."'";
         }else{
          //SI ENTRA AQUI INSERTO EL REGISTRO UN USUARIO INTERNO
            $user="Interno: ".$c["nombreinterno"]." ".$c["apellidointerno"];
         }
         //$user=$c["banderausuario"];
       
         //SIRVE PARA VER SI ES POLIGONO O PUNTO
         if($c["latitud"]==0 && $c["longitud"]==0){
          $tipo="Poligono";
         }else{
          $tipo="Punto";
         }
         

         $nombretecnica="'".$c["Tecnica"]."'";


         if($c["estado"]==2){
            $informacion='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalrestauracionpuntos3\"';
            $informacion.='onclick=\"llenarCajas3('.$id_restauracion.','.$idperiodo.','.$idtecnicas.','.$Municipio.','.$Canton.','.$Ubicacion.','.$Beneficiarios.','.$Instituciones.','.$especies.','.$cantidadpersonas.','.$comentarios.','.$area.','.$coordenadas.','.$longitud.','.$latitud.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-pencil\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';

         }else{
            $informacion='<a height=\"40\" class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#modalrestauracionpuntos2\"';
            $informacion.='onclick=\"llenarCajas('.$id_restauracion.','.$idperiodo.','.$idtecnicas.','.$Municipio.','.$Canton.','.$Ubicacion.','.$Beneficiarios.','.$Instituciones.','.$especies.','.$cantidadpersonas.','.$comentarios.','.$area.','.$coordenadas.','.$longitud.','.$latitud.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-info-circle\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';
         }
        //CAMBIAR PARAMETROS DE EDITAR
         
         $imagen='&nbsp;<a height=\"40\" class=\"btn btn-warning btn-sm\" data-toggle=\"modal\" data-target=\"#modalimagenes\"';
         $imagen.='onclick=\"consultarImagenes('.$id_restauracion.');\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-image\" style=\"font-size: 10px;\" aria-hidden=\"true\"> </i></a>';


         $tabla.='{
                  "acciones":"'.$informacion.$imagen.'",
                  "estadoaprobacion":"'.$estadoaprobacion.'",
                  "fecha":"'.$fecha.'",
                  "id_restauracion":"'.str_replace('"', "",$c["id_restauracion"]).'",
                  "periodo":"'.str_replace('"', "",$c["ano"]).'",
                  "Tecnica":"'.str_replace('"', "",$c["Tecnica"]).'",
                  "Tipo":"'.$tipo.'",
                  "Municipio":"'.str_replace('"', "",$c["Municipio"]).'",
                  "Canton":"'.str_replace('"', "",$c["Canton"]).'",
                  "Ubicacion":"'.str_replace('"', "",$c["Ubicacion"]).'"
                },';

                
                  /*,"Beneficiarios":"'.str_replace('"', "",$c["Beneficiarios"]).'",
                  "Instituciones":"'.str_replace('"', "",$c["Instituciones"]).'",
                  "cantidadpersonas":"'.str_replace('"', "",$c["cantidadpersonas"]).'",
                  "comentarios":"'.str_replace('"', "",$c["comentarios"]).'"*/
          
     }
        $tabla = substr($tabla,0, strlen($tabla) - 1);
        echo '{"data":['.$tabla.']}';
  }



  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
  if($page=='consultarpoints'){
     $dat = new daorestauracionpuntos();
         $r=$dat->consultarpoints();

         $geojson = array(
             'type'      => 'FeatureCollection',
             'features'  => array()
          );
         
         foreach($r as $c){
          $feature = array(
        
        'type' => 'Feature', 

        # Pass other attribute columns here
        'properties' => array(
            'nombre' =>($c['nombre']),
            'descripcion' =>($c['descripcion']),
            'periodo' => $c['periodo'],
            'arboles' =>($c['arboles']),
            'municipio' =>($c['Municipio']),
            'canton' =>($c['Canton']),
            'instituciones' =>($c['Instituciones']),
            'beneficiarios' =>($c['Beneficiarios']),
            'longitud' => $c['longitud'],
            'latitud' => $c['latitud']
            ),
        'geometry' => array(
            'type' => 'Point',
            # Pass Longitude and Latitude Columns here
            'coordinates' => [$c['longitud'], $c['latitud']],
          'id' => $c['codigo'])
        );
    # Add feature arrays to feature collection array
     array_push($geojson['features'], $feature);
         }   
         echo json_encode($geojson);

  }

  $page = isset($_GET['btnconsultar'])?$_GET['btnconsultar']:'';
    if($page=='consultarpointscoordenadas'){
     $dat = new daorestauracionpuntos();
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
            'nombre' =>($c['nombre']),
            'descripcion' =>($c['descripcion']),
            'periodo' => $c['periodo'],
            'arboles' =>($c['arboles']),
            'municipio' =>($c['Municipio']),
            'canton' =>($c['Canton']),
            'instituciones' =>($c['Instituciones']),
            'beneficiarios' =>($c['Beneficiarios'])
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