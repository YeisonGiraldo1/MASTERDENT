<!-- 
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Estaciones</title>

</head>

<body>

    <h2>Información detallada por estación 2</h2>
    <form action="BusquedaRotulosPorEstacion.php" method="get">
        <div class="mb-3">



            <label for="estaciones" class="form-label">Seleccionar estación</label>
            <select class="form-select" id="estaciones" name="estaciones" aria-label="Default select example">
                <option selected>Selecciona una estacion</option>

                $sql1 = "SELECT * from estaciones2 ORDER BY id ASC";
                $result = mysqli_query($conexion, $sql1);

                while ($mostrar = mysqli_fetch_array($result)) {
                    echo '<option value="' . $mostrar["id"] . '">' . $mostrar["nombre"] . '</option>';
                    $estacion = $mostrar["id"];
                    echo $estacion;
                }
            </select>

            <input type="submit" name="Buscar">
        </div>
    </form>

    <br> </br>

</body>

<body>


    <button onclick="location.href='../control/formularioEmplaquetado2.php'">Emplaquetado</button>
    <br></br>
    <button onclick="location.href='../control/consolidadoEstaciones/consolidadoEstaciones2.php'">Consolidado Estaciones</button>
    <button onclick="location.href='../control/vistas/modulos/verTablaPedidos.php?origenBusqueda=terminacion'">Pedidos Terminación</button>
    <button onclick="location.href='../control/vistas/modulos/verTablaPedidos.php?origenBusqueda=almacen'">Pedidos Almacén</button>

    </div>
    <p>Actualmente estamos trabajando las nuevas funcionalidades para la vista de pedidos</p>

</body>

</html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        width: 100%;
    }

    img {
        width: 100%;
    }

    hr {
        border: 1px solid #000;
        /* Línea negra horizontal */
        margin: 0;
        /* Eliminar el margen predeterminado del hr */
    }

    .titleContainer {
        width: 60%;
        height: 40%;
        margin: auto;
        background-color: #FFF;
        display: flex;
        align-items: center;
        margin-top: 10%;
        border-radius: 15px;

        justify-content: space-between;
        /* Espacio uniforme entre los elementos */
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;

    }

    .titleContainer h2 {
        width: 100%;
        text-align: center;
    }

    .images {
        width: 100%;
        height: 100%;
        z-index: -1;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .images .imageContainer {
        margin-top: 5%;
        display: flex;
        width: inherit;
        height: inherit;
        filter: blur(2px);
    }

    .images .imageContainer img {
        --image-w: 40%;
        width: auto !important;
        min-width: var(--image-w);
        max-width: var(--image-w);
        min-height: 95%;
        max-height: 95%;
        object-fit: cover;
    }
</style>

<body>
    <hr>
    <section class="images">
        <div class="imageContainer">
            <img src="../Public/imagenes/moldeado1.jpeg" alt="img1">
            <img src="../Public/imagenes/moldeado2.jpeg" alt="img2">
            <img src="../Public/imagenes/moldeado3.jpeg" alt="img3">
        </div>
    </section>
    <div class="titleContainer">
        <h2>BIENVENIDO AL SISTEMA MASTERDENT</h2>
        <div class="smile">
        </div>
    </div>

</body>

</html>