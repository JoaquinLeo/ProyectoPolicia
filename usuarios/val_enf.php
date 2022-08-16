<?php
    include("../sesion.php");
    include("../conexion.php");

    
    $id = $_SESSION['id'];

    $nombre = $_REQUEST['usuario'];
    $legajo = $_SESSION['legajo'];
    $imagen = addslashes(file_get_contents($_FILES['certificado']['tmp_name']));

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d H:i:s");

    
    $sql2 = "INSERT INTO enfermedad (policia_id,fecha,certificado) values ('$id','$fecha','$imagen')";

    $querry= mysqli_query($conexion,$sql2) or
    die("Problemas en el select:".mysqli_error($conexion));

    if($querry){
        echo "Se insertó correctamente";
    }
    else{
        echo "No se insertó correctamente";
    }
?>