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
                                            <a class="nav-link" id="semanas-tab" data-toggle="tab" href="#semanasconfig" role="tab" aria-controls="semanas" aria-selected="false">Modalidades</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="multa-tab" data-toggle="tab" href="#multaconfig" role="tab" aria-controls="multaconfig" aria-selected="false">Multa</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active p-3" id="abonosconfig" role="tabpanel" aria-labelledby="abonos-tab">
                                            <div class="d-flex w-100 flex-row justify-content-end mb-5">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_abono">Registrar abono</button>
                                            </div>
                                            <table class="table" id="tabla_abonos">
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
                                            <div class="d-flex w-100 flex-row justify-content-end mb-5">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_semana">Registrar modalidad</button>
                                            </div>
                                            <table class="table " id="tabla_semanas">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Cantidad semanas</th>
                                                        <th scope="col">Interes</th>
                                                        <th scope="col">Tipo de abono</th>
                                                        <th scope="col">Semana de renovación</th>
                                                        <th scope="col">Estatus</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade pt-5" id="multaconfig" role="tabpanel" aria-labelledby="multa-tab">

                                            <table class="table mt-3" id="tabla_multa">
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


    <!-- Modal Registrar Abonos -->
    <div class="modal fade" id="modal_registrar_abono" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar abono</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_abono_cantidad">Cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" min="0" id="inp_abono_cantidad" placeholder="Cantidad" autofocus required />
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_abono_tipo_cantidad">Tipo de cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_abono_tipo_cantidad" id="select_abono_tipo_cantidad" style="width:100%;">
                            <option value="%">Porcentaje (%)</option>
                            <option value="$">Peso ($)</option>
                        </select>

                        <div class="form-row d-flex mt-2">
                            <div class="form-group col mt-2">
                                <input class="form-control bg-white" id="inp_abono_cantidad_con_tipo" autofocus disabled />
                            </div>
                            <div class="form-group col mt-2">

                                <input class="form-control bg-white" id="inp_tipo" autofocus disabled />
                            </div>
                            <div class="form-group col mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" id="inp_cantidad_pagada" disabled type="text" placeholder="0.00" required name="price" min="0.00" value="Monto prestado" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_abono">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Abono -->
    <div class="modal fade" id="modal_editar_abono" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar abono</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_abono_cantidad_editar">Cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" min="0" id="inp_abono_cantidad_editar" placeholder="Cantidad" autofocus required />
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_abono_tipo_cantidad_editar">Tipo de cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_abono_tipo_cantidad_editar" id="select_abono_tipo_cantidad_editar" style="width:100%;">
                            <option value="%">Porcentaje (%)</option>
                            <option value="$">Peso ($)</option>
                        </select>

                        <div class="form-row d-flex mt-2">
                            <div class="form-group col mt-2">
                                <input class="form-control bg-white" id="inp_abono_cantidad_con_tipo_editar" autofocus disabled />
                            </div>
                            <div class="form-group col mt-2">
                                <input class="form-control bg-white" id="inp_tipo_editar" autofocus disabled />
                            </div>
                            <div class="form-group col mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" id="inp_cantidad_pagada_editar" disabled type="text" placeholder="0.00" required name="price" min="0.00" value="Monto prestado" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_abono">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Registrar Semanas -->
    <div class="modal fade" id="modal_registrar_semana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar modalidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group mt-2">
                        <label for="inp_semana_cantidad">Cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" min="0" id="inp_semana_cantidad" placeholder="Cantidad" autofocus required />
                    </div>

                    <div class="form-group mt-2">
                        <label for="inp_semana_interes">Interes <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input class="form-control" type="number" min="0" id="inp_semana_interes" placeholder="Interes" autofocus required />
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="select_semana_tipo_abono">Tipo de abono <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_semana_tipo_abono" id="select_semana_tipo_abono" style="width:100%;">
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label for="inp_semana_semana_ren">Semana de renovación<span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" min="0" id="inp_semana_semana_ren" placeholder="Semana de renovación" autofocus required />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_semana">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Editar Semanas -->
    <div class="modal fade" id="modal_editar_semana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar semana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group mt-2">
                        <label for="inp_semana_cantidad_editar">Cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" min="0" id="inp_semana_cantidad_editar" placeholder="Cantidad" autofocus required />
                    </div>

                    <div class="form-group mt-2">
                        <label for="inp_semana_interes_editar">Interes <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input class="form-control" type="number" min="0" id="inp_semana_interes_editar" placeholder="Interes" autofocus required />
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="select_semana_tipo_abono_editar">Tipo de abono <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_semana_tipo_abono" id="select_semana_tipo_abono_editar" style="width:100%;">
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label for="inp_semana_semana_ren_editar">Semana de renovación<span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" type="number" min="0" id="inp_semana_semana_ren_editar" placeholder="Semana de renovación" autofocus required />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_semana">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Editar Multa -->
    <div class="modal fade" id="modal_editar_multa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar multa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group col mt-2">
                        <label for="inp_multa_cantidad_editar">Cantidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input class="form-control" id="inp_multa_cantidad_editar" type="number" placeholder="0.00" required name="price" min="0.00" value="" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_multa">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <?php include 'templates/footer.php' ?>
    </div>

    <?php include 'templates/scripts.php' ?>
    <script src="js/auth.js"></script>
    <script src="js/configuracion_abonos.js"></script>
    <script src="js/configuracion_semanas.js"></script>
    <script src="js/configuracion_multa.js"></script>


</body>

</html>