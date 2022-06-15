

inp_nombre_completo = $('#inp_nombre_completo')
inp_usuario = $('#inp_usuario')
inp_password = $('#inp_password')

inp_editar_nombre_completo = $('#inp_editar_nombre_completo')
inp_editar_usuario = $('#inp_editar_usuario')
inp_editar_password = $('#inp_editar_password')

btn_guardar_usuario = $("#btn_guardar_usuario")
btn_editar_usuario = $(".btn_editar_usuario")
btn_guardar_editar_usuario = $("#btn_guardar_editar_usuario")

cambiarContraseña = false
idUsuarioEditar = 0


$(document).ready(function(){

    getUsuarios();

});


function getUsuarios(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO USUARIOS...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

		var datasend = {
			func: "index"
		};

		$.ajax({

			type: 'POST',
			url: 'php/Usuarios/App.php',
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
                        <td class="status"> ${ response.data[i].status == 1 ? 'Activo': 'Inactivo'  } </td>
                        <td> 
                            <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarUsuario(this, ${response.data[i].id})" title="Editar usuario" data-toggle="modal" data-target="#modal_editar_usuario"><i class="fa-solid fa-pen-to-square" ></i></button>
                            
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

function modalEditarUsuario(e, id){

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();    
    var usuario = $(e).closest("tr") 
    .find(".usuario") 
    .text();    
    inp_editar_nombre_completo.val($.trim(nombre_completo))
    inp_editar_usuario.val($.trim(usuario))
    idUsuarioEditar = id

}


btn_guardar_editar_usuario.click(function(){

    if(inp_editar_nombre_completo.val() == "" || inp_editar_usuario.val() == "" && cambiarContraseña == false){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })


    }
    else if(cambiarContraseña == true && inp_editar_password.val() == "" || inp_editar_nombre_completo.val() == "" || inp_editar_usuario.val() == ""){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })

    }
    else{

       if(cambiarContraseña == true){
            editarUsuario(inp_editar_nombre_completo.val(), inp_editar_usuario.val(), idUsuarioEditar, inp_editar_password.val())
       }
       else{
            editarUsuario(inp_editar_nombre_completo.val(), inp_editar_usuario.val(), idUsuarioEditar)
       }

    }

})


btn_guardar_usuario.click(function(){

    if(inp_nombre_completo.val() == "" || inp_usuario.val() == "" || inp_password.val() == ""){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })

    }
    else{
        registrarUsuario(inp_nombre_completo.val(), inp_usuario.val(), inp_password.val())
    }

})

function registrarUsuario(nombre_completo, usuario, password){

    var datasend ={
        func: 'create',
        nombre_completo,
        usuario, 
        password
    }

    $.ajax({
        type: 'POST',
        url: 'php/Usuarios/App.php',
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_registrar_usuario').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Nuevo usuario',
                    text: 'Se ha registrado al usuario',
                })
                getUsuarios()
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


function editarUsuario(nombre_completo, usuario, id, password = null,){

    if(password == null){
        user = {
            func: 'edit',
            nombre_completo,
            usuario,
            id, 
            changePassword : false
        }
    }
    else{
        user = {
            func: 'edit',
            nombre_completo,
            usuario,
            id, 
            changePassword : true,
            password
        }
    }



    $.ajax({

        type: 'POST',
        url: 'php/Usuarios/App.php',
        data: JSON.stringify(user),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_editar_usuario').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario actualizado',
                    text: 'Se ha editado al usuario',
                })
                getUsuarios();
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



function desactivar(id){

    Swal.fire({
        title: '¿Quieres desactivar al usuario?',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: 'php/Usuarios/App.php',
                data : JSON.stringify({
                    func: 'desactivar',
                    id
                }),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario desactivado',
                            text: 'Se ha desactivado al usuario',
                        })
                        getUsuarios()
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



function activar(id){

    Swal.fire({
        title: '¿Quieres activar al usuario?',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {
            
            $.ajax({
                type: 'POST',
                url: 'php/Usuarios/App.php',
                data : JSON.stringify({
                    func: 'activar',
                    id
                }),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario activado',
                            text: 'Se ha activado al usuario',
                        })
                        getUsuarios()
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