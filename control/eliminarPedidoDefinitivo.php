<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");



$id=$_POST["id"];


$borrar=mysqli_query($conexion,"DELETE  FROM pedidos2 WHERE  idP='$id' ");
mysqli_close($conexion);
 


echo "<script>
alert('LOS DATOS  HAN SIDO BORRADOS PERMANENTEMENTE Y NO PODRAS  RECUPERARLOS');
window.location= '../control/vistas/modulos/verTablaPedidos.php';
</script>";


?>



