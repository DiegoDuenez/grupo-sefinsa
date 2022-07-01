<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prestamos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_prestamo">Generar prestamo</button>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Prestamos registrados</h3>
                            </div>
                                <div class="card-body">
                                    <table class="table" id="tabla_prestamos">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Perfil</th>
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
            </div>
        </div>
    </div>


    <!-- Modal Registrar  -->
    <div class="modal fade" id="modal_registrar_prestamo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar archivos de cliente y aval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <h5>Archivos del cliente</h5>
                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_garantias_cliente">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_garantias_cliente" rows="3" required></textarea>
                        </div>
                        <div class="form-group col ml-3 mt-2">
                            <label for="inp_archivos_garantias_cliente">Archivos de garantiás <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="inp_archivos_garantias_cliente" required multiple >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_archivos_cliente">Comprobante de domicilio, INE, tarjetón, contrato y pagaré <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="inp_archivos_cliente" required multiple >
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5>Información del aval</h5>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_nombre_aval">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_nombre_aval" placeholder="Nombre aval" autofocus required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_direccion_aval">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_direccion_aval" placeholder="Dirección aval" required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_telefono_aval">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control"  type="number" min="0" id="inp_telefono_aval" placeholder="Teléfono aval" required/>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_otras_referencias_aval">Otras referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_otras_referencias_aval" rows="3" required></textarea>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_garantias_aval">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_garantias_aval" rows="3" required></textarea>
                        </div>
                        <div class="form-group col ml-3 mt-2">
                            <label for="inp_archivos_garantias_aval">Archivos de garantiás <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="inp_archivos_garantias_aval" required multiple >
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_archivos_aval">Comprobante de domicilio e INE <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="inp_archivos_aval" required multiple >
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_usuario">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar 
    <div class="modal fade" id="modal_editar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_editar_nombre_completo">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control " id="inp_editar_nombre_completo" placeholder="Nombre completo" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_editar_usuario">Usuario <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control " id="inp_editar_usuario" placeholder="Usuario" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_perfiles_editar">Perfil <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_perfiles editar"  id="select_perfiles_editar">
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="false" id="cb_password">
                            <label class="form-check-label" for="cb_password">
                                Cambiar contraseña
                            </label>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_editar_password" class="d-none" id="lb_password">Nueva contraseña <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control d-none" id="inp_editar_password" type="password" placeholder="Contraseña"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_usuario">Guardar</button>
                </div>
            </div>
        </div>
    </div>-->


    <?php include 'templates/footer.php' ?>
  </div>

  <?php include 'templates/scripts.php' ?>
  <script src="js/auth.js"></script>
  <script src="js/prestamos.js"></script>


</body>

</html>