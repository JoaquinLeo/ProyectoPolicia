<?php
    /* componente para cerrar la session creada */
    include("sesion.php");
    session_destroy();
    header("location:index.php");
?>