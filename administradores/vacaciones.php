<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 106) Control del tipo de usuario */
    include("controlA.php");

    /* 139) Funcion para calcular los dias pedidos de vacaciones */
    function diasPedidos($fecha1 , $fecha2){
        $segundosFecha1 = strtotime( $fecha1 );
        $segundosFecha2 = strtotime( $fecha2 );
        $diasPedidos = ($segundosFecha2 - $segundosFecha1)/86400;
        return $diasPedidos;
    }
    /* ---------------------------------------------------- */

    /* 49) Fijación de la zona horaria para trabajar con fechas */
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");
    /* ---------------------------------------------------- */

    /* 140) Consulta a la base de datos para traer y mostrar las vacaciones pedidas */
    $sql="SELECT vacaciones.vacaciones_id, policias.policia_id, policias.nombre, 
    policias.apellido, policias.legajo, vacaciones.fecha_inicio, 
    vacaciones.fecha_fin, vacaciones.estado, policias.dias_vacaciones
    FROM vacaciones INNER JOIN policias on vacaciones.policia_id = policias.policia_id
    WHERE vacaciones.estado <> 'borrado' ";
    $rta= mysqli_query($conexion,$sql) 
    or die("Problemas en el select:".mysqli_error($conexion));
    /* ---------------------------------------------------- */

    /* 141) Captura de los datos del formulario */  
    $opcion = (isset($_REQUEST['opcion']))?$_REQUEST['opcion']:"";
    $vacacionesId = (isset($_REQUEST['vacaciones_id']))?$_REQUEST['vacaciones_id']:"";
    $policiaId = (isset($_REQUEST['policia_id']))?$_REQUEST['policia_id']:"";
    $dias_vacaciones = (isset($_REQUEST['dias_vacaciones']))?$_REQUEST['dias_vacaciones']:"";
    $dias_pedidos = (isset($_REQUEST['dias_pedidos']))?$_REQUEST['dias_pedidos']:"";
    $estado = (isset($_REQUEST['estado']))?$_REQUEST['estado']:"";
    /* ----------------------------------- */  

    /* 142) Condición para saber que boton se presionó */
    switch($opcion){

        case "Aceptar" : 
            /* 143) Condición para saber si el usuario pidió menos dias de los que tiene disponibles */
            if($dias_vacaciones > $dias_pedidos){

                $diasRestantes = $dias_vacaciones - $dias_pedidos;
                /* 144) Actualización del estado de las vacaciones en la base de datos */
                $sql2 = "UPDATE vacaciones SET estado='aceptado' WHERE vacaciones_id='$vacacionesId'";
                if(!mysqli_query($conexion,$sql2)) {
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }
                /* ----------------------------------- */  
                /* 145) Actualización de la cantidad de dias restantes de vacaciones en la base de datos */
                $sql3 = "UPDATE policias SET dias_vacaciones='$diasRestantes' WHERE policia_id='$policiaId'";
                if(!mysqli_query($conexion,$sql3)) {
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }
                /* ----------------------------------- */ 
                /* 146) Alerta para indicar que las vacaciones fueron aceptas con exito */
                $var = "Se han aceptado las vacaciones";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
            }
            else{
                /* 147) Alerta para indicar que no se pueden aceptar las vacaciones por falta de suficientes dias */
                $var = "No es posible aceptar estas vacaciones ya que se estan pidiendo mas dias de los disponibles";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
            }
            break;

        case "Rechazar" : 
                /* 148) Actualización del estado de las vacaciones en la base de datos */
                $sql2 = "UPDATE vacaciones SET estado='rechazado' WHERE vacaciones_id='$vacacionesId'";
                if(mysqli_query($conexion,$sql2)) {
                    /* 149) Alerta para indicar que las vacaciones fueron rechazadas con exito */
                    $var = "Se han rechazado las vacaciones";
                    echo "<script> alert('".$var."');</script>";
                    echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
                }
                else{
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }
                break;

        case "Seleccionar" : 
            /* 150) Consulta a la base de datos para traer y mostrar los datos del usuario seleccionado */
            $sql3 = "SELECT vacaciones.vacaciones_id, policias.policia_id, 
            policias.nombre, policias.apellido, policias.legajo, vacaciones.fecha_inicio, 
            vacaciones.fecha_fin, vacaciones.estado, policias.dias_vacaciones
            FROM vacaciones INNER JOIN policias on vacaciones.policia_id = policias.policia_id
            WHERE vacaciones_id = '$vacacionesId'";
            $rta2 = mysqli_query($conexion,$sql3) 
            or die("Problemas en el select:".mysqli_error($conexion));
            /* ----------------------------------- */ 

            /* 151) Se almacenan los datos traidos del usuario en variables */
            $seleccion = mysqli_fetch_array($rta2);
            $nombre= $seleccion['nombre'] ; 
            $apellido= $seleccion['apellido'] ; 
            $legajo= $seleccion['legajo'] ; 
            $fechainicio= $seleccion['fecha_inicio'] ; 
            $fechafin= $seleccion['fecha_fin'] ; 
            $estado = $seleccion['estado'] ; 
            $diasVacaciones = $seleccion['dias_vacaciones'] ; 
            $policiaId = $seleccion['policia_id'] ;
            /* ----------------------------------- */ 
            break;

        case "Modificar": 
            /* 152) Condición para saber a que estado se actualizó el pedido de vacaciones */
            if($estado == "rechazado"){

                $diasRestantes = $dias_vacaciones + $dias_pedidos;

                /* 153) Actualización del estado de las vacaciones en la base de datos */
                $sql2 = "UPDATE vacaciones SET estado='rechazado' WHERE vacaciones_id='$vacacionesId'";
                if(!mysqli_query($conexion,$sql2)) {
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }
                /* ----------------------------------- */ 

                /* 154) Actualización de la cantidad de dias restantes de vacaciones en la base de datos */
                $sql3 = "UPDATE policias SET dias_vacaciones='$diasRestantes' WHERE policia_id='$policiaId'";
                if(!mysqli_query($conexion,$sql3)) {
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }
                /* ----------------------------------- */ 

                /* 155) Alerta para indicar que el cambio fue realizado con exito */
                $var = "Se ha aceptado el cambio. Aceptado actualizado a Rechazado";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>"; 
            }
   
            else{
                /* 156) Condición para saber si el usuario pidió menos dias de los que tiene disponibles */
                if($dias_vacaciones > $dias_pedidos){

                    $diasRestantes = $dias_vacaciones - $dias_pedidos;
                    /* 157) Actualización del estado de las vacaciones en la base de datos */
                    $sql2 = "UPDATE vacaciones SET estado='aceptado' WHERE vacaciones_id='$vacacionesId'";
                    if(!mysqli_query($conexion,$sql2)) {
                        echo "Error".$sql2."<br/>".mysqli_error($conexion);
                    }
                    /* ----------------------------------- */  
                    /* 158) Actualización de la cantidad de dias restantes de vacaciones en la base de datos */
                    $sql3 = "UPDATE policias SET dias_vacaciones='$diasRestantes' WHERE policia_id='$policiaId'";
                    if(!mysqli_query($conexion,$sql3)) {
                        echo "Error".$sql2."<br/>".mysqli_error($conexion);
                    }
                    /* ----------------------------------- */  
                    /* 159) Alerta para indicar que el cambio fue realizado con exito */
                    $var = "Se ha aceptado el cambio. Rechazado actualizado a Aceptado";
                    echo "<script> alert('".$var."');</script>";
                    echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
                }
                else{
                    /* 160) Alerta para indicar que el cambio no se pudo realizar por falta de suficientes dias */
                    $var = "Cambio denegado. No es posible aceptar estas vacaciones ya que se estan pidiendo mas dias de los disponibles";
                    echo "<script> alert('".$var."');</script>";
                    echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
                }
            }
            break;

        case "Borrar" : 
            /* 161) Actualización del estado de la vacacion en la base de datos */
            $sql2 = "UPDATE vacaciones SET estado = 'borrado' WHERE vacaciones_id='$vacacionesId'";
            if(mysqli_query($conexion,$sql2)) {
                /* 162) Alerta para indicar que se borró con exito */
                $var = "Borrado con exito";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vacaciones.php'; }, 10 ); </script>";
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* -------------------------------------------------------- */
    }
    mysqli_close($conexion);
    // 108) Inclusión de la cabecera
    include("cabeceraA.php");
?>

    <div class="container mx-auto my-4 section-content">
        <!-- 163) Formulario para mostrar los pedidos de vacaciones --> 
        <table id="vacaciones" class="table table-striped dt-responsive nowrap border border-dark " style="width:100%">
            <caption>Vacaciones</caption>
            <thead>
                <tr>
                    <th>Nombre</th> 
                    <th>Apellido</th> 
                    <th>Legajo</th> 
                    <th>Fecha de Inicio</td> 
                    <th>Fecha de Fin</th>
                    <th>Estado</th>
                    <th>Dias pedidos</th> 
                    <th>Dias disponibles</th>    
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>   
                <?php
                    /* 164) Bucle para mostrar todas las tuplas traidas de la base de datos */
                    while ($mostrar = mysqli_fetch_array($rta))
                    {
                ?>
                    <tr>
                        <td> <?php echo $mostrar['nombre'] ?> </td> 
                        <td> <?php echo $mostrar['apellido'] ?> </td> 
                        <td> <?php echo $mostrar['legajo'] ?> </td> 
                        <td> <?php echo $mostrar['fecha_inicio'] ?> </td> 
                        <td> <?php echo $mostrar['fecha_fin'] ?> </td> 
                        <td> <?php echo $mostrar['estado'] ?> </td> 
                        <td> 
                            <?php 
                                echo diasPedidos($mostrar['fecha_inicio'], $mostrar['fecha_fin']);
                            ?> 
                        </td> 
                        <td> <?php echo $mostrar['dias_vacaciones'] ?> </td> 
                        <td>
                            <!-- 165) Formulario para seleccionar vacaciones --> 
                            <form method="POST">
                                <input type="hidden" name="vacaciones_id"  value="<?= $mostrar['vacaciones_id'] ?>">
                                <input type="hidden" name="policia_id"  value="<?= $mostrar['policia_id'] ?>">
                                <input type="hidden" name="dias_vacaciones"  value="<?= $mostrar['dias_vacaciones'] ?>">
                                <input type="hidden" name="dias_pedidos"  value="<?= diasPedidos($mostrar['fecha_inicio'], $mostrar['fecha_fin']); ?>">
                                <input class="btn btn-outline-secondary btn-sm" type="submit" name="opcion" <?php echo ($mostrar['estado']!="espera")?"disabled":"";  ?> value="Aceptar">
                                <input class="btn btn-outline-secondary btn-sm" type="submit" name="opcion" <?php echo ($mostrar['estado']!="espera")?"disabled":"";  ?> value="Rechazar">
                                <input class="btn btn-secondary btn-sm" type="submit" name="opcion" <?php echo ($mostrar['estado']=="espera")?"disabled":"";  ?> value="Seleccionar">
                                <input class="btn btn-danger btn-sm" type="submit" name="opcion" value="Borrar">
                            </form>     
                        </td>
                    </tr>
                <?php    
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php 
        /* 166) Condición para saber si envió el formulario con la opcion de seleccionar*/
        if(isset($_REQUEST['opcion']) && $_REQUEST['opcion']=="Seleccionar"){
    ?>
        <br><br>
    <div class="conteiner1 mb-4">
        <div class="card text-bg-light mx-auto " style="max-width: 18rem;">
            <div class="card-header fs-5 fw-bold">Editar Vacaciones</div>
        <div class="card-body">
            <!-- 167) Formulario modificar vacaciones --> 
            <form method="POST">
                <input type="hidden" name="vacaciones_id" value="<?php echo $vacacionesId;?>">
                <input type="hidden" name="policia_id" value="<?php echo $policiaId;?>">
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Nombre:</p> <?php echo $nombre ?>
                </div>
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Apellido:</p> <?php echo $apellido;?>
                </div>
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Legajo:</p> <?php echo $legajo;?>
                </div>
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Fecha Inicio:</p> <?php echo $fechainicio;?>
                </div>
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Fecha Fin:</p> <?php echo $fechafin;?>
                </div>
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Estado Actual:</p> <?php echo $estado;?>
                </div>
                <div class="d-flex">
                    <p class="fs-6 fw-semibold me-1">Cambiar a:</p>
                </div>
                    <select class="form-select" name="estado">
                        <?php 
                            if($estado == "rechazado"){
                        ?>
                        <option value="aceptado" >Aceptado</option>
                        <?php 
                            }
                            else{ 
                        ?>
                        <option value="rechazado" >Rechazado</option>
                        <?php 
                            }
                        ?>
                    </select>
                <div class="d-flex mt-3">
                    <p class="fs-6 fw-semibold me-1">Dias Vacaciones:</p> <?php echo $diasVacaciones;?>
                    <input type="hidden" name="dias_vacaciones"  value="<?= $diasVacaciones; ?>">
                </div>
                    <div class="d-flex">
                <p class="fs-6 fw-semibold me-1">Dias Pedidos:</p> <?php echo diasPedidos($fechainicio, $fechafin);?>
                    <input type="hidden" name="dias_pedidos"  value="<?= diasPedidos($fechainicio, $fechafin); ?>">
                </div>
                <input class="btn btn-primary btn-sm " type="submit" name="opcion" value="Modificar">
            </form>
        </div>
        </div>
    </div>
    <?php 
        }
    ?>

    <!-- 72) Scripts para el funcionamiento dinámico de la tabla -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#vacaciones').DataTable({
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