
URL = 'php/Rutas/App.php'

inp_editar_nombre_ruta = $("#inp_editar_nombre_ruta")
inp_nombre_ruta = $("#inp_nombre_ruta")
btn_guardar_ruta = $("#btn_guardar_ruta")
btn_guardar_editar_ruta = $("#btn_guardar_editar_ruta")


idRutaEditar = 0

$(document).ready(function(){

    getRutas();

});


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
                    <td> 
                        <button class="btn btn-warning btn_editar_ruta" onclick="modalEditarRuta(this, ${response.data[i].id})" title="Editar ruta" data-toggle="modal" data-target="#modal_editar_ruta"><i class="fa-solid fa-pen-to-square" ></i></button>
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

function modalEditarRuta(e, id){

    var nombre_ruta = $(e).closest("tr") 
    .find(".nombre_ruta") 
    .text();    
    inp_editar_nombre_ruta.val($.trim(nombre_ruta))
    idRutaEditar = id
}


btn_guardar_ruta.click(function(){

    if(inp_nombre_ruta.val() == ""){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })

    }
    else{
        registrarRuta(inp_nombre_ruta.val())
       
    }

})


function registrarRuta(nombre_ruta){

    var datasend ={
        func: 'create',
        nombre_ruta
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

    if(inp_editar_nombre_ruta.val() == ""){

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacios',
            text: 'Necesitas llenar todos los campos',
        })


    }
    else{
        editarRuta(inp_editar_nombre_ruta.val(), idRutaEditar)
    }

})


function editarRuta(nombre_ruta, id){

    ruta = {
        func: 'edit',
        nombre_ruta,
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