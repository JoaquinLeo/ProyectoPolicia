<?php
    include("../sesion.php");
    include("../conexion.php");

    

    $sql = "SELECT movil_id,nro_serie,tipo_movil,estado,posesion FROM moviles
    where   (estado <> 'radiado' and estado <> 'borrado') 
    and (tipo_movil = 'cuatriciclo')  and posesion <> 1
    order by movil_id asc";

    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));

    if(isset($_REQUEST['seleccionar']))
    {
        
        $movil_id = $_REQUEST['movil_id'];
        $funcion = "chofer";
        $estado = $_REQUEST['estado'];
        $posesion = $_REQUEST['posesion'];
        $id = $_SESSION['id'];

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("Y-m-d H:i:s");
        
        $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) values 
        ('$id',$movil_id,'$funcion','$fecha', '$estado')";
        mysqli_query($conexion,$insert)
        or die("Problemas en el select".mysqli_error($conexion));

        $update = "UPDATE policias SET servicio='si' WHERE policia_id='$id'";
        mysqli_query($conexion,$update)
        or die("Problemas en el select".mysqli_error($conexion));

        $update2 = "UPDATE policia_movil SET movil_id='$movil_id' , funcion='$funcion' WHERE policia_id='$id'";
        mysqli_query($conexion,$update2)
        or die("Problemas en el select".mysqli_error($conexion));
            
        $update3 = "UPDATE moviles SET posesion = 1 WHERE movil_id = '$movil_id'";
        mysqli_query($conexion,$update3)
        or die("Problemas en el select".mysqli_error($conexion));

        $var = "Su presente fue dado con exito";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
        
    }

        include("cabeceraU.php");
?>
    <div class="container mx-auto my-4">
        <table id="cuatriciclos" class="table table-striped dt-responsive nowrap border border-dark " style="width:100%">
        <caption>Moviles Policiales</caption>
        <thead>
            <tr>
                <th>Numero</th> 
                <th>Nro Serie</th> 
                <th>Tipo de Movil</th> 
                <th>Estado</th>  
                <th>Opciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php  
                $contador=1;
                while($mostrar = mysqli_fetch_array($rta)){
                    
            ?>
            <tr>
                <td><?php echo $contador?></td>
                <td><?php echo $mostrar['nro_serie']?></td>
                <td><?php echo $mostrar['tipo_movil']?></td>
                <td><?php echo $mostrar['estado']?></td>
                
                    <form method="POST">

                        <td>
                            <?php
                                if($mostrar['posesion']==0){
                            ?>  
                                <input type="hidden" name="estado"  value="<?= $mostrar['estado'] ?>">
                                <input type="hidden" name="movil_id"  value="<?= $mostrar['movil_id'] ?>">
                                <input type="hidden" name="posesion"  value="<?= $mostrar['posesion'] ?>">
                                <input class="btn btn-secondary btn-sm" type="submit" value="seleccionar" name="seleccionar">
                            <?php
                                }
                            ?>
                        </td>     

                    </form>        
                
            </tr>
            
            <?php
                $contador++;
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
            $('#cuatriciclos').DataTable({
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",

                    "lengthMenu": "Mostrar de a _MENU_ registros",

                }
                
            });
        
        
        });
    </script>        
    
</body>
</html>
