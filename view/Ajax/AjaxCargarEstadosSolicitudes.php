<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
ValidarSesion();
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/Visual.php';
include_once '../../controller/controlPetidion.php';

$Render     = new Visual();
$Peticiones = new controlPetidion();
echo $Render->Select($Peticiones->VerPeticionesEstados());
