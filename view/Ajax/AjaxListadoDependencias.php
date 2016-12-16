<?php

include_once '../../controller/controlDependencias.php';
include_once '../../controller/Visual.php';
$Render = new Visual();
$Dep    = new controlDependencias();
$Data   = $Dep->Dependencias_All_cod();
foreach ($Data as $key => $temp)
{
    $temp['nombre'] = '<input value="' . $temp['nombre'] . '" id="descripcion_' . $temp['id_dependencia'] . '" name="descripcion[]" class="form form-control">';
    $temp['codigo'] = '<input value="' . $temp['codigo'] . '" id="codigo_' . $temp['id_dependencia'] . '" name="codigo[]" class="form form-control">';
    $Data[$key]     = $temp;
}
$Data = $Render->FunctionTableBoton2($Data, 'id_dependencia', 'EditarDependencia', 'glyphicon glyphicon-floppy-saved', 'primary');
echo $Render->Tabla($Data, '', array('Editar','Nombre','Codigo'), 'table table-hover');
