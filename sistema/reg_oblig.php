<?php
session_start();
include "../db.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['n_oblig']) || empty($_POST['monto'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $obligacion = $_POST['n_oblig'];
        $monto = $_POST['monto'];

        $query = mysqli_query($conection, "SELECT * FROM obligacion WHERE n_oblig = '$obligacion'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">Ya existe una obligación con ese nombre.</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO obligacion (n_oblig, monto) VALUE ('$obligacion', '$monto')");

            if ($query_insert) {
                $alert = '<p class="msg_save">Obligación registrado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al registrar la Obligación.</p>';
            }
        }
    }
}
$query_oblig = mysqli_query($conection, "SELECT * FROM obligacion");
mysqli_close($conection);
$clientes = mysqli_num_rows($query_oblig);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>BE Estudio Contable</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <div class="flex">
            <div class="client-management">
                <header class="client-header">
                    <h1>OBLIGACIONES</h1>
                </header>

                <div class="client-form">
                    <div class="alerta <?php echo isset($alert) ? 'show' : ''; ?>" id="alertBox">
                        <span class="alert-message"><?php echo isset($alert) ? $alert : ''; ?></span>
                        <button type="button" class="close-btn" onclick="closeAlert()">&times;</button>
                    </div>
                    <form action="" method="POST">
                        <input type="hidden" name="registrar_cliente" value="1">
                        <label class="lb_client_na" for="nombre">NOMBRE DE OBLIGACIÓN:</label>
                        <br>
                        <input class="in_client_na" type="text" name="n_oblig" id="obligacion" placeholder="Nombre de la Obligacion">
                        <br>
                        <br>
                        <label class="lb_client_tel" for="monto">MONTO:</label>
                        <br>
                        <input class="in_client_na" type="number" name="monto" id="monto" placeholder="Monto">
                        <button type="submit" class="btn_save"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
                    </form>
                </div>


            </div>

            <div class="client-table">
                <aside>
                    <table id="clientesTable">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Monto</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            while ($row = mysqli_fetch_array($query_oblig)) {
                            ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $row['n_oblig']; ?></td>
                                    <td><?= $row['monto']; ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </aside>
            </div>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
</body>

</html>