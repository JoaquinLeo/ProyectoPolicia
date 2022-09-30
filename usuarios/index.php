<?php
    include("../sesion.php");
    include("cabeceraU.php");
?>

<div class="roberto">
    <div class="card text-bg-light carlos">
        <p class="fs-5">Bienvenido <?php echo $_SESSION['usuario'] ?></p>

        <form method="POST" action="funcion.php">
            <div>
                <label for="Select1">Seleccionar actividad:</label>
                <select class="form-select form-select-sm" id="Select1" name="funcion">
                    <option value="movil">Movil</option>
                    <option value="caminante">Caminante</option>
                    <option value="bicicleta">Bicicleta</option>
                    <option value="cuatriciclo">Cuatriciclo</option>
                </select>
                <br><input class="btn btn-primary btn-sm" type="submit" value="seleccionar" name="selecionar"><br><br>
            </div>
        </form> 
    </div>  
</div>    
</body>
</html>