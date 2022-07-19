

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    
    if(target == "#abonosconfig"){
        getConfiguracionAbonos();

    }
    else if (target == "#semanasconfig"){
        getConfiguracionSemanas();
        llenarSelectTipoAbonos();
    }
    else if (target == "#multaconfig"){

    }

});