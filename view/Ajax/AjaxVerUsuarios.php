<?php

include_once '../../controller/controlusuario.php';
include_once '../../controller/Visual.php';
$User   = new controlusuario();
$Render = new Visual();
$Datos  = $User->VerUsuariosSistema();
foreach ($Datos as $key => $temp)
{
    $temp['id_usuario'] = '<button class="btn btn-success" onclick="editar(' . $temp['id_usuario'] . ')"><i class="glyphicon glyphicon-user"></i></button>';
    $Datos[$key]        = $temp;
}
echo $Render->Tabla($Datos, '', array('#', 'Editar', 'Usuario', 'Documento', 'Telefono', 'Celular', 'Correo', 'Tipo de usuario'), 'table table-hover', '', TRUE);
