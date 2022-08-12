<?php

    include("../sesion.php");

    if ($_REQUEST['nivel_usuario']=="caminante")
    { 
        header("Location:presentismo.php");
        echo "Presentismo completado. Usted será caminante";
    } 
    elseif ($_REQUEST['nivel_usuario']=="movil")
    { 
        header("Location:moviles.php");
    } 
?>