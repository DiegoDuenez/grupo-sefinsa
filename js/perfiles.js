URL = "php/Perfiles/App.php";

var inp_nombre_perfil = $("#inp_nombre_perfil");
var inp_editar_nombre_perfil = $("#inp_editar_nombre_perfil");

var btn_guardar_perfil = $("#btn_guardar_perfil");
var btn_guardar_editar_perfil = $("#btn_guardar_editar_perfil");

var table;
var idPerfilEditar = 0;
var perfilTipo = "";

$(document).ready(function () {
  table = $("#tabla_perfiles").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 20, "Todos"],
    ],
    language: {
      lengthMenu: "Mostrar _MENU_ registros por pagina",
      zeroRecords: "No se encontro ningún registro",
      info: "Mostrando pagina _PAGE_ de _PAGES_",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      sSearch: "Buscar",
      paginate: {
        previous: "Anterior",
        next: "Siguiente",
      },
    },
    columnDefs: [{ visible: false, targets: -1 }],
    order: [[3, "desc"]],
  });

  getPerfiles();
});

function getPerfiles() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO PERFILES...</h4>",
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
          table.row.add([
            response.data[i].nombre_perfil,
            response.data[i].tipo_perfil,
            `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarPerfil(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\', \'${response.data[i].tipo_perfil}\')" title="Editar perfil" data-toggle="modal" data-target="#modal_editar_perfil"><i class="fa-solid fa-pen-to-square" ></i></button>
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

function modalEditarPerfil(e, id, nombre_perfil, tipo_perfil) {
  inp_editar_nombre_perfil.val($.trim(nombre_perfil));
  idPerfilEditar = id;
  perfilTipo = tipo_perfil;

  $(`#select_editar_tipo_perfil option[value='${tipo_perfil}']`).prop(
    "selected",
    true
  );

  //getRutas()
}

btn_guardar_perfil.click(function () {
  if (inp_nombre_perfil.val() == "") {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    tipo_perfil = $(`#select_tipo_perfil option:selected`).val();

    registrarPerfil(inp_nombre_perfil.val(), tipo_perfil);
  }
});

function registrarPerfil(nombre_perfil, tipo_perfil) {
  var datasend = {
    func: "create",
    nombre_perfil,
    tipo_perfil,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_registrar_perfil").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Nuevo perfil",
          text: "Se ha creado el perfil",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getPerfiles();
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

btn_guardar_editar_perfil.click(function () {
  if (inp_editar_nombre_perfil.val() == "") {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    tipo_perfil = $(`#select_editar_tipo_perfil option:selected`).val();

    editarPerfil(idPerfilEditar, inp_editar_nombre_perfil.val(), tipo_perfil);
  }
});

function editarPerfil(id, nombre_perfil, tipo_perfil) {
  var datasend = {
    func: "edit",
    id,
    nombre_perfil,
    tipo_perfil,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_editar_perfil").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Perfil actualizado",
          text: "Se ha actualizado el perfil",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getPerfiles();
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
