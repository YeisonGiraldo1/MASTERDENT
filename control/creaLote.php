<?php
require_once("herramienta_introducir_datos.php");
//$num_dato=$_GET ["numero_molde"];

// if (empty($_GET["lote"]) || empty($_GET["color"])) {
//     echo "<script>
//         alert('Por favor, digita todos los campos')
//         window.location.href = ''
//     </script>";
// }

$lote = $_GET["lote"];
$colorId = $_GET["color"];

$herramienta9 = new Herramienta();
$ingresar_dato_tabla_lotes2 = $herramienta9->ingresar_datos_tabla_lotes2($lote, $colorId);
