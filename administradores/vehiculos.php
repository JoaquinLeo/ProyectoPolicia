<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT movil_id , nro_serie ,tipo_movil , estado , posesion FROM moviles WHERE estado <>'borrado' ";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    $numero=1;

    // CONDICION TERNARIA    ESTA ES LA CONDICION       SE CUMPLE           NO SE CUMPLE       
    $opcion =             (isset($_REQUEST['opcion']))?$_REQUEST['opcion']  :     "";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    switch($opcion){

        case "Borrar" : 

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fecha = date("Y-m-d H:i:s");

            $sql2 = "UPDATE moviles SET estado='borrado' , fecha_borrado='$fecha' WHERE movil_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:vehiculos.php");
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
            <li><a href="index.php">Control</a></li>
            <li><a href="ingresantes.php">Ingresantes</a></li>
            <li><a href="vacaciones.php">Vacaciones</a></li>
            <li><a href="enfermedades.php">Enfermedades</a></li>
            <li><a href="vehiculos.php">Vehiculos</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>
    </nav>

    <h1>Sistema de Gestión Electrónico Policia BA</h1>

    <table border="1">
        <caption>Moviles</caption>
        <tr>
            <td>Numero</td> 
            <td>Numero de Serie</td> 
            <td>Tipo de Movil</td> 
            <td>Estado</td> 
            <td>Posesion</td> 
            <td>Opciones</td>
        </tr>
    <?php
        while ($mostrar = mysqli_fetch_array($rta))
        {
    ?>
        <tr>
            <td> <?php echo $numero ?> </td> 
            <td> <?php echo $mostrar['nro_serie'] ?> </td> 
            <td> <?php echo $mostrar['tipo_movil'] ?> </td> 
            <td> <?php echo $mostrar['estado'] ?> </td> 
            <td> <?php echo $mostrar['posesion'] ?> </td> 
            <td>
                <form method="POST">
                    <input type="hidden" name="id"  value="<?= $mostrar['movil_id'] ?>">
                    <input type="submit" name="opcion" value="Editar">
                    <input type="submit" name="opcion" value="Borrar">
                </form>     
            </td>
        </tr>
    <?php    
        $numero++;
        }
    ?>

    </table>

</body>
</html>