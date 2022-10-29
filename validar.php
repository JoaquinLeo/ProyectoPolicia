<?php
    /* 4) Inclusión del componente conexion.php para conectarse a la base de datos
    (se realizó aparte ya que la conexion a la base de datos es la misma para todo el sistema) */
    include("conexion.php");

    /* 5) Captura de los datos del formulario del componente index.php */
    $usuario=$_REQUEST['usuario'];
    $contrasenna=$_REQUEST['contrasenna'];
    /* --------------------------------------------------------------- */

    /* 6) Consulta a la base de datos para comprobar si existe el usuario que esta queriendo ingresar */
    $sql="SELECT policia_id , nombre , legajo , estado , nivel_usuario 
    FROM policias where nombre='$usuario' and legajo='$contrasenna' and estado='aceptado'";
    $rta= mysqli_query($conexion,$sql) 
    or die("Problemas en el select:".mysqli_error($conexion));
    /* ----------------------------------------------------------------------------------------- */
    
    
    /* 7) En caso de que mysqli_fetch_array retorne un vector asociativo la condición del if se verifica 
    (es decir que se encontro un usuario con los datos ingresados en el formulario), 
    en caso de retornar false (no se encontró ningun usuario en la base de datos) se ejecuta el else */

    $reg=mysqli_fetch_array($rta);

    if($reg)
    {   
        /* 8) Verifición del tipo de usuario y creación de una sesión para el mismo */
        if($reg['nivel_usuario'] == "admin" || $reg['nivel_usuario'] == "superadm"){
                /* si es administrador o superadministrador entonces se envia al mismo a la seccion de administradores */
                session_start();
                $_SESSION['usuario']=$usuario;
                $_SESSION['legajo']=$contrasenna;
                $_SESSION['nivel_usuario'] = $reg['nivel_usuario'];
                $_SESSION['id']=$reg['policia_id'];
                header("location:./administradores/index.php");
        }
        else{  
                /* si es usuario comun entonces se envia al mismo a la seccion de usuarios */
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
        /* 9) Si no se encontra ningun usuario se muestra una alerta para intentar nuevamente */
        $var = "Error intentar nuevamente.";
        echo "<script> alert('".$var."');</script>";
        echo "<script>setTimeout( function() { window.location.href = 'index.php'; }, 10 ); </script>";
    }
        
?>