<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array("id_solicitud"));
#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/controlPetidion.php';
$user = new controlPetidion();
echo json_encode($user->VerPeticion($_POST['id_solicitud']),JSON_PRETTY_PRINT);
