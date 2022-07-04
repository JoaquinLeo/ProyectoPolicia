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
        <form action="fin_registro.php" method="post">
            Nombre:
            <input type="text" name="nombre" placeholder="Ingrese aqui su nombre" required><br><br>
            Apellido:
            <input type="text" name="apellido" placeholder="Ingrese aqui su apellido" required><br><br>
            Legajo:
            <input type="number" name="legajo" placeholder="Ingrese aqui su legajo" required><br><br>
            Nivel de usuario:
            <select name="nivel_usuario">
                <option value="noadmin">No Admin</option>
                <option value="admin">Admin</option>
            </select>
            <br><br>
            <input type="submit" value="Enviar" name="enviar">
            <input type="button" value="Volver" onclick='volver()'>
        </form>
        <script>
            function volver(){
                location.href = "index.php";
            }
        </script>
    </div>

</body>
</html>