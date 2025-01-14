<?php
session_start();
include "../db.php";

$query_oblig = mysqli_query($conection, "SELECT * FROM obligacion WHERE estado=1");
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
                    <form action="controlador_obligaciones.php" method="POST">
                        <input type="hidden" name="registrar_obligacion" value="1">
                        <label class="lb_client_na" for="nombre">NOMBRE DE OBLIGACIÓN:</label>
                        <br>
                        <input class="in_client_na" type="text" name="n_oblig" id="obligacion" placeholder="Nombre de la Obligacion">
                        <br>
                        <br>
                        <label class="lb_client_tel" for="monto">MONTO:</label>
                        <br>
                        <input class="in_client_na" type="number" name="monto" id="monto" placeholder="Monto">
                        <input type="submit" class="btn_save" value="Guardar">
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
                                    <td><?= $index++?></td>
                                    <td><?= $row['n_oblig']; ?></td>
                                    <td><?= $row['monto']; ?></td>
                                    <td>
                                        <button onclick="showEditModalOblig(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)"
                                            class="btn-edit">
                                            Editar
                                        </button>
                                    </td>
                                    <td>
                                        <form action="controlador_obligaciones.php" method="POST" id="form-eliminar-<?= $row['id'] ?>">
                                            <input type="hidden" name="eliminar_obligacion" value="1">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="button" class="btn-delete" onclick="eliminarObligacion(<?= $row['id'] ?>)">Eliminar</button>
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
            <form id="editClientForm" method="POST" action="./controlador_obligaciones.php">
                <input type="hidden" name="actualizar_obligacion" value="1">
                <input type="hidden" id="edit-id" name="id">
                <div class="row-container">
                    <div class="form-group">
                        <label for="edit-nombre">Nombre de la Obligación:</label>
                        <input type="text" id="edit-nombre" name="n_oblig" required>
                    </div>
                </div>
                <div class="row-container">
                    <div class="form-group">
                        <label for="edit-fantasia">Monto:</label>
                        <input type="text" id="edit-monto" name="monto" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-save">Guardar cambios</button>
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
<script>
    function eliminarObligacion(id) {
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