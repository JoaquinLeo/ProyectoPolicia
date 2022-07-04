<?php
    $volver="";
    if(isset($_REQUEST['volver']))$volver=$_REQUEST['volver'];
    if($volver){
        header("location:index.php");
    }
?>