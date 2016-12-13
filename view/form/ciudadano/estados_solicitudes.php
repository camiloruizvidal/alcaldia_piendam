<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'ciudadano.php';
$form->parametros = array('titulo' => 'Peticiones', 'css' => array('css/source/custom-small-screens.css'), 'js' => array('js/jquery/jquery.printPage.js', 'js/source/solicitudes_ciudadano.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<div class="col-md-4">
    <div class="panel panel-success">
        <form id="form_filtr" action='Ajax/AjaxVerPeticionesUsuario.php' method="post">

            <div class="panel-heading">
                Filtrar
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <label>Fecha de inicio</label>
                    <input class="form form-control" id="fecha_ini" name="fecha_ini">

                </div>
                <div class="col-md-6">
                    <label>Fecha de fin</label>
                    <input class="form form-control" id="fecha_fin" name="fecha_fin">
                </div>
                <div class="col-xs-12">
                    <label>Estado</label>
                    <select class="form form-control" id="id_estado" name="id_estado">
                        <option value="-1"></option>
                    </select>
                </div>
                <div class="col-xs-12">
                    <label>Dependencia</label>
                    <select class="form form-control" id="id_dependencia_tipo" name="id_dependencia_tipo">
                        <option value="-1"></option>
                    </select>
                </div>
                <div class="col-xs-12">
                    <label>Tipo</label>
                    <select class="form form-control" id="id_tipo" name="id_tipo">
                        <option value="-1"></option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label> </label>
                    <a href="" id="imp_data" class="boton_imp"><button class="brn btn-primary form form-control"><i class="glyphicon glyphicon-print"></i> Imprimir</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-success">
        <div class="panel-heading">
            Solicitudes
        </div>
        <div class="panel-body">
            <div id="Data"></div>
        </div>
    </div>
</div>
<#--content_fin--#>