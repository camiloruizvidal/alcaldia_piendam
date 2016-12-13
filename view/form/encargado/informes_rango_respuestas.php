<?php
include_once '../../../controller/form.php';
$form->ruta       = '../../../view/plantillas';
$form->plantilla  = 'admin_informes.php';
$form->parametros = array('titulo' => 'rangos', 'css' => array('css/source/custom-small-screens.css', 'css/source/registro_solicitudes.css'), 'js' => array('js/jquery/jquery.printPage.js', 'js/source/solicitudes_registros.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
informes_rangos
<#--content_fin--#>