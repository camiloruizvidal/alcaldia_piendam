<?php

include_once '../../controller/controlPetidion.php';
include_once '../../controller/Visual.php';
$Render   = new Visual();
$Peticion = new controlPetidion();
$Datos    = $Peticion->VerEstadosPeticiones($_POST['id_peticion']);
if (count($Datos) > 0)
{
    echo $Render->Tabla($Datos,'1',array('#','Fecha y hora','Estado Anterior','Estado Nuevo','Usuario<br>sistema','Descripción'),'table table-hover','',TRUE);
}
else
{
    echo '<h1>No se han generado cambios de estados</h1>';
}