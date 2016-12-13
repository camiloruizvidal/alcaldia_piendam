<?php

include_once '../../controller/controlReportes.php';
include_once '../../controller/Visual.php';
$Rep              = new controlReportes();
$Render           = new Visual();
$id_ciudadano     = '';
$fecha_inicio     = '';
$fecha_fin        = '';
$estado           = '';
$id_dependencia   = '';
$id_tipo_peticion = '';
$Data             = $Rep->VerSolicitudes($id_ciudadano, $fecha_inicio, $fecha_fin, $estado, $id_dependencia, $id_tipo_peticion);
echo $Render->Tabla($Data);
