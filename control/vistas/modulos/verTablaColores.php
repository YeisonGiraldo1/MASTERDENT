<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colores</title>
    <!-- Agrega las referencias a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h1 class="text-center mb-4">Tabla Colores</h1>
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM colores2";
            $result = mysqli_query($conexion, $sql);
            
            while($mostrar = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
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