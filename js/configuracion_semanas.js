

var inp_semana_cantidad = $('#inp_semana_cantidad')
var inp_semana_interes = $('#inp_semana_interes')
var select_semana_tipo_abono = $('#select_semana_tipo_abono')
var inp_semana_semana_ren = $('#inp_semana_semana_ren')

var inp_semana_cantidad_editar = $('#inp_semana_cantidad_editar')
var inp_semana_interes_editar = $('#inp_semana_interes_editar')
var select_semana_tipo_abono_editar = $('#select_semana_tipo_abono_editar')
var inp_semana_semana_ren_editar = $('#inp_semana_semana_ren_editar')

var btn_guardar_semana = $('#btn_guardar_semana')
var btn_guardar_editar_semana = $('#btn_guardar_editar_semana')


var table_semanas
var semanaEditarId = ""


$(document).ready(function(){

    table_semanas= $('#tabla_semanas').DataTable({
      
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
        aaSorting: []

    })

    getConfiguracionSemanas();
    llenarSelectTipoAbonos();


})


function getConfiguracionSemanas(){


    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO SEMANAS...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

    var datasend = {
        func: "index",
        tipo: 'semanas'
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                table_semanas.clear()
                for(var i = 0; i < response.data.length; i++ ){

                    var status
                    if(response.data[i].status == 1){
                        status = '<span class="badge badge-success">Activo</span>'
                    }
                    else if(response.data[i].status == 0){
                        status = '<span class="badge badge-danger">Inactivo</span>'
                    }

                    table_semanas.row.add([
                        response.data[i].cantidad, 
                        response.data[i].interes + "%", 
                        response.data[i].abono_descripcion,
                        response.data[i].semana_renovacion,
                        status,
                        `                                                                                            
                        <button class="btn btn-warning btn_editar_semana" onclick="modalEditarSemana(this, ${response.data[i].id}, ${response.data[i].cantidad}, ${response.data[i].interes}, ${response.data[i].tipo_abono}, ${response.data[i].semana_renovacion})" title="Editar semana" data-toggle="modal" data-target="#modal_editar_semana"><i class="fa-solid fa-pen-to-square" ></i></button>
                         ${ response.data[i].status == 1 ? `<button class="btn btn-danger btn_desactivar_semana" onclick="desactivarSemana( ${response.data[i].id})" title="Desactivar semana"><i class="fa-solid fa-ban" ></i></button>`
                        : `<button class="btn btn-success btn_activar_semana" onclick="activarSemana(${response.data[i].id})" title="Activar semana"><i class="fa-regular fa-circle-check"></i></button>`  }
                        `,
                        response.data[i].created_at

                    ]);


                }
                table_semanas.draw();

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




function llenarSelectTipoAbonos(){

    var datasend = {
        func: "abonosActivos",
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('.select_semana_tipo_abono').empty()

                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_semana_tipo_abono').append(`
                        <option name="${response.data[i].descripcion}" value="${response.data[i].id}">${response.data[i].descripcion}</option>
                    `)

                    /*if(usuarioPerfil != ""){
                        $(`.select_perfiles.editar option[name='${usuarioPerfil}']`).attr('selected','selected');
                    }*/


                }

               
            }

        },
        error : function(e){

            console.log(e)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }

    });

}

function modalEditarSemana(e, id, cantidad, interes, tipo_abono, semana_renovacion){

    semanaEditarId = id

    inp_semana_cantidad_editar.val(cantidad);
    inp_semana_interes_editar.val(interes)

    $("#select_semana_tipo_abono_editar > option").each(function() {
        if(this.value == tipo_abono){
            $(this).attr('selected','selected');
        }
        else{
            $(this).attr('selected',false);
        }
    });

    inp_semana_semana_ren_editar.val(semana_renovacion)

}


btn_guardar_semana.click(function(){


    if(inp_semana_cantidad.val() == "" || inp_semana_interes.val() == "" || inp_semana_semana_ren.val() == ""
    || inp_semana_cantidad.val() == "0" || inp_semana_interes.val() == "0" || inp_semana_semana_ren.val() == "0"
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
    else if(inp_semana_semana_ren.val() > inp_semana_cantidad.val()){
        Swal.fire({
            icon: 'warning',
            title: 'Campo no valido',
            text: 'La semana de renovación no puede ser mayor a la cantidad de semanas',
            timer: 2000,
            showCancelButton: false,
            showConfirmButton: false
        })
    }
    else{

        tipo = $('#select_semana_tipo_abono option:selected').val()

        registrarSemana(inp_semana_cantidad.val(), inp_semana_interes.val(), tipo, inp_semana_semana_ren.val())

    }

})

function registrarSemana(cantidad, interes, tipo_abono, semana_renovacion){

    var datasend = {
        func: "createSemana",
        cantidad,
        interes,
        tipo_abono,
        semana_renovacion
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('#modal_registrar_semana').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Nueva semana registrada',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })

                getConfiguracionSemanas();

            }

        },
        error : function(e){

            console.log(e)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });

}



btn_guardar_editar_semana.click(function(){

    if(inp_semana_cantidad_editar.val() == "" || inp_semana_interes_editar.val() == "" || inp_semana_semana_ren_editar.val() == ""
    || inp_semana_cantidad_editar.val() == "0" || inp_semana_interes_editar.val() == "0" || inp_semana_semana_ren_editar.val() == "0"
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

        tipo = $('#select_semana_tipo_abono_editar option:selected').val()
        editarSemana(semanaEditarId, inp_semana_cantidad_editar.val(), inp_semana_interes_editar.val(), tipo, inp_semana_semana_ren_editar.val())

    }

})

function editarSemana(id, cantidad, interes, tipo_abono, semana_renovacion){

    var datasend = {
        func: "editSemana",
        id,
        cantidad,
        interes,
        tipo_abono,
        semana_renovacion
    };

    $.ajax({

        type: 'POST',
        url: URL,
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('#modal_editar_semana').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Registro editado',
                    text: 'El registro de semanas se ha editado correctamente',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })

                getConfiguracionSemanas();

            }

        },
        error : function(e){

            console.log(e)
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    });

}



function desactivarSemana(id){

    Swal.fire({
        title: '¿Quieres desactivar el registro?',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: URL,
                data : JSON.stringify({
                    func: 'desactivarSemana',
                    id
                }),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro desactivado',
                            text: 'Se ha desactivado el registro',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        getConfiguracionSemanas();

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

function activarSemana(id){

    Swal.fire({
        title: '¿Quieres activar el registro?',
        showCancelButton: true,
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: URL,
                data : JSON.stringify({
                    func: 'activarSemana',
                    id
                }),
                dataType: 'json',
                success : function(response) {
        
                    if(response.status == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro activado',
                            text: 'Se ha activado el registro',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        getConfiguracionSemanas();
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