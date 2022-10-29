<?php
    /* Validación de una sesión */
    include("../sesion.php");
    /* Conexion a la base de datos */
    include("../conexion.php");
    /* Control del tipo de usuario */
    include("controlA.php");

    /* Consulta a la base de datos para traer y mostrar los ingresantes */
    $sql="SELECT * FROM policias WHERE estado <>'borrado'";
    $rta= mysqli_query($conexion,$sql) 
    or die("Problemas en el select:".mysqli_error($conexion));
    /* ---------------------------------------------------------------- */


    // CONDICION TERNARIA    ESTA ES LA CONDICION       SE CUMPLE           NO SE CUMPLE
    /* Captura de los datos del formulario */       
    $opcion =             (isset($_REQUEST['opcion']))?$_REQUEST['opcion']  :     "";
    $id = (isset($_REQUEST['id']))?$_REQUEST['id'] : "";

    $seleccion = (isset($_REQUEST['seleccion']))?$_REQUEST['seleccion']:"";
    $busqueda = (isset($_REQUEST['busqueda']))?$_REQUEST['busqueda']:"";

    $nombre= (isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"";
    $apellido= (isset($_REQUEST['apellido']))?$_REQUEST['apellido']:"";; 
    $legajo= (isset($_REQUEST['legajo']))?$_REQUEST['legajo']:"";
    $nivel_usuario= (isset($_REQUEST['nivel_usuario']))?$_REQUEST['nivel_usuario']:"";
    $estado= (isset($_REQUEST['estado']))?$_REQUEST['estado']:"";
    /* ---------------------------------- */

    /* Condición para saber que boton se presionó */
    switch($opcion){

        case "Aceptar" : 
            /* Actualización del estado del usuario en la base de datos */
            $sql2 = "UPDATE policias SET estado='aceptado' WHERE policia_id='$id'";
            if(!mysqli_query($conexion,$sql2)) {
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            /* -------------------------------------------------------- */

            /* 6) Condición para saber el estado del usuario */
            if($estado == "espera"){
                /* 6) Inserción del usuario en la tabla de vinculacion policia-vehiculo */
                $sql2 = "INSERT INTO policia_movil (policia_id , movil_id , funcion) 
                VALUES ('$id',NULL,NULL)";

                if(!mysqli_query($conexion,$sql2)) {
                    echo "Error".$sql2."<br/>".mysqli_error($conexion);
                }
                /* -------------------------------------------------------- */
            }   

            else{
                /* Consulta a la base de datos para saber si el usuario ya posee la vinculación policia-vehiculo */
                $sql2 = "SELECT * FROM policia_movil WHERE policia_id = '$id'";
                $rta2= mysqli_query($conexion,$sql2) 
                or die("Problemas en el select:".mysqli_error($conexion));
                /* -------------------------------------------------------- */
                /* Si no posee dicha vinculación */
                if(!mysqli_fetch_array($rta2)){
                    /* 6) Inserción del usuario en la tabla de vinculacion policia-vehiculo */
                    $sql2 = "INSERT INTO policia_movil (policia_id , movil_id , funcion) 
                    VALUES ('$id',NULL,NULL)";
                    if(!mysqli_query($conexion,$sql2)) {
                        echo "Error".$sql2."<br/>".mysqli_error($conexion);
                    }
                    /* -------------------------------------------------------- */
                }
                
            }
            header("Location:ingresantes.php");
            break;

        case "Rechazar" : 
            /* Actualización del estado del usuario en la base de datos */
            $sql2 = "UPDATE policias SET estado='rechazado' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* -------------------------------------------------------- */

        case "Seleccionar" : 
            /* Consulta a la base de datos para traer y mostrar los datos del usuario seleccionado */
            $sql3 = "SELECT * FROM policias WHERE policia_id='$id'";
            $rta2 = mysqli_query($conexion,$sql3) 
            or die("Problemas en el select:".mysqli_error($conexion));
            /* -------------------------------------------------------- */
            /* Se almacenan los datos traidos del usuario en variables */
            $seleccion = mysqli_fetch_array($rta2);
            $nombre= $seleccion['nombre'] ; 
            $apellido= $seleccion['apellido'] ; 
            $legajo= $seleccion['legajo'] ; 
            $nivel_usuario= $seleccion['nivel_usuario'] ; 

            /* -------------------------------------------------------- */
            break;

        case "Modificar" : 
            /* Actualización de los datos del usuario en la base de datos */
            $sql2 = "UPDATE policias SET nombre='$nombre', apellido='$apellido', legajo='$legajo',
            nivel_usuario='$nivel_usuario' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                header("Location:ingresantes.php");
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* -------------------------------------------------------- */

        case "Borrar" : 
            /* Actualización del estado del usuario en la base de datos */
            $sql2 = "UPDATE policias SET estado='borrado' WHERE policia_id='$id'";
            if(mysqli_query($conexion,$sql2)) {
                /* Alerta para indicar que se borró con exito */
                $var = "Borrado con exito";
                echo "<script> alert('".$var."');</script>";
                echo "<script>setTimeout( function() { window.location.href = 'ingresantes.php'; }, 10 ); </script>";
            }
            else{
                echo "Error".$sql2."<br/>".mysqli_error($conexion);
            }
            break;
            /* -------------------------------------------------------- */
    }
    mysqli_close($conexion);
    // 1) Inclusión de la cabecera (realizada en un componente aparte ya que es la misma para todo el sistema de administradores )
    include("cabeceraA.php");
?>


    <div class="container mx-auto my-4">

        <table id="ingresantes" class="table table-striped dt-responsive nowrap border border-dark" style="width:100%">
            <caption>Ingresantes</caption>
            <thead>
                <tr>
                    <th>Nombre</th> 
                    <th>Apellido</th> 
                    <th>Legajo</th> 
                    <th>Nivel de usuario</th> 
                    <th>Estado</th>
                    <th>Opciones</th>
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
                    <td> <?php echo $mostrar['nivel_usuario'] ?> </td> 
                    <td> <?php echo $mostrar['estado'] ?> </td> 
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id"  value="<?= $mostrar['policia_id'] ?>">
                            <input type="hidden" name="estado"  value="<?= $mostrar['estado'] ?>">
                            <input class="btn btn-outline-success btn-sm" type="submit" name="opcion"  value="Aceptar">
                            <input class="btn btn-outline-danger btn-sm" type="submit" name="opcion"  value="Rechazar">
                            <input class="btn btn-secondary btn-sm" type="submit" name="opcion"  value="Seleccionar">
                            <input class="btn btn-danger btn-sm" type="submit" name="opcion"  value="Borrar">  
                        </form> 
                    </td>
                </tr>
            <?php    
                }
            ?>  
            </tbody>
        </table> 
    </div>
        
    <div class="card text-bg-light mx-auto" style="max-width: 18rem;">
        <div class="card-header fs-5 fw-bold">Editar Policias</div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <p class="fs-6 fw-semibold mb-1">Nombre:</p>
            <input class="form-control mb-4" id="floatingPassword"  type="text" name="nombre" value="<?php echo $nombre;?>" placeholder="nombre">
            <p class="fs-6 fw-semibold mb-1">Apellido:</p>
            <input class="form-control mb-4" id="floatingPassword"  type="text" name="apellido" value="<?php echo $apellido;?>" placeholder="apellido">
            <p class="fs-6 fw-semibold mb-1">Legajo:</p>
            <input class="form-control mb-4" id="floatingPassword"  type="text" name="legajo" value="<?php echo $legajo;?>" placeholder="legajo">
            <?php if($_SESSION["nivel_usuario"]== "superadm"){?>
            Nivel de usuario:
            <select name="nivel_usuario">
                <option value="noadmin">noadmin</option>
                <option value="admin">admin</option>
            </select><br>
            <?php }else{  ?>
            <input type="hidden" name="nivel_usuario" value="<?php echo $nivel_usuario;?>">
            <?php 
                }
            ?>
            <input class="btn btn-primary btn-sm " type="submit" name="opcion" value="Modificar">
        </form>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () { 
            $('#ingresantes').DataTable({
                "language":{
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