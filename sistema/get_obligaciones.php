<?php
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_cliente'])) {
        $id_cliente = $_GET['id_cliente'];
        
        // Consulta para obtener las obligaciones del cliente
        $query = mysqli_query($conection, "SELECT cliente_obligacion.*, cliente.*, obligacion.*
                                        FROM cliente_obligacion JOIN cliente ON cliente.id = cliente_obligacion.id_cliente
                                        JOIN obligacion ON obligacion.id = cliente_obligacion.id_obligacion
                                        wHERE cliente_obligacion.id_cliente = '$id_cliente'");
        
        if ($query) {
            $obligaciones = array();
            while ($row = mysqli_fetch_assoc($query)) {
                $obligaciones[] = $row;
            }
            
            // Devolver los resultados en formato JSON
            header('Content-Type: application/json');
            echo json_encode(array('success' => true, 'obligaciones' => $obligaciones));
        } else {
            header('Content-Type: application/json');
            echo json_encode(array(
                'success' => false, 
                'error' => 'Error al obtener las obligaciones: ' . mysqli_error($conection)
            ));
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => false, 
            'error' => 'ID de cliente no proporcionado'
        ));
    }
}