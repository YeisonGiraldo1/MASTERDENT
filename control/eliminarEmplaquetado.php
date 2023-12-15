<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

$id = $_GET['id'];


//elimina el detalle

$sql = "DELETE FROM `seguimientoEmplaquetado` WHERE id = '" . $id . "'";

$resultado = mysqli_query($conexion, $sql);


?>

	<html lang="en">
			    <body>
			        
			<!--<button onclick="location.href='https://trazabilidadmasterdent.online/control/formulario_pedidos.php'">Nuevo Registro</button>
			<button onclick="location.href='https://trazabilidadmasterdent.online/control'">Inicio</button>-->
			<meta http-equiv="refresh" content="0.3; url= ../control/formularioEmplaquetado2.php">
	
</body>
</html>
