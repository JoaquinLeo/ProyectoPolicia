<?php


    $registrar = (isset($_REQUEST['registrar']))?$_REQUEST['registrar']:"";
    $ingresar  = (isset($_REQUEST['ingresar']))?$_REQUEST['ingresar']:"";

    if($ingresar){
        
        include("conexion.php");
        
        $usuario=$_REQUEST['usuario'];
        $contrasenna=$_REQUEST['contrasenna'];
         

        $sql="SELECT policia_id , nombre , legajo , estado , nivel_usuario FROM policias where nombre='$usuario' and legajo='$contrasenna' and estado='aceptado'";

        $rta= mysqli_query($conexion,$sql) or
        die("Problemas en el select:".mysqli_error($conexion));

        $reg=mysqli_fetch_array($rta);

        if($reg)
        {   

            if($reg['nivel_usuario'] == "admin" || $reg['nivel_usuario'] == "superadm"){
                 session_start();
                 $_SESSION['usuario']=$usuario;
                 $_SESSION['legajo']=$contrasenna;
                 $_SESSION['nivel_usuario'] = $reg['nivel_usuario'];
                 $_SESSION['id']=$reg['policia_id'];
                 header("location:./administradores/index.php");
            }
            else{  
                session_start();
                 $_SESSION['usuario']=$usuario;
                 $_SESSION['legajo']=$contrasenna;
                 $_SESSION['nivel_usuario'] = $reg['nivel_usuario'];
                 $_SESSION['id']=$reg['policia_id'];
                 header("location:./usuarios/index.php");
            }
        }
        else
        {
            include("index.php");
            ?>
            <script type="text/javascript">
                alert("Error intentar nuevamente.");
            </script>
               
            <?php
            //echo "Error intentar nuevamente";
        }
        
    }
    if($registrar){
        header("location:registrar.php");
    }
?>