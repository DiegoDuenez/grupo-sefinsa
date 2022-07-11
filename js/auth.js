var env = {

    production : {
        url : 'https://awsoftware.mx/grupo_sefinsa/'
    },

    local : {
        url : 'http://localhost/proyecto_cobranza/'
    }

}


var dateToday = new Date();
var dateLastWeek = new Date();

dateLastWeek.setDate(dateLastWeek.getDate());  

var day = addZero(dateToday.getDate());
var month = addZero(dateToday.getMonth() + 1);
var year = addZero(dateToday.getFullYear());

var hour = addZero(dateToday.getHours());
var minutes = addZero(dateToday.getMinutes());
var seconds = addZero(dateToday.getSeconds());

var dayLastWeek = addZero(dateLastWeek.getDate());
var monthLastWeek = addZero(dateLastWeek.getMonth() + 1);
var yearLastWeek = addZero(dateLastWeek.getFullYear());

var hourLastWeek = addZero(dateLastWeek.getHours());
var minutesLastWeek = addZero(dateLastWeek.getMinutes());
var secondsLastWeek = addZero(dateLastWeek.getSeconds());

var globalFechaInicial = `${yearLastWeek}-${monthLastWeek}-${dayLastWeek} 00:00:00`;
var globalFechaFinal = `${year}-${month}-${day} 23:59:59`;


$(document).ready(function(){

    if(localStorage.getItem('usuario') !== null){

        var usuario =  JSON.parse(localStorage.getItem('usuario'))
        $('#usuario').text(usuario.usuario)
        
    }
    
    $("#search_filter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_body tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});

function addZero(number){
    var valorReturn = number;
    if (number < 9) {
        valorReturn = `0${number}`;
    }
    return valorReturn;
}


function logout(){

    
    if(loggedIn()){
        /*Swal.fire({
            title: '¿Esta seguro de salir de la plataforma?',
            showCancelButton: true,
            allowOutsideClick: false
        }).then((result) => {
            
            if (result.isConfirmed) {
                localStorage.removeItem('usuario')
                window.location = "index.php";
            } 
            else if (result.isDenied) {
            }
        })*/

        localStorage.removeItem('usuario')
        window.location = "index.php";

       
        
    }
}

function loggedIn(){
    return !! localStorage.getItem('usuario')
}

function authGuard(){
    if(loggedIn()){
        return true
    }
    else{
        window.location = "index.php";
        return false
    }
}

function RemoveParameterFromUrl(url, parameter) {
    return url
      .replace(new RegExp('[?&]' + parameter + '=[^&#]*(#.*)?$'), '$1')
      .replace(new RegExp('([?&])' + parameter + '=[^&]*&'), '$1');
  }

function clearInputs(){

    
    /*$('input[type=text]').val('')
    $('input[type=number]').val('')

    $('textarea').val('')
    $('select').val(0).trigger('change.select2');*/


    $('#inp_nombre_completo').val("")
    $('#inp_usuario').val("")
    $('#inp_password').val("")

    $('#inp_editar_nombre_completo').val("")
    $('#inp_editar_usuario').val("")
    $('#inp_editar_password').val("")
    $('#cb_password').prop("checked", false)
    $('#lb_password').addClass('d-none')
    $('#inp_editar_password').addClass('d-none')
    $("#inp_nombre_ruta").val("")
    $("#inp_nombre_localidad").val("")


    //RUTAS INPUTS
    $('#select_empleados_registrar').val(0).trigger('change.select2');

    // POBLACIONES INPUTS
    $('#select_primer_dia option[value=Lunes]').prop('selected',true);
    $('#select_segundo_dia option[value=Sabado]').prop('selected',true);
    $("#inp_primer_hora").val('00:00:00')
    $('#inp_monto_multa').val('50.00')

    // EMPLEADOS INPUTS
    $(`.select_perfiles option[value="0"]`).prop('selected',true);

    // COLOCADORA INPUTS
    $('#inp_nombre_completo').val("")
    $('#inp_direccion').val("")
    $('#inp_telefono').val("")
    $('#inp_editar_nombre_completo').val("")
    $('#inp_editar_direccion').val("")
    $('#inp_editar_telefono').val("")


    // CLIENTES INPUT
    $('#inp_nombre_cliente').val('')
    $('#inp_direccion_cliente').val('')
    $('#inp_telefono_cliente').val('')
    $('#inp_otras_referencias_cliente').val('')
    $('#inp_nombre_aval').val('')
    $('#inp_direccion_aval').val('')
    $('#inp_telefono_aval').val('')
    $('#inp_otras_referencias_aval').val('')
    $('#inp_garantias_cliente').val('')
    $('#inp_garantias_aval').val('')
    $('#inp_editar_nombre_cliente').val('')
    $('#inp_editar_direccion_cliente').val('')
    $('#inp_editar_telefono_cliente').val('')
    $('#inp_editar_otras_referencias_cliente').val('')
    $('#inp_editar_nombre_aval').val('')
    $('#inp_editar_direccion_aval').val('')
    $('#inp_editar_telefono_aval').val('')
    $('#inp_editar_otras_referencias_aval').val('')
    $('#inp_editar_garantias_cliente').val('')
    $('#inp_editar_garantias_aval').val('')
    $('#inp_archivos_cliente').val('')
    $('#inp_archivos_aval').val('')
    $('#inp_archivos_garantias_cliente').val('')
    $('#inp_archivos_garantias_aval').val('')
    $('#select_colocadoras_registrar').val(0).trigger('change.select2');
    $('#select_rutas_registrar').val(0).trigger('change.select2');
    $('#select_poblaciones_registrar').val(0).trigger('change.select2');
    $('#select_colocadoras_editar').val(0).trigger('change.select2');
    $('#select_rutas_editar').val(0).trigger('change.select2');
    $('#select_poblaciones_editar').val(0).trigger('change.select2');
    $('#select_poblaciones_registrar').prop( "disabled", true );
    $('#select_colocadoras_registrar').prop( "disabled", true );


    // CLIENTE INPUTS
    $('#inp_nombre_cliente').val('')
    $('#inp_direccion_cliente').val('')
    $('#inp_telefono_cliente').val('')
    $('#select_rutas_registrar').val('')
    $('#select_poblaciones_registrar').val('')
    $('#select_colocadoras_registrar').val('')
    $('#inp_otras_referencias_cliente').val('')
    $('#inp_garantias_cliente').val('')
    $('#inp_archivos_garantias_cliente').val('')
    $('#inp_archivos_cliente').val('')
    $('#select_clientes_registrar').val(0).trigger('change.select2');

    $('#inp_garantias_cliente_existente').val('')
    $('#inp_archivos_garantias_cliente_existente').val('')
    $('#inp_archivos_cliente_existente').val('')
    $('#inp_archivos_cliente_existente').val('')
    $('#inp_direccion_cliente_existente').val('')
    $('#inp_telefono_cliente_existente').val('')

    $('#select_rutas_registrar_existente').prop( "disabled", true );
    $('#select_poblaciones_registrar_existente').prop( "disabled", true );
    $('#select_clientes_registrar_existente').prop( "disabled", true );
    
    $('#select_rutas_registrar_existente').val(0).trigger('change.select2');
    $('#select_poblaciones_registrar_existente').val(0).trigger('change.select2');
    $('#select_clientes_registrar_existente').val(0).trigger('change.select2');

    // AVAL INPUTS
    $('#inp_nombre_aval').val('')
    $('#inp_direccion_aval').val('')
    $('#inp_telefono_aval').val('')
    $('#inp_otras_referencias_aval').val('')
    $('#inp_garantias_aval').val('')
    $('#inp_archivos_garantias_aval').val('')
    $('#inp_archivos_aval').val('')

    // PRESTAMO INPUTS
    $('#inp_monto_prestar').val('')
    $('#inp_pago_semana').val('')

    $('#inp_cantidad_pagada').val('')
    $('#inp_concepto').val('')


    

}

authGuard()