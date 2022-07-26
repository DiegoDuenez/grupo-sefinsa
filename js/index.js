function iniciarSesion() {
  var usuario = $("#usuario").val();
  var password = $("#password").val();

  if (usuario == "" || password == "") {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Necesitas llenar todos los campos",
    });
  } else {
    $.blockUI({
      message: "<h4> REALIZANDO PETICIÓN...</h4>",
      css: { backgroundColor: null, color: "#fff", border: null },
    });

    var datasend = {
      func: "login",
      usuario,
      password,
    };

    $.ajax({
      type: "POST",
      url: "php/Usuarios/App.php",
      dataType: "json",
      data: JSON.stringify(datasend),
      success: function (response) {
        if (response.status == "success") {
          localStorage.setItem("usuario", JSON.stringify(response.data));
          localStorage.setItem("modulos", response.data.modulos.split());
          Swal.fire({
            icon: "success",
            title: `Bienvenid@ ${response.data.nombre_completo}`,
            allowOutsideClick: false,
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
          }).then(function () {
            window.location = "usuarios.php";
          });
        }
      },
      error: function (e) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: e.responseJSON.message,
        });
      },
      complete: function () {
        $.unblockUI();
      },
    });
  }
}

function keyLogin() {
  if (window.event.keyCode == 13) {
    iniciarSesion();
  }
}
