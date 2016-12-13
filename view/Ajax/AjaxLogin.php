<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array("login", "password"),FALSE);
#=======================================VALIDACION DE SEGURIDAD=======================================#
extract($_POST);
include_once '../../controller/sesiones.php';
$sesion = new sesiones();
if (!$sesion->ValidarSesion($login, $password))
{
    echo json_encode(array('SiValida' => FALSE, 'url' => 'login'), true);
}
else
{
    @session_start();
    echo json_encode(array('SiValida' => TRUE, 'url' => $_SESSION['url']), true);
}