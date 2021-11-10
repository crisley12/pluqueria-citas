$(document).ready(function () {
  let buttons = "<div class='text-center'><div class='btn-group'>"
  if (getPath() === 'listausers')
    buttons += "<button class='btn btn-primary btnEditar'>Editar</button>"
  buttons +=
    "<button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"

  tablaPersonas = $('#tablaPersonas').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent: buttons,
      },
    ],

    //Para cambiar el lenguaje a español
    language: {
      lengthMenu: 'Mostrar _MENU_ registros',
      zeroRecords: 'No se encontraron resultados',
      info: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
      infoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
      infoFiltered: '(filtrado de un total de _MAX_ registros)',
      sSearch: 'Buscar:',
      oPaginate: {
        sFirst: 'Primero',
        sLast: 'Último',
        sNext: 'Siguiente',
        sPrevious: 'Anterior',
      },
      sProcessing: 'Procesando...',
    },
  })

  $('#btnNuevo').click(function () {
    if (getPath() === 'listausers')
      document.querySelector('#rol').parentNode.style.cssText =
        'display: block;'

    $('#formPersonas').trigger('reset')
    $('.modal-header').css('background-color', '#28a745')
    $('.modal-header').css('color', 'white')
    $('.modal-title').text('Nueva Persona')
    $('#modalCRUD').modal('show')
    id = null
    opcion = 1 //alta
  })

  var fila //capturar la fila para editar o borrar el registro

  //botón EDITAR
  $(document).on('click', '.btnEditar', function () {
    switch (getPath()) {
      case 'listausers':
        {
          fila = $(this).closest('tr')
          id = parseInt(fila.find('td:eq(0)').text())
          email = fila.find('td:eq(1)').text()
          password = fila.find('td:eq(2)').text()
          nombre = fila.find('td:eq(4)').text()
          telefono = parseInt(fila.find('td:eq(5)').text())
          cpassword = fila.find('td:eq(2)').text()
          document.querySelector('#formPersonas').action = `updateuser/${id}`

          $('#userid').val(id)
          $('#email').val(email)
          $('#nombre').val(nombre)
          $('#number').val(telefono)
          document.querySelector('#rol').parentNode.style.cssText =
            'display: none;'
          $('#password').val(password)
          $('#cpassword').val(cpassword)
        }
        break
      default:
        break
    }

    opcion = 2 //editar

    $('.modal-header').css('background-color', '#007bff')
    $('.modal-header').css('color', 'white')
    $('.modal-title').text('Editar Persona')
    $('#modalCRUD').modal('show')
  })

  //botón BORRAR
  $(document).on('click', '.btnBorrar', function () {
    fila = $(this)
    id = parseInt($(this).closest('tr').find('td:eq(0)').text())
    opcion = 3 //borrar
    var respuesta = confirm('¿Está seguro de eliminar el registro: ' + id + '?')
    if (respuesta) {
      switch (getPath()) {
        case 'listausers':
          document.querySelector('#formPersonas').action = `delete/${id}`
          break
        case 'citasAdmin':
          document.querySelector('#formPersonas').action = `citasDelete/${id}`
        case 'citasP':
          document.querySelector('#formPersonas').action = `citasDelete/${id}`
          break
        default:
          break
      }
      document.querySelector('#formPersonas').submit()
    }
  })

  $('#formPersonas').submit(function (e) {
    e.preventDefault()
    nombre = $.trim($('#nombre').val())
    pais = $.trim($('#pais').val())
    edad = $.trim($('#edad').val())
    $.ajax({
      url: 'bd/crud.php',
      type: 'POST',
      dataType: 'json',
      data: { nombre: nombre, pais: pais, edad: edad, id: id, opcion: opcion },
      success: function (data) {
        console.log(data)
        id = data[0].id
        nombre = data[0].nombre
        pais = data[0].pais
        edad = data[0].edad
        if (opcion == 1) {
          tablaPersonas.row.add([id, nombre, pais, edad]).draw()
        } else {
          tablaPersonas.row(fila).data([id, nombre, pais, edad]).draw()
        }
      },
    })
    $('#modalCRUD').modal('hide')
  })
})

function getPath() {
  const paths = window.location.pathname.split('/')
  const actualPath = paths[paths.length - 1]

  return actualPath
}
