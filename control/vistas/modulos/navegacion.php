<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (isset($_SESSION['Nombres']) && isset($_SESSION['Apellidos'])) {
    $Nombres = $_SESSION['Nombres'];
    $Apellidos = $_SESSION['Apellidos'];

} else {
    // Si no hay usuario autenticado, se redirige al iniciar sesion
    header("Location: index.php?action=login");
    exit(); // detiene la ejecucion
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        font-family: "Open Sans", sans-serif;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    body {
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    header {
        width: 100%;
        background-color: #284886;
        padding: 1rem;
    }

    .interior {
        max-width: 100%;
        padding: 0 10px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        float: left;
        padding: 15px 20px 0;
    }

    .logo img {
        height: 60px;
    }

    .logo img:hover {
        transform: scale(1.1);
    }

    .navegacion ul {
        list-style: none;
        padding: 0 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
    }

    .navegacion ul li {
        display: inline-block;
        position: relative;
        transition: .3s linear;
    }

    .navegacion ul li:hover {
        transform: scale(1.1);
    }

    .navegacion ul li a {
        color: #ffffff; /* Blanco intenso */
        text-align: center;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
        padding: 12px 20px;
        transition: .3s linear;
        text-stroke: 1px white; /* Contorno blanco */
        text-shadow: 1px 1px 2px white; /* Sombra blanca */
    }

    .navegacion ul li a:hover {
        color: #ffffff; /* Blanco intenso */
        transform: scale(1.1);
    }

    .navegacion ul li:hover .hijos {
        display: block;
    }

    .navegacion .submenu {
        background-color: #284886;
    }

    .navegacion .submenu .hijos {
        display: none;
        background: #284886;
        position: absolute;
        width: auto;
    }

    .navegacion .submenu .hijos li {
        display: block;
        overflow: hidden;
        border-bottom: none;
    }

    .navegacion .submenu .hijos li a {
        display: block;
    }

    .navegacion ul li:hover .subhijos {
        display: block;
    }

    .navegacion li ul li .subhijos {
        position: relative;
    }

    /* Additional CSS for dropdown on hover */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }
</style>



</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-">
            <a class="navbar-brand" href="#">
                <img src="../Public/imagenes/nuevamasterdent.png" alt="Logo" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item" >
                        <a class="nav-link" href="#">Home</a>
                    </li> -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php?action=estaciones" id="estacionesDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Estaciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="estacionesDropdown">
                            <a class="dropdown-item"
                                href="index.php?action=template2&submenu=estacion_moldeado">Moldeado</a>
                            <a class="dropdown-item"
                                href="index.php?action=template2&submenu=estacion_terminacion">Terminacion</a>
                            <a class="dropdown-item"
                                href="index.php?action=template2&submenu=estacion_almacen">Almacen</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=fallos_masterdent">Mantenimiento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=registro_usuario">Nuevo Usuario</a>
                    </li>
                   


                <!-- Bloque del nombre y el icono -->
                <div style="padding-left: 380px;" class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Hola, <?php echo $Nombres; ?>
                                <?php echo $Apellidos; ?>
                                
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="index.php?action=estaciones" id="estacionesDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index.php?action=cerrar_sesion">Cerrar Sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>