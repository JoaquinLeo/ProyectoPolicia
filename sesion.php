<?php
    session_start(); 
    /*error_reporting(0);*/
    $varsession = $_SESSION['usuario'];
    
    if($varsession == null || $varsession == ""){
        echo "usted no tiene autorizacion";
        /*header("Location: ../index.php");*/
        ?>
        <br><a href="../index.php">Volver al Inicio</a>
        <?php
        die();
    }
?>