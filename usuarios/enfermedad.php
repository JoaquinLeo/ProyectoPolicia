<?php
    include("../sesion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enfermedad</title>
</head>
<body>

    <h1>Sistema de Gestión Electrónico Policia BA</h1> 
    
    <nav>   
          <ul>
              <li><a href="index.php">Presentismo</a></li> 
              <li><a href="enfermedad.php">Enfermedad</a></li>
              <li><a href="vacaciones.php">Vacaciones</a></li>
              <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
          </ul>
    </nav>
    
    <form action="val_enf.php" method="POST" enctype="multipart/form-data">
        Ingrese su Usuario:
        <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly ><br>
        Ingrese su certificado:
        <input type="file" name="certificado" required><br>
        <input type="submit" value="Enviar" name="enviar"><br>
    </form>

</body>
</html>