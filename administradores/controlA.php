<?php
    /* 116) Control de usuario */
    if($_SESSION['nivel_usuario'] != "admin" && $_SESSION['nivel_usuario'] != "superadm"){
        $var = "Usted no tiene autorizacion";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = '../index.php'; }, 10 ); </script>";
    }
?>