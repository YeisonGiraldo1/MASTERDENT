<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Referencias</title>
    <!-- Agrega las referencias a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container">

    <button class="btn btn-primary mt-3" onclick="location.href='../control'">Inicio</button>

    <h1 class="mt-3">Tabla Referencias</h1>
    
    <br>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>nombre</th>
                <th>juegos</th>
                <th>totalMoldes</th>
                <th>tipo</th>
                <th>capas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM referencias2";
            $result = mysqli_query($conexion, $sql);
            
            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['juegos'] ?></td>
                <td><?php echo $mostrar['totalMoldes'] ?></td>
                <td><?php echo $mostrar['tipo'] ?></td>
                <td><?php echo $mostrar['capas'] ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Agrega la referencia a Bootstrap JS si es necesario -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
</body>
</html>
