<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT movil_id , nro_serie ,tipo_movil , estado , posesion FROM moviles WHERE estado <>'borrado' ";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    $numero=1;

    // CONDICION TERNARIA    ESTA ES LA CONDICION       SE CUMPLE           NO SE CUMPLE       
    $opcion =             (isset($_REQUEST['opcion']))?$_REQUEST['opcion']  :     "";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    $posesion = (isset($_REQUEST['posesion']))?$_REQUEST['posesion']:"";
    $tipo_movil = (isset($_REQUEST['tipo_movil']))?$_REQUEST['tipo_movil']:"";
    $estado= (isset($_REQUEST['estado']))?$_REQUEST['estado']:"";
    $nro_serie= (isset($_REQUEST['nro_serie']))?$_REQUEST['nro_serie']:"";; 


    switch($opcion){

        case "Borrar" : 

            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fecha = date("Y-m-d H:i:s");

            $sql2 = "UPDATE moviles SET estado='borrado' , fecha_borrado='$fecha' WHERE movil_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:vehiculos.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

        case "Seleccionar" : 

            $sql3 = "SELECT * FROM moviles WHERE movil_id='$id'";
            $rta2 = mysqli_query($conexion,$sql3) or
            die("Problemas en el select:".mysqli_error($conexion));
        
            $seleccion = mysqli_fetch_array($rta2);

            $posesion= $seleccion['posesion'] ; 
            $tipo_movil= $seleccion['tipo_movil'] ; 
            $nro_serie= $seleccion['nro_serie'] ; 
            $estado= $seleccion['estado'] ; 

            break;

        case "Modificar" : 

            $sql2 = "UPDATE moviles SET posesion='$posesion', tipo_movil='$tipo_movil', estado='$estado',
            nro_serie='$nro_serie' WHERE movil_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:vehiculos.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <nav>
        <ul>
            <li><a href="index.php">Control</a></li>
            <li><a href="ingresantes.php">Ingresantes</a></li>
            <li><a href="vacaciones.php">Vacaciones</a></li>
            <li><a href="enfermedades.php">Enfermedades</a></li>
            <li><a href="vehiculos.php">Vehiculos</a></li>
            <li><a href="../cerrar_session.php">Cerrar Sesion</a></li>
        </ul>
    </nav>

    <h1>Sistema de Gestión Electrónico Policia BA</h1>

    <table border="1">
        <caption>Moviles</caption>
        <tr>
            <td>Numero</td> 
            <td>Numero de Serie</td> 
            <td>Tipo de Movil</td> 
            <td>Estado</td> 
            <td>Posesion</td> 
            <td>Opciones</td>
        </tr>
    <?php
        while ($mostrar = mysqli_fetch_array($rta))
        {
    ?>
        <tr>
            <td> <?php echo $numero ?> </td> 
            <td> <?php echo $mostrar['nro_serie'] ?> </td> 
            <td> <?php echo $mostrar['tipo_movil'] ?> </td> 
            <td> <?php echo $mostrar['estado'] ?> </td> 
            <td> <?php 
                    if ($mostrar['posesion'] == "si" ){
                        echo "si";
                    }
                    else{
                        echo"no";
                    }
                 ?> 
            </td> 
            <td>
                <form method="POST">
                    <input type="hidden" name="id"  value="<?= $mostrar['movil_id'] ?>">
                    <input type="submit" name="opcion" value="Seleccionar">
                    <input type="submit" name="opcion" value="Borrar">
                </form>     
            </td>
        </tr>
    <?php    
        $numero++;
        }
    ?>

    </table>

    <br><br><br>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id;?>"><br>
        Numero de Serie:
        <input type="text" name="nro_serie" value="<?php echo $nro_serie;?>" placeholder="nro_serie"><br>
        Estado: <?php echo $estado;?>
        <select name="estado"> 
            <option value="bien">Bien</option>
            <option value="regular">Regular</option>
            <option value="radiado">Radiado</option>
        </select><br>
        Posesion: <?php echo $posesion;?>
        <select name="posesion">
            <option value="si">Si</option>
            <option value="no">No</option>
        </select><br>
        Tipo de movil: <?php echo $tipo_movil;?>
        <select name="tipo_movil">
            <option value="auto">Auto</option>
            <option value="camioneta">Camioneta</option>
            <option value="cuatriciclo">Cuatriciclo</option>
            <option value="bicicleta">Bicicleta</option>
        </select><br>
        <input type="submit" name="opcion" value="Modificar">
    </form>
</body>
</html>