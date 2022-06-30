<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poblaciones</title>
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
                <input class="form-control" style="width: 30%" id="search_filter" placeholder="Buscar población..."/>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_localidad">Registrar población</button>
            </div>
            <table class="table mt-2" id="tabla_localidades" >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Hora limite de cobro </th>
                    <th scope="col">Monto de multa</th>
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
                    <div class="form-group mt-2">
                        <label for="inp_nombre_localidad">Nombre población <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_nombre_localidad" placeholder="Nombre población" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_rutas_registrar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_rutas" id="select_rutas_registrar" >
                            <option selected value="0" >Seleccionar ruta</option>
                        </select>
                    </div>

                    <label for="select_primer_dia">Dia de cobro <span class="text-danger" title="Campo obligatorio">*</span></label>
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
                            <input class="form-control" id="inp_primer_hora" required  />
                        </div>
                        <div class="form-group col mt-2">
                            <input class="form-control" id="inp_segunda_hora" required/>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="inp_monto_multa">Monto de multa <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input  class="form-control" id="inp_monto_multa"  type="number" placeholder="0.00" required name="price" min="0" value="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"/>
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

                    <div class="form-group mt-2">
                        <label for="inp_editar_nombre_localidad">Nombre población <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input class="form-control" id="inp_editar_nombre_localidad" placeholder="Nombre población" autofocus required/>
                    </div>
                    <div class="form-group mt-2">
                        <label for="select_rutas_editar">Ruta <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <select class="form-control select_rutas editar" id="select_rutas_editar">
                            <option selected value="0" >Seleccionar ruta</option>
                        </select>
                    </div>

                    <label for="select_editar_primer_dia">Dia de cobro <span class="text-danger" title="Campo obligatorio">*</span></label>
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
                            <input class="form-control" id="inp_editar_primer_hora" required  />
                        </div>
                        <div class="form-group col mt-2">
                            <input class="form-control" id="inp_editar_segunda_hora" required/>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="inp_editar_monto_multa">Monto de multa <span class="text-danger" title="Campo obligatorio">*</span></label>
                        <input  class="form-control" id="inp_editar_monto_multa"  type="number" placeholder="0.00" required name="price" min="0" value="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"/>
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
    <script src="js/localidades.js"></script>

</body>

</html>