<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuraciones</title>
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
                        <!--<div class="d-flex w-100 flex-row justify-content-end">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_usuario">Registrar usuario</button>
                        </div>-->

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-gears"></i> Configuraciones</h3>
                            </div>
                                <div class="card-body">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="abonos-tab" data-toggle="tab" href="#abonosconfig" role="tab" aria-controls="abonos" aria-selected="true">Abonos</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="semanas-tab" data-toggle="tab" href="#semanasconfig" role="tab" aria-controls="semanas" aria-selected="false">Semanas</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="multa-tab" data-toggle="tab" href="#multaconfig" role="tab" aria-controls="multaconfig" aria-selected="false">Multa</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active p-3" id="abonosconfig" role="tabpanel" aria-labelledby="abonos-tab">
                                        <div class="d-flex w-100 flex-row justify-content-end">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_usuario">Registrar abonos</button>
                                        </div>
                                        <table class="table mt-3" id="tabla_abonos">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Tipo de cantidad</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Estatus</th>
                                                    <th scope="col">Acciones</th>

                                                </tr>
                                            </thead>
                                            <tbody id="table_body">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade p-3" id="semanasconfig" role="tabpanel" aria-labelledby="semanas-tab">
                                        <div class="d-flex w-100 flex-row justify-content-end">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_usuario">Registrar semana</button>
                                        </div>
                                        <table class="table mt-3" id="tabla_semanas">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Interes</th>
                                                    <th scope="col">Tipo de abono</th>
                                                    <th scope="col">Estatus</th>
                                                    <th scope="col">Acciones</th>

                                                </tr>
                                            </thead>
                                            <tbody id="table_body">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="multaconfig" role="tabpanel" aria-labelledby="multa-tab">

                                        <table class="table mt-3" id="tabla_semanas">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Cantidad</th>
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
        </div>
    </div>


    <!-- Modal Registrar -->
    <div class="modal fade" id="modal_registrar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>
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
                        <label for="inp_usuario">Usuario <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_usuario" placeholder="Usuario" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_perfiles_registrar">Perfil <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_perfiles registrar"  id="select_perfiles_registrar">
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_password">Contraseña <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_password" type="password" placeholder="Contraseña" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_usuario">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
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
    </div>


    <?php include 'templates/footer.php' ?>
  </div>

  <?php include 'templates/scripts.php' ?>
  <script src="js/auth.js"></script>
  <script src="js/configuracion_semanas.js"></script>


</body>

</html>