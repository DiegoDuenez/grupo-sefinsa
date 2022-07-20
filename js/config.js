
window.top.config_cantidad_semanas
window.top.config_semana_renovar

$(document).ready(function(){
    getMultaPorDefecto();
    getSemanasActivasConfiguracion();
})


function getMultaPorDefecto(){

    var datasend = {
        func: "getMultaPorDefecto"
    };

    $.ajax({

        type: 'POST',
        url: 'php/Configuraciones/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){

            if(response.status == "success"){
                
                if(response.data.status == 1){
                    $("#inp_monto_multa").val(response.data.cantidad)
                }
                else{
                    $("#inp_monto_multa").val('')
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



function getSemanasActivasConfiguracion(){

    var datasend = {
        func: "semanasActivas"
    };

    $.ajax({

        type: 'POST',
        url: 'php/Configuraciones/App.php',
        dataType: 'json',
        data: JSON.stringify(datasend),
        success : function(response){


            $('#select_modalidad').empty()
            for(var i = 0; i < response.data.length; i++ ){
                
                $('#select_modalidad').append(`
                    <option name="${response.data[i].cantidad}" data-interes="${response.data[i].interes}" 
                    data-cantidad-abono="${response.data[i].cantidad_abono}" 
                    data-tipo-abono="${response.data[i].tipo_cantidad}" 
                    data-de="${response.data[i].de}"
                    data-por-cada="${response.data[i].por_cada}"
                    value="${response.data[i].id}">${response.data[i].cantidad} semanas (${response.data[i].abono_descripcion})</option>
                `)

            }

            /*if(response.status == "success"){
                
                if(response.data.status == 1){
                    $("#inp_monto_multa").val(response.data.cantidad)
                }
                else{
                    $("#inp_monto_multa").val('')
                }

            }*/

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