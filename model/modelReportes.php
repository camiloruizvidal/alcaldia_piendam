<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelReportes
{

    public function VerSolicitudes($id_ciudadano, $fecha_inicio, $fecha_fin, $estado, $id_dependencia, $id_tipo_dependencia)
    {
        $Wheres   = array();
        $Filtros  = array();
        $wheresql = '';
        if ($id_ciudadano != '' && $id_ciudadano != '0')
        {
            $Wheres[]   = ' `usuario`.`id_usuario` = ? ';
            $Filtros[] = $id_ciudadano;
        }
        if ($estado != '-1' && trim($estado) !== '')
        {
            $Wheres[]  = ' `peticion`.`id_estado`=? ';
            $Filtros[] = $estado;
        }
        if ($id_tipo_dependencia != '-1' && trim($id_tipo_dependencia) !== '')
        {
            $Wheres[]  = ' `peticion`.`id_tipo`= ? ';
            $Filtros[] = $id_tipo_dependencia;
        }
        if ($id_dependencia != '-1' && trim($id_dependencia) !== '')
        {
            $Wheres[]  = ' `dependencia`.`id_dependencia` = ? ';
            $Filtros[] = $id_dependencia;
        }
        if (trim($fecha_inicio) != '')
        {
            $Wheres[]  = ' date(`peticion`.`fecha_hora`) >= date(?) ';
            $Filtros[] = $fecha_inicio;
        }
        if (trim($fecha_fin) != '')
        {
            $Wheres[]  = ' date(?) >= date(`peticion`.`fecha_hora`) ';
            $Filtros[] = $fecha_fin;
        }
        if (count($Wheres) > 0)
        {
            $wheresql = ' WHERE ' . implode(' and ', $Wheres);
        }
        $sql = 'SELECT 
            `peticion`.`id_peticion`,
                    `dependencia`.`nombre` AS `dependencia`,
                    `dependencia_tipo`.`descripcion` AS `tipo_dependencia`,
                    CONCAT_WS(\' \', `usuario`.`nombre`, `usuario`.`apellido`, `usuario`.`documento`) AS `ciudadano`,
                    DATE_FORMAT(`peticion`.`fecha_hora`,\'%d-%m-%Y %h:%i %p\') AS `fecha_hora_solicitud`,
                    `vereda`.`nombre` AS `vereda`,
                    COALESCE(DATE_FORMAT(`peticion`.`fecha_hora_respuestad`,\'%d-%m-%Y %h:%i %p\'),\'No hay respuesta\') as fecha_hora_respuesta,
                    `peticion_estado`.`descripcion` AS `estado`,
                    SUBSTRING(`peticion`.`descripcion` FROM 1 FOR 10) as peticion
                FROM
                    `dependencia_tipo`
                    INNER JOIN `peticion` ON (`dependencia_tipo`.`id_dependencia_tipo` = `peticion`.`id_tipo`)
                    INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
                    INNER JOIN `usuario` ON (`peticion`.`id_usuario` = `usuario`.`id_usuario`)
                    INNER JOIN `vereda` ON (`peticion`.`id_vereda` = `vereda`.`id_vereda`)
                    INNER JOIN `peticion_estado` ON (`peticion`.`id_estado` = `peticion_estado`.`id_peticion_estado`)'
                . $wheresql;
        $con = App::$base;
        $Res = $con->Records($sql, $Filtros);
        return $Res;
    }

}
