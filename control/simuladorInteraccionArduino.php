<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
    

$estacion = isset($_GET["estaciones"]) ? $_GET["estaciones"] : '';

if (is_null($estacion)) {
    $estacion = isset($_POST["estacion"]) ? $_POST["estacion"] : '';
}

    
    $id = isset( $_POST['id'] ) ? $_POST['id'] : '';
    $referencia = isset( $_POST['referencia'] ) ? $_POST['referencia'] : '';
    $color = isset( $_POST['color'] ) ? $_POST['color'] : '';
    $pedido = isset( $_POST['pedido'] ) ? $_POST['pedido'] : '';
    $lote = isset( $_POST['lote'] ) ? $_POST['lote'] : '';
    $fecha = isset( $_POST['fecha'] ) ? $_POST['fecha'] : '';
    
    
    
    
    
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
    if ($fecha != ''){
            $filtros[]= "rotulos2.`fechaActualizacion` LIKE '$fecha%'";
    }
    
    $consultaFiltros='SELECT rotulos2.*, referencias2.`nombre` AS ref, lotes2.`nombreL` AS lote, colores2.`nombre` AS color, pedidos2.`codigoP` AS pedido FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN lotes2 ON rotulos2.`loteId`= lotes2.`id` INNER JOIN colores2 ON rotulos2.`colorId`= colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido`= pedidos2.`idP` WHERE ';
    
    $consultaSuma = 'select sum(total) as totales FROM rotulos2 WHERE ';



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Simulador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <button  class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
    
    
    <center>
   

        <h2>Datos que envía el Módulo electrónico al programa</h2>
            
            <br>
            
<!--<button onclick="location.href='../control/'">Ver Historial</button>-->

            <form action="interaccion_arduino.php" method="get">
            
            
            <div class="row">

            <div class="col-md-3">
                    <label for="proceso_php" class="form-label">proceso_php</label>
                    <input type="text" size="15" class="form-control "  id="proceso_php" name="proceso_php">
                    </div>
        

                    <div class="col-md-3">
                    <label for="cuentaLecturas_php" class="form-label">cuentaLecturas_php</label>
                    <input type="text" size="15" class="form-control "  id="cuentaLecturas_php" name="cuentaLecturas_php">
                    </div>
        

                    <div class="col-md-3">
                    <label for="hum_php" class="form-label">estación/hum_php</label>
                    <input type="text" size="15" class="form-control "  id="hum_php" name="hum_php">
                    </div>
        


                    <div class="col-md-3">
                    <label for="temp_php" class="form-label">juegos/gramos/temp_php</label>
                    <input type="text" size="15" class="form-control "  id="temp_php" name="temp_php">
                    </div>
        
                    </div>
        

                    <div class="row">
                    <div class="col-md-4">
                    <label for="pre_php" class="form-label">id_molde/juegosMalos_pre_php</label>
                    <input type="text" size="15" class="form-control "  id="pre_php" name="pre_php">
                    </div>
        

                    <div class="col-md-4">
                    <label for="dist_php" class="form-label">cod_molde/idEmplaquetador/dist_php</label>
                    <input type="text" size="15" class="form-control "  id="dist_php" name="dist_php">
                    </div>
        

                    <div class="col-md-4">
                    <label for="rotulo_php" class="form-label">rotulo_php</label>
                    <input type="text" size="15" class="form-control "  id="rotulo_php" name="rotulo_php">
                    
                    </div>
                    </div>
        <br>

                    
                   
                    
                     

                
                <input  class="btn btn-success" type="submit" name="Empacar" >
            </form>
              
<br></br>
    
   
        <br></br>




    </br>
</center>
</body>
</html>