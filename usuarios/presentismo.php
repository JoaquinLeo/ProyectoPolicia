<?php

    include("../sesion.php");
    include("../conexion.php");

    if(isset($_REQUEST['seleccionar']))
    {
        $movil = $_REQUEST['movil'];
        $funcion = $_REQUEST['funcion'];
        $estado = $_REQUEST['estado'];

    }
    
    else {
        $movil="null";
        $funcion="caminante";
        $estado="null";
    }
    

    
    $usuario = $_SESSION['usuario'];
    $legajo = $_SESSION['legajo'];
    $id = $_SESSION['id'];


    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d H:i:s");

    
    $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
        ('$id',$movil,'$funcion','$fecha', '$estado')";

    mysqli_query($conexion,$insert)
    or die("Problemas en el select".mysqli_error($conexion));
    mysqli_close($conexion);
    echo "Muchas gracias! Se presentismo fue correcto.";

?>