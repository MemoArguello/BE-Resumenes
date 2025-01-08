<?php

$alert = '';

session_start();

// Tiempo de inactividad en segundos (10 minutos)
$inactivityTime = 10 * 60;

if (isset($_SESSION['last_activity'])) {
    $inactive = time() - $_SESSION['last_activity'];
    if ($inactive >= $inactivityTime) {
        session_unset();
        session_destroy();
        header("Location: sistema/");
        exit();
    }
}

$_SESSION['last_activity'] = time();

if (!empty($_SESSION['active'])) {
    header('location: sistema/');
    exit();
}

if (!empty($_POST)) {
    if (empty($_POST['username']) || empty($_POST['pass'])) {
        $alert = "Ingrese su nombre de usuario y su clave";
    } else {
        require_once "db.php";

        $user = mysqli_real_escape_string($conection, $_POST['username']);
        $pass = mysqli_real_escape_string($conection, $_POST['pass']);

        $query = mysqli_query($conection, "SELECT u.id, u.nombre, u.username, u.email, u.pass, u.state, u.rol, r.rango AS n_rol 
                                            FROM user u
                                            INNER JOIN rol r ON u.rol = r.id
                                            WHERE u.username = '$user' AND u.state = 1");
        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $data = mysqli_fetch_array($query);

            if (password_verify($pass, $data['pass'])) {
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['id'];
                $_SESSION['Nuser'] = $data['nombre'];
                $_SESSION['user'] = $data['username'];
                $_SESSION['rol'] = $data['rol'];
                $_SESSION['Nrol'] = $data['n_rol'];

                header('location: sistema/');
                exit();
            } else {
                $alert = "El usuario o la clave son incorrectos";
                session_destroy();
            }
        } else {
            $alert = "El usuario o la clave son incorrectos";
            session_destroy();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="img/16.png" sizes="16x16">
    <title>BE Estudio Contable</title>
    <script src="./js/inactivity.js"></script>
</head>

<body style="background: url('./img/1.webp'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p><img src="img/16.png" alt=""></p>
            </div>
            <div class="nav-menu" id="navMenu">
                <!-- <ul>
                    <li><a href="#" class="link active"></a></li>
                    <li><a href="#" class="link"></a></li>
                    <li><a href="#" class="link"></a></li>
                    <li><a href="#" class="link"></a></li>
                </ul> -->
            </div>
            <div class="nav-button">
                <a class="be" for=""><b>BE Estudio Contable </b></a>
            </div>
            <!-- <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div> -->
        </nav>

        <div class="form-box">
            <div class="login-container" id="login">
                <form action="" method="post">
                    <div class="top">
                        <header>Iniciar Sesión</header>
                        <div class="alert" style="color: red;"><b><?php echo isset($alert) ? $alert : ''; ?></b></div>
                    </div>
                    <div class="input-box">
                        <input type="text" name="username" class="input-field" placeholder="Usuario">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="pass" class="input-field" placeholder="Contraseña">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Acceder">
                    </div>
                    <div class="two-col">
                        <div class="two">
                            <!-- <label><a href="#">¿Has olvidado tu contraseña?</a></label> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");
            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }

        var a = document.getElementById("loginBtn");
        var b = document.getElementById("registerBtn");
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function login() {
            x.style.left = "4px";
            y.style.right = "-520px";
            a.className += " white-btn";
            b.className = "btn";
            x.style.opacity = 1;
            y.style.opacity = 0;
        }

        function register() {
            x.style.left = "-510px";
            y.style.right = "5px";
            a.className = "btn";
            b.className += " white-btn";
            x.style.opacity = 0;
            y.style.opacity = 1;
        }
    </script>

</body>

</html>