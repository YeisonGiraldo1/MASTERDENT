<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>materialPreparado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <center>
        <div class="container">
            <h1>Material Preparado</h1>
            <br>
            <h2>Disponible por color</h2>
            <br>

            <table class="table table-striped">
                <tr>

                    <td>Color</td>
                    <td>Gramos</td>

                </tr>


                <table e class="table table-striped">
                    <tr>
                        <td>id</td>
                        <td>color</td>
                        <td>lote</td>
                        <td>Peso(gramos)</td>
                        <td>ubicación</td>
                        <td>fecha</td>

                    </tr>

                    <?php
                    //$sql="SELECT * from Rotulo";
                    $sql = "SELECT materialPreparado.*, colores2.nombre AS nombreC, lotes2.nombreL AS nombreL, estaciones2.nombre AS nombreE FROM materialPreparado INNER JOIN colores2 ON materialPreparado.colorId = colores2.id INNER JOIN lotes2 ON materialPreparado.loteId = lotes2.id INNER JOIN estaciones2 ON materialPreparado.ubicacion = estaciones2.id ORDER BY materialPreparado.id DESC LIMIT 100;";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo max($mostrar['id'], 0) ?></td>
                            <td><?php echo $mostrar['nombreC'] ?></td>
                            <td><?php echo $mostrar['nombreL'] ?></td>
                            <td><?php echo max($mostrar['cantidadBolsas'], 0) ?></td>
                            <td><?php echo $mostrar['nombreE'] ?></td>
                            <td><?php echo $mostrar['fechaCreacion'] ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>

        </div>
    </center>
</body>

</html>
