<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
echo "Here";
exit;



$id = $_GET["id"];
$desde = $_GET["desde"];
$hasta = $_GET["hasta"];
$color = $_GET["color"];
$referencia = $_GET["referencia"];
$lote = $_GET["lote"];
$pedido = $_GET["pedido"];

$borrar = mysqli_query($conexion, "DELETE  FROM rotulos2 WHERE  id='$id' ");
mysqli_close($conexion);

echo file_exists("control/filtros_Rotulos/consultarcolor.php");
// echo "<script>
// alert('LOS DATOS HAN SIDO BORRADOS PERMANENTEMENTE Y NO PODRAS  RECUPERARLOS');
// window.location= 'control/filtros_Rotulos/consultarcolor.php?color=$color&referencia=$referencia&lote=$lote&pedido=$pedido&desde=$desde&hasta=$hasta';
// </script>";
