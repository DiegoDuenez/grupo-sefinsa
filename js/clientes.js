
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

$(document).ready(function(){

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

    
    $('#select_rutas_filtro').select2({theme: 'bootstrap4', width: '15%'});
    $('#select_poblaciones_filtro').select2({theme: 'bootstrap4', width: '15%'});
    $('#select_colocadoras_filtro').select2({theme: 'bootstrap4', width: '20%'});



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

                $('#table_body').empty()
                for(var i = 0; i < response.data.length; i++ ){
                    $('#table_body').append(`
                    <tr>
                    <td class="nombre_completo"> ${response.data[i].nombre_completo} </td>
                    <td class="direccion"> ${response.data[i].direccion} </td>
                    <td class="telefono"> ${response.data[i].telefono} </td>
                    <td class="ruta"> ${response.data[i].nombre_ruta}  </td>
                    <td class="poblacion"> ${response.data[i].nombre_poblacion}</td>
                    ${response.data[i].status_colocadora == 0 ? `<td class="colocadora text-danger" title='Esta colocadora fue deshabilidata'> ${response.data[i].nombre_colocadora}</td>` : `<td class="colocadora"> ${response.data[i].nombre_colocadora}</td>`}
                    <td class="or d-none"> ${response.data[i].otras_referencias}</td>
                    <td class="garantias d-none"> ${response.data[i].garantias}</td>

                    <td class="nombre_aval d-flex justify-content-between w-100"> ${response.data[i].nombre_aval} &nbsp;&nbsp;<button class="btn btn-info btn_ver_aval" onclick="modalVerAval(this)" title='Ver aval del cliente' data-toggle="modal" data-target="#modal_ver_aval" ><i class="fa-solid fa-eye" title='Ver información del aval'></i> </button>  </td>
                    <td class="direccion_aval d-none"> ${response.data[i].direccion_aval}</td>
                    <td class="telefono_aval d-none"> ${response.data[i].telefono_aval}</td>
                    <td class="or_aval d-none"> ${response.data[i].or_aval}</td>
                    <td class="garantias_aval d-none"> ${response.data[i].garantias_aval}</td>

                    <td > 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id})" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <button class="btn btn-danger btn_pdf_usuario" onclick="pdfCliente(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\')" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                    </td>
    
                    </tr>
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

        },
        complete : function(){
            $.unblockUI();
        }
    });

}


btn_guardar_cliente.click(function(){


    if(inp_nombre_cliente.val() == '' || inp_direccion_cliente.val() == '' || inp_telefono_cliente.val() == '' 
        || inp_otras_referencias_cliente.val() == '' || inp_archivos_cliente.get(0).files.length == 0 
        || inp_garantias_cliente.val() == '' || inp_archivos_garantias_cliente.get(0).files.length == 0
        || inp_nombre_aval.val() == '' || inp_direccion_aval.val() == '' || inp_telefono_aval.val() == '' 
        || inp_otras_referencias_aval.val() == '' || inp_archivos_aval.get(0).files.length == 0
        || inp_garantias_aval.val() == '' || inp_archivos_garantias_aval.get(0).files.length == 0
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
    else if(inp_archivos_cliente.get(0).files.length < 5){
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
    }
    else
    {
        var colocadora_id = $('.select_colocadoras option:selected').val()
        registrarCliente(inp_nombre_cliente.val(), inp_direccion_cliente.val(), inp_telefono_cliente.val(), inp_otras_referencias_cliente.val(),
                        inp_nombre_aval.val(), inp_direccion_aval.val(), inp_telefono_aval.val(), inp_otras_referencias_aval.val(), colocadora_id,
                        inp_garantias_cliente.val(), inp_garantias_aval.val())
    }



    
    /*var data = new FormData();
    data.append('func', 'create');

    $.each(inp_domicilio_cliente[0].files, function(i, file) {
        data.append('domicilio_cliente', file);
    });
    $.each(inp_ine_cliente[0].files, function(i, file) {
        data.append('ine_cliente', file);
    });
*/

    /*var other_data = $('form').serializeArray();
    $.each(other_data,function(key,input){
        data.append(input.name,input.value);
    });*/
   /* $.ajax({
        url: URL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(response){
            alert(response);
        }
    });*/

})

function registrarCliente(nombre_cliente, direccion_cliente, telefono_cliente, or_cliente, nombre_aval, direccion_aval, telefono_aval, or_aval, colocadora_id, garantias_cliente, garantias_aval){

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


    $.each(inp_archivos_cliente[0].files, function(i, file) {
        data.append('archivo_cliente_'+i, file);
    });

    $.each(inp_archivos_aval[0].files, function(i, file) {
        data.append('archivo_aval_'+i, file);
    });

   /* $.each(inp_domicilio_cliente[0].files, function(i, file) {
        data.append('domicilio_cliente', file);
    });
    $.each(inp_ine_cliente[0].files, function(i, file) {
        data.append('ine_cliente', file);
    });
    $.each(inp_tarjeton_cliente[0].files, function(i, file) {
        data.append('tarjeton_cliente', file);
    });
    $.each(inp_contrato_cliente[0].files, function(i, file) {
        data.append('contrato_cliente', file);
    });
    $.each(inp_pagare_cliente[0].files, function(i, file) {
        data.append('pagare_cliente', file);
    });

    $.each(inp_domicilio_aval[0].files, function(i, file) {
        data.append('domicilio_aval', file);
    });
    $.each(inp_ine_aval[0].files, function(i, file) {
        data.append('ine_aval', file);
    });*/
    

   $.ajax({
        url: URL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(response){
            var jsonResponse = JSON.parse(response);
            
            if(jsonResponse.status == "success"){

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


btn_guardar_editar_cliente.click(function(){


    if(inp_editar_nombre_cliente.val() == '' || inp_editar_direccion_cliente.val() == '' || inp_editar_telefono_cliente.val() == '' 
        || inp_editar_otras_referencias_cliente.val() == '' || inp_editar_garantias_cliente.val() == ''
        || inp_editar_nombre_aval.val() == '' || inp_editar_direccion_aval.val() == '' || inp_editar_telefono_aval.val() == '' 
        || inp_editar_otras_referencias_aval.val() == '' || inp_editar_garantias_aval.val() == '' 
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
        editarCliente(inp_editar_nombre_cliente.val(), inp_editar_direccion_cliente.val(), inp_editar_telefono_cliente.val(), inp_editar_otras_referencias_cliente.val(),
                        inp_editar_nombre_aval.val(), inp_editar_direccion_aval.val(), inp_editar_telefono_aval.val(), inp_editar_otras_referencias_aval.val(), colocadora_id,
                        inp_editar_garantias_cliente.val(), inp_editar_garantias_aval.val(), idClienteEditar, idAvalEditar)

    }

})

function editarCliente(nombre_cliente, direccion_cliente, telefono_cliente, or_cliente, nombre_aval, direccion_aval, telefono_aval, or_aval, colocadora_id, garantias_cliente, garantias_aval, cliente_id, aval_id){

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


    $.ajax({
        url: URL,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(response){

            var jsonResponse = JSON.parse(response);
            
            if(jsonResponse.status == "success"){

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
    getClientesRuta(this.value)
})

$('#select_poblaciones_filtro').on('change', function(){
    $('#select_colocadoras_filtro').val(0).trigger('change.select2');
    $('#select_rutas_filtro').val(0).trigger('change.select2');
    getClientesPoblacion(this.value)
})

$('#select_colocadoras_filtro').on('change', function(){
    $('#select_poblaciones_filtro').val(0).trigger('change.select2');
    $('#select_rutas_filtro').val(0).trigger('change.select2');
    getClientesColocadora(this.value)
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
                    <option value="0" >Filtrar por ruta</option>
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
                    <option value="0" >Filtrar por población</option>
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
                    <option value="0" >Filtrar por colocadora</option>
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


function modalEditarCliente(e, cliente_id, aval_id, ruta_id, poblacion_id){

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();
    
    var direccion = $(e).closest("tr") 
    .find(".direccion") 
    .text();  

    var telefono = $(e).closest("tr") 
    .find(".telefono") 
    .text();  

    var ruta = $(e).closest("tr") 
    .find(".ruta") 
    .text();  

    var poblacion = $(e).closest("tr") 
    .find(".poblacion") 
    .text();  
   
    var colocadora = $(e).closest("tr") 
    .find(".colocadora") 
    .text();  

    var nombre_aval = $(e).closest("tr") 
    .find(".nombre_aval") 
    .text();  


    /** CAMPOS OCULTOS */

    var otras_referencias = $(e).closest("tr") 
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
    .text();  


    inp_editar_nombre_cliente.val($.trim(nombre_completo))
    inp_editar_direccion_cliente.val($.trim(direccion))
    inp_editar_telefono_cliente.val($.trim(telefono))
    inp_editar_otras_referencias_cliente.val($.trim(otras_referencias))
    inp_editar_garantias_cliente.val($.trim(garantias))
    inp_editar_direccion_aval.val($.trim(direccion_aval))
    inp_editar_telefono_aval.val($.trim(telefono_aval))
    inp_editar_otras_referencias_aval.val($.trim(or_aval))
    inp_editar_garantias_aval.val($.trim(garantias_aval))


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

                $('#table_body').empty()
                for(var i = 0; i < response.data.length; i++ ){
                    $('#table_body').append(`
                    <tr>
                    <td class="nombre_completo"> ${response.data[i].nombre_completo} </td>
                    <td class="direccion"> ${response.data[i].direccion} </td>
                    <td class="telefono"> ${response.data[i].telefono} </td>
                    <td class="ruta"> ${response.data[i].nombre_ruta}  </td>
                    <td class="poblacion"> ${response.data[i].nombre_poblacion}</td>
                    <td class="colocadora"> ${response.data[i].nombre_colocadora}</td>
                    
                    <td class="or d-none"> ${response.data[i].otras_referencias}</td>
                    <td class="garantias d-none"> ${response.data[i].garantias}</td>

                    <td class="nombre_aval d-flex justify-content-between w-100"> ${response.data[i].nombre_aval} &nbsp;&nbsp;<button class="btn btn-info btn_ver_aval" onclick="modalVerAval(this)" title='Ver aval del cliente' data-toggle="modal" data-target="#modal_ver_aval" ><i class="fa-solid fa-eye" title='Ver información del aval'></i> </button>  </td>
                    <td class="direccion_aval d-none"> ${response.data[i].direccion_aval}</td>
                    <td class="telefono_aval d-none"> ${response.data[i].telefono_aval}</td>
                    <td class="or_aval d-none"> ${response.data[i].or_aval}</td>
                    <td class="garantias_aval d-none"> ${response.data[i].garantias_aval}</td>

                    <td > 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id})" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <button class="btn btn-danger btn_pdf_usuario" onclick="pdfCliente(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\')" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                    </td>
    
                    </tr>
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

                $('#table_body').empty()
                for(var i = 0; i < response.data.length; i++ ){
                    $('#table_body').append(`
                    <tr>
                    <td class="nombre_completo"> ${response.data[i].nombre_completo} </td>
                    <td class="direccion"> ${response.data[i].direccion} </td>
                    <td class="telefono"> ${response.data[i].telefono} </td>
                    <td class="ruta"> ${response.data[i].nombre_ruta}  </td>
                    <td class="poblacion"> ${response.data[i].nombre_poblacion}</td>
                    <td class="colocadora"> ${response.data[i].nombre_colocadora}</td>
                    
                    <td class="or d-none"> ${response.data[i].otras_referencias}</td>
                    <td class="garantias d-none"> ${response.data[i].garantias}</td>

                    <td class="nombre_aval d-flex justify-content-between w-100"> ${response.data[i].nombre_aval} &nbsp;&nbsp;<button class="btn btn-info btn_ver_aval" onclick="modalVerAval(this)" title='Ver aval del cliente' data-toggle="modal" data-target="#modal_ver_aval" ><i class="fa-solid fa-eye" title='Ver información del aval'></i> </button>  </td>
                    <td class="direccion_aval d-none"> ${response.data[i].direccion_aval}</td>
                    <td class="telefono_aval d-none"> ${response.data[i].telefono_aval}</td>
                    <td class="or_aval d-none"> ${response.data[i].or_aval}</td>
                    <td class="garantias_aval d-none"> ${response.data[i].garantias_aval}</td>

                    <td > 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id})" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <button class="btn btn-danger btn_pdf_usuario" onclick="pdfCliente(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\')" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                    </td>
    
                    </tr>
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

                $('#table_body').empty()
                for(var i = 0; i < response.data.length; i++ ){
                    $('#table_body').append(`
                    <tr>
                    <td class="nombre_completo"> ${response.data[i].nombre_completo} </td>
                    <td class="direccion"> ${response.data[i].direccion} </td>
                    <td class="telefono"> ${response.data[i].telefono} </td>
                    <td class="ruta"> ${response.data[i].nombre_ruta}  </td>
                    <td class="poblacion"> ${response.data[i].nombre_poblacion}</td>
                    <td class="colocadora"> ${response.data[i].nombre_colocadora}</td>
                    
                    <td class="or d-none"> ${response.data[i].otras_referencias}</td>
                    <td class="garantias d-none"> ${response.data[i].garantias}</td>

                    <td class="nombre_aval d-flex justify-content-between w-100"> ${response.data[i].nombre_aval} &nbsp;&nbsp;<button class="btn btn-info btn_ver_aval" onclick="modalVerAval(this)" title='Ver aval del cliente' data-toggle="modal" data-target="#modal_ver_aval" ><i class="fa-solid fa-eye" title='Ver información del aval'></i> </button>  </td>
                    <td class="direccion_aval d-none"> ${response.data[i].direccion_aval}</td>
                    <td class="telefono_aval d-none"> ${response.data[i].telefono_aval}</td>
                    <td class="or_aval d-none"> ${response.data[i].or_aval}</td>
                    <td class="garantias_aval d-none"> ${response.data[i].garantias_aval}</td>

                    <td > 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, ${response.data[i].id},  ${response.data[i].aval_id}, ${response.data[i].ruta_id}, ${response.data[i].poblacion_id})" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
                        <button class="btn btn-danger btn_pdf_usuario" onclick="pdfCliente(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\')" title="Generar pdf"><i class="fa-solid fa-file-pdf"></i></button>
                    </td>
    
                    </tr>
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