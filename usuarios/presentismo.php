<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 21) Control del tipo de usuario */
    include("controlU.php");

    /* Consulta a la base de datos para saber si el usuario se encuenta en servicio o no */
    $id= $_SESSION["id"];
    $sql = "SELECT servicio FROM policias WHERE policia_id='$id'";
    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));
    $mostrar = mysqli_fetch_array($rta);
    /* --------------------------------------------------------------------------------- */
    mysqli_close($conexion);
    // 1) Inclusión de la cabecera (realizada en un componente aparte ya que es la misma para todo el sistema de usuarios )
    include("cabeceraU.php");
?>

    <div class="container mt-4 section-content" style="max-width: 800px">
        <div class="card border border-dark border-3 rounded" >
            <div class="card-header">
            </div>
            <div class="card-body">
                <!-- Formulario para dar el presentismo -->
                <form method="POST" action="funcion.php">
                    <p class="fs-6 fw-semibold mb-1">Seleccionar:</p> 
                    <select class="form-select w-50 mb-4" name="funcion">
                        <option value="movil">Moviles</option>
                        <option value="caminante">Caminante</option>
                        <option value="bicicleta">Bicicletas</option>
                        <option value="cuatriciclo">Cuatriciclos</option>
                    </select>
                    <input class="btn btn-primary" type="submit" value="siguiente" name="selecionar"
                    
                    <?php echo ($mostrar['servicio']=="si")?"disabled":"";  ?> >
                    <!-- Si el usuario se encuenta en servicio entonces se desactiva el envio del formulario -->
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