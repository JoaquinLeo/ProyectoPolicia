<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Bienvenido a la pagina de administradores
    </h1>
    <nav>
        <ul>
            <li><a href="index.php">Control</a></li>
            <li><a href="#">Ingresantes</a></li>
            <li><a href="../index.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
    <?php
        
            $conexion=mysqli_connect("localhost","root","","dbPolicia") or
            die("Problemas con la conexión");
    
            $consulta="SELECT * FROM policia";
    
            $resultado= mysqli_query($conexion,$consulta) or
            die("Problemas en el select:".mysqli_error($conexion));
            
            while ($reg=mysqli_fetch_array($resultado))
            {
            echo "Nombre:".$reg['nombre']."&nbsp &nbsp &nbsp";
            echo "Apellido:".$reg['apellido']."&nbsp &nbsp &nbsp";
            echo "Legajo:".$reg['legajo']."&nbsp &nbsp &nbsp";
            echo "Nivel de usuario:".$reg['nivel_usuario']."&nbsp &nbsp &nbsp";
            echo "Estado:".$reg['estado']."&nbsp &nbsp &nbsp";
            
            echo "<br>";
            echo "<hr>";
            }
    
            
    ?>
</body>
</html>