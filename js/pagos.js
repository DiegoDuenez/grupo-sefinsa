URL = 'php/Pagos/App.php'


var btn_guardar_pago = $('#btn_guardar_pago')
var inp_cantidad_pagada = $('#inp_cantidad_pagada')
var label_multa = $('#label_multa')
var cb_multa = $('#cb_multa')
var inp_concepto = $('#inp_concepto')
var select_clientes_filtro = $('#select_clientes_filtro')
var select_clientes_prestamos_filtro = $('#select_clientes_prestamos_filtro')
var inp_fecha_pago = $('#inp_fecha_pago')
var btn_omitir_pago = $('#btn_omitir_pago')
var inp_folio = $('#inp_folio')
var span_pago = $('#span_pago')
var ec_monto = $('#ec_monto')
var ec_ruta = $('#ec_ruta')
var ec_poblacion = $('#ec_poblacion')
var ec_cliente = $('#ec_cliente')
var span_fecha_prestamo = $('#span_fecha_prestamo')

var pagoId;
var prestamoId;
var montoMulta;
var table;
var clienteIdFiltro;
var prestamoIdFiltro;
var tabla_ec_pagos;

var semanaRenovar;

$(document).ready(function(){

    tabla_ec_pagos = $('#tabla_ec_pagos').DataTable({
        bFilter: false,
        bInfo: false,
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        "aaSorting": [],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
           
            api.columns('.sum_ec_abono', {
              page: 'current'
            }).every(function() {
              var sum = this
                .data()
                .reduce(function(a, b) {
                   a = a.toString().replace(/[$]/g,'');
                   b = b.toString().replace(/[$]/g,'');
                   a = a.toString().replace(/[,]/g,'');
                    b = b.toString().replace(/[,]/g,'');
                  var x = parseFloat(a) || 0;
                  var y = parseFloat(b) || 0;
                  return x + y;
                }, 0);
              $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
            });
        
            api.columns('.sum_ec_multa', {
                page: 'current'
              }).every(function() {
                var sum = this
                  .data()
                  .reduce(function(a, b) {
                     a = a.toString().replace(/[$]/g,'');
                     b = b.toString().replace(/[$]/g,'');
                     a = a.toString().replace(/[,]/g,'');
                      b = b.toString().replace(/[,]/g,'');
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
                    return x + y;
                  }, 0);
                $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
              });
        }

    })

    table = $('#tabla_pagos').DataTable( {
      
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontro ningún registro",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "sSearch": "Buscar",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        },
        "columnDefs": [
            { "visible": false, "targets": 10 }
          ],
          //order: [[8, 'asc']],
          "aaSorting": [],

          "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
           
            api.columns('.sum_pago_total', {
              page: 'current'
            }).every(function() {
              var sum = this
                .data()
                .reduce(function(a, b) {
                   a = a.toString().replace(/[$]/g,'');
                   b = b.toString().replace(/[$]/g,'');
                   a = a.toString().replace(/[,]/g,'');
                    b = b.toString().replace(/[,]/g,'');
                  var x = parseFloat(a) || 0;
                  var y = parseFloat(b) || 0;
      
                 
                  return x + y;
                }, 0);
              $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
            });

            api.columns('.sum_pago_multa', {
                page: 'current'
              }).every(function() {
                var sum = this
                  .data()
                  .reduce(function(a, b) {
                     a = a.toString().replace(/[$]/g,'');
                     b = b.toString().replace(/[$]/g,'');
                     a = a.toString().replace(/[,]/g,'');
                      b = b.toString().replace(/[,]/g,'');
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                   
                    return x + y;
                  }, 0);
                $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
              });

              api.columns('.sum_pago_recibido', {
                page: 'current'
              }).every(function() {
                var sum = this
                  .data()
                  .reduce(function(a, b) {
                     a = a.toString().replace(/[$]/g,'');
                     b = b.toString().replace(/[$]/g,'');
                     a = a.toString().replace(/[,]/g,'');
                      b = b.toString().replace(/[,]/g,'');
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                   
                    return x + y;
                  }, 0);
                $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
              });
              
              api.columns('.sum_pago_esperado', {
                page: 'current'
              }).every(function() {
                var sum = this
                  .data()
                  .reduce(function(a, b) {
                     a = a.toString().replace(/[$]/g,'');
                     b = b.toString().replace(/[$]/g,'');
                     a = a.toString().replace(/[,]/g,'');
                      b = b.toString().replace(/[,]/g,'');
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                   
                    return x + y;
                  }, 0);
                $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
              });

              api.columns('.sum_pago_pendiente', {
                page: 'current'
              }).every(function() {
                var sum = this
                  .data()
                  .reduce(function(a, b) {
                     a = a.toString().replace(/[$]/g,'');
                     b = b.toString().replace(/[$]/g,'');
                     a = a.toString().replace(/[,]/g,'');
                      b = b.toString().replace(/[,]/g,'');
                    var x = parseFloat(a) || 0;
                    var y = parseFloat(b) || 0;
        
                   
                    return x + y;
                  }, 0);
                $(this.footer()).html("$ " + formatearCantidadMX((Math.round(sum * 100) / 100).toFixed(2)));
              });
        }

          
    })

    getPagos()
    getClientes();

    
    select_clientes_filtro.select2({theme: 'bootstrap4', width: '100%'});
    select_clientes_prestamos_filtro.select2({theme: 'bootstrap4', width: '100%'});


    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    prestamo = urlParams.get('p')
    if(prestamo){
        //formClienteSoloArchivos.show()
        getPagosPrestamo(prestamo)
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



select_clientes_filtro.on('change', function() {
    clienteIdFiltro = this.value
    getPrestamosCliente(this.value)
    this.value == 0 ? getPagos() : getPagosCliente(this.value);
    
});

select_clientes_prestamos_filtro.on('change', function(){

    prestamoIdFiltro = this.value
    this.value == 0 ?  getPagosCliente(clienteIdFiltro) : getPagosPrestamo(this.value)
})

function getPrestamosCliente(cliente_id){

    var datasend = {
        func: "prestamosCliente",
        cliente_id
    };

    $.ajax({

        type: 'POST',
        url: 'php/Prestamos/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){


                if(response.data.length > 0){

                    select_clientes_prestamos_filtro.prop('disabled', false)

                    select_clientes_prestamos_filtro.empty()
                    select_clientes_prestamos_filtro.append(`
                        <option value="0" >General</option>
                    `)
                    for(var i = 0; i < response.data.length; i++ ){
                        
                        select_clientes_prestamos_filtro.append(`
                            <option name="${response.data[i].id}" value="${response.data[i].id}">${response.data[i].monto_prestado}</option>
                        `)

                    }

                }
                else{
                    select_clientes_prestamos_filtro.prop('disabled', true)
                }

    


            }

        },
        error : function(e){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });

}


function getPagosPrestamo(prestamo_id)
{
    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO PAGOS..</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

    var datasend = {
        func: "pagosPrestamo",
        prestamo_id
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                table.clear()
                for(var i = 0; i < response.data.length; i++ ){

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pendiente</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    else if(response.data[i].status == 2){
                        status = '<span class="badge badge-info">Omitido</span>'
                    }


                    table.row.add([
                        response.data[i].nombre_completo, 
                        "$ " + response.data[i].monto_prestado,
                        "$ " + response.data[i].cantidad_esperada_pago,
                        "$ " + response.data[i].cantidad_normal_pagada,
                        "$ " + response.data[i].cantidad_multa,
                        "$ " + response.data[i].cantidad_pendiente,
                        "$ " + response.data[i].cantidad_total_pagada,
                        response.data[i].concepto,
                        response.data[i].fecha_pago,
                        status,
                        response.data[i].status == 0 ? `
                        <button class="btn btn-success btn_pagar" onclick="modalPagar(\'${response.data[i].id}\', \'${response.data[i].prestamo_id}\', \'${response.data[i].monto_multa}\', \'${response.data[i].nombre_completo}\', \'${response.data[i].nombre_ruta}\',\'${response.data[i].nombre_poblacion}\'
                        , \'${response.data[i].monto_prestado}\')" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                        <button class="btn btn-danger btn_no_pagar mt-1" onclick="noPagar(\'${response.data[i].id}\', \'${response.data[i].monto_multa}\')" title="No pagó" ><i class="fa-solid fa-ban"></i></button>
                        ` : '',


                    ]);


                }
                table.draw();

            }

        },
        error : function(e){

            console.log(e)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        },
        complete : function(){
            $.unblockUI();
        }
    });
}


function getPagos(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO PAGOS..</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

    var datasend = {
        func: "index"
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){


                console.log(response)

                table.clear()
                for(var i = 0; i < response.data.length; i++ ){

                    puedeOmitirUltimaSemana(response.data[i].prestamo_id)

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pendiente</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    else if(response.data[i].status == 2){
                        status = '<span class="badge badge-info">Omitido</span>'
                    }


                    table.row.add([
                        response.data[i].semana, 
                        response.data[i].folio, 
                        response.data[i].nombre_completo, 
                        "$ " + response.data[i].monto_prestado,
                        "$ " + response.data[i].cantidad_esperada_pago,
                        "$ " + response.data[i].cantidad_normal_pagada,
                        "$ " + response.data[i].cantidad_multa,
                        `<span class="text-danger text-bold">$ ${response.data[i].cantidad_pendiente}</span>`,
                        "$ " + response.data[i].cantidad_total_pagada,
                        response.data[i].fecha_pago,
                        "$ " + response.data[i].balance,
                        status,
                        response.data[i].status == 0 ? `
                        <button class="btn btn-success btn_pagar" onclick="modalPagar(\'${response.data[i].id}\', \'${response.data[i].prestamo_id}\', \'${response.data[i].monto_multa}\', \'${response.data[i].cantidad_esperada_pago}\', \'${response.data[i].nombre_completo}\', \'${response.data[i].nombre_ruta}\',\'${response.data[i].nombre_poblacion}\'
                        , \'${response.data[i].monto_prestado}\', \'${response.data[i].fecha_prestamo}\', \'${response.data[i].semana}\')" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                        <button class="btn btn-danger btn_no_pagar mt-1" onclick="noPagar(\'${response.data[i].id}\', \'${response.data[i].monto_multa}\')" title="No pagó" ><i class="fa-solid fa-ban"></i></button>
                        ` : ''


                    ]);


                }
                table.draw();

            }

        },
        error : function(e){

            console.log(e)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        },
        complete : function(){
            $.unblockUI();
        }
    });

}


function modalPagar(pago_id, prestamo_id, monto_multa, pago, cliente, ruta, poblacion, monto, fecha_prestamo, semana){
    //alert(monto_multa)
    cb_multa.prop('checked', false);
    label_multa.text(`Aplicar multa de $${monto_multa}`)
    span_pago.text(`$ ${pago}`)
    ec_cliente.text(cliente)
    ec_ruta.text(ruta)
    ec_poblacion.text(poblacion)
    ec_monto.text(`$ ${monto}`)
    span_fecha_prestamo.text(fecha_prestamo)
    semanaRenovar = semana

    pagoId = pago_id
    prestamoId = prestamo_id
    montoMulta = monto_multa
    getPagosPrestamoPagados(prestamo_id)
    puedeOmitirUltimaSemana(prestamoId)

}
/*
cb_multa.change(function() {

    if(this.checked) {
    }
    else{
        montoMulta = 0.00
    }
    alert(montoMulta)
});*/

btn_guardar_pago.click(function(){

    if(inp_cantidad_pagada.val() == 0){
        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Se requiere una cantidad de pago valida',
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false
        })
    }
    else if(inp_concepto.val() == ""  || inp_fecha_pago.val() == "" || inp_folio.val() == ""){
        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Se necesitan llenar todos los campos',
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false
        })
    }
    else{

        if(semanaRenovar == "10"){

            Swal.fire({
                icon: 'question',
                title: '¿Cliente renueva?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: 'No',

            }).then((result) => {
                
                /*if (result.isConfirmed) {
                    window.location.href = `${env.local.url}prestamos.php?c=${response.data.id}`;
                }*/
            })

        }
        else{
            cb_multa.prop('checked') ? hacerPago(pagoId, prestamoId, inp_cantidad_pagada.val(), montoMulta, inp_concepto.val(), inp_fecha_pago.val(), inp_folio.val()) : hacerPago(pagoId, prestamoId, inp_cantidad_pagada.val(), 0.00, inp_concepto.val(), inp_fecha_pago.val(), inp_folio.val()) 
        }
           
    }

})

btn_omitir_pago.click(function(){

    omitirSemanaPago(pagoId)
})



function omitirSemanaPago(pago_id){

    var datasend ={
        func: 'omitirSemanaPago',
        pago_id
    }

    $.ajax({

        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            console.log(response.data)

            if(response.status == "success"){

                $('#modal_pagar').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Pago omitido',
                    text: 'Se ha omitido el pago correctamente',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                }).then((result)=>{

                    if(clienteIdFiltro){
                        if(prestamoId){
                            getPagosPrestamo(prestamoIdFiltro)
                        }
                        else{
                            getPagosCliente(clienteIdFiltro)
                        }
                        
                    }
                    else{
                        getPagos()
                    }

                })

            }
            
        },
        error : function(e){
            

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    })

}

function puedeOmitirUltimaSemana(prestamo_id){

    var datasend ={
        func: 'puedeOmitirUltimaSemana',
        prestamo_id
    }

    $.ajax({

        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            console.log(response.data)

            if(response.data){
                $('#btn_omitir_pago').removeClass('d-none')
            }
            else{
                $('#btn_omitir_pago').addClass('d-none')
            }

            if(response.status == "success"){

            }
            
        },
        error : function(e){
            

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    })

}



function hacerPago(pago_id, prestamo_id, pago_recibido, pago_multa, concepto, fecha_pago, folio){

    var datasend ={
        func: 'pagar',
        pago_id,
        prestamo_id,
        pago_recibido,
        pago_multa,
        concepto,
        fecha_pago,
        folio
    }

    $.ajax({

        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){

                $('#modal_pagar').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Pago recibido',
                    text: 'Se ha realizado el pago correctamente',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                }).then((result)=>{

                    if(clienteIdFiltro){
                        if(prestamoId){
                            getPagosPrestamo(prestamoIdFiltro)
                        }
                        else{
                            getPagosCliente(clienteIdFiltro)
                        }
                    }
                    else{
                        getPagos()
                    }

                })
               

            }
            
        },
        error : function(e){
            

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    })

}


function getClientes(){

    var datasend = {
        func: "index"
    };

    $.ajax({

        type: 'POST',
        url: 'php/Clientes/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){


                select_clientes_filtro.empty()
                select_clientes_filtro.append(`
                    <option value="0" >General</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    select_clientes_filtro.append(`
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo}</option>
                    `)

                }


            }

        },
        error : function(e){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });

}


function getPagosCliente(cliente_id){

    clearInputs()

    var datasend = {
        func: "pagosCliente",
        cliente_id
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){


                table.clear()
                for(var i = 0; i < response.data.length; i++ ){


                    puedeOmitirUltimaSemana(response.data[i].prestamo_id)


                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pendiente</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    else if(response.data[i].status == 2){
                        status = '<span class="badge badge-info">Omitido</span>'
                    }



                    table.row.add([
                        response.data[i].nombre_completo, 
                        "$ " + response.data[i].monto_prestado,
                        "$ " + response.data[i].cantidad_esperada_pago,
                        "$ " + response.data[i].cantidad_normal_pagada,
                        "$ " + response.data[i].cantidad_multa,
                        "$ " + response.data[i].cantidad_pendiente,
                        "$ " + response.data[i].cantidad_total_pagada,
                        response.data[i].concepto,
                        response.data[i].fecha_pago,
                        status,
                        response.data[i].status == 0 ? `
                        <button class="btn btn-success btn_pagar" onclick="modalPagar(\'${response.data[i].id}\', \'${response.data[i].prestamo_id}\', \'${response.data[i].monto_multa}\')" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                        <button class="btn btn-danger btn_no_pagar mt-1" onclick="noPagar(\'${response.data[i].id}\', \'${response.data[i].monto_multa}\')" title="No pagó" ><i class="fa-solid fa-ban"></i></button>
                        ` : '',
                    ]);


                }
                table.draw();


            }

        },
        error : function(e){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });

}


function noPagar(pago_id, pago_multa){

    Swal.fire({
        icon: 'warning',
        title: 'No realizó pago',
        text: 'Se marcara el pago como No pagado, ¿Esta seguro de esto?',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',

    }).then((result) => {
        
        if (result.isConfirmed) {

            var datasend ={
                func: 'noPagar',
                pago_id,
                pago_multa
            }
        
            $.ajax({
        
                type: 'POST',
                url: URL,
                data : JSON.stringify(datasend),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
        
                        Swal.fire({
                            icon: 'success',
                            title: 'Pago no recibido',
                            text: 'No se recibio el pago',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        }).then((result)=>{

                            if(clienteIdFiltro){
                                if(prestamoId){
                                    getPagosPrestamo(prestamoIdFiltro)
                                }
                                else{
                                    getPagosCliente(clienteIdFiltro)
                                }
                            }
                            else{
                                getPagos()
                            }
        
                        })
        
                    }
                    
                },
                error : function(e){
                    
        
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: e.responseJSON.message,
                    })
        
                }
            })
            
            
            
        }

        
    })

}


function getPagosPrestamoPagados(prestamo_id){


    var datasend = {
        func: "pagosPrestamoPagados",
        prestamo_id
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            console.log(response)
            if(response.status == 'success'){

                tabla_ec_pagos.clear()
                for(var i = 0; i < response.data.length; i++ ){

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pendiente</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    else if(response.data[i].status == 2){
                        status = '<span class="badge badge-info">Omitido</span>'
                    }


                    tabla_ec_pagos.row.add([
                        response.data[i].semana, 
                        response.data[i].fecha_pago_realizada,
                        "$ " + response.data[i].cantidad_normal_pagada,
                        "$ " + response.data[i].cantidad_multa,
                        status
                    ]);


                }
                tabla_ec_pagos.draw();

            }

        },
        error : function(e){

            console.log(e)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        },
        complete : function(){
            $.unblockUI();
        }
    });

}