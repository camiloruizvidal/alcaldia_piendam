<?php
include '../../../controller/controlusuario.php';
$Validar = new controlusuario();
$Validar->UsuarioCorrecto(array('Encargado'));
?><html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><#--titulo--#></title>
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
        <#--active--#>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li id="id_peticiones"><a href="nueva_peticion">Peticiones</a></li>
                        <ul class="nav navbar-nav navbar-right">
                            <li  id="id_informe">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Informes<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="informes_peticion"> Peticiones mas hechas </a></li>
                                    <li><a href="informes_can_acep"> peticiones mas aceptada y canceladas</a></li>
                                    <li><a href="informes_rangos"> rango de respuesta</a></li>
                                </ul>
                            </li>
                            <li id="id_configuracion"><a href="sistema"> Configuracion</a></li>
                        </ul>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">                  
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php
                                @session_start();
                                echo strtoupper($_SESSION['nombre']) . ' ' . strtoupper($_SESSION['apellido']);
                                ?> <i class="glyphicon glyphicon-user"></i><span class="caret"></span></a>                            
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> configurar</a></li>
                                <li><a href="logout"><i class="glyphicon glyphicon-off"></i> Cerrar sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid" id="contenido">
            <#--contenido--#>
        </div> 
    </body>
</html>