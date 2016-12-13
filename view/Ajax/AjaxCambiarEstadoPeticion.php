<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('cambio_estado_id_peticion', 'cambio_estado_id_estados', 'cambio_estado_descripcion'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlPetidion.php';
$peti = new controlPetidion();
extract($_POST);
$peti->CambioEstadoPeticion($cambio_estado_id_peticion, $cambio_estado_id_estados, $cambio_estado_descripcion);
