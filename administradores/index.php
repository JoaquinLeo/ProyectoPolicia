<?php
    include("../conexion.php");
    include("../sesion.php");
    /*if($_SESSION['nivel_usuario'] != "admin"){
        echo "usted no tiene autorizacion";

        ?>
        <br><a href="../index.php">Volver al Inicio</a>
        <?php
        die();
    }*/
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");

    $sql = "SELECT policias.nombre , policias.apellido , policias.legajo , 
    COALESCE(moviles.tipo_movil,'-') AS tipo_movil , COALESCE(moviles.nro_serie,'-') AS nro_serie, 
    presentismo.funcion , presentismo.fecha , 
    COALESCE(presentismo.estado_movil,'-') AS estado_movil FROM policias 
    INNER JOIN presentismo on presentismo.policia_id = policias.policia_id 
    LEFT JOIN moviles on moviles.movil_id = presentismo.movil_id 
    WHERE date(presentismo.fecha)='$fecha'
    ORDER BY presentismo.fecha ASC"; 
    
    $rta= mysqli_query($conexion,$sql)
    or die("Problemas en el select".mysqli_error($conexion));

    include("cabeceraA.php");

?>


    <h3 class="display-3 text-start m-3">Bienvenido <?php echo $_SESSION['usuario'] ?></h3>

    <?php 
    if(mysqli_fetch_row($rta)){
    ?>
    <div class="container mx-auto my-4">
    <table id="index" class="table table-striped dt-responsive nowrap border border-dark " style="width:100%">
        <caption>Presentismo</caption>
        <thead>
        <tr>
            <td>Nombre</td> 
            <td>Apellido</td> 
            <td>Legajo</td> 
            <td>Tipo de Movil</td> 
            <td>Numero de Serie</td> 
            <td>Estado</td>
            <td>Fecha</td>
        </tr>
    </thead>
    <tbody>
    <?php
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
    <tbody>
    </table>
    </div>
    <?php    
        }
        else{
           echo "<p class='fs-5 fw-light text-start m-3'>Aun no hay presentes hoy</p>";
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#index').DataTable({
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",

                    "lengthMenu": "Mostrar de a _MENU_ registros",

                }
                
            });
        
        
        });
    </script>    

</body>
</html>