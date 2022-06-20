<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rutas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include 'templates/navbar.php' ?>
    <?php include 'templates/sidebar.php' ?>

    <div class="content-wrapper">
        <div class="content">
          <div class="container-fluid">
            <div class="row p-lg-5">
                
            
            <div class="d-flex mt-2 w-100 flex-row justify-content-between">
                <input class="form-control w-25" id="search_filter" placeholder="Buscar ruta..."/>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_ruta">Registrar ruta</button>
            </div>
            <table class="table mt-2" id="tabla_rutas" >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Empleado</th>
                    <!--<th scope="col">Estatus</th>-->
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


    <!-- Modal Registrar -->
    <div class="modal fade" id="modal_registrar_ruta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar ruta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_nombre_ruta">Nombre de ruta</label>
                        <input class="form-control" id="inp_nombre_ruta" placeholder="Nombre ruta" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_empleados_registrar">Empleado</label>
                        <select class="form-control select_empleados" id="select_empleados_registrar" >
                            <option selected value="0" >Seleccionar empleado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_ruta">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar_ruta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar ruta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_editar_nombre_ruta">Nombre de ruta</label>
                        <input class="form-control" id="inp_editar_nombre_ruta" placeholder="Nombre ruta" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_empleados_editar">Empleado</label>
                        <select class="form-control select_empleados editar" id="select_empleados_editar" >
                            <option selected value="0" >Seleccionar empleado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_ruta">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <?php include 'templates/footer.php' ?>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="js/auth.js"></script>
  <script src="js/rutas.js"></script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="plugins/blockui/jquery.blockui.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</body>

</html>