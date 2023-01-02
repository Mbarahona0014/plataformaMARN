<?php 

  require_once "header.php"; 
  //SOLO USUARIO EXTERNO PUEDE VER ESTA LISTA
  //NO FUNCIONA
  if($_SESSION['idtipousuario']==1 || $_SESSION['idtipousuario']==3 || $_SESSION['idtipousuario']==4 || $_SESSION['idtipousuario']==5)
  {
    //session_destroy();
    echo "<script>window.location.href='vinicio.php'</script>";
    //header("location:index.php");
  }

  ?>


<link rel="stylesheet" href="recursos/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">


<!--CSS-->

<link rel="stylesheet" href="recursos/media/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="recursos/media/font-awesome/css/font-awesome.css">
<!--Javascript-->
<script src="recursos/media/js/jquery-1.10.2.js"></script>
<script src="recursos/media/js/bootstrap.js"></script>
<script type="text/javascript" src="recursos/js/jsmodelo/jsdetallepuntoexterno.js"></script>

<link rel="stylesheet" href="recursos/css/select2.css">
<script  type="text/javascript" src="recursos/js/select2.js"></script>


<script src="recursos/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="recursos/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="recursos/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>


<style type="text/css">
  #mapa {
              margin-left:15px;
              height: 450px;
              width: 97%;

            }
  #mapa3 {
              margin-left:15px;
              height: 450px;
              width: 97%;

            }
</style>

<div class="container-fluid">
    


      <!--AQUI IRA LA TABLA DE DATOS QUE IMPRIMIREMOS EN JS-->
      <h3><b>Registros de restauración ingresados</b></h3>
      <div class="row">
        <div class="col-md-12">
          <div class="container-fluid" style="background-color: white;">

            <br>
            <table id="example" class="table table-striped table-bordered table-hover"  width="100%" style=" ">
        <thead>
        <tr>
            <th>Detalles</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Código</th>
            <th>Período</th>
            <th>Técnica</th>
            <th>Tipo</th>
            <th>Municipio</th>
            <th>Cantón</th>
            <th>Ubicación</th>
            <!-- <th>Beneficiarios</th>
            <th>Instituciones</th>
            <th>Personas</th>
            <th>Comentarios</th> -->
            <!-- 14DATOS -->
        </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
            <th>Detalles</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Código</th>
            <th>Período</th>
            <th>Técnica</th>
            <th>Tipo</th>
            <th>Municipio</th>
            <th>Cantón</th>
            <th>Ubicación</th>
            <!-- <th>Beneficiarios</th>
            <th>Instituciones</th>
            <th>Personas</th>
            <th>Comentarios</th> -->
        </tr>
        </tfoot>
    </table>        
</div>  <br>
</div>
</div>
</div>

<!-- MODAL DE IMAGEN -->
<div class="modal fade bd-example-modal-xl" id="modalimagenes" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">
                              <center>Imágenes de referencia</center>
       </h3>
        <button type="button" onclick="limpiar2();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- AQUI VAS A PONER EL INPUT Y EL FORM-->
          <form id="formimagenes" name="formimagenes" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id_restauracion">
            
            <div class="form-row">
              <div class="form-group col-md-12">
                      <!-- <div class="form-group">
                          <p class="mt-5 text-center">
                            <label for="attachment">
                              <a class="btn btn-primary text-light" role="button" aria-disabled="false">+ Añadir imagen</a>
                              
                            </label>


                            <div id="prueba">
                            <input type="file" name="files[]" accept="image/*" id="attachment" style="visibility: hidden; position: absolute;" multiple/>
                            </div>
                          </p>
                          <p id="files-area">
                            <span id="filesList">
                              <span id="files-names"></span>
                            </span>
                          </p>
                      </div> -->

                      <!-- <div id="prueba">

                        <input type="file" name="files" accept="image/*" id="files" onchange="return fileValidation()">
                      </div> -->

            </div>
            <!-- NO PUEDE MODIFICAR, SOLO PUEDE VER SU REGISTRO -->
            <!--                 <div class="form-row text-center">
                            <div class="form-group col-md-12 ">
                              <button type="submit" style="background-color:#293643;border-color: darkblue;" name="btnmodificar" class="btn btn-primary">Guardar imagen</button>
                            </div>
                          </div>
             -->
                  
              </div>
          </form>
          

          <!--MUESRO LA LISTA DE IMAGENES -->
        <div id="imagenesListado"></div>
      </div>

      <div class="modal-footer">
        <button type="button" onclick="limpiar2();" class="btn btn-secondary" data-dismiss="modal">
                                          Cerrar
        </button>
      </div>

    </div>
  </div>
</div>

<!--OTRO MODAL SOLO DE INFORMACION SIN EDITAR-->
        <div class="modal fade bd-example-modal-lg" id="modalrestauracionpuntos2"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                                        Información punto de restauración
                 </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                  <form name="formrestauracionpuntos2" id="formrestauracionpuntos2" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
                  <div class="form-group">
                    
                  <!--input-->
                  <input type="hidden" class="form-control text-center" name="txtid2" id="txtid2" placeholder="detallepunto">
                    <!------------------------------------->
                  </div>
                  <div class="form-group col-md-3">
                  <label for="tpperiodo2">
                    Seleccionar el período
                  </label>
                  <!--input-->
                  <select class="form-control form-control-lg text-center" id="tpperiodo2" name="tpperiodo2" style="width: 100%" required>

                  </select>
                  <!------------------------------------->
                </div>
                  <div class="form-group col-md-9">
                    <label for="tptecnica2">Uso de suelo / Técnica</label>
                    <select class="form-control form-control-lg text-center" id="tptecnica2" name="tptecnica2" style="width: 100%">
                    </select>
                    <!-- <label for="txttecnica2">
                              Técnica
                  </label>
                    <input type="text" class="form-control form-control-lg text-center" name="txttecnica2" id="txttecnica2" placeholder="Técnica" required> -->
                </div>

                <!-- DIV PARA MOSTRAR MAPA -->
                <div class="form-row col-md-12" id="mapa"></div>


                <div class="form-group col-md-6">
                    <!-- <label for="txtlongitud2">
                              Longitud
                  </label> -->

                    <input type="hidden" class="form-control form-control-lg text-center" name="txtlongitud2" id="txtlongitud2">
                </div>
                <div class="form-group col-md-6">
                    <!-- <label for="txtlatitud2">
                              Latitud
                  </label> -->
                    <input type="hidden" class="form-control form-control-lg text-center" name="txtlatitud2" id="txtlatitud2">
                </div>


                <div class="form-group col-md-12">
                  <div class="form-group">
                    <!-- <label for="txtcoordenadas2">Coordenadas</label> -->
                      <input type="hidden" autocomplete="off"  style="height: 50px;" class="form-control" id="txtcoordenadas2" name="txtcoordenadas2" >
                  </div>
                </div>



                <div class="form-group col-md-4">
                  <label for="txtcantidadpersonas2">Cantidad de personas</label>
                  <input type="number" class="form-control form-control-lg text-center" id="txtcantidadpersonas2" name="txtcantidadpersonas2" min="0" pattern="^[0-9]+" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="tpmunicipio2">
                    Departamento/Municipio
                  </label>
                  <!--input-->
                  <select class="form-control form-control-lg text-center" id="tpmunicipio2" name="tpmunicipio2" style="width: 100%" required>

                  </select>
                  <!------------------------------------->
                </div>
                <div class="form-group col-md-4">
                    <label for="txtcanton2">
                              Cantón
                  </label>
                  <!--input-->
                    <input type="text" class="form-control form-control-lg text-center" name="txtcanton2" id="txtcanton2">
                </div>
                <div class="form-group col-md-6">
                    <label for="txtubicacion2">
                              Ubicación
                  </label>
                  <!--input-->
                    <input type="text" class="form-control form-control-lg text-center" name="txtubicacion2" id="txtubicacion2">
                </div>
                <div class="form-group col-md-6">
                    <label for="txtbeneficiarios2">
                              Beneficiarios
                  </label>
                  <!--input-->
                    <input type="text" class="form-control form-control-lg text-center" name="txtbeneficiarios2" id="txtbeneficiarios2">
                </div>
                <div class="form-group col-md-12">
                    <label for="txtinstituciones2">
                              Instituciones
                  </label>
                  <!--input-->
                    <input type="text" class="form-control form-control-lg text-center" name="txtinstituciones2" id="txtinstituciones2">
                </div>
                <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="txtarea2">Hectáreas</label>
                    <input type="number" class="form-control form-control-lg text-center" id="txtarea2" name="txtarea2" step="0.1" required>
                </div>
              </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="lista">Especies <!-- <button type="button" style="background-color:#293643;border-color: darkblue;" name="btnmas" id="btnmas" class="btn btn-primary">Agregar +</button> --></label>
                      <ul class="list-group" id="lista">
                        
                      </ul>

                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="txtcomentarios2">Comentarios</label>
                      <textarea class="form-control" id="txtcomentarios2" name="txtcomentarios2"  oninput="this.value=this.value.replace(/\n/g,'')"></textarea>
                    </div>
                  </div>

                </div>
                <!-- SOLO PUEDE VER AL SER USUARIO EXTERNO -->
                <!-- <div class="form-row">
                  <div class="form-group col-md-8">
                    <button type="submit" id="btnmodificar" class="btn btn-primary">
                      Modificar&nbsp;&nbsp;<i class="fa fa-edit" aria-hidden="true"></i>
                  </button>
                </div>
              </div> -->
              </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                  </button>
                </div>
              </div>
            </div>
          </div>




  <!--OTRO MODAL PARA MODIFICAR SI UN REGISTRO ES RECHAZADO-->
<div class="modal fade bd-example-modal-lg" id="modalrestauracionpuntos3"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
                                Información punto de restauración
         </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form name="formrestauracionpuntos3" id="formrestauracionpuntos3" method="POST" ><!--Aqui se le pone el ID para obtener todos los datos -->
          <div class="form-group">
            
          <!--input-->
          <input type="hidden" class="form-control text-center" name="txtid3" id="txtid3" placeholder="detallepunto">
            <!------------------------------------->
          </div>
          <div class="form-group col-md-3">
          <label for="tpperiodo3">
            Seleccionar el período
          </label>
          <!--input-->
          <select class="form-control form-control-lg text-center" id="tpperiodo3" name="tpperiodo3" style="width: 100%" required>

          </select>
          <!------------------------------------->
        </div>
          <div class="form-group col-md-9">
            <label for="tptecnica3">Uso de suelo / Técnica</label>
            <select class="form-control form-control-lg text-center" id="tptecnica3" name="tptecnica3" style="width: 100%">
            </select>
            <!-- <label for="txttecnica2">
                      Técnica
          </label>
            <input type="text" class="form-control form-control-lg text-center" name="txttecnica2" id="txttecnica2" placeholder="Técnica" required> -->
        </div>

        <!-- DIV PARA MOSTRAR MAPA -->
        <div class="form-row col-md-12" id="mapa3"></div>


        <div class="form-group col-md-6">
            <!-- <label for="txtlongitud2">
                      Longitud
          </label> -->

            <input type="hidden" class="form-control form-control-lg text-center" name="txtlongitud3" id="txtlongitud3">
        </div>
        <div class="form-group col-md-6">
            <!-- <label for="txtlatitud2">
                      Latitud
          </label> -->
            <input type="hidden" class="form-control form-control-lg text-center" name="txtlatitud3" id="txtlatitud3">
        </div>


        <div class="form-group col-md-12">
          <div class="form-group">
            <!-- <label for="txtcoordenadas2">Coordenadas</label> -->
              <input type="hidden" autocomplete="off"  style="height: 50px;" class="form-control" id="txtcoordenadas3" name="txtcoordenadas3" >
          </div>
        </div>



        <div class="form-group col-md-4">
          <label for="txtcantidadpersonas3">Cantidad de personas</label>
          <input type="number" class="form-control form-control-lg text-center" id="txtcantidadpersonas3" name="txtcantidadpersonas3" min="0" pattern="^[0-9]+" required>
        </div>
        <div class="form-group col-md-4">
          <label for="tpmunicipio3">
            Departamento/Municipio
          </label>
          <!--input-->
          <select class="form-control form-control-lg text-center" id="tpmunicipio3" name="tpmunicipio3" style="width: 100%" required>

          </select>
          <!------------------------------------->
        </div>
        <div class="form-group col-md-4">
            <label for="txtcanton3">
                      Cantón
          </label>
          <!--input-->
            <input type="text" class="form-control form-control-lg text-center" name="txtcanton3" id="txtcanton3">
        </div>
        <div class="form-group col-md-6">
            <label for="txtubicacion3">
                      Ubicación
          </label>
          <!--input-->
            <input type="text" class="form-control form-control-lg text-center" name="txtubicacion3" id="txtubicacion3">
        </div>
        <div class="form-group col-md-6">
            <label for="txtbeneficiarios3">
                      Beneficiarios
          </label>
          <!--input-->
            <input type="text" class="form-control form-control-lg text-center" name="txtbeneficiarios3" id="txtbeneficiarios3">
        </div>
        <div class="form-group col-md-12">
            <label for="txtinstituciones3">
                      Instituciones
          </label>
          <!--input-->
            <input type="text" class="form-control form-control-lg text-center" name="txtinstituciones3" id="txtinstituciones3">
        </div>
        <div class="form-row">
        <div class="form-group col-md-12">
            <label for="txtarea3">Hectáreas</label>
            <input type="number" class="form-control form-control-lg text-center" id="txtarea3" name="txtarea3" step="0.1" required>
        </div>
      </div>
        <div class="form-row">
          <div class="form-group col-md-12">
              <!-- <label for="lista3">Especies <button type="button" style="background-color:#293643;border-color: darkblue;" name="btnmas" id="btnmas" class="btn btn-primary">Agregar +</button></label>
              <ul class="list-group" id="lista3">
                
              </ul> -->

              <label for="lista3">Especies <button type="button" style="background-color:#293643;border-color: darkblue;" name="btnmas" id="btnmas" class="btn btn-primary" data-toggle="modal" data-target="#modalespecie"  data-backdrop="static" data-keyboard="false">Agregar +</button></label>
              <ul class="list-group" id="lista3">
                        
              </ul>

          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="txtcomentarios3">Comentarios</label>
              <textarea class="form-control" id="txtcomentarios3" name="txtcomentarios3"  oninput="this.value=this.value.replace(/\n/g,'')"></textarea>
            </div>
          </div>

        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <button type="submit" id="btnmodificar" class="btn btn-primary">
              Modificar&nbsp;&nbsp;<i class="fa fa-edit" aria-hidden="true"></i>
          </button>
        </div>
      </div>
      </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>



<div class="modal fade bd-example-modal-xs" id="modalespecie"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                                        Agregar detalle especie
                 </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                  <form id="formdetalleespecie" action="#" method="POST"><!--Aqui se le pone el ID para obtener todos los datos -->

                  <div class="form-group">
                    

                    <div class="form-floating text-left"><strong><label>Cantidad:</label></strong><input class= "form-control" type="number" id="txtcantidad" name="txtcantidad" placeholder="Cantidad de árboles" min="1" pattern="^[0-9]+" required/></div>

                    <div class=" text-left"><strong><label>Especie:</label></strong>
                      <select id="tpespecie" name="tpespecie" class="form-control form-control-lg" style="width: 100%"></select>
                    </div>



                  </div>
                    <button type="button" style="background-color:#293643;border-color: darkblue;" onclick="guardardetalleespecie()" class="btn btn-primary">Agregar</button>

              </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncerrar2" name="btncerrar2">
                                                    Cerrar
                  </button>
                </div>
              </div>
            </div>
          </div>



<!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
<script src="https://js.arcgis.com/4.23/"></script>
</body>
</html>




