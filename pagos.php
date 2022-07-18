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

    <style>
        /*.sum_pago_pendiente {
            color: red;
        }*/
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'templates/navbar.php' ?>
        <?php include 'templates/sidebar.php' ?>

        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">

                

                <div class="row p-2">
                    <div class="d-flex mt-2 w-100" style="gap: 1rem;">
                        <div class="form-group" style="width: 30%">
                            <label for="select_clientes_filtro">Filtrar por cliente</label>
                            <select class="form-control select_clientes_filtro"  id="select_clientes_filtro"  style="width:50%;">
                                <option value="0">General</option>
                            </select>
                        </div>

                        <div class="form-group" style="width: 30%">
                            <label for="select_clientes_prestamos_filtro">Filtrar por prestamo</label>
                            <select class="form-control select_clientes_prestamos_filtro"  id="select_clientes_prestamos_filtro"  style="width:50%;" disabled>
                                <option value="0">General</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="d-flex w-100 flex-row justify-content-end" style="gap: 1rem;">
                        <button type="button" id="btn_excel" class="btn btn-success" title="Exportar pagos a excel"  onclick="tableToExcel('tabla_pagos', 'Hoja1')"><i class="fa-solid fa-file-excel"></i></button>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                            <h3 class="card-title"><i class="fa-solid fa-money-bill"></i> Pagos registrados</h3>
                            </div>
                                <div class="card-body">
                                    <table class="table" id="tabla_pagos">
                                    <thead>
                                        <tr>
                                            <th scope="col">Semana</th>
                                            <th scope="col">Folio</th>
                                            <th scope="col">Nombre del cliente</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col" class="sum_pago_esperado" >Pago</th>
                                            <th scope="col" class="sum_pago_recibido" >Pagado</th>
                                            <th scope="col" class="sum_pago_multa">Multa</th>
                                            <th scope="col" class="sum_pago_pendiente">Pago pendiente</th>
                                            <th scope="col" class="sum_pago_total">Pago total</th>
                                            <th scope="col">Fecha de pago</th>
                                            <th scope="col" class="sum_balance">Balance</th>
                                            <th scope="col">Estatus</th>
                                            <th scope="col">Acciones</th>
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


    <!-- Modal Registrar -->
    <div class="modal fade" id="modal_pagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pagar-tab" data-toggle="tab" href="#pagar" role="tab" aria-controls="pagar" aria-selected="true">Realizar pago</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cuenta-tab" data-toggle="tab" href="#cuenta" role="tab" aria-controls="cuenta" aria-selected="false">Estado de cuenta</a>
                    </li>
                    
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pagar" role="tabpanel" aria-labelledby="pagar-tab">

                        <div class="form-row mt-3">
                            <p class="font-weight-bold">Pago: <span class="font-weight-normal" id="span_pago">$</span></p>
                        </div>

                        <div class="form-row">
                            <div class="form-group col mt-2">
                                <label for="inp_cantidad_pagada">Pago recibido <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input  class="form-control" id="inp_cantidad_pagada" type="number" placeholder="0.00" required name="price" min="0.00" value="" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col mt-2">
                                <label for="inp_folio">Folio <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input  class="form-control" id="inp_folio" type="number" placeholder="Folio de pago" required min="0" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col mt-2">
                                <label for="inp_fecha_pago">Fecha de pago <span class="text-danger" title="Campo obligatorio">*</span></label>
                                <input  class="form-control" id="inp_fecha_pago" type="date" value="<?php echo date('Y-m-d'); ?>" required />
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

                    <div class="tab-pane fade" id="cuenta" role="tabpanel" aria-labelledby="cuenta-tab">

                        <div class="form-row mt-3">
                            <p class="font-weight-bold" id="ec_cliente">Juan Perez</p>
                        </div>
                        <div class="form-row">
                            <div class="d-flex flex-row w-100" style="gap: 2rem;">
                                <p id="ec_ruta">R1</p>
                                <p id="ec_poblacion">Población 1</p>
                                <p id="ec_monto">$8000.00</p>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <p class="font-weight-bold" id="ec_fecha_prestamo">Fecha prestamo: <span class="font-weight-normal" id="span_fecha_prestamo">19/12/2022</span></p>
                        </div>


                        <div class="mt3">
                            <p class="font-weight-bold">Pagos recibidos </p>
                            <table class="table" id="tabla_ec_pagos">
                                <thead>
                                    <tr>
                                        <th scope="col">Semana</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col" class="sum_ec_abono">Abono</th>
                                        <th scope="col" class="sum_ec_multa">Multa</th>
                                        <th scope="col">Estatus</th>
                                    </tr>
                                </thead>
                            <tbody id="table_ec_body">
                            
                            </tbody>
                                <tfoot>
                                    <tr class="thead-dark">
                                        <th>Totales</th>
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary d-none" id="btn_omitir_pago">Omitir pago</button>
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
  <script>
    var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta charset="utf-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        //window.location.href = uri + base64(format(template, ctx))
        var a = document.createElement('a');
        a.href = uri + base64(format(template, ctx))
        a.download = "Prestamos" + '.xls';
        a.click();
    }
    })()

  </script>

</body>

</html>