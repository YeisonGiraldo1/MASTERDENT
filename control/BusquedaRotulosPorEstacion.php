<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

// Verificar si 'estaciones' está definida en $_GET
if (isset($_GET["estaciones"])) {
    $estacion = $_GET["estaciones"];
} else {
    // Si 'estaciones' no está definida en $_GET, verifica si está en $_POST
    if (isset($_POST['estacion'])) {
        $estacion = $_POST['estacion'];
    } else {
        // Maneja el caso en el que 'estaciones' no está en $_GET ni en $_POST.
        // Puedes asignar un valor por defecto o mostrar un mensaje de error.
        echo "La estación no se ha especificado ni en GET ni en POST.";
        // Puedes detener la ejecución del script o realizar otra acción apropiada aquí.
        exit;
    }
}

// Ahora puedes usar $estacion en tu código.
    
    $id = isset( $_POST['id'] ) ? $_POST['id'] : '';
    $referencia = isset( $_POST['referencia'] ) ? $_POST['referencia'] : '';
    $color = isset( $_POST['color'] ) ? $_POST['color'] : '';
    $pedido = isset( $_POST['pedido'] ) ? $_POST['pedido'] : '';
    $lote = isset( $_POST['lote'] ) ? $_POST['lote'] : '';
    $fechaDesde = isset( $_POST['fechaDesde'] ) ? $_POST['fechaDesde'] : '';
    $fechaHasta = isset( $_POST['fechaHasta'] ) ? $_POST['fechaHasta'] : '';
    
    
    
    
    
   $filtros = array();
    if ($estacion != ''){
            $filtros[]= "rotulos2.`estacionId2` = '$estacion'";
    }
    if ($id != ''){
            $filtros[]= "rotulos2.`id` = '$id'";
    }
    if ($referencia != ''){
        
         // busco el id de la referencia según su nombre en la tabla referencias2
                
                
$sqlRef= "SELECT `id` FROM `referencias2` WHERE nombre LIKE '%$referencia%'";
$resultRef=mysqli_query($conexion,$sqlRef);       

     
                while($mostrarRef=mysqli_fetch_array($resultRef)){
                    $referencia=$mostrarRef['id'];
                   
            }
            
            $filtros[]= "rotulos2.`referenciaId` = '$referencia'";
            
                
    }
    if ($color != ''){
        
         // busco el id del color según su nombre 
                
                
$sqlCol= "SELECT `id` FROM `colores2` WHERE nombre = '$color'";
$resultCol=mysqli_query($conexion,$sqlCol);       

     
                while($mostrarCol=mysqli_fetch_array($resultCol)){
                    $color=$mostrarCol['id'];
                   
            }
            
            $filtros[]= "rotulos2.`colorId` = '$color'";
    }
    if ($pedido != ''){
        
        // busco el id del pedido según su nombre 
                
                
$sqlPed= "SELECT `idP` FROM `pedidos2` WHERE codigoP = '$pedido'";
$resultPed=mysqli_query($conexion,$sqlPed);       

     
                while($mostrarPed=mysqli_fetch_array($resultPed)){
                    $pedido=$mostrarPed['idP'];
                   
            }
            
            $filtros[]= "rotulos2.`pedido` = '$pedido'";
    }
    if ($lote != ''){
        
         // busco el id del lote según su nombre 
                
                
$sqlLot= "SELECT `id` FROM `lotes2` WHERE nombreL = '$lote'";
$resultLot=mysqli_query($conexion,$sqlLot);       

     
                while($mostrarLot=mysqli_fetch_array($resultLot)){
                    $lote=$mostrarLot['id'];
                   
            }
        
            $filtros[]= "rotulos2.`loteId` = '$lote'";
    }
    if ($fechaDesde != '' and $fechaHasta != ''){
            $filtros[]= "rotulos2.`fechaActualizacion` BETWEEN '$fechaDesde%' AND '$fechaHasta%'";
    }
    
    $consultaFiltros='SELECT rotulos2.*, referencias2.`nombre` AS ref, lotes2.`nombreL` AS lote, colores2.`nombre` AS color, pedidos2.`codigoP` AS pedido FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN lotes2 ON rotulos2.`loteId`= lotes2.`id` INNER JOIN colores2 ON rotulos2.`colorId`= colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido`= pedidos2.`idP` WHERE ';
    
    $consultaSuma = 'select sum(total) as totales FROM rotulos2 WHERE ';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Public/imagenes/terminacion4.jpeg');
            background-size: cover;
        }
           .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }
        
    </style>
	<meta charset="UTF-8">
	<title>PorEstacion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>


        <div class="text-center">
            <button class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
            <button class="btn btn-primary" onclick="location.href='../control/historialEstacion.php?estaciones=<?php echo $estacion ?>&Buscar=Enviar'">Historial Estación</button>

    <?php
        $sql2 = "SELECT nombre from estaciones2 WHERE id ='" . $estacion . "'";
        $result2 = mysqli_query($conexion, $sql2);
        
        // A continuación presento botones según la estación.
        
        switch ($estacion){
            case 7:
                ?>
                <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaPedidos.php'">Ver tabla Pedidos</button>
                <button class="btn btn-primary" onclick="location.href='../control/vistas/modulos/verTablaListasGeneral.php'">Ver Lista de Empaque Global</button>
                <button class="btn btn-primary" onclick="location.href='../control/formulario_pedidos.php'">Nuevo Pedido</button>
                <button class="btn btn-primary" onclick="location.href='../control/formulario_clientes.php'">Nuevo Cliente</button>
                <button class="btn btn-primary" onclick="location.href='../control/listaFiltro.php'">Lista de empaque</button>
                <button class="btn btn-primary" onclick="location.href='../control/PDL/inventario_Pdl.php'">Inventario PDL</button>
    
               
    
                <?php
                break;
        
            case 1:
    
                ?>
                <button class="btn btn-primary"  onclick="location.href='../control/vistas/modulos/verTablaTiempoPrensas.php'">Tiempos Prensas</button>
                <button class="btn btn-primary"  onclick="location.href='../control/vistas/modulos/verTablaPrensadas.php'">Cuenta Prensadas</button>
                <button class="btn btn-primary"  onclick="location.href='../control/formulario_temperaturaPrensas.php'">Temperatura Planchas</button>
                <!--<button onclick="location.href='../control/nuevaProgramacion.php'">Programación de Producción</button>-->
                <button class="btn btn-primary"  onclick="location.href='../control/progProduccion/progProduccion1.php'">Programación</button>
                <!--<button onclick="location.href='../control/interaccion_arduino.php?proceso_php=9&rotulo_php=700'">simulaciónTags</button>-->
    
                
    
                <?php
                break;
            case 2:
                break;
            case 6:
                ?>
                <button class="btn btn-primary"  onclick="location.href='../control/simuladorInteraccionArduino.php'">Simulador de interacción arduino</button>
                <?php
                break;
        }
    ?>
     </div>
   
    <br>
        <h1 class="text-center">Producción actualmente en 
        <?php
            while($mostrar2=mysqli_fetch_array($result2)){
                $estacionActual=$mostrar2['nombre'];
        ?>
        <td><?php echo $estacionActual ?></td>
        <?php
        }
        ?>
        </h1>
    </div>

    <!--<button onclick="location.href='../control/'">Ver Historial</button>-->
    

    

<div class="container">



        <form action="BusquedaRotulosPorEstacion.php" method="POST" class="mx-auto">
          
        <div class="row">

        <div class="col-md-4">
                <label for="id" class="form-label">Id</label>
                <input type="text" size="15" class="form-control" id="id" name="id">
                </div>
                
        <div class="col-md-4">
                <label for="referencia" class="form-label">Referencia</label>
                <input type="text" size="15" class="form-control" id="referencia" name="referencia">
                </div>

                
        <div class="col-md-4">
                <label for="color" class="form-label">Color</label>
                <input type="text" size="15" class="form-control" id="color" name="color">
                     </div> 
                </div>

                <div class="row">


                <div class="col-md-6">
                <label for "pedido" class="form-label">Pedido</label>
                <input type="text" size="15" class="form-control" id="pedido" name="pedido">
                </div>     
        

                <div class="col-md-6">
                <label for="lote" class="form-label">Lote</label>
                <input type="text" size="15" class="form-control" id="lote" name="lote">
                </div>
            </div>

                <h3>Ingresada a la estación entre</h3>
                    

                <div class="row">
    


                <div class="col-md-6">
                <label for="fechaDesde" class="form-label">Fecha Desde</label>
                <input type="Date" class="form-control" id="fechaDesde" name="fechaDesde" placeholder="fecha de inicio">
                </div>

                    
                <div class="col-md-6">
                <label for="fechaHasta" class="form-label">Fecha Hasta</label>
                <input type="Date" class="form-control" id="fechaHasta" name="fechaHasta" placeholder="fecha de fin">
                </div>   
            </div>
                    
                <input name="estacion" type="hidden" value="<?php echo $estacion; ?>">
                <br>

                <div class="row">
                <div class="col-md-12">
                <input type="submit" name="Empacar" class="btn btn-success" >
                </div>   
            </div>
        </form>
    


    <br></br>
        
    <table class="table table-dark table-striped">
        <tr>
            <td>id</td>
            <!--<td>cod_rotulo</td>-->
            <td>referencia</td>
            <td>color</td>
            <td>pedido</td>
            <td>lote</td>
            <!-- <td>cantidadMoldes</td>                -->
            <td>juegos</td>
            <td>Fecha Producción</td>
            <td>Ingreso a <?php echo $estacionActual?></td>
        </tr>
            
        <?php
            //$sql="SELECT * from Rotulo";
            //$sql= "SELECT * from rotulos2 WHERE estacionId2 ='". $estacion. "'";
            //$sql= "SELECT rotulos2.*, referencias2.`nombre` AS ref, colores2.`nombre` AS color FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id`  INNER JOIN colores2 ON rotulos2.`colorId`= colores2.`id`  WHERE rotulos2.`estacionId2` = '". $estacion. "'";
            echo  $fechaDesde." - ". $fechaHasta;
            
            $sql= $consultaFiltros." ". implode(" AND ",$filtros) ." ORDER BY rotulos2.`fechaActualizacion` DESC";
            //echo $sql;
            $result=mysqli_query($conexion,$sql);
            
            while($mostrar=mysqli_fetch_array($result)){
        ?>

        <tr>
            <td><?php echo $mostrar['id'] ?></td>
            <!--<td><//?php echo $mostrar['cod_rotulo'] ?></td>-->
            <td><?php echo $mostrar['ref'] ?></td>
            <td><?php echo $mostrar['color'] ?></td>
            <td><?php echo $mostrar['pedido'] ?></td>
            <td><?php echo $mostrar['lote'] ?></td>
            <!--<td><?php //echo $mostrar['cantidadMoldes'] ?></td>-->
            <td><?php echo $mostrar['total'] ?></td>
            <td><?php echo $mostrar['fecha'] ?></td>
            <td><?php echo $mostrar['fechaActualizacion'] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <br>
        
    <table class="table table-dark table-striped">
        <tr>
            <td>TOTAL JUEGOS</td>
        </tr>
            
        <?php
            //$sql="select * , COUNT(id), sum(juegos) as total FROM listaEmpaque WHERE pedidoId ='". $pedido. "' AND mold = '". $referencia. "' AND shade = '".$color."' GROUP BY mold, shade, lote, uppLow, caja ORDER BY mold;";
            $sqlSuma=$consultaSuma." ". implode(" AND ",$filtros);
            $resultSuma=mysqli_query($conexion,$sqlSuma);
            
            //echo $sqlSuma;
            //echo var_dump($filtros);
            
            while($mostrarSuma=mysqli_fetch_array($resultSuma)){
        ?>
        <tr>
                
            <td><?php echo $mostrarSuma['totales'] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br></br>
</div>
</body>
</html>