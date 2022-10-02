<?php
    include("../sesion.php");

    $funcion = ($_REQUEST['funcion'])?$_REQUEST['funcion']:"";


    switch($funcion){
        case "movil" :
            header("Location:moviles.php");
            break;
        case "caminante" :
            header("Location:caminante.php");
            break;
        case "bicicleta" :
            header("Location:bicicletas.php");
            break;
        case "cuatriciclo" :
            header("Location:cuatriciclos.php");
            break;
    }

?>