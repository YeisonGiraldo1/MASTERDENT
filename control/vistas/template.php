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
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["barraprincipal"])) {
        $_SESSION["barraprincipal"] = "mostrar"; // Por defecto, mostrar la barra principal
    }

    $condition = isset($_GET["action"]) && $_GET["action"] == "template2";



 
    if (isset($_GET["menu"])) {
        $menu = $_GET["menu"];
        if (isset($menu) && !empty($menu)) {//validar que menu no este vacio
            include "modulos/$menu" . ".php";
        }
    } else if(!$condition) include "modulos/navegacion.php"; //incluye la barra de navegacion principal si la variable de session lo permite
    
   
    

    ?>

    <section>
        <?php
        $mvc = new MvcController();
        $mvc->enlacesPaginasController();


        ?>
    </section>


</body>

</html>