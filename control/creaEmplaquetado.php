<?php 
require_once("herramienta_introducir_datos.php");

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

$emplaquetador=$_GET ["emplaquetador"];
$cod_rotulo = isset($_GET["rotulo"]) ? $_GET["rotulo"] : null;

if ($cod_rotulo === null) {
    // Manejo del error o mensaje de advertencia
    echo "Error: El parámetro 'rotulo' no está definido.";
    // Puedes detener la ejecución del script si es necesario
    die();
}

$cajas=$_GET ["cajas"];
$juegos=0;

$linea = ''; // Asigna un valor predeterminado vacío
$pedidoId = ''; // Asigna un valor predeterminado vacío
$referenciaId = ''; // Asigna un valor predeterminado vacío
$colorId = ''; // Asigna un valor predeterminado vacío

$sqlR="SELECT referenciaId, colorId, pedido,total, referencias2.gramosJuego AS gramosJuego, referencias2.tipo AS tipo, pedidos2.linea AS linea FROM rotulos2 INNER JOIN referencias2 ON rotulos2.referenciaId = referencias2.id INNER JOIN pedidos2 ON rotulos2.pedido = pedidos2.idP WHERE rotulos2.id = '".$cod_rotulo. "';";

$resultR=mysqli_query($conexion,$sqlR);

while($mostrarR=mysqli_fetch_array($resultR)){
                    
                    $referenciaId=$mostrarR['referenciaId']; 
                    $pedidoId=$mostrarR['pedido']; 
                    $colorId=$mostrarR['colorId']; 
                    $juegosIngresan=$mostrarR['total'];
                    $gramosJuego=$mostrarR['gramosJuego'];
                    $tipo = ''; // Asigna un valor predeterminado vacío
                    if (isset($mostrarR['tipo'])) {
                        $tipo = $mostrarR['tipo'];
                    } else {
                        // Manejo del error o mensaje de advertencia
                        echo "Error: El índice 'tipo' no está definido en el resultado de la consulta.";
                        // Puedes detener la ejecución del script si es necesario
                        die();
                    }
                    
                    $linea=$mostrarR['linea'];
                    //$gramosGranel=$mostrarR['gramosGranel'];
                    //$juegosGranel=$gramosGranel/$gramosJuego;
                    //$juegosGranel=round($juegosGranel);
                    
}


  if ($linea=='RESISTAL' || $linea=='ZENITH'){
                    
                    if ($tipo=='Diente'){
                        $juegosCaja=16;
                    }
                    else if ($tipo=='Muela'){
                        $juegosCaja=14;
                    }
                    else{
                        echo "error: seleccione el tipo : diente/muela";
                    }
                }
                else if ($linea=='REVEAL' || $linea=='STARDENT' || $linea=='STARVIT'){
                    $juegosCaja=20;
                }
                else if ($linea=='UHLERPLUS' || $linea=='STARPLUS'){
                    $juegosCaja=12;
                    
                }
                else{
                    $juegosCaja=20;//pendiente de verificar. 
                }
                
$juegos=$cajas*$juegosCaja;

if ($linea=='UHLERPLUS' || $linea=='STARPLUS'){
    $puntos=$juegos*1.2;
    
}
else{
    $puntos=$juegos;
}

//echo $emplaquetador ."/";
//echo $linea ."/";
//echo $tipo ."/";
//echo $cajas ."/" ;
//echo $juegos ."/" ;

// Verificar si $pedidoId es válido y existe en pedidos2
$sqlValidarPedido = "SELECT COUNT(*) AS count FROM pedidos2 WHERE idP = '$pedidoId'";
$resultValidarPedido = mysqli_query($conexion, $sqlValidarPedido);
$count = mysqli_fetch_assoc($resultValidarPedido)['count'];

if ($count > 0) {
    // El pedidoId es válido y existe en la tabla pedidos2, procedemos con la inserción
    $sqlCalidad = "INSERT INTO `pedidoDetalles` (`id`, `pedidoId`, `referenciaId`, `colorId`, `rotuloId`, `juegos`, `granel`, `programados`, `producidos`, `pulidos`, `enSeparacion`, `separado`, `enEmplaquetado`, `emplaquetados`, `revision1`, `revision2`, `empacados`, `calidad`, `colaborador`, `fechaCreacion`) VALUES (NULL, '$pedidoId', '$referenciaId', '$colorId', '$cod_rotulo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$juegos', NULL, NULL, NULL, NULL, '$emplaquetador', (select DATE_SUB(NOW(), INTERVAL 5 HOUR)));";

    $resultCalidad = mysqli_query($conexion, $sqlCalidad);
} else {
    // El pedidoId no es válido o no existe en la tabla pedidos2
    echo "Error: El pedidoId no es válido o no existe en la tabla pedidos2.";
}

$herramientaEmplaquetado = new Herramienta();
$ingresar_dato_tabla_SeguimientoEmplaquetado = $herramientaEmplaquetado->ingresar_datos_seguimientoEmplaquetado($emplaquetador, $linea, $tipo,$juegos, $puntos);
//
?>