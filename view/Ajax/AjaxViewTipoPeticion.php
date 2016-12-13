<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
ValidarSesion();
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlPetidion.php';
include_once '../../controller/Visual.php';
$Render = new Visual();
$Peti   = new controlPetidion();
$Datos  = $Peti->VerTiposPeticiones();
$Data   = array();
foreach ($Datos as $temp)
{
    $temp['descripcion']         = '<input id="edit_tipo_' . $temp['id_dependencia_tipo'] . '" class="edit_descript" value="' . $temp['descripcion'] . '">';
    $temp['id_dependencia_tipo'] = '<button class="form form-control btn btn-success" onclick="editar(' . $temp['id_dependencia_tipo'] . ')"><i class="glyphicon glyphicon-floppy-saved"></i></button>';
    $Data[]                      = $temp;
}

echo $Render->Tabla($Data, '', array('Editar', 'Nombre'), 'table table-hover');
