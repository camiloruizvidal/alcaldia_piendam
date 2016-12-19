<?php

if (isset($_POST['cc']) && isset($_POST['mail']))
{

    function generaPass()
    {
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena         = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);

        //Se define la variable que va a contener la contraseña
        $pass         = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass = 10;

        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++)
        {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(0, $longitudCadena - 1);

            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

    function EnviarCorreo($id_usuario, $mail)
    {
        include_once '../../model/activerecords/conexion.php';
        include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';
        $user = atable::Make('usuario');
        $user->Load("id_usuario = {$id_usuario}");
        if (!is_null($user->id_usuario))
        {
            $md5        = generaPass();
            $user->pass = md5($md5);
            $user->Save();
            $para       = $mail;
            $titulo     = 'Cambio de contraseña';
            $mensaje    = '<h1>Su contraseña ha cambiado.</h1> <p>Para ingresar su nueva contraseña es:</p> <strong><i>' . $md5 . '</i></strong>';
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras  .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras  .= 'From: webmaster@solicitudes.solucionescrv.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($para, $titulo, $mensaje, $cabeceras);
        }
    }

    function Validar()
    {
        include_once '../../model/activerecords/conexion.php';
        include_once Config::$home_bin . Config::$ds . 'db' . Config::$ds . 'active_table.php';
        $sql = 'SELECT `usuario`.`id_usuario` FROM `usuario` WHERE `usuario`.`login` = ? AND `usuario`.`correo` = ?';
        $con = App::$base;
        $Res = $con->Record($sql, array($_POST['cc'], $_POST['mail']));
        if (count($Res) > 0)
        {
            EnviarCorreo($Res['id_usuario'], $_POST['mail']);
        }
    }

    Validar();
}
else
{
    echo '404';
}