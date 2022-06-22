
URL = 'php/Clientes/App.php'


var btn_guardar_cliente = $('#btn_guardar_cliente')

var inp_nombre_cliente = $('#inp_nombre_cliente')
var inp_direccion_cliente = $('#inp_direccion_cliente')
var inp_telefono_cliente = $('#inp_telefono_cliente')
var inp_otras_referencias_cliente = $('#inp_otras_referencias_cliente')

var inp_nombre_aval = $('#inp_nombre_aval')
var inp_direccion_aval = $('#inp_direccion_aval')
var inp_telefono_aval = $('#inp_telefono_aval')
var inp_otras_referencias_aval = $('#inp_otras_referencias_aval')


var inp_domicilio_cliente = $('#inp_domicilio_cliente')
var inp_ine_cliente = $('#inp_ine_cliente')
var inp_tarjeton_cliente = $('#inp_tarjeton_cliente')
var inp_contrato_cliente = $('#inp_contrato_cliente')
var inp_pagare_cliente = $('#inp_pagare_cliente')

var inp_domicilio_aval = $('#inp_domicilio_aval')
var inp_ine_aval = $('#inp_ine_aval')


$(document).ready(function(){

    getCliente()


});

function getCliente(){

    //clearInputs()

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
                    <td class="garantias"> ${response.data[i].garantias_cliente}  </td>
                    <td class="comprobantes"> ${response.data[i].comprobantes_cliente} </td>
                    <td class="otras_referencias"> ${response.data[i].otras_referencias} </td>
                    <td class="nombre_aval"> ${response.data[i].nombre_aval} &nbsp;&nbsp;<button class="btn btn-info btn_ver_aval" title='Ver aval del cliente'><i class="fa-solid fa-eye" title='Ver información del aval'></i> </button>  </td>

                    <td> 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarCliente(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\')" title="Editar cliente" data-toggle="modal" data-target="#modal_editar_cliente"><i class="fa-solid fa-pen-to-square" ></i></button>
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
        || inp_otras_referencias_cliente.val() == '' || inp_domicilio_cliente.get(0).files.length == 0 || inp_ine_cliente.get(0).files.length == 0
        || inp_tarjeton_cliente.get(0).files.length == 0 || inp_contrato_cliente.get(0).files.length == 0 || inp_pagare_cliente.get(0).files.length == 0

        || inp_nombre_aval.val() == '' || inp_direccion_aval.val() == '' || inp_telefono_aval.val() == '' 
        || inp_otras_referencias_aval.val() == '' || inp_domicilio_aval.get(0).files.length == 0 || inp_ine_aval.get(0).files.length == 0
        ){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })

    }
    else
    {
        Swal.fire({
            icon: 'success',
            title: 'Nada',
            text: 'OKAS',
        })
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

function registrarCliente(){
    
}