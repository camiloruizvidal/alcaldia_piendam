<?php

include_once '../../controller/controlDependencias.php';
$Dep = new controlDependencias();
extract($_POST);
$Dep->NewDependencia($descripcion, $codigo);
