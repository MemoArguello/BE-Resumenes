<?php
session_start();
include "../db.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['n_carpeta']) || empty($_POST['cliente_desde']) || empty($_POST['ruc']) || empty($_POST['dv']) || empty($_POST['nombre']) || empty($_POST['nombre_fantasia']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['vencimiento'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $carpeta = $_POST['n_carpeta'];
        $f_cliente = $_POST['cliente_desde'];
        $ruc = $_POST['ruc'];
        $dv = $_POST['dv'];
        $nombre = $_POST['nombre'];
        $fantasia = $_POST['nombre_fantasia'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $vencimiento = $_POST['vencimiento'];

        $query = mysqli_query($conection, "SELECT * FROM cliente WHERE ruc = '$ruc'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El cliente ya existe.</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO cliente (n_carpeta, cliente_desde, ruc, dv, nombre, nombre_fantasia, telefono, direccion, vencimiento) VALUE ('$carpeta', '$f_cliente', '$ruc', '$dv', '$nombre', '$fantasia', '$telefono', '$direccion', '$vencimiento')");

            if ($query_insert) {
                $alert = '<p class="msg_save">Cliente creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al crear el cliente.</p>';
            }
        }
    }
}
// Consulta para obtener los clientes
$clientes = mysqli_query($conection, "SELECT * FROM cliente");

mysqli_close($conection);
$result = mysqli_num_rows($query);
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
                    <h1>CLIENTES</h1>
                </header>

                <div class="client-form">
                <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
                    <form action="" method="POST">
                        <input type="hidden" name="registrar_cliente" value="1">
                        <label class="lb_client_carpeta" for="carpeta">CARPETA:</label>
                        <label class="lb_client_cldes" for="f_cliente">CLIENTE DESDE:</label>
                        <label class="lb_client_ruc" for="ruc">RUC:</label>
                        <label class="lb_client_dv" for="dv">DV:</label>
                        <br>
                        <input class="in_client_carpeta" type="number" name="n_carpeta" id="carpeta" placeholder="N° Carpeta">
                        <input class="in_client_cldes" type="date" name="cliente_desde" id="f_cliente">
                        <input class="in_client_ruc" type="number" name="ruc" id="ruc" placeholder="N° de Documento">
                        <input class="in_client_dv" type="number" name="dv" id="dv" placeholder="dv">
                        <br>
                        <br>
                        <label class="lb_client_na" for="nombre">NOMBRE Y APELLIDO:</label>
                        <label class="lb_client_nf" for="fantasia">NOMBRE DE FANTASÍA:</label>
                        <br>
                        <input class="in_client_na" type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                        <input class="in_client_nf" type="text" name="nombre_fantasia" id="fantasia" placeholder="Nombre de Fantasía">
                        <br>
                        <br>
                        <label class="lb_client_tel" for="telefono">TELEFONO:</label>
                        <br>
                        <input class="in_client_tel" type="text" inputmode="numeric" name="telefono" id="telefono" placeholder="N° de Teléfono">
                        <br>
                        <br>
                        <label class="lb_client_dir" for="direccion">DIRECCION:</label>
                        <br>
                        <input class="in_client_dir" type="text" name="direccion" id="direccion" placeholder="Dirección">
                        <br>
                        <br>
                        <label class="lb_client_dir" for="f_cliente">VENCIMIENTO:</label>
                        <input class="in_client_dir" type="date" name="vencimiento" id="vencimiento">
                        <button type="submit" class="btn_save"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
                    </form>
                </div>

                <!-- <div class="obligations-section">
                    <header>
                        <h2>OBLIGACIONES</h2>
                    </header>
                    <table>
                        <thead>
                            <tr>
                                <th>Obligaciones</th>
                                <th>Importe</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;"><button style="padding-right: 5px; padding-left: 5px;">+</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="add-row">+</button>
                </div> -->

            </div>

            <div class="client-table">
                <div>
                    <input type="text" class="search" placeholder="Buscar">
                </div>
                <aside>
                    <table>
                        <thead>
                            <tr>
                                <th>Carpeta</th>
                                <th>Cliente Desde</th>
                                <th>Nombre</th>
                                <th>RUC DV</th>
                                <th>Nombre y Apellido</th>
                                <th>Nombre de fantasia</th>
                                <th>Teléfono</th>
                                <th>Direccion</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                                foreach ($clientes as $cliente) : ?>
                                    <tr>
                                        <td><?= $cliente->n_carpeta ?></td>
                                        <td><?= $cliente->cliente_desde ?></td>
                                        <td><?= $cliente->ruc ?></td>
                                        <td><?= $cliente->dv ?></td>
                                        <td><?= $cliente->nombre ?></td>
                                        <td><?= $cliente->nombre_fantasia ?></td>
                                        <td><?= $cliente->telefono ?></td>
                                        <td><?= $cliente->direccion ?></td>
                                        <td><?= $cliente->vencimiento ?></td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </aside>
            </div>
        </div>
    </section>
    <?php include "include/footer.php"; ?>
</body>
</html>