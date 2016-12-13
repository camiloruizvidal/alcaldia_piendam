<?php

#=======================================VALIDACION DE SEGURIDAD=======================================#
include_once '../../controller/security_session.php';
validarPost(array('name'));
#=======================================VALIDACION DE SEGURIDAD=======================================#

include_once '../../model/activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';
$sql   = 'SELECT 
                    `config`.`value`
            FROM
                    `config`
            WHERE
                    `config`.`name`=?';
$con   = App::$base;
$Datos = $con->Record($sql, array($_POST['name']));
echo json_encode(array('value' => $Datos['value']), JSON_PRETTY_PRINT);
