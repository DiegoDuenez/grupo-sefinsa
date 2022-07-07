
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

// URI
var cliente = ""
var table


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
            { "visible": false, "targets": -1 }
          ],
          order: [[9, 'desc']],
    })
    
    getPrestamos()
    getRutas()
    getClientes()
    
    $('#select_colocadoras_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_clientes_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});

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

select_clientes_registrar.on('change', function() {
    cliente = this.value
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

                table.clear()
                for(var i = 0; i < response.data.length; i++ ){
                    table.row.add([
                        response.data[i].nombre_completo, 
                        response.data[i].direccion,
                        response.data[i].telefono,
                        response.data[i].nombre_aval,
                        response.data[i].direccion_aval,
                        response.data[i].telefono_aval,
                        "$ " + response.data[i].monto_prestado,
                        "$ " + response.data[i].pago_semanal,
                        `
                        <button class="btn btn-info btn_ver_semanas" title="Ver semanas de pago" data-toggle="modal" data-target="#"><i class="fa-solid fa-eye"></i></button>
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
    if(target == "cliente-existente"){
        $("#inputs_registrar_cliente_3").addClass('d-none')      
    }
    else{
        $("#inputs_registrar_cliente_3").removeClass('d-none')      
    }
  });

btn_guardar_prestamo.click(function(){
    var id = $('.tab-content .active').attr('id');
    
    var data = new FormData();

   

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
            console.log('func', 'createPrestamoClienteExistente');
            console.log('cliente_id', cliente)
            console.log('nombre_aval', inp_nombre_aval.val())
            console.log('direccion_aval', inp_direccion_aval.val())
            console.log('telefono_aval', inp_telefono_aval.val())
            console.log('or_aval', inp_otras_referencias_aval.val())
            console.log('garantias_cliente', inp_garantias_cliente.val())
            console.log('garantias_aval', inp_garantias_aval.val())
            console.log("archivos cliente", inp_archivos_cliente.get(0).files.length)
            console.log("archivos aval", inp_archivos_aval.get(0).files.length)
            console.log('cantidad_archivos_garantias_aval', inp_archivos_garantias_aval.get(0).files.length)
            console.log('cantidad_archivos_garantias_cliente', inp_archivos_garantias_cliente.get(0).files.length)
            console.log('fecha_prestamo', inp_fecha_prestamo.val())
            console.log('monto_prestado', inp_monto_prestar.val())
            console.log('pago_semanal', inp_pago_semana.val())
        }
        else {

            data.append('func', 'createPrestamoClienteExistente');
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
            data.append('pago_semanal', inp_pago_semana.val())


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
    
                    Swal.fire({
                        icon: 'success',
                        title: 'Nuevo prestamo',
                        text: 'Se ha registrado un nuevo prestamo',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
    
                    window.location.href = RemoveParameterFromUrl(window.location.href, 'c')

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
            data.append('pago_semanal', inp_pago_semana.val())


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
    else if(id == "cliente-existente"){
        //alert(id)

        if(inp_nombre_aval.val() == "" || inp_direccion_aval.val() == "" || inp_telefono_aval.val() == ""
        || inp_otras_referencias_aval.val() == "" || select_clientes_registrar.val() == "0" 
        || inp_garantias_cliente_existente.val() == "" || inp_garantias_aval.val() == ""
        || inp_archivos_cliente_existente.get(0).files.length == 0 || inp_archivos_aval.get(0).files.length == 0
        || inp_archivos_garantias_aval.get(0).files.length == 0 || inp_archivos_garantias_cliente_existente.get(0).files.length == 0
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

            console.log('func', 'createPrestamoClienteExistente');
            console.log('cliente_id', cliente)
            console.log('garantias_cliente', inp_garantias_cliente_existente.val())
            console.log('garantias_aval', inp_garantias_aval.val())
            console.log("archivos cliente", inp_archivos_cliente_existente.get(0).files.length)
            console.log("archivos aval", inp_archivos_aval.get(0).files.length)
            console.log('cantidad_archivos_garantias_aval', inp_archivos_garantias_aval.get(0).files.length)
            console.log('cantidad_archivos_garantias_cliente', inp_archivos_garantias_cliente_existente.get(0).files.length)
            console.log('fecha_prestamo', inp_fecha_prestamo.val())
            console.log('monto_prestado', inp_monto_prestar.val())
            console.log('pago_semanal', inp_pago_semana.val())
        
        }
        else {

            data.append('func', 'createPrestamoClienteExistente');
            data.append('cliente_id', cliente)
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
            data.append('pago_semanal', inp_pago_semana.val())

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



function getRutas(){

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
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_rutas').append(`
                        <option name="${response.data[i].nombre_ruta}" value="${response.data[i].id}">${response.data[i].nombre_ruta}</option>
                    `)

                    /*if(rutaCliente != ""){
                        $(`.select_rutas.editar option[name='${rutaCliente}']`).attr('selected','selected');
                    }*/


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


function getPoblacionesRuta(ruta_id){


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

                    for(var i = 0; i < response.data.length; i++ ){
                    
                        $('.select_poblaciones').append(`
                            <option name="${response.data[i].nombre_poblacion}" value="${response.data[i].id}">${response.data[i].nombre_poblacion}</option>
                        `)
    
                       /* if(poblacionCliente != ""){
                            $(`.select_poblaciones.editar option[name='${poblacionCliente}']`).attr('selected','selected');
                        }*/
    
    
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


function getColocadorasRutaPoblacion(ruta_id, poblacion_id){

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
                    for(var i = 0; i < response.data.length; i++ ){

                        $('.select_colocadoras.editar').prop( "disabled", false );

                        
                        $('.select_colocadoras').append(`
                            <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo}</option>
                        `)

                        /*if(colocadoraCliente != ""){
                            $(`.select_colocadoras.editar option[name='${colocadoraCliente}']`).attr('selected','selected');
                        }*/


                    }
                
                }
                else{
                    $('.select_colocadoras').prop( "disabled", true );
                    $('.select_colocadoras').val(0).trigger('change.select2');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'Esta poblacion no tiene colcoadoras asignadas aún',
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
                
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El usuario no existe',
                    }).then((result) => {
                        $('#modal_registrar_prestamo').modal('toggle');
                        window.location.href = RemoveParameterFromUrl(window.location.href, 'c')

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