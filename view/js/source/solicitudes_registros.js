$(function () {
    actualizar_cambios();
    data_select();
    VerEstadosAgenda();
    VerVeredas();
    solicitud_search();
    solicitud_enviar();
    $("#tabs").tabs();
    CardarDocumento();
    VerCiudadanos();
    cambios();
    $(".btnPrint").printPage();
    $('#solicitudes').submit(false);
    Solicitantes();
    $('#actualizar').click(function ()
    {
        Actualizar();
    });
});
function view_edit(id_user)
{
    $('.views').html('');
    $.ajax({
        url: 'Ajax/AjaxVerSolicitud',
        data: {id_solicitud: id_user},
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function (index, value)
            {
                $('#view_' + index).html(value);
            });
            $('#myModalView').modal('show');
        },
        complete: function (jqXHR, textStatus) {
            loadingstop();
        }
    });
}
function actualizar_cambios()
{
    $('#cambio_solicitud').submit(function (e)
    {
        e.preventDefault();
        loadingstart();
        $.ajax({
            url: 'Ajax/AjaxCambiarEstadoPeticion',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data) {
                $('#myModalUpdate').modal('hide');
                CargarSolicitudes();
            },
            complete: function (jqXHR, textStatus) {
                loadingstop();
            }
        })
    });
}
function CambioEstado()
{
    $('#myModalEdit').modal('hide');
    $('#myModalUpdate').modal('show');
}
function VerVeredas()
{
    $('#id_vereda').load('Ajax/AjaxSelectVeredas');
    $('#update_id_vereda').load('Ajax/AjaxSelectVeredas');
}
function data_select()
{
    $.ajax({
        url: 'Ajax/AjaxTiposSolicitudes',
        async: false,
        success: function (data) {
            $('#update_id_tipo').html(data);
            $('#filt_id_tipo').html(data);
            $('#id_tipo').html(data.replace('<option value="-1">SELECCIONE</option>', ''));
        }
    });
}
function Solicitantes()
{
    $('#filt_ciudadano').autocomplete({
        source: 'Ajax/AjaxSolicitantesAutocomplete',
        select: function (e, data)
        {
            $('#id_filt_ciudadano').val(data.item.id_usuario);
            CargarSolicitudes();
        }
    });
}
function Actualizar()
{
    loadingstart();
    $.ajax({
        url: 'Ajax/AjaxActualizarSolicitud',
        data: $('#solicitudes').serialize(),
        type: 'POST',
        success: function (data, textStatus, jqXHR) {
            $('#myModalEdit').modal('hide');
        },
        complete: function () {
            loadingstop();
        }
    });
}
function remove(id)
{
    $('#myModalDelete').modal('show');
}
function edit(id)
{
    $.ajax({
        url: 'Ajax/AjaxVerSolicitud',
        data: {id_solicitud: id},
        type: 'POST',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $('#cambio_estado_id_peticion').val(data.id_peticion);
            $('#detalleSolicitud').html(data.detalle);
            $('#cambio_estado_id_estados').val(data.id_peticion_estado);
            $('#nombreciudadano').html(data.nombre + ' ' + data.apellido);
            $.each(data, function (index, value)
            {
                var name = '#update_' + index;
                if (index == 'url')
                {
                    $(name).html(value);
                }
                $(name).val(value);
            });
            loadingstart();
        },
        complete: function (jqXHR, textStatus) {
            loadingstop();
            $('#myModalEdit').modal('show');
        }
    });
}
function cambios()
{
    $('#id_filt_ciudadano,#Fechaini,#Fechafin,#Estado,#filt_id_tipo').change(function ()
    {
        CargarSolicitudes();
    });
}
function VerCiudadanos()
{

}
function VerEstadosAgenda()
{
    $.ajax({
        url: "Ajax/AjaxCargarEstadosSolicitudes",
        success: function (data)
        {
            $('#Estado').html(data);
            $('#cambio_estado_id_estados').html(data);
            CargarSolicitudes();
        }
    });
}
function CardarDocumento()
{
    $('#documento').change(function () {
        loadingstart();
        $.ajax({
            url: "Ajax/AjaxVerCiudadano",
            data: {documento: $('#documento').val()},
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $.each(data, function (index, value)
                {
                    $('#' + index).val(value);
                });
            },
            complete: function (jqXHR, textStatus) {
                loadingstop();
            }
        });
    });
}
function solicitud_search()
{
    $('#form_search').submit(function (e)
    {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function ()
            {
                CargarSolicitudes();
            },
            complete: function () {
                loadingstop();
            }
        });
    });
}
function Limpiar(id_input)
{
    $('#' + id_input).val('');
    CargarSolicitudes();
}
function solicitud_enviar()
{
    $('#form_search').submit(function (e)
    {
        CargarSolicitudes();
        e.preventDefault();
        loadingstart();
    });
    $('#NuevaSolicitud').submit(function (e)
    {
        e.preventDefault();
        loadingstart();
        var data = new FormData($("#NuevaSolicitud")[0]);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function ()
            {
                CargarSolicitudes();
            }
        });
    });
}
function FiltrarHoy()
{
    var date = new Date();
    var dia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hoy = dia.getFullYear() + '-' + (dia.getMonth() + 1) + '-' + date.getDate();
    $('.fechaini').val(hoy);
    $('.fechafin').val(hoy);
    solicitud_search();
}
function CargarSolicitudes()
{
    $.ajax({
        url: 'Ajax/AjaxSolicitudes',
        data: $('#form_search').serialize(),
        type: 'POST',
        success: function (data)
        {
            $('#imp_inf').attr('href', $('#form_search').attr('action') + '?' + $('#form_search').serialize());
            $('#solicitudes_table').html(data);
            $('#myTable').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        },
        complete: function () {
            $('[name="myTable_length"]').addClass('form form-control');
            $('input[type="search"]').addClass('form form-control');
            loadingstop();
        }
    });
}
