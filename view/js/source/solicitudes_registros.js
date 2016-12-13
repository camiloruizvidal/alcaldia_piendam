$(function () {
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
function VerVeredas()
{
    $('#id_vereda').load('Ajax/AjaxSelectVeredas.php');
    $('#update_id_vereda').load('Ajax/AjaxSelectVeredas.php');
    $.ajax({url: 'Ajax/AjaxNewTipoPeticion.php',
        success: function (data) {

        }});
}
function data_select()
{
    $.ajax({
        url: 'Ajax/AjaxTiposSolicitudes.php',
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
        source: 'Ajax/AjaxSolicitantesAutocomplete.php',
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
        url: 'Ajax/AjaxActualizarSolicitud.php',
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
        url: 'Ajax/AjaxVerSolicitud.php',
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
        url: "Ajax/AjaxCargarEstadosSolicitudes.php",
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
            url: "Ajax/AjaxVerCiudadano.php",
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
        loadingstart();
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
        url: 'Ajax/AjaxSolicitudes.php',
        data: $('#form_search').serialize(),
        type: 'POST',
        success: function (data)
        {
            $('#imp_inf').attr('href', $('#form_search').attr('action') + '?' + $('#form_search').serialize());
            $('#solicitudes_table').html(data);
        },
        complete: function () {
            loadingstop();
        }
    });
}
