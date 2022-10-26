<?php
    include("../sesion.php");
    include("cabeceraU.php");

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");

?>

        <form action="val_vac.php" method="POST">
            Ingrese su Usuario:
            <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly><br>
            Ingrese su fecha de inicio:
            <input class="form-control w-25" type="date" min="<?=$fecha?>" name="finicio" required><br>
            Ingrese su fecha de fin:
            <input class="form-control w-25" type="date" min="<?=$fecha?>" name="ffin" required><br>
            <input type="submit" value="Enviar" name="enviar"><br>  
        </form>

</body>
</html>