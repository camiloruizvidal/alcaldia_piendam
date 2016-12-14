<?php
@session_start();

if (isset($_GET['cerrarsesion']))
{
    $_SESSION = array();
    session_destroy();
    exit();
}
$url = './login';
if (isset($_SESSION['id_usuario']))
{
    $url = $_SESSION['url'];
}
?>
<html>
    <head>
        <?php
        echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . $url . '">'
        ?>
    </head>
    <body>
    </body>
</html>