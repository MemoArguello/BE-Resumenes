<?php
include "../db.php"; // Asegúrate de que db.php devuelve una conexión PDO
session_start();

if (!empty($_POST)) {
    try {
        // Actualizar datos de la Empresa
        if ($_POST['action'] == 'updateDataEmpresa') {
            if (
                empty($_POST['txtRuc']) || empty($_POST['txtDv']) || empty($_POST['txtNombre']) ||
                empty($_POST['txtTelEmpresa']) || empty($_POST['txtEmailEmpresa']) || empty($_POST['txtDirEmpresa'])
            ) {
                $code = '1';
                $msg = "Todos los campos son obligatorios";
            } else {
                // Datos recibidos del formulario
                $intNit = $_POST['txtRuc'];
                $intDv = $_POST['txtDv'];
                $strNombre = $_POST['txtNombre'];
                $strRSocial = $_POST['txtRSocial'];
                $intTel = $_POST['txtTelEmpresa'];
                $strEmail = $_POST['txtEmailEmpresa'];
                $strDir = $_POST['txtDirEmpresa'];

                // Actualizar datos en la base de datos con PDO
                $queryUpd = $conection->prepare(
                    "UPDATE configuracion 
                     SET ruc = :ruc, dv = :dv, nombre = :nombre, razon_social = :razon_social, 
                         telefono = :telefono, email = :email, direccion = :direccion
                     WHERE id = 1"
                );

                $queryUpd->bindParam(':ruc', $intNit, PDO::PARAM_STR);
                $queryUpd->bindParam(':dv', $intDv, PDO::PARAM_STR);
                $queryUpd->bindParam(':nombre', $strNombre, PDO::PARAM_STR);
                $queryUpd->bindParam(':razon_social', $strRSocial, PDO::PARAM_STR);
                $queryUpd->bindParam(':telefono', $intTel, PDO::PARAM_STR);
                $queryUpd->bindParam(':email', $strEmail, PDO::PARAM_STR);
                $queryUpd->bindParam(':direccion', $strDir, PDO::PARAM_STR);
                $queryUpd->bindParam(':foto', $imgProducto, PDO::PARAM_STR);

                if ($queryUpd->execute()) {
                    $code = '00';
                    $msg = "Datos actualizados correctamente.";
                } else {
                    $code = '2';
                    $msg = "Error al actualizar los datos.";
                }
            }

            // Devolver respuesta en formato JSON
            $array_data = array('cod' => $code, 'msg' => $msg, 'newImage' => $newImage);
            echo json_encode($array_data, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } catch (PDOException $e) {
        $code = '2';
        $msg = "Error en la base de datos: " . $e->getMessage();
        $array_data = array('cod' => $code, 'msg' => $msg, 'newImage' => '');
        echo json_encode($array_data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Cerrar la conexión a la base de datos
$conection = null;
exit;
