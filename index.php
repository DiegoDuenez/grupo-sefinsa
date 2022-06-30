
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.0/css/all.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

</head>
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <span class="fw-bold h1">Iniciar Sesión</span>
        </div>
        <!-- /.login-logo -->
        <div class="card rounded-3 card-outline card-primary shadow">
            <div class="card-body login-card-body">
                <p class="login-box-msg text-sm fst-italic">Ingresa tus datos para iniciar sesión</p>

                <form id="formulario_login" onsubmit="return false">
                    <input type="hidden" id="accion" value="iniciar_sesion">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control rounded-l" id='usuario' name='usuario' placeholder="Usuario" aria-label="Username" aria-describedby="span-usuario" autofocus="autofocus" />
                        <span class="input-group-text" id="span-usuario"><i class="fa-solid fa-user"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id='password' name='contrasenia' placeholder="Contraseña" aria-label="Contrasenia" aria-describedby="span-contrasenia"autocomplete="off" 
                        onkeypress="keyLogin()"/>
                        <span class="input-group-text" id="span-contrasenia"><i class="fa-solid fa-key"></i></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary btn-block fw-bold text-center" id="btnIniciarsesion" onclick="iniciarSesion()">
                                <i class="fa-solid fa-circle-arrow-right"></i>&nbsp;INGRESAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
  <!--<script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.js"></script>

  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="plugins/blockui/jquery.blockui.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>-->
  <?php include 'templates/scripts.php' ?>
  <script src="js/index.js"></script>

</body>
</html>