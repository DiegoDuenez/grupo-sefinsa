
$(document).ready(function(){
    getMultaPorDefecto();
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