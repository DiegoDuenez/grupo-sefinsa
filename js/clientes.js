
URL = 'php/Clientes/App.php'


var btn_guardar_cliente = $('#btn_guardar_cliente')
var btn_guardar_editar_cliente = $('#btn_guardar_editar_cliente')

var inp_nombre_cliente = $('#inp_nombre_cliente')
var inp_direccion_cliente = $('#inp_direccion_cliente')
var inp_telefono_cliente = $('#inp_telefono_cliente')
var inp_otras_referencias_cliente = $('#inp_otras_referencias_cliente')

var inp_nombre_aval = $('#inp_nombre_aval')
var inp_direccion_aval = $('#inp_direccion_aval')
var inp_telefono_aval = $('#inp_telefono_aval')
var inp_otras_referencias_aval = $('#inp_otras_referencias_aval')

var inp_garantias_cliente = $('#inp_garantias_cliente')
var inp_garantias_aval = $('#inp_garantias_aval')

var inp_archivos_cliente = $('#inp_archivos_cliente')
var inp_archivos_aval = $('#inp_archivos_aval')
var inp_archivos_garantias_cliente = $('#inp_archivos_garantias_cliente')
var inp_archivos_garantias_aval = $('#inp_archivos_garantias_aval')


var inp_editar_nombre_cliente = $('#inp_editar_nombre_cliente')
var inp_editar_direccion_cliente = $('#inp_editar_direccion_cliente')
var inp_editar_telefono_cliente = $('#inp_editar_telefono_cliente')
var inp_editar_otras_referencias_cliente = $('#inp_editar_otras_referencias_cliente')

var inp_editar_nombre_aval = $('#inp_editar_nombre_aval')
var inp_editar_direccion_aval = $('#inp_editar_direccion_aval')
var inp_editar_telefono_aval = $('#inp_editar_telefono_aval')
var inp_editar_otras_referencias_aval = $('#inp_editar_otras_referencias_aval')

var inp_editar_garantias_cliente = $('#inp_editar_garantias_cliente')
var inp_editar_garantias_aval = $('#inp_editar_garantias_aval')

var rutaCliente = ""
var poblacionCliente = ""
var colocadoraCliente = ""
var idClienteEditar = 0
var idAvalEditar = 0

/*
var inp_domicilio_cliente = $('#inp_domicilio_cliente')
var inp_ine_cliente = $('#inp_ine_cliente')
var inp_tarjeton_cliente = $('#inp_tarjeton_cliente')
var inp_contrato_cliente = $('#inp_contrato_cliente')
var inp_pagare_cliente = $('#inp_pagare_cliente')

var inp_domicilio_aval = $('#inp_domicilio_aval')
var inp_ine_aval = $('#inp_ine_aval')
*/
var table;

$(document).ready(function(){

    table = $('#tabla_clientes').DataTable( {
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
        }
    })

    getClientes()
    getRutas()
    getPoblaciones()
    getColocadoras()

    $('#select_colocadoras_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});
    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});

    $('#select_colocadoras_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});
    $('#select_rutas_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});
    $('#select_poblaciones_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});

    
    $('#select_rutas_filtro').select2({theme: 'bootstrap4', width: '100%'});
    $('#select_poblaciones_filtro').select2({theme: 'bootstrap4', width: '100%'});
    $('#select_colocadoras_filtro').select2({theme: 'bootstrap4', width: '100%'});



});

function getClientes(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO CLIENTES...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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

                    var colocadoraTag = ""
                    var colocadoraStatus = "";
                    var colocadoraClass = ""

                    if(response.data[i].status_colocadora == 0){
                        colocadoraStatus = '(Colocadora deshabilitada)'
                        colocadoraClass = 'text-danger'
                    }

                    if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente && response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ni a la población ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</>`
                    }
                    else if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else if(response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la poblacion ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else{
                        colocadoraTag = `<td class="colocadora ${colocadoraClass}" title='${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    }

                    table.row.add([
                        response.data[i].nombre_completo, 
                        response.data[i].direccion,
                        response.data[i].telefono,
                        response.data[i].nombre_ruta,
                        response.data[i].nombre_poblacion,
                        colocadoraTag,
                        response.data[i].nombre_aval == null ? '(Por definir)' : response.data[i].nombre_aval ,
                        `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, 
                            ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id},
                            \'${response.data[i].nombre_completo}\', \'${response.data[i].direccion}\', \'${response.data[i].telefono}\',
                            \'${response.data[i].nombre_ruta}\', \'${response.data[i].nombre_poblacion}\', \'${response.data[i].nombre_colocadora}\',
                            \'${response.data[i].nombre_aval}\', \'${response.data[i].otras_referencias}\', \'${response.data[i].garantias}\')" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <form action="php/PDF/pdf.php" method="POST" class="d-inline">
                            <input type="hidden" value="${response.data[i].id}" name="id"/>
                            <button class="btn btn-danger btn_pdf_usuario" type="submit" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                        </form>
                        `
                    ]);


                }
                table.draw();



                /*$('#table_body').empty()
                for(var i = 0; i < response.data.length; i++ ){

                    var colocadoraTag = ""
                    var colocadoraStatus = "";
                    var colocadoraClass = ""

                    if(response.data[i].status_colocadora == 0){
                        colocadoraStatus = '(Colocadora deshabilitada)'
                        colocadoraClass = 'text-danger'
                    }
                   

                    if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente && response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ni a la población ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</>`
                    }
                    else if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else if(response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la poblacion ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else{
                        colocadoraTag = `<td class="colocadora ${colocadoraClass}" title='${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    }
                    

                    $('#table_body').append(`
                    <tr>
                    <td class="id d-none"> ${response.data[i].id} </td>
                    <td class="nombre_completo"> ${response.data[i].nombre_completo} </td>
                    <td class="direccion"> ${response.data[i].direccion} </td>
                    <td class="telefono"> ${response.data[i].telefono} </td>
                    <td class="ruta"> ${response.data[i].nombre_ruta}  </td>
                    <td class="poblacion"> ${response.data[i].nombre_poblacion}</td>
                    ${colocadoraTag}
                    
                    <td class="or d-none"> ${response.data[i].otras_referencias}</td>
                    <td class="garantias d-none"> ${response.data[i].garantias}</td>
                    <td class="nombre_aval d-flex justify-content-between w-100"> ${response.data[i].nombre_aval} </td>
                    <td class="direccion_aval d-none"> ${response.data[i].direccion_aval}</td>
                    <td class="telefono_aval d-none"> ${response.data[i].telefono_aval}</td>
                    <td class="or_aval d-none"> ${response.data[i].or_aval}</td>
                    <td class="garantias_aval d-none"> ${response.data[i].garantias_aval}</td>

                    <td > 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id})" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <form action="php/PDF/pdf.php" method="POST" class="d-inline">
                            <input type="hidden" value="${response.data[i].id}" name="id"/>
                            <button class="btn btn-danger btn_pdf_usuario" type="submit" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                        </form>
                    </td>
    
                    </tr>
                    `)
    
                }*/

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


btn_guardar_cliente.click(function(){


    if(inp_nombre_cliente.val() == '' || inp_direccion_cliente.val() == '' || inp_telefono_cliente.val() == '' 
        || inp_otras_referencias_cliente.val() == '' 
        || $('.select_rutas option:selected').val() == 0  || $('.select_poblaciones option:selected').val() == 0 
        || $('.select_colocadoras option:selected').val() == 0 
        ){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false
        })

    }
    /*else if(inp_archivos_cliente.get(0).files.length < 5){
        Swal.fire({
            icon: 'warning',
            title: 'Archivos faltantes',
            text: 'Necesitas subir todos los archivos del cliente',
            timer: 1500,
            showCancelButton: false,
            showConfirmButton: false
        })
    }
    else if(inp_archivos_aval.get(0).files.length < 2){
        Swal.fire({
            icon: 'warning',
            title: 'Archivos faltantes',
            text: 'Necesitas subir todos los archivos del aval',
            timer: 1500,
            showCancelButton: false,
            showConfirmButton: false
        })
    }*/
    else
    {
        var colocadora_id = $('.select_colocadoras option:selected').val()
        var ruta_id = $('#select_rutas_registrar option:selected').val() 
        var poblacion_id = $('.select_poblaciones option:selected').val() 


      registrarCliente(inp_nombre_cliente.val(), inp_direccion_cliente.val(), inp_telefono_cliente.val(), inp_otras_referencias_cliente.val(),
        "", colocadora_id, ruta_id, poblacion_id)

    }


})

function registrarCliente(nombre_cliente, direccion_cliente, telefono_cliente, or_cliente, garantias_cliente, colocadora_id, ruta_id, poblacion_id){

    var datasend ={
        func: 'create',
        nombre_cliente,
        direccion_cliente,
        telefono_cliente,
        or_cliente,
        garantias_cliente,
        ruta_id, 
        poblacion_id,
        colocadora_id
    }

    $.ajax({
        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_registrar_cliente').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Nuevo empleado',
                    text: 'Se ha registrado al empleado',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                }).then((result) => {
                    window.location.href = `${env.local.url}prestamos.php?c=1`;
                })
                getClientes()
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


function editarCliente(nombre_cliente, direccion_cliente, telefono_cliente, or_cliente, garantias_cliente, colocadora_id, ruta_id, poblacion_id, cliente_id){

    var datasend ={
        func: 'edit',
        nombre_cliente,
        direccion_cliente,
        telefono_cliente,
        or_cliente,
        garantias_cliente,
        ruta_id, 
        poblacion_id,
        colocadora_id,
        cliente_id
    }

    $.ajax({
        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_editar_cliente').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Empleado actualizado',
                    text: 'Se ha actualizado al empleado',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })
                getClientes()
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

/*function registrarCliente(nombre_cliente, direccion_cliente, telefono_cliente, or_cliente, nombre_aval, direccion_aval, telefono_aval, or_aval, colocadora_id, garantias_cliente, garantias_aval, ruta_id, poblacion_id){

    var data = new FormData();
    data.append('func', 'create');
    data.append('nombre_cliente', nombre_cliente)
    data.append('direccion_cliente', direccion_cliente)
    data.append('telefono_cliente', telefono_cliente)
    data.append('or_cliente', or_cliente)
    data.append('nombre_aval', nombre_aval)
    data.append('direccion_aval', direccion_aval)
    data.append('telefono_aval', telefono_aval)
    data.append('or_aval', or_aval)
    data.append('colocadora_id', colocadora_id)
    data.append('garantias_cliente', garantias_cliente)
    data.append('garantias_aval', garantias_aval)
    data.append('poblacion_id', poblacion_id)
    data.append('ruta_id', ruta_id)
    data.append('cantidad_archivos_garantias_aval', inp_archivos_garantias_aval.get(0).files.length)
    data.append('cantidad_archivos_garantias_cliente', inp_archivos_garantias_cliente.get(0).files.length)


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
        url: URL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(response){

                $('#modal_registrar_cliente').modal('toggle');

                Swal.fire({
                    icon: 'success',
                    title: 'Nuevo cliente',
                    text: 'Se ha registrado al cliente',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })

                getClientes()
            //}

        },
        error : function(e){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });
    
}*/


btn_guardar_editar_cliente.click(function(){


    if(inp_editar_nombre_cliente.val() == '' || inp_editar_direccion_cliente.val() == '' || inp_editar_telefono_cliente.val() == '' 
        || inp_editar_otras_referencias_cliente.val() == ''
        || $('#select_rutas_editar option:selected').val() == 0  || $('#select_poblaciones_editar option:selected').val() == 0 
        || $('#select_colocadoras_editar option:selected').val() == 0 
        ){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false
        })

    }
    else{

        var colocadora_id = $('#select_colocadoras_editar option:selected').val()
        var ruta_id = $('#select_rutas_editar option:selected').val() 
        var poblacion_id = $('#select_poblaciones_editar option:selected').val() 

       /* editarCliente(inp_editar_nombre_cliente.val(), inp_editar_direccion_cliente.val(), inp_editar_telefono_cliente.val(), inp_editar_otras_referencias_cliente.val(),
                        inp_editar_nombre_aval.val(), inp_editar_direccion_aval.val(), inp_editar_telefono_aval.val(), inp_editar_otras_referencias_aval.val(), colocadora_id,
                        inp_editar_garantias_cliente.val(), inp_editar_garantias_aval.val(), idClienteEditar, idAvalEditar, ruta_id, poblacion_id)*/

        editarCliente(inp_editar_nombre_cliente.val(), inp_editar_direccion_cliente.val(), inp_editar_telefono_cliente.val(), inp_editar_otras_referencias_cliente.val(),
        "", colocadora_id, ruta_id, poblacion_id,idClienteEditar)
    }

})

/*function editarCliente(nombre_cliente, direccion_cliente, telefono_cliente, or_cliente, nombre_aval, direccion_aval, telefono_aval, or_aval, colocadora_id, garantias_cliente, garantias_aval, cliente_id, aval_id, ruta_id, poblacion_id){

    var data = new FormData();
    data.append('func', 'edit');
    data.append('nombre_cliente', nombre_cliente)
    data.append('direccion_cliente', direccion_cliente)
    data.append('telefono_cliente', telefono_cliente)
    data.append('or_cliente', or_cliente)
    data.append('nombre_aval', nombre_aval)
    data.append('direccion_aval', direccion_aval)
    data.append('telefono_aval', telefono_aval)
    data.append('or_aval', or_aval)
    data.append('colocadora_id', colocadora_id)
    data.append('garantias_cliente', garantias_cliente)
    data.append('garantias_aval', garantias_aval)
    data.append('aval_id', aval_id)
    data.append('cliente_id', cliente_id)
    data.append('ruta_id', ruta_id)
    data.append('poblacion_id', poblacion_id)



    $.ajax({
        url: URL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(response){

            

                $('#modal_editar_cliente').modal('toggle');

                Swal.fire({
                    icon: 'success',
                    title: 'Cliente actualizado',
                    text: 'Se ha actualizado al cliente',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })

                getClientes()
           // }

        },
        error : function(e){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });

}*/



$('#select_rutas_registrar').on('change', function() {
    $('#select_poblaciones_registrar').prop( "disabled", false );
    getPoblacionesRuta(this.value);
});

$('#select_poblaciones_registrar').on('change', function() {
    $('#select_colocadoras_registrar').prop( "disabled", false);
    getColocadorasRutaPoblacion($('#select_rutas_registrar option:selected').val(), this.value);
});


$('#select_rutas_editar').on('change', function() {
    $('#select_poblaciones_editar').prop( "disabled", false );
    getPoblacionesRuta(this.value);
});

$('#select_poblaciones_editar').on('change', function() {
    $('#select_colocadoras_editar').prop( "disabled", false);
    getColocadorasRutaPoblacion($('#select_rutas_editar option:selected').val(), this.value);
});

/* FILTROS */

$('#select_rutas_filtro').on('change', function(){
    $('#select_poblaciones_filtro').val(0).trigger('change.select2');
    $('#select_colocadoras_filtro').val(0).trigger('change.select2');
    if(this.value == 0){
        getClientes();
    }
    else{
        getClientesRuta(this.value)
    }
})

$('#select_poblaciones_filtro').on('change', function(){
    $('#select_colocadoras_filtro').val(0).trigger('change.select2');
    $('#select_rutas_filtro').val(0).trigger('change.select2');
    if(this.value == 0){
        getClientes();
    }
    else{
        getClientesPoblacion(this.value)
    }
})

$('#select_colocadoras_filtro').on('change', function(){
    $('#select_poblaciones_filtro').val(0).trigger('change.select2');
    $('#select_rutas_filtro').val(0).trigger('change.select2');
    if(this.value == 0){
        getClientes();
    }
    else{
        getClientesColocadora(this.value)
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

                    if(rutaCliente != ""){
                        $(`.select_rutas.editar option[name='${rutaCliente}']`).attr('selected','selected');
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
    
                        if(poblacionCliente != ""){
                            $(`.select_poblaciones.editar option[name='${poblacionCliente}']`).attr('selected','selected');
                        }
    
    
                    }
                }
                else{
                    $('.select_poblaciones').prop( "disabled", true );
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


function getPoblaciones(){


    var datasend = {
        func: "index",
    };

    $.ajax({

        type: 'POST',
        url: 'php/Poblaciones/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('#select_poblaciones_filtro').empty()
                $('#select_poblaciones_filtro').append(`
                    <option value="0" >General</option>
                `)

                for(var i = 0; i < response.data.length; i++ ){
                
                    $('#select_poblaciones_filtro').append(`
                        <option name="${response.data[i].nombre_poblacion}" value="${response.data[i].id}">${response.data[i].nombre_poblacion}</option>
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

                        if(colocadoraCliente != ""){
                            $(`.select_colocadoras.editar option[name='${colocadoraCliente}']`).attr('selected','selected');
                        }


                    }
                
                }
                else{
                    $('.select_colocadoras').prop( "disabled", true );
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


function getColocadoras(){


    var datasend = {
        func: "colocadorasActivas",
    };

    $.ajax({

        type: 'POST',
        url: 'php/Colocadoras/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('#select_colocadoras_filtro').empty()
                $('#select_colocadoras_filtro').append(`
                    <option value="0" >General</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){

                    $('#select_colocadoras_filtro').append(`
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


function modalEditarCliente(e, cliente_id, aval_id, ruta_id, poblacion_id, nombre_completo, direccion, telefono, ruta, poblacion, colocadora, nombre_aval, otras_referencias, garantias){


    /** CAMPOS OCULTOS */

    /*var otras_referencias = $(e).closest("tr") 
    .find(".or") 
    .text();  

    var garantias = $(e).closest("tr") 
    .find(".garantias") 
    .text();  

    var direccion_aval = $(e).closest("tr") 
    .find(".direccion_aval") 
    .text();  

    var telefono_aval = $(e).closest("tr") 
    .find(".telefono_aval") 
    .text();  

    var or_aval = $(e).closest("tr") 
    .find(".or_aval") 
    .text();  

    var garantias_aval = $(e).closest("tr") 
    .find(".garantias_aval") 
    .text();  */


    inp_editar_nombre_cliente.val($.trim(nombre_completo))
    inp_editar_direccion_cliente.val($.trim(direccion))
    inp_editar_telefono_cliente.val($.trim(telefono))
    inp_editar_otras_referencias_cliente.val($.trim(otras_referencias))
    inp_editar_garantias_cliente.val($.trim(garantias))
   /* inp_editar_direccion_aval.val($.trim(direccion_aval))
    inp_editar_telefono_aval.val($.trim(telefono_aval))
    inp_editar_otras_referencias_aval.val($.trim(or_aval))
    inp_editar_garantias_aval.val($.trim(garantias_aval))*/


    idClienteEditar = cliente_id
    idAvalEditar = aval_id
    rutaCliente = $.trim(ruta)
    poblacionCliente = $.trim(poblacion)
    colocadoraCliente = $.trim(colocadora)
    inp_editar_nombre_aval.val($.trim(nombre_aval))
    
    getRutas()
    getPoblacionesRuta(ruta_id)
    getColocadorasRutaPoblacion(ruta_id, poblacion_id)

}



function getClientesRuta(ruta_id){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO CLIENTES...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

    var datasend = {
        func: "clientesRuta",
        ruta_id
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

                    var colocadoraTag = ""
                    var colocadoraStatus = "";
                    var colocadoraClass = ""

                    if(response.data[i].status_colocadora == 0){
                        colocadoraStatus = '(Colocadora deshabilitada)'
                        colocadoraClass = 'text-danger'
                    }

                    if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente && response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ni a la población ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</>`
                    }
                    else if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else if(response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la poblacion ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else{
                        colocadoraTag = `<td class="colocadora ${colocadoraClass}" title='${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    }

                    table.row.add([
                        response.data[i].nombre_completo, 
                        response.data[i].direccion,
                        response.data[i].telefono,
                        response.data[i].nombre_ruta,
                        response.data[i].nombre_poblacion,
                        colocadoraTag,
                        response.data[i].nombre_aval,
                        `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, 
                            ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id},
                            \'${response.data[i].nombre_completo}\', \'${response.data[i].direccion}\', \'${response.data[i].telefono}\',
                            \'${response.data[i].nombre_ruta}\', \'${response.data[i].nombre_poblacion}\', \'${response.data[i].nombre_colocadora}\',
                            \'${response.data[i].nombre_aval}\', \'${response.data[i].otras_referencias}\', \'${response.data[i].garantias}\')" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <form action="php/PDF/pdf.php" method="POST" class="d-inline">
                            <input type="hidden" value="${response.data[i].id}" name="id"/>
                            <button class="btn btn-danger btn_pdf_usuario" type="submit" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                        </form>
                        `
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


function getClientesPoblacion(poblacion_id){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO CLIENTES...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

    var datasend = {
        func: "clientesPoblacion",
        poblacion_id
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

                    var colocadoraTag = ""
                    var colocadoraStatus = "";
                    var colocadoraClass = ""

                    if(response.data[i].status_colocadora == 0){
                        colocadoraStatus = '(Colocadora deshabilitada)'
                        colocadoraClass = 'text-danger'
                    }

                    if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente && response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ni a la población ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</>`
                    }
                    else if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else if(response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la poblacion ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else{
                        colocadoraTag = `<td class="colocadora ${colocadoraClass}" title='${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    }

                    table.row.add([
                        response.data[i].nombre_completo, 
                        response.data[i].direccion,
                        response.data[i].telefono,
                        response.data[i].nombre_ruta,
                        response.data[i].nombre_poblacion,
                        colocadoraTag,
                        response.data[i].nombre_aval,
                        `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, 
                            ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id},
                            \'${response.data[i].nombre_completo}\', \'${response.data[i].direccion}\', \'${response.data[i].telefono}\',
                            \'${response.data[i].nombre_ruta}\', \'${response.data[i].nombre_poblacion}\', \'${response.data[i].nombre_colocadora}\',
                            \'${response.data[i].nombre_aval}\', \'${response.data[i].otras_referencias}\', \'${response.data[i].garantias}\')" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <form action="php/PDF/pdf.php" method="POST" class="d-inline">
                            <input type="hidden" value="${response.data[i].id}" name="id"/>
                            <button class="btn btn-danger btn_pdf_usuario" type="submit" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                        </form>
                        `
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

function getClientesColocadora(colocadora_id){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO CLIENTES...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

    var datasend = {
        func: "clientesColocadora",
        colocadora_id
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

                    var colocadoraTag = ""
                    var colocadoraStatus = "";
                    var colocadoraClass = ""

                    if(response.data[i].status_colocadora == 0){
                        colocadoraStatus = '(Colocadora deshabilitada)'
                        colocadoraClass = 'text-danger'
                    }

                    if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente && response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ni a la población ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</>`
                    }
                    else if(response.data[i].ruta_colocadora != response.data[i].ruta_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la ruta ${response.data[i].nombre_ruta} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else if(response.data[i].poblacion_colocadora != response.data[i].poblacion_cliente){
                        colocadoraTag = `<td class="colocadora text-danger" title='Esta colocadora no pertenece a la poblacion ${response.data[i].nombre_poblacion} ${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    
                    }
                    else{
                        colocadoraTag = `<td class="colocadora ${colocadoraClass}" title='${colocadoraStatus}'> ${response.data[i].nombre_colocadora}</td>`
                    }

                    table.row.add([
                        response.data[i].nombre_completo, 
                        response.data[i].direccion,
                        response.data[i].telefono,
                        response.data[i].nombre_ruta,
                        response.data[i].nombre_poblacion,
                        colocadoraTag,
                        response.data[i].nombre_aval,
                        `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, 
                            ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id},
                            \'${response.data[i].nombre_completo}\', \'${response.data[i].direccion}\', \'${response.data[i].telefono}\',
                            \'${response.data[i].nombre_ruta}\', \'${response.data[i].nombre_poblacion}\', \'${response.data[i].nombre_colocadora}\',
                            \'${response.data[i].nombre_aval}\', \'${response.data[i].otras_referencias}\', \'${response.data[i].garantias}\')" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <form action="php/PDF/pdf.php" method="POST" class="d-inline">
                            <input type="hidden" value="${response.data[i].id}" name="id"/>
                            <button class="btn btn-danger btn_pdf_usuario" type="submit" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                        </form>
                        `
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



function modalVerAval(e){

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();

    var nombre_aval = $(e).closest("tr") 
    .find(".nombre_aval") 
    .text();

    var direccion_aval = $(e).closest("tr") 
    .find(".direccion_aval") 
    .text();  

    var telefono_aval = $(e).closest("tr") 
    .find(".telefono_aval") 
    .text();  

    var or_aval = $(e).closest("tr") 
    .find(".or_aval") 
    .text();  

    var garantias_aval = $(e).closest("tr") 
    .find(".garantias_aval") 
    .text();  

    $('#modal_ver_aval_label').text("Aval de " + nombre_completo)
    $('#nombre_aval').text($.trim(nombre_aval))
    $('#direccion_aval').text($.trim(direccion_aval))
    $('#telefono_aval').text($.trim(telefono_aval))
    $('#or_aval').text($.trim(or_aval))
    $('#garantias_aval').text($.trim(garantias_aval))


}


function savePDF(e){

    
    var img  = 'http://localhost/proyecto_cobranza/resources/comprobantes/clientes/1_Diego%20Due%C3%B1ez/INE_1.jpeg';
    var img2  = 'http://localhost/proyecto_cobranza/resources/comprobantes/clientes/1_Diego%20Due%C3%B1ez/Domicilio_1.jpeg';


    var doc = new jsPDF('p', 'pt', 'a4');

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();

    var id = $(e).closest("tr") 
    .find(".id") 
    .text();

    doc.addImage(img, 'JPEG', 15, 40, 180, 160);
    doc.addImage(img2, 'JPEG', 15, 40, 180, 160);
    var base64string = doc.output('dataurlstring');
    debugBase64( base64string );

    /*var getImageFromUrl = function(url, callback) {

        var img = new Image();
        img.onError = function() {
            alert('Cannot load image: "'+url+'"');
        };
        img.onload = function() {
            callback(img);
        };
            img.src = url;
    }

    var createPDF = function(imgData) {

        var width = doc.internal.pageSize.width;    
        var height = doc.internal.pageSize.height;
        var options = {
            pagesplit: true
        };
        doc.text(10, 20, 'Crazy Monkey');
        var h1=50;
        var aspectwidth1= (height-h1)*(9/16);
        doc.addImage(imgData, 'JPEG', 10, h1, aspectwidth1, (height-h1), 'monkey');

        var base64string = doc.output('dataurlstring');
        debugBase64( base64string );

        
    }
    
        
        getImageFromUrl(`resources/comprobantes/clientes/${$.trim(id)}_${$.trim(nombre_completo)}/Domicilio_1.jpeg`, createPDF);
        getImageFromUrl(`resources/comprobantes/clientes/${$.trim(id)}_${$.trim(nombre_completo)}/INE_1.jpeg`, createPDF);*/

        
    /*var img = new Image()
    img.src = `resources/comprobantes/clientes/${$.trim(id)}_${$.trim(nombre_completo)}/Domicilio_1.jpeg`
    var img2 = new Image()
    img2.src = `resources/comprobantes/clientes/${$.trim(id)}_${$.trim(nombre_completo)}/INE_1.jpeg`

    doc.text(20,20, id + " " + nombre_completo)

    img.onload = function(){
        doc.addImage(img, 'jpeg', 10, 78, 50, 50)
        doc.addImage(img2, 'jpeg', 30, 100, 50, 50)
        var base64string = doc.output('dataurlstring');
        debugBase64( base64string );

        
    }*/
    
    
    /*$.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                for(var i = 2; i < response.data.length; i++ ){
                    console.log(response.data[i])

                    var img = new Image()
                    img.src = `resources/comprobantes/clientes/${$.trim(id)}_${$.trim(nombre_completo)}/${response.data[i]}`


                    img.onload = function(){
                        doc.text(20,20, id + " " + nombre_completo)
                        doc.addImage(img, 'jpeg', 10, 78, 50, 50)
                        var base64string = doc.output('dataurlstring');
                        debugBase64( base64string );
                        
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
    });*/

  
    

    //doc.save('ola.pdf')
    //doc.output('dataurlnewwindow')
    //doc.save('ola.pdf')
   // window.open(doc.output('dataurlstring', { filename: 'ola.pdf'}), '_blank');
    //doc.save('ola.pdf')
   /* var url = doc.output('dataurlstring');
    openDataUriWindow(url);*/
   /* uri = doc.save('hola.pdf')
    openDataUriWindow(uri);*/

    /*window.jsPDF = window.jspdf.jsPDF;
    var doc = new jspdf()
    doc.setFontSize(5)
    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();
    doc.text(20,20, nombre_completo)*/
    /* var cols = ["Cliente", "Servicio", "Inversión", "Pago de venta", "Pago proximo año", "Fecha pago inicial", "Fecha de vencimiento", "Status de pago"];
    var data = [];*/
    //doc.autoTable(cols, data,{ html: '#historialClon',margin: {top: 10}, headStyles: { fillColor: [70, 99, 180], tableWidth: '10px'}})
    //doc.output('dataurlnewwindow', {filename: 'ola.pdf'})

    
}

function debugBase64(base64URL){
    var win = window.open(base64URL, '_blank');
    //win.opener.location.reload();
    //win.document.write('<iframe src="' + base64URL  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
}

/*
async function addImageProcess(src) {
    return new Promise((resolve, reject) => {
      let img = new Image();
      img.src = src;
      img.onload = () => resolve(img);
      img.onerror = reject;
    });
  }
  

async function generatePDF(imageUrls, id, nombre) {
    const doc = new jsPDF();
    for (const [i, url] of imageUrls.entries()) {
        const image = await addImageProcess(`resources/comprobantes/clientes/${$.trim(id)}_${$.trim(nombre)}/${url}`);
        doc.addImage(image, "png", 5, 5, 0, 0);
        if (i !== imageUrls.length - 1) {
        doc.addPage();
        }
    }
    return doc;
}

async function savePDF() {

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();

    var id = $(e).closest("tr") 
    .find(".id") 
    .text();


    var datasend = {
        func: "comprobantesCliente",
        id
    };
    var images = []
    $.ajax({

        async: true,
        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                images =
               
                
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

    const pdf = await generatePdf(response.data, id, nombre_completo);

    // generate dataURLString
    const dataURLString = pdf.output("dataurlstring", "testing.pdf");
    //console.log(dataURLString);

    // save PDF (blocked in iFrame in chrome)
    pdf.output("save", "testing.pdf");

    
}*/