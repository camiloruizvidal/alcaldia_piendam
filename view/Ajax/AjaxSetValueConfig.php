<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('value', 'name'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../model/activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';
$sql = 'UPDATE `config` SET `value` = ?
WHERE `config`.`name` = ?';
$con = App::$base;
$con->dosql($sql, array($_POST['value'], $_POST['name']));
