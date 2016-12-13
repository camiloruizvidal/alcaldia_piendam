<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelUsuario
{

    public function newusuario($nombre, $apellido, $documento, $telefono, $celular, $correo, $login='', $pass='', $id_usuario_tipo='')
    {
        $usuario = atable::Make('usuario');
        $usuario->Load("documento = {$documento}");
        if (is_null($usuario->id_usuario))
        {
            $usuario->login = $login;
            $usuario->pass  = $pass;
        }
        $usuario->nombre    = $nombre;
        $usuario->apellido  = $apellido;
        $usuario->documento = $documento;
        $usuario->correo    = $correo;
        $usuario->celular   = $celular;
        $usuario->telefono  = $telefono;
        if ($id_usuario_tipo != '')
        {
            $usuario->id_usuario_tipo = $id_usuario_tipo;
        }
        $usuario->Save();
        return $usuario->id_usuario;
    }

    public function findusuario($documento)
    {
        $sql = 'SELECT 
                `usuario`.`nombre`,
                `usuario`.`apellido`,
                `usuario`.`documento`,
                `usuario`.`telefono`,
                `usuario`.`celular`,
                `usuario`.`correo`
            FROM
                `usuario`
            WHERE
                `usuario`.`documento`=?';
        $con = App::$base;
        $Res = $con->Record($sql, array($documento));
        return $Res;
    }

    public function ValidarSesion($login, $password)
    {
        $sql = 'SELECT 
                    `usuario`.`id_usuario`,
                    `usuario`.`nombre`,
                    `usuario`.`apellido`,
                    `usuario`.`documento`,
                    `usuario`.`telefono`,
                    `usuario`.`celular`,
                    `usuario`.`correo`,
                    `usuario`.`login`,
                    `usuario_tipo`.`id_usuario_tipo`,
                    `usuario_tipo`.`descripcion` AS `descripcion_tipo`,
                    `usuario_tipo`.`permisos`,
                    `dependencia_encargado`.`id_dependencia`
                FROM
                    `usuario`
                    LEFT OUTER JOIN `usuario_tipo` ON (`usuario`.`id_usuario_tipo` = `usuario_tipo`.`id_usuario_tipo`)
                    LEFT OUTER JOIN `dependencia_encargado` ON (`usuario`.`id_usuario` = `dependencia_encargado`.`id_usuario_encargado`)
                WHERE
                    UPPER(`usuario`.`login`)=UPPER(?) AND `usuario`.`pass`=MD5(?)';
        $con = App::$base;
        $Res = $con->Record($sql, array($login, $password));
        return $Res;
    }

}
