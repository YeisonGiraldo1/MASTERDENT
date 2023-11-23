<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

$id = $_GET['id'];

$sql = "DELETE FROM temperaturaprensas WHERE id = '".$id."'";


$resultado = mysqli_query($conexion, $sql);
?>