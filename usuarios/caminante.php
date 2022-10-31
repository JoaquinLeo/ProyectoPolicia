<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 21) Control del tipo de usuario */
    include("controlU.php");

    /* 48) Asignación de variables */
    $movil="null";
    $funcion="caminante";
    $estado="null";
    $id = $_SESSION['id'];
    /* ----------------------- */

    /* 49) Fijación de la zona horaria para trabajar con fechas */
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d H:i:s");
    /* ---------------------------------------------------- */

    /* 50) Inserción del presentismo en la base de datos  */
    $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) 
    values ('$id', NULL ,'$funcion','$fecha', NULL)";
    mysqli_query($conexion,$insert)
    or die("Problemas en el insert".mysqli_error($conexion));
    /* ------------------------------------------------- */

    /* 51) Actualización del servicio del usuario en la base de datos (servicio -> si) */
    $update = "UPDATE policias SET servicio='si' WHERE policia_id='$id'";
    mysqli_query($conexion,$update)
    or die("Problemas en el update".mysqli_error($conexion));
    /* ------------------------------------------------- */
    mysqli_close($conexion);
    /* 52) Alerta para indicar que el presente fue dado con exito */
    $var= "Su presente fue dado con exito";
    echo  "<script> alert('".$var."');</script>";
    echo  "<script> setTimeout( function() { window.location.href = 'index.php'; }, 10 );</script>"
?>