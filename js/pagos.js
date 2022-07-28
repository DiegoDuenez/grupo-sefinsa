URL = "php/Pagos/App.php";

var btn_guardar_pago = $("#btn_guardar_pago");
var inp_cantidad_pagada = $("#inp_cantidad_pagada");
var label_multa = $("#label_multa");
var cb_multa = $("#cb_multa");
var inp_concepto = $("#inp_concepto");
var select_clientes_filtro = $("#select_clientes_filtro");
var select_clientes_prestamos_filtro = $("#select_clientes_prestamos_filtro");
var inp_fecha_pago = $("#inp_fecha_pago");
var btn_omitir_pago = $("#btn_omitir_pago");
var inp_folio = $("#inp_folio");
var span_pago = $("#span_pago");
var ec_monto = $("#ec_monto");
var ec_ruta = $("#ec_ruta");
var ec_poblacion = $("#ec_poblacion");
var ec_cliente = $("#ec_cliente");
var span_fecha_prestamo = $("#span_fecha_prestamo");
var span_balance = $("#span_balance");
var btn_limpiar_filtros = $('#btn_limpiar_filtros')
var pagoId;
var prestamoId;
var montoMulta;
var table;
var clienteIdFiltro;
var prestamoIdFiltro;
var tabla_ec_pagos;
//var tabla_pagos
var semana_renovar_pago_seleccionado;
var modalidad_id_pago_seleccionado;

var config_cantidad_semanas;
var config_semana_renovar;

var card_body_pagos = $('#card_body_pagos')

$(document).ready(function () {
  tabla_ec_pagos = $("#tabla_ec_pagos").DataTable({
    bFilter: false,
    bInfo: false,
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
    pageLength: 5,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 20, "Todos"],
    ],
    aaSorting: [],
    footerCallback: function (row, data, start, end, display) {
      var api = this.api();

      api
        .columns(".sum_ec_abono", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;
            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });

      api
        .columns(".sum_ec_multa", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;
            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });
    },
  });

  table = $("#tabla_pagos").DataTable({
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
    createdRow: function (row, data, index) {
      $("td", row).eq(7).addClass("text-danger").addClass("text-bold");
    },
    columnDefs: [{ visible: false, targets: [] }],
    //order: [[8, 'asc']],
    aaSorting: [],

    footerCallback: function (row, data, start, end, display) {
      var api = this.api();

      api
        .columns(".sum_pago_total", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;

            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });

      api
        .columns(".sum_pago_multa", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;

            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });

      api
        .columns(".sum_pago_recibido", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;

            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });

      api
        .columns(".sum_pago_esperado", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;

            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });

      api
        .columns(".sum_pago_pendiente", {
          page: "current",
        })
        .every(function () {
          var sum = this.data().reduce(function (a, b) {
            a = a.toString().replace(/[$]/g, "");
            b = b.toString().replace(/[$]/g, "");
            a = a.toString().replace(/[,]/g, "");
            b = b.toString().replace(/[,]/g, "");
            var x = parseFloat(a) || 0;
            var y = parseFloat(b) || 0;

            return x + y;
          }, 0);
          $(this.footer()).html(
            "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
          );
        });
    },
  });

  getPagos();
  getClientes();

  select_clientes_filtro.select2({ theme: "bootstrap4", width: "100%" });
  select_clientes_prestamos_filtro.select2({
    theme: "bootstrap4",
    width: "100%",
  });

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  prestamo = urlParams.get("p");
  cliente = urlParams.get("c");
  if (prestamo) {
    /*$(`#collapse${prestamo}`).collapse('toggle');
    alert(prestamo)*/
    //getPagosPrestamo(prestamo);
  }
  /*$('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});

    $('#select_colocadoras_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});
    $('#select_rutas_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});
    $('#select_poblaciones_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});

    
    $('#select_rutas_filtro').select2({theme: 'bootstrap4', width: '100%'});
    $('#select_poblaciones_filtro').select2({theme: 'bootstrap4', width: '100%'});
    $('#select_colocadoras_filtro').select2({theme: 'bootstrap4', width: '100%'});*/
});

/*select_clientes_filtro.on("change", function () {
  clienteIdFiltro = this.value;
  getPrestamosCliente(this.value);
  this.value == 0 ? getPagos() : getPagosCliente(this.value);
});

select_clientes_prestamos_filtro.on("change", function () {
  prestamoIdFiltro = this.value;
  this.value == 0
    ? getPagosCliente(clienteIdFiltro)
    : getPagosPrestamo(this.value);
});*/


btn_limpiar_filtros.click(function(){
    window.location.href = env.local.url + 'pagos.php'
})

function getPrestamosCliente(cliente_id) {
  var datasend = {
    func: "prestamosCliente",
    cliente_id,
  };

  $.ajax({
    type: "POST",
    url: "php/Prestamos/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        if (response.data.length > 0) {
          select_clientes_prestamos_filtro.prop("disabled", false);

          select_clientes_prestamos_filtro.empty();
          select_clientes_prestamos_filtro.append(`
                        <option value="0" >General</option>
                    `);
          for (var i = 0; i < response.data.length; i++) {
            select_clientes_prestamos_filtro.append(`
                            <option name="${response.data[i].id}" value="${response.data[i].id}">${response.data[i].monto_prestado}</option>
                        `);
          }
        } else {
          select_clientes_prestamos_filtro.prop("disabled", true);
          select_clientes_prestamos_filtro.empty();
          select_clientes_prestamos_filtro.append(`
                        <option value="0" >General</option>
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

function getPagosPrestamo(prestamo_id, cliente_id) {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO PAGOS..</h4>",
    css: { backgroundColor: null, color: "#fff", border: null },
  });

  var datasend = {
    func: "pagosPrestamo",
    prestamo_id,
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {

        $(`#tabla_pagos_${cliente_id}`).DataTable().clear().destroy()

        let tabla_pagos = $(`#tabla_pagos_${cliente_id}`).DataTable({
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
            createdRow: function (row, data, index) {
              $("td", row).eq(7).addClass("text-danger").addClass("text-bold");
            },
            columnDefs: [{ visible: false, targets: [] }],
            //order: [[8, 'asc']],
            aaSorting: [],
        
            footerCallback: function (row, data, start, end, display) {
              var api = this.api();
        
              api
                .columns(".sum_pago_total", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_multa", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_recibido", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_esperado", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_pendiente", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
            }})

        tabla_pagos.clear();
        for (var i = 0; i < response.data.length; i++) {
          puedeOmitirUltimaSemana(response.data[i].prestamo_id);

          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Pagado</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-warning">Pendiente</span>';
          } else if (response.data[i].status == -1) {
            status = '<span class="badge badge-danger">No pagó</span>';
          } else if (response.data[i].status == 2) {
            status = '<span class="badge badge-info">Omitido</span>';
          }

          tabla_pagos.row.add([
            response.data[i].semana,
            response.data[i].folio,
            response.data[i].nombre_completo,
            "$ " + response.data[i].monto_prestado,
            "$ " + response.data[i].cantidad_esperada_pago,
            "$ " + response.data[i].cantidad_normal_pagada,
            "$ " + response.data[i].cantidad_multa,
            `$ ${response.data[i].cantidad_pendiente}`,
            "$ " + response.data[i].cantidad_total_pagada,
            moment(response.data[i].fecha_pago).format('DD/MM/YYYY'),
            "$ " + response.data[i].balance,
            status,
            response.data[i].status == 0
              ? `
                        <button class="btn btn-success btn_pagar btn-sm" onclick="modalPagar(\'${response.data[i].id}\', \'${response.data[i].prestamo_id}\', \'${response.data[i].monto_multa}\', \'${response.data[i].cantidad_esperada_pago}\', \'${response.data[i].nombre_completo}\', \'${response.data[i].nombre_ruta}\',\'${response.data[i].nombre_poblacion}\'
                        , \'${response.data[i].monto_prestado}\', \'${response.data[i].fecha_prestamo}\', \'${response.data[i].semana}\', ${response.data[i].modalidad_semanas}, ${response.data[i].balance})" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                        <button class="btn btn-danger btn_no_pagar btn-sm" onclick="noPagar(\'${response.data[i].id}\', \'${response.data[i].monto_multa}\', ${response.data[i].semana})" title="No pagó" ><i class="fa-solid fa-ban"></i></button>
                        `
              : "",
          ]);
        }
        tabla_pagos.draw();
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

function getPagos() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO PAGOS..</h4>",
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
          puedeOmitirUltimaSemana(response.data[i].prestamo_id);

          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Pagado</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-warning">Pendiente</span>';
          } else if (response.data[i].status == -1) {
            status = '<span class="badge badge-danger">No pagó</span>';
          } else if (response.data[i].status == 2) {
            status = '<span class="badge badge-info">Omitido</span>';
          }

          table.row.add([
            response.data[i].semana,
            response.data[i].folio,
            response.data[i].nombre_completo,
            "$ " + response.data[i].monto_prestado,
            "$ " + response.data[i].cantidad_esperada_pago,
            "$ " + response.data[i].cantidad_normal_pagada,
            "$ " + response.data[i].cantidad_multa,
            `$ ${response.data[i].cantidad_pendiente}`,
            "$ " + response.data[i].cantidad_total_pagada,
            moment(response.data[i].fecha_pago).format('DD/MM/YYYY'),
            "$ " + response.data[i].balance,
            status,
            response.data[i].status == 0
              ? `
                        <button class="btn btn-success btn_pagar btn-sm" onclick="modalPagar(\'${response.data[i].id}\', \'${response.data[i].prestamo_id}\', \'${response.data[i].monto_multa}\', \'${response.data[i].cantidad_esperada_pago}\', \'${response.data[i].nombre_completo}\', \'${response.data[i].nombre_ruta}\',\'${response.data[i].nombre_poblacion}\'
                        , \'${response.data[i].monto_prestado}\', \'${response.data[i].fecha_prestamo}\', \'${response.data[i].semana}\', ${response.data[i].modalidad_semanas}, ${response.data[i].balance})" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                        <button class="btn btn-danger btn_no_pagar mt-1 btn-sm" onclick="noPagar(\'${response.data[i].id}\', \'${response.data[i].monto_multa}\', ${response.data[i].semana})" title="No pagó" ><i class="fa-solid fa-ban"></i></button>
                        `
              : "",
          ]);
        }
        table.draw();
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

function modalPagar(
  pago_id,
  prestamo_id,
  monto_multa,
  pago,
  cliente,
  ruta,
  poblacion,
  monto,
  fecha_prestamo,
  semana,
  modalidad,
  balance
) {
  //alert(monto_multa)
  cb_multa.prop("checked", false);
  label_multa.text(`Aplicar multa de $${monto_multa}`);
  span_pago.text(`$ ${pago}`);
  span_balance.text(`$ ${balance}`);
  ec_cliente.text(cliente);
  ec_ruta.text(ruta);
  ec_poblacion.text(poblacion);
  ec_monto.text(`$ ${monto}`);
  span_fecha_prestamo.text(fecha_prestamo);

  semana_renovar_pago_seleccionado = semana;
  modalidad_id_pago_seleccionado = modalidad;

  getSemanaConfiguracionId(modalidad);
  
  pagoId = pago_id;
  prestamoId = prestamo_id;
  montoMulta = monto_multa;
  getPagosPrestamoPagados(prestamo_id);
  puedeOmitirUltimaSemana(prestamoId);
}

btn_guardar_pago.click(function () {
  if (inp_cantidad_pagada.val() == 0) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Se requiere una cantidad de pago valida",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else if (
    inp_concepto.val() == "" ||
    inp_fecha_pago.val() == "" ||
    inp_folio.val() == ""
  ) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacíos",
      text: "Se necesitan llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } else {
    cb_multa.prop("checked")
      ? hacerPago(
          pagoId,
          prestamoId,
          inp_cantidad_pagada.val(),
          montoMulta,
          inp_concepto.val(),
          inp_fecha_pago.val(),
          inp_folio.val()
        )
      : hacerPago(
          pagoId,
          prestamoId,
          inp_cantidad_pagada.val(),
          0.0,
          inp_concepto.val(),
          inp_fecha_pago.val(),
          inp_folio.val()
        );
  }
});

btn_omitir_pago.click(function () {
  omitirSemanaPago(pagoId);
});

function omitirSemanaPago(pago_id) {
  var datasend = {
    func: "omitirSemanaPago",
    pago_id,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      console.log(response.data);

      if (response.status == "success") {
        $("#modal_pagar").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Pago omitido",
          text: "Se ha omitido el pago correctamente",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        }).then((result) => {
          if (clienteIdFiltro) {
            if (prestamoId) {
              getPagosPrestamo(prestamoIdFiltro);
            } else {
              getPagosCliente(clienteIdFiltro);
            }
          } else {
            getPagos();
          }
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
  });
}

function puedeOmitirUltimaSemana(prestamo_id) {
  var datasend = {
    func: "puedeOmitirUltimaSemana",
    prestamo_id,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      console.log(response.data);

      if (response.data) {
        $("#btn_omitir_pago").removeClass("d-none");
      } else {
        $("#btn_omitir_pago").addClass("d-none");
      }

      if (response.status == "success") {
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

function hacerPago(
  pago_id,
  prestamo_id,
  pago_recibido,
  pago_multa,
  concepto,
  fecha_pago,
  folio
) {
  var datasend = {
    func: "pagar",
    pago_id,
    prestamo_id,
    pago_recibido,
    pago_multa,
    concepto,
    fecha_pago,
    folio,
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        if (semana_renovar_pago_seleccionado == config_semana_renovar) {

          Swal.fire({
            icon: "question",
            title: "¿Cliente renueva?",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            allowOutsideClick: false,
            allowEscapeKey: false,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `${env.local.url}prestamos.php?p=${prestamo_id}`;
            } else {
              $("#modal_pagar").modal("toggle");
              getPagos();
            }
          });
        } else {
          $("#modal_pagar").modal("toggle");
          Swal.fire({
            icon: "success",
            title: "Pago recibido",
            text: "Se ha realizado el pago correctamente",
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
          }).then((result) => {
            /*if (clienteIdFiltro) {
              if (prestamoId) {
                getPagosPrestamo(prestamoIdFiltro);
              } else {
                getPagosCliente(clienteIdFiltro);
              }
              getClientes();

            } else {
              getClientes();
            }*/
            getClientes();
          });
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

function getClientes() {
  var datasend = {
    func: "getClientes",
  };

  $.ajax({
    type: "POST",
    url: "php/Clientes/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        select_clientes_filtro.empty();
        select_clientes_filtro.append(`
                    <option value="0" >General</option>
                `);
          
                card_body_pagos.empty();

        for (var i = 0; i < response.data.length; i++) {

          select_clientes_filtro.append(`
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo}</option>
                    `);

            card_body_pagos.append(`
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" style="cursor: pointer;" id="headingOne" data-toggle="collapse" data-target="#collapse${response.data[i].id}" aria-expanded="true" aria-controls="collapse${response.data[i].id}">
                          <h5 class="mb-0">
                              <button class="btn btn-link" >
                              <i class="fa-solid fa-handshake"></i> ${response.data[i].nombre_completo}
                              </button>
                          </h5>
                        </div>
    
                        <div id="collapse${response.data[i].id}" data-prestamo="${response.data[i].prestamo_id}" data-cliente="${response.data[i].id}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body" id='card-body-collapse-${response.data[i].id}'>
                            </div>
                        </div>
                    </div>
                </div>
            `)


        }

        $('.collapse').on('show.bs.collapse', function (e) {
          prestamo = $(e.target).attr('data-prestamo')
          cliente = $(e.target).attr('data-cliente')

            idCollapse = $(e.target).attr('id')
            dataCliente = $(e.target).attr('data-cliente')
            $(`#card-body-collapse-${dataCliente}`).empty();
            getPagosCliente(dataCliente)
        });

        if (prestamo && cliente) {
            $(`#collapse${cliente}`).collapse('toggle');
            dataCliente = $(`#collapse${cliente}`).attr('data-cliente')
            $(`#card-body-collapse-${dataCliente}`).empty();
            getPagosPrestamo(prestamo, dataCliente);
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

function getPagosCliente(cliente_id) {
  clearInputs();

  var datasend = {
    func: "pagosCliente",
    cliente_id,
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {

      if (response.status == "success") {

        $(`#card-body-collapse-${cliente_id}`)
        .append(`<table class="table" id="tabla_pagos_${cliente_id}">
                <thead>
                    <tr>
                        <th scope="col">Sem.</th>
                        <th scope="col">Folio</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Monto</th>
                        <th scope="col" class="sum_pago_esperado">Pago</th>
                        <th scope="col" class="sum_pago_recibido">Pagado</th>
                        <th scope="col" class="sum_pago_multa">Multa</th>
                        <th scope="col" class="sum_pago_pendiente">Pendiente</th>
                        <th scope="col" class="sum_pago_total">Total</th>
                        <th scope="col">Fecha</th>
                        <th scope="col" class="sum_balance">Balance</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="table_body" style="font-size: 0.9rem !important;">
                    
                </tbody>
                <tfoot style="font-size: 0.8rem !important;">
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
            </table>`)



        let tabla_pagos = $(`#tabla_pagos_${cliente_id}`).DataTable({
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
            createdRow: function (row, data, index) {
              $("td", row).eq(7).addClass("text-danger").addClass("text-bold");
            },
            columnDefs: [{ visible: false, targets: [] }],
            //order: [[8, 'asc']],
            aaSorting: [],
        
            footerCallback: function (row, data, start, end, display) {
              var api = this.api();
        
              api
                .columns(".sum_pago_total", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_multa", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_recibido", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_esperado", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
        
              api
                .columns(".sum_pago_pendiente", {
                  page: "current",
                })
                .every(function () {
                  var sum = this.data().reduce(function (a, b) {
                    a = a.toString().replace(/[$]/g, "");
                    b = b.toString().replace(/[$]/g, "");
                    a = a.toString().replace(/[,]/g, "");
                    b = b.toString().replace(/[,]/g, "");
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                    return x + y;
                  }, 0);
                  $(this.footer()).html(
                    "$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2))
                  );
                });
            }})


        tabla_pagos.clear();

        for (var i = 0; i < response.data.length; i++) {
          puedeOmitirUltimaSemana(response.data[i].prestamo_id);

          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Pagado</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-warning">Pendiente</span>';
          } else if (response.data[i].status == -1) {
            status = '<span class="badge badge-danger">No pagó</span>';
          } else if (response.data[i].status == 2) {
            status = '<span class="badge badge-info">Omitido</span>';
          }

          tabla_pagos.row.add([
            response.data[i].semana,
            response.data[i].folio,
            response.data[i].nombre_completo,
            "$ " + response.data[i].monto_prestado,
            "$ " + response.data[i].cantidad_esperada_pago,
            "$ " + response.data[i].cantidad_normal_pagada,
            "$ " + response.data[i].cantidad_multa,
            `$ ${response.data[i].cantidad_pendiente}`,
            "$ " + response.data[i].cantidad_total_pagada,
            moment(response.data[i].fecha_pago).format('DD/MM/YYYY'),
            "$ " + response.data[i].balance,
            status,
            response.data[i].status == 0
              ? `
                        <button class="btn btn-success btn_pagar btn-sm" onclick="modalPagar(\'${response.data[i].id}\', \'${response.data[i].prestamo_id}\', \'${response.data[i].monto_multa}\', \'${response.data[i].cantidad_esperada_pago}\', \'${response.data[i].nombre_completo}\', \'${response.data[i].nombre_ruta}\',\'${response.data[i].nombre_poblacion}\'
                        , \'${response.data[i].monto_prestado}\', \'${response.data[i].fecha_prestamo}\', \'${response.data[i].semana}\', ${response.data[i].modalidad_semanas}, ${response.data[i].balance})" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                        <button class="btn btn-danger btn_no_pagar btn-sm" onclick="noPagar(\'${response.data[i].id}\', \'${response.data[i].monto_multa}\', ${response.data[i].semana})" title="No pagó" ><i class="fa-solid fa-ban"></i></button>
                        `
              : "",
          ]);
        }
        tabla_pagos.draw();

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

function noPagar(pago_id, pago_multa, semana) {
  Swal.fire({
    icon: "warning",
    title: "No realizó pago",
    text: "Se marcara el pago como No pagado, ¿Esta seguro de esto?",
    showCancelButton: true,
    showConfirmButton: true,
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      var datasend = {
        func: "noPagar",
        pago_id,
        pago_multa,
        semana,
      };

      $.ajax({
        type: "POST",
        url: URL,
        data: JSON.stringify(datasend),
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Pago no recibido",
              text: "No se recibio el pago",
              timer: 1000,
              showCancelButton: false,
              showConfirmButton: false,
            }).then((result) => {
              /*if (clienteIdFiltro) {
                if (prestamoId) {
                  getPagosPrestamo(prestamoIdFiltro);
                } else {
                  getPagosCliente(clienteIdFiltro);
                }
              } else {
                getPagos();
              }*/
              getClientes();
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
      });
    }
  });
}

function getPagosPrestamoPagados(prestamo_id) {
  var datasend = {
    func: "pagosPrestamoPagados",
    prestamo_id,
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        tabla_ec_pagos.clear();
        for (var i = 0; i < response.data.length; i++) {
          var status;
          if (response.data[i].status == 1) {
            status = '<span class="badge badge-success">Pagado</span>';
          } else if (response.data[i].status == 0) {
            status = '<span class="badge badge-warning">Pendiente</span>';
          } else if (response.data[i].status == -1) {
            status = '<span class="badge badge-danger">No pagó</span>';
          } else if (response.data[i].status == 2) {
            status = '<span class="badge badge-info">Omitido</span>';
          }

          tabla_ec_pagos.row.add([
            response.data[i].semana,
            response.data[i].fecha_pago_realizada,
            "$ " + response.data[i].cantidad_normal_pagada,
            "$ " + response.data[i].cantidad_multa,
            status,
          ]);
        }
        tabla_ec_pagos.draw();
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

function getSemanaConfiguracionId(id) {
  var datasend = {
    func: "buscarSemana",
    id,
  };

  $.ajax({
    type: "POST",
    url: "php/Configuraciones/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      config_cantidad_semanas = response.data.cantidad;
      config_semana_renovar = response.data.semana_renovacion;
      console.log(response);
      console.log(config_cantidad_semanas);
      console.log(config_semana_renovar);
    },
    error: function (e) {
      console.log(e);
    },
  });
}


