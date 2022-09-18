<?php
    include("../sesion.php");

    $funcion = ($_REQUEST['funcion'])?$_REQUEST['funcion']:"";


    switch($funcion){
        case "movil" :
            header("Location:moviles.php");
            break;
        case "caminante" :
            header("Location:presentismo.php");
            break;
        case "bicicleta" :
            header("Location:bicicleta.php");
            break;
        case "cuatriciclo" :
            header("Location:cuatriciclo.php");
            break;
    }

?>