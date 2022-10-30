<?php
    /* Validación de una sesión */
    include("../sesion.php");
    /* Conexion a la base de datos */
    include("../conexion.php");
    /* Control del tipo de usuario */
    include("controlU.php");

    /* Condición para saber si envió el formulario */
    if(isset($_REQUEST['enviar']))
    {   
        /* Captura de los datos del formulario */
        $id = $_SESSION['id'];
        $nombre = $_REQUEST['usuario'];
        $legajo = $_SESSION['legajo'];
        $imagen = addslashes(file_get_contents($_FILES['certificado']['tmp_name']));
        /* ----------------------------------- */

        /* Fijación de la zona horaria para trabajar con fechas */
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("Y-m-d H:i:s");
        /* ---------------------------------------------------- */

        /* 6) Inserción del certificado en la base de datos  */
        $sql = "INSERT INTO enfermedad(policia_id,fecha,certificado) 
        values ('$id','$fecha','$imagen')";
        mysqli_query($conexion,$sql) 
        or die("Problemas en el insert:".mysqli_error($conexion));
        /* ---------------------------------------------------- */

        /* Alerta para indicar que se insertó correctamente el certificado */
        $var = "Se insertó correctamente el certificado";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'enfermedad.php'; }, 10 ); </script>";
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
                <!-- Formulario para enviar el certificado de enfermedad --> 
                <form method="POST" enctype="multipart/form-data">
                    <p class="fs-6 fw-semibold mb-1">Usuario:</p>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <p class="fs-6 fw-semibold mb-1">Ingrese su certificado:</p>
                    <div class="input-group mb-3">
                        <input type="file" name="certificado" required class="form-control" id="inputGroupFile02" accept="image/*">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                        <input class="btn btn-primary" type="submit" value="Enviar" name="enviar">
                </form>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>   
    </div>

    <div class="text-center mt-4">
        <img class="img-fluid img-thumbnail"  height="300" width="300" id="imagenPrevisualizacion">
    <div>

    <!-- Script para la previsualizacion del certificado -->    
    <script>
        const $inputGroupFile02 = document.querySelector("#inputGroupFile02"),
        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
        $inputGroupFile02.addEventListener("change", () => {
        const archivos = $inputGroupFile02.files;

        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }

        const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);
        $imagenPrevisualizacion.src = objectURL;
        });
    </script>

<?php
    // 1) Inclusión del footer (realizado en un componente aparte ya que es la misma para todo el sistema de usuarios )
    include("footerU.php");
?>