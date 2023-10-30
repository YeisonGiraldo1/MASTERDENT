<?php

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
$cedula=mysqli_real_escape_string($conexion,$_POST['usuario']);
$query=mysqli_query($conexion,"SELECT *FROM usuario WHERE Cedula='$cedula'");
mysqli_close($conexion);
$resultado=mysqli_num_rows($query);
if($resultado >0){
         while($data=mysqli_fetch_array($query)){
         $id=$data['id'];
    $correo=$data['Email'];
    
    
}
 
$enlace="../cambiar_contrasena.php?a26031997=$id";
echo "<script>

    window.location='../recuperacion_contraseña.php?correo=$correo&enlace=$enlace';

</script>";

}

else {  echo "<script>

    alert('El usuario no esta registrado en el sistema');

    window.location='../index.php';

</script>";


}
