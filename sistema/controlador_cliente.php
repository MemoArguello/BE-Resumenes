<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_cliente'])) {
        // Código para registrar cliente
        if (empty($_POST['n_carpeta']) || empty($_POST['cliente_desde']) || empty($_POST['ruc']) || empty($_POST['dv']) || empty($_POST['nombre']) || empty($_POST['nombre_fantasia']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['vencimiento'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './reg_client.php';
                    }
                });
            }
            </script>";
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

            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE ruc = '$ruc' AND estado=1");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Ya existe un cliente con este RUC', 'warning').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = './reg_client.php';
                        }
                    });
                }
                </script>";
            } else {
                $query_insert = mysqli_query($conection, "INSERT INTO cliente (n_carpeta, cliente_desde, ruc, dv, nombre, nombre_fantasia, telefono, direccion, vencimiento) VALUE ('$carpeta', '$f_cliente', '$ruc', '$dv', '$nombre', '$fantasia', '$telefono', '$direccion', '$vencimiento')");

                if ($query_insert) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Cliente creado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './reg_client.php';
                            }
                        });
                    }
                    </script>";
                } else {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al crear el cliente.', 'error').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './reg_client.php';
                            }
                        });
                    }
                    </script>";
                }
            }
        }
    } elseif (isset($_POST['actualizar_cliente'])) {
        // Código para actualizar cliente
        $id_cliente = $_POST['id'];
        $carpeta = $_POST['n_carpeta'];
        $f_cliente = $_POST['cliente_desde'];
        $ruc = $_POST['ruc'];
        $dv = $_POST['dv'];
        $nombre = $_POST['nombre'];
        $fantasia = $_POST['nombre_fantasia'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $vencimiento = $_POST['vencimiento'];

        $query = mysqli_query($conection, "SELECT * FROM cliente WHERE ruc = '$ruc' AND estado=1");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Ya existe un cliente con este RUC', 'warning').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './reg_client.php';
                    }
                });
            }
            </script>";
        } else {
        $query_update = mysqli_query($conection, "UPDATE cliente SET n_carpeta='$carpeta', cliente_desde='$f_cliente', ruc='$ruc', dv='$dv', nombre='$nombre', nombre_fantasia='$fantasia', telefono='$telefono', direccion='$direccion', vencimiento='$vencimiento' WHERE id='$id_cliente'");
        if ($query_update) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Cliente actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_client.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar el cliente.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_client.php';
                        }
                    });
                }
            </script>";
        }
    }
    } elseif (isset($_POST['eliminar_cliente'])) {
        // Código para eliminar cliente
        $id_cliente = $_POST['id'];
        $estado = 0;

        $query_delete = mysqli_query($conection, "UPDATE cliente SET estado='$estado' WHERE id='$id_cliente'");
        if ($query_delete) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Cliente eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_client.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar el cliente.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_client.php';
                        }
                    });
                }
            </script>";
        }
    }
}
