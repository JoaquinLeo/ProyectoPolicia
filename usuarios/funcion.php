<?php
    if ($_REQUEST['nivel_usuario']=="caminante")
    { 
        echo "Presentismo completado. Usted será caminante";
    } 
    elseif ($_REQUEST['nivel_usuario']=="movil")
    { 
        include("moviles.php");
    } 
?>