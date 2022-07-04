
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <header>
        <h1>Sistema de Gestión Electrónico Policia BA</h1>
    </header>
    <div>
    <form action="validar.php" method="post">
        Ingrese Usuario:
        <input type="text" name="usuario" placeholder="nombre" required><br>
        Ingrese Contraseña:
        <input type="number" name="contrasenna" placeholder="legajo" required><br>
        <input type="button" value="Registrar"  onclick='registrar()'>
        <input type="submit" value="Ingresar" name="ingresar">
    </form>
   
        </form>
        <script>
            function registrar(){
                location.href = "registrar.php";
            }
    </script>
    
    </div>
</body>
</html>