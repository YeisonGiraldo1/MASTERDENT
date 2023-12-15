<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

    $rotulo=$_GET ["rotulos"];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RotulosPorEstacion</title>
    <!-- Agrega las referencias a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="text-center">
        <?php
            $sql2= "SELECT id from rotulos2 WHERE id ='". $rotulo. "'";
            $result2=mysqli_query($conexion,$sql2);
        ?>

        <h1>Detalles del rótulo <?php while($mostrar2=mysqli_fetch_array($result2)){ $idRotulo=$mostrar2['id']; echo $mostrar2['id']; } ?></h1>
    </div>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
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
                $sql= "SELECT rotulos2.*, referencias2.`nombre` AS ref, lotes2.`nombreL` AS lote, colores2.`nombre` AS color, pedidos2.`codigoP` AS pedido, estaciones2.`nombre` AS estacion FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN lotes2 ON rotulos2.`loteId`= lotes2.`id` INNER JOIN colores2 ON rotulos2.`colorId`= colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido` = pedidos2.`idP` INNER JOIN estaciones2 ON rotulos2.`estacionId2` = estaciones2.`id` WHERE rotulos2.`id` = '" . $rotulo. "'";
                $result=mysqli_query($conexion,$sql);
            
                while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
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

    <div class="text-center mt-4">
        <h1>Datos Básicos</h1>
    </div>
        
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>referencia</th>
                <th>color</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sqlBasico= "SELECT rotulos2.*, referencias2.`nombre` AS ref,  colores2.`nombre` AS color FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id`  INNER JOIN colores2 ON rotulos2.`colorId`= colores2.`id`  WHERE rotulos2.`id` = '" . $rotulo. "'";
                $resultBasico=mysqli_query($conexion,$sqlBasico);
                
                while($mostrarBasico=mysqli_fetch_array($resultBasico)){
            ?>
            <tr>
                <td><?php echo $mostrarBasico['id'] ?></td>
                <td><?php echo $mostrarBasico['ref'] ?></td>
                <td><?php echo $mostrarBasico['color'] ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <h1>Trazabilidad del rótulo <?php echo $idRotulo; ?></h1>
    </div> 
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Estación</th>
                <th>Ingreso</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql= "SELECT rotuloestaciones2.*,  estaciones2.`nombre` AS estacion FROM rotuloestaciones2 INNER JOIN estaciones2 ON rotuloestaciones2.`estacionId` = estaciones2.`id` WHERE rotuloestaciones2.`rotuloId2` = '" . $rotulo. "' ORDER BY rotuloestaciones2.`id` DESC";
                $result=mysqli_query($conexion,$sql);
                
                while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['estacion'] ?></td>
                <td><?php echo $mostrar['ingreso'] ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <h1>Detalle del pedido</h1>
    </div>
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>RotuloId</th>
                <th>Pedidos</th>
                <th>Granel</th>
                <th>Programados</th>
                <th>Producidos</th>
                <th>Pulidos</th>
                <th>EnSeparación</th>
                <th>Separados</th>
                <th>EnEmplaquetado</th>
                <th>Emplaquetados</th>
                <th>Revisión 1</th>
                <th>Revisión 2</th>
                <th>Empacados</th>
                <th>Calidad</th>
                <th>Colaborador</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql= "SELECT * FROM `pedidoDetalles` WHERE rotuloId= '" . $rotulo. "'";
                $result=mysqli_query($conexion,$sql);
                
                while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar["rotuloId"] ?></td>
                <td><?php echo $mostrar["juegos"] ?></td>
                <td><?php echo $mostrar["granel"]?></td>
                <td><?php echo $mostrar["programados"]?></td>
                <td><?php echo $mostrar["producidos"]?></td>
                <td><?php echo $mostrar["pulidos"]?></td>
                <td><?php echo $mostrar["enSeparacion"]?></td>
                <td><?php echo $mostrar["separado"]?></td>
                <td><?php echo $mostrar["enEmplaquetado"]?></td>
                <td><?php echo $mostrar["emplaquetados"]?></td>
                <td><?php echo $mostrar["revision1"]?></td>
                <td><?php echo $mostrar["revision2"]?></td>
                <td><?php echo $mostrar["empacados"]?></td>
                <td><?php echo $mostrar["calidad"]?></td>
                <td><?php echo $mostrar["colaborador"]?></td>
                <td><?php echo $mostrar["fechaCreacion"]?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaReferencias.php'">Ver tabla Referencias</button>
        <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaColores.php'">Ver tabla Colores</button>
        <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaEstaciones.php'">Ver tabla Estaciones</button>
    </div>
    </center>
</body>
</html>