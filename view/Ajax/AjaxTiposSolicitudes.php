<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
ValidarSesion();
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlPetidion.php';
include_once '../../controller/Visual.php';
$Render    = new Visual();
$TipoDepen = new controlPetidion();
$Datos     = $TipoDepen->VerTiposPeticiones();
echo $Render->Select($Datos);
