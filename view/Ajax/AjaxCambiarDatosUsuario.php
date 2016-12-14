<?php

include_once '../../controller/controlusuario.php';
$user         = new controlusuario();
//$user->CambiarDatosUsuario();
extract($_POST);
$SiValidaPass = $user->SiValidarDatosUsuario($login, $pass_old);
if ($SiValidaPass)
{

    if ($pass === $pass2)
    {
        if ($pass != '' && $pass2 != '')
        {
            $SiGuardo = $user->CambiarDatosUsuario($telefono, $celular, $correo, $login, $pass);
            if ($SiGuardo)
            {
                echo json_encode(array('SiValida' => TRUE, 'msj' => 'Cambios realizados con éxito'));
            }
            else
            {
                echo json_encode(array('SiValida' => FALSE, 'msj' => 'Error inexperado. Por favor contacte al administrador'));
            }
        }
        else
        {
            $SiGuardo = $user->CambiarDatosUsuarioNoPass($telefono, $celular, $correo, $login);
            if ($SiGuardo)
            {
                echo json_encode(array('SiValida' => TRUE, 'msj' => 'Cambios realizados con éxito'));
            }
            else
            {
                echo json_encode(array('SiValida' => FALSE, 'msj' => 'Error inexperado. Por favor contacte al administrador'));
            }
        }
    }
    else
    {
        echo json_encode(array('SiValida' => FALSE, 'msj' => 'Las contraseñas no coinciden'));
    }
}
else
{
    echo json_encode(array('SiValida' => FALSE, 'msj' => 'Login o contraseña incorrecta'));
}