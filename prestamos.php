<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Préstamos</title>
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

                    <div class="row p-2">
                        <div class="d-flex mt-2 w-100 justify-content-between" style="gap: 1rem;">
                            <div class="form-group" style="width: 20%">
                                <label for="select_rutas_filtro">Filtrar por ruta</label>
                                <select class="form-control select_rutas_filtro" id="select_rutas_filtro" style="width:auto;">
                                    <option value="0">General</option>
                                </select>
                            </div>

                            <div class="form-group" style="width: 20%">
                                <label for="select_poblaciones_filtro">Filtrar por población</label>
                                <select class="form-control select_poblaciones_filtro" id="select_poblaciones_filtro" style="width:auto;">
                                    <option value="0">General</option>
                                </select>
                            </div>

                            <div class="form-group" style="width: 20%">
                                <label for="select_colocadoras_filtro">Filtrar por colocadora</label>
                                <select class="form-control select_colocadoras_filtro" id="select_colocadoras_filtro" style="width:auto;">
                                    <option value="0">General</option>
                                </select>
                            </div>

                            <div class="form-group" style="width: 20%">
                                <label for="select_estatus_filtro">Filtrar por estatus</label>
                                <select class="form-control select_estatus_filtro" id="select_estatus_filtro" style="width:auto;">
                                    <option value="0">Pagandose</option>
                                    <option value="1">Pagado</option>
                                    <option value="2">Renovado</option>
                                    <option value="-1">Vencido</option>
                                    <option value="3">General</option>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row p-3">

                        <div class="d-flex w-100 flex-row justify-content-end" style="gap: 1rem;">
                            <button type="button" id="btn_generar_prestamo" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_prestamo">Generar prestamo</button>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-dollar-sign"></i> Préstamos registrados</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="tabla_prestamos">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tarjetón</th>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">Dirección del cliente</th>
                                                <th scope="col">Teléfono</th>
                                                <th scope="col">Aval</th>
                                                <th scope="col">Dirección del aval</th>
                                                <th scope="col">Teléfono aval</th>
                                                <th scope="col">Fecha de préstamo</th>
                                                <th scope="col" class="sum_monto_prestado">Monto</th>
                                                <th scope="col" class="sum_pago_semanal">Semanal</th>
                                                <!-- <th scope="col">Semana 1</th>
                                            <th scope="col">Semana 2</th>
                                            <th scope="col">Semana 3</th>
                                            <th scope="col">Semana 4</th>
                                            <th scope="col">Semana 5</th>
                                            <th scope="col">Semana 6</th>
                                            <th scope="col">Semana 7</th>
                                            <th scope="col">Semana 8</th>
                                            <th scope="col">Semana 9</th>
                                            <th scope="col">Semana 10</th>
                                            <th scope="col">Semana 11</th>
                                            <th scope="col">Semana 12</th>
                                            <th scope="col">Semana 13</th>
                                            <th scope="col">Semana 14</th>
                                            <th scope="col">Semana 15</th>
                                            <th scope="col">Semana 16</th>
                                            <th scope="col">Semana 17</th>
                                            <th scope="col">Semana 18</th>
                                            <th scope="col">Semana 19</th>
                                            <th scope="col">Semana 20</th>-->
                                                <th scope="col">Modalidad</th>
                                                <th scope="col">Ruta</th>
                                                <th scope="col">Población</th>
                                                <th scope="col">Estatus</th>
                                                <th scope="col">Historial</th>
                                                <th scope="col">Info.</th>

                                            </tr>
                                        </thead>
                                        <tbody id="table_body">

                                        </tbody>
                                        <tfoot>
                                            <tr class="thead-dark">
                                                <th>Totales</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
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
        <div class="modal-dialog modal-xl" id="modal_dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_prestamos_label">Registrar archivos de cliente y aval</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="cliente" class="">

                        <ul class="nav nav-tabs" id="prestamosTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nuevo-cliente-tab" data-toggle="tab" href="#nuevo-cliente" role="tab" aria-controls="home" aria-selected="true">Nuevo cliente</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cliente-existente-tab" data-toggle="tab" href="#cliente-existente" role="tab" aria-controls="profile" aria-selected="false">Cliente existente</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="prestamosTabContent">

                            <div class="tab-pane fade show active" id="nuevo-cliente" role="tabpanel" aria-labelledby="nuevo-cliente-tab">

                                <h5 id="titulo_cliente">Archivos del cliente</h5>

                                <div class="form-row" id="inputs_registrar_cliente_1">

                                    <div class="form-group col mt-2">
                                        <label for="inp_nombre_cliente">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" id="inp_nombre_cliente" placeholder="Nombre cliente" autofocus required />
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_direccion_cliente">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" id="inp_direccion_cliente" placeholder="Dirección cliente" required />
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_telefono_cliente">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" type="number" min="0" id="inp_telefono_cliente" placeholder="Teléfono cliente" required />
                                    </div>

                                </div>

                                <div class="form-row" id="inputs_registrar_cliente_2">

                                    <div class="form-group col mt-2">
                                        <label for="select_rutas_registrar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_rutas" id="select_rutas_registrar">
                                        </select>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="select_poblaciones_registrar">Población <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_poblaciones" id="select_poblaciones_registrar" disabled>
                                            <option value="0">Seleccionar población</option>
                                        </select>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="select_colocadoras_registrar">Colocadora <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_colocadoras" id="select_colocadoras_registrar" disabled>
                                            <option value="0">Seleccionar colocadora</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-row" id="inputs_registrar_cliente_3" class="">

                                    <div class="form-group col mt-2" id="group_or_client">
                                        <label for="inp_otras_referencias_cliente">Otras referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <textarea class="form-control" id="inp_otras_referencias_cliente" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_garantias_cliente">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <textarea class="form-control" id="inp_garantias_cliente" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group col ml-3 mt-2">
                                        <label for="inp_archivos_garantias_cliente">Archivos de garantías</label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_garantias_cliente" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row" id="inputs_registrar_cliente_4">

                                    <div class="form-group col mt-2">
                                        <label for="inp_archivos_cliente">Comprobante de domicilio, INE, tarjetón, contrato y pagaré</label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_cliente" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="cliente-existente" role="tabpanel" aria-labelledby="cliente-existente-tab">

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="select_clientes_registrar">Cliente <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_clientes" id="select_clientes_registrar">
                                        </select>
                                    </div>

                                    <div class="form-group col mt-2">
                                        <label for="inp_direccion_cliente_existente">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" id="inp_direccion_cliente_existente" placeholder="Dirección cliente" required />
                                    </div>

                                    <div class="form-group col mt-2">
                                        <label for="inp_telefono_cliente_existente">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" type="number" min="0" id="inp_telefono_cliente_existente" placeholder="Teléfono cliente" required />
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="select_rutas_registrar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_rutas" id="select_rutas_registrar_existente" disabled>
                                        </select>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="select_poblaciones_registrar">Población <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_poblaciones" id="select_poblaciones_registrar_existente" disabled>
                                        </select>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="select_colocadoras_registrar">Colocadora <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_colocadoras" id="select_colocadoras_registrar_existente" disabled>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="inp_garantias_cliente">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <textarea class="form-control" id="inp_garantias_cliente_existente" rows="3" required></textarea>
                                    </div>

                                    <div class="form-group col ml-3 mt-2">
                                        <label for="inp_archivos_garantias_cliente">Archivos de garantías </label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_garantias_cliente_existente" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col mt-2">
                                        <label for="inp_archivos_cliente">Comprobante de domicilio, INE, tarjetón, contrato y pagaré </label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_cliente_existente" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>



                        <hr>
                        <h5>Información del aval</h5>

                        <div class="form-row">

                            <div class="form-group col mt-2">
                                <label for="inp_nombre_aval">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input class="form-control" id="inp_nombre_aval" placeholder="Nombre aval" autofocus required />
                            </div>
                            <div class="form-group col mt-2">
                                <label for="inp_direccion_aval">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input class="form-control" id="inp_direccion_aval" placeholder="Dirección aval" required />
                            </div>
                            <div class="form-group col mt-2">
                                <label for="inp_telefono_aval">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input class="form-control" type="number" min="0" id="inp_telefono_aval" placeholder="Teléfono aval" required />
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
                                <label for="inp_archivos_garantias_aval">Archivos de garantías </label>
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" id="inp_archivos_garantias_aval" required multiple>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col mt-2">
                                <label for="inp_archivos_aval">Comprobante de domicilio e INE </label>
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" id="inp_archivos_aval" required multiple>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--<ul class="nav nav-tabs" id="prestamosAvalTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="nuevo-aval-tab" data-toggle="tab" href="#nuevo-aval" role="tab" aria-controls="nuevo-aval" aria-selected="true">Nuevo aval</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cliente-aval-tab" data-toggle="tab" href="#cliente-aval" role="tab" aria-controls="cliente-aval" aria-selected="false">Cliente-Aval</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="prestamosAvalTabContent">

                            <div class="tab-pane fade show active" id="nuevo-aval" role="tabpanel" aria-labelledby="nuevo-aval-tab">

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="inp_nombre_aval">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" id="inp_nombre_aval" placeholder="Nombre aval" autofocus required />
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_direccion_aval">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" id="inp_direccion_aval" placeholder="Dirección aval" required />
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_telefono_aval">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" type="number" min="0" id="inp_telefono_aval" placeholder="Teléfono aval" required />
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
                                        <label for="inp_archivos_garantias_aval">Archivos de garantías </label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_garantias_aval" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="inp_archivos_aval">Comprobante de domicilio e INE </label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_aval" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <div class="tab-pane fade show" id="cliente-aval" role="tabpanel" aria-labelledby="cliente-aval-tab">

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="select_clientes_aval">Cliente <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <select class="form-control select_clientes" id="select_clientes_aval">
                                        </select>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_direccion_cliente_aval">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" id="inp_direccion_cliente_aval" placeholder="Dirección aval" required />
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_telefono_cliente_aval">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <input class="form-control" type="number" min="0" id="inp_telefono_cliente_aval" placeholder="Teléfono aval" required />
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="inp_otras_referencias_cliente_aval">Otras referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <textarea class="form-control" id="inp_otras_referencias_cliente_aval" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="inp_garantias_cliente_aval">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                                        <textarea class="form-control" id="inp_garantias_cliente_aval" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group col ml-3 mt-2">
                                        <label for="inp_archivos_garantias_cliente_aval">Archivos de garantías </label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_garantias_cliente_aval" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col mt-2">
                                        <label for="inp_archivos_cliente_aval">Comprobante de domicilio e INE </label>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="inp_archivos_cliente_aval" required multiple>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        
                            </div>
                        

                        </div>-->



                    </div>

                    <div id="pago" class="d-none">

                        <div class="form-row">
                            <div class="form-group col mt-2">
                                <label for="inp_fecha_prestamo">Fecha de préstamo <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input class="form-control" id="inp_fecha_prestamo" type="date" value="<?php echo date('Y-m-d'); ?>" required />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col mt-2">
                                <label for="inp_monto_prestar">Monto a prestar <span class="text-danger" title="Campo obligatorio">*</span></label>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" id="inp_monto_prestar" type="number" placeholder="0.00" required name="price" min="0.00" value="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                                </div>
                            </div>

                            <div class="form-group col mt-2">
                                <label for="select_modalidad">Modalidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <select class="form-control select_modalidad" id="select_modalidad">
                                    <option value="15">15 semanas</option>
                                    <option value="20">20 semanas</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col mt-2">
                                <label for="inp_pago_semana">Pago por semana <span class="text-danger" title="Campo obligatorio">*</span></label>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" id="inp_pago_semana" type="number" placeholder="0.00" required name="price" min="0.00" value="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                                </div>
                            </div>

                            <div class="form-group col mt-2">
                                <label for="inp_tarjeton">Número de tarjetón <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input class="form-control" id="inp_tarjeton" type="number" placeholder="Número de tarjetón" required " min=" 0" />
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" id="btn_anterior_usuario" disabled>Anterior</button>
                    <button type="submit" class="btn btn-primary" id="btn_siguiente_usuario">Siguiente</button>
                    <button type="submit" class="btn btn-primary d-none" id="btn_guardar_prestamo">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Semanas-->
    <div class="modal fade" id="modal_ver_semanas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Semanas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table" id="tabla_pagos">
                        <thead>
                            <tr>
                                <th scope="col">Semana</th>
                                <th scope="col">Cantidad a pagar</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="">Guardar</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal Renovar -->
    <div class="modal fade" id="modal_renovar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Renovar préstamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_fecha_renovacion" class="d-none">Fecha de renovación <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_fecha_renovacion" type="hidden" value="<?php echo date('Y-m-d'); ?>" required />
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_monto_renovar">Monto a prestar <span class="text-danger" title="Campo obligatorio">*</span></label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input class="form-control" id="inp_monto_renovar" type="number" placeholder="0.00" required name="price" min="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                            </div>
                        </div>

                        <div class="form-group col mt-2">
                            <label for="select_modalidad_renovar">Modalidad <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_modalidad" id="select_modalidad_renovar">
                                <option value="15">15 semanas</option>
                                <option value="20">20 semanas</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_pago_semana_renovar">Pago por semana <span class="text-danger" title="Campo obligatorio">*</span></label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input class="form-control" id="inp_pago_semana_renovar" type="number" placeholder="0.00" required name="price" min="0.00" value="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" />
                            </div>
                        </div>

                        <div class="form-group col mt-2">
                            <label for="inp_tarjeton_renovar">Número de tarjetón <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_tarjeton_renovar" type="number" placeholder="Número de tarjetón" required min=" 0" />
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col mt-2">
                            <label for="inp_debe_renovar">Debe <span class="text-danger" title="Campo obligatorio">*</span></label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input class="form-control" id="inp_debe_renovar" type="number" placeholder="0.00" required name="price" min="0.00" value="0.00" step="0.01" disabled pattern="^\d+(?:\.\d{1,2})?$" />
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_renovar">Renovar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver Informacion  -->
    <div class="modal fade" id="modal_ver_informacion" tabindex="-1" aria-labelledby="modal_ver_informacion_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_ver_informacion_label">Información préstamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Nombre cliente:</p>
                            <p id="info_nombre_cliente"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Dirección cliente:</p>
                            <p id="info_direccion_cliente"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Télefono cliente:</p>
                            <p id="info_telefono_cliente"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Nombre aval:</p>
                            <p id="info_nombre_aval"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Dirección aval:</p>
                            <p id="info_direccion_aval"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Teléfono aval:</p>
                            <p id="info_telefono_aval"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Otras referencias aval:</p>
                            <p id="info_or_aval"></p>
                        </div>
                        <div class="d-flex w-100" style="gap: 0.5rem;">
                            <p class="text-bold">Garantias aval:</p>
                            <p id="info_garantias_aval"></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    <?php include 'templates/footer.php' ?>
    </div>

    <?php include 'templates/scripts.php' ?>
    <script src="js/auth.js"></script>
    <script src="js/prestamos.js"></script>
    <script src="js/config.js"></script>


</body>

</html>