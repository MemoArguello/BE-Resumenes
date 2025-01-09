<?php
if (empty($_SESSION['active'])) {
    header('location: ../');
}

include "../db.php";

//	Datos de la Empresa
$nombreEmpresa = '';

$query_empresa = mysqli_query($conection, "SELECT * FROM configuracion");
$row_empesa = mysqli_num_rows($query_empresa);

if ($row_empesa > 0) {
    while ($arrayInfoEmpresa  = mysqli_fetch_assoc($query_empresa)) {
        $nombreEmpresa = $arrayInfoEmpresa['nombre'];
    }
}
?>

<div class="sidebar close">
    <div class="logo-details">
        <img src="img/logo_be.png" alt="logo">
        <span class="logo_name"><?php echo htmlspecialchars($nombreEmpresa); ?></span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="index.php">
                <i class="fa-solid fa-chart-line"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="index.php">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bx bx-collection"></i>
                    <span class="link_name">Clientes</span>
                </a>
                <i class="bx bxs-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Clientes</a></li>
                <li><a href="reg_client.php">Clientes</a></li>
                <li><a href="reg_oblig.php">Obligaciones</a></li>
                <li><a href="reg_salary.php">Salarios</a></li>
            </ul>
        </li>
        <li>
            <a href="reg_sumary.php">
                <i class="fa-regular fa-folder-open"></i>
                <span class="link_name">Resumenes</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="reg_summary.php">Resumenes</a></li>
            </ul>
        </li>
        <?php if ($_SESSION['rol'] == 1) { ?>
            <li>
                <a href="reg_usuario.php">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="link_name">Usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="reg_usuario.php">Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="lista_user.php">
                    <i class="fa-solid fa-list"></i>
                    <span class="link_name">Lista de Usuarios</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="lista_user.php">Lista de Usuarios</a></li>
                </ul>
            </li>
            <li>
                <a href="configuracion.php">
                    <i class="fa-solid fa-gear"></i>
                    <span class="link_name">Configuración</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="configuracion.php">Configuración</a></li>
                </ul>
            </li>
        <?php } ?>
    </ul>
    <div class="profile-details">
        <div class="profile-content">
            <img src="img/user.png" alt="profile">
        </div>
        <div class="name-job">
            <div class="profile_name"><?php echo htmlspecialchars($_SESSION['Nuser']); ?></div>
            <div class="job"><?php echo htmlspecialchars($_SESSION['Nrol']); ?></div>
        </div>
        <a href="salir.php">
            <i class="bx bx-log-out"></i>
        </a>
    </div>
</div>

<section class="home-section">
    <div class="home-content">
        <i class="bx bxs-chevron-right arrow_menu"></i>
        <p style="margin-left: 50px;" class="fecha">Paraguay, <?php echo fechaC(); ?></p>
        <span class="text"></span>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Control de submenús
        document.querySelectorAll('.arrow').forEach(arrow => {
            arrow.addEventListener('click', () => {
                arrow.parentElement.parentElement.classList.toggle('showMenu');
            });
        });

        // Control del menú colapsado
        const sidebar = document.querySelector('.sidebar');
        const sidebarBtn = document.querySelector('.bxs-chevron-right');
        sidebarBtn.addEventListener('click', () => {
            sidebar.classList.toggle('close');
        });

        // Rotación del ícono de menú
        const arrowMenu = document.querySelector('.arrow_menu');
        arrowMenu.addEventListener('click', () => {
            arrowMenu.classList.toggle('rotated');
        });
    });
</script>