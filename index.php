<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="./estilos/Logreg.css" rel="stylesheet">
    <title>Document</title>   
    
</head>
<body class="text-center">
    <div>
        <main class="form-signin w-100 m-auto">
            <form action="validar.php" method="POST">
                <h1 class="h3 mb-3 fw-normal">Sistema de Gestión Electrónico Policia BA</h1>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="usuario" placeholder="Usuario" required>
                    <label for="floatingInput">Usuario</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="contrasenna" placeholder="Legajo" required>
                    <label for="floatingPassword">Legajo</label>
                </div>
                
                <button class="btn btn-primary btn-lg boton" type="button" value="Registrar" onclick='registrar()'>Registrar</button>
                <button class="btn btn-primary btn-lg boton" type="submit" value="Ingresar" name="ingresar">Ingresar</button>
            </form>   
        </main>
        <script>
            function registrar(){
                location.href = "registrar.php";
            }
        </script>

    </div>
</body>
</html>