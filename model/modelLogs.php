<?php

class modelLogs
{

    public function InserLogs($id_user, $fecha_hora, $ip, $funcion, $data_after, $data_before, $table)
    {
        $sys              = atable::Make('peticion_files');
        $sys->id_user     = $id_user;
        $sys->fecha_hora  = $fecha_hora;
        $sys->ip          = $ip;
        $sys->funcion     = $funcion;
        $sys->data_after  = $data_after;
        $sys->data_before = $data_before;
        $sys->table       = $table;
        $sys->Save();
    }

    public function select($id_usuario, $FechaInicio, $FechaFin)
    {
        $sql = 'SELECT 
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
        $con = App::$base;
        $Res = $con->Records($sql, $Filtro);
        return $Res;
    }

}
