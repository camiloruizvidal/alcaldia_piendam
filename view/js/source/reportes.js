$(function () {
    dependencias();
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
function Detalle(id)
{
    $.ajax({
        url: 'Ajax/AjaxVerCambiosEstados',
        type: 'POST',
        data: {id_peticion: id},
        success: function (data)
        {
            $('#info_reporte').html(data);
            $('#myModalDetail').modal('show');
        }
    });

}
function dependencias()
{
    $('#id_dependencia').load('Ajax/AjaxCargarDependencias_reportes');
}
function VerVeredas()
{
    $('#id_vereda').load('Ajax/AjaxSelectVeredas');
    $('#update_id_vereda').load('Ajax/AjaxSelectVeredas');
}
function data_select()
{
    $.ajax({
        url: 'Ajax/AjaxTiposSolicitudesReportes',
        async: false,
        type: 'POST',
        data: {id_dependencia: $('#id_dependencia').val()},
        success: function (data) {
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
    $('#id_filt_ciudadano,#Fechaini,#Fechafin,#Estado,#filt_id_tipo,#id_dependencia').change(function ()
    {
        if ($(this).attr('id') === 'id_dependencia')
        {
            data_select();
        }
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
    $('.fechaini').val(dia.getFullYear() + '-' + (dia.getMonth() + 1) + '-' + date.getDate());
    $('.fechafin').val(dia.getFullYear() + '-' + (dia.getMonth() + 1) + '-' + date.getDate());
    solicitud_search();
}
function CargarSolicitudes()
{
    $.ajax({
        url: 'Ajax/AjaxReportes',
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
