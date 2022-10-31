<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 21) Control del tipo de usuario */
    include("controlU.php");

    /* 48) Variable para recibir la funcion que va a llevar a cabo el usuario */
    $funcion = ($_REQUEST['funcion'])?$_REQUEST['funcion']:"";

    /* 49) Dependiendo la funcion del usuario , se lo envia a una página u otra */
    switch($funcion){
        case "caminante" :
            header("Location:caminante.php");
            break;
        case "movil" :
            header("Location:moviles.php");
            break;
        case "bicicleta" :
            header("Location:bicicletas.php");
            break;
        case "cuatriciclo" :
            header("Location:cuatriciclos.php");
            break;
    }
?>