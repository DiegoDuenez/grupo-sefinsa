URL = 'php/Colocadoras/App.php'

inp_nombre_completo = $('#inp_nombre_completo')
inp_direccion = $('#inp_direccion')
inp_telefono = $('#inp_telefono')

inp_editar_nombre_completo = $('#inp_editar_nombre_completo')
inp_editar_direccion = $('#inp_editar_direccion')
inp_editar_telefono = $('#inp_editar_telefono')

btn_guardar_colocadora = $("#btn_guardar_colocadora")
btn_editar_colocadora = $(".btn_editar_colocadora")
btn_guardar_editar_colocadora = $("#btn_guardar_editar_colocadora")
btn_modal_registrar_colocadora = $(".btn_modal_registrar_colocadora")

idColocadoraEditar = 0
colocadoraRuta = ""
colocadoraPoblacion = ""

$(document).ready(function(){

    getColocadoras();
    getRutas()

    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_colocadora ')});
    $('#select_rutas_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_colocadora')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_colocadora')});
    $('#select_poblaciones_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_colocadora')});

    /*getRutas();
    getPoblaciones();*/


});

btn_modal_registrar_colocadora.click(function(){
    /*$(`#select_rutass_registrar option[value="0"]`).attr('selected','selected');
    $(`#select_poblaciones_registrar option[value="0"]`).attr('selected','selected');*/
   /* $('#select_rutas_registrar option[value="0"]').prop('selected', true);
    $('#select_poblaciones_registrar option[value="0"]').prop('selected', true);*/

    /*$('#select_rutas_registrar').val(1).select2();
    $('#select_poblaciones_registrar').val(1).select2();*/


})


function getColocadoras(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO COLOCADORAS...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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
                    <td class="nombre_ruta"> ${response.data[i].nombre_ruta} </td>
                    <td class="nombre_poblacion"> ${response.data[i].nombre_poblacion} </td>

                    <td class="status"> ${ response.data[i].status == 1 ? 'Activo': 'Inactivo'  } </td>
                    <td> 
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarColocadora(this, ${response.data[i].id},  ${response.data[i].ruta_id} , \'${response.data[i].nombre_ruta}\',  \'${response.data[i].nombre_poblacion}\')" title="Editar colocadora" data-toggle="modal" data-target="#modal_editar_colocadora"><i class="fa-solid fa-pen-to-square" ></i></button>
                        
                        ${ response.data[i].status == 1 ? `<button class="btn btn-danger btn_eliminar_usuario" onclick="desactivar( ${response.data[i].id})" title="Desactivar colocadora"><i class="fa-solid fa-ban" ></i></button>`
                        : `<button class="btn btn-success btn_activar_usuario" onclick="activar(${response.data[i].id})" title="Activar colocadora"><i class="fa-regular fa-circle-check"></i></button>`  }
                            
    
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

                    if(colocadoraRuta != ""){
                        $(`.select_rutas.editar option[name='${colocadoraRuta}']`).attr('selected','selected');
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


function getPoblaciones(ruta_id){


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

                    for(var i = 0; i < response.data.length; i++ ){
                    
                        $('.select_poblaciones').append(`
                            <option name="${response.data[i].nombre_poblacion}" value="${response.data[i].id}">${response.data[i].nombre_poblacion}</option>
                        `)
    
                        if(colocadoraPoblacion != ""){
                            $(`.select_poblaciones.editar option[name='${colocadoraPoblacion}']`).attr('selected','selected');
                        }
    
    
                    }
                }
                else{
                    $('.select_poblaciones').prop( "disabled", true );
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'Esta ruta no tienen poblaciones asignadas aún',
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


btn_guardar_colocadora.click(function(){

    if(inp_nombre_completo.val() == "" || inp_direccion.val() == "" || inp_telefono.val() == "" || $(`.select_rutas option:selected`).val() == 0 || $(`.select_poblaciones option:selected`).val() == 0){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })

    }
    else{
        ruta_id = $(`.select_rutas option:selected`).val()
        poblacion_id = $(`.select_poblaciones option:selected`).val()
        registrarColocadora(inp_nombre_completo.val(), inp_direccion.val(), inp_telefono.val(), ruta_id, poblacion_id)

    }

})

function registrarColocadora(nombre_completo, direccion, telefono, ruta_id, poblacion_id){

    var datasend ={
        func: 'create',
        nombre_completo,
        direccion,
        telefono,
        ruta_id,
        poblacion_id
    }

    $.ajax({
        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_registrar_colocadora').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Nueva colocadora',
                    text: 'Se ha registrado a la colocadora',
                })
                getColocadoras()
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



btn_guardar_editar_colocadora.click(function(){

    if(inp_editar_nombre_completo.val() == "" || inp_editar_direccion.val() == "" || inp_editar_telefono.val() == "" || $(`.select_rutas.editar option:selected`).val() == 0 || $(`.select_poblaciones.editar option:selected`).val() == 0){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })


    }
    else{
        ruta_id = $(`.select_rutas.editar option:selected`).val()
        poblacion_id = $(`.select_poblaciones.editar option:selected`).val()
        editarColocadora(inp_editar_nombre_completo.val(), inp_editar_direccion.val(), inp_editar_telefono.val(), ruta_id, poblacion_id, idColocadoraEditar)
    }

})


function editarColocadora(nombre_completo, direccion, telefono, ruta_id, poblacion_id, id){

    var datasend ={
        func: 'edit',
        nombre_completo,
        direccion,
        telefono,
        ruta_id,
        poblacion_id,
        id
    }

    $.ajax({

        type: 'POST',
        url: URL,
        data: JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_editar_colocadora').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Colocadora actualizada',
                    text: 'Se ha editado a la colocadora',
                })
                getColocadoras();
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

$('.select_rutas').on('change', function() {
    $('.select_poblaciones').prop( "disabled", false );
    getPoblaciones(this.value);
});

function modalEditarColocadora(e, id, ruta_id, ruta, poblacion){

    var nombre_completo = $(e).closest("tr") 
    .find(".nombre_completo") 
    .text();    
    var direccion = $(e).closest("tr") 
    .find(".direccion") 
    .text();  
    var telefono = $(e).closest("tr") 
    .find(".telefono") 
    .text();  
    inp_editar_nombre_completo.val($.trim(nombre_completo))
    inp_editar_direccion.val($.trim(direccion))
    inp_editar_telefono.val($.trim(telefono))
    idColocadoraEditar = id
    colocadoraRuta = ruta
    colocadoraPoblacion = poblacion
    getRutas()
    getPoblaciones(ruta_id)


}


function desactivar(id){

    Swal.fire({
        title: '¿Quieres desactivar a la colocadora?',
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
                            title: 'Colocadora desactivada',
                            text: 'Se ha desactivado a la colocadora',
                        })
                        getColocadoras()
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
        title: '¿Quieres activar a la colocadora?',
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
                            title: 'Colocadora activada',
                            text: 'Se ha activado a la colocadora',
                        })
                        getColocadoras();
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

