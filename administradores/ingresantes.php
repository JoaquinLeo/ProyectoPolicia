<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT * FROM policias WHERE estado <>'borrado'";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    // CONDICION TERNARIA    ESTA ES LA CONDICION       SE CUMPLE           NO SE CUMPLE       
    $opcion =             (isset($_REQUEST['opcion']))?$_REQUEST['opcion']  :     "";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    $seleccion = (isset($_REQUEST['seleccion']))?$_REQUEST['seleccion']:"";
    $busqueda = (isset($_REQUEST['busqueda']))?$_REQUEST['busqueda']:"";

    $nombre= (isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"";
    $apellido= (isset($_REQUEST['apellido']))?$_REQUEST['apellido']:"";; 
    $legajo= (isset($_REQUEST['legajo']))?$_REQUEST['legajo']:"";
    $nivel_usuario= (isset($_REQUEST['nivel_usuario']))?$_REQUEST['nivel_usuario']:"";


    switch($opcion){

        case "Aceptar" : 

            $sql2 = "UPDATE policias SET estado='aceptado' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

        case "Rechazar" : 

            $sql2 = "UPDATE policias SET estado='rechazado' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

        case "Borrar" : 

            $sql2 = "UPDATE policias SET estado='borrado' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;

        case "Seleccionar" : 

            $sql3 = "SELECT * FROM policias WHERE policia_id='$id'";
            $rta2 = mysqli_query($conexion,$sql3) or
            die("Problemas en el select:".mysqli_error($conexion));
        
            $seleccion = mysqli_fetch_array($rta2);
            $nombre= $seleccion['nombre'] ; 
            $apellido= $seleccion['apellido'] ; 
            $legajo= $seleccion['legajo'] ; 
            $nivel_usuario= $seleccion['nivel_usuario'] ; 


            break;

        case "Modificar" : 

            $sql2 = "UPDATE policias SET nombre='$nombre', apellido='$apellido', legajo='$legajo',
            nivel_usuario='$nivel_usuario' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
    }

?>

<!DOCTYPE html>
<html lang="es">
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

 
    <table border="1" id="tabla">

        <caption>Ingresantes</caption>
        <thead>
            <tr>
                <td>Nombre</td> 
                <td>Apellido</td> 
                <td>Legajo</td> 
                <td>Nivel de usuario</td> 
                <td>Estado</td>
                <td>Opciones</td>
            </tr>
        </thead>
        
    <?php
        while ($mostrar = mysqli_fetch_array($rta))
        {
    ?>
        <tr>
            <td> <?php echo $mostrar['nombre'] ?> </td> 
            <td> <?php echo $mostrar['apellido'] ?> </td> 
            <td> <?php echo $mostrar['legajo'] ?> </td> 
            <td> <?php echo $mostrar['nivel_usuario'] ?> </td> 
            <td> <?php echo $mostrar['estado'] ?> </td> 
            <td>
                <form method="POST">
                    <input type="hidden" name="id"  value="<?= $mostrar['policia_id'] ?>">
                    <input type="submit" name="opcion" value="Aceptar">
                    <input type="submit" name="opcion" value="Rechazar">
                    <input type="submit" name="opcion" value="Seleccionar">
                    <input type="submit" name="opcion" value="Borrar">  
                </form> 
            </td>
        </tr>
    <?php    
        }
    ?>  

    </table> 
    
    <br><br><br>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id;?>"><br>
        Nombre:
        <input type="text" name="nombre" value="<?php echo $nombre;?>" placeholder="nombre"><br>
        Apellido:
        <input type="text" name="apellido" value="<?php echo $apellido;?>" placeholder="apellido"><br>
        Legajo:
        <input type="text" name="legajo" value="<?php echo $legajo;?>" placeholder="legajo"><br>
        Nivel de usuario:
        <select name="nivel_usuario">
            <option value="noadmin">noadmin</option>
            <option value="admin">admin</option>
        </select><br>
        <input type="submit" name="opcion" value="Modificar">
    </form>
    
</body>
</html>