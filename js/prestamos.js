
$(document).ready(function(){
    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const cliente = urlParams.get('c')
    if(cliente){
        $('#modal_registrar_prestamo').modal('toggle');
    }
    
})
