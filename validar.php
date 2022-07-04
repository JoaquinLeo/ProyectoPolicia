<?php
    $registrar ="";
    $ingresar ="";

    if(isset($_REQUEST['registrar']))$registrar=$_REQUEST['registrar'];
    if(isset($_REQUEST['ingresar']))$ingresar=$_REQUEST['ingresar'];

    
    if($ingresar){
        $usuario=$_REQUEST['usuario'];
        $contrasenna=$_REQUEST['contrasenna'];

        $conexion=mysqli_connect("localhost","root","","dbPolicia") or
        die("Problemas con la conexión");

        $consulta="SELECT nombre , legajo , estado FROM policia where nombre='$usuario' and legajo='$contrasenna' and estado='aceptado'";

        $resultado= mysqli_query($conexion,$consulta) or
        die("Problemas en el select:".mysqli_error($conexion));
        
        $filas=mysqli_num_rows($resultado);

        if($filas)
        {   
            $consulta2="SELECT nivel_usuario FROM policia where nombre='$usuario' and legajo='$contrasenna' and estado='aceptado'";
            $resultado2= mysqli_query($conexion,$consulta2) or
            die("Problemas en el select:".mysqli_error($conexion));
            $reg=mysqli_fetch_array($resultado2);
            if($reg['nivel_usuario'] == "admin"){
                header("location:./administradores/index.php");
            }
            else{
                header("location:./usuarios/index.php");
            }
            //header("location:iniciar.php");
        }
        else
        {
            include("index.php");
            echo "<br>Error intente nuevamente";
        }
        
    }
    if($registrar){
        header("location:registrar.php");
    }
?>