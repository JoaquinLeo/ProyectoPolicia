<?php
    /* 20) Validación de una sesión */
    include("../sesion.php");
    /* 5) Conexion a la base de datos */
    include("../conexion.php");
    /* 106) Control del tipo de usuario */
    include("controlA.php");

    /* 171) Consulta a la base de datos para traer y mostrar los vehiculos */
    $sql="SELECT movil_id , nro_serie ,tipo_movil , estado , posesion 
    FROM moviles WHERE estado <>'borrado' ";
    $rta= mysqli_query($conexion,$sql) 
    or die("Problemas en el select:".mysqli_error($conexion));
    /* -------------------------------------------------------------- */

    /* 172) Captura de los datos del formulario */  
    $opcion = (isset($_REQUEST['opcion']))?$_REQUEST['opcion']:"";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    $posesion = (isset($_REQUEST['posesion']))?$_REQUEST['posesion']:"";
    $tipo_movil = (isset($_REQUEST['tipo_movil']))?$_REQUEST['tipo_movil']:"";
    $estado= (isset($_REQUEST['estado']))?$_REQUEST['estado']:"";
    $nro_serie= (isset($_REQUEST['nro_serie']))?$_REQUEST['nro_serie']:"";; 
    $descripcion= (isset($_REQUEST['descripcion']))?$_REQUEST['descripcion']:"";; 
    /* -------------------------------------------------------------- */

    /* 173) Condición para saber que boton se presionó */
    switch($opcion){

        case "Borrar" : 
            /* 49) Fijación de la zona horaria para trabajar con fechas */
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fecha = date("Y-m-d H:i:s");
            /* ---------------------------------------------------- */

            /* 174) Actualización del estado del usuario en la base de datos */
            $sql2 = "UPDATE moviles SET estado='borrado' , fecha_borrado='$fecha' WHERE movil_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                /* 175) Alerta para indicar que se borró con exito */
                $var = "Borrado con exito";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vehiculos.php'; }, 10 ); </script>";
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* ---------------------------------------------------- */

        case "Seleccionar" : 
            /* 176) Consulta a la base de datos para traer y mostrar los datos del vehiculo seleccionado */
            $sql3 = "SELECT * FROM moviles WHERE movil_id='$id'";
            $rta2 = mysqli_query($conexion,$sql3) or
            die("Problemas en el select:".mysqli_error($conexion));
            /* ----------------------------------- */ 

            /* 177) Se almacenan los datos traidos del usuario en variables */
            $seleccion = mysqli_fetch_array($rta2);
            $posesion= $seleccion['posesion'] ; 
            $tipo_movil= $seleccion['tipo_movil'] ; 
            $nro_serie= $seleccion['nro_serie'] ; 
            $estado= $seleccion['estado'] ; 
            $descripcion = $seleccion['descripcion'];
            /* ----------------------------------- */ 
            break;

        case "Modificar" : 
            /* 178) Actualización de las modificaciones del vehiculo en la base de datos */
            $sql2 = "UPDATE moviles SET posesion='$posesion', tipo_movil='$tipo_movil', estado='$estado',
            nro_serie='$nro_serie' , descripcion='$descripcion' WHERE movil_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                /* 179) Alerta para indicar que el cambio fue realizado con exito */
                $var = "Modificación realizada con exito";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vehiculos.php'; }, 10 ); </script>";
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* ----------------------------------- */ 

        case "Agregar" : 
            /* 180) Inserción del nuevo vehiculo en la base de datos  */
            $sql2 = "INSERT INTO moviles(nro_serie, tipo_movil, estado, posesion) 
            values ('$nro_serie','$tipo_movil','$estado','$posesion')";
            if(mysqli_query($conexion,$sql2)) {
                /* 181) Alerta para indicar que se agregó con exito */
                $var = "Vehiculo agregado con exito";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'vehiculos.php'; }, 10 ); </script>";
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* ----------------------------------- */ 
    }
    mysqli_close($conexion);
    // 108) Inclusión de la cabecera     
    include("cabeceraA.php");
?>

    <div class="container mx-auto my-4 section-content">
        <!-- 182) Tabla para mostrar los vehiculos  -->   
        <table id="vehiculos" class="table table-striped dt-responsive nowrap border border-dark" style="width:100%">
            <caption>Moviles</caption>
            <thead>
            <tr>
                <td>Numero</td> 
                <td>Numero de Serie</td> 
                <td>Tipo de Movil</td> 
                <td>Estado</td> 
                <td>Posesion</td> 
                <td>Opciones</td>
            </tr>
            <thead>
            <tbody>
            <?php
                $numero=1;
                /* 183) Bucle para mostrar todas las tuplas traidas de la base de datos */
                while ($mostrar = mysqli_fetch_array($rta))
                {
            ?>
                <tr>
                    <td> <?php echo $numero ?> </td> 
                    <td> <?php echo $mostrar['nro_serie'] ?> </td> 
                    <td> <?php echo $mostrar['tipo_movil'] ?> </td> 
                    <td> <?php echo $mostrar['estado'] ?> </td> 
                    <td> 
                        <?php 
                            if($mostrar['posesion'] == 0){
                                echo "no";
                            }
                            else{
                                echo"si";
                            }
                        ?> 
                    </td> 
                    <td>
                        <!-- 184) Formulario para seleccionar los vehiculos  -->   
                        <form method="POST">
                            <input type="hidden" name="id"  value="<?= $mostrar['movil_id'] ?>">
                            <input class="btn btn-secondary btn-sm" type="submit" name="opcion" value="Seleccionar">
                            <input class="btn btn-danger btn-sm" type="submit" name="opcion" value="Borrar">
                        </form>     
                    </td>
                </tr>
            <?php    
                $numero++;
                }
            ?>
            </tbody>
        </table>
    </div>
    
    <div class="container mb-4">
        <div class="row justify-content-md-center">
            <div  class="col col-md-auto">
                <div class="card text-bg-light" style="max-width: 18rem;">
                    <div class="card-header fs-5 fw-bold">Modificar vehiculos</div>
                    <div class="card-body">
                        <!-- 185) Formulario para modificar vehiculos  -->   
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <p class="fs-6 fw-semibold me-1 mb-1">Numero de Serie actual:</p>
                            <input class="form-control mb-4" id="floatingPassword" type="text" name="nro_serie" 
                            value="<?php echo $nro_serie;?>" placeholder="nro_serie">
                            <div class="d-flex">
                            <p class="fs-6 fw-semibold me-1 mb-1">Estado actual:<P> <?php echo $estado;?>
                            </div>
                            <select class="form-select mb-4" name="estado"> 
                                <option value="bien" <?php echo ($estado=="bien")?"selected":""; ?> >Bien</option>
                                <option value="regular"  <?php echo ($estado=="regular")?"selected":""; ?> >Regular</option>
                                <option value="radiado" <?php echo ($estado=="radiado")?"selected":""; ?> >Radiado</option>
                            </select>
                            <div class="d-flex">
                            <p class="fs-6 fw-semibold me-1 mb-1">Posesion actual:</p> <?php if($posesion == 0)echo "no"; else echo"si"; ?>
                            </div>
                            <select class="form-select mb-4" name="posesion">
                                <option value="si" <?php echo ($posesion==1)?"selected":""; ?> >Si</option>
                                <option value="no" <?php echo ($posesion==0)?"selected":""; ?> >No</option>
                            </select>
                            <div class="d-flex">
                            <p class="fs-6 fw-semibold me-1 mb-1">Tipo de movil actual:</p><?php echo $tipo_movil;?>
                            </div>
                            <select class="form-select mb-4" name="tipo_movil">
                                <option value="auto" <?php echo ($tipo_movil=="auto")?"selected":""; ?> >Auto</option>
                                <option value="camioneta" <?php echo ($tipo_movil=="camioneta")?"selected":""; ?> >Camioneta</option>
                                <option value="cuatriciclo" <?php echo ($tipo_movil=="cuatriciclo")?"selected":""; ?> >Cuatriciclo</option>
                                <option value="bicicleta" <?php echo ($tipo_movil=="bicicleta")?"selected":""; ?> >Bicicleta</option>
                            </select>
                            <p class="fs-6 fw-semibold me-1 mb-1">Descripcion actual:</p>
                            <div class="form-floating mb-4">
                            <textarea class="form-control" name="descripcion" cols="25" rows="10" maxlength="250"><?php echo $descripcion;?></textarea>
                            </div>
                            <input class="btn btn-primary btn-sm boton" type="submit" name="opcion" value="Modificar">
                        </form>
                    </div>
                </div>
            </div>

        <div class="col col-md-auto">
            <div class="card text-bg-light" style="max-width: 18rem;">
                <div class="card-header fs-5 fw-bold">Agregar vehiculos</div>
                    <div class="card-body">
                        <!-- 186) Formulario para agregar los vehiculos  -->
                        <form method="POST">
                            <p class="fs-6 fw-semibold me-1 mb-1">Numero de Serie:</p>
                            <input class="form-control mb-4" id="floatingPassword" type="text" name="nro_serie" placeholder="nro_serie" required>
                            <p class="fs-6 fw-semibold me-1 mb-1">Estado:</p>
                            <select class="form-select mb-4" name="estado"> 
                                <option value="bien" >Bien</option>
                                <option value="regular" >Regular</option>
                                <option value="radiado" >Radiado</option>
                            </select>
                            <p class="fs-6 fw-semibold me-1 mb-1">Posesion:</p>
                            <select class="form-select mb-4" name="posesion">
                                <option value="si">Si</option>
                                <option value="no" selected>No</option>
                            </select>
                            <p class="fs-6 fw-semibold me-1 mb-1">Tipo de movil:</p>
                            <select class="form-select mb-4" name="tipo_movil">
                                <option value="auto">Auto</option>
                                <option value="camioneta">Camioneta</option>
                                <option value="cuatriciclo">Cuatriciclo</option>
                                <option value="bicicleta">Bicicleta</option>
                            </select>
                            <input class="btn btn-primary btn-sm " type="submit" name="opcion" value="Agregar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 72) Scripts para el funcionamiento dinámico de la tabla -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#vehiculos').DataTable({
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