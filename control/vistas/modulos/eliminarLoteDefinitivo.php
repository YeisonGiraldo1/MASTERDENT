<?php
print_r($_GET);
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");


$id = $_GET["id"];


$borrar = mysqli_query($conexion, "DELETE  FROM lotes2 WHERE  id='$id '");
mysqli_close($conexion);

echo "<script>
alert('LOS DATOS HAN SIDO BORRADOS PERMANENTEMENTE Y NO PODRAS  RECUPERARLOS');
window.location='http://localhost/Masterdent_6_dic/control/vistas/modulos/verTablaLotes.php';
</script>";
