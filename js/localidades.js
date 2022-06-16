URL = 'php/Localidades/App.php'

inp_editar_nombre_localidad = $("#inp_editar_nombre_localidad")
inp_nombre_localidad = $("#inp_nombre_localidad")
btn_guardar_localidad = $("#btn_guardar_localidad")
btn_guardar_editar_localidad = $("#btn_guardar_editar_localidad")

idLocalidadEditar = 0
rutaLocalidad = ""

$(document).ready(function(){

    getLocalidades();
    getRutas();

    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_localidad')});
    $('#select_rutas_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_localidad')});



});


function getLocalidades(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO LOCALIDADES...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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
                    <td class="nombre_localidad"> ${response.data[i].nombre_localidad} </td>
                    <td class="nombre_ruta"> ${response.data[i].nombre_ruta} </td>
                    <td> 
                        <button class="btn btn-warning btn_editar_ruta" onclick="modalEditarLocalidad(this, ${response.data[i].id}, \' ${response.data[i].nombre_ruta}'\)" title="Editar localidad" data-toggle="modal" data-target="#modal_editar_localidad"><i class="fa-solid fa-pen-to-square" ></i></button>
                       
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

                    if(rutaLocalidad != ""){
                        $(`.select_rutas.editar option[name=${rutaLocalidad}]`).attr('selected','selected');
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

function modalEditarLocalidad(e, id, ruta){

    var nombre_localidad = $(e).closest("tr") 
    .find(".nombre_localidad") 
    .text();    
   /* var usuario = $(e).closest("tr") 
    .find(".") 
    .text();   */ 
    inp_editar_nombre_localidad.val($.trim(nombre_localidad))
    //inp_editar_usuario.val($.trim(usuario))
    idLocalidadEditar = id
    rutaLocalidad = ruta
    getRutas()

}

btn_guardar_localidad.click(function(){

    if(inp_nombre_localidad.val() == "" || $(`.select_rutas option:selected`).val() == 0){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })


    }
    else{
        ruta_id = $(`.select_rutas option:selected`).val()
        registrarLocalidad(inp_nombre_localidad.val(), ruta_id)

    }

})

function registrarLocalidad(nombre_localidad, ruta_id){

    var datasend ={
        func: 'create',
        nombre_localidad,
        ruta_id
    }

    $.ajax({
        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_registrar_localidad').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Nueva localidad',
                    text: 'Se ha registrado la localidad',
                })
                getLocalidades()
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


btn_guardar_editar_localidad.click(function(){

    if(inp_editar_nombre_localidad.val() == "" || $(`.select_rutas.editar option:selected`).val() == 0){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })


    }
    else{
        ruta_id = $(`.select_rutas.editar option:selected`).val()
        editarLocalidad(inp_editar_nombre_localidad.val(), ruta_id, idLocalidadEditar)

    }

})


function editarLocalidad(nombre_localidad, ruta_id, id){

    localidad = {
        func: 'edit',
        nombre_localidad,
        ruta_id,
        id, 
    }

    $.ajax({

        type: 'POST',
        url: URL,
        data: JSON.stringify(localidad),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_editar_localidad').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Localidad actualizada',
                    text: 'Se ha editado la localidad',
                })
                getLocalidades();
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
        title: '¿Quieres desactivar la localidad?',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: URL,
                data : JSON.stringify({
                    func: 'desactivar',
                    id
                }),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Localidad desactivada',
                            text: 'Se ha desactivado la localidad',
                        })
                        getEmpleados()
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
        title: '¿Quieres activar la localidad?',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {
            
            $.ajax({
                type: 'POST',
                url: URL,
                data : JSON.stringify({
                    func: 'activar',
                    id
                }),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Localidad activada',
                            text: 'Se ha activado la localidad',
                        })
                        getEmpleados()
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