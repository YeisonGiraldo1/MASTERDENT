<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");




$id=$_GET["id"];





$borrar=mysqli_query($conexion,"DELETE  FROM inventario_lab WHERE  id='$id' ");
mysqli_close($conexion);

echo "<script>
window.location= 'seleccion_inventario.php';
</script>";



?>


