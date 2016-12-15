<?php

extract($_POST);
include_once '../../controller/controlusuario.php';
include_once '../../controller/controlDependencias.php';
$depe = new controlDependencias();
$user = new controlusuario();
$id   = $user->newusuario($nombre, $apellido, $documento, $telefono, $celular, $correo, $documento, $documento, $id_usuario_tipo);

if ($id_usuario_tipo === '1')
{
    $depe->DependenciaUsuario($id_dependencia, $id);
}