<?php
    include("../sesion.php");
    include("../conexion.php");
    
    $id= $_SESSION["id"];
    $sql = "SELECT servicio FROM policias WHERE policia_id='$id'";
    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));
    $mostrar = mysqli_fetch_array($rta);

    if(isset($_REQUEST["servicio"])){

        $update = "UPDATE policias SET servicio='no' WHERE policia_id='$id'";
        mysqli_query($conexion,$update)
        or die("Problemas en el select".mysqli_error($conexion));


        $sql2 = "SELECT policia_id,policia_movil.movil_id, funcion , posesion FROM policia_movil 
        INNER JOIN moviles on policia_movil.movil_id = moviles.movil_id
        WHERE policia_id ='$id'";
        $rta2 = mysqli_query($conexion,$sql2) or 
        die("Problemas en el select:".mysqli_error($conexion));
        $mostrar2 = mysqli_fetch_array($rta2);


        if($mostrar2['posesion']==3){
            if($mostrar2['funcion']=="acompañante"){
                $movil_id = $mostrar2['movil_id'];
                $update2 = "UPDATE policia_movil SET movil_id = null , funcion= null WHERE policia_id='$id'";
                mysqli_query($conexion,$update2)
                or die("Problemas en el select".mysqli_error($conexion));

                $update3 = "UPDATE moviles SET posesion = 1 WHERE movil_id='$movil_id'";
                mysqli_query($conexion,$update3)
                or die("Problemas en el select".mysqli_error($conexion));
            }
            else{

                $movil_id = $mostrar2['movil_id'];
                $update2 = "UPDATE policia_movil SET movil_id = null , funcion= null WHERE policia_id='$id'";
                mysqli_query($conexion,$update2)
                or die("Problemas en el select".mysqli_error($conexion));

                $update3 = "UPDATE moviles SET posesion = 2 WHERE movil_id='$movil_id'";
                mysqli_query($conexion,$update3)
                or die("Problemas en el select".mysqli_error($conexion));
            }
        }
        else{
                $movil_id = $mostrar2['movil_id'];
                $update2 = "UPDATE policia_movil SET movil_id = null , funcion= null WHERE policia_id='$id'";
                mysqli_query($conexion,$update2)
                or die("Problemas en el select".mysqli_error($conexion));

                $update3 = "UPDATE moviles SET posesion = 0 WHERE movil_id='$movil_id'";
                mysqli_query($conexion,$update3)
                or die("Problemas en el select".mysqli_error($conexion));
        }



        $var = "Usted ha salido de servicio con exito";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
    }

    include("cabeceraU.php");

?>
    <p class="display-3 text-start m-3">Bienvenido <?php echo $_SESSION['usuario'] ?></p>

    <?php 
        if($mostrar['servicio']=="si") {
            echo "<p class='fs-5 fw-light text-start m-3'>Usted ya esta en servicio</p>";
            ?>     
            <form method="POST">
                <input class="btn btn-primary m-3" type="submit" value="Dejar servicio" name="servicio">
            </form>
        <?php }
        else echo "<p class='fs-5 fw-light text-start m-3'>Usted aun no esta en servicio</p>";
    ?>   
</body>
</html>