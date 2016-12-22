<?php

include_once '../../controller/Visual.php';
include_once '../../controller/controlPetidion.php';
$Render = new Visual();
$peti   = new controlPetidion();

if ($_POST)
{
    if (!isset($_POST['filt_id_tipo']))
    {
        exit('No hay tipos de peticiones registrada. Dirijase a <a href="sistema">configuracion</a>.');
    }
#=======================================VALIDACION DE SEGURIDAD=======================================#
    include_once '../../controller/security_session.php';
    validarPost(array("id_filt_ciudadano", "filt_ciudadano", "Fechaini", "Fechafin", "Estado", 'filt_id_tipo'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

    extract($_POST);
    $Datos = $peti->VerPeticiones($id_filt_ciudadano, $filt_ciudadano, $Fechaini, $Fechafin, $Estado, $filt_id_tipo);
    echo $Render->Tabla($Datos, '', array('#', 'editar', 'Archivo', 'Ciudadano', 'Fecha hora', 'Estado', 'Resumen', 'Peticion'), 'table table-hover', 'myTable', true);
}
if ($_GET)
{
    extract($_GET);
    include '../../model/modelConfig.php';
    $con        = new modelConfig();
    $Encabezado = $con->VerValue('formato_encabezado');
    $Datos      = $peti->VerPeticiones($id_filt_ciudadano, $filt_ciudadano, $Fechaini, $Fechafin, $Estado, $filt_id_tipo);
    $data       = array();
    foreach ($Datos as $temp)
    {
        $data[] = array($temp['ciudadano'], $temp['fecha_hora'], $temp['estado'], $temp['dependencia_tipo_descripcion']);
    }
    echo $Encabezado . '<br>';
    if ($filt_ciudadano != '')
    {
        echo '<strong>Ciudadano</strong>: ' . $filt_ciudadano . '<br>';
    }
    if ($Fechaini != '')
    {
        echo '<strong>Fecha de inicio</strong>: ' . $Fechaini . ' ';
    }
    if ($Fechafin != '')
    {
        echo '<strong>Fecha de fin</strong>: ' . $Fechafin . '<br>';
    }
    echo $Render->Tabla($data, '', array('#', 'Ciudadano', 'Fecha hora', 'Estado', 'Tipo'), 'table table-hover', '', TRUE);
}
