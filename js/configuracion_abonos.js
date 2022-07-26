URL = "php/Configuraciones/App.php";

var inp_abono_cantidad = $("#inp_abono_cantidad");
var select_abono_tipo_cantidad = $("#select_abono_tipo_cantidad");
var inp_abono_cantidad_con_tipo = $("#inp_abono_cantidad_con_tipo");
var select_tipo = $("#select_tipo");
var inp_tipo = $("#inp_tipo");
var inp_cantidad_pagada = $("#inp_cantidad_pagada");
var inp_abono_cantidad_editar = $("#inp_abono_cantidad_editar");
var select_abono_tipo_cantidad_editar = $("#select_abono_tipo_cantidad_editar");
var inp_abono_cantidad_con_tipo_editar = $(
  "#inp_abono_cantidad_con_tipo_editar"
);
var select_tipo_editar = $("#select_tipo_editar");
var inp_tipo_editar = $("#inp_tipo_editar");
var inp_cantidad_pagada_editar = $("#inp_cantidad_pagada_editar");

var btn_guardar_abono = $("#btn_guardar_abono");
var btn_guardar_editar_abono = $("#btn_guardar_editar_abono");

var table_abonos;
var abonoEditarId = "";

$(document).ready(function () {
  table_abonos = $("#tabla_abonos").DataTable({
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
    aaSorting: [],
    /*"columnDefs": [
            { "visible": false, "targets": -1 }
          ],
          order: [[7, 'desc']],*/
  });

  getConfiguracionAbonos();
});

// INPUTS EN MODAL REGISTRAR

inp_abono_cantidad.on("input", function () {
  if (
    $("#select_abono_tipo_cantidad option:selected").val() == "$" &&
    $(this).val() != ""
  ) {
    inp_abono_cantidad_con_tipo.val(
      select_abono_tipo_cantidad.val() + $(this).val()
    );
    inp_tipo.val("Por cada");
    inp_cantidad_pagada.val("0.00");
    inp_cantidad_pagada.prop("disabled", false);
  } else if (
    $("#select_abono_tipo_cantidad option:selected").val() == "%" &&
    $(this).val() != ""
  ) {
    inp_abono_cantidad_con_tipo.val(
      $(this).val() + select_abono_tipo_cantidad.val()
    );
    inp_tipo.val("De");
    inp_cantidad_pagada.val("Monto prestado");
    inp_cantidad_pagada.prop("disabled", "disabled");
  } else {
    inp_abono_cantidad_con_tipo.val("");
    inp_tipo.val("");
  }
});

select_abono_tipo_cantidad.on("change", function () {
  if ($(this).val() == "$" && inp_abono_cantidad_con_tipo.val().includes("%")) {
    inp_abono_cantidad_con_tipo.val(
      inp_abono_cantidad_con_tipo.val().slice(0, -1) + ""
    );
    inp_abono_cantidad_con_tipo.val($(this).val() + inp_abono_cantidad.val());
    inp_tipo.val("Por cada");
    inp_cantidad_pagada.val("0.00");
    inp_cantidad_pagada.prop("disabled", false);
  } else if (
    $(this).val() == "%" &&
    inp_abono_cantidad_con_tipo.val().includes("$")
  ) {
    inp_abono_cantidad_con_tipo.val().substring(1);
    inp_abono_cantidad_con_tipo.val(inp_abono_cantidad.val() + $(this).val());
    inp_tipo.val("De");
    inp_cantidad_pagada.val("Monto presto");
    inp_cantidad_pagada.prop("disabled", "disabled");
  }
});

// INPUTS EN MODAL EDITAR

inp_abono_cantidad_editar.on("input", function () {
  if (
    $("#select_abono_tipo_cantidad_editar option:selected").val() == "$" &&
    $(this).val() != ""
  ) {
    inp_abono_cantidad_con_tipo_editar.val(
      select_abono_tipo_cantidad_editar.val() + $(this).val()
    );
    inp_tipo_editar.val("Por cada");
    inp_cantidad_pagada_editar.val("0.00");
    inp_cantidad_pagada_editar.prop("disabled", false);
  } else if (
    $("#select_abono_tipo_cantidad_editar option:selected").val() == "%" &&
    $(this).val() != ""
  ) {
    inp_abono_cantidad_con_tipo_editar.val(
      $(this).val() + select_abono_tipo_cantidad_editar.val()
    );
    inp_tipo_editar.val("De");
    inp_cantidad_pagada_editar.val("Monto prestado");
    inp_cantidad_pagada_editar.prop("disabled", "disabled");
  } else {
    inp_abono_cantidad_con_tipo_editar.val("");
    inp_tipo_editar.val("");
  }
});

select_abono_tipo_cantidad_editar.on("change", function () {
  if (
    $(this).val() == "$" &&
    inp_abono_cantidad_con_tipo_editar.val().includes("%")
  ) {
    inp_abono_cantidad_con_tipo_editar.val(
      inp_abono_cantidad_con_tipo_editar.val().slice(0, -1) + ""
    );
    inp_abono_cantidad_con_tipo_editar.val(
      $(this).val() + inp_abono_cantidad_editar.val()
    );
    inp_tipo_editar.val("Por cada");
    inp_cantidad_pagada_editar.val("0.00");
    inp_cantidad_pagada_editar.prop("disabled", false);
  } else if (
    $(this).val() == "%" &&
    inp_abono_cantidad_con_tipo_editar.val().includes("$")
  ) {
    inp_abono_cantidad_con_tipo_editar.val().substring(1);
    inp_abono_cantidad_con_tipo_editar.val(
      inp_abono_cantidad_editar.val() + $(this).val()
    );
    inp_tipo_editar.val("De");
    inp_cantidad_pagada_editar.val("Monto presto");
    inp_cantidad_pagada_editar.prop("disabled", "disabled");
  }
});

function getConfiguracionAbonos() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO ABONOS...</h4>",
    css: { backgroundColor: null, color: "#fff", border: null },
  });

  var datasend = {
    func: "index",
    tipo: "abonos",
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        table_abonos.clear();
        for (var i = 0; i < response.data.length; i++) {
          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Activo</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-danger">Inactivo</span>';
          }

          var tipo_cantidad;

          if (response.data[i].tipo_cantidad == "%") {
            tipo_cantidad = "Porcentaje (%)";
          } else {
            tipo_cantidad = "Peso ($)";
          }

          table_abonos.row.add([
            response.data[i].cantidad,
            tipo_cantidad,
            response.data[i].descripcion,
            status,
            `
                        <button class="btn btn-warning btn_editar_abono" onclick="modalEditarAbono(this, ${
                          response.data[i].id
                        }, ${response.data[i].cantidad},  \'${
              response.data[i].tipo_cantidad
            }\', \'${response.data[i].descripcion}\', \'${
              response.data[i].de
            }\', ${
              response.data[i].por_cada
            } )" title="Editar abono" data-toggle="modal" data-target="#modal_editar_abono"><i class="fa-solid fa-pen-to-square" ></i></button>
                         ${
                           response.data[i].status == 1
                             ? `<button class="btn btn-danger btn_desactivar_abono" onclick="desactivarAbono( ${response.data[i].id})" title="Desactivar abono"><i class="fa-solid fa-ban" ></i></button>`
                             : `<button class="btn btn-success btn_activar_abono" onclick="activarAbono(${response.data[i].id})" title="Activar abono"><i class="fa-regular fa-circle-check"></i></button>`
                         }
                        `,
            response.data[i].created_at,
          ]);
        }
        table_abonos.draw();
      }
    },
    error: function (e) {
      console.log(e);
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

btn_guardar_abono.click(function () {
  if (
    inp_abono_cantidad.val() == "" ||
    inp_cantidad_pagada.val() == "" ||
    inp_cantidad_pagada.val() == "0.00"
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
    tipo = $("#select_abono_tipo_cantidad option:selected").val();

    if (inp_cantidad_pagada.val() != "Monto prestado") {
      descripcion =
        inp_abono_cantidad_con_tipo.val() +
        " " +
        inp_tipo.val() +
        " $" +
        inp_cantidad_pagada.val();
      registrarAbono(
        inp_abono_cantidad.val(),
        tipo,
        descripcion,
        null,
        inp_cantidad_pagada.val()
      );
    } else {
      descripcion =
        inp_abono_cantidad_con_tipo.val() +
        " " +
        inp_tipo.val() +
        " " +
        inp_cantidad_pagada.val();
      registrarAbono(
        inp_abono_cantidad.val(),
        tipo,
        descripcion,
        inp_cantidad_pagada.val(),
        null
      );
    }
  }
});

function registrarAbono(
  cantidad,
  tipo_cantidad,
  descripcion,
  de = null,
  por_cada = null
) {
  var datasend = {
    func: "createAbono",
    cantidad,
    tipo_cantidad,
    descripcion,
    de,
    por_cada,
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $("#modal_registrar_abono").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Nuevo abono registrado",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });

        getConfiguracionAbonos();
      }
    },
    error: function (e) {
      console.log(e);
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}

function modalEditarAbono(
  e,
  id,
  cantidad,
  tipo_cantidad,
  descripcion,
  de = null,
  por_cada = null
) {
  abonoEditarId = id;
  inp_abono_cantidad_editar.val(cantidad);

  $("#select_abono_tipo_cantidad_editar > option").each(function () {
    if (this.value == tipo_cantidad) {
      $(this).attr("selected", "selected");
    } else {
      $(this).attr("selected", false);
    }
  });

  if (de != "null") {
    inp_tipo_editar.val("De");
    inp_cantidad_pagada_editar.val("Monto prestado");
    inp_abono_cantidad_con_tipo_editar.val(cantidad + tipo_cantidad);
    inp_cantidad_pagada_editar.prop("disabled", "disabled");
  } else if (por_cada != null) {
    inp_tipo_editar.val("Por cada");
    inp_abono_cantidad_con_tipo_editar.val(tipo_cantidad + cantidad);
    inp_cantidad_pagada_editar.val(por_cada);
    inp_cantidad_pagada_editar.prop("disabled", false);
  }
}

btn_guardar_editar_abono.click(function () {
  if (
    inp_abono_cantidad_editar.val() == "" ||
    inp_cantidad_pagada_editar.val() == "" ||
    inp_cantidad_pagada_editar.val() == "0.00"
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Necesitas llenar sstodos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    tipo = $("#select_abono_tipo_cantidad_editar option:selected").val();

    if (inp_cantidad_pagada_editar.val() != "Monto prestado") {
      descripcion =
        inp_abono_cantidad_con_tipo_editar.val() +
        " " +
        inp_tipo_editar.val() +
        " $" +
        inp_cantidad_pagada_editar.val();
      editarAbono(
        abonoEditarId,
        inp_abono_cantidad_editar.val(),
        tipo,
        descripcion,
        null,
        inp_cantidad_pagada_editar.val()
      );
    } else {
      descripcion =
        inp_abono_cantidad_con_tipo_editar.val() +
        " " +
        inp_tipo_editar.val() +
        " " +
        inp_cantidad_pagada_editar.val();
      editarAbono(
        abonoEditarId,
        inp_abono_cantidad_editar.val(),
        tipo,
        descripcion,
        inp_cantidad_pagada_editar.val(),
        null
      );
    }
  }
});

function editarAbono(
  id,
  cantidad,
  tipo_cantidad,
  descripcion,
  de = null,
  por_cada = null
) {
  var datasend = {
    func: "editAbono",
    id,
    cantidad,
    tipo_cantidad,
    descripcion,
    de,
    por_cada,
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $("#modal_editar_abono").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Abono editado",
          text: "El abono se ha editado correctamente",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });

        getConfiguracionAbonos();
      }
    },
    error: function (e) {
      console.log(e);
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}

function desactivarAbono(id) {
  Swal.fire({
    title: "¿Quieres desactivar el abono?",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify({
          func: "desactivarAbono",
          id,
        }),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Abono desactivado",
              text: "Se ha desactivado el abono",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            });
            getConfiguracionAbonos();
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

function activarAbono(id) {
  Swal.fire({
    title: "¿Quieres activar el abono?",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify({
          func: "activarAbono",
          id,
        }),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Abono activado",
              text: "Se ha activado el abono",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            });
            getConfiguracionAbonos();
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
