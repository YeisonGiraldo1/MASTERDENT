<?php
//$pedido=$_GET ["id"];
//echo "aquí podremos ver lo ítems del pedido". $pedido. "según su estado dentro del proceso.";

//////////////////////////////////////////////////////////////
//condenado por session start malo   session_start();
//condenado por session start malo     if(!isset ($_SESSION['Cedula']) or !isset($_SESSION['Contrasena'])){ 
//condenado por session start malo       $cedula=1993;
//condenado por session start malo     $contrasena=2050;
//condenado por session start malo       echo "<script>
//condenado por session start malo       alert('Zona  no autorizada,por favor inicia la seccion');
//condenado por session start malo       window.location='../index.php';
//condenado por session start malo     
//condenado por session start malo     
//condenado por session start malo       
//condenado por session start malo     </script>";
//condenado por session start malo     
//condenado por session start malo      
//condenado por session start malo     }
//condenado por session start malo     
//condenado por session start malo     else{
//condenado por session start malo       
//condenado por session start malo       
//condenado por session start malo       $cedula=$_SESSION['Cedula'];
//condenado por session start malo       $contrasena=$_SESSION['Contrasena']; 
//condenado por session start malo      $rol=$_SESSION['Rol'];
  




$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");  
  $pedidoId=$_GET ['idP'];
  
            
            //consulto el nombre o código del pedido a partir del id
                
                 
            $sqlCod= "SELECT pedidos2.`codigoP` from pedidos2 WHERE idP ='".$pedidoId. "' ";
        $resultCod=mysqli_query($conexion,$sqlCod);

         

                while($mostrarCod=mysqli_fetch_array($resultCod)){
                    $pedido=$mostrarCod['codigoP'];
                }
 
  
    $referenciaId = isset( $_GET['referenciaId'] ) ? $_GET['referenciaId'] : '';
    
    
    $colorId = isset( $_GET['colorId'] ) ? $_GET['colorId'] : '';
    
     //variable para determinar las columnas a mostrar según área de la empresa
    
     $origenBusqueda = isset($_GET['origenBusqueda']) ? $_GET['origenBusqueda'] : '';
     if (empty($origenBusqueda)) {
         $origenBusqueda = isset($_POST['origenBusqueda']) ? $_POST['origenBusqueda'] : '';
     }
     $origenBusqueda = trim($origenBusqueda, " ");
     
     $origenBusqueda=trim($origenBusqueda," ");
    
    $granel=0;
    $programados=0;
    $producidos=0;    
    $pulidos=0;
    $separados=0;
    $emplaquetados=0;
    $revisados=0;
    $verificados=0;
    $empacados=0;
    
    // imprimo las variables 
   // echo "pedido= ".$pedido;
   // echo "pedidoId= ".$pedidoId;
   // echo "referencia= ".$referencia;
   // echo "color= ".$color;
    
     $filtros = array();
     
     if ($pedidoId != ''){
        $filtros[]= "pedidoDetalles.`pedidoId` = '$pedidoId'";
    }
    
     if ($referenciaId != ''){
        
         
            
            $filtros[]= "pedidoDetalles.`referenciaId` = '$referenciaId'";
            
                
    }
    if ($colorId != ''){
        
        
            
            $filtros[]= "pedidoDetalles.`colorId` = '$colorId'";
    }
    
    
    $consultaFiltros= 'SELECT * FROM pedidoDetalles WHERE ';
    
    $consultaSuma = 'select sum(juegos) as totales FROM pedidoDetalles WHERE ';
    
  //condenado por session start malo }
  
  //condenado por session start malo if($rol==1 OR $rol==3 ){
    
  
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <button class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
    <button class="btn btn-primary" onclick="location.href='../control/trazarPedido.php?id=<?php echo $pedidoId; ?>&referenciaId=<?php echo $referenciaId; ?>&colorId=<?php echo $colorId; ?>&origenBusqueda=<?php echo $origenBusqueda?>&Crear=Enviar'">Atrás</button>
    
    <!-- Agrega estos enlaces en la sección head de tu HTML -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-oS3QGVnm6MOBqch3geQcV3kxr83r4pR9Nyp+RTtDz3cM7CYC/SpWQROQjbzm+JCE" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    
<div style="text-align: center;">
    <button  class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
    <button class="btn btn-primary" onclick="location.href='../control/tableroTerminacion2.php'">Tablero</button>
     <button class="btn btn-primary" onclick="location.href='../control/consolidadoEmplaquetado.php'">Consolidado Emplaquetado</button>
     <button class="btn btn-primary" onclick="location.href='../control/consolidadoPorEmplaquetar.php'">Consolidado Entregado A Emplaquetar</button>
     </div>
    <br></br>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplaquetado Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
         
       
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<head>
    <meta charset="UTF-8">
    <title>ItemPedido</title>
</head>
<body>
    <center>

        <h1>Historial movimientos del pedido <?php echo $pedido ?>  </h1>

        <?php
        // Busco el nombre de la referencia según su id en la tabla referencias2
        $sqlRef = "SELECT `nombre` FROM `referencias2` WHERE id = '$referenciaId'";
        $resultRef = mysqli_query($conexion, $sqlRef);

        while ($mostrarRef = mysqli_fetch_array($resultRef)) {
            $referencia = $mostrarRef['nombre'];
        }
        ?>

        <h3>Referencia: 
            <td><?php echo max($referencia, "") ?></td>
        </h3>

        <?php
        // Busco el id del color según su nombre 
        $sqlCol = "SELECT `nombre` FROM `colores2` WHERE id = '$colorId'";
        $resultCol = mysqli_query($conexion, $sqlCol);

        while ($mostrarCol = mysqli_fetch_array($resultCol)) {
            $color = $mostrarCol['nombre'];
        }
        ?>

        <h3>Color: 
            <td><?php echo max($color, "") ?></td>
        </h3>

        <!--
        <div class="row">
            <form action="trazarPedido.php" method="POST">
                <div class="mb-3">
                    <label for="referencia" class="form-label">Referencia</label>
                    <input type="text" size="15" class="form-control " id="referencia" name="referencia">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" size="15" class="form-control " id="color" name="color">
                    <input name="id" type="hidden" value="<?php echo $pedidoId; ?>">
                    <input type="submit" name="Empacar">
                </div>
            </form>
        </div>
        <br></br>
        -->

        <table border="2" class="table table-striped table-bordered table-hover">
            <tr>
                <!--<td>id</td>-->
                <td>RotuloId</td>
                <td>Pedidos</td>
                <td>Granel</td>
                <td>Programados</td>
                <td>Producidos</td>
                <td>Pulidos</td>
                <td>EnSeparación</td>
                <td>Separados</td>
                <td>EnEmplaquetado</td>
                <td>Emplaquetados</td>
                <td>Revisión 1</td>
                <td>Asignados</td>
                <td>Empacados</td>
                <td>Calidad</td>
                <td>Colaborador</td>
                <td>Fecha</td>
                <td>Acción</td>
            </tr>

            <?php
            $iniciales = array();
            // Consulto las iniciales de los emplaquetadores
            $sqlEmplaquetadores = "SELECT iniciales FROM emplaquetadores WHERE 1";
            $resultEmplaquetadores = mysqli_query($conexion, $sqlEmplaquetadores);

            while ($mostrarEmplaquetadores = mysqli_fetch_array($resultEmplaquetadores)) {
                $iniciales[] = $mostrarEmplaquetadores["iniciales"];
            }

            $sql = $consultaFiltros . " " . implode(" AND ", $filtros) . "  ";
            $result = mysqli_query($conexion, $sql);

            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <!--<td><?php //echo $mostrar['id'] ?></td>-->
                    <td><?php echo max($mostrar["rotuloId"], "") ?></td>
                    <td><?php echo max($mostrar["juegos"], 0) ?></td>
                    <td><?php echo max($mostrar["granel"], 0) ?></td>
                    <td><?php echo max($mostrar["programados"], 0) ?></td>
                    <td><?php echo max($mostrar["producidos"], 0) ?></td>
                    <td><?php echo max($mostrar["pulidos"], 0) ?></td>
                    <td><?php echo max($mostrar["enSeparacion"], 0) ?></td>
                    <td><?php echo max($mostrar["separado"], 0) ?></td>
                    <td><?php echo max($mostrar["enEmplaquetado"], 0) ?></td>
                    <td><?php echo max($mostrar["emplaquetados"], 0) ?></td>
                    <td><?php echo max($mostrar["revision1"], 0) ?></td>
                    <td><?php echo max($mostrar["revision2"], 0) ?></td>
                    <td><?php echo max($mostrar["empacados"], 0) ?></td>
                    <td><?php echo max($mostrar["calidad"], 0) ?></td>
                    <td><?php echo max(isset($mostrar["colaborador"]) ? $iniciales[$mostrar["colaborador"] - 1] : "", "") ?></td>
                    <td><?php echo max($mostrar["fechaCreacion"], "") ?></td>
                    <td><a href="#" class="eliminar-btn" data-id="<?php echo $mostrar['id']; ?>"><i class="fas fa-trash" style="color: red;"></i></a></td>                </tr>
            <?php
            }
            ?>
        </table>
        <br></br>

        <script>
document.addEventListener('DOMContentLoaded', function () {
    // Obtén todos los elementos con la clase 'eliminar-btn'
    var botonesEliminar = document.querySelectorAll('.eliminar-btn');

    // Itera sobre los elementos y agrega un evento de clic a cada uno
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();

            // Obtiene el valor del atributo 'data-id'
            var id = boton.getAttribute('data-id');

            // Confirma si el usuario realmente desea eliminar antes de enviar la solicitud
            var confirmacion = confirm('¿Estás seguro de que quieres eliminar este registro?');

            if (confirmacion) {
                // Envía una solicitud al script 'eliminar_rotulo.php' con el parámetro 'id'
                window.location.href = 'eliminaDetalle.php?id=' + id;
            }
        });
    });
});
</script>


        <table border="1">
            <tr>
                <td>TOTAL JUEGOS PEDIDOS</td>
            </tr>

            <?php
            $sqlSuma = $consultaSuma . " " . implode(" AND ", $filtros) . " ";
            $resultSuma = mysqli_query($conexion, $sqlSuma);

            while ($mostrarSuma = mysqli_fetch_array($resultSuma)) {
            ?>
                <tr>
                    <td><?php echo max($mostrarSuma['totales'], 0) ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br></br>

        <?php
        // Condenado por session start malo
        // ...
        ?>

    </center>
</body>
</html>
