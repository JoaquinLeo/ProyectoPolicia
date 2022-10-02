<?php
    
    include("../sesion.php");
    include("../conexion.php");

    $id = $_SESSION['id'];

    $nombre = $_REQUEST['usuario'];
    $finicio = $_REQUEST['finicio'];
    $ffin = $_REQUEST['ffin'];
    $estado = 'espera';

    

    $sql = "INSERT INTO vacaciones (policia_id,fecha_inicio,fecha_fin,estado) values ('$id','$finicio','$ffin','$estado')";
    
    $querry= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    if($querry){
        echo "Se insertó correctamente";
    }
    else{
        echo "No se insertó correctamente";
    }





?>