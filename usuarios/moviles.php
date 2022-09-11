<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql = "SELECT movil_id,nro_serie,tipo_movil,estado,posesion FROM moviles order by movil_id asc";
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
                while($mostrar = mysqli_fetch_row($rta)){
                    if($mostrar['4']==0)$mostrar['4']="no";
                    else $mostrar['4']="si";
                    $contador=1;
            ?>
            <tr>
                <td><?php echo $mostrar['0']?></td>
                <td><?php echo $mostrar['1']?></td>
                <td><?php echo $mostrar['2']?></td>
                <td><?php echo $mostrar['3']?></td>
                <td><?php echo $mostrar['4']?></td>
                
                    <form action="presentismo.php" method="POST">

                        <td>
                            <select name="funcion">
                                <option value="chofer">Chofer</option>
                                <option value="acompañante">Acompañante</option>
                            </select> 
                        </td> 

                        <td>
                            <?php
                                if($mostrar['4']=="no"){
                            ?>  
                                <input type="hidden" name="movil"  value="<?= $mostrar['0'] ?>">
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
