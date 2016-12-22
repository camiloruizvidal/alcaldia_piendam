<?php

include_once '../../controller/controlReportes.php';
include_once '../../controller/Visual.php';
$Rep          = new controlReportes();
$Render       = new Visual();
$filt_id_tipo = '';
if ($_POST)
{
    extract($_POST);
    $data = array();
    $Data = $Rep->VerSolicitudes($id_filt_ciudadano, $Fechaini, $Fechafin, $Estado, $id_dependencia, $filt_id_tipo);
    foreach ($Data as $temp)
    {
        $button = '<button onclick="Detalle(' . $temp['id_peticion'] . ')" class="form form-control btn btn-success"><i class="glyphicon glyphicon-search"></i></button>';
        $data[] = array($button,
            $temp['dependencia'],
            $temp['tipo_dependencia'],
            $temp['ciudadano'],
            $temp['fecha_hora_solicitud'],
            $temp['vereda'],
            $temp['fecha_hora_respuesta'],
            $temp['estado']);
    }
    echo $Render->Tabla($data, '', array('#', 'Detalle', 'Dependencia', 'Tipo<br/>solicitud', 'Ciudadano', 'Hora<br/>Llegada', 'Vereda', 'Hora de respuesta', 'Estado'), 'table table-hover', 'myTable', TRUE);
}
if ($_GET)
{
    include_once '../../model/modelConfig.php';
    $Enc  = new modelConfig();
    extract($_GET);
    $data = array();
    $Data = $Rep->VerSolicitudes($id_filt_ciudadano, $Fechaini, $Fechafin, $Estado, $id_dependencia, $filt_id_tipo);
    foreach ($Data as $temp)
    {
        $data[] = array($temp['dependencia'],
            $temp['tipo_dependencia'],
            $temp['ciudadano'],
            $temp['fecha_hora_solicitud'],
            $temp['vereda'],
            $temp['fecha_hora_respuesta'],
            $temp['estado'],
            $temp['peticion']);
    }
    echo $Enc->VerValue('formato_admin') . '<br>';
    echo $Render->Tabla($data, '', array('#', 'Dependencia', 'Tipo<br/>solicitud', 'Ciudadano', 'Fecha y hora<br/>de llegada', 'Vereda', 'Hora de respuesta', 'Estado', 'Descripcion',), 'table table-hover', '', TRUE);
}