<?php
    include("../sesion.php");

    if ($_REQUEST['nivel_usuario']=="caminante")
    { 
        header("Location:presentismo.php");
        
    } 
    elseif ($_REQUEST['nivel_usuario']=="movil")
    { 
        header("Location:moviles.php");
    } 
?>