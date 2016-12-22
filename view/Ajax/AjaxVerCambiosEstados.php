<?php

include_once '../../controller/controlPetidion.php';
include_once '../../controller/Visual.php';
$Render       = new Visual();
$Peticion     = new controlPetidion();
$id_solicitud = $_POST['id_peticion'];
$data         = $Peticion->VerPeticion($id_solicitud);
$Datos        = $Peticion->VerEstadosPeticiones($id_solicitud);
echo '
<div class="container-fluid">
    <div class="col-md-6">
    <label>
    Ingreso
    </label>
    ' . $data['fecha_hora'] . '
    </div>
    <div class="col-md-6">
    <label>
    Estado
    </label>
    ' . $data['estado'] . '
    </div>
    <div class="col-md-6">
    <label>
    Solicitante
    </label>
    ' . $data['nombre'] .' '. $data['apellido'] . '
    </div>
    <div class="col-md-6">
    <label>
    Documento
    </label>
    ' . $data['documento'] . '
    </div>
    <div class="col-md-6">
    <label>
    Vereda
    </label>
    ' . $data['nombre_vereda'] . '
    </div>
    <div class="col-md-6">
    <label>
    Tipo peticion
    </label>
    <span>' . $data['descripcion_tipo_dependencia'] . '</span>
    </div>
</div>';
if (count($Datos) > 0)
{
    echo $Render->Tabla($Datos, '1', array('#', 'Fecha y hora', 'Estado Anterior', 'Estado Nuevo', 'Usuario<br>sistema', 'Descripción'), 'table table-hover', '', TRUE);
}
else
{
    echo '<h1>No se han generado cambios de estados</h1>';
}