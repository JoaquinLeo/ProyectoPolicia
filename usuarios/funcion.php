<?php
    /* Validación de una sesión */
    include("../sesion.php");
    /* Control del tipo de usuario */
    include("controlU.php");


    /* Variable para recibir la funcion que va a llevar a cabo el usuario */
    $funcion = ($_REQUEST['funcion'])?$_REQUEST['funcion']:"";

    /* Dependiendo la funcion del usuario , se lo envia a una página u otra */
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