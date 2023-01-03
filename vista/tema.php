<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once './layout/head.php'; ?>
</head>
<!-- Instanciar clases -->

<body class="hold-transition layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php require_once './layout/nav.php'; ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php require_once './layout/aside.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Mantenimiento Tema</h1>
              <h5 name="temaSubs" id="temaSubs" >No ha seleccionado tema</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./dashboard">Inicio</a></li>
                <li class="breadcrumb-item active">Tema</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- Default box -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Ingresar/Actualizar Tema</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form id="form_tema" class="row">
                  <input type="hidden" name="id_tema" id="id_tema">

                  <div class="form-group col-md-12 mb-3">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre del tema" />
                  </div>

                  <div class="form-group col-md-12 mb-3">
                    <label for="desc">Descripción:</label>
                    <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Ingrese la descripción del tema"></textarea>
                  </div>

                  <div class="form-group col-md-12 mb-3">
                    <label for="obser">Observaciones:</label>
                    <textarea class="form-control" name="obser" id="obser" rows="5" placeholder="Ingrese las observaciones del tema"></textarea>
                  </div>

                  <div class="form-group col-md-12 mb-3">
                    <div class="form-group">
                      <label>Selecciona el ambito relacionado</label>
                      <select name="ambito" id="ambito" class="form-control">

                      </select>
                    </div>
                  </div>


                  <div class="form-group col-md-12">
                    <button type="button" id="btn_cancelar" class="btn btn-danger float-right">Cancelar</button>
                    <button type="submit" id="btn_enviar" class="btn btn-primary float-right mr-2">Guardar</button>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Puntajes</b></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimízar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form id="form_puntaje" class="row">
                  <input type="hidden" name="id_tema" id="id_tema">
                  <input type="hidden" name="id_puntaje" id="id_puntaje">
                  <div class="form-group col-md-12 mb-3">
                    <div class="form-group">
                      <label>Selecciona el puntaje</label>
                      <select name="pts" id="pts" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-md-12 mb-3">
                    <label for="desc">Descripcion</label>
                    <textarea class="form-control" name="ptsDesc" id="ptsDesc" rows="5" placeholder="Puntaje no ingresado, ingrese la descripcion"></textarea>
                  </div>

                  <div class="form-group col-md-12">
                    <button type="submit" id="btn_enviar_puntaje" class="btn btn-primary float-right mr-2">Guardar</button>
                  </div>

                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Lista de Temas</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="tabla_temas" class="table table-bordered display nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 20%;">Nombre</th>
                      <th style="width: 35%;">Descripción</th>
                      <th style="width: 35%;">Observaciones</th>
                      <th style="width: 10%;">Acción</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="width: 20%;"></th>
                      <th style="width: 35%;"></th>
                      <th style="width: 35%;"></th>
                      <th style="width: 10%;"></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require_once './layout/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php require_once './layout/scripts.php'; ?>
  <script src="./js/tema.js"></script>
</body>

</html>