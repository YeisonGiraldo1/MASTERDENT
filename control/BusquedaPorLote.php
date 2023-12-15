<?php
 $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

    $lote=$_GET ["lote"];
    
    $sqlLote="SELECT id from lotes2 WHERE nombreL ='".$lote."' ORDER BY id LIMIT 1";
    $resultLote=mysqli_query($conexion,$sqlLote);
    while($mostrarLote=mysqli_fetch_array($resultLote)){
        $loteId=$mostrarLote['id'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RotulosPorLote</title>
    <!-- Agrega las referencias a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="text-center">
        <h1 class="mb-4">Rotulos del Lote <?php echo $lote ?></h1>
    </div>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>cod_rotulo</th>
                <th>referencia</th>
                <th>lote</th>
                <th>color</th>
                <th>pedido</th> 
                <th>#Moldes</th> 
                <th>juegos</th>
                <th>Estacion Actual</th>
                <th>fecha Producción</th>   
                <th>vuelta1</th>
                <th>vuelta2</th>
                <th>vuelta3</th>
                <th>vuelta4</th>
                <th>vuelta5</th>
                <th>vuelta6</th>
                <th>vuelta7</th>
                <th>vuelta8</th>                
                <th>total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT rotulos2.*, referencias2.`nombre` AS ref, lotes2.`nombreL` AS lote, colores2.`nombre` AS color, pedidos2.`codigoP` AS pedido, estaciones2.nombre AS estacion FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN lotes2 ON rotulos2.`loteId`= lotes2.`id` INNER JOIN colores2 ON rotulos2.`colorId`= colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido` = pedidos2.`idP` INNER JOIN estaciones2 ON rotulos2.`estacionId2` = estaciones2.`id`  WHERE rotulos2.`loteId` = '" . $loteId. "' ORDER BY rotulos2.`id` DESC";

            $result = mysqli_query($conexion, $sql);
            
            while($mostrar = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['cod_rotulo'] ?></td>
                <td><?php echo $mostrar['ref'] ?></td>
                <td><?php echo $mostrar['lote'] ?></td>
                <td><?php echo $mostrar['color'] ?></td>
                <td><?php echo $mostrar['pedido'] ?></td>
                <td><?php echo $mostrar['cantidadMoldes'] ?></td>
                <td><?php echo $mostrar['juegos'] ?></td>
                <td><?php echo $mostrar['estacion'] ?></td>
                <td><?php echo $mostrar['fecha'] ?></td>
                <td><?php echo $mostrar['vuelta1'] ?></td>
                <td><?php echo $mostrar['vuelta2'] ?></td>
                <td><?php echo $mostrar['vuelta3'] ?></td>
                <td><?php echo $mostrar['vuelta4'] ?></td>
                <td><?php echo $mostrar['vuelta5'] ?></td>
                <td><?php echo $mostrar['vuelta6'] ?></td>
                <td><?php echo $mostrar['vuelta7'] ?></td>
                <td><?php echo $mostrar['vuelta8'] ?></td>            
                <td><?php echo $mostrar['total'] ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaReferencias.php'">Ver tabla Referencias</button>
        <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaColores.php'">Ver tabla Colores</button>
        <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaEstaciones.php'">Ver tabla Estaciones</button>
    </div>

    <!-- Agrega la referencia a Bootstrap JS si es necesario -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
</body>
</html>
