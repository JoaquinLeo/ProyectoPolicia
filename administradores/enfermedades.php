<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT enfermedad.enfermedad_id, policias.nombre , policias.apellido , policias.legajo, 
    enfermedad.fecha, enfermedad.certificado
    FROM enfermedad INNER JOIN policias on enfermedad.policia_id = policias.policia_id";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

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
            <li><a href="#">Control</a></li>
            <li><a href="ingresantes.php">Ingresantes</a></li>
            <li><a href="vacaciones.php">Vacaciones</a></li>
            <li><a href="enfermedades.php">Enfermedades</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>
    </nav>

    <h1>
        Seccion de enfermedades
    </h1>

    <table border="1">
        <caption>Vacaciones</caption>
        <tr>
            <td>Nombre</td> 
            <td>Apellido</td> 
            <td>Legajo</td> 
            <td>Fecha</td> 
            <td>Certificado</td> 
        </tr>
    <?php
        while ($mostrar = mysqli_fetch_array($rta))
        {
    ?>
        <tr>
            <td> <?php echo $mostrar['nombre'] ?> </td> 
            <td> <?php echo $mostrar['apellido'] ?> </td> 
            <td> <?php echo $mostrar['legajo'] ?> </td> 
            <td> <?php echo $mostrar['fecha'] ?> </td> 
            <td><img src="data:image/jpg;base64,  <?php echo base64_encode($mostrar['certificado']) ?>" height="50px;" width="50px;"/> </td> 
        </tr>
    <?php    
        }
    ?>

    </table>

</body>
</html>