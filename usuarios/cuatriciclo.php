<?php
    include("../sesion.php");
    include("../conexion.php");

    

    $sql = "SELECT movil_id,nro_serie,tipo_movil,estado,posesion FROM moviles
    where   estado <> 'radiado' and (tipo_movil = 'cuatriciclo')  order by movil_id asc";

    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moviles</title>
</head>
<body>
    
        <ul>
            <li><a href="index.php">Presentismo</a></li>    
            <li><a href="enfermedad.php">Enfermedad</a></li>
            <li><a href="vacaciones.php">Vacaciones</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>

        <h1>Sistema de Gestión Electrónico Policia BA</h1>

        <table border="1">
        <caption>Moviles Policiales</caption>
            <tr>
                <td>Numero</td> 
                <td>Nro Serie</td> 
                <td>Tipo de Movil</td> 
                <td>Estado</td> 
                <td>Posesion</td> 
                <td>Opciones</td> 
            </tr>
            <?php  
                while($mostrar = mysqli_fetch_array($rta)){
                    $contador=1;
            ?>
            <tr>
                <td><?php echo $mostrar['movil_id']?></td>
                <td><?php echo $mostrar['nro_serie']?></td>
                <td><?php echo $mostrar['tipo_movil']?></td>
                <td><?php echo $mostrar['estado']?></td>
                <td><?php echo $mostrar['posesion']?></td>
                
                    <form method="POST">

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
    <?php
        if(isset($_REQUEST['seleccionar']))
        {
            
            $movil_id = $_REQUEST['movil_id'];
            $funcion = "chofer";
            $estado = $_REQUEST['estado'];
            $id = $_SESSION['id'];
    
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fecha = date("Y-m-d H:i:s");
            
            $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
                ('$id',$movil_id,'$funcion','$fecha', '$estado')";
    
            mysqli_query($conexion,$insert)
            or die("Problemas en el select".mysqli_error($conexion));
            mysqli_close($conexion);
            ?>
            <script type="text/javascript">
                alert("Muchas gracias! Se presentismo fue correcto.");
            </script>
               
            <?php
            
        }
    ?>
    
</body>
</html>
