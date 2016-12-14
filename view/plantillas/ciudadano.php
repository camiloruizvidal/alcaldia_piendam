<?php
include '../../../controller/controlusuario.php';
$Validar = new controlusuario();
$Validar->UsuarioCorrecto(array('Solicitantes'));
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><#--titulo--#></title>
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/jquery/jquery-ui.min.css">
        <link rel="stylesheet" href="css/jquery/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="css/source/plantilla_admin.css">
        <#--css--#>
        <script type="text/javascript" src="js/jquery/jquery.js"></script>
        <script type="text/javascript" src="js/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/source/plantilla_admin.js"></script>
        <script type="text/javascript" src="js/source/functions.js"></script>
        <#--js--#>
        <style>body {
                min-height: 2000px;
                padding-top: 70px;
            }</style>
    </head>

    <body>
        <!-- Fixed navbar -->
        <?php
        include_once '../../plantillas/menu/ciudadano.php';
        ?>
        <div class="container-fluid">
            
               <#--contenido--#>
        </div>
    </body>
</html>
