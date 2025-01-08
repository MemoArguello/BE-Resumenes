<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../db.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $nombre = $_POST['nombre'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $rol = $_POST['rol'];

        $query = mysqli_query($conection, "SELECT * FROM user WHERE username = '$user'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
        } else {
            if (empty($_POST['nombre'])) {
                $query_insert = mysqli_query($conection, "INSERT INTO user (username, email, pass, rol) VALUE ('$user', '$email', '$pass', '$rol')");
            } elseif (empty($_POST['email'])) {
                $query_insert = mysqli_query($conection, "INSERT INTO user (nombre, username, pass, rol) VALUE ('$nombre', '$user', '$pass', '$rol')");
            } elseif (empty($_POST['nombre']) || (empty($_POST['email']))) {
                $query_insert = mysqli_query($conection, "INSERT INTO user (username, pass, rol) VALUE ('$nombre', '$user', '$pass', '$rol')");
            }

            if ($query_insert) {
                $alert = '<p class="msg_save">Usuario creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">Error al crear el usuario.</p>';
            }
        }
    }
}
mysqli_close($conection);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "include/script.php"; ?>
    <title>Registrar Usuario</title>
</head>

<body>
    <?php include "include/nav.php"; ?>
    <section class="dashboard">

        <div class="form_register_user">
            <h1 class="user_new"><i class="fa-solid fa-user-plus"></i> Registrar Usuario</h1>
            <hr class="hr">
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>

            <form class="form_user" action="" method="POST">

                <label class="lb_user" for="nombre">Nombre:</label>
                <input class="in_user" type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

                <label class="lb_user" for="username">Usuario:</label>
                <input class="in_user" type="text" name="username" id="username" placeholder="Nombre de usuario" autocomplete="new-password">

                <label class="lb_user" for="correo">Correo Electrónico:</label>
                <input class="in_user" type="email" name="correo" id="correo" placeholder="ejemplo@gmail.com">

                <label class="lb_user" for="pass">Contraseña:</label>
                <input class="in_user" type="password" name="pass" id="pass" placeholder="Contraseña" autocomplete="new-password">

                <label class="lb_user" for="rol">Tipo de Usuario:</label>
                <?php
                $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_rol);
                ?>

                <select name="rol" id="rol">
                    <?php
                    if ($result_rol > 0) {
                        while ($rol = mysqli_fetch_array($query_rol)) {
                    ?>
                            <option value="<?php echo $rol["id"] ?>"><?php echo $rol["rango"] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <button type="submit" class="btn_save"><i class="fa-regular fa-floppy-disk"></i> Registrar</button>

            </form>

        </div>
    </section>
    <?php include "include/footer.php"; ?>

</body>

</html>