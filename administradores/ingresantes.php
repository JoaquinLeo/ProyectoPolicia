<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT * FROM policias";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    // CONDICION TERNARIA    ESTA ES LA CONDICION       SE CUMPLE           NO SE CUMPLE       
    $opcion =             (isset($_REQUEST['opcion']))?$_REQUEST['opcion']  :     "";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    $seleccion = (isset($_REQUEST['seleccion']))?$_REQUEST['seleccion']:"";
    $busqueda = (isset($_REQUEST['busqueda']))?$_REQUEST['busqueda']:"";

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

            $sql2 = "DELETE FROM policias WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
        case "Buscar" : 

            $sql="SELECT * FROM policias WHERE $seleccion='$busqueda'";
    
            $rta= mysqli_query($conexion,$sql) or
            die("Problemas en el select:".mysqli_error($conexion));
           /* echo $seleccion;

            echo $busqueda;

            while ($mostrar = mysqli_fetch_array($rta))
        {

            echo $mostrar['nombre'];
            echo $mostrar['apellido'];
            echo $mostrar['legajo'];
            echo $mostrar['nivel_usuario'];
            echo $mostrar['estado'];

   
        }*/
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
      <!--   <form method="POST">
            Seleccionar por: 
            <select name="seleccion">
                <option value="nombre">Nombre</option>
                <option value="apellido">Apellido</option>
                <option value="legajo">Legajo</option>
                <option value="nivel_usuario">Nivel de usuario</option>
                <option value="estado">Estado</option>
            </select>
                <input type="text" name="busqueda" placeholder="escribir aqui">
                <input type="submit" name="opcion" value="Buscar"><br><br>
        </form> -->

        <caption>Ingresantes</caption>
        <thead>
            <tr>
                <td>Nombre</td> 
                <td>Apellido</td> 
                <td>Legajo</td> 
                <td>Nivel de usuario</td> 
                <td>Estado</td>
                <td>Opcion</td>
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
                    <input type="submit" name="opcion" value="Borrar">
                </form>     
            </td>
        </tr>
    <?php    
        }
    ?>  
    </table>     
    
</body>
</html>