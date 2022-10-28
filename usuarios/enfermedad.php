<?php
    include("../sesion.php");
    include("cabeceraU.php");
?>

    
    <!-- <form action="val_enf.php" method="POST" enctype="multipart/form-data">
        Ingrese su Usuario:
        <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly ><br>
        Ingrese su certificado:
        <input type="file" name="certificado" required><br>
        <input type="submit" value="Enviar" name="enviar"><br>
    </form> -->

<div class="container mt-4" style="max-width: 800px">
    <div class="card border border-dark border-3 rounded" >
        <div class="card-header">
        </div>
        <div class="card-body">
            <form action="val_enf.php" method="POST" enctype="multipart/form-data">
                <p class="fs-6 fw-semibold mb-1">Usuario:</p>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" name="usuario" value="<?= $_SESSION['usuario']?>" readonly class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <p class="fs-6 fw-semibold mb-1">Ingrese su certificado:</p>
                <div class="input-group mb-3">
                    <input type="file" name="certificado" required class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
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