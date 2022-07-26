var inp_multa_cantidad_editar = $("#inp_multa_cantidad_editar");
var btn_guardar_editar_multa = $("#btn_guardar_editar_multa");

var tabla_multa;
var multaEditarId;

$(document).ready(function () {
  tabla_multa = $("#tabla_multa").DataTable({
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
  });

  getConfiguracionMulta();
});

$('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  var target = $(e.target).attr("href"); // activated tab

  if (target == "#abonosconfig") {
    getConfiguracionAbonos();
  } else if (target == "#semanasconfig") {
    getConfiguracionSemanas();
    llenarSelectTipoAbonos();
  } else if (target == "#multaconfig") {
  }
});

function getConfiguracionMulta() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO MULTA...</h4>",
    css: { backgroundColor: null, color: "#fff", border: null },
  });

  var datasend = {
    func: "index",
    tipo: "multa",
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        tabla_multa.clear();
        for (var i = 0; i < response.data.length; i++) {
          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Activo</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-danger">Inactivo</span>';
          }

          tabla_multa.row.add([
            "$ " + response.data[i].cantidad,
            status,
            `                                                                                            
                        <button class="btn btn-warning btn_editar_multa" onclick="modalEditarMulta(this, ${
                          response.data[i].id
                        }, ${
              response.data[i].cantidad
            })" title="Editar multa" data-toggle="modal" data-target="#modal_editar_multa"><i class="fa-solid fa-pen-to-square" ></i></button>
                         ${
                           response.data[i].status == 1
                             ? `<button class="btn btn-danger btn_desactivar_multa" onclick="desactivarMulta( ${response.data[i].id})" title="Desactivar multa"><i class="fa-solid fa-ban" ></i></button>`
                             : `<button class="btn btn-success btn_activar_multa" onclick="activarMulta(${response.data[i].id})" title="Activar multa"><i class="fa-regular fa-circle-check"></i></button>`
                         }
                        `,
          ]);
        }
        tabla_multa.draw();
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

function modalEditarMulta(e, id, cantidad) {
  multaEditarId = id;

  inp_multa_cantidad_editar.val((Math.round(cantidad * 100) / 100).toFixed(2));
}

btn_guardar_editar_multa.click(function () {
  if (inp_multa_cantidad_editar.val() == "") {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    editarMulta(multaEditarId, inp_multa_cantidad_editar.val());
  }
});

function editarMulta(id, cantidad) {
  var datasend = {
    func: "editMulta",
    id,
    cantidad,
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        $("#modal_editar_multa").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Multa editada",
          text: "Se ha editado la multa correctamente",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });

        getConfiguracionMulta();
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

function desactivarMulta(id) {
  Swal.fire({
    title: "¿Quieres desactivar la multa?",
    text: "No aparecera por defecto en los campos que la requieran",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify({
          func: "desactivarMulta",
          id,
        }),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Multa desactivada",
              text: "Se ha desactivado la multa",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            });
            getConfiguracionMulta();
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

function activarMulta(id) {
  Swal.fire({
    title: "¿Quieres activar la multa?",
    text: "Aparecera por defecto en los campos que la requieran",
    showCancelButton: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify({
          func: "activarMulta",
          id,
        }),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Multa activada",
              text: "Se ha activado la multa",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            });
            getConfiguracionMulta();
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
