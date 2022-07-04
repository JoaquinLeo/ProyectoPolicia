<?php
    $volver="";
    if(isset($_REQUEST['volver']))$volver=$_REQUEST['volver'];
    if($volver){
        header("location:../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sistema de Gestión Electrónico Policia BA</h1>
    <form action="index.php" method="POST">
        Seleccionar funcion: 
        <select name="nivel_usuario">
            <option value="movil">Movil</option>
            <option value="caminante">Caminante</option>
        </select>
        <br><input type="submit" value="Volver" name="volver">
    </form>

</body>
</html>