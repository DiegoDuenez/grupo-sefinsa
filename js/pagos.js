URL = 'php/Pagos/App.php'


var btn_guardar_pago = $('#btn_guardar_pago')
var inp_cantidad_pagada = $('#inp_cantidad_pagada')
var label_multa = $('#label_multa')
var cb_multa = $('#cb_multa')
var inp_concepto = $('#inp_concepto')
var select_clientes_filtro = $('#select_clientes_filtro')

var pagoId;
var prestamoId;
var montoMulta;
var table;
var clienteIdFiltro;

$(document).ready(function(){

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
        /*"columnDefs": [
            { "visible": false, "targets": -1 }
          ],*/
          order: [[8, 'asc']],

          
    })

    getPagos()
    getClientes();

    
    select_clientes_filtro.select2({theme: 'bootstrap4', width: '100%'});

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
    this.value == 0 ? getPagos() : getPagosCliente(this.value);
    
});


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


function modalPagar(pago_id, prestamo_id, monto_multa){
    //alert(monto_multa)
    cb_multa.prop('checked', false);
    label_multa.text(`Aplicar multa de $${monto_multa}`)
    pagoId = pago_id
    prestamoId = prestamo_id
    montoMulta = monto_multa
    console.log(pagoId)
    console.log(prestamoId)

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
    else if(inp_concepto.val() == ""){
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

        cb_multa.prop('checked') ? hacerPago(pagoId, prestamoId, inp_cantidad_pagada.val(), montoMulta, inp_concepto.val()) : hacerPago(pagoId, prestamoId, inp_cantidad_pagada.val(), 0.00, inp_concepto.val()) 
           
    }

})



function hacerPago(pago_id, prestamo_id, pago_recibido, pago_multa, concepto){

    var datasend ={
        func: 'pagar',
        pago_id,
        prestamo_id,
        pago_recibido,
        pago_multa,
        concepto
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
                })
                getPagos()

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
                    <option value="0" >Seleccionar cliente</option>
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
        title: 'No realizar pago',
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
                        })
                        getPagos()
        
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

