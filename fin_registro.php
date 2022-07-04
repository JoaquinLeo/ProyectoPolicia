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
        $volver ="";
        if(isset($_REQUEST['enviar']))$enviar=$_REQUEST['enviar'];
        if(isset($_REQUEST['volver']))$volver=$_REQUEST['volver'];

        if($enviar){
        $conexion = mysqli_connect("localhost","root","","dbPolicia")or
        die("Problemas con la conexión");
        mysqli_query($conexion,"insert into policia(nombre,apellido,legajo,nivel_usuario,estado) values 
        ('$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[legajo]','$_REQUEST[nivel_usuario]','espera')")
        or die("Problemas en el select".mysqli_error($conexion));
        mysqli_close($conexion);
        ?>
        <p>
            Muchas gracias! Espere confirmación.<br>
            <form method="post" action="fin_registro.php">
            <input type="submit" value="Volver a la pagina Principal" name="inicio">
            </form>

        </p>
        <?php
        }
        if($volver){
           header("location:index.php");
        }
        $inicio="";
        if(isset($_REQUEST['inicio']))$inicio=$_REQUEST['inicio'];
        if($inicio){
            header("location:index.php");
        }
        ?>

    </div>
</body>
</html>
