<?php

@include_once '../../../model/modelUsuario.php';
@include_once '../../model/modelUsuario.php';

class controlusuario
{

    public function ActualizarUsuario($update_id_usuario, $update_nombre, $update_apellido, $update_documento, $update_telefono, $update_celular, $update_correo, $update_id_usuario_tipo)
    {
        $user = new modelUsuario();
        $user->ActualizarUsuario($update_id_usuario, $update_nombre, $update_apellido, $update_documento, $update_telefono, $update_celular, $update_correo, $update_id_usuario_tipo);
    }

    public function VerTiposUsuarios()
    {
        $user = new modelUsuario();
        $Data = $user->VerTiposUsuarios();
        return $Data;
    }

    public function VerUsuarioId($id)
    {
        $user = new modelUsuario();
        $Data = $user->VerUsuarioId($id);
        return $Data;
    }

    public function VerUsuariosSistema()
    {
        $user = new modelUsuario();
        $Data = $user->VerUsuariosSistema();
        return $Data;
    }

    public function CerrarSession()
    {
        @session_start();
        $_SESSION = array();
        unset($_SESSION);
        $_SESSION = FALSE;
        header('Location: ./login');
    }

    public function CambiarDatosUsuario($telefono, $celular, $correo, $login, $pass)
    {
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $user       = new modelUsuario();
        $pass       = md5($pass);
        return $user->CambiarDatosUsuario($id_usuario, $telefono, $celular, $correo, $login, $pass);
    }

    public function CambiarDatosUsuarioNoPass($telefono, $celular, $correo, $login)
    {
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $user       = new modelUsuario();
        return $user->CambiarDatosUsuarioNoPass($id_usuario, $telefono, $celular, $correo, $login);
    }

    public function SiValidarDatosUsuario($login, $password)
    {
        @session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $user       = new modelUsuario();
        $data       = $user->ValidarSesion($login, $password);
        if (count($data) > 0)
        {
            if ($data['id_usuario'] === $id_usuario)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
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
