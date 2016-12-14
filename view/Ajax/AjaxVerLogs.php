<?php

include_once '../../controller/controlLog.php';
$Log = new controlLog();
extract($_POST);
var_dump($Log->Select($Fechainicio, $Fechafin, $id_user));
