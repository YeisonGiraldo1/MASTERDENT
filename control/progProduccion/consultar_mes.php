<?php
$Seleccionado=$_GET['Seleccionado'];
$date=date("d-m-y");
$año=date("y");
$Selecciono_ano=$_GET['Selecciono_ano'];
$añodefinitivo="20".$Selecciono_ano;


$mes=$Seleccionado;

$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
$consultofecha=mysqli_query($conexion,"SELECT rotulos2.*,rotulos2.id AS rotid, colores2.*,colores2.nombre AS color, estaciones2.*,estaciones2.nombre AS verestacion , lotes2.*,lotes2.nombreL AS verlote,referencias2.*, pedidos2.*,referencias2.nombre AS vereferencia, pedidos2.codigoP AS verpedido FROM rotulos2 INNER JOIN colores2 ON rotulos2.`colorId` = colores2.`id` INNER JOIN estaciones2 ON rotulos2.`estacionId2`=estaciones2.`id`INNER JOIN lotes2 ON rotulos2.`loteId`=lotes2.`id` INNER JOIN referencias2 ON rotulos2.`referenciaId`=referencias2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido`=pedidos2.`idP` WHERE YEAR(fecha) = '$añodefinitivo' AND MONTH(fecha) = '$mes'  ORDER BY rotulos2.fecha ASC, rotulos2.id ASC");
$resultado=mysqli_num_rows($consultofecha);

if($resultado>0){




?>
<html>

<head>
<style>
          body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../../Public/imagenes/moldeado2.jpeg');
            background-size: cover;
        }
           .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }
    </style>
    <button class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
</head>

<body>

<div class="container">
  <br>
  <div style="display:center;">
  <br>
  <h1>RESULTADOS INVIMA </h1>&nbsp;&nbsp;
   <br>
<a class="btn btn-primary" style="margin-left:60%;" href="invima.php">REGRESAR</a>
<a class="btn btn-primary" href="exportar_invima.php?Seleccionado=<?php echo $Seleccionado?>&Selecciono_ano=<?php echo $Selecciono_ano?>">Exportar a Excel</a>
</div>
<br><br>

<table  class="table table-dark">
  <thead>
    <tr>
      <th scope='col'  hidden>ID</th>
      <th scope='col'>Fecha</th>
      <th scope='col'>Referencia</th>
      <th scope='col'>Color</th>
      <th scope='col'>Lote</th>
      <th scope='col'>Producidos</th>
      
                       
    </tr>
  </thead>
  <tbody>
    <?php
      while  ($data = mysqli_fetch_assoc($consultofecha)) {

        ?>
        <tr>
    <th  hidden><?php   echo $data['rotid'];?></th> 
        <th><?php   echo $data['fecha'];?></th>
          <td><?php   echo $data['vereferencia'];?></td>
          <td><?php   echo $data['color'];?></td>
          <td><?php   echo $data['verlote'];?></td>
          <td><?php   echo $data['total'];?></td>
          
           
              </td>
          <?php  }?>
        </tr>
    
      </tbody>
    </table>
    
    
    </div>
    
    </body>
    </div>
<div>
    
    </html>
    
    <?php

      }
else {
    
      $color=0;
      $referencia=0;
      $lote=0;
      $fecha=0;
    
    echo"<head>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    </head>
    
    <body>
    <div>
    <br>
    <div style='display:flex;'>
    <h1>Resultados De Busqueda</h1>&nbsp;&nbsp;&nbsp;
    <button type='button'  style='margin-left:60%;'><a href='invima.php'>REGRESAR</a></button>
    
    </div>
    <br>
    <h3  style='color: red;'> NO SE ENCUENTRAN LOS DATOS SOLICITADOS</h3>
    <table class='table'>
      <thead>
        <tr>
          <th scope='col'>Fecha</th>
                      <th scope='col'>Referencia</th>
                      <th scope='col'>Color</th>
                      <th scope='col'>Lote</th>
                      
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope='col'>NULL</th>
          <th scope='col'>NULL</th>
          <th scope='col'>NULL</th>
          <th scope='col'>NULL</th>
        
      
    
        </tr>
      </tbody>
    </body>";
    

}

?>

