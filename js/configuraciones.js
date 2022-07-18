
var inp_abono_cantidad = $('#inp_abono_cantidad')
var select_abono_tipo_cantidad = $('#select_abono_tipo_cantidad')
var inp_abono_cantidad_con_tipo = $('#inp_abono_cantidad_con_tipo')
var select_tipo = $('#select_tipo')
var inp_tipo = $('#inp_tipo')

inp_abono_cantidad.on('input', function(){

    //console.log($('#select_abono_tipo_cantidad option:selected').val())
    /*$(this).val() == "" ? inp_abono_cantidad_con_tipo.val('') : inp_abono_cantidad_con_tipo.val($(this).val() + select_abono_tipo_cantidad.val())

*/
    
    if($('#select_abono_tipo_cantidad option:selected').val() == '$' && $(this).val() != ""){
        inp_abono_cantidad_con_tipo.val(select_abono_tipo_cantidad.val() + $(this).val())
        inp_tipo.val('Por cada')

    }
    else if($('#select_abono_tipo_cantidad option:selected').val()== '%' && $(this).val() != ""){
        inp_abono_cantidad_con_tipo.val($(this).val() + select_abono_tipo_cantidad.val())
        inp_tipo.val('De')
    }
    else{
        inp_abono_cantidad_con_tipo.val('')
        inp_tipo.val('')
    }

    

})

select_abono_tipo_cantidad.on('change', function() {


    if($(this).val() == "$" && inp_abono_cantidad_con_tipo.val().includes('%')){
        inp_abono_cantidad_con_tipo.val(inp_abono_cantidad_con_tipo.val().slice(0, -1) + '')
        inp_abono_cantidad_con_tipo.val($(this).val() + inp_abono_cantidad.val())
       /* $(`#select_tipo option[name='de']`).attr('selected',false);
        $(`#select_tipo option[name='porcada']`).attr('selected','selected');*/
        inp_tipo.val('Por cada')

    }
    else if($(this).val() == "%" && inp_abono_cantidad_con_tipo.val().includes('$')){
        inp_abono_cantidad_con_tipo.val().substring(1)
        inp_abono_cantidad_con_tipo.val(inp_abono_cantidad.val() + $(this).val())
        inp_tipo.val('De')
       /* $(`#select_tipo option[name='porcada']`).attr('selected',false);
        $(`#select_tipo option[name='de']`).attr('selected','selected');*/


    }

})