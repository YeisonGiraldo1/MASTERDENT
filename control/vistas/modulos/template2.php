<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["barraprincipal"] = "ocultar"; // Ocultar la barra principal
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Template</title>

    <style>
        section {
            height: 100vh;
            /* Usamos la altura de la ventana del navegador para centrar verticalmente */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            /* Para alinear verticalmente */
            justify-content: center;
            align-items: center;
            text-align: center;

        }
    </style>

</head>

<body>


    <?php


if (isset($_GET["submenu"]) && $_GET["submenu"] == "estacion_terminacion") {
    include "navegacion_terminacion.php";
} else {

    if (isset($_GET["submenu"]) && $_GET["submenu"] == "estacion_almacen") {
        include "navegacion_almacen.php";
    } else {
        include "navegacion_moldeado.php"; // Incluye la barra de navegación secundaria
    }
}
    ?>

    <section>
        <?php
        $mvc = new MvcController();
        $mvc->enlacesPaginasController2();




        ?>
    </section>


</body>

</html>