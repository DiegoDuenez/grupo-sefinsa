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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'templates/navbar.php' ?>
        <?php include 'templates/sidebar.php' ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row p-3">
                        <div class="d-flex w-100 flex-row justify-content-end">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_ruta">Registrar ruta</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-route"></i> Rutas registradas</h3>
                                </div>
                                <div class="card-body">
                                    <table id="tabla_rutas" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Empleado(s)</th>
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
            </section>

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
                    <div class="modal-body" id="modal_body_registrar_ruta">

                        <div class="form-group mt-2">
                            <label for="inp_nombre_ruta">Nombre de ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_nombre_ruta" placeholder="Nombre ruta" autofocus required />
                        </div>

                        <div class="form-group mt-2">
                            <label for="select_empleados_registrar_0">Empleado(s) <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_empleados" id="select_empleados_registrar_0">
                                <option selected value="0">Seleccionar empleado</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group mt-2 ml-2 mr-2">
                        <button class="btn btn-success btn-block" id="btn_agregar_empleado">Agregar empleado</button>
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
                    <div class="modal-body" id="modal_body_editar_ruta">

                        <div class="form-group mt-2" id="contenedor_inp_editar_nombre_ruta">
                            <label for="inp_editar_nombre_ruta">Nombre de ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_nombre_ruta" placeholder="Nombre ruta" autofocus required />
                        </div>

                    </div>

                    <div class="form-group mt-2 ml-2 mr-2">
                        <button class="btn btn-success btn-block" id="btn_editar_agregar_empleado">Agregar empleado</button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn_guardar_editar_ruta">Guardar</button>
                    </div>
                </div>
            </div>
        </div>


        <?php include 'templates/footer.php' ?>
    </div>

    <?php include 'templates/scripts.php' ?>
    <script src="js/auth.js"></script>
    <script src="js/rutas.js"></script>

    <script>

    </script>

</body>

</html>