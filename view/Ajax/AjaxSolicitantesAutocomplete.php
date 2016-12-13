<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
ValidarSesion();
#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/controlPetidion.php';
extract($_GET);
$Solicitantes = new controlPetidion();
echo json_encode($Solicitantes->VerSolicitantes($term));
