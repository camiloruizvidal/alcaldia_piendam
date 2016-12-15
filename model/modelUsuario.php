<?php

include_once 'activerecords/conexion.php';
include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';

class modelUsuario
{

    private $Log;

    public function ActualizarUsuario($id_usuario, $nombre, $apellido, $documento, $telefono, $celular, $correo, $id_usuario_tipo)
    {
        $usuario = atable::Make('usuario');
        $usuario->Load("id_usuario={$id_usuario}");
        if (!is_null($usuario->id_usuario))
        {
            $usuario->nombre          = $nombre;
            $usuario->apellido        = $apellido;
            $usuario->documento       = $documento;
            $usuario->telefono        = $telefono;
            $usuario->celular         = $celular;
            $usuario->correo          = $correo;
            $usuario->id_usuario_tipo = $id_usuario_tipo;
            $usuario->Save();
        }
    }

    public function __construct()
    {
        include_once '../../controller/controlLog.php';
        $this->Log = new controlLog();
    }

    public function VerTiposUsuarios()
    {
        $sql = 'SELECT 
                    `usuario_tipo`.`id_usuario_tipo`,
                    `usuario_tipo`.`descripcion`
                FROM
                    `usuario_tipo`
                ORDER BY 2';
        $con = App::$base;
        $Res = $con->Records($sql, array());
        return $Res;
    }

    public function VerUsuarioId($id)
    {
        $sql = 'SELECT 
                    `usuario`.`id_usuario`,
                    `usuario`.`nombre`,
                    `usuario`.`apellido`,
                    `usuario`.`documento`,
                    `usuario`.`telefono`,
                    `usuario`.`celular`,
                    `usuario`.`correo`,
                    `usuario_tipo`.`descripcion` AS `tipo_usuario`,
                    `usuario`.`id_usuario_tipo`,
                    `dependencia_encargado`.`id_dependencia`
                FROM
                    `usuario`
                    INNER JOIN `usuario_tipo` ON (`usuario`.`id_usuario_tipo` = `usuario_tipo`.`id_usuario_tipo`)
                    LEFT OUTER JOIN `dependencia_encargado` ON (`usuario`.`id_usuario` = `dependencia_encargado`.`id_usuario_encargado`)
                WHERE
                    `usuario`.`id_usuario`=?';
        $con = App::$base;
        $Res = $con->Record($sql, array($id));
        return $Res;
    }

    public function VerUsuariosSistema()
    {
        $sql = 'SELECT 
                    `usuario`.`id_usuario`,
                    CONCAT_WS(\' \', `usuario`.`nombre`, `usuario`.`apellido`) AS `usuarios`,
                    `usuario`.`documento`,
                    `usuario`.`telefono`,
                    `usuario`.`celular`,
                    `usuario`.`correo`,
                    `usuario_tipo`.`descripcion` AS `tipo_usuario`
                FROM
                    `usuario`
                    INNER JOIN `usuario_tipo` ON (`usuario`.`id_usuario_tipo` = `usuario_tipo`.`id_usuario_tipo`)
                    ORDER BY 2';
        $con = App::$base;
        $Res = $con->Records($sql, array());
        return $Res;
    }

    public function CambiarDatosUsuarioNoPass($id_usuario, $telefono, $celular, $correo, $login)
    {
        $usuario = atable::Make('usuario');
        $usuario->Load("id_usuario = {$id_usuario} and login = {$login}");
        if (!is_null($usuario->id_usuario))
        {
            $data_before       = $usuario->_original;
            $usuario->correo   = $correo;
            $usuario->celular  = $celular;
            $usuario->telefono = $telefono;
            $usuario->Save();
            $this->Log->update($usuario->_table, $usuario->_original, $data_before);
            return TRUE;
        }
        return FALSE;
    }

    public function CambiarDatosUsuario($id_usuario, $telefono, $celular, $correo, $login, $pass)
    {
        $usuario = atable::Make('usuario');
        $usuario->Load("id_usuario = {$id_usuario} and login = {$login}");
        if (!is_null($usuario->id_usuario))
        {
            $data_before       = $usuario->_original;
            $usuario->pass     = $pass;
            $usuario->correo   = $correo;
            $usuario->celular  = $celular;
            $usuario->telefono = $telefono;
            $usuario->Save();
            $this->Log->update($usuario->_table, $usuario->_original, $data_before);
            return TRUE;
        }
        return FALSE;
    }

    public function newusuario($nombre, $apellido, $documento, $telefono, $celular, $correo, $login = '', $pass = '', $id_usuario_tipo = '')
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
        $usuario->estado    = 1;
        if ($id_usuario_tipo != '')
        {
            $usuario->id_usuario_tipo = $id_usuario_tipo;
        }
        $this->Log->Insert($usuario->_table, $usuario->_original);
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
                    UPPER(`usuario`.`login`)=UPPER(?) AND `usuario`.`pass`=MD5(?)
                    AND 
                    `usuario`.`estado`=1';
        $con = App::$base;
        $Res = $con->Record($sql, array($login, $password));
        return $Res;
    }

}
