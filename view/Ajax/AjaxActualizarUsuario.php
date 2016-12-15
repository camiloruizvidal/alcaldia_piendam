<?php

extract($_POST);
include_once '../../controller/controlusuario.php';
$user = new controlusuario();
$user->ActualizarUsuario($update_id_usuario, $update_nombre, $update_apellido, $update_documento, $update_telefono, $update_celular, $update_correo, $update_id_usuario_tipo);
