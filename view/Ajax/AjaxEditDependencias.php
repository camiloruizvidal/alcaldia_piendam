<?php
extract($_POST);
include_once '../../controller/controlDependencias.php';
$Dep = new controlDependencias();
$Dep->EditarDependencia($id_dependencia, $descripcion, $codigo);
