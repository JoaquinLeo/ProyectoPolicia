<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 21) Control del tipo de usuario */
    include("controlU.php");

    /* 84) Consulta a la base de datos para traer y mostrar los cuatriciclos */
    $sql = "SELECT movil_id,nro_serie,tipo_movil,estado,posesion FROM moviles
    where   (estado <> 'radiado' and estado <> 'borrado') 
    and (tipo_movil = 'cuatriciclo')  and posesion <> 1
    order by movil_id asc";
    $rta = mysqli_query($conexion,$sql) or 
    die("Problemas en el select:".mysqli_error($conexion));
    /* --------------------------------------------------------------- */

    /* 85) Condición para saber si envió el formulario */
    if(isset($_REQUEST['seleccionar']))
    {
        /* 86) Captura de los datos del formulario */
        $movil_id = $_REQUEST['movil_id'];
        $funcion = "chofer";
        $estado = $_REQUEST['estado'];
        $id = $_SESSION['id'];
        /* ----------------------------------- */
         
        /* 49) Fijación de la zona horaria para trabajar con fechas */
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("Y-m-d H:i:s");
        /* ---------------------------------------------------- */

        /* 87) Inserción del presentismo en la base de datos  */
        $insert="INSERT INTO presentismo(policia_id,movil_id,funcion,fecha,estado_movil) 
        values ('$id',$movil_id,'$funcion','$fecha', '$estado')";
        mysqli_query($conexion,$insert)
        or die("Problemas en el insert".mysqli_error($conexion));
        /* ------------------------------------------------- */

        /* 88) Actualización del servicio del usuario en la base de datos (servicio -> si) */
        $update = "UPDATE policias SET servicio='si' WHERE policia_id='$id'";
        mysqli_query($conexion,$update)
        or die("Problemas en el update".mysqli_error($conexion));
        /* ------------------------------------------------- */ 

        /* 89) Vinculación de la relación policia-vehiculo */
        $update2 = "UPDATE policia_movil SET movil_id='$movil_id' , funcion='$funcion' WHERE policia_id='$id'";
        mysqli_query($conexion,$update2)
        or die("Problemas en el update".mysqli_error($conexion));
        /* ------------------------------------------------- */ 

        /* 90) Al cuatriciclo en cuestion se la actualiza con un 1 indicando que esta ocupado */             
        $update3 = "UPDATE moviles SET posesion = 1 WHERE movil_id = '$movil_id'";
        mysqli_query($conexion,$update3)
        or die("Problemas en el update".mysqli_error($conexion));
        /* ------------------------------------------------- */ 

        /* 91) Alerta para indicar que el presente fue dado con existo */
        $var = "Su presente fue dado con exito";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
        
    }
    mysqli_close($conexion);
    // 38) Inclusión de la cabecera 
    include("cabeceraU.php");
?>

    <div class="container mx-auto my-4 section-content">
        <!-- 92) Tabla para mostrar los cuatriciclos --> 
        <table id="cuatriciclos" class="table table-striped dt-responsive nowrap border border-dark " style="width:100%">
            <caption>Cuatriciclos Policiales</caption>
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
                    /* 93) Bucle para mostrar todas las tuplas traidas de la base de datos */
                    while($mostrar = mysqli_fetch_array($rta)){   
                ?>
                <tr>
                    <td><?php echo $contador?></td>
                    <td><?php echo $mostrar['nro_serie']?></td>
                    <td><?php echo $mostrar['tipo_movil']?></td>
                    <td><?php echo $mostrar['estado']?></td>
                    <!-- 94) Formulario para seleccionar el cuatriciclo --> 
                    <form method="POST">
                        <td>
                            <input type="hidden" name="estado"  value="<?= $mostrar['estado'] ?>">
                            <input type="hidden" name="movil_id"  value="<?= $mostrar['movil_id'] ?>">
                            <input class="btn btn-secondary btn-sm" type="submit" value="seleccionar" name="seleccionar">
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

    <!-- 72) Scripts para el funcionamiento dinámico de la tabla -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#cuatriciclos').DataTable({
                "language":{
                    /* 73) Cambio de lenguaje al español */
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
                    "lengthMenu": "Mostrar de a _MENU_ registros",
                }
            });
        });
    </script>        
    
<?php
    // 41) Inclusión del footer 
    include("footerU.php");
?>
