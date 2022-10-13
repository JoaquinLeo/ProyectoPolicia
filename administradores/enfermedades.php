<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT enfermedad.enfermedad_id, policias.nombre , policias.apellido , policias.legajo, 
    enfermedad.fecha, enfermedad.certificado
    FROM enfermedad INNER JOIN policias on enfermedad.policia_id = policias.policia_id";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    include("cabeceraA.php");

?>

    <table border="1">
        <caption>Enfermedades</caption>
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
            <td><img src="data:image/jpg;base64,  <?php echo base64_encode($mostrar['certificado']) ?>" height="150px;" width="150px;"/> </td> 
        </tr>
    <?php    
        }
    ?>

    </table>

</body>
</html>