<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfiles</title>
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
            <div class="content">
                <div class="container-fluid">
                    <div class="row p-3">
                        <div class="d-flex w-100 flex-row justify-content-end">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_perfil">Registrar perfil</button>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Perfiiles registrados</h3>
                            </div>
                                <div class="card-body">
                                    <table class="table" id="tabla_perfiles">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Tipo perfil</th>
                                            <th scope="col">Acciones</th>
                                            <th scope="col">Fecha de registro</th>
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
            </div>
        </div>
    </div>


    <!-- Modal Registrar -->
    <div class="modal fade" id="modal_registrar_perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_nombre_perfil">Nombre perfil <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_nombre_perfil" placeholder="Nombre perfil" autofocus required/>
                        </div>

                    </div>

                    <label for="select_tipo_perfil">Tipo de perfil <span class="text-danger" title="Campo obligatorio">*</span></label>
                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <select class="form-control" name="select_tipo_perfil" id="select_tipo_perfil">
                                <option value="usuario">Usuario</option>
                                <option value="empleado">Empleado</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_perfil">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar_perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_editar_nombre_perfil">Nombre perfil <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_nombre_perfil" placeholder="Nombre perfil" autofocus required/>
                        </div>

                    </div>

                    <label for="select_editar_tipo_perfil">Tipo de perfil <span class="text-danger" title="Campo obligatorio">*</span></label>
                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <select class="form-control" name="select_editar_tipo_perfil" id="select_editar_tipo_perfil">
                                <option value="usuario">Usuario</option>
                                <option value="empleado">Empleado</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_perfil">Guardar</button>
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
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/moment/moment-with-locales.js"></script>
    <script src="plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="plugins/blockui/jquery.blockui.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>-->

    <?php include 'templates/scripts.php' ?>
    <script src="js/auth.js"></script>
    <script src="js/perfiles.js"></script>

</body>

</html>