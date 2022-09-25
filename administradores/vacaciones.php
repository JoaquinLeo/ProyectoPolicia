<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT vacaciones.vacaciones_id, policias.nombre , policias.apellido , policias.legajo, 
    vacaciones.fecha_inicio, vacaciones.fecha_fin , vacaciones.estado 
    FROM vacaciones INNER JOIN policias on vacaciones.policia_id = policias.policia_id";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    // CONDICION TERNARIA    ESTA ES LA CONDICION       SE CUMPLE           NO SE CUMPLE       
    $opcion =             (isset($_REQUEST['opcion']))?$_REQUEST['opcion']  :     "";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    switch($opcion){

        case "Aceptar" : 

            $sql2 = "UPDATE vacaciones SET estado='aceptado' WHERE vacaciones_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:vacaciones.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

        case "Rechazar" : 

            $sql2 = "UPDATE vacaciones SET estado='rechazado' WHERE vacaciones_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:vacaciones.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

        case "Borrar" : 

            $sql2 = "DELETE FROM vacaciones WHERE vacaciones_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:vacaciones.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
    }

    include("cabeceraA.php");

?>



    <table border="1">
        <caption>Vacaciones</caption>
        <tr>
            <td>Nombre</td> 
            <td>Apellido</td> 
            <td>Legajo</td> 
            <td>Fecha de Inicio</td> 
            <td>Fecha de Fin</td> 
            <td>Estado</td>
            <td>Opciones</td>
        </tr>
    <?php
        while ($mostrar = mysqli_fetch_array($rta))
        {
    ?>
        <tr>
            <td> <?php echo $mostrar['nombre'] ?> </td> 
            <td> <?php echo $mostrar['apellido'] ?> </td> 
            <td> <?php echo $mostrar['legajo'] ?> </td> 
            <td> <?php echo $mostrar['fecha_inicio'] ?> </td> 
            <td> <?php echo $mostrar['fecha_fin'] ?> </td> 
            <td> <?php echo $mostrar['estado'] ?> </td> 
            <td>
                <form method="POST">
                    <input type="hidden" name="id"  value="<?= $mostrar['vacaciones_id'] ?>">
                    <input type="submit" name="opcion" value="Aceptar">
                    <input type="submit" name="opcion" value="Rechazar">
                    <input type="submit" name="opcion" value="Borrar">
                </form>     
            </td>
        </tr>
    <?php    
        }
    ?>

    </table>

</body>
</html>