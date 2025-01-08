<?php

if (empty($_SESSION['active'])) {
    header('location: ../');
}

?>

<header>
    <div class="header">
        <h1 class="encabezado"><?php //echo $nombreEmpresa; ?></h1>
        <div class="optionsBar">
            <p class="fecha">Paraguay, <?php echo fechaC(); ?></p>
            <span>|</span>
            <span class="user"><?php echo $_SESSION['nombre'] . " - " . $_SESSION['Nrol']; ?></span>
            <img class="photouser" src="img/user.png" alt="Usuario">
            <a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
        </div>
    </div>
    <?php include "navlateral.php"; ?>
</header>

<div class="modal">
    <div class="bodyModal">

    </div>
</div>