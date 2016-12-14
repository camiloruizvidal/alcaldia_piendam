<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Solicitudes</a></li>
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
        </div><!--/.nav-collapse -->
    </div>
</nav>