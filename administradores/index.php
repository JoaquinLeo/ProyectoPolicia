<?php
    session_start();
    error_reporting(0);
    $varsession = $_SESSION['usuario'];
    if($varsession == null || $varsession == ""){
        echo "usted no tiene autorizacion";
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Bienvenido a la pagina de administradores
    </h1>
    <nav>
        <ul>
            <li><a href="#">Contacto</a></li>
            <li><a href="ingresantes.php">Ingresantes</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</body>
</html>