<?php

$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

$totalInventario = 0;

$fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : '';
$fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : '';

$filtros = array();

if ($fechaDesde != '' && $fechaHasta != '') {
    $filtros[] = "pedidoDetalles.fechaCreacion BETWEEN '$fechaDesde%' AND '$fechaHasta%'";
}

if (empty($filtros)) {
    $filtros[] = "1";
} else {
    if (is_null($filtros[0])) {
        $filtros[0] = "1";
    }
}

$consultaFiltros = 'select sum(revision2) as total, pedidos2.linea as linea FROM pedidoDetalles INNER JOIN pedidos2 ON pedidoDetalles.pedidoId = pedidos2.idP WHERE ';

$sumaSTARPLUS = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'STARPLUS', $totalInventario);
$sumaRESISTAL = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'RESISTAL', $totalInventario);
$sumaUHLERPLUS = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'UHLERPLUS', $totalInventario);
$sumaREVEAL = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'REVEAL', $totalInventario);
$sumaSTARDENT = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'STARDENT', $totalInventario);
$sumaSTARVIT = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'STARVIT', $totalInventario);
$sumaZENITH = calcularSumaLinea($conexion, $consultaFiltros, $filtros, 'ZENITH', $totalInventario);

function calcularSumaLinea($conexion, $consultaFiltros, $filtros, $linea, &$totalInventario)
{
    $consulta = $consultaFiltros . " " . (empty($filtros) ? "" : implode(" AND ", $filtros)) . " AND linea = '$linea'";
    $result = mysqli_query($conexion, $consulta);

    $suma = 0;

    while ($mostrar = mysqli_fetch_array($result)) {
        $total = $mostrar['total'];
        $suma += max(0, $total);
        $totalInventario += max(0, $total);
    }

    return $suma;
}

// Resto del código HTML
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TerminadoConsolidado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
          body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Public/imagenes/almacen2.jpeg');
            background-size: cover;
        }
           .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }

        .gray-table {
            background-color: #ccc; /* Color gris de fondo */
        }
    </style>
</head>
</head>
<body>
    
    <button class="btn btn-primary"  onclick="location.href='../control'">Inicio</button>

    <div class="container">
<center>
    <!--<h3><BASEFONT SIZE="20"><?php //echo $fechaActual = date ( 'Y-m-d' );?></h3>-->
    <h1>Producto Terminado Consolidado</h1>
    
    
    
<div class="row">
            <form action="consolidadoAsignado.php" method="POST">
            
          
            <div class="row">
                    

            <div class="col-md-6">
                    <label for="fechaDesde" class="form-label">Desde</label>
                    <input type="Date" class="form-control" id="fechaDesde" name="fechaDesde" placeholder="Ingresa la fecha" >
                    </div>

                    <div class="col-md-6">
                    <label for="fechaHasta" class="form-label">Hasta</label>
                    <input type="Date" class="form-control" id="fechaHasta" name="fechaHasta" placeholder="Ingresa la fecha" >
                    </div>
                    </div>
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;  
                    ?>">
                     
<br><br>
                
                <input type="submit" name="Empacar" class="btn btn-success"  >
                
            </form>
       
    
    <?php
    if($fechaDesde != ''){
    echo "Entregado a bodega desde $fechaDesde hasta $fechaHasta";
    }
    ?>
   
   <table style="margin-top: 30px;" class="table table-bordered table-striped gray-table">
            <tr>
                
                <td><H2>LÍNEA</H2></td>
                <td><H2>JUEGOS</H2></td>
                
               
                
            </tr>
            
            <?php
            
           
            
          
            
           
            ?>
            <tr>
                <td>STARPLUS</td>
                <td><?php echo $sumaSTARPLUS ?></td>
                
                      
            </tr>
            
            <tr>
                <td>RESISTAL</td>
                <td><?php echo $sumaRESISTAL ?></td>
                
                      
            </tr>
            
            <tr>
                <td>UHLERPLUS</td>
                <td><?php echo $sumaUHLERPLUS ?></td>
                
                      
            </tr>
            
            <tr>
                <td>REVEAL</td>
                <td><?php echo $sumaREVEAL ?></td>
                
                      
            </tr>
            
            <tr>
                <td>STARDENT</td>
                <td><?php echo $sumaSTARDENT ?></td>
                
                      
            </tr>
            
            <tr>
                <td>STARVIT</td>
                <td><?php echo $sumaSTARVIT ?></td>
                
                      
            </tr>
            
            <tr>
                <td>ZENITH</td>
                <td><?php echo $sumaZENITH ?></td>
                
                      
            </tr>

</table>
</div>

<script type="text/javascript">
$(document).on("click", "#delRg", function(event) {
event.preventDefault();

let ifRegistro = $(this).attr('data-rg');

$.ajax({
    url: "../control/eliminar_Lotes.php",
    data: {
        id: ifRegistro
    },
    success: function(result) {

        console.log(result);
        location.reload();
       

    },
    error: function(request, status, error) {
        console(request.responseText);
        console(error);
    }
});

});
</script>

 </table >
 

         <br>
<table  class="table table-bordered table-striped gray-table">
            <tr>
               
              
                <td>TOTAL JUEGOS</td>
                
            </tr>
            
         
            <tr>
                
                
                <td><CENTER><?php echo $totalInventario ?></CENTER></td>
                
            </tr>
           
        </table>
        <br></br>
        <section>
            <p>Nota: para filtrar un día se selecciona desde esa fecha hasta el día siguiente</p>
        </section>
 </center>
</body>
</html>

          
       
