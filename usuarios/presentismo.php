<?php

    if(isset($_REQUEST['seleccionar']))
    {
        $movil = $_REQUEST['movil'];
        $funcion=$_REQUEST['funcion'];
    }
    
    else {
        $movil="null";
        $funcion="caminante";
    }
    

    include("../sesion.php");
    include("../conexion.php");
    $usuario = $_SESSION['usuario'];
    $legajo = $_SESSION['legajo'];
    $sql="SELECT policia_id FROM policias where nombre='$usuario' and legajo='$legajo'";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    $reg=mysqli_fetch_array($rta);

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d H:i:s");

    
    $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
        ('$reg[policia_id]',$movil,'$funcion','$fecha','bueno')";

    mysqli_query($conexion,$insert)
    or die("Problemas en el select".mysqli_error($conexion));
    mysqli_close($conexion);
    echo "Muchas gracias! Se presentismo fue correcto.";

?>