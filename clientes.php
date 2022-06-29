<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>
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
                
            <div class="d-flex mt-2 w-100 justify-content-between">

                <div class="form-group" style="width: 30%">
                    <label for="select_rutas_filtro">Filtrar por ruta</label>
                    <select class="form-control select_rutas_filtro"  id="select_rutas_filtro"  style="width:auto;">
                        <option value="0">General</option>
                    </select>
                </div>

                <div class="form-group" style="width: 30%">
                    <label for="select_poblaciones_filtro">Filtrar por población</label>
                    <select class="form-control select_poblaciones_filtro"  id="select_poblaciones_filtro" style="width:auto;">
                    <option value="0">General</option>
                </select>
                </div>

                <div class="form-group" style="width: 30%">
                    <label for="select_colocadoras_filtro">Filtrar por colocadora</label>
                    <select class="form-control select_colocadoras_filtro"  id="select_colocadoras_filtro" style="width:auto;">
                    <option value="0">General</option>
                </select>

                </div>
            

            </div>
            <div class="d-flex mt-2 w-100 flex-row justify-content-between">
                <input class="form-control" id="search_filter" placeholder="Buscar Cliente..." style="width: 30%"/>
                <!--<select class="form-control select_rutas_filtro"  id="select_rutas_filtro"  style="width:auto;">
                    <option value="0">Filtrar por ruta</option>
                </select>

                <select class="form-control select_poblaciones_filtro"  id="select_poblaciones_filtro" style="width:auto;">
                    <option value="0">Filtrar por población</option>
                </select>

                <select class="form-control select_colocadoras_filtro"  id="select_colocadoras_filtro" style="width:auto;">
                    <option value="0">Filtrar por colocadora</option>
                </select>-->

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_cliente">Registrar Cliente</button>
            </div>
            <table class="table mt-2" id="tabla_clientes" >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Población</th>
                    <th scope="col">Colocadora</th>
                    <!--<th scope="col">Garantías</th>
                    <th scope="col">Comprobantes</th>
                    <th scope="col">Otras referencias</th>-->
                    <th scope="col">Aval</th>
                    <!--<th scope="col">Nombre (Aval)</th>
                    <th scope="col">Dirección (Aval)</th>
                    <th scope="col">Teléfono (Aval)</th>
                    <th scope="col">Garantías (Aval)</th>
                    <th scope="col">Comprobantes (AvaL)</th>
                    <th scope="col">Otras referencias (Aval)</th>-->
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
    <div class="modal fade " id="modal_registrar_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_nombre_cliente">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_nombre_cliente" placeholder="Nombre cliente" autofocus required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_direccion_cliente">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_direccion_cliente" placeholder="Dirección cliente" required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_telefono_cliente">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" type="number" min="0" id="inp_telefono_cliente" placeholder="Teléfono cliente" required/>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="select_rutas_registrar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_rutas"  id="select_rutas_registrar">
                            </select>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="select_poblaciones_registrar">Población <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_poblaciones"  id="select_poblaciones_registrar" disabled>
                                <option value="0">Seleccionar población</option>
                            </select>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="select_colocadoras_registrar">Colocadora <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_colocadoras"  id="select_colocadoras_registrar" disabled>
                                <option value="0">Seleccionar colocadora</option>
                            </select>
                        </div>
                       
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col mt-2">
                            <label for="inp_otras_referencias_cliente">Otras referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_otras_referencias_cliente" rows="3" required></textarea>
                        </div>
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

                   

                    
                   
                    
                    
                    
                    <!--<div class="form-group">
                        <label for="inp_domicilio_cliente">Comprobante de domicilio <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_domicilio_cliente" required >
                    </div>
                    <div class="form-group">
                        <label for="inp_ine_cliente">INE <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_ine_cliente" required >
                    </div>
                    <div class="form-group">
                        <label for="inp_tarjeton_cliente">Tarjetón <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_tarjeton_cliente" required >
                    </div>
                    <div class="form-group">
                        <label for="inp_contrato_cliente">Contrato <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_contrato_cliente" required >
                    </div>
                    <div class="form-group">
                        <label for="inp_pagare_cliente">Pagaré <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_pagare_cliente" required >
                    </div>-->

                    <!-- AVAL <div class="form-group col mt-2">
                        <label for="inp_domicilio_aval">Comprobante de domicilio <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_domicilio_aval" required>
                    </div>
                    <div class="form-group col mt-2">
                        <label for="inp_ine_aval">INE <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input type="file" class="form-control-file" id="inp_ine_aval" required >
                    </div> -->


                   
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_cliente">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_editar_nombre_cliente">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_nombre_cliente" placeholder="Nombre cliente" autofocus required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_editar_direccion_cliente">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_direccion_cliente" placeholder="Dirección cliente" required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_editar_telefono_cliente">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" type="number" min="0" id="inp_editar_telefono_cliente" placeholder="Teléfono cliente" required/>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="select_rutas_editar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_rutas editar"  id="select_rutas_editar">
                            </select>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="select_poblaciones_editar">Población <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_poblaciones editar"  id="select_poblaciones_editar" disabled>
                                <option value="0">Seleccionar población</option>
                            </select>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="select_colocadoras_editar">Colocadora <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <select class="form-control select_colocadoras editar"  id="select_colocadoras_editar" disabled>
                                <option value="0">Seleccionar colocadora</option>
                            </select>
                        </div>
                       
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col mt-2">
                            <label for="inp_editar_otras_referencias_cliente">Otras referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_editar_otras_referencias_cliente" rows="3" required></textarea>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_editar_garantias_cliente">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_editar_garantias_cliente" rows="3" required></textarea>
                        </div>

                    </div>

                    <hr>
                    <h5>Información del aval</h5>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_editar_nombre_aval">Nombre completo <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_nombre_aval" placeholder="Nombre aval" autofocus required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_editar_direccion_aval">Dirección <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control" id="inp_editar_direccion_aval" placeholder="Dirección aval" required/>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_editar_telefono_aval">Teléfono <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <input class="form-control"  type="number" min="0" id="inp_editar_telefono_aval" placeholder="Teléfono aval" required/>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_editar_otras_referencias_aval">Otras referencias <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_editar_otras_referencias_aval" rows="3" required></textarea>
                        </div>
                        <div class="form-group col mt-2">
                            <label for="inp_editar_garantias_aval">Garantías <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_editar_garantias_aval" rows="3" required></textarea>
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_editar_cliente">Guardar</button>
                </div>
            </div>
        </div>
    </div>



     <!-- Modal Ver Informacion Aval -->
     <div class="modal fade" id="modal_ver_aval" tabindex="-1" aria-labelledby="modal_ver_aval_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_ver_aval_label">Aval de</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <p class="text-bold">Nombre completo</p>
                    <p id="nombre_aval"></p>

                    <p class="text-bold">Dirección aval</p>
                    <p id="direccion_aval"></p>

                    <p class="text-bold">Teléfono aval</p>
                    <p id="telefono_aval"></p>

                    <p class="text-bold">Otras referencias</p>
                    <p id="or_aval"></p>

                    <p class="text-bold">Garantias</p>
                    <p id="garantias_aval"></p>

                </div>
                
            </div>
        </div>
    </div>


    <?php include 'templates/footer.php' ?>
  </div>

    <?php include 'templates/scripts.php' ?>
    <script src="js/clientes.js"></script>

</body>

</html>