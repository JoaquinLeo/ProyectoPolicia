<?php
    include("../sesion.php");
    include("cabeceraU.php");
?>

    
    <form action="val_enf.php" method="POST" enctype="multipart/form-data">
        Ingrese su Usuario:
        <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly ><br>
        Ingrese su certificado:
        <input type="file" name="certificado" required><br>
        <input type="submit" value="Enviar" name="enviar"><br>
    </form>

</body>
</html>