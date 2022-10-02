<?php
    include("../sesion.php");
    include("../conexion.php");

    

    $sql = "SELECT movil_id,nro_serie,tipo_movil,estado,posesion FROM moviles
    where   (estado <> 'radiado' and estado <> 'borrado') 
    and (tipo_movil = 'cuatriciclo')  and posesion <> 3
    order by movil_id asc";

    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));

    if(isset($_REQUEST['seleccionar']))
        {
            
            $movil_id = $_REQUEST['movil_id'];
            $funcion = "chofer";
            $estado = $_REQUEST['estado'];
            $posesion = $_REQUEST['posesion'];
            $id = $_SESSION['id'];
    
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fecha = date("Y-m-d H:i:s");
            
            $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
                ('$id',$movil_id,'$funcion','$fecha', '$estado')";
            mysqli_query($conexion,$insert)
            or die("Problemas en el select".mysqli_error($conexion));

            $update = "UPDATE policias SET servicio='si' WHERE policia_id='$id'";
            mysqli_query($conexion,$update)
            or die("Problemas en el select".mysqli_error($conexion));

            $update2 = "UPDATE policia_movil SET movil_id='$movil_id' , funcion='$funcion' WHERE policia_id='$id'";
            mysqli_query($conexion,$update2)
            or die("Problemas en el select".mysqli_error($conexion));

            if($posesion == 0){

                if($funcion == "chofer"){
                    $sql = "UPDATE moviles SET posesion = 2 WHERE movil_id = '$movil_id'";
                    mysqli_query($conexion,$sql)
                    or die("Problemas en el select".mysqli_error($conexion));
                    echo "posesion 0";
                }
                else{
                    $sql = "UPDATE moviles SET posesion = 1 WHERE movil_id = '$movil_id'";
                    mysqli_query($conexion,$sql)
                    or die("Problemas en el select".mysqli_error($conexion));
    
                }
    
            }
            else{
                $sql = "UPDATE moviles SET posesion = 3 WHERE movil_id = '$movil_id'";
                mysqli_query($conexion,$sql)
                or die("Problemas en el select".mysqli_error($conexion));
    
            }
            
            $var = "Su presente fue dado con exito";
            echo "<script> alert('".$var."');</script>";
            echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
         
        }

        include("cabeceraU.php");
?>

        <table border="1">
        <caption>Moviles Policiales</caption>
            <tr>
                <td>Numero</td> 
                <td>Nro Serie</td> 
                <td>Tipo de Movil</td> 
                <td>Estado</td>
                <td>Funcion</td>  
                <td>Opciones</td> 
            </tr>
            <?php  
                $contador=1;
                while($mostrar = mysqli_fetch_array($rta)){
                    
            ?>
            <tr>
                <td><?php echo $contador?></td>
                <td><?php echo $mostrar['nro_serie']?></td>
                <td><?php echo $mostrar['tipo_movil']?></td>
                <td><?php echo $mostrar['estado']?></td>
                
                    <form method="POST">
 
                        <td>
                            <?php
                                if($mostrar['posesion']==0){
                            ?> 
                            <select name="funcion">
                                <option value="chofer">Chofer</option>
                                <option value="acompañante">Acompañante</option>
                            </select> 
                            <?php
                                }
                                else if($mostrar['posesion']==1){
                            ?>
                            <select name="funcion">
                                <option value="chofer">Chofer</option>
                            </select> 
                            <?php
                                }
                                else if($mostrar['posesion']==2){
                            ?>
                            <select name="funcion">
                                <option value="acompañante">Acompañante</option>
                            </select> 
                            <?php
                                }
                            ?>
                        </td> 

                        <td>
                            <?php
                                if($mostrar['posesion'] != 3){
                            ?>  
                                <input type="hidden" name="estado"  value="<?= $mostrar['estado'] ?>">
                                <input type="hidden" name="movil_id"  value="<?= $mostrar['movil_id'] ?>">
                                <input type="hidden" name="posesion"  value="<?= $mostrar['posesion'] ?>">
                                <input type="submit" value="seleccionar" name="seleccionar">
                            <?php
                                }
                            ?>
                        </td>     

                    </form>        
                
            </tr>
            
            <?php
                $contador++;
                }
            ?>
        </table>

    
</body>
</html>