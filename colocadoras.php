<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Colocadoras</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include 'templates/navbar.php' ?>
    <?php include 'templates/sidebar.php' ?>

    <div class="content-wrapper">
    <section class="content">
    <div class="container-fluid">
        <div class="row p-lg-5">
            <div class="d-flex w-100 flex-row justify-content-end">
                <button type="button" class="btn btn-success btn_modal_registrar_colocadora" data-toggle="modal" data-target="#modal_registrar_colocadora">Registrar colocadora</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Colocadoras registradas</h3>
                    </div>
                        <div class="card-body">
                            <table class="table mt-2" id="tabla_colocadoras" >
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Dirección o referencias</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Ruta</th>
                                        <th scope="col">Población</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>

    <!--<div class="content-wrapper">
        <div class="content">
          <div class="container-fluid">
            <div class="row p-lg-5">
                
            
            <div class="d-flex mt-2 w-100 flex-row justify-content-between">
                <input class="form-control" style="width: 30%" id="search_filter" placeholder="Buscar colocadora..."/>
                <button type="button" class="btn btn-success btn_modal_registrar_colocadora" data-toggle="modal" data-target="#modal_registrar_colocadora">Registrar colocadora</button>
            </div>
            <table class="table mt-2" id="tabla_colocadoras" >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección o referencias</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Población</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="table_body">
               
            </tbody>
            </table>
            </div>
          </div>
        </div>
    </div>-->


    <!-- Modal Registrar -->
    <div class="modal fade" id="modal_registrar_colocadora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar colocadora</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_nombre_completo">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_nombre_completo" placeholder="Nombre completo" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_direccion">Dirección o referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_direccion" placeholder="Dirección o referencias" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_telefono">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" id="inp_telefono" placeholder="Teléfono" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_rutas_registrar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_rutas" id="select_rutas_registrar">
                            <option selected value="0" >Seleccionar ruta</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_poblaciones_registrar">Población <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_poblaciones" id="select_poblaciones_registrar" disabled >
                            <option selected value="0" >Seleccionar población</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_colocadora">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar_colocadora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar colocadora</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_editar_nombre_completo">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_editar_nombre_completo" placeholder="Nombre completo" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_editar_direccion">Dirección o referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_editar_direccion" placeholder="Dirección o referencias" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_editar_telefono">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" id="inp_editar_telefono" placeholder="Teléfono" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_rutas_editar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_rutas editar" id="select_rutas_editar">
                            <option selected value="0" >Seleccionar ruta</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_poblaciones_editar">Población <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_poblaciones editar" id="select_poblaciones_editar">
                            <option selected value="0" >Seleccionar población</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_colocadora">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <?php include 'templates/footer.php' ?>
  </div>

  <!--<script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="js/auth.js"></script>
  <script src="js/colocadoras.js"></script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="plugins/blockui/jquery.blockui.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>-->
  <?php include 'templates/scripts.php' ?>
  <script src="js/auth.js"></script>
  <script src="js/colocadoras.js"></script>

</body>

</html>