<?php
    if($_SESSION['nivel_usuario'] != "admin"){
        $var = "Usted no tiene autorizacion";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = '../index.php'; }, 10 ); </script>";
    }
?>