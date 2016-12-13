<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('id_dependencia'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../controller/controlPetidion.php';
include_once '../../controller/Visual.php';
$Render    = new Visual();
$TipoDepen = new controlPetidion();
extract($_POST);
$Datos     = $TipoDepen->VerTiposPeticionesAll($id_dependencia);
echo $Render->Select($Datos);
