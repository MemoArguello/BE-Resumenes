<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
    exit;
}

include "../db.php"; // Conexión a la base de datos con PDO

// Datos de la Empresa
$nit = '';
$dv = '';
$nombreEmpresa = '';
$razonSocial = '';
$telEmpresa = '';
$emailEmpresa = '';
$dirEmpresa = '';
$foto = '';

try {
    // Consultar datos de la empresa
    $query_empresa = $conection->prepare("SELECT * FROM configuracion");
    $query_empresa->execute();
    $arrayInfoEmpresa = $query_empresa->fetch(PDO::FETCH_ASSOC);

    if ($arrayInfoEmpresa) {
        $nit = $arrayInfoEmpresa['ruc'];
        $dv = $arrayInfoEmpresa['dv'];
        $nombreEmpresa = $arrayInfoEmpresa['nombre'];
        $razonSocial = $arrayInfoEmpresa['razon_social'];
        $telEmpresa = $arrayInfoEmpresa['telefono'];
        $emailEmpresa = $arrayInfoEmpresa['email'];
        $dirEmpresa = $arrayInfoEmpresa['direccion'];
        $foto = $arrayInfoEmpresa['foto'];

        if ($foto != 'img_producto.png') {
            $foto = 'img/uploads/' . $foto;
        }
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>Configuracion</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <div class="form_empresa containerDataEmpresa">

            <!-- <div class="logoEmpresa">
                <img src="../img/16.png" id="img" alt="Logo de la Empresa">
            </div> -->

            <h3>Datos del Sistema</h3>
            <br>
            <form method="POST" name="formEmpresa" id="formEmpresa" class="" enctype="multipart/form-data">

                <input type="hidden" name="action" value="updateDataEmpresa">

                <div class="form-group">
                    <label class="label" for="txtRuc">Ruc:</label>
                    <input class="input" type="text" name="txtRuc" id="txtRuc" placeholder="Ruc de la empresa" value="<?php echo htmlspecialchars($nit); ?>" required>
                </div>

                <div class="form-group">
                    <label class="label" for="txtDv">Derivacion:</label>
                    <input class="input" type="text" name="txtDv" id="txtDv" placeholder="Numero de derivacion" value="<?php echo htmlspecialchars($dv); ?>" required>
                </div>

                <div class="form-group">
                    <label class="label" for="txtNombre">Nombre del Sistema:</label>
                    <input class="input" type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la empresa" value="<?php echo htmlspecialchars($nombreEmpresa); ?>" required>
                </div>

                <div class="form-group">
                    <label class="label" for="txtRSocial">Razon Social:</label>
                    <input class="input" type="text" name="txtRSocial" id="txtRSocial" placeholder="Razon social" value="<?php echo htmlspecialchars($razonSocial); ?>" required>
                </div>

                <div class="form-group">
                    <label class="label" for="txtTelEmpresa">Teléfono:</label>
                    <input class="input" type="text" name="txtTelEmpresa" id="txtTelEmpresa" placeholder="Número de teléfono" value="<?php echo htmlspecialchars($telEmpresa); ?>" required>
                </div>

                <div class="form-group">
                    <label class="label" for="txtEmailEmpresa">Correo electrónico:</label>
                    <input class="input" type="email" name="txtEmailEmpresa" id="txtEmailEmpresa" placeholder="Correo electrónico" value="<?php echo htmlspecialchars($emailEmpresa); ?>" required>
                </div>

                <div class="form-group">
                    <label class="label" for="txtDirEmpresa">Direccion:</label>
                    <textarea class="input comentario_conf" type="text" name="txtDirEmpresa" id="txtDirEmpresa" placeholder="Direccion" required><?php echo htmlspecialchars($dirEmpresa); ?></textarea>
                </div>

                <div class="alertFormEmpresa" style="display: none;"></div>
                <div>
                    <button type="submit" class="btn_save btnChangePass"><i class="far fa-save fa-lg"></i> Guardar datos</button>
                </div>
            </form>
        </div>
    </section>

    <?php include 'include/footer.php'; ?>
</body>

</html>