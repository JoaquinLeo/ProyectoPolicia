<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql = "SELECT movil_id,nro_serie,tipo_movil,estado,posesion FROM moviles
    where   estado <> 'radiado' and (tipo_movil = 'auto' or tipo_movil = 'camioneta')  order by movil_id asc";

    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));

    if(isset($_REQUEST['seleccionar']))
    {
        
        $movil_id = $_REQUEST['movil_id'];
        $funcion = $_REQUEST['funcion'];
        $estado = $_REQUEST['estado'];
        $id = $_SESSION['id'];

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("Y-m-d H:i:s");
        
        $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
            ('$id',$movil_id,'$funcion','$fecha', '$estado')";

        mysqli_query($conexion,$insert)
        or die("Problemas en el select".mysqli_error($conexion));

        $sql = "UPDATE moviles SET posesion = 1 WHERE movil_id = '$movil_id'";
        mysqli_query($conexion,$sql)
        or die("Problemas en el select".mysqli_error($conexion));

        ?>
        <!-- <script type="text/javascript">
            alert("Muchas gracias! Se presentismo fue correcto.");
            //location.reload();
        </script> -->
            
        <?php

        header("Location:bicicletas.php");
        
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
                <td>Posesion</td> 
                <td>Funcion</td> 
                <td>Opciones</td> 
            </tr>
            <?php  
                while($mostrar = mysqli_fetch_array($rta)){
                    $contador=1;
                    if($mostrar['posesion']==0){
                        $mostrar['posesion']="no";
                    }
                    else{
                        $mostrar['posesion']="si";
                    }
            ?>
            <tr>
                <td><?php echo $mostrar['movil_id']?></td>
                <td><?php echo $mostrar['nro_serie']?></td>
                <td><?php echo $mostrar['tipo_movil']?></td>
                <td><?php echo $mostrar['estado']?></td>
                <td><?php echo $mostrar['posesion']?></td>
                
                    <form method="POST">

                        <td>
                            <select name="funcion">
                                <option value="chofer">Chofer</option>
                                <option value="acompañante">Acompañante</option>
                            </select> 
                        </td> 

                        <td>
                            <?php
                                if($mostrar['posesion']=="no"){
                            ?>  
                                <input type="hidden" name="estado"  value="<?= $mostrar['estado'] ?>">
                                <input type="hidden" name="movil_id"  value="<?= $mostrar['movil_id'] ?>">
                                <input type="submit" value="seleccionar" name="seleccionar">
                            <?php
                                }
                                else echo "ocupado"; 
                            ?>
                        </td>   

                    </form>        
                
            </tr>
            
            <?php
                
                }
            ?>
        </table>

    
</body>
</html>
