<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
ValidarSesion();
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlDependencias.php';
include_once '../../controller/Visual.php';
$Render      = new Visual();
$dependencia = new controlDependencias();
$Datos       = $dependencia->Dependencias_All();
echo $Render->Select($Datos);
