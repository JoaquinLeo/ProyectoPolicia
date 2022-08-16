<?php
    

    $registrar ="";
    $ingresar ="";

    if(isset($_REQUEST['registrar']))$registrar=$_REQUEST['registrar'];
    if(isset($_REQUEST['ingresar']))$ingresar=$_REQUEST['ingresar'];

    
    if($ingresar){
        
        include("conexion.php");
        
        $usuario=$_REQUEST['usuario'];
        $contrasenna=$_REQUEST['contrasenna'];
        /*session_start();
        $_SESSION['usuario']=$usuario;*/
        
        

        $consulta1="SELECT policia_id , nombre , legajo , estado FROM policias where nombre='$usuario' and legajo='$contrasenna' and estado='aceptado'";

        $resultado= mysqli_query($conexion,$consulta1) or
        die("Problemas en el select:".mysqli_error($conexion));

        $reg1=mysqli_fetch_array($resultado);


        $filas=mysqli_num_rows($resultado);

        if($filas)
        {   
            $consulta2="SELECT nivel_usuario FROM policias where nombre='$usuario' and legajo='$contrasenna' and estado='aceptado'";
            $resultado2= mysqli_query($conexion,$consulta2) or
            die("Problemas en el select:".mysqli_error($conexion));
            $reg=mysqli_fetch_array($resultado2);
            if($reg['nivel_usuario'] == "admin"){
                 session_start();
                 $_SESSION['usuario']=$usuario;
                 $_SESSION['legajo']=$contrasenna;
                 $_SESSION['id']=$reg1['policia_id'];
                 header("location:./administradores/index.php");
            }
            else{  
                session_start();
                 $_SESSION['usuario']=$usuario;
                 $_SESSION['legajo']=$contrasenna;
                 $_SESSION['id']=$reg1['policia_id'];
                 header("location:./usuarios/index.php");
            }
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