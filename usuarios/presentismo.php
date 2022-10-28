<?php
    include("../sesion.php");
    include("../conexion.php");
    

    $id= $_SESSION["id"];
    $sql = "SELECT servicio FROM policias WHERE policia_id='$id'";
    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));
    $mostrar = mysqli_fetch_array($rta);
    /* <?php echo ($mostrar['servicio']=="si")?"disabled":""; ?> */

    include("cabeceraU.php");
?>

    <form method="POST" action="funcion.php">
        <h3>Presentismo</h3>        
        Seleccionar: 
        <select name="funcion">
            <option value="movil">Moviles</option>
            <option value="caminante">Caminante</option>
            <option value="bicicleta">Bicicletas</option>
            <option value="cuatriciclo">Cuatriciclos</option>
        </select>
        <br><input type="submit" value="siguiente" name="selecionar"
        <?php echo ($mostrar['servicio']=="si")?"disabled":"";  ?> ><br><br>

    </form>
  
</body>
</html>