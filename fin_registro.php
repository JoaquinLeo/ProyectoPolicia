<?php
        // SE PUEDE BORRAR ESTA PAGINA, YA NO HACE NADA (ahora directo en registrar.php)
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
    <h1>Sistema de Gestión Electrónico Policia BA</h1>
    <div>

        <?php
        $enviar = (isset($_REQUEST['enviar']))?$_REQUEST['enviar']:"";


        if($enviar){
        include("conexion.php");
        $sql="INSERT into policias(nombre,apellido,legajo,nivel_usuario,estado) values 
        ('$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[legajo]','noadmin','espera')";
        
        mysqli_query($conexion,$sql)
        or die("Problemas en el select".mysqli_error($conexion));
        mysqli_close($conexion);
        ?>
        <p>Muchas gracias! Espere confirmación.</p>
        <?php    
        }

        ?>
        <br><a href="index.php">Volver al Inicio</a>
    </div>
</body>
</html>
