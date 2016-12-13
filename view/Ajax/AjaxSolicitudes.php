<?php

include_once '../../controller/Visual.php';
include_once '../../controller/controlPetidion.php';
$Render = new Visual();
$peti   = new controlPetidion();

if ($_POST)
{
#=======================================VALIDACION DE SEGURIDAD=======================================#
    include_once '../../controller/security_session.php';
    validarPost(array("id_filt_ciudadano", "filt_ciudadano", "Fechaini", "Fechafin", "Estado", 'filt_id_tipo'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

    extract($_POST);
    $Datos = $peti->VerPeticiones($id_filt_ciudadano, $filt_ciudadano, $Fechaini, $Fechafin, $Estado, $filt_id_tipo);
    echo $Render->Tabla($Datos, '', array('#', 'editar', 'Archivo', 'Ciudadano', 'Fecha hora', 'Estado', 'Resumen', 'Peticion'), 'table table-hover', '', true);
}
if ($_GET)
{
    extract($_GET);
    $Datos = $peti->VerPeticiones($id_filt_ciudadano, $filt_ciudadano, $Fechaini, $Fechafin, $Estado, $filt_id_tipo);
    $data  = array();
    foreach ($Datos as $temp)
    {
        $data[] = array($temp['ciudadano'], $temp['fecha_hora'], $temp['estado'], $temp['dependencia_tipo_descripcion']);
    }
    echo '<table width="100%">'
    . '<tr>'
    . '<td style="width: 10%;text-align: right;"><img src="http://img.webme.com/pic/p/piendamoenlinea/escudo_piendamo_color.jpg" style="width: 130px;/* text-align: right; */"></td>'
    . '<td><center><h1>Informe de solicitudes</h1></center></td><tr></table>';
    echo '<h4>Criterio de búsqueda</h4>';
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
