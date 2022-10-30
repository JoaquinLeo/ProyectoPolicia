<?php
    /* Validación de una sesión */
    include("../sesion.php");
    /* Conexion a la base de datos */
    include("../conexion.php");
    /* Control del tipo de usuario */
    include("controlA.php");

    /* Fijación de la zona horaria para trabajar con fechas */
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");
    /* ---------------------------------------------------- */

    /* Consulta a la base de datos para traer y mostrar los presentes del dia actual */
    $sql = "SELECT policias.nombre , policias.apellido , policias.legajo ,
    COALESCE(moviles.tipo_movil,'-') AS tipo_movil , 
    COALESCE(moviles.nro_serie,'-') AS nro_serie, 
    presentismo.funcion , presentismo.fecha , 
    COALESCE(presentismo.estado_movil,'-') AS estado_movil FROM policias 
    INNER JOIN presentismo on presentismo.policia_id = policias.policia_id 
    LEFT JOIN moviles on moviles.movil_id = presentismo.movil_id 
    WHERE date(presentismo.fecha)='$fecha'
    ORDER BY presentismo.fecha ASC"; 
    $rta= mysqli_query($conexion,$sql)
    or die("Problemas en el select".mysqli_error($conexion));
    /* ---------------------------------------------------------------------------- */
    mysqli_close($conexion);
    // 1) Inclusión de la cabecera (realizada en un componente aparte ya que es la misma para todo el sistema de administradores )
    include("cabeceraA.php");
?>

<!-- Tarjeta de Admin -->
<div class="container mt-2" style="max-width: 450px">
        <div class="text-center" >
            <div class="cardlog">
                <div class="card">
                    <div class="img1"><img class="card-img-top" src="../imagenes/wallpapergris.png"></div>
                        <div class="card-body">
                            <div class="img2 mx-auto" style="max-width: 200px;"><img class="img-fluid rounded-circle border border-2 border-dark" src="../imagenes/pngpolicia.png"></div>
                            <div class="h1"><?php echo $_SESSION['usuario'] ?></div>
                        </div>
                    </div>
                </div>      
            </div>   
        </div>
    </div>
</div> 

    <?php 
    /* Condición para saber si se encontró algun presente en el dia actual */
    if(mysqli_fetch_row($rta)){
    ?>
    <div class="container mx-auto my-4">
        <!-- Tabla para mostrar los presentes del dia actual --> 
        <table id="index" class="table table-striped dt-responsive nowrap border border-dark " style="width:100%">
            <caption>Presentismo</caption>
            <thead>
                <tr>
                    <td>Nombre</td> 
                    <td>Apellido</td> 
                    <td>Legajo</td> 
                    <td>Funcion</td> 
                    <td>Tipo de Movil</td> 
                    <td>Numero de Serie</td> 
                    <td>Estado</td>
                    <td>Fecha</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    /* Bucle para mostrar todas las tuplas traidas de la base de datos */
                    while ($mostrar = mysqli_fetch_array($rta))
                    {
                ?>
                    <tr>
                        <td> <?php echo $mostrar['nombre'] ?> </td> 
                        <td> <?php echo $mostrar['apellido'] ?> </td> 
                        <td> <?php echo $mostrar['legajo'] ?> </td> 
                        <td> <?php echo $mostrar['funcion'] ?> </td> 
                        <td> <?php echo $mostrar['tipo_movil'] ?> </td> 
                        <td> <?php echo $mostrar['nro_serie'] ?> </td> 
                        <td> <?php echo $mostrar['estado_movil'] ?> </td> 
                        <td> <?php echo $mostrar['fecha'] ?> </td> 
                    </tr>
                <?php    
                    }
                ?>
            <tbody>
        </table>
    </div>
    <?php    
        }
        else{
           echo "<p class='fs-5 fw-light text-start m-3'>Aun no hay presentes hoy</p>";
        }
    ?>

    <!-- Scripts para el funcionamiento dinámico de la tabla -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#index').DataTable({
                "language":{
                    /* Cambio de lenguaje al español */
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
                    "lengthMenu": "Mostrar de a _MENU_ registros",
                }   
            });
        });
    </script>    

<?php
    // 1) Inclusión del footer (realizado en un componente aparte ya que es la misma para todo el sistema de administradores )
    include("footerA.php");
?>