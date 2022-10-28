<?php
    include("../sesion.php");
    include("cabeceraU.php");

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d");

?>

        <!-- <form action="val_vac.php" method="POST">
            Ingrese su Usuario:
            <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly><br>
            Ingrese su fecha de inicio:
            <input class="form-control w-25" type="date" min="<?=$fecha?>" name="finicio" required><br>
            Ingrese su fecha de fin:
            <input class="form-control w-25" type="date" min="<?=$fecha?>" name="ffin" required><br>
            <input type="submit" value="Enviar" name="enviar"><br>  
        </form> -->

<div class="container mt-4" style="max-width: 800px">
    <div class="card border border-dark border-3 rounded" >
        <div class="card-header">
        </div>
        <div class="card-body">
            <form action="val_vac.php" method="POST">
                <p class="fs-6 fw-semibold mb-1">Usuario:</p>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <p class="fs-6 fw-semibold mb-1">Ingrese su fecha de inicio:</p>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputDate01">Select Date</label>
                    <input class="form-control" id="inputDate01" type="date" min="<?=$fecha?>" name="finicio" required>
                </div>
                <p class="fs-6 fw-semibold mb-1">Ingrese su fecha de fin:</p>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputDate02">Select Date</label>
                    <input class="form-control" id="inputDate02"type="date" min="<?=$fecha?>" name="ffin" required>
                </div>
                <input class="btn btn-primary" type="submit" value="Enviar" name="enviar"> 
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>   
</div>

</body>
</html>