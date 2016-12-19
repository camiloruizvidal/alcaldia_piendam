<?php
if (isset($_GET['cerrarsesion']))
{
    @session_start();
    $_SESSION = NULL;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel='stylesheet prefetch' href='./css/bootstrap/bootstrap.css'>
        <link rel='stylesheet prefetch' href='./css/bootstrap/bootstrap-theme.css'>
        <link rel="stylesheet" href="./css/source/login.css">
        <script src='js/jquery/jquery.js'></script>
        <script src="js/source/plantilla_admin.js"></script>
        <link rel="stylesheet" href="http://codeseven.github.io/toastr/build/toastr.min.css">
        <script src="http://codeseven.github.io/toastr/build/toastr.min.js"></script>
        <script src="js/source/relogin.js"></script>
        <style></style>
    </head>
    <body>
        <div class="container-fluid">
            <form id="form" class="login-form">
                <center><a href="http://piendamo-cauca.gov.co/Paginas/default.aspx" target="_blank"><img src="img/Piendamo-Tunia-Foot.png"></a></center>
                <div class="form-group ">
                    <input type="text" class="form-control" required="true" placeholder="Numero de documento" name="cc" id="cc">
                </div>
                <div class="form-group ">
                    <input type="text" class="form-control" required="true" placeholder="Correo electrónico" name="mail" id="mail">
                    <i>Si usted ha cambiado la contraseña el sistema le exijio un correo de validación.</i>
                </div>
                <button type="submit" class="log-btn" >Validar</button> 
            </form>
        </div>
    </body>
</html>