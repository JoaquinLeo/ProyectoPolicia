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

    <nav>
          <ul>
              <li><a href="enfermedad.php">Enfermedad</a></li>
              <li><a href="contacto.html">Vacaciones</a></li>
              <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
          </ul>
    </nav>


    <h1>Sistema de Gestión Electrónico Policia BA</h1>
    <form action="funcion.php" method="POST">
        Seleccionar funcion: 
        <select name="nivel_usuario">
            <option value="movil">Movil</option>
            <option value="caminante">Caminante</option>
        </select>
        <br><input type="submit" value="seleccionar" name="selecionar"><br><br>
    </form>
         
</body>
</html>