<?php

    if(isset($_REQUEST['enviar'])){

        include("conexion.php");
        $sql="INSERT into policias(nombre,apellido,legajo,nivel_usuario,estado,servicio,años_servicio,dias_vacaciones) values 
        ('$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[legajo]','noadmin','espera','no',0,20)";
        
        mysqli_query($conexion,$sql)
        or die("Problemas en el select".mysqli_error($conexion));
        mysqli_close($conexion);

        $var = "Muchas gracias! Registro con exito.";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
    }

    include("cabeceraI.php");
?>
    <main class="form-signin w-100 m-auto">
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal">Sistema de Gestión Electrónico Policia BA</h1>
            <div class="form-floating">
                <input type="text" name="nombre" class="form-control" id="floatingInput" placeholder="Nombre" required>
                <label for="floatingInput">Nombre</label>
            </div>
            <div class="form-floating">
                <input type="text2" name="apellido" class="form-control" id="floatingInput" placeholder="Apellido" required>
                <label for="floatingInput">Apellido</label>
            </div>
            <div class="form-floating">
                 <input type="password" name="legajo" class="form-control" id="floatingPassword" placeholder="Legajo" required>
                <label for="floatingPassword">Legajo</label>
            </div>
            <!-- <select class="form-select" name="nivel_usuario">
                <option value="noadmin">No Admin</option>
                <option value="admin">Admin</option>
            </select> -->
            <button class="btn btn-primary btn-lg boton" type="Sumbit" value="Enviar" name="enviar" >Enviar</button>
            <button class="btn btn-primary btn-lg boton" type="button" value="Volver" onclick='volver()'>Volver</button>
        </form>
    </main>
    <script>
        function volver(){
            location.href = "index.php";
        }
    </script> 
</body>
</html>