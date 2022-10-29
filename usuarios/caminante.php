<?php
    /* Validación de una sesión */
    include("../sesion.php");
    /* Conexion a la base de datos */
    include("../conexion.php");
    /* Control del tipo de usuario */
    include("controlU.php");

    /* Asignación de variables */
    $movil="null";
    $funcion="caminante";
    $estado="null";
    $id = $_SESSION['id'];
    /* ----------------------- */

    /* Fijación de la zona horaria para trabajar con fechas */
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d H:i:s");
    /* ---------------------------------------------------- */

    /* 6) Inserción del presentismo en la base de datos  */
    $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) 
    values ('$id', NULL ,'$funcion','$fecha', NULL)";
    mysqli_query($conexion,$insert)
    or die("Problemas en el insert".mysqli_error($conexion));
    /* ------------------------------------------------- */

    /* Actualización del servicio del usuario en la base de datos (servicio -> si) */
    $update = "UPDATE policias SET servicio='si' WHERE policia_id='$id'";
    mysqli_query($conexion,$update)
    or die("Problemas en el update".mysqli_error($conexion));
    mysqli_close($conexion);
    /* ------------------------------------------------- */

    /* Alerta para indicar que el presente fue dado con exito */
    $var= "Su presente fue dado con exito";
    echo  "<script> alert('".$var."');</script>";
    echo  "<script> setTimeout( function() { window.location.href = 'index.php'; }, 10 );</script>"
?>