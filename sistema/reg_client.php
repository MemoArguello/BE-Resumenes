<?php
session_start();
include "../db.php";


$query_clientes = mysqli_query($conection, "SELECT * FROM cliente");
mysqli_close($conection);
$clientes = mysqli_num_rows($query_clientes);
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
                    <div class="alerta <?php echo isset($alert) ? 'show' : ''; ?>" id="alertBox">
                        <span class="alert-message"><?php echo isset($alert) ? $alert : ''; ?></span>
                        <button type="button" class="close-btn" onclick="closeAlert()">&times;</button>
                    </div>
                    <form action="controlador_cliente.php" method="POST">
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
                        <input type="submit" class="btn_save" value="Guardar">
                    </form>
                </div>

            </div>

            <div class="client-table">
                <aside>
                    <table id="clientesTable">
                        <thead>
                            <tr>
                                <th>Carpeta</th>
                                <th>Nombre y Apellido</th>
                                <th>RUC</th>
                                <th>Información</th>
                                <th>Activo</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            while ($row = mysqli_fetch_array($query_clientes)) {
                            ?>
                                <tr>
                                    <td><?= $row['n_carpeta']; ?></td>
                                    <td><?= $row['nombre']; ?></td>
                                    <td><?= $row['ruc']; ?></td>
                                    <td>
                                        <button onclick="showClientDetails(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)"
                                            class="btn-modal">
                                            Ver Completo
                                        </button>
                                    </td>
                                    <td></td>
                                    <td>
                                        <button onclick="showEditModal(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)"
                                            class="btn-edit">
                                            Editar
                                        </button>
                                    </td>
                                    <td>
                                        <form action="controlador_cliente.php" method="POST" id="form-eliminar-<?= $row['id'] ?>">
                                            <input type="hidden" name="eliminar_cliente" value="1">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <!-- Otros campos del formulario -->
                                            <button type="button" class="btn-delete" onclick="eliminarCliente(<?= $row['id'] ?>)">Eliminar</button>
                                        </form>
                                    </td>
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
    <!-- Modal de edición -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeEditModal()">&times;</span>
            <h2>Editar Cliente</h2>
            <form id="editClientForm" method="POST" action="./controlador_cliente.php">
                <input type="hidden" name="actualizar_cliente" value="1">
                <input type="hidden" id="edit-id" name="id">
                <div class="row-container">
                    <div class="form-group">
                        <label for="edit-nombre">Nombre y Apellido:</label>
                        <input type="text" id="edit-nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-fantasia">Nombre de Fantasía:</label>
                        <input type="text" id="edit-fantasia" name="nombre_fantasia" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-telefono">Teléfono:</label>
                        <input type="text" id="edit-telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-vencimiento">Vencimiento:</label>
                        <input type="date" id="edit-vencimiento" name="vencimiento" required>
                    </div>
                </div>
                <div class="row-container">
                    <div class="form-group">
                        <label for="edit-carpeta">Carpeta:</label>
                        <input type="number" id="edit-carpeta" name="n_carpeta" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-cliente-desde">Cliente desde:</label>
                        <input type="date" id="edit-cliente-desde" name="cliente_desde" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-ruc">RUC:</label>
                        <input type="number" id="edit-ruc" name="ruc" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-dv">DV:</label>
                        <input type="number" id="edit-dv" name="dv" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-direccion">Dirección:</label>
                        <input type="text" id="edit-direccion" name="direccion" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-save">Guardar cambios</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal para ver los detalles del cliente-->
    <div id="clientModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2>Detalles del Cliente</h2>
            <div class="modal-body">
                <!-- Primera Fila -->
                <div class="row-container">
                    <div class="detail-box">
                        <label>Nombre y Apellido:</label>
                        <span id="modal-nombre"></span>
                    </div>
                    <div class="detail-box">
                        <label>Nombre de Fantasía:</label>
                        <span id="modal-fantasia"></span>
                    </div>
                    <div class="detail-box">
                        <label>N° de Carpeta:</label>
                        <span id="modal-carpeta"></span>
                    </div>
                    <div class="detail-box">
                        <label>Cliente desde:</label>
                        <span id="modal-cliente-desde"></span>
                    </div>
                    <div class="detail-box">
                        <label>RUC:</label>
                        <span id="modal-ruc"></span>
                    </div>
                    <div class="detail-box">
                        <label>DV:</label>
                        <span id="modal-dv"></span>
                    </div>
                </div>

                <!-- Segunda Fila -->
                <div class="row-container">
                    <div class="detail-box">
                        <label>Teléfono:</label>
                        <span id="modal-telefono"></span>
                    </div>
                    <div class="detail-box">
                        <label>Dirección:</label>
                        <span id="modal-direccion"></span>
                    </div>
                    <div class="detail-box">
                        <label>Fecha de Vencimiento de Obligacion:</label>
                        <span id="modal-vencimiento"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
<script>
    function eliminarCliente(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-eliminar-' + id).submit();
            }
        })
    }
</script>

</html>