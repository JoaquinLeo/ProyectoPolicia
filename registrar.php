<?php

    /* 4) Comprobación para verificar si se presionó el boton de enviar */
    if(isset($_REQUEST['enviar'])){

        /* 5) Conexion a la base de datos */
        include("conexion.php");

        /* 6) Inserción de los datos enviados en el formulario de registro en la base de datos */
        $sql="INSERT into policias(nombre,apellido,legajo,nivel_usuario,estado,servicio,años_servicio,dias_vacaciones) 
        values ('$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[legajo]','noadmin','espera','no',0,20)";
        mysqli_query($conexion,$sql)
        or die("Problemas en el insert".mysqli_error($conexion));
        /* --------------------------------------------------------- */

        /* 7) Cerrar conexion a la base de datos */
        mysqli_close($conexion);

        $var = "Muchas gracias! Registro con exito.";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
    }

    /* 1) Inclusión de la cabecera */
    include("cabeceraI.php");
?>

    <main class="form-signin w-100 m-auto">
        <!-- 8) Formulario para registrarse en el sistema -->
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal">Sistema de Gestión Electrónica Policia BA</h1>
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
            <button class="btn btn-primary btn-lg boton" type="Sumbit" value="Enviar" name="enviar" >Enviar</button>
            <button class="btn btn-primary btn-lg boton" type="button" value="Volver" onclick='volver()'>Volver</button>
        </form>
    </main>
    <!--  3) Función con javascipt para poder ir a index evitando los "required" del formulario    -->
    <script> 
        function volver(){
            location.href = "index.php";
        }
    </script> 
</body>
</html>