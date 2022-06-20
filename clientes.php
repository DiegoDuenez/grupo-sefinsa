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
                
            
            <div class="d-flex mt-2 w-100 flex-row justify-content-between">
                <input class="form-control w-25" id="search_filter" placeholder="Buscar Cliente..."/>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_registrar_localidad">Registrar Cliente</button>
            </div>
            <table class="table mt-2" id="tabla_localidades" >
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Garantías</th>
                    <th scope="col">Comprobantes</th>
                    <th scope="col">Otras referencias</th>
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
    <div class="modal fade" id="modal_registrar_localidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="inp_nombre_localidad">Nombre Cliente</label>
                        <input class="form-control" id="inp_nombre_localidad" placeholder="Nombre Cliente" autofocus required/>
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
                <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="form-group mt-2">
                        <label for="inp_editar_nombre_localidad">Nombre Cliente</label>
                        <input class="form-control" id="inp_editar_nombre_localidad" placeholder="Nombre Cliente" autofocus required/>
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
    <script src="js/clientes.js"></script>

</body>

</html>