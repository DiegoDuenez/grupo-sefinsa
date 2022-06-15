


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


function logout(){

    if(loggedIn()){
        localStorage.removeItem('usuario')
        window.location = "index.php";
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

}

authGuard()