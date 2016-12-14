<?php
@include_once '../../../model/modelUsuario.php';
@include_once '../../model/modelUsuario.php';

class controlusuario
{

    public function CerrarSession()
    {
        @session_start();
        $_SESSION = array();
        unset($_SESSION);
        $_SESSION = FALSE;
        header('Location: ./login');
    }

    public function UsuarioCorrecto($ArrayPerfilesUsuario)
    {
        $Datos = $this->VerUsuario();
        $Tipo  = ($Datos['descripcion_tipo']);
        $Res   = false;
        if (!in_array($Tipo, $ArrayPerfilesUsuario))
        {
            $this->CerrarSession();
        }
    }

    public function SessionActiva()
    {

        @session_start();
        if (count($_SESSION) === 0)
            return false;
        else
            return $_SESSION;
    }

    public function VerUsuario()
    {
        return $this->SessionActiva();
    }

    public function newusuario($nombre, $apellido, $documento, $telefono, $celular, $correo, $login, $pass, $id_usuario_tipo)
    {
        $user = new modelUsuario();
        $id   = $user->newusuario(trim($nombre), trim($apellido), trim($documento), trim($telefono), trim($celular), trim($correo), trim($login), md5(trim($pass)), $id_usuario_tipo);
        return $id;
    }

    public function findusuario($documento)
    {
        $user = new modelUsuario();
        return json_encode($user->findusuario($documento));
    }

}
