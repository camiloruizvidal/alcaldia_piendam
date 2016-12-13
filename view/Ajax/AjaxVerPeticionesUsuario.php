<?php

if ($_POST)
{
#=======================================VALIDACION DE SEGURIDAD=======================================#
    include_once '../../controller/security_session.php';
    validarPost(array("id_estado", "id_tipo", "id_dependencia_tipo", "fecha_ini", "fecha_fin"));
#=======================================VALIDACION DE SEGURIDAD=======================================#
    extract($_POST);
    include_once '../../controller/Visual.php';
    include_once '../../controller/controlPetidion.php';
    $Render = new Visual();
    $Peti   = new controlPetidion();
    $data   = array();
    $Datos  = $Peti->VerPeticionesCiudadano($id_estado, $id_tipo, $id_dependencia_tipo, $fecha_ini, $fecha_fin);
    $Res    = array();
    foreach ($Datos as $temp)
    {
        $temp1['head'] = 'Solicitud del ' . $temp["fecha_hora"] . '. Estado ' . $temp["estado"];
        $temp1['body'] = '  <h4>Tipo de solicitud: ' . $temp["tipo"] . '</h4>
                            <h4>Dependencia: ' . $temp["nombre"] . '</h4>
                            <h4>Hora de respuesta: ' . $temp["fecha_hora_respuestad"] . '</h4>'
                . '<p>' . $temp["descripcion"] . '</p>';
        $Res[]         = $temp1;
    }
    echo $Render->Tabsmenu($Res);
}
if ($_GET)
{
    if (!isset($_GET['id_dependencia_tipo']))
    {
        $_GET['id_dependencia_tipo'] = '-1';
    }
#=======================================VALIDACION DE SEGURIDAD=======================================#
    include_once '../../controller/security_session.php';
    validarGet(array("id_estado", "id_tipo", "id_dependencia_tipo", "fecha_ini", "fecha_fin"));
#=======================================VALIDACION DE SEGURIDAD=======================================#
    extract($_GET);
    include_once '../../controller/Visual.php';
    include_once '../../controller/controlPetidion.php';
    $Render = new Visual();
    $Peti   = new controlPetidion();
    $data   = array();
    $Datos  = $Peti->VerPeticionesCiudadano($id_estado, $id_tipo, $id_dependencia_tipo, $fecha_ini, $fecha_fin);
    $Res    = array();
    $data   = '';
    foreach ($Datos as $temp)
    {
        $data .= '<h1>Solicitud del ' . $temp["fecha_hora"] . '. Estado ' . $temp["estado"] . '<h1>' .
                '  <h4>Tipo de solicitud: ' . $temp["tipo"] . '</h4>
        <h4>Dependencia: ' . $temp["nombre"] . '</h4>
        <h4>Hora de respuesta: ' . $temp["fecha_hora_respuestad"] . '</h4>'
                . '<p>' . $temp["descripcion"] . '</p>';
    }
    echo '<table width="100%"><tr><td style="width: 10%;text-align: right;"><img src="http://img.webme.com/pic/p/piendamoenlinea/escudo_piendamo_color.jpg" style="width: 130px;/* text-align: right; */"></td><td><center><h1>Informe de solicitudes</h1></center></td><tr></table>';
    echo $data;
}