<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Estaciones</title>
    
</head>

<body>    
  
    <h2>Información detallada por estación </h2>

    

 <form action="BusquedaRotulosPorEstacion.php" method="get">
    <div class="mb-3">


                   
                    <label for="estaciones" class="form-label">Seleccionar estación</label>
                    <select class="form-select" id="estaciones" name="estaciones" aria-label="Default select example">
                        <option selected>Selecciona una estacion</option>

                    <?php
                        $sql1="SELECT * from estaciones2 ORDER BY id ASC";
                        $result=mysqli_query($conexion,$sql1);
                        
                        while($mostrar=mysqli_fetch_array($result)){
                    ?>
                    <?php
                        echo '<option value="'.$mostrar["id"].'">'.$mostrar["nombre"].'</option>';
                    ?>
                    <?php
                    $estacion=$mostrar["id"];
                    echo $estacion;
                        }
                    ?>
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
</html>

        
    

