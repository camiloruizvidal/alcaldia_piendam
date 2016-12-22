$(function ()
{
    fechas();
    Estados();
    Dependencias();
    Tipos();
    filtrar();
    $('#id_estado,#id_tipo,#fecha_ini,#fecha_fin,#id_dependencia_tipo').change(function ()
    {
        filtrar();
    });
    $('.boton_imp').printPage();
});
function filtrar()
{

    $.ajax({
        url: $('#form_filtr').attr('action'),
        data: $('#form_filtr').serialize(),
        type: 'POST',
        success: function (data) {
            $('#Data').html(data);
            $('#imp_data').attr('href', $('#form_filtr').attr('action') + '?' + $('#form_filtr').serialize());
        }
    });
}
function fechas()
{
    var date = new Date();
    var dia = new Date(date.getFullYear(), date.getMonth(), 1);
    var uia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var ini = dia.getFullYear() + '-' + (dia.getMonth() + 1) + '-' + 1;
    var fin = uia.getFullYear() + '-' + (uia.getMonth() + 1) + '-' + uia.getDate();
    $('#fecha_ini').datepicker({dateFormat: 'yy-mm-dd'});
    $('#fecha_fin').datepicker({dateFormat: 'yy-mm-dd'});
    $('#fecha_ini').val(ini);
    $('#fecha_fin').val(fin);
}
function Dependencias()
{
    $('#id_dependencia_tipo').load('Ajax/AjaxCargarDependencias_user');
}
function Estados()
{
    $('#id_estado').load('Ajax/AjaxCargarEstadosSolicitudes');
}
function Tipos()
{
    $('#id_dependencia_tipo').change(function ()
    {
        $.ajax({
            url: 'Ajax/AjaxTiposDependencia',
            data: {id_tipo: $(this).val()},
            type: 'POST',
            success: function (data) {
                $('#id_tipo').html(data);
            }
        });
    });
}