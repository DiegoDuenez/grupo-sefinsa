
URL = 'php/Empleados/App.php'

inp_nombre_completo = $('#inp_nombre_completo')
inp_empleado = $('#inp_empleado')
inp_password = $('#inp_password')

inp_editar_nombre_completo = $('#inp_editar_nombre_completo')
inp_editar_empleado = $('#inp_editar_empleado')
inp_editar_password = $('#inp_editar_password')

btn_guardar_empleado = $("#btn_guardar_empleado")
btn_editar_empleado = $(".btn_editar_empleado")
btn_guardar_editar_empleado = $("#btn_guardar_editar_empleado")

btn_modal_registrar_empleado = $('.btn_modal_registrar_empleado')

cambiarContraseña = false
idEmpleadoEditar = 0
empleadoPerfil = ""

$(document).ready(function(){

    getEmpleados();
    getPerfiles();

});

btn_modal_registrar_empleado.click(function(){
    $(`.select_perfiles option[value="0"]`).attr('selected','selected');
})


function getEmpleados(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO EMPLEADOS...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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
                    <td class="usuario"> ${response.data[i].usuario} </td>
                    <td class="perfil"> ${response.data[i].nombre_perfil} </td>
                    <td class="status"> ${ response.data[i].status == 1 ? 'Activo': 'Inactivo'  } </td>
                    <td> 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarUsuario(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\')" title="Editar usuario" data-toggle="modal" data-target="#modal_editar_empleado"><i class="fa-solid fa-pen-to-square" ></i></button>
                        
                        ${ response.data[i].status == 1 ? `<button class="btn btn-danger btn_eliminar_usuario" onclick="desactivar( ${response.data[i].id})" title="Desactivar usuario"><i class="fa-solid fa-ban" ></i></button>`
                        : `<button class="btn btn-success btn_activar_usuario" onclick="activar(${response.data[i].id})" title="Activar usuario"><i class="fa-regular fa-circle-check"></i></button>`  }
                            
    
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


function getPerfiles(){

    var datasend = {
        func: "perfiles"
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('.select_perfiles').empty()
                $('.select_perfiles').append(`
                    <option value="0" >Seleccionar perfil</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_perfiles').append(`
                        <option name="${response.data[i].nombre_perfil}" value="${response.data[i].id}">${$response.data[i].nombre_perfil}</option>
                    `)

                    if(empleadoPerfil != ""){
                        $(`.select_perfiles option[name=${empleadoPerfil}]`).attr('selected','selected');
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


$('#cb_password').change(function() {

    if(this.checked) {
        inp_editar_password.removeClass('d-none')
        inp_editar_password.prop('required',false);
        cambiarContraseña = true
    }
    else{
        inp_editar_password.addClass('d-none')
        inp_editar_password.prop('required',true);
        cambiarContraseña = false
    }


});

function modalEditarUsuario(e, id, perfil){

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();    
    var usuario = $(e).closest("tr") 
    .find(".usuario") 
    .text();    
    inp_editar_nombre_completo.val($.trim(nombre_completo))
    inp_editar_empleado.val($.trim(usuario))
    idEmpleadooEditar = id
    empleadoPerfil = perfil
    getPerfiles()

}