<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'reportes.php';
$form->parametros = array('titulo' => 'Ingreso de dependencias', 'active' => array('admin_dependencias'), 'css' => array('css/source/custom-small-screens.css', 'css/source/registro_solicitudes.css'), 'js' => array('js/jquery/jquery.printPage.js', 'js/source/reportes.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<script>
    $(function ()
    {
        CargarDependencias();
    });
    function CargarDependencias()
    {
        $.ajax({
            url: 'Ajax/AjaxListadoDependencias',
            success: function (data) {
                $('#ListadoDependencias').html(data);
            }
        });
    }
    function GuardarDependencia()
    {
        if ($('#codigo').val() !== '' && $('#descripcion').val() !== '')
        {
            loadingstart()
            $.ajax({
                url: 'Ajax/AjaxGuardarNewDependencias',
                type: 'POST',
                data: {
                    descripcion: $('#descripcion').val(),
                    codigo: $('#codigo').val()
                },
                success: function (data) {
                    loadingstop();
                    CargarDependencias();
                }
            });
        } else
        {
            alert('Debe llenar todos los datos');
        }
    }
    function EditarDependencia(id)
    {
       loadingstart();
        $.ajax({
            url: 'Ajax/AjaxEditDependencias',
            type: 'POST',
            data: {
                descripcion: $('#descripcion_' + id).val(),
                id_dependencia: id,
                codigo: $('#codigo_' + id).val()
            },
            success: function () {
                CargarDependencias();
                loadingstop();
            }
        });
    }
</script>
<style>
    .modal-footer
    {
        background-color: #e5e5e5;
    }
    #info_reporte table
    {
        font-size: 14px;
    }    
</style>
<div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            Solicitudes
        </div>
        <div class="panel panel-body">
            <div class="container-fluid">
                <div class="col-md-4">
                    <label>Dependencia</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-plus"></i></span>
                        <input id="descripcion" class="form form-control" name="descripcion">
                    </div>
                    <label>Codigo</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-plus"></i></span>
                        <input id="codigo" class="form form-control" name="codigo">
                    </div>
                    <label> </label>
                    <button onclick="GuardarDependencia()" class="btn btn-success form form-control"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                </div>
                <div class="col-md-8">
                    <div id="ListadoDependencias">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<#--content_fin--#>