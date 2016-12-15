<?php

include_once '../../controller/Visual.php';
include_once '../../controller/controlDependencias.php';
$dependencia = new controlDependencias();
$Render      = new Visual();
$Datos       = $dependencia->Dependencias_All();
echo $Render->Select($Datos,'','-1');
