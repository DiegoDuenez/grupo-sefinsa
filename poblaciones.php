<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poblaciones</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!--<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">-->
    <link rel="stylesheet" href="css/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="css/datatable-bootstrap4.css">

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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_localidad">Registrar población</button>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-map-location-dot"></i> Poblaciones registradas</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="tabla_localidades">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ruta</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Grupo</th>
                                                <th scope="col">Hora límite de cobro </th>
                                                <th scope="col">Monto de multa</th>
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
    <div class="modal fade" id="modal_registrar_localidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar población</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_nombre_localidad">Nombre población <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_nombre_localidad" placeholder="Nombre población" autofocus required />
                        </div>

                        <div class="form-group col mt-2">
                            <label for="select_rutas_registrar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_rutas" id="select_rutas_registrar">
                                <option selected value="0">Seleccionar ruta</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_grupo">Grupo <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_grupo" type="number" placeholder="Grupo" value="1" required min="1" />
                        </div>

                    </div>


                    <label for="select_primer_dia">Día de cobro <span class="text-danger" title="Campo obligatorio">*</span></label>
                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <select class="form-control" name="select_primer_dia" id="select_primer_dia">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sabado</option>
                            </select>
                        </div>

                    </div>

                    <label for="inp_primer_hora">Horario de cobro <span class="text-danger" title="Campo obligatorio">*</span></label>
                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <input class="form-control" id="inp_primer_hora" required />
                        </div>
                        <div class="form-group col mt-2">
                            <input class="form-control" id="inp_segunda_hora" required />
                        </div>

                    </div>

                    <div class="form-group mt-2">

                        <label for="inp_monto_multa">Monto de multa <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input class="form-control" id="inp_monto_multa" type="number" placeholder="0.00" required name="price" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_localidad">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar_localidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar población</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_editar_nombre_localidad">Nombre población <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_nombre_localidad" placeholder="Nombre población" autofocus required />
                        </div>

                        <div class="form-group col mt-2">
                            <label for="select_rutas_editar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_rutas editar" id="select_rutas_editar">
                                <option selected value="0">Seleccionar ruta</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_editar_grupo">Grupo <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_grupo" type="number" placeholder="Grupo" required min="1" />
                        </div>

                    </div>

                    <label for="select_editar_primer_dia">Día de cobro <span class="text-danger" title="Campo obligatorio">*</span></label>
                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <select class="form-control" name="select_editar_primer_dia" id="select_editar_primer_dia">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sabado">Sabado</option>
                            </select>
                        </div>

                    </div>

                    <label for="inp_editar_primer_hora">Horario de cobro <span class="text-danger" title="Campo obligatorio">*</span></label>
                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <input class="form-control" id="inp_editar_primer_hora" required />
                        </div>
                        <div class="form-group col mt-2">
                            <input class="form-control" id="inp_editar_segunda_hora" required />
                        </div>

                    </div>

                    <div class="form-group mt-2">

                        <label for="inp_editar_monto_multa">Monto de multa <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input class="form-control" id="inp_editar_monto_multa" type="number" placeholder="0.00" required name="price" min="0.00" value="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_localidad">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <?php include 'templates/footer.php' ?>
    </div>

    <?php include 'templates/scripts.php' ?>
    <script src="js/auth.js"></script>
    <script src="js/localidades.js"></script>
    <script src="js/config.js"></script>

</body>

</html>