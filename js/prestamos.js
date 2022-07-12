
URL = 'php/Prestamos/App.php'

var inputs_registrar_cliente_1 = $('#inputs_registrar_cliente_1')
var inputs_registrar_cliente_2 = $('#inputs_registrar_cliente_2')
var inputs_registrar_cliente_3 = $('#inputs_registrar_cliente_3')
var inputs_registrar_cliente_4 = $('#inputs_registrar_cliente_4')
var group_or_client = $('#group_or_client')
var btn_generar_prestamo = $('#btn_generar_prestamo')
var titulo_cliente = $('#titulo_cliente')
var modal_prestamos_label = $('#modal_prestamos_label')
var formClienteSoloArchivos = $('#formClienteSoloArchivos')
var prestamosTab = $('#prestamosTab')
var btn_guardar_prestamo = $('#btn_guardar_prestamo')
var btn_siguiente_usuario = $('#btn_siguiente_usuario')
var btn_anterior_usuario = $('#btn_anterior_usuario')

// CLIENTE INPUTS
var inp_nombre_cliente =$('#inp_nombre_cliente')
var inp_direccion_cliente = $('#inp_direccion_cliente')
var inp_telefono_cliente = $('#inp_telefono_cliente')
var select_rutas_registrar = $('#select_rutas_registrar')
var select_poblaciones_registrar = $('#select_poblaciones_registrar')
var select_colocadoras_registrar = $('#select_colocadoras_registrar')
var inp_otras_referencias_cliente = $('#inp_otras_referencias_cliente')
var inp_garantias_cliente = $('#inp_garantias_cliente')
var inp_archivos_garantias_cliente = $('#inp_archivos_garantias_cliente')
var inp_archivos_cliente = $('#inp_archivos_cliente')
var select_clientes_registrar = $('#select_clientes_registrar')

var inp_garantias_cliente_existente = $('#inp_garantias_cliente_existente')
var inp_archivos_garantias_cliente_existente = $('#inp_archivos_garantias_cliente_existente')
var inp_archivos_cliente_existente = $('#inp_archivos_cliente_existente')
var inp_direccion_cliente_existente = $('#inp_direccion_cliente_existente')
var inp_telefono_cliente_existente = $('#inp_telefono_cliente_existente')

// AVAL INPUTS
var inp_nombre_aval = $('#inp_nombre_aval')
var inp_direccion_aval = $('#inp_direccion_aval')
var inp_telefono_aval = $('#inp_telefono_aval')
var inp_otras_referencias_aval = $('#inp_otras_referencias_aval')
var inp_garantias_aval = $('#inp_garantias_aval')
var inp_archivos_garantias_aval = $('#inp_archivos_garantias_aval')
var inp_archivos_aval = $('#inp_archivos_aval')

// PRESTAMO INPUTS
var inp_fecha_prestamo = $('#inp_fecha_prestamo')
var inp_monto_prestar = $('#inp_monto_prestar')
var inp_pago_semana = $('#inp_pago_semana')
var inp_monto_prestar_intereses = $('#inp_monto_prestar_intereses')
// URI
var cliente = ""
var clienteID = ""
var table
var tableExcel


$(document).ready(function(){

    formClienteSoloArchivos.hide()

    table = $('#tabla_prestamos').DataTable( {
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
            { "visible": false, "targets": [-1/*, 8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27*/] }
          ],
          order: [[10, 'desc']],
    })

    tableExcel = $('#tabla_prestamos_excel').DataTable({bFilter: false, bPaginate: false})
    
    getPrestamos()
    getRutas()
    getClientes()
    
    $('#select_colocadoras_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_clientes_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});

    $('#select_rutas_registrar_existente').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_poblaciones_registrar_existente').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_colocadoras_registrar_existente').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});

    /*inp_fecha_prestamo.datetimepicker({
		format:'YYYY:MM:DD',
		date : globalFechaInicial,
		locale: 'es-MX'
	});*/


    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    cliente = urlParams.get('c')
    if(cliente){
        $('#modal_registrar_prestamo').modal('toggle');
        inputs_registrar_cliente_1.hide()
        inputs_registrar_cliente_2.hide()
        group_or_client.hide()
        prestamosTab.hide()
        traerCliente(cliente)

        //formClienteSoloArchivos.show()

    }
    else{
       // $('#modal_registrar_prestamo').modal({backdrop: 'static'})
       titulo_cliente.hide()
       modal_prestamos_label.text('Registrar cliente y aval')

    }
})

$('#select_rutas_registrar').on('change', function() {
    $('#select_poblaciones_registrar').prop( "disabled", false );
    getPoblacionesRuta(this.value);
});

$('#select_poblaciones_registrar').on('change', function() {
    $('#select_colocadoras_registrar').prop( "disabled", false);
    getColocadorasRutaPoblacion($('#select_rutas_registrar option:selected').val(), this.value);
});

$('#select_rutas_registrar_existente').on('change', function() {
    $('#select_poblaciones_registrar_existente').prop( "disabled", false );
    getPoblacionesRuta(this.value);
});

$('#select_poblaciones_registrar_existente').on('change', function() {
    $('#select_colocadoras_registrar_existente').prop( "disabled", false);
    getColocadorasRutaPoblacion($('#select_rutas_registrar_existente option:selected').val(), this.value);
});

select_clientes_registrar.on('change', function() {
    clienteID = this.value

    traerCliente(clienteID)

})

inp_monto_prestar.on('input', function(){

    var interes = 0
    var abono = 0
    if($('#select_modalidad option:selected').val() == 15){
        interes = 40
        abono = 10
    }
    else if($('#select_modalidad option:selected').val() == 20){
        interes = 55
        abono = 80
    }

    monto_con_interes = (inp_monto_prestar.val() * interes) / 100 + parseInt(inp_monto_prestar.val())

    inp_monto_prestar_intereses.val(monto_con_interes )

    console.log('abono', abono)
    console.log('interes', interes)
    console.log('monto_interes', monto_con_interes)
    console.log(`formular ${inp_monto_prestar.val()} * ${interes} / 100`)

    if($('#select_modalidad option:selected').val() == 15){
        pago_semanal = (inp_monto_prestar.val() * abono) / 100
    }
    else if($('#select_modalidad option:selected').val() == 20){
        pago_semanal = abono * inp_monto_prestar.val()[0]
    }

    console.log('pago_semanal',pago_semanal)


    inp_pago_semana.val(pago_semanal)

})


$('#select_modalidad').on('change', function() {

    var interes = 0
    var abono = 0
    if(this.value == 15){
        interes = 50
        abono = 10
    }
    else if(this.value == 20){
        interes = 60
        abono = 80
    }

    monto_con_interes = (inp_monto_prestar.val() * interes) / 100 + parseInt(inp_monto_prestar.val())
    inp_monto_prestar_intereses.val(monto_con_interes )

    console.log('abono', abono)
    console.log('interes', interes)
    console.log('monto_interes', monto_con_interes)
    console.log(`formular ${inp_monto_prestar.val()} * ${interes} / 100`)

    if(this.value == 15){
        pago_semanal = (inp_monto_prestar.val() * abono) / 100
    }
    else if(this.value == 20){
        pago_semanal = abono * inp_monto_prestar.val()[0]
    }

    console.log('pago_semanal',pago_semanal)


    inp_pago_semana.val(pago_semanal)



})


function getPrestamos(){


    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO PRESTAMOS...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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

                //getPrestamosExcel(response.data[i].id)

                table.clear()
                for(var i = 0; i < response.data.length; i++ ){

                    //console.log(response.data[i].id)

                    //getPrestamosExcel(response.data[i].id)

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pagandose</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    
                    table.row.add([
                        response.data[i].nombre_completo, 
                        response.data[i].direccion_cliente,
                        response.data[i].telefono_cliente,
                        response.data[i].nombre_aval,
                        response.data[i].direccion_aval,
                        response.data[i].telefono_aval,
                        "$ " + response.data[i].monto_prestado,
                        "$ " + response.data[i].pago_semanal,
                        status,
                        `
                        <a class="btn btn-info btn_ver_semanas" title="Ver pagos" href="${env.local.url}pagos.php?p=${response.data[i].id}"><i class="fa-solid fa-eye"></i></a>
                        `,
                        response.data[i].created_at,

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

        },
        complete : function(){
            $.unblockUI();
        }
    });

}

btn_siguiente_usuario.click(function(){
    $('#pago').removeClass('d-none')
    $('#cliente').addClass('d-none')
    btn_anterior_usuario.prop('disabled', false)
    modal_prestamos_label.text('Prestamo')
    btn_siguiente_usuario.addClass('d-none')
    btn_guardar_prestamo.removeClass('d-none')
    $('#modal_dialog').removeClass('modal-xl')

})

btn_anterior_usuario.click(function(){
    $('#pago').addClass('d-none')
    $('#cliente').removeClass('d-none')
    btn_anterior_usuario.prop('disabled', true)
    btn_siguiente_usuario.removeClass('d-none')
    btn_guardar_prestamo.addClass('d-none')
    modal_prestamos_label.text('Registrar cliente y aval')
    $('#modal_dialog').addClass('modal-xl')


})

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    if(target == "#cliente-existente"){
        inp_nombre_cliente.val('')
        inp_direccion_cliente.val('')
        inp_telefono_cliente.val('')
        inp_otras_referencias_cliente.val('')
        inp_garantias_cliente.val('')
        inp_nombre_aval.val('')
        inp_direccion_aval.val('')
        inp_telefono_aval.val('')
        inp_otras_referencias_aval.val('')
        inp_garantias_cliente.val('')

        $('#select_rutas_registrar').val(0).trigger('change.select2');
        $('#select_poblaciones_registrar').val(0).trigger('change.select2');
        $('#select_colocadoras_registrar').val(0).trigger('change.select2');
        $('#select_poblaciones_registrar').prop('disabled', true)
        $('#select_colocadoras_registrar').prop('disabled', true)
        $('#select_poblaciones_registrar').empty()
        $('#select_colocadoras_registrar').empty()
        $('#select_clientes_registrar').val(0).trigger('change.select2');


        
        $("#inputs_registrar_cliente_3").addClass('d-none')      
    }
    else{

        inp_direccion_cliente_existente.val('')
        inp_telefono_cliente_existente.val('')
        inp_garantias_cliente_existente.val('')
        inp_nombre_aval.val('')
        inp_direccion_aval.val('')
        inp_telefono_aval.val('')
        inp_otras_referencias_aval.val('')
        inp_garantias_cliente.val('')

        $('#select_rutas_registrar_existente').val(0).trigger('change.select2');
        $('#select_poblaciones_registrar_existente').val(0).trigger('change.select2');
        $('#select_colocadoras_registrar_existente').val(0).trigger('change.select2');
        $('#select_poblaciones_registrar_existente').prop('disabled', true)
        $('#select_colocadoras_registrar_existente').prop('disabled', true)
        $('#select_rutas_registrar_existente').prop('disabled', true)
        $('#select_poblaciones_registrar_existente').empty()
        $('#select_colocadoras_registrar_existente').empty()
        $('#select_poblaciones_registrar').empty()
        $('#select_colocadoras_registrar').empty()


        $("#inputs_registrar_cliente_3").removeClass('d-none')      
    }
  });

btn_guardar_prestamo.click(function(){
    
    var id = $('.tab-content .active').attr('id');
    
    var data = new FormData();

    alert(id)

    if(id == "nuevo-cliente" && cliente ){

        if(inp_nombre_aval.val() == "" || inp_direccion_aval.val() == "" || inp_telefono_aval.val() == ""
        || inp_otras_referencias_aval.val() == "" || inp_garantias_cliente.val() == "" || inp_garantias_aval.val() == ""
        || inp_archivos_cliente.get(0).files.length == 0 || inp_archivos_aval.get(0).files.length == 0
        || inp_archivos_garantias_aval.get(0).files.length == 0 || inp_archivos_garantias_cliente.get(0).files.length == 0
        || inp_monto_prestar.val() == 0 || inp_pago_semana.val() == 0)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Campos vacios',
                text: 'Necesitas llenar todos los campos',
                timer: 1000,
                showCancelButton: false,
                showConfirmButton: false
            })
           
        }
        else {

            data.append('func', 'createPrestamoClienteExistenteURI');
            data.append('cliente_id', cliente)
            data.append('nombre_aval', inp_nombre_aval.val())
            data.append('direccion_aval', inp_direccion_aval.val())
            data.append('telefono_aval', inp_telefono_aval.val())
            data.append('or_aval', inp_otras_referencias_aval.val())
            data.append('garantias_cliente', inp_garantias_cliente.val())
            data.append('garantias_aval', inp_garantias_aval.val())
            data.append('cantidad_archivos_garantias_aval', inp_archivos_garantias_aval.get(0).files.length)
            data.append('cantidad_archivos_garantias_cliente', inp_archivos_garantias_cliente.get(0).files.length)
            data.append('fecha_prestamo', inp_fecha_prestamo.val())
            data.append('monto_prestado', inp_monto_prestar.val())
            data.append('monto_prestado_intereses', 0.00)
            data.append('pago_semanal', inp_pago_semana.val())
            data.append('modalidad_semanas', $('#select_modalidad option:selected').val())


            $.each(inp_archivos_cliente[0].files, function(i, file) {
                data.append('archivo_cliente_'+i, file);
            });
        
            $.each(inp_archivos_aval[0].files, function(i, file) {
                data.append('archivo_aval_'+i, file);
            });
        
            $.each(inp_archivos_garantias_aval[0].files, function(i, file) {
                data.append('garantia_aval_'+i, file);
            });
        
            $.each(inp_archivos_garantias_cliente[0].files, function(i, file) {
                data.append('garantia_cliente_'+i, file);
            });

            $.ajax({
                url: 'php/Clientes/App.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(response){
        
                    $('#modal_registrar_prestamo').modal('toggle');
                    $('#pago').addClass('d-none')
                    $('#cliente').removeClass('d-none')
                    btn_anterior_usuario.prop('disabled', true)
                    btn_siguiente_usuario.removeClass('d-none')
                    btn_guardar_prestamo.addClass('d-none')
                    modal_prestamos_label.text('Registrar cliente y aval')
                    $('#modal_dialog').addClass('modal-xl')
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Nuevo prestamo',
                        text: 'Se ha registrado un nuevo prestamo',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
    
                    //window.location.href = RemoveParameterFromUrl(window.location.href, 'c')

                    getPrestamos()
        
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


    }
    else if(id == "nuevo-cliente"){


        if(inp_nombre_cliente.val() == "" || inp_direccion_cliente.val() == "" || inp_telefono_cliente.val() == ""
        || $('.select_rutas option:selected').val() == 0  || $('.select_poblaciones option:selected').val() == 0 
        || $('.select_colocadoras option:selected').val() == 0 
        || inp_nombre_aval.val() == "" || inp_direccion_aval.val() == "" || inp_telefono_aval.val() == ""
        || inp_otras_referencias_aval.val() == "" || inp_garantias_cliente.val() == "" || inp_garantias_aval.val() == ""
        || inp_archivos_cliente.get(0).files.length == 0 || inp_archivos_aval.get(0).files.length == 0
        || inp_archivos_garantias_aval.get(0).files.length == 0 || inp_archivos_garantias_cliente.get(0).files.length == 0
        || inp_monto_prestar.val() == 0 || inp_pago_semana.val() == 0)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Campos vacios',
                text: 'Necesitas llenar todos los campos',
                timer: 1000,
                showCancelButton: false,
                showConfirmButton: false
            })
            
        }
        else {

            data.append('func', 'createPrestamoNuevoCliente');
            data.append('nombre_cliente', inp_nombre_cliente.val())
            data.append('direccion_cliente', inp_direccion_cliente.val())
            data.append('telefono_cliente', inp_telefono_cliente.val())
            data.append('or_cliente', inp_otras_referencias_cliente.val())
            data.append('ruta_id', $('#select_rutas_registrar option:selected').val() )
            data.append('poblacion_id', $('.select_poblaciones option:selected').val() )
            data.append('colocadora_id', $('.select_colocadoras option:selected').val())
            data.append('nombre_aval', inp_nombre_aval.val())
            data.append('direccion_aval', inp_direccion_aval.val())
            data.append('telefono_aval', inp_telefono_aval.val())
            data.append('or_aval', inp_otras_referencias_aval.val())
            data.append('garantias_cliente', inp_garantias_cliente.val())
            data.append('garantias_aval', inp_garantias_aval.val())
            data.append('cantidad_archivos_garantias_aval', inp_archivos_garantias_aval.get(0).files.length)
            data.append('cantidad_archivos_garantias_cliente', inp_archivos_garantias_cliente.get(0).files.length)
            data.append('fecha_prestamo', inp_fecha_prestamo.val())
            data.append('monto_prestado', inp_monto_prestar.val())
            data.append('monto_prestado_intereses', 0.00)
            data.append('pago_semanal', inp_pago_semana.val())
            data.append('modalidad_semanas', $('#select_modalidad option:selected').val())


            $.each(inp_archivos_cliente[0].files, function(i, file) {
                data.append('archivo_cliente_'+i, file);
            });
        
            $.each(inp_archivos_aval[0].files, function(i, file) {
                data.append('archivo_aval_'+i, file);
            });
        
            $.each(inp_archivos_garantias_aval[0].files, function(i, file) {
                data.append('garantia_aval_'+i, file);
            });
        
            $.each(inp_archivos_garantias_cliente[0].files, function(i, file) {
                data.append('garantia_cliente_'+i, file);
            });

            $.ajax({
                url: 'php/Clientes/App.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(response){
        
                    $('#modal_registrar_prestamo').modal('toggle');
                    $('#pago').addClass('d-none')
                    $('#cliente').removeClass('d-none')
                    btn_anterior_usuario.prop('disabled', true)
                    btn_siguiente_usuario.removeClass('d-none')
                    btn_guardar_prestamo.addClass('d-none')
                    modal_prestamos_label.text('Registrar cliente y aval')
                    $('#modal_dialog').addClass('modal-xl')

                    Swal.fire({
                        icon: 'success',
                        title: 'Nuevo prestamo',
                        text: 'Se ha registrado un nuevo prestamo',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
    
                    getClientes()
                    getPrestamos()
        
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
    

    }
    else if(id == "cliente-existente"){
        //alert(id)
        if( inp_direccion_cliente_existente.val() == "" || inp_telefono_cliente_existente.val() == "" || inp_nombre_aval.val() == "" || inp_direccion_aval.val() == "" || inp_telefono_aval.val() == ""
        || inp_otras_referencias_aval.val() == "" || select_clientes_registrar.val() == "0" 
        || inp_garantias_cliente_existente.val() == "" || inp_garantias_aval.val() == ""
        || inp_archivos_cliente_existente.get(0).files.length == 0 || inp_archivos_aval.get(0).files.length == 0
        || inp_archivos_garantias_aval.get(0).files.length == 0 || inp_archivos_garantias_cliente_existente.get(0).files.length == 0
        || inp_monto_prestar.val() == 0 || inp_pago_semana.val() == 0
        || $('#select_rutas_registrar_existente option:selected').val() == 0
        || $('#select_colocadoras_registrar_existente option:selected').val() == 0
        ||  $('#select_poblaciones_registrar_existente option:selected').val() == 0
        || clienteID == ""
        )
        {
            Swal.fire({
                icon: 'warning',
                title: 'Campos vacios',
                text: 'Necesitas llenar todos los campos',
                timer: 1000,
                showCancelButton: false,
                showConfirmButton: false
            })

        }
        else {

            data.append('func', 'createPrestamoClienteExistente');
            data.append('cliente_id', clienteID)
            data.append('direccion_cliente', inp_direccion_cliente_existente.val())
            data.append('telefono_cliente', inp_telefono_cliente_existente.val())
            data.append('ruta_id', $('#select_rutas_registrar_existente option:selected').val() )
            data.append('poblacion_id', $('#select_poblaciones_registrar_existente option:selected').val() )
            data.append('colocadora_id', $('#select_colocadoras_registrar_existente option:selected').val())
            data.append('nombre_aval', inp_nombre_aval.val())
            data.append('direccion_aval', inp_direccion_aval.val())
            data.append('telefono_aval', inp_telefono_aval.val())
            data.append('or_aval', inp_otras_referencias_aval.val())
            data.append('garantias_cliente', inp_garantias_cliente_existente.val())
            data.append('garantias_aval', inp_garantias_aval.val())
            data.append('cantidad_archivos_garantias_aval', inp_archivos_garantias_aval.get(0).files.length)
            data.append('cantidad_archivos_garantias_cliente', inp_archivos_garantias_cliente_existente.get(0).files.length)
            data.append('fecha_prestamo', inp_fecha_prestamo.val())
            data.append('monto_prestado', inp_monto_prestar.val())
            data.append('monto_prestado_intereses', 0.00)
            data.append('pago_semanal', inp_pago_semana.val())
            data.append('modalidad_semanas', $('#select_modalidad option:selected').val())

            $.each(inp_archivos_cliente_existente[0].files, function(i, file) {
                data.append('archivo_cliente_'+i, file);
            });
        
            $.each(inp_archivos_aval[0].files, function(i, file) {
                data.append('archivo_aval_'+i, file);
            });
        
            $.each(inp_archivos_garantias_aval[0].files, function(i, file) {
                data.append('garantia_aval_'+i, file);
            });
        
            $.each(inp_archivos_garantias_cliente_existente[0].files, function(i, file) {
                data.append('garantia_cliente_'+i, file);
            });

            $.ajax({
                url: 'php/Clientes/App.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(response){
        
                    $('#modal_registrar_prestamo').modal('toggle');
                    $('#pago').addClass('d-none')
                    $('#cliente').removeClass('d-none')
                    btn_anterior_usuario.prop('disabled', true)
                    btn_siguiente_usuario.removeClass('d-none')
                    btn_guardar_prestamo.addClass('d-none')
                    modal_prestamos_label.text('Registrar cliente y aval')
                    $('#modal_dialog').addClass('modal-xl')

                    Swal.fire({
                        icon: 'success',
                        title: 'Nuevo prestamo',
                        text: 'Se ha registrado un nuevo prestamo',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
    

                    getPrestamos()
        
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

       

    }
})



function getRutas(nombre_ruta = ""){

    var datasend = {
        func: "rutasActivas"
    };

    $.ajax({

        type: 'POST',
        url: 'php/Rutas/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){


                $('.select_rutas').empty()
                $('.select_rutas').append(`
                    <option value="0" >Seleccionar ruta</option>
                `)

                var tabSeleccionado = $('.tab-content .active').attr('id');

                if(tabSeleccionado == 'cliente-existente'){

                    $('#select_rutas_registrar_existente').prop( "disabled", false );
                    console.log(nombre_ruta)
                }

                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_rutas').append(`
                        <option name="${response.data[i].nombre_ruta}" value="${response.data[i].id}">${response.data[i].nombre_ruta}</option>
                    `)

                    if(tabSeleccionado == 'cliente-existente'){
                        $(`#select_rutas_registrar_existente option[name='${nombre_ruta}']`).attr('selected','selected');
                    }

                }

                $('#select_rutas_filtro').empty()
                $('#select_rutas_filtro').append(`
                    <option value="0" >General</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_rutas_filtro').append(`
                        <option name="${response.data[i].nombre_ruta}" value="${response.data[i].id}">${response.data[i].nombre_ruta}</option>
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


function getPoblacionesRuta(ruta_id, nombre_poblacion = ""){


    var datasend = {
        func: "poblacionesRuta",
        ruta_id
    };

    $.ajax({

        type: 'POST',
        url: 'php/Poblaciones/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('.select_poblaciones').empty()
                $('.select_poblaciones').append(`
                    <option value="0" >Seleccionar población</option>
                `)

                if(response.data.length > 0){

                    $('.select_poblaciones.editar').prop( "disabled", false );

                    var tabSeleccionado = $('.tab-content .active').attr('id');

                    if(tabSeleccionado == 'cliente-existente'){
                        $('#select_poblaciones_registrar_existente').prop( "disabled", false );
                        console.log(nombre_poblacion)
                    }

                    for(var i = 0; i < response.data.length; i++ ){
                    
                        $('.select_poblaciones').append(`
                            <option name="${response.data[i].nombre_poblacion}" value="${response.data[i].id}">${response.data[i].nombre_poblacion}</option>
                        `)

                        if(tabSeleccionado == 'cliente-existente'){
                            $(`#select_poblaciones_registrar_existente option[name='${nombre_poblacion}']`).attr('selected','selected');
                        }
    
                    }
                }
                else{
                    $('.select_poblaciones').prop( "disabled", true );
                    $('.select_poblaciones').val(0).trigger('change.select2');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'Esta ruta no tienen poblaciones asignadas aún',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
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


function getColocadorasRutaPoblacion(ruta_id, poblacion_id, nombre_colocadora = ""){

    var datasend = {
        func: "colocadorasRutaPoblacion",
        ruta_id,
        poblacion_id
    };

    $.ajax({

        type: 'POST',
        url: 'php/Colocadoras/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                if(response.data.length > 0){

                    $('.select_colocadoras').empty()
                    $('.select_colocadoras').append(`
                        <option value="0" >Seleccionar colocadora</option>
                    `)

                    var tabSeleccionado = $('.tab-content .active').attr('id');

                    if(tabSeleccionado == 'cliente-existente'){

                        $('#select_colocadoras_registrar_existente').prop( "disabled", false );

                        console.log(nombre_colocadora)
                    }

                    for(var i = 0; i < response.data.length; i++ ){

                        $('.select_colocadoras.editar').prop( "disabled", false );

                        
                        $('.select_colocadoras').append(`
                            <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo}</option>
                        `)

                        if(tabSeleccionado == 'cliente-existente'){
                            $(`#select_colocadoras_registrar_existente option[name='${nombre_colocadora}']`).attr('selected','selected');
                        }


                    }
                
                }
                else{
                    $('.select_colocadoras').prop( "disabled", true );
                    $('.select_colocadoras').val(0).trigger('change.select2');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'Esta poblacion no tiene colcadoras asignadas aún',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })

    

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


                $('.select_clientes').empty()
                $('.select_clientes').append(`
                    <option value="0" >Seleccionar cliente</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_clientes').append(`
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo}</option>
                    `)

                    /*if(rutaCliente != ""){
                        $(`.select_rutas.editar option[name='${rutaCliente}']`).attr('selected','selected');
                    }*/


                }


                /*$('#select_rutas_filtro').empty()
                $('#select_rutas_filtro').append(`
                    <option value="0" >General</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_rutas_filtro').append(`
                        <option name="${response.data[i].nombre_ruta}" value="${response.data[i].id}">${response.data[i].nombre_ruta}</option>
                    `)

                }*/


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



function traerCliente(id){


    var datasend = {
        func: "traerCliente",
        id
    };

    $.ajax({

        type: 'POST',
        url: 'php/Clientes/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                var objectLength = Object.keys(response.data).length;

                if(objectLength > 0){

                    console.log(response.data)

                    var tabSelecionado = $('.tab-content .active').attr('id');

                    if(tabSelecionado == "cliente-existente"){
                        getRutas(response.data.nombre_ruta)
                        getPoblacionesRuta(response.data.ruta_id, response.data.nombre_poblacion)
                        getColocadorasRutaPoblacion(response.data.ruta_id, response.data.poblacion_id, response.data.nombre_colocadora)
                        inp_direccion_cliente_existente.val(response.data.direccion)
                        inp_telefono_cliente_existente.val(response.data.telefono)
                        inp_garantias_cliente_existente.val(response.data.garantias)
                    }
                   
                
                }
                else{
                    if(id != 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El usuario no existe',
                        }).then((result) => {
                            $('#modal_registrar_prestamo').modal('toggle');
                            window.location.href = RemoveParameterFromUrl(window.location.href, 'c')
    
                        })
                    }
                    else{

                        inp_direccion_cliente_existente.val('')
                        inp_telefono_cliente_existente.val('')
                        inp_garantias_cliente_existente.val('')
                        inp_nombre_aval.val('')
                        inp_direccion_aval.val('')
                        inp_telefono_aval.val('')
                        inp_otras_referencias_aval.val('')
                        inp_garantias_cliente.val('')
                
                        $('#select_rutas_registrar_existente').val(0).trigger('change.select2');
                        $('#select_poblaciones_registrar_existente').val(0).trigger('change.select2');
                        $('#select_colocadoras_registrar_existente').val(0).trigger('change.select2');
                        $('#select_poblaciones_registrar_existente').prop('disabled', true)
                        $('#select_colocadoras_registrar_existente').prop('disabled', true)
                        $('#select_poblaciones_registrar_existente').empty()
                        $('#select_colocadoras_registrar_existente').empty()
                        $('#select_poblaciones_registrar').empty()
                        $('#select_colocadoras_registrar').empty()
                        
                    }
                    
    
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

function generarSemanas(semanas, fecha_prestamo){

    fecha = moment(fecha_prestamo, 'YYYY-MM-DD')
   /* for(var i = 0; i < 20; i++){
        console.log(fecha.add(i, 'weeks').format('YYYY-MM-DD'))
    }*/
    console.log(fecha.add(15, 'weeks').format('YYYY-MM-DD'))
    /*var fecha = new Date(fecha_prestamo);
    var dias = 2; // Número de días a agregar
    fecha.setDate(fecha.getDate() + dias);
    console.info(fecha)*/
}


function getPrestamosExcel(prestamo_id){

    var datasend = {
        func: 'fechasPago',
        prestamo_id
    }

    $.ajax({

        type: 'POST',
        url: 'php/Pagos/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                console.log(response.data)

                //table.clear()
                for(var i = 0; i < response.data.length; i++ ){

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pagandose</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    
                    if(response.data[i].modalidad_semanas == "15"){

                        table.row.add([
                            response.data[i].nombre_completo, 
                            response.data[i].direccion_cliente,
                            response.data[i].telefono_cliente,
                            response.data[i].nombre_aval,
                            response.data[i].direccion_aval,
                            response.data[i].telefono_aval,
                            "$ " + response.data[i].monto_prestado,
                            "$ " + response.data[i].pago_semanal,
                            moment(response.data[i].semana1).format("DD/MM/YYYY"),
                            moment(response.data[i].semana2).format("DD/MM/YYYY"),
                            moment(response.data[i].semana3).format("DD/MM/YYYY"),
                            moment(response.data[i].semana4).format("DD/MM/YYYY"),
                            moment(response.data[i].semana5).format("DD/MM/YYYY"),
                            moment(response.data[i].semana6).format("DD/MM/YYYY"),
                            moment(response.data[i].semana7).format("DD/MM/YYYY"),
                            moment(response.data[i].semana8).format("DD/MM/YYYY"),
                            moment(response.data[i].semana9).format("DD/MM/YYYY"),
                            moment(response.data[i].semana10).format("DD/MM/YYYY"),
                            moment(response.data[i].semana11).format("DD/MM/YYYY"),
                            moment(response.data[i].semana12).format("DD/MM/YYYY"),
                            moment(response.data[i].semana13).format("DD/MM/YYYY"),
                            moment(response.data[i].semana14).format("DD/MM/YYYY"),
                            moment(response.data[i].semana15).format("DD/MM/YYYY"),
                            '',
                            '',
                            '',
                            '',
                            '',
                            status,
                            `
                            <a class="btn btn-info btn_ver_semanas" title="Ver pagos" href="${env.local.url}pagos.php?p=${response.data[i].id}"><i class="fa-solid fa-eye"></i></a>
                            `,
                            response.data[i].created_at,

                        ]);

                    }
                    else if(response.data[i].modalidad_semanas == "20"){

                        table.row.add([
                            response.data[i].nombre_completo, 
                            response.data[i].direccion_cliente,
                            response.data[i].telefono_cliente,
                            response.data[i].nombre_aval,
                            response.data[i].direccion_aval,
                            response.data[i].telefono_aval,
                            "$ " + response.data[i].monto_prestado,
                            "$ " + response.data[i].pago_semanal,
                            moment(response.data[i].semana1).format("DD/MM/YYYY"),
                            moment(response.data[i].semana2).format("DD/MM/YYYY"),
                            moment(response.data[i].semana3).format("DD/MM/YYYY"),
                            moment(response.data[i].semana4).format("DD/MM/YYYY"),
                            moment(response.data[i].semana5).format("DD/MM/YYYY"),
                            moment(response.data[i].semana6).format("DD/MM/YYYY"),
                            moment(response.data[i].semana7).format("DD/MM/YYYY"),
                            moment(response.data[i].semana8).format("DD/MM/YYYY"),
                            moment(response.data[i].semana9).format("DD/MM/YYYY"),
                            moment(response.data[i].semana10).format("DD/MM/YYYY"),
                            moment(response.data[i].semana11).format("DD/MM/YYYY"),
                            moment(response.data[i].semana12).format("DD/MM/YYYY"),
                            moment(response.data[i].semana13).format("DD/MM/YYYY"),
                            moment(response.data[i].semana14).format("DD/MM/YYYY"),
                            moment(response.data[i].semana15).format("DD/MM/YYYY"),
                            moment(response.data[i].semana16).format("DD/MM/YYYY"),
                            moment(response.data[i].semana17).format("DD/MM/YYYY"),
                            moment(response.data[i].semana18).format("DD/MM/YYYY"),
                            moment(response.data[i].semana19).format("DD/MM/YYYY"),
                            moment(response.data[i].semana20).format("DD/MM/YYYY"),
                            status,
                            `
                            <a class="btn btn-info btn_ver_semanas" title="Ver pagos" href="${env.local.url}pagos.php?p=${response.data[i].id}"><i class="fa-solid fa-eye"></i></a>
                            `,
                            response.data[i].created_at,

                        ]);

                    }
                }
               


                table.draw();

                /*for(var i = 0; i < response.data.length; i++ ){

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Pagado</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-warning">Pagandose</span>'
                    }
                    else if(response.data[i].status == -1){
                        status = '<span class="badge badge-danger">No pagó</span>'
                    }
                    
                    if(response.data[i].modalidad_semanas == "15"){
                        tableExcel.row.add([
                            response.data[i].nombre_completo, 
                            response.data[i].direccion,
                            response.data[i].telefono,
                            response.data[i].nombre_aval,
                            response.data[i].direccion_aval,
                            response.data[i].telefono_aval,
                            response.data[i].monto_prestado,
                            response.data[i].pago_semanal,
                            response.data[i].modalidad_semanas,
                            moment(response.data[i].semana1).format("DD/MM/YYYY"),
                            moment(response.data[i].semana2).format("DD/MM/YYYY"),
                            moment(response.data[i].semana3).format("DD/MM/YYYY"),
                            moment(response.data[i].semana4).format("DD/MM/YYYY"),
                            moment(response.data[i].semana5).format("DD/MM/YYYY"),
                            moment(response.data[i].semana6).format("DD/MM/YYYY"),
                            moment(response.data[i].semana7).format("DD/MM/YYYY"),
                            moment(response.data[i].semana8).format("DD/MM/YYYY"),
                            moment(response.data[i].semana9).format("DD/MM/YYYY"),
                            moment(response.data[i].semana10).format("DD/MM/YYYY"),
                            moment(response.data[i].semana11).format("DD/MM/YYYY"),
                            moment(response.data[i].semana12).format("DD/MM/YYYY"),
                            moment(response.data[i].semana13).format("DD/MM/YYYY"),
                            moment(response.data[i].semana14).format("DD/MM/YYYY"),
                            moment(response.data[i].semana15).format("DD/MM/YYYY"),
                            '',
                            '',
                            '',
                            '',
                            '',
                            status
                        
                        ]);
                    }
                    else if(response.data[i].modalidad_semanas == "20"){
                        tableExcel.row.add([
                            response.data[i].nombre_completo, 
                            response.data[i].direccion,
                            response.data[i].telefono,
                            response.data[i].nombre_aval,
                            response.data[i].direccion_aval,
                            response.data[i].telefono_aval,
                            response.data[i].monto_prestado,
                            response.data[i].pago_semanal,
                            response.data[i].modalidad_semanas,
                            moment(response.data[i].semana1).format("DD/MM/YYYY"),
                            moment(response.data[i].semana2).format("DD/MM/YYYY"),
                            moment(response.data[i].semana3).format("DD/MM/YYYY"),
                            moment(response.data[i].semana4).format("DD/MM/YYYY"),
                            moment(response.data[i].semana5).format("DD/MM/YYYY"),
                            moment(response.data[i].semana6).format("DD/MM/YYYY"),
                            moment(response.data[i].semana7).format("DD/MM/YYYY"),
                            moment(response.data[i].semana8).format("DD/MM/YYYY"),
                            moment(response.data[i].semana9).format("DD/MM/YYYY"),
                            moment(response.data[i].semana10).format("DD/MM/YYYY"),
                            moment(response.data[i].semana11).format("DD/MM/YYYY"),
                            moment(response.data[i].semana12).format("DD/MM/YYYY"),
                            moment(response.data[i].semana13).format("DD/MM/YYYY"),
                            moment(response.data[i].semana14).format("DD/MM/YYYY"),
                            moment(response.data[i].semana15).format("DD/MM/YYYY"),
                            moment(response.data[i].semana16).format("DD/MM/YYYY"),
                            moment(response.data[i].semana17).format("DD/MM/YYYY"),
                            moment(response.data[i].semana18).format("DD/MM/YYYY"),
                            moment(response.data[i].semana19).format("DD/MM/YYYY"),
                            moment(response.data[i].semana20).format("DD/MM/YYYY"),
                            status
                        
                        ]);
                    }
                    

                }

                tableExcel.draw();*/


            }

        },
        error : function(e){

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