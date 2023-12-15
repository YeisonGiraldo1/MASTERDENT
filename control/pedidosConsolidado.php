<?php
//$pedido=$_GET ["id"];
//echo "aquí podremos ver lo ítems del pedido". $pedido. "según su estado dentro del proceso.";

//////////////////////////////////////////////////////////////
session_start();
if (!isset($_SESSION['Cedula']) || !isset($_SESSION['Contrasena'])) {
    $cedula = 1993;
    $contrasena = 2050;
    echo "<script>
    alert('Zona no autorizada, por favor inicia la sesión');
    window.location = '../index.php';
    </script>";
} else {
    $cedula = $_SESSION['Cedula'];
    $contrasena = $_SESSION['Contrasena'];
    $rol = $_SESSION['Rol'];

    $conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

    $pedido = isset($_POST['pedido']) ? $_POST['pedido'] : '';
    $cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
    $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $uppLow = isset($_POST['uppLow']) ? $_POST['uppLow'] : '';
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';

    $granel = 0;
    $programados = 0;
    $producidos = 0;
    $pulidos = 0;
    $separados = 0;
    $emplaquetados = 0;
    $revisados = 0;
    $verificados = 0;
    $empacados = 0;

    $filtros = array();

    if ($pedido != '') {
        $sqlPedido = "SELECT `idP` FROM `pedidos2` WHERE `codigoP` = '$pedido'";
        $resultPedido = mysqli_query($conexion, $sqlPedido);

        while ($mostrarPedido = mysqli_fetch_array($resultPedido)) {
            $pedido = $mostrarPedido['idP'];
        }

        $filtros[] = "pedidoDetalles.`pedidoId` = '$pedido'";
    }

    if ($cliente != '') {
        $filtros[] = "nombreCliente LIKE '%$cliente%'";
    }

    if ($referencia != '') {
        $sqlRef = "SELECT `id` FROM `referencias2` WHERE nombre LIKE '$referencia'";
        $resultRef = mysqli_query($conexion, $sqlRef);

        while ($mostrarRef = mysqli_fetch_array($resultRef)) {
            $referencia = $mostrarRef['id'];
        }

        $filtros[] = "pedidoDetalles.`referenciaId` = '$referencia'";
    }

    if ($color != '') {
        $sqlCol = "SELECT `id` FROM `colores2` WHERE nombre = '$color'";
        $resultCol = mysqli_query($conexion, $sqlCol);

        while ($mostrarCol = mysqli_fetch_array($resultCol)) {
            $color = $mostrarCol['id'];
        }

        $filtros[] = "pedidoDetalles.`colorId` = '$color'";
    }

    if ($uppLow != '') {
        $filtros[] = "referencias2.`nombre` LIKE '%$uppLow'";
    }

    if ($tipo != '') {
        $filtros[] = "referencias2.`tipo` = '$tipo'";
    }

    if (empty($filtros) || (is_null($filtros[0]) || $filtros[0] == '')) {
        $filtros[0] = '1';
    }

    $consultaFiltros = "SELECT 
    pedidoDetalles.*,
    pedidos2.`codigoP` AS pedido,
    pedidos2.`estado` AS estado,
    pedidos2.`idCliente` AS idCliente,
    clientes2.nombreCliente AS nombreCliente,
    GREATEST(sum(pedidoDetalles.`juegos`), 0) as totalPedidos,
    GREATEST(sum(pedidoDetalles.`programados`), 0) as totalProgramados,
    GREATEST(sum(pedidoDetalles.`granel`), 0) as totalGranel,
    GREATEST(sum(pedidoDetalles.`pulidos`), 0) as totalPulidos,
    GREATEST(sum(pedidoDetalles.`producidos`), 0) as totalProducidos,
    GREATEST(sum(pedidoDetalles.`enSeparacion`), 0) as totalEnSeparacion,
    GREATEST(sum(pedidoDetalles.`separado`), 0) as totalSeparados,
    GREATEST(sum(pedidoDetalles.`enEmplaquetado`), 0) as totalEnEmplaquetado,
    GREATEST(sum(pedidoDetalles.`emplaquetados`), 0) as totalEmplaquetados,
    GREATEST(sum(pedidoDetalles.`revision1`), 0) as totalRevision1,
    GREATEST(sum(pedidoDetalles.`revision2`), 0) as totalRevision2,
    GREATEST(sum(pedidoDetalles.`empacados`), 0) as totalEmpacados,
    referencias2.`nombre` AS referencia,
    referencias2.`tipo` AS tipo,
    colores2.`nombre` AS Color
 FROM pedidoDetalles
 INNER JOIN referencias2 ON pedidoDetalles.`referenciaId` = referencias2.`id`
 INNER JOIN pedidos2 ON pedidoDetalles.`pedidoId` = pedidos2.`idP`
 INNER JOIN colores2 ON pedidoDetalles.`colorId` = colores2.`id`
 INNER JOIN clientes2 ON pedidos2.idCliente = clientes2.id
 WHERE pedidos2.`estado` = 'enProceso' AND";

$consultaSuma = "SELECT 
referencias2.`nombre` AS referencia,
referencias2.`tipo` AS tipo,
pedidos2.`codigoP` AS pedido,
pedidos2.`estado` AS estado,
pedidos2.`idCliente` AS idCliente,
clientes2.nombreCliente AS nombreCliente,
GREATEST(sum(pedidoDetalles.`juegos`), 0) as totalPedidos,
GREATEST(sum(pedidoDetalles.`programados`), 0) as totalProgramados,
GREATEST(sum(pedidoDetalles.`granel`), 0) as totalGranel,
GREATEST(sum(pedidoDetalles.`pulidos`), 0) as totalPulidos,
GREATEST(sum(pedidoDetalles.`producidos`), 0) as totalProducidos,
GREATEST(sum(pedidoDetalles.`enSeparacion`), 0) as totalEnSeparacion,
GREATEST(sum(pedidoDetalles.`separado`), 0) as totalSeparados,
GREATEST(sum(pedidoDetalles.`enEmplaquetado`), 0) as totalEnEmplaquetado,
GREATEST(sum(pedidoDetalles.`emplaquetados`), 0) as totalEmplaquetados,
GREATEST(sum(pedidoDetalles.`revision1`), 0) as totalRevision1,
GREATEST(sum(pedidoDetalles.`revision2`), 0) as totalRevision2,
GREATEST(sum(pedidoDetalles.`empacados`), 0) as totalEmpacados
FROM pedidoDetalles
INNER JOIN pedidos2 ON pedidoDetalles.`pedidoId` = pedidos2.`idP`
INNER JOIN referencias2 ON pedidoDetalles.`referenciaId` = referencias2.`id`
INNER JOIN clientes2 ON pedidos2.idCliente = clientes2.id
WHERE pedidos2.`estado` = 'enProceso' AND";
}

if ($rol == 1 || $rol == 3) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
          body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Public/imagenes/almacen2.jpeg');
            background-size: cover;
        }
           .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }

        .gray-table {
            background-color: #ccc; /* Color gris de fondo */
        }
    </style>
    <button class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
     <!--<button onclick="location.href='../control/vistas/modulos/verTablaPedidos.php'">Atrás</button>-->
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PedidosConsolidado</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    


</head>

<head>
	<meta charset="UTF-8">
	<title>Empaque</title>
</head>
<body>
    <center>

   
<div class="container">


        <h1>Consolidado de pedidos </h1>
    
    

            <form action="pedidosConsolidado.php" method="POST">
            
            
            <div class="row">
                   
            <div class="col-md-4">
                    <label for="pedido" class="form-label">Pedido</label>
                    <input type="text" size="15" class="form-control " id="pedido" name="pedido">            
 </div>


                    <div class="col-md-4">
                    <label for="cliente" class="form-label">Cliente</label>
                    <input type="text" size="15" class="form-control " id="cliente" name="cliente">
                    </div>
                   

                    <div class="col-md-4">
                    <label for="referencia" class="form-label">Referencia</label>
                    <input type="text" size="15" class="form-control " autofocus  id="referencia" name="referencia">
                    </div>


                    <div class="row">

                    <div class="col-md-4">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" size="15" class="form-control "  id="color" name="color">
                    </div>

                    <div class="col-md-4">
                    <label for="tipo" class="form-label">Muela/Diente</label>
                    <select class="form-select"  id="tipo" name="tipo" aria-label="Default select example">
                        <option selected></option>
                        <option value="Muela">MUELA</option>
                        <option value="Diente">DIENTE</option>
                    </select>
                    </div>


                    <div class="col-md-4">
                     <label for="uppLow" class="form-label">Sup/Inf</label>
                    <select class="form-select"  id="uppLow" name="uppLow" aria-label="Default select example">
                        <option selected></option>
                        <option value="-S">SUP</option>
                        <option value="-I">INF</option>
                    </select>
                    <br><br>
                    </div> </div>
                

                   
                    
                    <div class="row">

                    <div class="col-md-12">
                <input type="submit" name="Empacar" class="btn btn-success" >
                </div> </div>
            </form>
     
                    
<br></br><br><br>
    
<table class="table table-bordered table-striped gray-table"> 
            <tr>
                <!--<td>id</td>-->
               
                <td>Pedido</td>
                <td>Cliente</td>
                <td>Referencia</td>
                <td>Color</td>
                <td>Pedidos</td>
                <td>Granel</td>
                <td>PorProgramar</td>
                <td>Programados</td>
                <td>Producidos</td>
                <td>Pulidos</td>
                <!--<td>EnSeparación</td>-->
                <td>Separados</td>
                <td>EnEmplaquetado</td>
                <td>Emplaquetados</td>
                <td>Revisión 1</td>
                <td>Asignados</td>
                <td>Empacados</td>
                <td>Faltan</td>
                <td>Historial</td>
                <td>VerGranel</td>
               
                <!--<td>acción</td>
                <td>acción</td>-->
                
                
            </tr>
            
            <?php
            
            
            if ($pedido != ''){
             echo " - Pedido = ".$_POST['pedido'];
    }
    
        if($cliente != ''){
           echo " - Cliente = ".$cliente;
        }
       
    
         if ($referencia != ''){
        
        
            
            echo " - Referencia = ".$_POST['referencia'];
            
                
    }
    if ($color != ''){
            
            echo " - Color = ".$_POST['color'];
    }
    
    if ($uppLow != ''){
           echo " - Sup/Inf=  $uppLow";
    }
     if ($tipo != ''){
            echo " - Tipo = $tipo";
    }
    
            
            
            
            
            //$sql="SELECT pedidoDetalles.*, referencias2.`nombre` AS 'referencia', colores2.`nombre` AS 'Color' FROM pedidoDetalles INNER JOIN referencias2 ON pedidoDetalles.`referenciaId`= referencias2.`id` INNER JOIN colores2 ON pedidoDetalles.`colorId` = colores2.`id` WHERE pedidoDetalles.`pedidoId` = '".$pedidoId."' ORDER BY pedidoDetalles.`id` DESC";
            $sql= $consultaFiltros." ". implode(" AND ",$filtros) ." GROUP BY pedido, colorId, referenciaId ";
            //echo $sql;
            $result=mysqli_query($conexion,$sql);
            
            while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <!--<td><?php //echo $mostrar['id'] ?></td>-->
                    <td><?php echo $mostrar['pedido'] ?></td>
                    <td><?php echo $mostrar['nombreCliente'] ?></td>
                    <td><?php echo $mostrar['referencia'] ?></td>
                    <td><?php echo $mostrar['Color'] ?></td>
                    <td><?php echo max(0, $mostrar["totalPedidos"]) ?></td>
                    <td><?php echo max(0, $mostrar["totalGranel"]) ?></td>
                    <td><?php echo max(0, ($mostrar["totalPedidos"] * 1.25) - ($mostrar["totalRevision2"] + $mostrar["totalProgramados"])) ?></td>
                    <td bgcolor="<?php echo ($mostrar["totalRevision2"] + $mostrar["totalProgramados"]) > $mostrar["totalPedidos"] * 1.25 ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalProgramados"]) ?></td>
                    <td bgcolor="<?php echo $mostrar["totalProducidos"] > $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalProducidos"]) ?></td>
                    <td bgcolor="<?php echo $mostrar["totalPulidos"] > $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalPulidos"]) ?></td>
                    <!--<td bgcolor= "<?php //if($mostrar["totalEnSeparacion"]>$mostrar["totalPedidos"]){
                    //echo "B6FF8A";
                    //}?>"><?php //echo $mostrar["totalEnSeparacion"] ?></td>-->
                    <td bgcolor="<?php echo $mostrar["totalSeparados"] > $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalSeparados"]) ?></td>
                    <td bgcolor="<?php echo $mostrar["totalEnEmplaquetado"] > $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalEnEmplaquetado"]) ?></td>
                    <td bgcolor="<?php echo $mostrar["totalEmplaquetados"] >= $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalEmplaquetados"]) ?></td>
                    <td bgcolor="<?php echo $mostrar["totalRevision1"] >= $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalRevision1"]) ?></td>
                    <td bgcolor="<?php echo $mostrar["totalRevision2"] >= $mostrar["totalPedidos"] ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalRevision2"]) ?></td>
                    <td bgcolor="<?php
                        if ($mostrar["totalEmpacados"] == $mostrar["totalPedidos"]) {
                            echo "B6FF8A";
                        } else if (($mostrar["totalEmpacados"] > $mostrar["totalPedidos"]) || ($mostrar["totalEmpacados"] - $mostrar["totalPedidos"] == $mostrar["totalEmpacados"])) {
                            echo "FB413B";
                        }
                        ?>"><?php echo max(0, $mostrar["totalEmpacados"]) ?></td>
                    <td bgcolor="<?php
                        if ($mostrar["totalPedidos"] - $mostrar["totalEmpacados"] == 0) {
                            echo "B6FF8A";
                        } else if ($mostrar["totalPedidos"] - $mostrar["totalEmpacados"] < 0) {
                            echo "FB413B";
                        }
                        ?>"><?php echo max(0, ($mostrar["totalPedidos"]) - ($mostrar["totalEmpacados"])) ?></td>
                    <td><a class="btn btn-secondary" href="../control/trazarItem.php?idP=<?php echo $mostrar['pedidoId']; ?>&referenciaId=<?php echo $mostrar['referenciaId'] ?>&colorId=<?php echo $mostrar['colorId'] ?>&Crear=Enviar'">Historial</a></td>
                    <td><a class="btn btn-secondary" href="../control/vistas/modulos/verTablaGranel.php?idP=<?php echo $mostrar['pedidoId']; ?>&referenciaId=<?php echo $mostrar['referenciaId'] ?>&colorId=<?php echo $mostrar['colorId'] ?>&Crear=Enviar'">verGranel</a></td>
                    <!--<td><a    href="editar_detellePedido.php?id=<?php //echo $mostrar['id'] ?>&turno=<?php //echo $turno?>&prensada=<?php //echo $prensada?>&fecha=<?php //echo $fecha?> ">Editar</a></td>
                    <td><a href="#" data-href="eliminar_detallePedido.php?id=<?php //echo $mostrar['id']; ?>" data-rg="<?= $mostrar['id'] ?>" id="delRg" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Eliminar</a></td>-->
                </tr>
                <?php
            }
            ?>
            
        </table>
        
        <br></br>
        
         <script type="text/javascript">
        $(document).on("click", "#delRg", function(event) {
            event.preventDefault();

            let ifRegistro = $(this).attr('data-rg');

            $.ajax({
                url: "../control/trazarItem.php",
                data: {
                    id: ifRegistro
                },
                success: function(result) {

                    console.log(result);
                    location.reload();
                   


                },
                error: function(request, status, error) {
                    console(request.responseText);
                    console(error);
                }
            });

        });
    </script>
    
    <!--enlace en tabla para ver producción a granel de esa referencia y color-->
    
           <script type="text/javascript">
        $(document).on("click", "#delRg", function(event) {
            event.preventDefault();

            let ifRegistro = $(this).attr('data-rg');

            $.ajax({
                url: "../control/vistas/modulos/verTablaGranel.php",
                data: {
                    id: ifRegistro
                },
                success: function(result) {

                    console.log(result);
                    location.reload();
                   


                },
                error: function(request, status, error) {
                    console(request.responseText);
                    console(error);
                }
            });

        });
    </script>
    
    <table class="table table-bordered table-striped gray-table"> 
        <tr>
               
                <td COLSPAN= "13"><CENTER>TOTALES</CENTER></td>
                
            </tr>
            <tr>
               
                <td>Pedidos</td>
                <td>Granel</td>
                <td>Programados</td>
                <td>Producidos</td>
                <td>Pulidos</td>
                <!--<td>EnSeparación</td>-->
                <td>Separados</td>
                <td>EnEmplaquetado</td>
                <td>Emplaquetados</td>
                <td>Revisión</td>
                <td>Revisión</td>
                <td>Empacados</td>
                
                
            </tr>
            
            <?php
            //$sql="select * , COUNT(id), sum(juegos) as total FROM listaEmpaque WHERE pedidoId ='". $pedido. "' AND mold = '". $referencia. "' AND shade = '".$color."' GROUP BY mold, shade, lote, uppLow, caja ORDER BY mold;";
            $sqlSuma=$consultaSuma." ". implode(" AND ",$filtros)." ";
            $resultSuma=mysqli_query($conexion,$sqlSuma);
            
            //echo $sqlSuma;
            //echo var_dump($filtros);
            
            while ($mostrarSuma = mysqli_fetch_array($resultSuma)) {
    ?>
    <tr>
        <td><?php echo max(0, $mostrarSuma['totalPedidos']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalGranel']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalProgramados']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalProducidos']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalPulidos']) ?></td>
        <!--<td><?php //echo $mostrarSuma['totalEnSeparacion'] ?></td>-->
        <td><?php echo max(0, $mostrarSuma['totalSeparados']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalEnEmplaquetado']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalEmplaquetados']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalRevision1']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalRevision2']) ?></td>
        <td><?php echo max(0, $mostrarSuma['totalEmpacados']) ?></td>
    </tr>
    <?php
}
?>

        </table>
        <br></br>
        </div>
          
            

<?php




}

else {
  echo"<h1>No estoy autorizado para ingresar a esta pagina.</h1>";
}
?>