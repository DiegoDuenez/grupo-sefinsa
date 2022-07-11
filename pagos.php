<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagos</title>
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

                <div class="row p-2">
                    <div class="d-flex mt-2 w-100 justify-content-between">
                        <div class="form-group" style="width: 30%">
                            <label for="select_clientes_filtro">Filtrar por cliente</label>
                            <select class="form-control select_clientes_filtro"  id="select_clientes_filtro"  style="width:50%;">
                                <option value="0">General</option>
                            </select>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Pagos registrados</h3>
                            </div>
                                <div class="card-body">
                                    <table class="table" id="tabla_pagos">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre del cliente</th>
                                            <th scope="col">Monto prestado</th>
                                            <th scope="col">Pago esperado</th>
                                            <th scope="col">Pago recibido</th>
                                            <th scope="col">Pago de multa</th>
                                            <th scope="col">Pago pendiente</th>
                                            <th scope="col">Pago total</th>
                                            <th scope="col">Concepto</th>
                                            <th scope="col">Fecha de pago</th>
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


    <!-- Modal Registrar -->
    <div class="modal fade" id="modal_pagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col mt-2">
                            <label for="inp_cantidad_pagada">Pago recibido <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input  class="form-control" id="inp_cantidad_pagada" type="number" placeholder="0.00" required name="price" min="0.00" value="" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col mt-2" id="group_or_client">
                            <label for="inp_concepto">Concepto <span class="text-danger" title="Campo obligatorio">*</span></label>
                            <textarea class="form-control" id="inp_concepto" rows="3" required></textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="false" id="cb_multa">
                                <label class="form-check-label" for="cb_multa" id="label_multa"> 
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_guardar_pago">Guardar</button>
                </div>
            </div>
        </div>
    </div>


   


    <?php include 'templates/footer.php' ?>
  </div>

  <?php include 'templates/scripts.php' ?>
  <script src="js/auth.js"></script>
  <script src="js/pagos.js"></script>


</body>

</html>