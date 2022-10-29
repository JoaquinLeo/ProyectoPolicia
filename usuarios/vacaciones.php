<?php
    /* Validación de una sesión */
    include("../sesion.php");
    /* Conexion a la base de datos */
    include("../conexion.php");
    /* Control del tipo de usuario */
    include("controlU.php");

    /* Fijación de la zona horaria para trabajar con fechas */
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");
    /* ---------------------------------------------------- */

    if(isset($_REQUEST['enviar']))
    {   
        /* Captura de los datos del formulario */
        $id = $_SESSION['id'];
        $nombre = $_REQUEST['usuario'];
        $finicio = $_REQUEST['finicio'];
        $ffin = $_REQUEST['ffin'];
        $estado = 'espera';
        /* ----------------------------------- */

        /* 6) Inserción del certificado en la base de datos  */
        $sql = "INSERT INTO vacaciones (policia_id,fecha_inicio,fecha_fin,estado) 
        values ('$id','$finicio','$ffin','$estado')";
        mysqli_query($conexion,$sql) 
        or die("Problemas en el insert:".mysqli_error($conexion));
        /* ---------------------------------------------------- */

        /* Alerta para indicar que se envió correctamente el pedido de vacaciones */
        $var = "Se envió correctamente el pedido de vacaciones";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
    }
    mysqli_close($conexion);
    // 1) Inclusión de la cabecera (realizada en un componente aparte ya que es la misma para todo el sistema de usuarios )
    include("cabeceraU.php");
?>

    <div class="container mt-4" style="max-width: 800px">
        <div class="card border border-dark border-3 rounded" >
            <div class="card-header">
            </div>
            <div class="card-body">
                <!-- Formulario para enviar pedido de vacaciones --> 
                <form method="POST">
                    <p class="fs-6 fw-semibold mb-1">Usuario:</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
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
    // 1) Inclusión del footer (realizado en un componente aparte ya que es la misma para todo el sistema de usuarios )
    include("footerU.php");
?>