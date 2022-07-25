URL = "php/Perfiles/App.php";

var inp_nombre_perfil = $("#inp_nombre_perfil");
var inp_editar_nombre_perfil = $("#inp_editar_nombre_perfil");

var btn_guardar_perfil = $("#btn_guardar_perfil");
var btn_guardar_editar_perfil = $("#btn_guardar_editar_perfil");

var btn_agregar_modulo = $('#btn_agregar_modulo')
var btn_editar_agregar_modulo = $('#btn_editar_agregar_modulo')

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

  $(`#select_modulos_registrar_0`).select2({
    theme: "bootstrap4",
    width: "100%",
    dropdownParent: $("#modal_registrar_perfil"),
  });

  getPerfiles();
  getModulos();
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
            response.data[i].modulos,
            response.data[i].tipo_perfil,
            `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarPerfil(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\', \'${response.data[i].tipo_perfil}\', \'${response.data[i].modulos_id}\', \'${response.data[i].modulos}\')" title="Editar perfil" data-toggle="modal" data-target="#modal_editar_perfil"><i class="fa-solid fa-pen-to-square" ></i></button>
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

function modalEditarPerfil(e, id, nombre_perfil, tipo_perfil, modulos_id, modulos) {

  inp_editar_nombre_perfil.val($.trim(nombre_perfil));
  idPerfilEditar = id;
  perfilTipo = tipo_perfil;

  /*$(`#select_editar_tipo_perfil option[value='${tipo_perfil}']`).prop(
    "selected",
    true
  );*/

  $("#modal_body_editar_perfil")
    .children()
    .not("#contenedor_inp_editar_nombre_perfil")
    .not('#contenedor_select_editar_tipo_perfil')
    .empty();
  $("#modal_body_editar_perfil").append(`
        <div class="form-group mt-2">
            <label for="select_modulos_editar">Modulo(s) <span class="text-danger" title="Campo obligatorio">*</span></label>
            <select class="form-control select_modulos_editar" id="select_modulos_editar_0" >
                <option selected value="0" >Seleccionar modulo</option>
            </select>
        </div>
    `);

  for (var i = 0; i < modulos_id.split(",").length; i++) {
    if (i > 0) {
      $("#modal_body_editar_perfil").append(`
                <div class="form-group mt-2" >
                    <div class="d-flex flex-row "id="contenedor_select_${i}" >
                        <select class="form-control select_modulos_editar" style="width: 80%" id="select_modulos_editar_${i}" >
                        <option selected value="0" >Seleccionar modulo ${i}</option>
                        </select>
                        <button class="btn btn-light btn-block btn-sm remover" style="width: 20%" >Remover</button>
                    </div>
                </div>
            `);
    }

    $(`#select_modulos_editar_${i}`).select2({
      theme: "bootstrap4",
      width: "100%",
      dropdownParent: $("#modal_editar_perfil"),
    });

    llenarSelectEditar(`select_modulos_editar_${i}`, modulos.split(",")[i]);
  }

  if (
    $(".select_empleados_perfil").toArray().length >
    modulos_id.split(",").length
  ) {
    $(`#contenedor_select_${i}`).parent("div").remove();
  }


}



function llenarSelectEditar(select_id, optionSelect) {
  var datasend = {
    func: "modulosActivos",
  };

  $.ajax({
    type: "POST",
    url: "php/Modulos/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $(`#${select_id}`).empty();
        $(`#${select_id}`).append(`
                    <option value="0" >Seleccionar modulo</option>
                `);
        for (var i = 0; i < response.data.length; i++) {
          $(`#${select_id}`).append(`
                        <option name="${response.data[i].nombre_modulo}" value="${response.data[i].id}">${response.data[i].nombre_modulo} </option>
                    `);

          if ($.trim(optionSelect) == response.data[i].nombre_modulo) {
            $(`#${select_id} option[name='${$.trim(optionSelect)}']`).attr(
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


btn_guardar_perfil.click(function () {
  var arrayModulos = [];
  var camposValidos = false;

  for (var i = 0; i < $(".select_modulos").toArray().length; i++) {
    if (
      inp_nombre_perfil.val() == "" ||
      $(`#select_modulos_registrar_${i} option:selected`).val() == 0
    ) {
      Swal.fire({
        icon: "warning",
        title: "Campos vacios",
        text: "Necesitas llenar todos los campos",
        timer: 1000,
        showCancelButton: false,
        showConfirmButton: false,
      });
      camposValidos = false;

    } else {
      modulo_id = $(`#select_modulos_registrar_${i} option:selected`).val();

      camposValidos = true;
    }
  }

  if (camposValidos) {
    $(".select_modulos option:selected").each(function () {
      var id = $(this).val();
      arrayModulos.push(id);
    });

    tipo_perfil = $(`#select_tipo_perfil option:selected`).val();
    registrarPerfil(inp_nombre_perfil.val(), tipo_perfil, arrayModulos);

  }
});

function registrarPerfil(nombre_perfil, tipo_perfil, modulos) {
  var datasend = {
    func: "create",
    nombre_perfil,
    tipo_perfil,
    modulos
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
  var arrayModulos = [];
  var camposValidos = false;

  for (var i = 0; i < $(".select_modulos_editar").toArray().length; i++) {
    if (
      inp_editar_nombre_perfil.val() == "" ||
      $(`#select_modulos_editar_${i} option:selected`).val() == 0
    ) {
      Swal.fire({
        icon: "warning",
        title: "Campos vacios",
        text: "Necesitas llenar todos los campos",
        timer: 1000,
        showCancelButton: false,
        showConfirmButton: false,
      });
      camposValidos = false;
    } else {
      modulo_id = $(`#select_modulos_editar_${i} option:selected`).val();
      camposValidos = true;
    }
  }

  if (camposValidos) {
    $(".select_modulos_editar option:selected").each(function () {
      var id = $(this).val();
      arrayModulos.push(id);
    });

    tipo_perfil = $(`#select_editar_tipo_perfil option:selected`).val();
    editarPerfil(idPerfilEditar, inp_editar_nombre_perfil.val(), tipo_perfil, arrayModulos);
  }

});

function editarPerfil(id, nombre_perfil, tipo_perfil, modulos) {
  var datasend = {
    func: "edit",
    id,
    nombre_perfil,
    tipo_perfil,
    modulos
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


var x = 1;
btn_agregar_modulo.click(function (e) {
  e.preventDefault();

  $("#modal_body_registrar_perfil").append(`
            <div class="form-group mt-2">
                <div class="d-flex flex-row">
                    <select class="form-control select_modulos" style="width: 80%" id="select_modulos_registrar_${x}" >
                    <option selected value="0" >Seleccionar modulo</option>
                    </select>
                    <button class="btn btn-light btn-block btn-sm remover" style="width: 20%" >Remover</button>
                </div>
            </div>
        `);

  $(`#select_modulos_registrar_${x}`).select2({
    theme: "bootstrap4",
    width: "100%",
    dropdownParent: $("#modal_registrar_perfil"),
  });

  llenarSelect(`select_modulos_registrar_${x}`);
  x++;
});

$("#modal_body_registrar_perfil").on("click", ".remover", function (e) {
  e.preventDefault();
  $(this).parent("div").remove();
  x--;
});


var y;
btn_editar_agregar_modulo.click(function (e) {
  y = $(".select_modulos_editar").toArray().length;

  e.preventDefault();

  $("#modal_body_editar_perfil").append(`
        <div class="form-group mt-2">
            <div class="d-flex flex-row">
                <select class="form-control select_modulos_editar" style="width: 80%" id="select_modulos_editar_${y}" >
                <option selected value="0" >Seleccionar modulo</option>
                </select>
                <button class="btn btn-light btn-block btn-sm remover" style="width: 20%" >Remover</button>
            </div>
        </div>
    `);

  $(`#select_modulos_editar_${y}`).select2({
    theme: "bootstrap4",
    width: "100%",
    dropdownParent: $("#modal_editar_perfil"),
  });

  llenarSelect(`select_modulos_editar_${y}`);
  y++;
});

$("#modal_body_editar_perfil").on("click", ".remover", function (e) {
  e.preventDefault();
  $(this).parent("div").remove();
  y--;
});

function llenarSelect(select_id) {
  var datasend = {
    func: "modulosActivos",
  };

  $.ajax({
    type: "POST",
    url: "php/Modulos/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $(`#${select_id}`).empty();
        $(`#${select_id}`).append(`
                    <option value="0" >Seleccionar modulo</option>
                `);
        for (var i = 0; i < response.data.length; i++) {
          $(`#${select_id}`).append(`
                        <option name="${response.data[i].nombre_modulo}" value="${response.data[i].id}">${response.data[i].nombre_modulo}</option>
                    `);
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


function getModulos(){

  var datasend = {
    func: "modulosActivos",
  };

  $.ajax({
    type: "POST",
    url: "php/Modulos/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $(`#select_modulos_registrar_0`).empty();
        $(`#select_modulos_registrar_0`).append(`
                    <option value="0" >Seleccionar modulo</option>
                `);
        for (var i = 0; i < response.data.length; i++) {
          $(`#select_modulos_registrar_0`).append(`
                        <option name="${response.data[i].nombre_modulo}" value="${response.data[i].id}">${response.data[i].nombre_modulo}</option>
                    `);
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