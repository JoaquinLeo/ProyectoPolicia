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
    $estado= (isset($_REQUEST['estado']))?$_REQUEST['estado']:"";


    switch($opcion){

        case "Aceptar" : 

            $sql2 = "UPDATE policias SET estado='aceptado' WHERE policia_id='$id'";
            if(!mysqli_query($conexion,$sql2)) {
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }

            if($estado == "espera"){

                $sql2 = "INSERT INTO policia_movil (policia_id , movil_id , funcion) VALUES ('$id',NULL,NULL)";
                if(!mysqli_query($conexion,$sql2)) {
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }

            }   
            
            else{

                $sql2 = "SELECT * FROM policia_movil WHERE policia_id = '$id'";
                $rta2= mysqli_query($conexion,$sql2) or
                die("Problemas en el select:".mysqli_error($conexion));

                $reg=mysqli_fetch_array($rta2);

                if(!$reg){
                    $sql2 = "INSERT INTO policia_movil (policia_id , movil_id , funcion) VALUES ('$id',NULL,NULL)";
                    if(!mysqli_query($conexion,$sql2)) {
                        echo "Error".$sql2."<br/>".mysqli_error($conexion);
                    }
                }
            }
            header("Location:ingresantes.php");
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

    include("cabeceraA.php");

?>


 
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
                    <input type="hidden" name="estado"  value="<?= $mostrar['estado'] ?>">
                    <input type="submit" name="opcion"  value="Aceptar">
                    <input type="submit" name="opcion"  value="Rechazar">
                    <input type="submit" name="opcion"  value="Seleccionar">
                    <input type="submit" name="opcion"  value="Borrar">  
                </form> 
            </td>
        </tr>
    <?php    
        }
    ?>  

    </table> 
        
    <form method="POST">
        <h3>Editar policias</h3>
        <input type="hidden" name="id" value="<?php echo $id;?>"><br>
        Nombre:
        <input type="text" name="nombre" value="<?php echo $nombre;?>" placeholder="nombre"><br>
        Apellido:
        <input type="text" name="apellido" value="<?php echo $apellido;?>" placeholder="apellido"><br>
        Legajo:
        <input type="text" name="legajo" value="<?php echo $legajo;?>" placeholder="legajo"><br>
        <?php if($_SESSION["nivel_usuario"]== "superadm"){?>
        Nivel de usuario:
        <select name="nivel_usuario">
            <option value="noadmin">noadmin</option>
            <option value="admin">admin</option>
        </select><br>
        <?php }
        else{   ?>
            <input type="hidden" name="nivel_usuario" value="<?php echo $nivel_usuario;?>">
        <?php 
            }
        ?>
        <input type="submit" name="opcion" value="Modificar">
    </form>
    
</body>
</html>