<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
$id = $_GET['id'];

$datoRef = "";
$datoSupInf = "";
$datoColor = "";
$pedido = "";
$datoJuegos = "";
$refId = ""; // Inicializar la variable $refId
$colorId = ""; // Inicializar la variable $colorId

$sql = "SELECT *  FROM listaEmpaque WHERE id = '" . $id . "'";
$result = mysqli_query($conexion, $sql);

$sqlColorId = "SELECT id FROM `colores2` WHERE `nombre` ='" . $datoColor . "'";
$resultColorId = mysqli_query($conexion, $sqlColorId);

while ($mostrarColorId = mysqli_fetch_array($resultColorId)) {
    $colorId = $mostrarColorId['id'];
    $datoRef = $mostrar['mold'];
    $datoSupInf = $mostrar['uppLow'];
    $datoColor = $mostrar['shade'];
    $pedido = $mostrar['pedidoId'];
    $datoJuegos = $mostrar['juegos'];
}
            //echo "/juegos = ". $datoJuegos;
            
           /* 
           //Se crea el registro en base de datos de las referencias según el requerimiento del cliente. 
            //Establezco la escepción de las referencias PL3 y H45.
		   
		   if($datoRef=='PL3'){
		       $datoRef='PU3';
		   }
		    if($datoRef=='PL3'){
		       $datoRef='PU3';
		   }
		    if($datoRef=='J21'){
		       $datoRef='21J';
		   }
		    if($datoRef=='H45'){
		       $datoRef='45H';
		   }
            */
            
            //preparo el supInf para concatenar con la referencia
		   $datoSupInf=substr($datoSupInf,0,1);
		   $datoRef=$datoRef."-".$datoSupInf;
		   //echo "pedido= ".$pedido;
		   //echo "referencia = ".$datoRef;
		   
		    //consulto la referencia
		    $sqlRefId="SELECT `id` FROM `referencias2` WHERE `nombre` = '".$datoRef."'";
		    $resultRefId= mysqli_query($conexion,$sqlRefId);
		    
		    while($mostrarRefId=mysqli_fetch_array($resultRefId)){
			    
                $refId=$mostrarRefId['id'];
                //echo "id de la referencia= ".$refId;
                
            }
            
            //consulto el color
		    $sqlColorId="SELECT id FROM `colores2` WHERE `nombre` ='".$datoColor."'";
		    $resultColorId= mysqli_query($conexion,$sqlColorId);
		    
		    while($mostrarColorId=mysqli_fetch_array($resultColorId)){
			    
                $colorId=$mostrarColorId['id'];
                
                //echo "id de la color= ".$colorId;
                
                /*
                for($i=0;$i<10;$i++){
                    echo $i;
                }
                */
               
                
            }
//En esta consulta elimino todos los registros que comparten los datos de pedido referencia color y numero de juegos ¡peligro! elimina varios datos si los encuentra. 

//remplazo por un insert con el dato de los juegos en negativo. 
//$sql_Detalles1 = "DELETE FROM `pedidoDetalles` WHERE `pedidoId`='".$pedido."' AND `referenciaId` ='".$refId."' AND `colorId`='".$colorId."'AND `empacados`='".$datoJuegos."'";
//$resultDetalles1 = mysqli_query($conexion, $sql_Detalles1);

$negativoDatoJuegos = -intval($datoJuegos);

// Construye la consulta con la variable
$sql_Detalles1 = "INSERT INTO `pedidoDetalles` (`id`, `pedidoId`, `referenciaId`, `colorId`, `rotuloId`, `juegos`, `granel`, `programados`, `producidos`, `pulidos`, `enSeparacion`, `separado`, `enEmplaquetado`, `emplaquetados`, `revision1`, `revision2`, `empacados`, `calidad`, `colaborador`, `fechaCreacion`) values (NULL,'".$pedido."','".$refId."','".$colorId."',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'".$negativoDatoJuegos."',NULL,NULL,(select DATE_SUB(NOW(),INTERVAL 5 HOUR)))";
		    
$resultDetalles1 = mysqli_query($conexion,$sql_Detalles1);

//echo "/consulta = ". $sql_Detalles1;
$sqlEliminar = "DELETE FROM listaEmpaque WHERE id = ' ".$id."'";
$resultado = mysqli_query($conexion, $sqlEliminar);
/*
echo "elementos borrados";
echo"</br>";
echo "id de la referencia= ".$refId;
echo"</br>";
echo "id de la color= ".$colorId;
*/



?>

<html lang="en">
			    <body>
			        
			<!--<button onclick="location.href='https://trazabilidadmasterdent.online/control/formulario_pedidos.php'">Nuevo Registro</button>
			<button onclick="location.href='https://trazabilidadmasterdent.online/control'">Inicio</button>-->
			<meta http-equiv="refresh" content="0.3; url= ../../../control>
	
</body>
</html>