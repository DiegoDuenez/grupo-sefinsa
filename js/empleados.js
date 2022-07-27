URL = "php/Empleados/App.php";

inp_nombre_completo = $("#inp_nombre_completo");
inp_usuario = $("#inp_usuario");
inp_password = $("#inp_password");

inp_editar_nombre_completo = $("#inp_editar_nombre_completo");
inp_editar_usuario = $("#inp_editar_usuario");
inp_editar_password = $("#inp_editar_password");

btn_guardar_empleado = $("#btn_guardar_empleado");
btn_editar_empleado = $(".btn_editar_empleado");
btn_guardar_editar_empleado = $("#btn_guardar_editar_empleado");
btn_modal_registrar_empleado = $(".btn_modal_registrar_empleado");

cambiarContraseña = false;
idEmpleadoEditar = 0;
empleadoPerfil = "";

var table;

$(document).ready(function () {
  table = $("#tabla_empleados").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 20, "Todos"],
    ],
    language: {
      lengthMenu: "Mostrar _MENU_ registros por página",
      zeroRecords: "No se encontro ningún registro",
      info: "Mostrando página _PAGE_ de _PAGES_",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      sSearch: "Buscar",
      paginate: {
        previous: "Anterior",
        next: "Siguiente",
      },
    },
    columnDefs: [{ visible: false, targets: -1 }],
    order: [[5, "desc"]],
  });

  getEmpleados();
  getPerfiles();
});

btn_modal_registrar_empleado.click(function () {
  $(`.select_perfiles option[value="0"]`).attr("selected", "selected");
});

function getEmpleados() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO EMPLEADOS...</h4>",
    css: { backgroundColor: null, color: "#fff", border: null },
  });

  var datasend = {
    func: "index",
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        table.clear();
        for (var i = 0; i < response.data.length; i++) {
          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Activo</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-danger">Inactivo</span>';
          }

          table.row.add([
            response.data[i].nombre_completo,
            response.data[i].usuario,
            response.data[i].nombre_perfil,
            status,
            `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarUsuario(this, ${
                          response.data[i].id
                        },  \'${response.data[i].nombre_perfil}\', \'${
              response.data[i].nombre_completo
            }\', \'${
              response.data[i].usuario
            }\')" title="Editar empleado" data-toggle="modal" data-target="#modal_editar_empleado"><i class="fa-solid fa-pen-to-square" ></i></button>
                        ${
                          response.data[i].status == 1
                            ? `<button class="btn btn-danger btn_eliminar_usuario" onclick="desactivar( ${response.data[i].id})" title="Desactivar empleado"><i class="fa-solid fa-ban" ></i></button>`
                            : `<button class="btn btn-success btn_activar_usuario" onclick="activar(${response.data[i].id})" title="Activar empleado"><i class="fa-regular fa-circle-check"></i></button>`
                        }

                        `,
            response.data[i].created_at,
          ]);
        }
        table.draw();
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

function getPerfiles() {
  var datasend = {
    func: "perfiles",
    tipo_perfil: "empleado",
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $(".select_perfiles").empty();
        $(".select_perfiles").append(`
                    <option value="0" >Seleccionar perfil</option>
                `);
        for (var i = 0; i < response.data.length; i++) {
          $(".select_perfiles").append(`
                        <option name="${response.data[i].nombre_perfil}" value="${response.data[i].id}">${response.data[i].nombre_perfil}</option>
                    `);

          if (empleadoPerfil != "") {
            $(`.select_perfiles option[name='${empleadoPerfil}']`).attr(
              "selected",
              "selected"
            );
          }
        }
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}

btn_guardar_empleado.click(function () {
  if (
    inp_nombre_completo.val() == "" ||
    inp_usuario.val() == "" ||
    inp_password.val() == "" ||
    $(`.select_perfiles option:selected`).val() == 0
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    perfil_id = $(`.select_perfiles option:selected`).val();

    registrarEmpleado(
      inp_nombre_completo.val(),
      inp_usuario.val(),
      inp_password.val(),
      perfil_id
    );
  }
});

function registrarEmpleado(nombre_completo, usuario, password, perfil_id) {
  var datasend = {
    func: "create",
    nombre_completo,
    usuario,
    password,
    perfil_id,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_registrar_empleado").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Nuevo empleado",
          text: "Se ha registrado al empleado",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getEmpleados();
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}

$("#cb_password").change(function () {
  if (this.checked) {
    inp_editar_password.removeClass("d-none");
    $("#lb_password").removeClass("d-none");
    inp_editar_password.prop("required", false);
    cambiarContraseña = true;
  } else {
    inp_editar_password.addClass("d-none");
    $("#lb_password").addClass("d-none");
    inp_editar_password.prop("required", true);
    cambiarContraseña = false;
  }
});

function modalEditarUsuario(e, id, perfil, nombre_completo, usuario) {
  inp_editar_nombre_completo.val($.trim(nombre_completo));
  inp_editar_usuario.val($.trim(usuario));
  idEmpleadoEditar = id;
  empleadoPerfil = perfil;
  getPerfiles();
}

btn_guardar_editar_empleado.click(function () {
  if (
    inp_editar_nombre_completo.val() == "" ||
    inp_editar_usuario.val() == "" ||
    ($(`.select_perfiles.editar option:selected`).val() == 0 &&
      cambiarContraseña == false)
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else if (
    (cambiarContraseña == true && inp_editar_password.val() == "") ||
    inp_editar_nombre_completo.val() == "" ||
    inp_editar_usuario.val() == "" ||
    $(`.select_perfiles.editar option:selected`).val() == 0
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    perfil_id = $(`.select_perfiles.editar option:selected`).val();
    if (cambiarContraseña == true) {
      editarEmpleado(
        inp_editar_nombre_completo.val(),
        inp_editar_usuario.val(),
        idEmpleadoEditar,
        perfil_id,
        inp_editar_password.val()
      );
    } else {
      editarEmpleado(
        inp_editar_nombre_completo.val(),
        inp_editar_usuario.val(),
        idEmpleadoEditar,
        perfil_id
      );
    }
  }
});

function editarEmpleado(
  nombre_completo,
  usuario,
  id,
  perfil_id,
  password = null
) {
  if (password == null) {
    user = {
      func: "edit",
      nombre_completo,
      usuario,
      id,
      perfil_id,
      changePassword: false,
    };
  } else {
    user = {
      func: "edit",
      nombre_completo,
      usuario,
      id,
      perfil_id,
      changePassword: true,
      password,
    };
  }

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(user),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_editar_empleado").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Empleado actualizado",
          text: "Se ha editado al empleado",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getEmpleados();
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}

function desactivar(id) {
  Swal.fire({
    title: "¿Quieres desactivar al empleado?",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify({
          func: "desactivar",
          id,
        }),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Empleado desactivado",
              text: "Se ha desactivado al empleado",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            });
            getEmpleados();
          }
        },
        error: function (e) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: e.responseJSON.message,
          });
        },
      });
    }
  });
}

function activar(id) {
  Swal.fire({
    title: "¿Quieres activar al empleado?",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify({
          func: "activar",
          id,
        }),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Empleado activado",
              text: "Se ha activado al empleado",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            });
            getEmpleados();
          }
        },
        error: function (e) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: e.responseJSON.message,
          });
        },
      });
    }
  });
}
