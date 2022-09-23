<?php

    include("../sesion.php");
    include("../conexion.php");

    $movil="null";
    $funcion="caminante";
    $estado="null";
    $id = $_SESSION['id'];

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d H:i:s");

    
    $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
        ('$id', NULL ,'$funcion','$fecha', NULL)";

    mysqli_query($conexion,$insert)
    or die("Problemas en el select".mysqli_error($conexion));
    mysqli_close($conexion);
    ?>
            <script type="text/javascript">
                alert("Muchas gracias! Se presentismo fue correcto.");
            </script>
            <a href="index.php">Volver al inicio</a>
    <?php  
?>