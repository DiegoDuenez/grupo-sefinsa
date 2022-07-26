URL = "php/Perfiles/App.php";

var inp_nombre_perfil = $("#inp_nombre_perfil");
var inp_editar_nombre_perfil = $("#inp_editar_nombre_perfil");

var btn_guardar_perfil = $("#btn_guardar_perfil");
var btn_guardar_editar_perfil = $("#btn_guardar_editar_perfil");

var btn_agregar_modulo = $('#btn_agregar_modulo')
var btn_editar_agregar_modulo = $('#btn_editar_agregar_modulo')

var modulos_container = $('.modulos_container')

var table;
var idPerfilEditar = 0;
var perfilTipo = "";

$(document).ready(function () {
  table = $("#tabla_perfiles").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 20, "Todos"],
    ],
    language: {
      lengthMenu: "Mostrar _MENU_ registros por página",
      zeroRecords: "No se encontro ningún registro",
      info: "Mostrando página _PAGE_ de _PAGES_",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      sSearch: "Buscar",
      paginate: {
        previous: "Anterior",
        next: "Siguiente",
      },
    },
    columnDefs: [{ visible: false, targets: -1 }],
    order: [[3, "desc"]],
  });

  $(`#select_modulos_registrar_0`).select2({
    theme: "bootstrap4",
    width: "100%",
    dropdownParent: $("#modal_registrar_perfil"),
  });

  getPerfiles();
  getModulos();
});

function getPerfiles() {
  clearInputs();

  $.blockUI({
    message: "<h4> TRAYENDO PERFILES...</h4>",
    css: { backgroundColor: null, color: "#fff", border: null },
  });

  var datasend = {
    func: "index",
  };

  $.ajax({
    type: "POST",
    url: URL,
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        table.clear();
        for (var i = 0; i < response.data.length; i++) {
          table.row.add([
            response.data[i].nombre_perfil,
            response.data[i].modulos,
            response.data[i].tipo_perfil,
            `
                        <button class="btn btn-warning btn_editar_usuario" onclick="modalEditarPerfil(this, ${response.data[i].id},  \'${response.data[i].nombre_perfil}\', \'${response.data[i].tipo_perfil}\', \'${response.data[i].modulos_id}\', \'${response.data[i].modulos}\')" title="Editar perfil" data-toggle="modal" data-target="#modal_editar_perfil"><i class="fa-solid fa-pen-to-square" ></i></button>
                        `,
            response.data[i].created_at,
          ]);
        }
        table.draw();
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
    complete: function () {
      $.unblockUI();
    },
  });
}



function getModulos(){

  var datasend = {
    func: "modulosActivos",
  };

  $.ajax({
    type: "POST",
    url: "php/Modulos/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {

        modulos_container.empty()
        for(var i = 0; i < response.data.length; i++){
          modulos_container.append(`
            <div class="modulo" id="${response.data[i].id}">
              ${response.data[i].nombre_modulo}
            </div>
        `)
        }
        $('.modulo').click(function(){
          if($(this).hasClass('modulo--select')){
            $(this).removeClass('modulo--select')
          }
          else{
            $(this).addClass('modulo--select')
          }
        })
        
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });

}

function modalEditarPerfil(e, id, nombre_perfil, tipo_perfil, modulos_id, modulos) {

  inp_editar_nombre_perfil.val($.trim(nombre_perfil));
  idPerfilEditar = id;
  perfilTipo = tipo_perfil;

  $("#select_editar_tipo_perfil > option").each(function () {
    if (this.value == tipo_perfil) {
      $(this).attr("selected", "selected");
    } else {
      $(this).attr("selected", false);
    }
  });

  $('.modulo').removeClass('modulo--select')

  for (var i = 0; i < modulos_id.split(",").length; i++) {
      $('.modulo').each(function(){
        if(this.id == $.trim(modulos_id.split(",")[i])){
          $(this).addClass('modulo--select')
        }
        
      })
  }

  

}



btn_guardar_perfil.click(function () {
  let arrayModulos = [];
  let modulosSeleccionados = $('#box_modulos .modulo--select').length

  if (inp_nombre_perfil.val() == "" || modulosSeleccionados == 0) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } 
  else {
    $('#box_modulos .modulo--select').each(function(){
      arrayModulos.push(this.id);
    })
    tipo_perfil = $(`#select_editar_tipo_perfil option:selected`).val();
    registrarPerfil(inp_nombre_perfil.val(), tipo_perfil, arrayModulos);

  }

});

function registrarPerfil(nombre_perfil, tipo_perfil, modulos) {
  var datasend = {
    func: "create",
    nombre_perfil,
    tipo_perfil,
    modulos
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_registrar_perfil").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Nuevo perfil",
          text: "Se ha creado el perfil",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        });
        getPerfiles();
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}


btn_guardar_editar_perfil.click(function () {
  let arrayModulos = [];
  let modulosSeleccionados = $('#box_modulos_editar .modulo--select').length

  if (inp_editar_nombre_perfil.val() == "" || modulosSeleccionados == 0) {
    Swal.fire({
      icon: "warning",
      title: "Campos vacios",
      text: "Necesitas llenar todos los campos",
      timer: 1000,
      showCancelButton: false,
      showConfirmButton: false,
    });
  } 
  else {
    $('#box_modulos_editar .modulo--select').each(function(){
      arrayModulos.push(this.id);
    })
    tipo_perfil = $(`#select_editar_tipo_perfil option:selected`).val();
    editarPerfil(idPerfilEditar, inp_editar_nombre_perfil.val(), tipo_perfil, arrayModulos);
  }
  

});

function editarPerfil(id, nombre_perfil, tipo_perfil, modulos) {
  var datasend = {
    func: "edit",
    id,
    nombre_perfil,
    tipo_perfil,
    modulos
  };

  $.ajax({
    type: "POST",
    url: URL,
    data: JSON.stringify(datasend),
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#modal_editar_perfil").modal("toggle");
        Swal.fire({
          icon: "success",
          title: "Perfil actualizado",
          text: "Se ha actualizado el perfil",
          timer: 1000,
          showCancelButton: false,
          showConfirmButton: false,
        }).then((response) => {

          var usuario = JSON.parse(localStorage.getItem("usuario"));
          if(id == usuario.perfil_id){
            localStorage.removeItem("modulos");
            getModulosPerfil(usuario.perfil_id)
          }
          getPerfiles();

        });
       

      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });
}




function getModulosPerfil(id){

  var datasend = {
    func: "modulosPerfil",
    id
  };

  $.ajax({
    type: "POST",
    url: "php/Perfiles/App.php",
    dataType: "json",
    data: JSON.stringify(datasend),
    success: function (response) {
      if (response.status == "success") {
        localStorage.setItem("modulos", response.data.modulos.split());
        document.location.reload()
      }
    },
    error: function (e) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: e.responseJSON.message,
      });
    },
  });

}


