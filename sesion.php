<?php

    /* componente para comprobar que los usuarios tienen su sesion abierta */    
    session_start(); 
    /* error_reporting(0); */

    $varsession = $_SESSION['usuario'];
    
    if($varsession == null || $varsession == ""){
        /* si no tienen una sesion entonces se envia esta alerta */
        $var = "Usted no tiene autorizacion.";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = '../index.php'; }, 10 ); </script>";
        die();
        
    }
?>