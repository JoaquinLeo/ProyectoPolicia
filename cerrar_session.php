<?php
    session_start();
    error_reporting(0);
    $varsession = $_SESSION['usuario'];
    if($varsession == null || $varsession == ""){
        echo "usted no tiene autorizacion";
        die();
    }
    session_destroy();
    header("location:index.php");
?>