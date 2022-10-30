<?php

    /* 16) Componente para comprobar que los usuarios tienen su sesion abierta */    
    session_start(); 

    $varsession = $_SESSION['usuario'];
    
    if($varsession == null || $varsession == ""){
        /* 17) Si no tienen una sesion entonces se envia esta alerta */
        $var = "Usted no tiene autorizacion.";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = '../index.php'; }, 10 ); </script>";
        die();
        
    }
?>