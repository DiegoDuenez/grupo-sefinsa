URL = 'php/Pagos/App.php'


var table;

$(document).ready(function(){

    table = $('#tabla_pagos').DataTable( {
      
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
        /*"columnDefs": [
            { "visible": false, "targets": -1 }
          ],*/
          order: [[6, 'asc']],

          
    })

    getPagos()

    /*$('#select_colocadoras_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});
    $('#select_rutas_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});
    $('#select_poblaciones_registrar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_registrar_cliente')});

    $('#select_colocadoras_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});
    $('#select_rutas_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});
    $('#select_poblaciones_editar').select2({theme: 'bootstrap4', width: '100%', dropdownParent: $('#modal_editar_cliente')});

    
    $('#select_rutas_filtro').select2({theme: 'bootstrap4', width: '100%'});
    $('#select_poblaciones_filtro').select2({theme: 'bootstrap4', width: '100%'});
    $('#select_colocadoras_filtro').select2({theme: 'bootstrap4', width: '100%'});*/



});



function getPagos(){

    //clearInputs()

    $.blockUI({ message: '<h4> TRAYENDO PAGOS..</h4>', css: { backgroundColor: null, color: '#fff', border: null } });

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
                        response.data[i].nombre_completo, 
                        "$ " + response.data[i].monto_prestado,
                        "$ " + response.data[i].cantidad_esperada_pago,
                        "$ " + response.data[i].cantidad_normal_pagada,
                        "$ " + response.data[i].cantidad_multa,
                        "$ " + response.data[i].cantidad_total_pagada,
                        response.data[i].fecha_pago,
                        response.data[i].status == 0 ? 'Pendiente' : 'Pagado',
                        `
                        <button class="btn btn-success btn_pagar" onclick="modalPago()" title="Pagar" data-toggle="modal" data-target="#modal_pagar"><i class="fa-solid fa-pen-to-square" ></i></button>
                      
                        `,

                    ]);


                }
                table.draw();

            }

        },
        error : function(e){

            console.log(e)
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
