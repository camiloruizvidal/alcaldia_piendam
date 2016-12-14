<?php

class modelLogs
{

    private function FieldsColumns($_table)
    {
        $sql  = 'SHOW COLUMNS FROM `' . $_table . '`';
        $con  = App::$base;
        $Res  = $con->Records($sql, array());
        $data = array();
        foreach ($Res as $temp)
        {
            $data[] = ($temp["Field"]);
        }
        return json_encode($data, TRUE);
    }

    public function InserLogs($id_user, $fecha_hora, $ip, $funcion, $data_after, $data_before, $table)
    {
        $fields           = $this->FieldsColumns($table);
        $sys              = atable::Make('tbl_sys_log');
        $sys->id_user     = $id_user;
        $sys->fecha_hora  = $fecha_hora;
        $sys->ip          = $ip;
        $sys->funcion     = $funcion;
        $sys->data_after  = '{' . $fields . ',' . $data_after . '}';
        $sys->data_before = '{' . $fields . ' ' . $data_before . '}';
        $sys->table_db    = $table;
        $sys->Save();
    }

    public function select($id_usuario, $FechaInicio, $FechaFin)
    {
        $Filtro = array();
        $sql    = 'SELECT 
                CONCAT_WS(\' \', `usuario`.`nombre`, `usuario`.`apellido`) AS `usuario`,
                `tbl_sys_log`.`fecha_hora`,
                `tbl_sys_log`.`ip`,
                `tbl_sys_log`.`funcion`,
                `tbl_sys_log`.`data_after`,
                `tbl_sys_log`.`data_before`
              FROM
                `tbl_sys_log`
                INNER JOIN `usuario` ON (`tbl_sys_log`.`id_user` = `usuario`.`id_usuario`)
              ORDER BY
                `tbl_sys_log`.`fecha_hora`';
        $con    = App::$base;
        $Res    = $con->Records($sql, $Filtro);
        return $Res;
    }

}
