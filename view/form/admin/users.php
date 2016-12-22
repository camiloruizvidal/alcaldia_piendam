<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'reportes.php';
$form->parametros = array('titulo' => 'Ingreso de peticiones', 'active' => array('admin_users'), 'css' => array('css/source/custom-small-screens.css'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<script>
    function ConsultarUsuarios()
    {
        $('#Users').load('Ajax/AjaxVerUsuarios');
        $('#id_dependencia').load('Ajax/AjaxVerDependencias');
        $('#update_id_dependencia').load('Ajax/AjaxVerDependencias');
    }
    $(function ()
    {
        $('#dependencia').hide();
        ConsultarUsuarios();
        $.ajax({
            url: 'Ajax/AjaxSelectTiposUsuarios',
            success: function (data) {
                data = data.replace('<option value="-1">SELECCIONE</option>', '');
                $('#update_id_usuario_tipo').html(data);
                $('#id_usuario_tipo').html(data);
            }
        });
        $('#actualizar').click(function ()
        {
            $.ajax({
                url: 'Ajax/AjaxActualizarUsuario',
                data: $('#update_form_update').serialize(),
                type: 'POST',
                success: function ()
                {
                    ConsultarUsuarios();
                    $('#myModalEdit').modal('hide');
                }
            });
        });
        $('#id_usuario_tipo').change(function ()
        {
            if ($('#id_usuario_tipo').val() === '1')
            {
                $('#dependencia').show();
            } else
            {
                $('#dependencia').hide();
            }
        });
        $('#form').submit(function (e)
        {
            e.preventDefault();
            $.ajax({
                url: 'Ajax/AjaxGuardarUsuario',
                data: $(this).serialize(),
                type: 'POST',
                success: function ()
                {
                    $('input').val('');
                    ConsultarUsuarios();
                }
            });
        });
    });
    function editar(id)
    {
        $.ajax({
            url: 'Ajax/AjaxVerUsuario',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function (data, textStatus, jqXHR)
            {
                $.each(data, function (index, value)
                {
                    $('#update_' + index).val(value);
                });
                if ($('#update_id_usuario_tipo').val() == '1')
                {
                    $('#update_dependencia').show();
                    $('#update_id_dependencia').val();
                    console.log(data);
                } else
                {
                    $('#update_dependencia').hide();
                }
                $('#myModalEdit').modal('show');
            }
        }
        );
    }
</script>
<div class="container-fluid">
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                Usuarios
            </div>
            <form id="form">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <label>Nombre</label>
                            <input class="form form-control" id="nombre" name="nombre">
                        </div>
                        <div class="col-xs-12">
                            <label>Apellido</label>
                            <input class="form form-control" id="apellido" name="apellido">
                        </div>
                        <div class="col-xs-12">
                            <label>Documento</label>
                            <input class="form form-control" id="documento" name="documento">
                        </div>
                        <div class="col-xs-12">
                            <label>Telefono</label>
                            <input class="form form-control" id="telefono" name="telefono">
                        </div>
                        <div class="col-xs-12">
                            <label>Celular</label>
                            <input class="form form-control" id="celular" name="celular">
                        </div>
                        <div class="col-xs-12">
                            <label>Correo</label>
                            <input class="form form-control" id="correo" name="correo">
                        </div>
                        <div class="col-xs-12">
                            <label>Tipo de usuario</label>
                            <select class="form form-control" id="id_usuario_tipo" name="id_usuario_tipo"></select>
                        </div>
                        <div id="dependencia">
                            <div class="col-xs-12">
                                <label>Tipo de usuario</label>
                                <select class="form form-control" id="id_dependencia" name="id_dependencia">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="container-fluid">
                        <div class="col-xs-12">
                            <button class="form form-control btn btn-success" type="submit">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div id="Users"></div>
    </div>
</div>
<div id="modal">
    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"  style="color: #fff;background-color: #5cb85c;border-color: #4cae4c;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar</h4>
                </div>
                <div class="modal-body">
                    <form id="update_form_update">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="col-xs-12">
                                    <label>Nombre</label>
                                    <input class="form form-control" id="update_nombre" name="update_nombre">
                                </div>
                                <div class="col-xs-12">
                                    <label>Apellido</label>
                                    <input class="form form-control" id="update_apellido" name="update_apellido">
                                </div>
                                <div class="col-xs-12">
                                    <label>Documento</label>
                                    <input class="form form-control" id="update_documento" name="update_documento">
                                </div>
                                <div class="col-xs-12">
                                    <label>Telefono</label>
                                    <input class="form form-control" id="update_telefono" name="update_telefono">
                                </div>
                                <div class="col-xs-12">
                                    <label>Celular</label>
                                    <input class="form form-control" id="update_celular" name="update_celular">
                                </div>
                                <div class="col-xs-12">
                                    <label>Correo</label>
                                    <input class="form form-control" id="update_correo" name="update_correo">
                                </div>
                                <div class="col-xs-12">
                                    <label>Tipo de usuario</label>
                                    <select class="form form-control" id="update_id_usuario_tipo" name="update_id_usuario_tipo"></select>
                                </div>
                                <div class="col-xs-12">
                                    <div id="update_dependencia">
                                        <label>Tipo de dependencia</label>
                                        <select class="form form-control" id="update_id_dependencia" name="update_id_dependencia">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="update_id_usuario" id="update_id_usuario">
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-6">
                        <button type="button" class="btn btn-success form form-control" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="col-xs-6">
                        <button type="button" id="actualizar" class="btn btn-primary form form-control">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<#--content_fin--#>