<?php

include_once '../../controller/controlusuario.php';
include_once '../../controller/Visual.php';
$Render = new Visual();
$Tipos  = new controlusuario();
$Datos  = $Tipos->VerTiposUsuarios();
echo $Render->Select($Datos);
