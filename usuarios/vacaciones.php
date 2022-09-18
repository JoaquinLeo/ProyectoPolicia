<?php
    include("../sesion.php");
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
        <ul>
            <li><a href="index.php">Presentismo</a></li> 
            <li><a href="enfermedad.php">Enfermedad</a></li>
            <li><a href="vacaciones.php">Vacaciones</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>

        <h1>Sistema de Gestión Electrónico Policia BA</h1>

        <form action="val_vac.php" method="POST">
            Ingrese su Usuario:
            <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly><br>
            Ingrese su fecha de inicio:
            <input type="date" name="finicio" required><br>
            Ingrese su fecha de fin:
            <input type="date" name="ffin" required><br>
            <input type="submit" value="Enviar" name="enviar"><br>  
        </form>

</body>
</html>