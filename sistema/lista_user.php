<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

// Supongamos que ya tienes una conexión a la base de datos establecida en $conn
include "../db.php";

// Consulta para obtener los datos de los usuarios
$query = mysqli_query($conection, "SELECT u.id AS userid, u.nombre, u.username, u.email, r.rango AS n_rol FROM user u 
                                    INNER JOIN rol r ON u.rol = r.id 
                                    WHERE u.id != 1 
                                    AND u.state = 1 
                                    ORDER BY u.id DESC");
mysqli_close($conection);
$result = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>Listado de Usuarios</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">
        <header class="user-header">
            <h1>Listado de Usuarios</h1>
        </header>
        <main class="main-user">
            <div class="scrollable-container">
                <ul class="user-list">
                    <?php
                    // Comprueba si hay resultados y los muestra
                    if ($result > 0) {
                    ?>
                        <ul class="user-list">
                            <?php
                            $index = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <li class="user-item">
                                    <div class="user-info">
                                        <h2>Nombre: <?php echo $row['nombre']; ?></h2>
                                        <p>Usuario: <?php echo $row['username']; ?></p>
                                        <?php if (empty($row['email'])) { ?>
                                            <p>Correo: No posee correo</p>
                                        <?php } else { ?>
                                            <p>Correo: <?php echo $row['email']; ?></p>
                                        <?php } ?>
                                        <p>Rol: <?php echo $row['n_rol']; ?></p>
                                        <input type="hidden" value="<?php echo $row['userid']; ?>">
                                    </div>
                                    <div class="user-actions">
                                        <a class="btn_edit" href="editar_usuario.php?id=<?php echo $row['userid']; ?>">Editar</a>
                                        <a class="btn_delete" href="eliminar_usuario.php?id=<?php echo $row['userid']; ?>">Eliminar</a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        <?php
                    } else {
                        ?>
                            <li style="text-align: center;" class="user-item">
                                <div class="user-info">
                                    <h2>NO HAY DATOS REGISTRADOS</h2>
                                    <p>Desea regitrar algun dato?</p>
                                </div>
                                <div class="user-actions">
                                    <p><button class="btn_new"><a class="link_new" href="./registro_usuario.php">Registrar</a></button></p>
                                </div>
                            </li>
                        <?php
                    }
                        ?>
                        </ul>
            </div>
        </main>
    </section>
    <?php include "include/footer.php"; ?>
</body>

</html>