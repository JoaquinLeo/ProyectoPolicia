<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 106) Control del tipo de usuario */
    include("controlA.php");

    /* 117) Consulta a la base de datos para traer y mostrar el historial del presentismo */
    $sql = "SELECT policias.nombre, policias.apellido, policias.legajo, 
    COALESCE(moviles.tipo_movil,'-') AS tipo_movil, 
    COALESCE(moviles.nro_serie,'-') AS nro_serie, 
    presentismo.funcion , presentismo.fecha, 
    COALESCE(presentismo.estado_movil,'-') AS estado_movil FROM policias 
    INNER JOIN presentismo on presentismo.policia_id = policias.policia_id 
    LEFT JOIN moviles on moviles.movil_id = presentismo.movil_id 
    ORDER BY presentismo.fecha ASC"; 
    $rta= mysqli_query($conexion,$sql)
    or die("Problemas en el select".mysqli_error($conexion));
    /* ----------------------------------------------------------------------------- */
    mysqli_close($conexion);
    // 108) Inclusión de la cabecera 
    include("cabeceraA.php");
?>

    <div class="container mx-auto my-4 section-content">
        <!-- 118) Tabla para mostrar el historial del presentismo --> 
        <table id="historial" class="table table-striped dt-responsive nowrap border border-dark " style="width:100%">
            <caption>Presentismo</caption>
            <thead>
                <tr>
                    <th>Nombre</th> 
                    <th>Apellido</th> 
                    <th>Legajo</th> 
                    <th>Tipo de Movil</th> 
                    <th>Numero de Serie</th> 
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            <thead>
            <tbody>
                <?php
                    /* 119) Bucle para mostrar todas las tuplas traidas de la base de datos */
                    while ($mostrar = mysqli_fetch_array($rta))
                    {
                ?>
                    <tr>
                        <td> <?php echo $mostrar['nombre'] ?> </td> 
                        <td> <?php echo $mostrar['apellido'] ?> </td> 
                        <td> <?php echo $mostrar['legajo'] ?> </td> 
                        <td> <?php echo $mostrar['tipo_movil'] ?> </td> 
                        <td> <?php echo $mostrar['nro_serie'] ?> </td> 
                        <td> <?php echo $mostrar['estado_movil'] ?> </td> 
                        <td> <?php echo $mostrar['fecha'] ?> </td> 
                    </tr>
                <?php    
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- 72) Scripts para el funcionamiento dinámico de la tabla -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#historial').DataTable({
                "language":{
                    /* 73) Cambio de lenguaje al español */
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
                    "lengthMenu": "Mostrar de a _MENU_ registros",
                } 
            });
        });
    </script>
    
    <?php
    // 113) Inclusión del footer
    include("footerA.php");
?>