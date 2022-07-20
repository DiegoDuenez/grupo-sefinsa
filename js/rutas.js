
URL = 'php/Rutas/App.php'

var inp_editar_nombre_ruta = $("#inp_editar_nombre_ruta")
var inp_nombre_ruta = $("#inp_nombre_ruta")
var btn_guardar_ruta = $("#btn_guardar_ruta")
var btn_guardar_editar_ruta = $("#btn_guardar_editar_ruta")
var btn_agregar_empleado = $('#btn_agregar_empleado')
var btn_editar_agregar_empleado = $('#btn_editar_agregar_empleado')

var idRutaEditar = 0
var rutaEmpleado = ""
var cantidadEmpleadosCrear = 0

var table;

$(document).ready(function(){

    getRutas();
    getEmpleados();

    table = $('#tabla_rutas').DataTable( {
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
        "columnDefs": [
            { "visible": false, "targets": -1 }
          ],
          order: [[3, 'desc']],
    })

    $('#select_empleados_registrar_0').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_ruta')});
    $('#select_empleados_editar_0').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_ruta')});

});

var x = 1;
btn_agregar_empleado.click (function(e) {
        e.preventDefault();
        
        $('#modal_body_registrar_ruta').append(`
            <div class="form-group mt-2">
                <div class="d-flex flex-row">
                    <select class="form-control select_empleados" style="width: 80%" id="select_empleados_registrar_${x}" >
                    <option selected value="0" >Seleccionar empleado</option>
                    </select>
                    <button class="btn btn-light btn-block btn-sm remover" style="width: 20%" >Remover</button>
                </div>
            </div>
        `);

        $(`#select_empleados_registrar_${x}`).select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_ruta')});

        llenarSelect(`select_empleados_registrar_${x}`)
        x++;
});

$('#modal_body_registrar_ruta').on("click",".remover",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
});


var y;
btn_editar_agregar_empleado.click (function(e) {

    y = $(".select_empleados_editar").toArray().length;

    e.preventDefault();
    
    $('#modal_body_editar_ruta').append(`
        <div class="form-group mt-2">
            <div class="d-flex flex-row">
                <select class="form-control select_empleados_editar" style="width: 80%" id="select_empleados_editar_${y}" >
                <option selected value="0" >Seleccionar empleado</option>
                </select>
                <button class="btn btn-light btn-block btn-sm remover" style="width: 20%" >Remover</button>
            </div>
        </div>
    `);

    $(`#select_empleados_editar_${y}`).select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_ruta')});

    llenarSelect(`select_empleados_editar_${y}`)
    y++;
});

$('#modal_body_editar_ruta').on("click",".remover",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    y--;
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
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo} (${response.data[i].nombre_perfil})</option>
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

        }
    });

}


function llenarSelect(select_id){

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

                $(`#${select_id}`).empty()
                $(`#${select_id}`).append(`
                    <option value="0" >Seleccionar empleado</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $(`#${select_id}`).append(`
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo} (${response.data[i].nombre_perfil})</option>
                    `)

                    /*if(rutaEmpleado != ""){
                        $(`.select_empleados_editar option[name='${rutaEmpleado}']`).attr('selected','selected');
                    }*/


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

function llenarSelectEditar(select_id, optionSelect){


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

                $(`#${select_id}`).empty()
                $(`#${select_id}`).append(`
                    <option value="0" >Seleccionar empleado</option>
                `)
                for(var i = 0; i < response.data.length; i++ ){
                    
                    $(`#${select_id}`).append(`
                        <option name="${response.data[i].nombre_completo}" value="${response.data[i].id}">${response.data[i].nombre_completo} (${response.data[i].nombre_perfil})</option>
                    `)


                    if($.trim(optionSelect) == response.data[i].nombre_completo){
                        $(`#${select_id} option[name='${$.trim(optionSelect)}']`).attr('selected','selected');
                    }

                    /*for(var x = 0; x < data.length; x++){
                        
                        
                        if(response.data[x].nombre_completo == $.trim(data[x])){

                            console.log("son iguales")
                            console.log(response.data[i].nombre_completo)
                            console.log($.trim(data[x]))
                            $(`#${select_id} option[name='${$.trim(data[x])}']`).attr('selected','selected');
                        }
                        break;

                    }*/

                   /* if(rutaEmpleado != ""){
                        $(`.select_empleados_editar option[name='${rutaEmpleado}']`).attr('selected','selected');
                    }*/
                   // $(`#select_empleados_editar_${i} option[name='${$.trim(empleados_id.split(',')[i])}']`).attr('selected','selected');

                }

                /*for(var x = 0; x < data.length; x++){
                    console.log(data[x])
                    $(`#${select_id} option[name='${$.trim(data[x])}']`).attr('selected','selected');
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

                table.clear()
                for(var i = 0; i < response.data.length; i++ ){
                    table.row.add([
                        response.data[i].nombre_ruta, 
                        response.data[i].empleados,
                        `
                        <button class="btn btn-warning btn_editar_ruta" onclick="modalEditarRuta(this, ${response.data[i].id}, \'${response.data[i].empleados}\', \'${response.data[i].empleados_id}\', \'${response.data[i].nombre_ruta}'\)" title="Editar ruta" data-toggle="modal" data-target="#modal_editar_ruta"><i class="fa-solid fa-pen-to-square" ></i></button>
                        `,
                        response.data[i].created_at

                    ]);
                }
                table.draw();


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

function modalEditarRuta(e, id, empleados, empleados_id, nombre_ruta){

    /*var nombre_ruta = $(e).closest("tr") 
    .find(".nombre_ruta") 
    .text();    */


    inp_editar_nombre_ruta.val($.trim(nombre_ruta))

    idRutaEditar = id

    $('#modal_body_editar_ruta').children().not('#contenedor_inp_editar_nombre_ruta').empty()
    $('#modal_body_editar_ruta').append(`
        <div class="form-group mt-2">
            <label for="select_empleados_editar">Empleado <span class="text-danger" title="Campo obligatorio">*</span></label>
            <select class="form-control select_empleados_editar" id="select_empleados_editar_0" >
                <option selected value="0" >Seleccionar empleado</option>
            </select>
        </div>
    `);


    for(var i = 0; i < empleados_id.split(',').length; i++)
    {

        if(i > 0){

            $('#modal_body_editar_ruta').append(`
                <div class="form-group mt-2" >
                    <div class="d-flex flex-row "id="contenedor_select_${i}" >
                        <select class="form-control select_empleados_editar" style="width: 80%" id="select_empleados_editar_${i}" >
                        <option selected value="0" >Seleccionar empleado ${i}</option>
                        </select>
                        <button class="btn btn-light btn-block btn-sm remover" style="width: 20%" >Remover</button>
                    </div>
                </div>
            `);

        }

        $(`#select_empleados_editar_${i}`).select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_ruta')});

        llenarSelectEditar(`select_empleados_editar_${i}`, empleados.split(',')[i])

    }

    if( $(".select_empleados_editar").toArray().length > empleados_id.split(',').length){
        $(`#contenedor_select_${i}`).parent('div').remove();
    }

}


btn_guardar_ruta.click(function(){


    var arrayEmpleados = []
    var camposValidos = false
    
    for(var i = 0; i < $(".select_empleados").toArray().length; i++)
    {

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
           
        }
    }

    if(camposValidos){
        $('.select_empleados option:selected').each(function(){
            var id = $(this).val();
            arrayEmpleados.push(id)
        })

        registrarRuta(inp_nombre_ruta.val(), arrayEmpleados)

    }


})


function registrarRuta(nombre_ruta, empleados){

    var datasend ={
        func: 'create',
        nombre_ruta,
        empleados
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
    })

}


btn_guardar_editar_ruta.click(function(){


    var arrayEmpleados = []
    var camposValidos = false
    
    for(var i = 0; i < $(".select_empleados_editar").toArray().length; i++)
    {

        if(inp_editar_nombre_ruta.val() == "" || $(`#select_empleados_editar_${i} option:selected`).val() == 0){

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

            empleado_id = $(`#select_empleados_editar_${i} option:selected`).val()

            camposValidos = true
           
        }
    }

    if(camposValidos){
        $('.select_empleados_editar option:selected').each(function(){
            var id = $(this).val();
            arrayEmpleados.push(id)
        })

        console.log(arrayEmpleados)
        editarRuta(inp_editar_nombre_ruta.val(), arrayEmpleados, idRutaEditar)

    }




    /*if(inp_editar_nombre_ruta.val() == "" || $(`.select_empleados_editar option:selected`).val() == 0){

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
    }*/

})


function editarRuta(nombre_ruta, empleados, id){

    ruta = {
        func: 'edit',
        nombre_ruta,
        empleados,
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