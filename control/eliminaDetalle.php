<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

$id = $_GET['id'];
//echo "id = ". $id;


//echo "/consulta = ". $sql_Detalles1;
$sqlEliminar = "DELETE FROM pedidoDetalles WHERE id = '".$id."'";
$resultado = mysqli_query($conexion, $sqlEliminar);
echo "<script>
alert('LOS DATOS HAN SIDO BORRADOS PERMANENTEMENTE Y NO PODRAS  RECUPERARLOS');
window.location='http://localhost/Masterdent_6_dic/control';
</script>";



?>
