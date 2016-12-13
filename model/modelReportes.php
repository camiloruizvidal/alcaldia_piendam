<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelReportes
{

    public function VerSolicitudes($id_ciudadano, $fecha_inicio, $fecha_fin, $estado, $id_dependencia, $id_tipo_peticion)
    {
        $sql = 'SELECT 
                    `dependencia`.`nombre` AS `dependencia`,
                    `dependencia_tipo`.`descripcion` AS `tipo_dependencia`,
                    CONCAT_WS(\' \', `usuario`.`nombre`, `usuario`.`apellido`, `usuario`.`documento`) AS `ciudadano`,
                    `peticion`.`fecha_hora` AS `fecha_hora_solicitud`,
                    `vereda`.`nombre` AS `vereda`,
                    `peticion`.`fecha_hora_respuestad`,
                    SUBSTRING(`peticion`.`descripcion` FROM 1 FOR 10) as peticion
                FROM
                    `dependencia_tipo`
                    INNER JOIN `peticion` ON (`dependencia_tipo`.`id_dependencia_tipo` = `peticion`.`id_tipo`)
                    INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
                    INNER JOIN `usuario` ON (`peticion`.`id_usuario` = `usuario`.`id_usuario`)
                    INNER JOIN `vereda` ON (`peticion`.`id_vereda` = `vereda`.`id_vereda`)';
        $con = App::$base;
        $Res = $con->Records($sql, array($id_usuario, $id_dependencia));
        return $Res;
    }

}
