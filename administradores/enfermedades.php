<?php
    include("../sesion.php");
    include("../conexion.php");

    $sql="SELECT enfermedad.enfermedad_id, policias.nombre , policias.apellido , policias.legajo, 
    enfermedad.fecha, enfermedad.certificado
    FROM enfermedad INNER JOIN policias on enfermedad.policia_id = policias.policia_id";
    
    $rta= mysqli_query($conexion,$sql) or
    die("Problemas en el select:".mysqli_error($conexion));

    include("cabeceraA.php");

?>
    <div class="container mx-auto my-4">
    <table id="enfermedades" class="table table-striped dt-responsive nowrap border border-dark" style="width:100%">
        <caption>Enfermedades</caption>
        <thead>
            <tr>
                <td>Nombre</td> 
                 <td>Apellido</td> 
                <td>Legajo</td> 
                <td>Fecha</td> 
                <td>Certificado</td> 
            </tr>
        <thead>
        <tbody>  
    <?php
        while ($mostrar = mysqli_fetch_array($rta))
        {
    ?>
        <tr>
            <td> <?php echo $mostrar['nombre'] ?> </td> 
            <td> <?php echo $mostrar['apellido'] ?> </td> 
            <td> <?php echo $mostrar['legajo'] ?> </td> 
            <td> <?php echo $mostrar['fecha'] ?> </td> 
            <td><img src="data:image/jpg;base64,  <?php echo base64_encode($mostrar['certificado']) ?>" height="150px;" width="150px;"/> </td> 
        </tr>
    <?php    
        }
    ?>
        </tbody>
    </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#enfermedades').DataTable({
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",

                    "lengthMenu": "Mostrar de a _MENU_ registros",

                }
                
            });
        
        
        });
    </script>

</body>
</html>