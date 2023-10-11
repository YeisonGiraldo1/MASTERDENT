
<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
    $sqlBodega=$_POST ["query"];
    $pedido=$_POST['pedido'] ;
    $resultBodega=mysqli_query($conexion,$sqlBodega); 
    
    
    //echo $sqlBodega;
    ?>
    <html lang="en">
			    <head>
			    <meta http-equiv="refresh" content="0.2; url= ../control/inventario.php?pedido=<?php echo $pedido?>">
			    </head>