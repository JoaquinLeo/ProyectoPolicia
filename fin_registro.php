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
        $enviar ="";
        if(isset($_REQUEST['enviar']))$enviar=$_REQUEST['enviar'];


        if($enviar){
        include("conexion.php");
        $sql="INSERT into policias(nombre,apellido,legajo,nivel_usuario,estado) values 
        ('$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[legajo]','$_REQUEST[nivel_usuario]','espera')";
        
        mysqli_query($conexion,$sql)
        or die("Problemas en el select".mysqli_error($conexion));
        mysqli_close($conexion);
        echo "Muchas gracias! Espere confirmación.";
        
        /*?>
        <p>
            Muchas gracias! Espere confirmación.<br>
            <form method="post" action="fin_registro.php">
            <input type="submit" value="Volver a la pagina Principal" name="inicio">
            </form>

        </p>
        <?php*/
        }

        /*$inicio="";
        if(isset($_REQUEST['inicio']))$inicio=$_REQUEST['inicio'];
        if($inicio){
            header("location:index.php");
        }
        ?>*/
        ?>
        <br><a href="index.php">Cerrar Sesion</a>
    </div>
</body>
</html>
