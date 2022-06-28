
URL = 'php/Rutas/App.php'

var inp_editar_nombre_ruta = $("#inp_editar_nombre_ruta")
var inp_nombre_ruta = $("#inp_nombre_ruta")
var btn_guardar_ruta = $("#btn_guardar_ruta")
var btn_guardar_editar_ruta = $("#btn_guardar_editar_ruta")
var btn_agregar_empleado = $('#btn_agregar_empleado')


var idRutaEditar = 0
var rutaEmpleado = ""
var cantidadEmpleadosCrear = 0

$(document).ready(function(){

    getRutas();
    getEmpleados();

    $('#select_empleados_registrar_0').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_ruta')});
    $('#select_empleados_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_ruta')});

});

var x = 1;
btn_agregar_empleado.click (function(e) {
        e.preventDefault();
        
        $('#modal_body_registrar_ruta').append(`
            <div class="form-group mt-2">
                <select class="form-control select_empleados" id="select_empleados_registrar_${x}" >
                    <option selected value="0" >Seleccionar empleado</option>
                </select>
                <button class="btn btn-light btn-block btn-sm remover">Remover</button>
            </div>
        `);

        $(`#select_empleados_registrar_${x}`).select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_ruta')});

        getEmpleados()
        x++;
});

$('#modal_body_registrar_ruta').on("click",".remover",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
});


function getEmpleados(){

    var datasend = {
        func: "empleadosActivos"
    };

    $.ajax({

        type: 'POST',
        url: 'php/Empleados/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == 'success'){

                $('.select_empleados').empty()
                $('.select_empleados').append(`
                    <option value="0" >Seleccionar empleado</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $('.select_empleados').append(`
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo}</option>
                    `)

                    if(rutaEmpleado != ""){
                        $(`.select_empleados_editar option[name='${rutaEmpleado}']`).attr('selected','selected');
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

        },
        complete : function(){
            $.unblockUI();
        }
    });

}


function getRutas(){

    clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO RUTAS...</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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
                    <td class="nombre_ruta"> ${response.data[i].nombre_ruta} </td>
                     ${response.data[i].empleado_status == 0 ? `<td class="nombre_completo text-danger" title='Este usuario fue deshabilidato'> ${response.data[i].nombre_completo}</td>` : `<td class="nombre_completo"> ${response.data[i].nombre_completo}</td>`}
                    <td> 
                        <button class="btn btn-warning btn_editar_ruta" onclick="modalEditarRuta(this, ${response.data[i].id}, \'${response.data[i].nombre_completo}\')" title="Editar ruta" data-toggle="modal" data-target="#modal_editar_ruta"><i class="fa-solid fa-pen-to-square" ></i></button>
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

function modalEditarRuta(e, id, nombre_empleado){

    var nombre_ruta = $(e).closest("tr") 
    .find(".nombre_ruta") 
    .text();    
    inp_editar_nombre_ruta.val($.trim(nombre_ruta))
    idRutaEditar = id
    rutaEmpleado = nombre_empleado
    getEmpleados()
}


btn_guardar_ruta.click(function(){


    var arrayEmpleados = []
    var camposValidos = false
    
    for(var i = 0; i < $(".select_empleados").toArray().length; i++)
    {
        //alert("iteracion " + i)
        //alert(`#select_empleados_registrar_${i} ` + $(`#select_empleados_registrar_${i} option:selected`).val() )

        if(inp_nombre_ruta.val() == "" || $(`#select_empleados_registrar_${i} option:selected`).val() == 0){

            Swal.fire({
                icon: 'warning',
                title: 'Campos vacios',
                text: 'Necesitas llenar todos los campos',
                timer: 1000,
                showCancelButton: false,
                showConfirmButton: false
            })
            camposValidos =  false

        }
        else{

            empleado_id = $(`#select_empleados_registrar_${i} option:selected`).val()

            camposValidos = true
           
            /*arrayEmpleados.push(empleado_id)
            registrarRuta(inp_nombre_ruta.val(), empleado_id)*/
           
        }
    }

    if(camposValidos){
        $('.select_empleados option:selected').each(function(){
            var id = $(this).val();
            arrayEmpleados.push(id)
        })

        registrarRuta(inp_nombre_ruta.val(), arrayEmpleados)

    }



   /* if(inp_nombre_ruta.val() == "" || $(`.select_empleados option:selected`).val() == 0){

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
        empleado_id = $(`.select_empleados option:selected`).val()
        registrarRuta(inp_nombre_ruta.val(), empleado_id)
       
    }*/

})


function registrarRuta(nombre_ruta, empleado_id){

    console.log(empleado_id.length)

    /*var datasend ={
        func: 'create',
        nombre_ruta,
        empleado_id
    }

    $.ajax({
        type: 'POST',
        url: URL,
        data : JSON.stringify(datasend),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_registrar_ruta').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Nueva ruta registrada',
                    text: 'Se ha registrado la ruta',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })
                getRutas()
            }
            
        },
        error : function(e){

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e.responseJSON.message,
            })

        }
    })*/

}


btn_guardar_editar_ruta.click(function(){

    if(inp_editar_nombre_ruta.val() == "" || $(`.select_empleados_editar option:selected`).val() == 0){

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
        empleado_id = $(`.select_empleados_editar option:selected`).val()
        editarRuta(inp_editar_nombre_ruta.val(), empleado_id, idRutaEditar)
    }

})


function editarRuta(nombre_ruta, empleado_id, id){

    ruta = {
        func: 'edit',
        nombre_ruta,
        empleado_id,
        id
    }

    $.ajax({

        type: 'POST',
        url: URL,
        data: JSON.stringify(ruta),
        dataType: 'json',
        success : function(response) {

            if(response.status == "success"){
                $('#modal_editar_ruta').modal('toggle');
                Swal.fire({
                    icon: 'success',
                    title: 'Ruta actualizada',
                    text: 'Se ha editado la ruta',
                    timer: 1000,
                    showCancelButton: false,
                    showConfirmButton: false
                })
                getRutas();
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
        title: '¿Quieres desactivar la ruta?',
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
                            title: 'Ruta desactivada',
                            text: 'Se ha desactivado la ruta ',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        getRutas()
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
        title: '¿Quieres activar la ruta?',
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
                            title: 'Ruta activada',
                            text: 'Se ha activado la ruta',
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                        getRutas()
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