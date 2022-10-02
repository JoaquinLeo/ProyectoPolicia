<?php
    include("cabeceraI.php");
?>
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