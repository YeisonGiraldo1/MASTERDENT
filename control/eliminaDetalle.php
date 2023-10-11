<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

$id = $_GET['id'];
//echo "id = ". $id;


//echo "/consulta = ". $sql_Detalles1;
$sqlEliminar = "DELETE FROM pedidoDetalles WHERE id = '".$id."'";
$resultado = mysqli_query($conexion, $sqlEliminar);
/*
echo "elementos borrados";
echo"</br>";
echo "id de la referencia= ".$refId;
echo"</br>";
echo "id de la color= ".$colorId;
*/

?>