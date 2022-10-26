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

    $sql = "SELECT policias.nombre , policias.apellido , policias.legajo , 
    COALESCE(moviles.tipo_movil,'-') AS tipo_movil , COALESCE(moviles.nro_serie,'-') AS nro_serie, 
    presentismo.funcion , presentismo.fecha , 
    COALESCE(presentismo.estado_movil,'-') AS estado_movil FROM policias 
    INNER JOIN presentismo on presentismo.policia_id = policias.policia_id 
    LEFT JOIN moviles on moviles.movil_id = presentismo.movil_id 

    ORDER BY presentismo.fecha ASC"; 
    
    $rta= mysqli_query($conexion,$sql)
    or die("Problemas en el select".mysqli_error($conexion));

    include("cabeceraA.php");

?>
    <!-- <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></link>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"></link>

    </head> -->

   <div class="container mt-4"> 
    <table id="present" class="table table-striped display responsive nowrap" style="width:100%">
        <caption>Presentismo</caption>
        <tr>
            <th>Nombre</th> 
            <th>Apellido</th> 
            <th>Legajo</th> 
            <th>Tipo de Movil</th> 
            <th>Numero de Serie</th> 
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
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

    </table>
    </div>

        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function () {
            $('#present').DataTable();
        });
        </script> -->

    
</body>
</html>