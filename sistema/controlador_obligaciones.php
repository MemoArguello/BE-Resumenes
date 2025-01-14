<?php
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar_obligacion'])) {
        // Código para registrar
        if (empty($_POST['n_oblig']) || empty($_POST['monto'])) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './reg_oblig.php';
                    }
                });
            }
            </script>";
        } else {

            $n_oblig = $_POST['n_oblig'];
            $monto = $_POST['monto'];

            $query = mysqli_query($conection, "SELECT * FROM obligacion WHERE n_oblig = '$n_oblig' AND estado=1");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                echo "<script>
                window.onload = function() {
                    Swal.fire('Érror', 'Ya existe una Obligación con este nombre', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = './reg_oblig.php';
                        }
                    });
                }
                </script>";
            } else {
                $query_insert = mysqli_query($conection, "INSERT INTO obligacion (n_oblig, monto) VALUE ('$n_oblig', '$monto')");
                if ($query_insert) {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Éxito', 'Obligacion creado correctamente.', 'success').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './reg_oblig.php';
                            }
                        });
                    }
                    </script>";
                } else {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire('Error', 'Error al crear la obligación.', 'error').then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './reg_oblig.php';
                            }
                        });
                    }
                    </script>";
                }
            }
        }
    } elseif (isset($_POST['actualizar_obligacion'])) {
        // Código para actualizar 
        $id = $_POST['id'];

        $n_oblig = $_POST['n_oblig'];
        $monto = $_POST['monto'];

        $query = mysqli_query($conection, "SELECT * FROM obligacion WHERE n_oblig = '$n_oblig' AND estado=1");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            echo "<script>
            window.onload = function() {
                Swal.fire('Error', 'Ya existe una Obligación con este nombre', 'error').then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './reg_oblig.php';
                    }
                });
            }
            </script>";
        } else {
        $query_update = mysqli_query($conection, "UPDATE obligacion SET n_oblig='$n_oblig', monto='$monto' WHERE id='$id'");
        if ($query_update) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Obligación actualizado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_oblig.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al actualizar la obligación.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_oblig.php';
                        }
                    });
                }
            </script>";
        }
    }
    } elseif (isset($_POST['eliminar_obligacion'])) {
        // Código para eliminar
        $id = $_POST['id'];
        $estado = 0;
    
        $query_delete = mysqli_query($conection, "UPDATE obligacion SET estado='$estado' WHERE id='$id'");
        if ($query_delete) {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Éxito', 'Obligación eliminado correctamente.', 'success').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_oblig.php';
                        }
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire('Error', 'Error al eliminar la obligación.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reg_oblig.php';
                        }
                    });
                }
            </script>";
        }
    }
}
