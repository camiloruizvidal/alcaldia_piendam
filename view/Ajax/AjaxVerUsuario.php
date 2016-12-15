<?php

include_once '../../controller/controlusuario.php';
$User = new controlusuario();
extract($_POST);
echo json_encode($User->VerUsuarioId($id));
