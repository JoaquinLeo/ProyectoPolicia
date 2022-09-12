<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="./estilos/index.css" rel="stylesheet">
    <title>Document</title>

</head>
<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="fin_registro.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Sistema de Gestión Electrónico Policia BA</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" required>
                <label for="floatingInput">Nombre</label>
            </div>
            <div class="form-floating">
                <input type="text2" class="form-control" id="floatingInput" placeholder="Apellido" required>
                <label for="floatingInput">Apellido</label>
            </div>
            <div class="form-floating">
                 <input type="password" class="form-control" id="floatingPassword" placeholder="Legajo" required>
                <label for="floatingPassword">Legajo</label>
            </div>
            <select class="form-select" name="nivel_usuario">
                <option value="noadmin">No Admin</option>
                <option value="admin">Admin</option>
            </select>
            <button class="btn btn-primary btn-lg" type="Sumbit" value="Enviar">Enviar</button>
            <button class="btn btn-primary btn-lg" type="button" onclick='volver()'>Volver</button>
        </form>
    </main>
    <script>
        function volver(){
            location.href = "index.php";
        }
    </script> 
</body>
</html>