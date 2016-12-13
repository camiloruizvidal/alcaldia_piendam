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
        <script src="js/source/login.js"></script>
        <style></style>
    </head>
    <body>
        <div class="container-fluid">
            <form id="form" class="login-form">
                <h1>CRV SSP</h1>
                <div class="form-group ">
                    <input type="text" class="form-control" placeholder="Numero de documento" id="UserName">
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group log-status">
                    <input type="password" class="form-control" placeholder="Contraseña" id="Passwod">
                    <i class="fa fa-lock"></i>
                </div>
                <span class="alert">Nombre de usuario o contraseña incorrecta</span>
                <a class="link" href="#">¿Olvidó su contraseña?</a>
                <button type="submit" class="log-btn" >Iniciar</button>    
            </form>
        </div>
    </body>
</html>
