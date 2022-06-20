
var dateToday = new Date();
var dateLastWeek = new Date();

dateLastWeek.setDate(dateLastWeek.getDate());  

var day = addZero(dateToday.getDate());
var month = addZero(dateToday.getMonth() + 1);
var year = addZero(dateToday.getFullYear());

var hour = addZero(dateToday.getHours());
var minutes = addZero(dateToday.getMinutes());
var seconds = addZero(dateToday.getSeconds());

var dayLastWeek = addZero(dateLastWeek.getDate());
var monthLastWeek = addZero(dateLastWeek.getMonth() + 1);
var yearLastWeek = addZero(dateLastWeek.getFullYear());

var hourLastWeek = addZero(dateLastWeek.getHours());
var minutesLastWeek = addZero(dateLastWeek.getMinutes());
var secondsLastWeek = addZero(dateLastWeek.getSeconds());

var globalFechaInicial = `${yearLastWeek}-${monthLastWeek}-${dayLastWeek} 00:00:00`;
var globalFechaFinal = `${year}-${month}-${day} 23:59:59`;


$(document).ready(function(){

    if(localStorage.getItem('usuario') !== null){

        var usuario =  JSON.parse(localStorage.getItem('usuario'))
        $('#usuario').text(usuario.usuario)
        
    }
    
    $("#search_filter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table_body tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});

function addZero(number){
    var valorReturn = number;
    if (number < 9) {
        valorReturn = `0${number}`;
    }
    return valorReturn;
}


function logout(){

    
    if(loggedIn()){
        Swal.fire({
            title: '¿Esta seguro de salir de la plataforma?',
            showCancelButton: true,
            allowOutsideClick: false
        }).then((result) => {
            
            if (result.isConfirmed) {
                localStorage.removeItem('usuario')
                window.location = "index.php";
            } 
            else if (result.isDenied) {
            }
        })
        
    }
}

function loggedIn(){
    return !! localStorage.getItem('usuario')
}

function authGuard(){
    if(loggedIn()){
        return true
    }
    else{
        window.location = "index.php";
        return false
    }
}

function clearInputs(){

    $(`.select_perfiles option[value="0"]`).attr('selected','selected');
    $('#inp_nombre_completo').val("")
    $('#inp_usuario').val("")
    $('#inp_password').val("")

    $('#inp_editar_nombre_completo').val("")
    $('#inp_editar_usuario').val("")
    $('#inp_editar_password').val("")

    $('#cb_password').prop("checked", false)
    $('#inp_editar_password').addClass('d-none')
    $("#inp_nombre_ruta").val("")
    $("#inp_nombre_localidad").val("")

    // COLOCADORA INPUTS
    $('#inp_nombre_completo').val("")
    $('#inp_direccion').val("")
    $('#inp_telefono').val("")
    $('#inp_editar_nombre_completo').val("")
    $('#inp_editar_direccion').val("")
    $('#inp_editar_telefono').val("")
    

}

authGuard()