<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 21) Control del tipo de usuario */
    include("controlU.php");

    /* 49) Fijación de la zona horaria para trabajar con fechas */
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");
    /* ---------------------------------------------------- */

    /* 101) Condición para saber si envió el formulario */
    if(isset($_REQUEST['enviar']))
    {   
        /* 102) Captura de los datos del formulario */
        $id = $_SESSION['id'];
        $nombre = $_REQUEST['usuario'];
        $finicio = $_REQUEST['finicio'];
        $ffin = $_REQUEST['ffin'];
        $estado = 'espera';
        /* ----------------------------------- */

        /* 103) Inserción de la vacacion en la base de datos  */
        $sql = "INSERT INTO vacaciones (policia_id,fecha_inicio,fecha_fin,estado) 
        values ('$id','$finicio','$ffin','$estado')";
        mysqli_query($conexion,$sql) 
        or die("Problemas en el insert:".mysqli_error($conexion));
        /* ---------------------------------------------------- */

        /* 104) Alerta para indicar que se envió correctamente el pedido de vacaciones */
        $var = "Se envió correctamente el pedido de vacaciones";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
    }
    mysqli_close($conexion);

    // 38) Inclusión de la cabecera 
    include("cabeceraU.php");
?>

    <div class="container mt-4 section-content" style="max-width: 800px">
        <div class="card border border-dark border-3 rounded" >
            <div class="card-header">
            </div>
            <div class="card-body">
                <!-- 105) Formulario para enviar pedido de vacaciones --> 
                <form method="POST">
                    <p class="fs-6 fw-semibold mb-1">Usuario:</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly class="form-control" 
                        placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <p class="fs-6 fw-semibold mb-1">Ingrese su fecha de inicio:</p>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputDate01">Select Date</label>
                        <input class="form-control" id="inputDate01" type="date" min="<?=$fecha?>" name="finicio" required>
                    </div>
                    <p class="fs-6 fw-semibold mb-1">Ingrese su fecha de fin:</p>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputDate02">Select Date</label>
                        <input class="form-control" id="inputDate02"type="date" min="<?=$fecha?>" name="ffin" required>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Enviar" name="enviar"> 
                </form>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>   
    </div>

<?php
    // 41) Inclusión del footer
    include("footerU.php");
?>