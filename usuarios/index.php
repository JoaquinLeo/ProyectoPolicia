<?php
    include("../sesion.php");
    include("cabeceraU.php");
?>


    <p>Bienvenido <?php echo $_SESSION['usuario'] ?></p>

    <form method="POST" action="funcion.php">
        Seleccionar actividad: 
        <select name="funcion">
            <option value="movil">Movil</option>
            <option value="caminante">Caminante</option>
            <option value="bicicleta">Bicicleta</option>
            <option value="cuatriciclo">Cuatriciclo</option>
        </select>
        <br><input type="submit" value="seleccionar" name="selecionar"><br><br>
    </form>
         
</body>
</html>