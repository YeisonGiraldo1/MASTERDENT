<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
$sumaJuegos = 0;
$diferenciaTotal = 0;
$sumaProducidos = 0;

$referenciaIdPedido = '';
$colorIdPedido = '';
$pedidoIdPedido = '';

$referenciaIdPedido = isset($_GET['referenciaId']) ? $_GET['referenciaId'] : '';
$colorIdPedido = isset($_GET['colorId']) ? $_GET['colorId'] : '';
$pedidoIdPedido = isset($_GET['idP']) ? $_GET['idP'] : '';

$arregloReferencias = array();
$gramosJuego = array();
$capas = array();
$tipo = array();

$sqlReferencias = "SELECT id, nombre, gramosJuego, tipo, capas FROM referencias2";
$resultReferencias = mysqli_query($conexion, $sqlReferencias);

while ($mostrarReferencias = mysqli_fetch_array($resultReferencias)) {
    $arregloReferencias[$mostrarReferencias['id']] = $mostrarReferencias['nombre'];
    $gramosJuego[$mostrarReferencias['id']] = $mostrarReferencias['gramosJuego'];
    $capas[$mostrarReferencias['id']] = $mostrarReferencias['capas'];
    $tipo[$mostrarReferencias['id']] = $mostrarReferencias['tipo'];
}

$arregloColores = array();

$sqlColores = "SELECT id, nombre FROM colores2";
$resultColores = mysqli_query($conexion, $sqlColores);

while ($mostrarColores = mysqli_fetch_array($resultColores)) {
    $arregloColores[$mostrarColores['id']] = $mostrarColores['nombre'];
}

$arregloPedidos = array();

$sqlPedidos = "SELECT idP, codigoP FROM pedidos2";
$resultPedidos = mysqli_query($conexion, $sqlPedidos);

while ($mostrarPedidos = mysqli_fetch_array($resultPedidos)) {
    $arregloPedidos[$mostrarPedidos['idP']] = $mostrarPedidos['codigoP'];
}

$rotuloId = isset($_POST['rotuloId']) ? $_POST['rotuloId'] : '';
$referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$tipoDato = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$capasDato = isset($_POST['capas']) ? $_POST['capas'] : '';
$codigoP = isset($_POST['codigoP']) ? $_POST['codigoP'] : '';
$fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : '';
$fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : '';
$fechaProduccionDesde = isset($_POST['fechaProduccionDesde']) ? $_POST['fechaProduccionDesde'] : '';
$fechaProduccionHasta = isset($_POST['fechaProduccionHasta']) ? $_POST['fechaProduccionHasta'] : '';

$filtros = array();

if ($rotuloId != '') {
    $filtros[] = "rotuloId = '$rotuloId'";
}

if ($referencia != '') {
    $referenciaId = array_search($referencia, $arregloReferencias);
    $filtros[] = "rotulos2.referenciaId = '$referenciaId'";
} else {
    if ($referenciaIdPedido != '') {
        $filtros[] = "rotulos2.referenciaId = '$referenciaIdPedido'";
    }
}

if ($color != '') {
    $colorId = array_search($color, $arregloColores);
    $filtros[] = "rotulos2.colorId = '$colorId'";
} else {
    if ($colorIdPedido != '') {
        $filtros[] = "rotulos2.colorId = '$colorIdPedido'";
    }
}

if ($tipoDato != '') {
    $filtros[] = "referencias2.tipo = '$tipoDato'";
}

if ($capasDato != '') {
    $filtros[] = "referencias2.capas = '$capasDato'";
}

if ($codigoP != '') {
    $idP = array_search($codigoP, $arregloPedidos);
    $filtros[] = "rotulos2.pedido = '$idP'";
}

if ($fechaDesde != '' && $fechaHasta != '') {
    $filtros[] = "productoGranel.`fechaHora` BETWEEN '$fechaDesde%' AND '$fechaHasta%'";
}

if ($fechaProduccionDesde != '' && $fechaProduccionHasta != '') {
    $filtros[] = "rotulos2.`fecha` BETWEEN '$fechaProduccionDesde%' AND '$fechaProduccionHasta%'";
}

if (empty($filtros)) {
    $filtros[] = "1";
}

$consultaFiltros = "SELECT productoGranel.*, rotulos2.referenciaId AS referencia, rotulos2.colorId as color, rotulos2.total AS producidos, rotulos2.pedido AS pedido, rotulos2.fecha AS fechaProduccion, referencias2.tipo AS tipo, referencias2.capas AS capas FROM productoGranel INNER JOIN rotulos2 ON productoGranel.rotuloId = rotulos2.id INNER JOIN referencias2 ON rotulos2.referenciaId = referencias2.id WHERE ";
$consultaSuma = "SELECT SUM(gramos) AS totalGramos, COUNT(productoGranel.id) AS totalRegistros, rotulos2.referenciaId AS referencia, rotulos2.colorId AS color FROM productoGranel INNER JOIN rotulos2 ON productoGranel.rotuloId = rotulos2.id INNER JOIN referencias2 ON rotulos2.referenciaId = referencias2.id WHERE ";
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
            background-image: url('../../../Public/imagenes/terminacion4.jpeg');
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
    <meta charset="UTF-8">
    <title>Granel</title>
    
    <!---->
    <!--<link rel="stylesheet" href="cssProyecto/estilosTablas.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <link href="cssProyecto/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="cssProyecto/slide.css">
    <!--bootstrap-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--CSS-->
    <link rel="stylesheet" href="../resources/estilos.css">
    <!--Fin-->

  
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    
    <button  class="btn btn-primary"  onclick="location.href='../../../control'">Inicio</button>
    <button  class="btn btn-primary"  onclick="location.href='../../../control/formulario_rotulo_granel.php'">Nuevo Rotulo</button>
    <button  class="btn btn-primary"  onclick="location.href='../../../control/trazarPedido.php?id=<?php echo $pedidoIdPedido?>'">Volver al pedido</button>
    <button  class="btn btn-primary" onclick="location.href='../../../control/pedidosConsolidado.php'">Ir al consolidado</button>

    
    <center>

    <h1>Producto a granel</h1>
    
    
<div class="container">
<form action="../modulos/verTablaGranel.php" method="POST">

     

            <div class="row">


            <div class="col-md-4">
                    <label for="rotuloId" class="form-label">ID Rotulo</label>
                    <input type="text" class="form-control "  id="rotuloId" name="rotuloId" autofocus >
                    </div>
        
   

                    <div class="col-md-4">
                    <label for="referencia" class="form-label">Referencia</label>
                    <input type="text" class="form-control "  id="referencia" name="referencia" >
                    </div>
        
                    
                    <div class="col-md-4">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control "  id="color" name="color" >
                    </div>
                    </div>
        



                    <div class="row">
                    <div class="col-md-4">
                    <label for="uppLow" class="form-label">Tipo</label>
                    <select class="form-select" autofocus id="tipo" name="tipo" aria-label="Default select example">
                        <option selected></option>
                        <option value="Diente">Diente</option>
                        <option value="Muela">Muela</option>
                    </select>
                    </div>
        

                    <div class="col-md-4">
                    <label for="uppLow" class="form-label">Capas</label>
                    <select class="form-select" autofocus id="capas" name="capas" aria-label="Default select example">
                        <option selected></option>
                        <option value="2C">2C</option>
                        <option value="4C">4C</option>
                    </select>
                    </div>
        

                    <div class="col-md-4">
                    <label for="codigoP" class="form-label">Pedido</label>
                    <input type="text" class="form-control "  id="codigoP" name="codigoP" }>
                    </div>
                    </div>
        
               <br>
                    <h5>Fecha Producción</h5>


                    <div class="row">
                    <div class="col-md-6">
                    <label for="fechaProduccionDesde" class="form-label">Desde</label>
                    <input type="Date" class="form-control" id="fechaProduccionDesde" name="fechaProduccionDesde" placeholder="Ingresa la fecha" >
                    </div>
        

                    <div class="col-md-6">
                    <label for="fechaProduccionHasta" class="form-label">Hasta</label>
                    <input type="Date" class="form-control" id="fechaProduccionHasta" name="fechaProduccionHasta" placeholder="Ingresa la fecha" >
                    </div>
                    </div>
        
                    <br>
                    <h5>Fecha Ingreso Granel</h5>


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
        
                <br>
                <input type="submit" class="btn btn-success"  name="Empacar" >
            </form>
       
    <br>
    
        <table class="table table-bordered table-striped gray-table"> 
            <tr>
                <!--<td>id</td>-->
                <td>ID Rotulo</td>
                <td>Referencia</td>
                <td>Color</td>
                <td>Tipo</td>
                <td>Capas</td>
                <td>Pedido</td>
                <td>GramosGranel</td>
                <td>JuegosGranel</td>
                <!--<td>JuegosProducidos</td>
                <td>Diferencia</td>-->
                <td>FechaProducción</td>
                <td>fechaIngreso</td>
                <td>Acción</td>
                
                <?php
                 //if($referenciaIdPedido!=''){
                 //echo " <td>asignar a pedido</td>";
                 //}
                ?>
                
            </tr>
            
            <?php
             if ($referencia != ''){
       echo "Referencia = $referencia, ";
    }
    if ($color != ''){
         echo "Color = $color, ";
    }
    if ($tipoDato != ''){
             echo "Tipo = $tipoDato, ";
    }
    if ($capasDato != ''){
        
             echo "Capas = $capasDato, ";
    }
    if ($codigoP != ''){
         echo "Pedido = $codigoP, ";
    }
             
            if ($fechaDesde != '' && $fechaHasta != ''){
            echo "Poducción ingresada a Granel";
            echo " entre $fechaDesde y $fechaHasta, ";
            }
            if ($fechaProduccionDesde != '' && $fechaProduccionHasta != ''){
            echo "Producido";
            echo " entre $fechaProduccionDesde y $fechaProduccionHasta, ";
            }
            
           $sql= $consultaFiltros." ". implode(" AND ",$filtros) . " ORDER BY productoGranel.id DESC";
            
            $result=mysqli_query($conexion,$sql);
            //echo $sql;
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <!--<td><?php //echo $mostrar['id'] ?></td>-->
                <td><?php echo $mostrar['rotuloId'] ?></td>
                <td><?php echo $arregloReferencias[$mostrar['referencia']] ?></td>
                <td><?php echo $arregloColores[$mostrar['color']] ?></td>
                <td><?php echo $tipo[$mostrar['referencia']] ?></td>
                <td><?php echo $capas[$mostrar['referencia']] ?></td>
           
                
            
                <!-- un condicional con isset que verifica que verrifica si la clave existe antes de acceder a ella -->
                <td>
    <?php
    if (isset($mostrar['pedido']) && isset($arregloPedidos[$mostrar['pedido']])) {
        echo $arregloPedidos[$mostrar['pedido']];
    } else {
        echo "Valor no definido";
    }
    ?>
</td>
                
                <td><?php echo $mostrar['gramos'] ?></td>
                
                <td><?php echo round($mostrar['gramos']/$gramosJuego[$mostrar['referencia']],1);
                
                if($mostrar['gramos']/$gramosJuego[$mostrar['referencia']]!=0 and !(is_null($gramosJuego[$mostrar['referencia']]))){
                $sumaJuegos=$sumaJuegos+round($mostrar['gramos']/$gramosJuego[$mostrar['referencia']]);
                    
                }
                else{
                echo "";
                }
                ?></td>
                
                <!--
                <td><?php 
                $sumaProducidos=$sumaProducidos+$mostrar['producidos'];
                //echo $mostrar['producidos'] ?></td>
                <td><?php 
                //$diferencia=$mostrar['producidos']-(round($mostrar['gramos']/$gramosJuego[$mostrar['referencia']],1));
                $diferenciaTotal=$diferenciaTotal+$diferencia;
                //echo round($diferencia,1) ?></td>
                
                -->
                <td><?php echo $mostrar['fechaProduccion'] ?></td>
                <td><?php echo $mostrar['fechaHora'] ?></td>
               
                <td>
    <a  class="btn btn-secondary" href="asignarGranelAPedidio.php?idP=<?php echo (isset($pedidoIdPedido) && $pedidoIdPedido !== '') ? $pedidoIdPedido : '' ?>&rotuloId=<?php echo $mostrar['rotuloId']; ?>&referenciaId=<?php echo $mostrar['referencia'] ?>&colorId=<?php echo $mostrar['color'] ?>">Asignar a <?php echo (isset($pedidoIdPedido) && $pedidoIdPedido !== '') ? $arregloPedidos[$pedidoIdPedido] : ''; ?></a>

</td>

 <!--<td><a href="editar_lotes.php?id=<?php //echo $mostrar['id'];?>">Editar</a></td>            -->
</tr>
<?php
}
?>
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

 </table>
 
 
 <br></br>
 
  <?php
  /*
                 if($referenciaIdPedido!=''){
                 echo " Aquí irá un botón que asignará el rótulo al pedido con ID: $pedidoIdPedido";
                 }
                 */
                ?>
                
                <br></br>
 

                <table class="table table-bordered table-striped gray-table"> 
            
            
            
            <tr>
                <td>TOTAL REGISTROS</td>
                <td>GRAMOS GRANEL</td>
                <td>JUEGOS GRANEL</td>
                <!--
                <td>JUEGOS PRODUCIDOS</td>
                <td>DIFERENCIA TOTAL</td>
                -->
                
            </tr>
            
            <?php
            //$sql="select * , COUNT(id), sum(juegos) as total FROM listaEmpaque WHERE pedidoId ='". $pedido. "' AND mold = '". $referencia. "' AND shade = '".$color."' GROUP BY mold, shade, lote, uppLow, caja ORDER BY mold;";
            $sqlSuma=$consultaSuma." ". implode(" AND ",$filtros);
            //echo $sqlSuma;
            $resultSuma=mysqli_query($conexion,$sqlSuma);
            //echo var_dump($sumaJuegos);
            //echo $sqlSuma;
            //echo var_dump($filtros);
            
            while($mostrarSuma=mysqli_fetch_array($resultSuma)){
            ?>
            <tr>
                <td><?php echo $mostrarSuma['totalRegistros'] ?></td>
                <td><?php echo $mostrarSuma['totalGramos'] ?></td>
                <td><?php echo $sumaJuegos ?></td>
                <!--
                <td><?php //echo $sumaProducidos ?></td>
                <td><?php //echo $diferenciaTotal ?></td>
                -->
                
            </tr>
            <?php
            }
            ?>
        </table>
        <br></br>
 </center>
</body>
</html>

          
       
