<?php
    include("../sesion.php");
    include("cabeceraU.php");
?>


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