<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
 //$ActualizarDespuesDe = 60;
 
 $totalInventario=0;
    
    // Envíe un encabezado Refresh al navegador preferido.
   //header('Refresh: '.$ActualizarDespuesDe);
    $fechaDesde = isset( $_POST['fechaDesde'] ) ? $_POST['fechaDesde'] : '';
    $fechaHasta = isset( $_POST['fechaHasta'] ) ? $_POST['fechaHasta'] : '';
    
    $filtros = array();
    
    if ($fechaDesde != '' && $fechaHasta != ''){
            $filtros[]= "pedidoDetalles.fechaCreacion BETWEEN '$fechaDesde%' AND '$fechaHasta%'";
    }
    if (empty($filtros)) {
        $filtros[] = "1";
    } else {
        if (is_null($filtros[0])) {
            $filtros[0] = "1";
        }
    }
    
    $consultaFiltros='select sum(revision2) as total, pedidos2.linea as linea FROM pedidoDetalles INNER JOIN pedidos2 ON pedidoDetalles.pedidoId = pedidos2.idP WHERE ';
    
    $consultaSuma = 'select sum(revision2) as total, pedidos2.linea as linea FROM pedidoDetalles INNER JOIN pedidos2 ON pedidoDetalles.pedidoId = pedidos2.idP WHERE ';
    
    $consultaSTARPLUS = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'STARPLUS'";
    $resultSTARPLUS=mysqli_query($conexion, $consultaSTARPLUS);
            
            //echo $consultaSTARPLUS;
            //echo var_dump($filtros);
            
            while($mostrarSTARPLUS=mysqli_fetch_array($resultSTARPLUS)){
                $sumaSTARPLUS=$mostrarSTARPLUS['total'];
                $totalInventario=$totalInventario+$mostrarSTARPLUS['total'];
            }
            
    ////////////////
    
    $consultaRESISTAL = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'RESISTAL'";
    $resultRESISTAL=mysqli_query($conexion, $consultaRESISTAL);
            
            //echo $consultaRESISTAL;
            //echo var_dump($filtros);
            
            while($mostrarRESISTAL=mysqli_fetch_array($resultRESISTAL)){
                $sumaRESISTAL=$mostrarRESISTAL['total'];
                $totalInventario=$totalInventario+$mostrarRESISTAL['total'];
            }
            
    ////////////
    
    $consultaUHLERPLUS = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'UHLERPLUS'";
    $resultUHLERPLUS=mysqli_query($conexion, $consultaUHLERPLUS);
            
            //echo $consultaUHLERPLUS;
            //echo var_dump($filtros);
            
            while($mostrarUHLERPLUS=mysqli_fetch_array($resultUHLERPLUS)){
                $sumaUHLERPLUS=$mostrarUHLERPLUS['total'];
                $totalInventario=$totalInventario+$mostrarUHLERPLUS['total'];
            }
            
    /////////////
    $consultaREVEAL = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'REVEAL'";
    $resultREVEAL=mysqli_query($conexion, $consultaREVEAL);
            
            //echo $consultaREVEAL;
            //echo var_dump($filtros);
            
            while($mostrarREVEAL=mysqli_fetch_array($resultREVEAL)){
                $sumaREVEAL=$mostrarREVEAL['total'];
                $totalInventario=$totalInventario+$mostrarREVEAL['total'];
            }
            
    /////////////////////
    
    $consultaSTARDENT = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'STARDENT'";
    $resultSTARDENT=mysqli_query($conexion, $consultaSTARDENT);
            
            //echo $consultaSTARDENT;
            //echo var_dump($filtros);
            
            while($mostrarSTARDENT=mysqli_fetch_array($resultSTARDENT)){
                $sumaSTARDENT=$mostrarSTARDENT['total'];
                $totalInventario=$totalInventario+$mostrarSTARDENT['total'];
            }
            
    $consultaSTARVIT = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'STARVIT'";
    $resultSTARVIT=mysqli_query($conexion, $consultaSTARVIT);
            
            //echo $consultaSTARVIT;
            //echo var_dump($filtros);
            
            while($mostrarSTARVIT=mysqli_fetch_array($resultSTARVIT)){
                $sumaSTARVIT=$mostrarSTARVIT['total'];
                $totalInventario=$totalInventario+$mostrarSTARVIT['total'];
            }
            
    ///////////////////
    
    $consultaZENITH = $consultaFiltros." ".implode(" AND ",$filtros) ." AND linea = 'ZENITH'";
    $resultZENITH=mysqli_query($conexion, $consultaZENITH);
            
            //echo $consultaZENITH;
            //echo var_dump($filtros);
            
            while($mostrarZENITH=mysqli_fetch_array($resultZENITH)){
                $sumaZENITH=$mostrarZENITH['total'];
                $totalInventario=$totalInventario+$mostrarZENITH['total'];
            }
            
    ////////////////
    
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TerminadoConsolidado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
   
   <table style="margin-top: 30px;" class="table table-bordered table-striped">
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
<table  class="table table-bordered table-striped">
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

          
       
