<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('nombre_tipo_peticion'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlPetidion.php';
$Peti = new controlPetidion();
$Peti->NuevoTipoPeticion($_POST['nombre_tipo_peticion']);
