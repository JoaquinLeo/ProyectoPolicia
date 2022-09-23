<?php
    include("../sesion.php");
    if($_SESSION['nivel_usuario'] != "admin"){
        echo "usted no tiene autorizacion";

        ?>
        <br><a href="../index.php">Volver al Inicio</a>
        <?php
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

    <nav>
        <ul>
            <li><a href="index.php">Control</a></li>
            <li><a href="ingresantes.php">Ingresantes</a></li>
            <li><a href="vacaciones.php">Vacaciones</a></li>
            <li><a href="enfermedades.php">Enfermedades</a></li>
            <li><a href="vehiculos.php">Vehiculos</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>
    </nav>

    <h1>Sistema de Gestión Electrónico Policia BA</h1>

    <p>Bienvenido <?php echo $_SESSION['usuario'] ?></p>

</body>
</html>