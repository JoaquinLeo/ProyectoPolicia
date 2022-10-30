<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 21) Control del tipo de usuario */
    include("controlU.php");

    /* 22) Consulta a la base de datos para saber si el usuario se encuenta en servicio o no */
    $id= $_SESSION["id"];
    $sql = "SELECT servicio FROM policias WHERE policia_id='$id'";
    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));
    $mostrar = mysqli_fetch_array($rta); 
    /* ------------------------------------------------------   */

    /* 23) Condición para saber si envió el formulario */
    if(isset($_REQUEST["servicio"])){

        /* 24) Actualización en la base de datos (servicio -> no) */
        $update = "UPDATE policias SET servicio='no' WHERE policia_id='$id'";
        mysqli_query($conexion,$update)
        or die("Problemas en el update".mysqli_error($conexion));
        /* ------------------------------------------------------ */

        /* 25) Consulta a la base de datos para saber que vehiculo estaba utilizando el usuario 
        y con que función */
        $sql2 = "SELECT policia_id,policia_movil.movil_id, funcion , posesion FROM policia_movil 
        INNER JOIN moviles on policia_movil.movil_id = moviles.movil_id
        WHERE policia_id ='$id'";
        $rta2 = mysqli_query($conexion,$sql2) or 
        die("Problemas en el select:".mysqli_error($conexion));
        $mostrar2 = mysqli_fetch_array($rta2);
        /* ------------------------------------------------------------------------   */

        /* 26)
        posesion 0 = vehiculo libre
        posesion 1 = vehiculo ocupado por el chofer
        posesion 2 = vehiculo ocupado por el acompañante
        posesion 3 = vehiculo ocupado totalmente 
        */

        /* 27) Condición para saber si el vehiculo esta ocupado totalmente  */
        if($mostrar2['posesion']==3){

            /* 28) Vehiculo liberado por el acompañante  */
            if($mostrar2['funcion']=="acompañante"){
                /* 29) Desvinculación de la relacion policia-vehiculo  */    
                $movil_id = $mostrar2['movil_id'];
                $update2 = "UPDATE policia_movil SET movil_id = null , funcion= null WHERE policia_id='$id'";
                mysqli_query($conexion,$update2)
                or die("Problemas en el update".mysqli_error($conexion));
                /* --------------------------------------------------------------------------------- */

                /* 30) Al vehiculo en cuestion se lo actualiza con un 1 indicando que solo tiene chofer  */ 
                $update3 = "UPDATE moviles SET posesion = 1 WHERE movil_id='$movil_id'";
                mysqli_query($conexion,$update3)
                or die("Problemas en el update".mysqli_error($conexion));
                /* --------------------------------------------------------------------------------- */
            }
                /* 31) Vehiculo liberado por el chofer */
            else{
                /* 32) Desvinculación de la relacion policia-vehiculo  */    
                $movil_id = $mostrar2['movil_id'];
                $update2 = "UPDATE policia_movil SET movil_id = null , funcion= null WHERE policia_id='$id'";
                mysqli_query($conexion,$update2)
                or die("Problemas en el update".mysqli_error($conexion));
                /* --------------------------------------------------------------------------------- */

                /* 33) Al vehiculo en cuestion se lo actualiza con un 2 indicando que solo tiene acompañante  */ 
                $update3 = "UPDATE moviles SET posesion = 2 WHERE movil_id='$movil_id'";
                mysqli_query($conexion,$update3)
                or die("Problemas en el update".mysqli_error($conexion));
                /* --------------------------------------------------------------------------------- */
            }
        }
        /* 34) El vehiculo no esta ocupado totalmente (solo por un usuario) */
        else{
                /* 35) Desvinculación de la relacion policia-vehiculo  */
                $movil_id = $mostrar2['movil_id'];
                $update2 = "UPDATE policia_movil SET movil_id = null , funcion= null WHERE policia_id='$id'";
                mysqli_query($conexion,$update2)
                or die("Problemas en el update".mysqli_error($conexion));
                /* --------------------------------------------------------------------------------- */

                /* 36) Al vehiculo en cuestion se lo actualiza con un 0 indicando que se encuentra vacio  */ 
                $update3 = "UPDATE moviles SET posesion = 0 WHERE movil_id='$movil_id'";
                mysqli_query($conexion,$update3)
                or die("Problemas en el update".mysqli_error($conexion));
                /* --------------------------------------------------------------------------------- */
        }
        
        /* 37) Alerta para indicar que el usuario ya no se encuentra en servicio */
        $var = "Usted ha salido de servicio con exito";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
    }
    mysqli_close($conexion);
    // 38) Inclusión de la cabecera
    include("cabeceraU.php");
?>

    <p class="display-3 text-start m-3">Bienvenido <?php echo $_SESSION['usuario'] ?></p>

    <?php 
        /* 39) Condición para saber si el usuario se encuenta en servicio */
        if($mostrar['servicio']=="si") {
            echo "<p class='fs-5 fw-light text-start m-3'>Usted ya esta en servicio</p>";
            ?>    
            <!-- 40) Formulario para dejar el servicio --> 
            <form method="POST">
                <input class="btn btn-primary m-3" type="submit" value="Dejar servicio" name="servicio">
            </form>
        <?php }
        else {
             echo "<p class='fs-5 fw-light text-start m-3'>Usted aun no esta en servicio</p>";
        }
    ?>  

<?php
    /* 41) Inclusión del footer (realizado en un componente aparte ya 
    que es la misma para todo el sistema de usuarios )*/
    include("footerU.php");
?>