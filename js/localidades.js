URL = "php/Poblaciones/App.php";

inp_editar_nombre_localidad = $("#inp_editar_nombre_localidad");
inp_nombre_localidad = $("#inp_nombre_localidad");
inp_primer_hora = $("#inp_primer_hora");
inp_segunda_hora = $("#inp_segunda_hora");
inp_monto_multa = $("#inp_monto_multa");
inp_grupo = $("#inp_grupo");
inp_editar_grupo = $("#inp_editar_grupo");
inp_editar_primer_hora = $("#inp_editar_primer_hora");
inp_editar_segunda_hora = $("#inp_editar_segunda_hora");
inp_editar_monto_multa = $("#inp_editar_monto_multa");
var inp_semanas = $("#inp_semanas");
var inp_editar_semanas = $("#inp_editar_semanas");

btn_guardar_localidad = $("#btn_guardar_localidad");
btn_guardar_editar_localidad = $("#btn_guardar_editar_localidad");

idLocalidadEditar = 0;
rutaLocalidad = "";
var table;

$(document).ready(function () {
  table = $("#tabla_localidades").DataTable({
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
    order: [[6, "desc"]],
  });

  getLocalidades();
  getRutas();

  $("#select_rutas_registrar").select2({
    theme: "bootstrap4",
    width: "100%",
    dropdownParent: $("#modal_registrar_localidad"),
  });
  $("#select_rutas_editar").select2({
    theme: "bootstrap4",
    width: "100%",
    dropdownParent: $("#modal_editar_localidad"),
  });

  inp_primer_hora.datetimepicker({
    format: "HH:mm:ss",
    date: globalFechaInicial,
    locale: "es-MX",
  });

  inp_segunda_hora.datetimepicker({
    format: "HH:mm:ss",
    date: globalFechaFinal,
    locale: "es-MX",
  });

  inp_editar_primer_hora.datetimepicker({
    format: "HH:mm:ss",
    date: globalFechaFinal,
    locale: "es-MX",
  });

  inp_editar_segunda_hora.datetimepicker({
    format: "HH:mm:ss",
    date: globalFechaFinal,
    locale: "es-MX",
  });
});

function getLocalidades() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO POBLACIONES...</h4>",
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
          var horario = `
                    ${response.data[i].primer_dia_cobro} de ${
            response.data[i].primer_hora_limite
          } ${
            response.data[i].primer_hora_limite >= "00:00:00" &&
            response.data[i].primer_hora_limite <= "11:59:59"
              ? "AM"
              : "PM"
          } a ${response.data[i].segunda_hora_limite} ${
            response.data[i].segunda_hora_limite >= "00:00:00" &&
            response.data[i].segunda_hora_limite <= "11:59:59"
              ? "AM"
              : "PM"
          }
                    `;

          table.row.add([
            response.data[i].nombre_ruta,
            response.data[i].nombre_poblacion,
            response.data[i].grupo,
            horario,
            "$ " + response.data[i].monto_multa,
            `
                        <button class="btn btn-warning btn_editar_ruta" onclick="modalEditarLocalidad(this, ${response.data[i].id}, \'${response.data[i].nombre_ruta}'\, \'${response.data[i].primer_hora_limite}'\, \'${response.data[i].segunda_hora_limite}'\, \'${response.data[i].monto_multa}'\, \'${response.data[i].primer_dia_cobro}\', \'${response.data[i].nombre_poblacion}\', \'${response.data[i].grupo}\', ${response.data[i].semanas_pago})" title="Editar localidad" data-toggle="modal" data-target="#modal_editar_localidad"><i class="fa-solid fa-pen-to-square" ></i></button>
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

function getRutas() {
  var datasend = {
    func: "rutasActivas",
  };

  $.ajax({
    type: "POST",
    url: "php/Rutas/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $(".select_rutas").empty();
        $(".select_rutas").append(`
                    <option value="0" >Seleccionar ruta</option>
                `);
        for (var i = 0; i < response.data.length; i++) {
          $(".select_rutas").append(`
                        <option name="${response.data[i].nombre_ruta}" value="${response.data[i].id}">${response.data[i].nombre_ruta}</option>
                    `);

          if (rutaLocalidad != "") {
            $(`.select_rutas.editar option[name='${rutaLocalidad}']`).attr(
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

function modalEditarLocalidad(
  e,
  id,
  ruta,
  primer_hora_limite,
  segunda_hora_limite,
  monto_multa,
  primer_dia_cobro,
  nombre_poblacion,
  grupo,
  semanas
) {
  inp_editar_nombre_localidad.val($.trim(nombre_poblacion));
  inp_editar_monto_multa.val($.trim(monto_multa));
  inp_editar_primer_hora.val($.trim(primer_hora_limite));
  inp_editar_segunda_hora.val($.trim(segunda_hora_limite));
  inp_editar_monto_multa.val($.trim(monto_multa));
  inp_editar_grupo.val($.trim(grupo));
  inp_editar_semanas.val($.trim(semanas));
  idLocalidadEditar = id;
  rutaLocalidad = ruta;

  $(`#select_editar_primer_dia option[value='${primer_dia_cobro}']`).prop(
    "selected",
    true
  );

  getRutas();
}

btn_guardar_localidad.click(function () {
  if (
    inp_nombre_localidad.val() == "" ||
    $(`.select_rutas option:selected`).val() == 0 ||
    inp_grupo.val() == "" ||
    inp_grupo.val() == 0 ||
    inp_primer_hora.val() == "" ||
    inp_segunda_hora.val() == "" ||
    inp_monto_multa.val() < 0
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    ruta_id = $(`.select_rutas option:selected`).val();
    dia_cobro = $("#select_primer_dia option:selected").val();
    //segundo_dia_cobro = $('#select_segundo_dia option:selected').val()

    registrarLocalidad(
      inp_nombre_localidad.val(),
      ruta_id,
      inp_primer_hora.val(),
      inp_segunda_hora.val(),
      inp_monto_multa.val(),
      dia_cobro,
      inp_grupo.val(),
      inp_semanas.val()
    );
  }
});

function registrarLocalidad(
  nombre_localidad,
  ruta_id,
  primer_hora_limite,
  segunda_hora_limite,
  monto_multa,
  dia_cobro,
  grupo,
  semanas
) {
  var datasend = {
    func: "create",
    nombre_localidad,
    ruta_id,
    primer_hora_limite,
    segunda_hora_limite,
    monto_multa,
    dia_cobro,
    grupo,
    semanas,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_registrar_localidad").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Nueva población",
          text: "Se ha registrado la población",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getLocalidades();
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

btn_guardar_editar_localidad.click(function () {
  if (
    inp_editar_nombre_localidad.val() == "" ||
    $(`.select_rutas.editar option:selected`).val() == 0 ||
    inp_editar_grupo.val() == "" ||
    inp_editar_grupo.val() == 0 ||
    inp_editar_primer_hora.val() == "" ||
    inp_editar_segunda_hora.val() == "" ||
    inp_editar_monto_multa.val() < 0
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    var ruta_id = $(`.select_rutas.editar option:selected`).val();
    var dia_cobro = $("#select_editar_primer_dia option:selected").val();

    editarLocalidad(
      inp_editar_nombre_localidad.val(),
      ruta_id,
      idLocalidadEditar,
      inp_editar_primer_hora.val(),
      inp_editar_segunda_hora.val(),
      inp_editar_monto_multa.val(),
      dia_cobro,
      inp_editar_grupo.val(),
      inp_editar_semanas.val()
    );
  }
});

function editarLocalidad(
  nombre_localidad,
  ruta_id,
  id,
  primer_hora_limite,
  segunda_hora_limite,
  monto_multa,
  dia_cobro,
  grupo,
  semanas
) {
  localidad = {
    func: "edit",
    nombre_localidad,
    ruta_id,
    id,
    primer_hora_limite,
    segunda_hora_limite,
    monto_multa,
    dia_cobro,
    grupo,
    semanas,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(localidad),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_editar_localidad").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Población actualizada",
          text: "Se ha editado la localidad",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getLocalidades();
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
    title: "¿Quieres desactivar la localidad?",
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
              title: "Población desactivada",
              text: "Se ha desactivado la localidad",
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
    title: "¿Quieres activar la localidad?",
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
              title: "Población activada",
              text: "Se ha activado la localidad",
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
