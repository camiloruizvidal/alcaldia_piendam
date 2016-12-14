<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'reportes.php';
$form->parametros = array('titulo' => 'Ingreso de peticiones', 'active' => array('admin_logs'), 'css' => array('css/source/custom-small-screens.css'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<script>
    $(function ()
    {
        $.ajax({
            url: 'Ajax/AjaxVerLogs.php',
            type: 'POST',
            data: {Fechainicio: '', Fechafin: '', id_user: ''},
            success: function (data) {
                $('#data').html(data);
            }
        });
    });
</script>
<div class="container-fluid">
    <div class="col-md-12">
        <pre>
            <div id="data"></div>
        </pre>
    </div>
</div>
<#--content_fin--#>