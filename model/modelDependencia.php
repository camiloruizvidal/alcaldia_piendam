<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelDependencia
{

    public function TiposDependencias($id_usuario, $id_dependencia)
    {
        $sql = 'SELECT 
                    `dependencia_tipo`.`id_dependencia_tipo`,
                    `dependencia_tipo`.`descripcion`
                FROM
                    `peticion`
                    INNER JOIN `dependencia_tipo` ON (`peticion`.`id_tipo` = `dependencia_tipo`.`id_dependencia_tipo`)
                    INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
                WHERE
                    `peticion`.`id_usuario` = ? 
                AND
                    `dependencia`.`id_dependencia` = ?
                GROUP BY
                    `dependencia_tipo`.`id_dependencia`,
                    `dependencia_tipo`.`descripcion`
                ORDER BY
                    `dependencia_tipo`.`id_dependencia`,
                    `dependencia_tipo`.`descripcion`';
        $con = App::$base;
        $Res = $con->Records($sql, array($id_usuario, $id_dependencia));
        return $Res;
    }

    public function Dependencias_peticionesxUser($id_usuario)
    {
        $sql = 'SELECT 
                    `dependencia`.`id_dependencia`,
                    `dependencia`.`nombre`
              FROM
                    `peticion`
                    INNER JOIN `dependencia_tipo` ON (`peticion`.`id_tipo` = `dependencia_tipo`.`id_dependencia_tipo`)
                    INNER JOIN `dependencia` ON (`dependencia_tipo`.`id_dependencia` = `dependencia`.`id_dependencia`)
              WHERE
                    `peticion`.`id_usuario` = ?
              GROUP BY
                    1, 2
              ORDER BY
                `dependencia`.`nombre`';
        $con = App::$base;
        $Res = $con->Records($sql, array($id_usuario));
        return $Res;
    }

}
