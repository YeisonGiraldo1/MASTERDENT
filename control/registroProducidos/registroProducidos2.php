<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
    
    $moldesPrensada=null;
    $turnoMayus="";
    
    //$arrayId[$i]="";
    //$arrayPrensada[$i]="";
    //$arrayRef[$i]="";
    //$arrayColor[$i]="";
    //$arrayPedido[$i]="";
    //$arrayLote[$i]="";

  
    
    
   
    
    
        
       $fecha=$_POST ["fecha"];
       $turno=$_POST ["turno"];
       
       

$fecha = substr($fecha, int -12);
$turno = substr($turno, int -10);
//$prensada = substr($prensada, int -2);
        
        //elimino los espacios en blanco del string turno.
        
        $turno=trim($turno," ");
   



//echo "después de limitar los datos";
/*
var_dump($fecha);
var_dump($turno);
var_dump($prensada);*/

  //a continuación consulto el total de moldes de la prensada actual.
           
           $sqlC="SELECT SUM(cantidadMoldes) AS total FROM rotulos2 WHERE rotulos2.`fecha` = '".$fecha."' AND rotulos2.`turno` LIKE '%".$turno."%'";
            $resultC=mysqli_query($conexion,$sqlC);
            
            while($mostrarC=mysqli_fetch_array($resultC)){
            $moldesPrensada=$mostrarC['total'];
            }

?>

<!DOCTYPE html>
<html lang="en">
    <!--<button onclick="location.href='../control'">Inicio</button>-->
    <!--<button onclick="location.href='../control/progProduccion/formularioImprimirProg.php?fecha=<?php echo $fecha?>&turno=<?php //echo $turno?>'">Cambiar Fecha/Turno</button>-->
    <!--<button onclick="location.href='../control/progProduccion/cambiarPrensada.php?turno=<?php //echo $turno?>&fecha=<?php //echo $fecha?>">Cambiar prensada</button>
    	<button onclick="location.href='../control/progProduccion/cambiarTurno.php?prensada=<?php //echo $prensada?>&fecha=<?php //echo $fecha?> ">Cambiar Turno</button>-->
			
<head>
    <button onclick="location.href='../control'">Inicio</button>
	<meta charset="UTF-8">
	<title>Producidos</title>
	
	 <!---->
    <!--<link rel="stylesheet" href="cssProyecto/estilosTablas.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <link href="cssProyecto/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="cssProyecto/slide.css">
    <!--bootstrap-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--CSS-->
    <link rel="stylesheet" href="../resources/estilos.css">
    <!--Fin-->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
	
</head>
<body>
    <center>
  <div class="row">
            <form action="actualizaProducidos.php" method="POST">
    <?php
        //reviso el valor de la variable: aImprimir y dependiendo de éste presento la hoja o las etiquetas
        /*var_dump($aImprimir);
        $aImprimir=intval($aImprimir);
        var_dump($aImprimir);*/
        
    
            ?>
        <!--  
        
        <h2>Programación del día: <?php echo $fecha ?> </h2>
        <h2>Turno:  <?php echo $turno ?></h2>
 
        </div>
        
        <br>    

    
    
    <br>
    -->
  <!--<h1>Regitro de juegos producidos</h1>-->
    
        <table border="1">
            
            <tr>
            <!--Encabezado general de la tabla-->
            
            <td ROWSPAN="3" COLSPAN="5" ><center><h2>MASTERDENT</center></td>
            <td ROWSPAN="3" COLSPAN="13"><center><h4>REGISTRO DE JUEGOS PRODUCIDOS</center></td>
            <td COLSPAN="4" >Cod F-PR-05</td>
        </tr>
        <tr><td COLSPAN="4">Versión 003</td></tr>
        <tr><td COLSPAN="4">09-jun-22</td></tr>
            
            <tr>
                <td COLSPAN="8"><center>HORARIO: <?php 
                switch ($turno) {
                case "mañana":
                echo "06:00 am - 02:00 pm";
                break;
                case "tarde":
                echo "02:00 pm - 10:00 pm";
                break;
                case "noche":
                echo "10:00 pm - 06:00 am";
                break;
                }?></center></td>
                <td COLSPAN="14"><center>FECHA: <?php echo $fecha ?></center></td>
            
            </tr>
        </tr>
            
            <?php 
            
             $cantidadRotulos=0;
             $arregloIdRotulo=array();
             
             
            ///////////////////////////////////////////////
            for($prensada=1;$prensada<=7;$prensada++){
            
            if($prensada==7){
                ?>
                
            <tr>
                <td COLSPAN="22"><center>INTEGRANTES</center></td>
            </tr>
             <tr>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="1"><?php //echo $turno ?>_</td>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="7"><?php //echo $turno ?>_</td>
                <td COLSPAN="7"><?php //echo $turno ?>_</td>
            </tr>
            <tr>
                <td COLSPAN="22"><center>OBSERVACIONES</td>
            </tr>
             <tr>
                <td COLSPAN="22">_<?php //echo $turno ?></td>
            </tr>
            <tr>
                <td COLSPAN="22">_<?php //echo $turno ?></td>
            </tr>
            <tr>
                <td COLSPAN="22">_<?php //echo $turno ?></td>
            </tr>
                <tr>
            <!--Encabezado general de la tabla-->
            
            <td ROWSPAN="3" COLSPAN="5" ><center><h2>MASTERDENT</center></td>
            <td ROWSPAN="3" COLSPAN="13"><center><h4>PROGRAMACIÓN PARA LAS PRENSADAS</center></td>
            <td COLSPAN="4" >Cod F-PR-05</td>
        </tr>
        <tr><td COLSPAN="4">Versión 003</td></tr>
        <tr><td COLSPAN="4">09-jun-22</td></tr>
            <tr>
                <td COLSPAN="8"><center>HORARIO: <?php 
                switch ($turno) {
                case "mañana":
                echo "06:00 am - 02:00 pm";
                break;
                case "tarde":
                echo "02:00 pm - 10:00 pm";
                break;
                case "noche":
                echo "10:00 pm - 06:00 am";
                break;
                }?></center></td>
                <td COLSPAN="14"><center>FECHA: <?php echo $fecha ?></center></td>
            
            </tr>
            
        </tr>
        <?php        
            }
            ?>
            
            <!--Encabezado de cada prensada-->
            
            <tr>
                <td COLSPAN="8"><center>PRENSADA <?php echo $prensada ?></center></td>
                <td COLSPAN="14"><center>VUELTAS</center></td>
            
            </tr>
            <tr>
                <!--<td>id</td>-->
                <td>ID</td><!--presento el código del rótulo con el nombre de id-->
                <td>REF</td>
                <td>PEDIDO</td>
                <td>LOTE</td>
                <td>#</td> 
                <td>COLOR</td>
                <td>INCISAL</td>
                <td>JUEGOS</td>
                <td>_1</td>
                <td>_2</td>
                <td>_3</td>
                <td>_4</td>
                <td>_5</td>
                <td>_6</td>
                <td>_7</td>
                <td>_8</td>
                <td>_9</td> 
                <td>_10</td> 
                <td>_11</td> 
                <td>_12</td> 
                <td>total</td> 
                <td style="background-color: yellow">total</td>
                
                
                
            </tr>
            
            <!--datos espesíficos de cada prensada-->
            
            <?php
            
            //consulta para obtener los datos de la prensada específica
            
            $sql="SELECT rotulos2.*,referencias2.`nombre` AS 'referencia', colores2.`nombre` AS 'Color', colores2.`incisal` AS 'incisal', pedidos2.`codigoP` AS Pedido, lotes2.`nombreL` AS Lote, estaciones2.`nombre` AS 'estacionActual' FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN colores2 ON rotulos2.`colorId` = colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido` = pedidos2.`idP` INNER JOIN lotes2  ON  rotulos2.`loteId`= lotes2.`id` INNER JOIN estaciones2 ON rotulos2.`estacionId2` = estaciones2.`id`   WHERE rotulos2.`fecha` = '".$fecha."' AND rotulos2.`turno` LIKE '%".$turno."%' AND rotulos2.`prensada` = '".$prensada."' ORDER BY rotulos2.`id` ASC";
            
            $result=mysqli_query($conexion,$sql);
            
           
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <!--<td><?php //echo $mostrar['id'] ?></td>-->
                
                
                <td><?php echo $mostrar['id'] ?></td>
                
                <td><?php echo $mostrar['referencia'] ?></td>
                <td><?php echo $mostrar['Pedido'] ?></td>
                <td><?php echo $mostrar['Lote'] ?></td>
                <td><?php echo $mostrar['cantidadMoldes'] ?></td>
                <td><?php echo $mostrar['Color'] ?></td>
                <!--<td><?php //echo $mostrar['fecha'] ?></td>-->
                <!--<td><?php //echo $mostrar['prensada'] ?></td>-->
                
                
                
                
                
                <td><?php echo $mostrar['incisal'] ?></td>
                <td><?php echo $mostrar['juegos'] ?></td>
                
                <td><?php "   "//echo $mostrar['vuelta1'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta2'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta3'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta4'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta5'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta6'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta7'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta8'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta9'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta10'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta11'] ?></td>
                <td><?php "   "//echo $mostrar['vuelta12'] ?></td>
                <td><?php echo $mostrar['total'] ?></td>
                <td><label for="producidos<?php echo $mostrar['id']  ?>" class="form-label"></label><input type="text" class="form-control" id="producidos<?php echo $mostrar['id']  ?>" name="producidos<?php echo $mostrar['id']  ?>" style="width: 40px" ></td>
                <!--<td><?php //echo $mostrar['nota'] ?></td>-->
                
            </tr>
            
            <!--datos generales al final de cada prensada-->
            <?php
            
            $cantidadRotulos=$cantidadRotulos+1;
            $arregloIdRotulo[]=$mostrar['id'];
            }
            
            //a continuación consulto el total de moldes de la prensada actual.
           
           $sqlC="SELECT SUM(cantidadMoldes) AS total, SUM(juegos) AS totalJuegos FROM rotulos2 WHERE rotulos2.`fecha` = '".$fecha."' AND rotulos2.`turno` LIKE '%".$turno."%' AND rotulos2.`prensada` = '".$prensada."'";
            $resultC=mysqli_query($conexion,$sqlC);
            
            while($mostrarC=mysqli_fetch_array($resultC)){
            $moldesPrensada=$mostrarC['total'];
            $totalJuegos=$mostrarC['totalJuegos'];
            }
            
            //convierto el string $turno a mayúsculas para presentarlo en la tabla
            //$turnoMayus=strtoupper($turno);


            ?>
            <!--una línea vacía al final de cada prensada-->
            <tr>
                
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>_</td>
                
            </tr>
            
            <tr>
                <td COLSPAN="5"><center>TOTAL MOLDES: <?php echo $moldesPrensada ?> </center></td>
                <td COLSPAN="3"><center>TOTAL JUEGOS: <?php echo $totalJuegos ?></center></td>
                <td ROWSPAN="2" COLSPAN="14"><center></center></td>
            
            </tr>
            <tr>
                <td COLSPAN="8"><center>TURNO: <?php echo $turno ?></center></td>
                
            
            </tr>
            <tr>
                <!--<td COLSPAN="17"><center>_<?php //echo $turno ?></center></td>-->
            </tr>
            
            <?php
            }
            ?>
            
            <tr>
                <td COLSPAN="22"><center>INTEGRANTES</center></td>
            </tr>
             <tr>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="1"><?php //echo $turno ?>_</td>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="2"><?php //echo $turno ?>_</td>
                <td COLSPAN="7"><?php //echo $turno ?>_</td>
                <td COLSPAN="7"><?php //echo $turno ?>_</td>
            </tr>
            <tr>
                <td COLSPAN="22"><center>OBSERVACIONES</td>
            </tr>
             <tr>
                <td COLSPAN="22">_<?php //echo $turno ?></td>
            </tr>
            <tr>
                <td COLSPAN="22">_<?php //echo $turno ?></td>
            </tr>
            <tr>
                <td COLSPAN="22">_<?php //echo $turno ?></td>
            </tr>
        </table>
        
        
                  <input name="cantidadRotulos" type="hidden" value=" <?php
                        echo $cantidadRotulos; 
                    ?>">
                    
                    <input type="hidden" name="arregloIdRotulo" value="<?php echo  base64_encode(serialize($arregloIdRotulo));?>" >
        
         </div>
                <br>
                <input type="submit" name="Crear" >
            </form>
        </div>
    
    
        
        
    </div>
    
   
        <br></br>

    <br>
    
    
    
    </center>
    

<?php
  
            ?>
            
            </body>
</html>