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

<div class="container mt-4" style="max-width: 800px">
    <div class="card border border-dark border-3 rounded" >
        <div class="card-header">
        </div>
        <div class="card-body">
            <form method="POST" action="funcion.php">
                <p class="fs-6 fw-semibold mb-1">Seleccionar:</p> 
                <select class="form-select w-50 mb-4" name="funcion">
                    <option value="movil">Moviles</option>
                    <option value="caminante">Caminante</option>
                    <option value="bicicleta">Bicicletas</option>
                    <option value="cuatriciclo">Cuatriciclos</option>
                </select>
                <input class="btn btn-primary" type="submit" value="siguiente" name="selecionar"
                <?php echo ($mostrar['servicio']=="si")?"disabled":"";  ?> >
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>   
</div>
</body>
</html>