<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('id', 'nombre_tipo_peticion'));
#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/controlPetidion.php';
$Peti = new controlPetidion();
extract($_POST);
$Peti->EditTipoPeticion($id, $nombre_tipo_peticion);
