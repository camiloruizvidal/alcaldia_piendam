<?php

include_once '../../model/activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';
include_once '../../controller/Visual.php';
$Render = new Visual();
$sql    = 'Select 
        `vereda`.`id_vereda`,
        `vereda`.`nombre`
        FROM 
        vereda
        Order by
        `vereda`.`nombre`
        ';
$con    = App::$base;
$Datos  = $con->Records($sql, array());
echo $Render->Select($Datos, '', FALSE);
