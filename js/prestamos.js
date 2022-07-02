
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


$(document).ready(function(){

    formClienteSoloArchivos.hide()
    
    getRutas()
    getClientes()
    
    $('#select_colocadoras_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});
    $('#select_clientes_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_prestamo')});



    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const cliente = urlParams.get('c')
    if(cliente){
        $('#modal_registrar_prestamo').modal('toggle');
        inputs_registrar_cliente_1.hide()
        inputs_registrar_cliente_2.hide()
        group_or_client.hide()
        prestamosTab.hide()
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