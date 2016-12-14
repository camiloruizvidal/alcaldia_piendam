<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelConfig
{

    public function VerValue($Name)
    {
        $sql = 'SELECT `config`.`value` FROM `config` WHERE `config`.`name` = ?';
        $con = App::$base;
        $Res = $con->Record($sql, array($Name));
        if (count($Res) > 0)
        {
            return $Res['value'];
        }
        else
        {
            return NULL;
        }
    }

}
