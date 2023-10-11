<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");


$id=$_GET["id"];


$borrar=mysqli_query($conexion,"DELETE  FROM rotulos2 WHERE  id='$id' ");
mysqli_close($conexion);
 


echo "<script>
alert('LOS DATOS  HAN SIDO BORRADOS PERMANENTEMENTE Y NO PODRAS  RECUPERARLOS');
window.location='verTablaRotulos.php';
</script>";


?>