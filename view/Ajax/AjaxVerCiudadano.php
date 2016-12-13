<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array("documento"));
#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/controlusuario.php';
$user = new controlusuario();
echo $user->findusuario($_POST['documento']);
