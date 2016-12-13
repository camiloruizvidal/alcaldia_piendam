<?php

if ($_POST)
{
    #=======================================VALIDACION DE SEGURIDAD=======================================#
    include_once '../../controller/security_session.php';
    validarPost(array('id_tipo'));
    #=======================================VALIDACION DE SEGURIDAD=======================================#
    extract($_POST);
    include_once '../../controller/controlDependencias.php';
    include_once '../../controller/Visual.php';
    $Render      = new Visual();
    $dependencia = new controlDependencias();
    $Datos       = $dependencia->TiposDependencias($id_tipo);
    echo $Render->Select($Datos);
}