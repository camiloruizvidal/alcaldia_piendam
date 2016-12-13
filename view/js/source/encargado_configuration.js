$(function ()
{
    TiposPeticiones();
    nuevotipopeticion();
    VerEncabezado();
});
function setEncabezado()
{
    loadingstart();
    $.ajax({url: 'Ajax/AjaxSetValueConfig.php',
        type: 'POST',
        data: {name: 'formato_encabezado', value: $('#encabezado_format').val()},
        success: function (data) {
            $('textarea#encabezado_format').val(data.value);
            VerEncabezado();
        },
        complete: function (jqXHR, textStatus) {
            loadingstop();
        }});
}
function VerEncabezado()
{
    $.ajax({url: 'Ajax/AjaxNameConfig.php',
        type: 'POST',
        data: {name: 'formato_encabezado'},
        dataType: 'json',
        success: function (data) {
            $('textarea#encabezado_format').val(data.value);
        }});
}
function TiposPeticiones()
{
    $.ajax({url: 'Ajax/AjaxViewTipoPeticion.php',
        type: 'POST',
        success: function (data) {
            $('#data_peticiones_tipo').html(data);
        }});
}
function nuevotipopeticion()
{
    $('#new_peticion').click(function ()
    {
        $.ajax({url: 'Ajax/AjaxNewTipoPeticion.php',
            data: {nombre_tipo_peticion: $('#nombre_tipo_peticion').val()},
            type: 'POST',
            success: function (data) {
                TiposPeticiones();
            },
            complete: function (jqXHR, textStatus) {
                loadingstop();
            }});
    });
}
function editar(id)
{
    loadingstart();
    $.ajax({url: 'Ajax/AjaxSaveTipoPeticion.php',
        data: {
            nombre_tipo_peticion: $('#edit_tipo_' + id).val(),
            id: id
        },
        type: 'POST',
        success: function () {
            TiposPeticiones();
        },
        complete: function () {
            loadingstop();
        }});
}