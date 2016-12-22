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

    public function NewValue($name, $value)
    {
        
    }

    public function EditValue($name, $values)
    {
        $value        = atable::Make('config');
        $value->Load("name = '{$name}'");
        $value->name  = $name;
        $value->value = $values;
        $value->Save();
    }

}
