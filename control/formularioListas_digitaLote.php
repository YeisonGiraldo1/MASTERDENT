<?php


$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");


$pedido=$_GET ["pedido"];
$caja=$_GET ["caja"];
$metodo=$_GET ["metodo"];

$lineaPedido="";




//$nombreCliente=$_GET ["nombreCliente"];
$cajaMayor="";

//consulto el valor máximo de las cajas para asignar el dicho valor más uno en caso de que el valor GET de caja sea==0

$sqlCaja="SELECT * FROM `listaEmpaque` WHERE pedidoId='". $pedido. "' ORDER BY caja DESC LIMIT 1;";
$resultCaja=mysqli_query($conexion,$sqlCaja);

 while($mostrarCaja=mysqli_fetch_array($resultCaja)){
                    $cajaMayor=$mostrarCaja['caja'];   //valor máximo de caja para  este pedido       
   
            
            }
            
            //pregunto por el valor de la caja GET y si es == 0, pregunto cuál es el valor de la caja mayor, si este es null $caja=1, si es otro, entonces caja=cajaMayor+1
            if ($caja==0){
                
                if(is_null($cajaMayor)){
                    
                    $caja=1;
                    
                }
                else{
                    $cajaM=intval($cajaMayor);
                    $caja = $cajaM + 1;
                }
            }



?>

<!DOCTYPE html>
<html lang="en">
    
<div class="container mt-3">
        <div class="row">
        <div class="col-md-6 mb-3">
            <button class="btn btn-primary w-100" onclick="location.href='../control/'">Inicio</button>
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-primary w-100" onclick="location.href='../control/formulario_seleccionPedido.php'">Seleccionar otro pedido</button>
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-primary w-100" onclick="location.href='../control/formulario_seleccionPedido.php?destino=inventario&Crear=Enviar'">Inventarios</button>
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-primary w-100" onclick="location.href='../control/formulario_seleccionPedido.php?destino=asignacion&Crear=Enviar'">Asignaciones</button>
        </div>
        
        
       

    	
			
			
		
			    
			    <body>
			        
                <div class="container mt-3">
                <div class="container mt-3">
    <div class="row">
        <!-- Primer formulario -->
        <div class="col-md-6">
            <form action="empaque.php" method="get" name="empaquePedido">
                <div class="mb-3">
                    <input name="cajas" type="hidden" value="null">
                    <input name="pedido" type="hidden" value="<?php echo $pedido; ?>">
                    <input name="caja" type="hidden" value="<?php echo $caja; ?>">
                    <input name="metodo" type="hidden" value="<?php echo $metodo; ?>">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary w-100" onClick='submitForm()'>Volver al pedido</button>
                </div>
            </form>
        </div>

        <!-- Segundo formulario -->
        <div class="col-md-6">
            <form action="inventario.php" method="get" name="generalInventario">
                <div class="mb-3">
                    <input name="cajas" type="hidden" value="null">
                    <input name="pedido" type="hidden" value="<?php echo $pedido; ?>">
                    <input name="caja" type="hidden" value="<?php echo $caja; ?>">
                    <input name="metodo" type="hidden" value="<?php echo $metodo; ?>">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary w-100" onClick='submitForm()'>Inventario General</button>
                </div>
            </form>
        </div>
    </div>
</div>


            
            <script>
             function submitForm() {
                document.getElementById('empaquePedido').submit();
                }
                </script>



		     
            <script>
                     function submitForm() {
                    document.getElementById('generalInventario').submit();
                      }
                    </script>
                
                
                




<head>
    <meta charset="UTF-8">
    
    <title>listaEmpaque</title>
    
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
    <!---->
    <!--<link rel="stylesheet" href="cssProyecto/estilosTablas.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <link href="cssProyecto/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="cssProyecto/slide.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
        
                <!--<h2>Registro de Ítems</h2>-->
                <?php
                presentar_formulario_segun_metodo($metodo,$caja,$pedido, $cajaMayor);
                
                if ($metodo=="7" || $metodo=="8"){
                    
                    ?>
                    
    <div class="table-responsive gray-table">
        <table  class="table table-striped table-bordered gray-table">
            <tr>
                <!--<td>id</td>-->
               
                
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
                <td>Historial</td>
                <!--<td>VerGranel</td>-->
               
                <!--<td>acción</td>
                <td>acción</td>-->
                
                
            </tr>
            
            <?php
$sql = "SELECT pedidoDetalles.*, sum(pedidoDetalles.`juegos`) as totalPedidos, sum(pedidoDetalles.`programados`) as totalProgramados, sum(pedidoDetalles.`granel`) as totalGranel, sum(pedidoDetalles.`pulidos`) as totalPulidos, sum(pedidoDetalles.`producidos`) as totalProducidos, sum(pedidoDetalles.`enSeparacion`) as totalEnSeparacion, sum(pedidoDetalles.`separado`) as totalSeparados, sum(pedidoDetalles.`enEmplaquetado`) as totalEnEmplaquetado, sum(pedidoDetalles.`emplaquetados`) as totalEmplaquetados, sum(pedidoDetalles.`revision1`) as totalRevision1, sum(pedidoDetalles.`revision2`) as totalRevision2, sum(pedidoDetalles.`empacados`) as totalEmpacados, referencias2.`nombre` AS referencia, referencias2.`tipo` AS tipo, colores2.`nombre` AS Color FROM pedidoDetalles INNER JOIN referencias2 ON pedidoDetalles.`referenciaId`= referencias2.`id` INNER JOIN colores2 ON pedidoDetalles.`colorId` = colores2.`id` WHERE pedidoDetalles.pedidoId='" . $pedido . "' AND pedidoDetalles.revision2 >0 AND pedidoDetalles.revision2 IS NOT NULL GROUP BY colorId, referenciaId ORDER BY pedidoDetalles.fechaCreacion DESC";
$result = mysqli_query($conexion, $sql);

while ($mostrar = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <!--<td><?php //echo $mostrar['id'] ?></td>-->
            <td><?php echo max(0, $mostrar['referencia']) ?></td>
            <td><?php echo max(0, $mostrar['Color']) ?></td>
            <td><?php echo max(0, $mostrar["totalPedidos"]) ?></td>
            <td><?php echo max(0, $mostrar["totalGranel"]) ?></td>
            <td><?php echo max(0, ($mostrar["totalPedidos"] * 1.25) - ($mostrar["totalGranel"] + $mostrar["totalProgramados"])) ?></td>
    
            <td bgcolor="<?php echo (($mostrar["totalGranel"] + $mostrar["totalProgramados"]) > $mostrar["totalPedidos"] * 1.25) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalProgramados"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalProducidos"] > $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalProducidos"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalPulidos"] > $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalPulidos"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalSeparados"] > $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalSeparados"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalEnEmplaquetado"] > $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalEnEmplaquetado"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalEmplaquetados"] >= $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalEmplaquetados"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalRevision1"] >= $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalRevision1"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalRevision2"] >= $mostrar["totalPedidos"]) ? "B6FF8A" : "" ?>"><?php echo max(0, $mostrar["totalRevision2"]) ?></td>
    
            <td bgcolor="<?php echo ($mostrar["totalEmpacados"] == $mostrar["totalPedidos"]) ? "B6FF8A" : ((($mostrar["totalEmpacados"] > $mostrar["totalPedidos"]) || ($mostrar["totalEmpacados"] - $mostrar["totalPedidos"]) == $mostrar["totalEmpacados"]) ? "FB413B" : "") ?>"><?php echo max(0, $mostrar["totalEmpacados"]) ?></td>
            <td><a href="../control/trazarItem.php?idP=<?php echo $mostrar['pedidoId']; ?>&referenciaId=<?php echo $mostrar['referenciaId'] ?>&colorId=<?php echo $mostrar['colorId'] ?>&Crear=Enviar'">Historial</a></td>
            <!--
            <td><a href="../control/vistas/modulos/verTablaGranel.php?idP=<?php //echo $mostrar['pedidoId']; ?>&referenciaId=<?php //echo $mostrar['referenciaId'] ?>&colorId=<?php //echo $mostrar['colorId'] ?>&Crear=Enviar'" >verGranel</a></td>-->
    
            <!--<td><a    href="editar_detellePedido.php?id=<?php //echo $mostrar['id'] ?>&turno=<?php //echo $turno?>&prensada=<?php //echo $prensada?>&fecha=<?php //echo $fecha?> ">Editar</a></td>
            <td><a href="#" data-href="eliminar_detallePedido.php?id=<?php //echo $mostrar['id']; ?>" data-rg="<?= $mostrar['id'] ?>" id="delRg" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Eliminar</a></td>-->
        </tr>
    <?php
    }
    ?>

        </table>
    </div>
        <br></br>
                    
                    <?php
                }
                else{
                ?>
                <div class="table-responsive">
        <center><h3>Registros</h3></center>
        
        

        <table ALIGN="center" border="1" class="table table-striped table-bordered gray-table">
            <tr>
                <td>ID</td>
                <td>QR</td>
                <td>MOLD</td>
                <td>ANT/POS</td>
                <td>UPP/LOW</td>
                <td>SHADE</td>
                <td>CAJA</td>
                <td>JUEGOS</td>
                <td>INGRESO</td>
                <td>ACCIÓN</td>
                
            </tr>
            
            <?php
            $sql="select *  FROM listaEmpaque WHERE caja = '". $caja. "'AND pedidoId = '" .$pedido. "' ORDER BY id DESC LIMIT 100;";
            $result=mysqli_query($conexion,$sql);
            //echo $sql;
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $codigoQR = max(0, $mostrar['codigoQR']); ?></td>
                <td><?php echo $mold = max(0, $mostrar['mold']); ?></td>
                <td><?php echo $antPos = max(0, $mostrar['antPos']); ?></td>
                <td><?php echo $uppLow = max(0, $mostrar['uppLow']); ?></td>
                <td><?php echo $mostrar['shade'] ?></td>
                <td><?php echo $caja = max(0, $mostrar['caja']); ?></td>
                <td><?php echo  $juegos = max(0, $mostrar['juegos']); ?></td>
                <td><?php echo $mostrar['Fecha'] ?></td>
                <td><a href="#" class="eliminar-btn" data-id="<?php echo $mostrar['id']; ?>"><i class="fas fa-trash" style="color: red;"></i></a></td>
                 <!--<td><a href="registro-eliminado.php?id=<?php  //echo $mostrar['id']; ?>" data-rg="<?= $mostrar['id'] ?>" id="delRg" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Eliminar</a></td>-->
                 <!--<td><a href="registro-eliminado.php?id=<?php  echo $mostrar['id']; ?>&Crear=Enviar'"  >Eliminar</a></td>-->
            </tr>
            
            <?php
            }
            ?>
            
              </table>
        </div>
    
              <!--<BR CLEAR="all">
                   <br></br>-->
    <br></br>
              
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Obtén todos los elementos con la clase 'eliminar-btn'
    var botonesEliminar = document.querySelectorAll('.eliminar-btn');

    // Itera sobre los elementos y agrega un evento de clic a cada uno
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();

            // Obtiene el valor del atributo 'data-id'
            var id = boton.getAttribute('data-id');

            // Confirma si el usuario realmente desea eliminar antes de enviar la solicitud
            var confirmacion = confirm('¿Estás seguro de que quieres eliminar este registro?');

            if (confirmacion) {
                // Envía una solicitud al script 'eliminar_rotulo.php' con el parámetro 'id'
                window.location.href = 'registro-eliminado.php?id=' + id;
            }
        });
    });
});
</script>

    
    </center>
    
    
   
   
        
        <?php
                }
        
        function presentar_formulario_segun_metodo($metodo,$caja,$pedido, $cajaMayor){
            $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
                
        //////////////////////////////////////////////////////////////////////////////////////////////
        
         //si la selección fue ingreso uno a uno 
         
            if ($metodo=="1"){
                
             
    presentar_tabla_segun_caja($caja, $pedido, $metodo);
    
            ?>
            <h2 style="color: white">Ingreso uno a uno </h2>
        
       
         <br>

   
        <div class="row">
        <div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="creaLista2.php" method="get" name="ingresoLista">
                <div class="mb-3 text-center">
                    <label for="lote" class="form-label" style="color: white">Codigo de lote</label>
                    <input type="text" class="form-control" autofocus id="lote" name="lote" placeholder="Digita numero de lote">
                </div>
                <div class="mb-3 text-center">
                    <label for="codigoQR" class="form-label" style="color: white">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" placeholder="Digita código QR">
                    <input name="cajas" type="hidden" value="null">
                    <input name="pedido" type="hidden" value="<?php echo $pedido; ?>">
                    <input name="caja" type="hidden" value="<?php echo $caja; ?>">
                    <input name="metodo" type="hidden" value="<?php echo $metodo; ?>">
                </div>
                <div class="text-center">
                    <input type="submit" name="Crear" class="btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

            
     




            
        </div>
        
    </div>
    
    <br>    

    
        
        <?php
            }
            
            ////////////////////////////////////////////////////////////////////////////////////////////7
            //si la selección fue ingreso grupal
            
            else if($metodo=="2"){
                presentar_tabla_segun_caja($caja, $pedido, $metodo);
            ?>
                <h2>Ingreso grupal</h2>
               
         <br>

   
        <div class="row">
            <form action="creaLista2.php" method="get" name="ingresoLista">

                <div class="mb-3">
                    <label for="lote" class="form-label">Codigo de lote</label>
                    <input type="text" class="form-control"  id="lote" name="lote" autofocus placeholder="Digita numero de lote">
                    </div>
 <br>

    
                
 <div class="mb-3">
                    <label for="cajas" class="form-label">Número de cajas</label>
                    <input type="text" class="form-control" id="cajas" name="cajas"  placeholder="Digita cantidad cajas">
                </div>
 <br>

  
                <div class="mb-3">
                    <label for="codigoQR" class="form-label">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" placeholder="Digita numero de lote">
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                    
                </div>        
                <br>

   
                
                <input type="submit" name="Crear" >
            </form>
        </div>
        
    </div>
    
    <br>    

        
        



 <?php
            }
            
            
            //////////////////////////////////////////////////////////////////////////////////////////////7
            
                        //si la selección fue ingreso manual
            
            else if($metodo=="3"){
                presentar_tabla_segun_caja($caja, $pedido, $metodo);
            ?>
                <h2>Ingreso Manual</h2>
                
         <br>

   
        <div class="row">
            <form action="creaListaManual.php" method="get" name="ingresoLista">

                <div class="mb-3">
                    <label for="ref" class="form-label">Seleccionar referencia</label>
                    <select class="form-select" id="ref" name="ref" aria-label="Default select example">
                        <option selected>Selecciona una referencia</option>
                    <?php
                        $sql1="SELECT * from referencias2 ORDER BY id ASC";
                        $result=mysqli_query($conexion,$sql1);
                        
                        while($mostrar=mysqli_fetch_array($result)){
                    ?>
                    <?php
                        echo '<option value="'.$mostrar["id"].'">'.$mostrar["nombre"].'</option>';
                    ?>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                 <br>
                 <!--
                <div class="mb-3">
                    <label for="antPos" class="form-label">Seleccionar ANT/POS</label>
                    <select class="form-select" id="antPos" name="antPos" aria-label="Default select example">
                        <option value="">Selecciona</option>
                        <option value="ANT">ANT</option>
                        <option value="POS">POS</option>
                    </select>
                </div>
                 <br>
                
                <div class="mb-3">
                    <label for="supInf" class="form-label">Seleccionar SUP/INF</label>
                    <select class="form-select" id="supInf" name="supInf" aria-label="Default select example">
                        <option value="">Selecciona</option>
                        <option value="SUP">SUP</option>
                        <option value="INF">INF</option>
                    </select>
                </div>
                 <br>
                -->
                <div class="mb-3">
                    <label for="color" class="form-label">Seleccionar color</label>
                    <select class="form-select" id="color" name="color" aria-label="Default select example">
                        <option selected>Selecciona un color</option>
                    <?php
                        $sql1="SELECT * from colores2 ORDER BY id ASC";
                        $result=mysqli_query($conexion,$sql1);
                        
                        while($mostrar=mysqli_fetch_array($result)){
                    ?>
                    <?php
                        echo '<option value="'.$mostrar["id"].'">'.$mostrar["nombre"].'</option>';
                    ?>
                    <?php
                        }
                    ?>
                    </select>
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                    
                </div>
                 <br>
                <div class="mb-3">
                    <label for="lote" class="form-label">Codigo de lote</label>
                    <input type="text" class="form-control" autofocus id="lote" name="lote" placeholder="Digita numero de lote">
                    </div>
 <br>
 <!--
                <div class="mb-3">
                    <label for="juegos" class="form-label">Seleccionar número de juegos</label>
                    <select class="form-select" id="juegos" name="juegos" aria-label="Default select example">
                        <option value="">Selecciona</option>
                        <option value="6">6</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="14">14</option>
                        <option value="16">16</option>
                        <option value="20">20</option>
                    </select>
                    
                </div>
                
                
                 <br>
                <div class="mb-3">
                    <label for="cajas" class="form-label">Número de cajas</label>
                    <input type="text" class="form-control" id="cajas" name="cajas" placeholder="Digita cantidad cajas">
                </div>

                <br>

   -->
   <div class="mb-3">
                    <label for="juegos" class="form-label">Número de juegos</label>
                    <input type="text" class="form-control" id="juegos" name="juegos" placeholder="Digita cantidad de juegos">
                </div>

                <br>
   
                
                <input type="submit" name="Crear" >
            </form>
        </div>
        
    </div>
    
    <br>    

        
        



 <?php
            }
            
            ////////////////////////////////////////////////////////////////////////////////////////////
            
 //si la selección fue ingreso StarPlus
 
            if ($metodo=="4"){
                
            presentar_tabla_segun_caja($caja, $pedido, $metodo);
            ?>
            <h2>Ingreso StarPlus </h2>
        
        
         <br>

   
        <div class="row">
            <form action="creaListaStarPlus.php" method="get" name="ingresoLista">

                <div class="mb-3">
                    <label for="lote" class="form-label">Codigo de lote</label>
                    <input type="text" class="form-control" autofocus id="lote" name="lote" placeholder="Digita numero de lote">
                    </div>
 <br>
 <!--<div class="mb-3">
                    <label for="juegos" class="form-label">Seleccionar número de juegos</label>
                    <select class="form-select" id="juegos" name="juegos" aria-label="Default select example">
                        <option value="">Selecciona</option>
                        <option value="6">6</option>
                        <option value="12">12</option>
                        
                    </select>
                    </div>
                    <br> -->
                    
<div class="mb-3">
                    <label for="juegos" class="form-label">Número de juegos</label>
                    <input type="text" class="form-control" id="juegos" name="juegos" placeholder="Digita numero de Juegos">
                    </div>
 <br>

                <div class="mb-3">
                    <label for="codigoQR" class="form-label">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" placeholder="Digita código QR">
                    <input name="cajas" type="hidden" value="null">
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;  
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                    
                </div>        
                <br>

   
                

                <input type="submit" name="Crear" >
                
            </form>

            
        </div>
        
    </div>
    
    <br>
    
    

     <?php
            
    //presentar_tabla_segun_caja($caja, $pedido);
   
            }
            
            //si la selección fue ingreso uno a uno 
         
            if ($metodo=="5"){
                
             
    //presentar_tabla_segun_caja($caja, $pedido, $metodo);
    ?>
       <div class="container mt-5">
        <h1>Ingreso a Almacén</h1>
        <h2>Pedido:
        <?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");       $sql2= "SELECT codigoP from pedidos2 WHERE idP ='". $pedido. "'";
        $result2=mysqli_query($conexion,$sql2);
                while($mostrar2=mysqli_fetch_array($result2)){
            ?>
                
                <td><?php echo $codigoP=max(0,$mostrar2['codigoP']) ."        ";
                $codigoPedido=$mostrar2['codigoP'];?>
                
                </td>
                </h2>
                
            
            <?php
            }
            ?>
    
        
            <h2>Ingreso inventario uno a uno </h2>
        
       
         <br>

   
        <div class="row">
            <form action="creaLista2.php" method="get" name="ingresoLista">



                <div class="mb-3">
                    <label for="codigoQR" class="form-label">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" autofocus placeholder="Digita código QR">
                    <input name="cajas" type="hidden" value="null">
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;  
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                   
                </div>        
                <br>

   
                

                <input type="submit" name="Crear" >
                
            </form>
            
     




            
        </div>
        
    </div>
    
    <br>    

    
        
        <?php
            }
            
            //*****************fin del método 5
            
            else if($metodo=="6"){
                //presentar_tabla_segun_caja($caja, $pedido, $metodo);
                   ?>
                   <div class="container mt-5">
        <h1>Ingreso a Almacén</h1>
        <h2>Pedido:
        <?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");       $sql2= "SELECT codigoP from pedidos2 WHERE idP ='". $pedido. "'";
        $result2=mysqli_query($conexion,$sql2);
                while($mostrar2=mysqli_fetch_array($result2)){
            ?>
                
                <td><?php echo $codigoP=max(0,$mostrar2['codigoP']) ."        ";
                $codigoPedido=$mostrar2['codigoP'];
                
                ?></td>
                </h2>
                
            
            <?php
            }
            ?>
            
                <h2>Ingreso grupal</h2>
               
         <br>

   
        <div class="row">
            <form action="creaLista2.php" method="get" name="ingresoLista">

       

    
                
 <div class="mb-3">
                    <label for="cajas" class="form-label">Número de cajas</label>
                    <input type="text" class="form-control" id="cajas" name="cajas" autofocus placeholder="Digita cantidad cajas">
                </div>
 <br>

  
                <div class="mb-3">
                    <label for="codigoQR" class="form-label">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" placeholder="Digita numero de lote">
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                    
                </div>        
                <br>

   
                
                <input type="submit" name="Crear" >
            </form>
        </div>
        
    </div>
    
    <br>    

        
        



 <?php
            }
            
            
            
            //fin del método 6 ///////////////////************************************************************
            
             if ($metodo=="7"){
                
             
    //presentar_tabla_segun_caja($caja, $pedido, $metodo);
    ?>
       <div class="container mt-5">
        <h1>Asignación</h1>
        <h2>Pedido:
        <?php
       $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
       $sql2= "SELECT codigoP from pedidos2 WHERE idP ='". $pedido. "'";
        $result2=mysqli_query($conexion,$sql2);
                while($mostrar2=mysqli_fetch_array($result2)){
            ?>
                
                <td><?php echo $codigoP=max(0,$mostrar2['codigoP']) ."        ";
                $codigoPedido=$mostrar2['codigoP'];?>
                
                </td>
                </h2>
                
            
            <?php
            }
            ?>
    
        
            <h2>Asignación uno a uno </h2>
        
       
         <br>

   
        <div class="row">
            <form action="creaLista2.php" method="get" name="ingresoLista">



                <div class="mb-3">
                    <label for="codigoQR" class="form-label">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" autofocus placeholder="Digita código QR">
                    <input name="cajas" type="hidden" value="null">
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;  
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                   
                </div>        
                <br>

   
                

                <input type="submit" name="Crear" >
                
            </form>
            
     




            
        </div>
        
    </div>
    
    <br>    

    
        
        <?php
            }
            
            ///*******************Fin del método 7
            
             else if($metodo=="8"){
                //presentar_tabla_segun_caja($caja, $pedido, $metodo);
                   ?>
                   <div class="container mt-5">
        <h1>Asignación</h1>
        <h2>Pedido:
        <?php
        $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
       $sql2= "SELECT codigoP from pedidos2 WHERE idP ='". $pedido. "'";
        $result2=mysqli_query($conexion,$sql2);
                while($mostrar2=mysqli_fetch_array($result2)){
            ?>
                
                <td><?php echo $codigoP=max(0,$mostrar2['codigoP']) ."        ";
                $codigoPedido=$mostrar2['codigoP'];
                
                ?></td>
                </h2>
                
            
            <?php
            }
            ?>
            
                <h2>Ingreso grupal</h2>
               
         <br>

   
        <div class="row">
            <form action="creaLista2.php" method="get" name="ingresoLista">

       

    
                
 <div class="mb-3">
                    <label for="cajas" class="form-label">Número de cajas</label>
                    <input type="text" class="form-control" id="cajas" name="cajas" autofocus placeholder="Digita cantidad cajas">
                </div>
 <br>

  
                <div class="mb-3">
                    <label for="codigoQR" class="form-label">Código QR</label>
                    <input type="text" class="form-control" id="codigoQR" name="codigoQR" placeholder="Digita numero de lote">
                    <input name="pedido" type="hidden" value=" <?php
                        echo $pedido;
                    ?>">
                    <input name="caja" type="hidden" value=" <?php
                        echo $caja; 
                    ?>">
                    <input name="metodo" type="hidden" value=" <?php
                        echo $metodo; 
                    ?>">
                    
                </div>        
                <br>

   
                
                <input type="submit" name="Crear" >
            </form>
        </div>
        
    </div>
    
    <br>    

        
        



 <?php
            }
            
            //**************fin del método 8
        }
            
            function presentar_tabla_segun_caja($numCaja, $numPedido, $metodo){
                $conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
                ?>
                 <center>
                 

<html lang="en">


    <div class="container mt-5">
        <h1>Lista de Empaque</h1>
        <h2>Pedido:
        <?php
       $sql2= "SELECT codigoP from pedidos2 WHERE idP ='". $numPedido. "'";
        $result2=mysqli_query($conexion,$sql2);
                while($mostrar2=mysqli_fetch_array($result2)){
            ?>
                
                <td><?php echo $codigoP=max(0,$mostrar2['codigoP']) ."        ";
                $codigoPedido=$mostrar2['codigoP'];
                
                ?></td>
                </h2>
                
            
            <?php
            }
            ?>
            
            
            <?php
            
            //presento el nombre del cliente

        $sql3= "SELECT pedidos2.`idCliente`, clientes2.`nombreCliente` AS cliente from pedidos2 INNER JOIN clientes2 ON pedidos2.`idCliente` = clientes2.`id` WHERE pedidos2.`idP` ='". $numPedido. "'";
        $result3=mysqli_query($conexion,$sql3);

            ?>



        <h2>Cliente: 

        
                 <?php

                while($mostrar3=mysqli_fetch_array($result3)){
                    $nombreCliente=$mostrar3['cliente'];
            ?>

            
                
                <td><?php //echo $mostrar3['cliente'] 
                echo $nombreCliente;
                ?></td>
                
                
                
            
            <?php
            }
            ?>
            </h2>
           
        <h2>
        
        Box# 
                
                <td><?php echo $numCaja ?></td>
            
           </h2>
           <!--
           <div class="row">
            <form action="formularioListas_digitaLote.php" method="POST">
            
            <div class="mb-3">
                   
                    
                    <label for="uppLow" class="form-label">Cajas</label>
                    <select class="form-select" autofocus id="tipo" name="tipo" aria-label="Default select example">
                        <option selected></option>
                        <?php
                        //for ($i=1;$i=$cajaMayor;$i++){
                        ?>
                        <option value="<?php //echo $i ?>"><?php //echo $i ?></option>
                        
                        <?php
                        
                        //}
                        ?>
                   
                
                <input type="submit" name="Empacar" >
            </form>
        </div>
        
    </div>-->
    
    <br>
           
           <?php
           //a continuación consulto el total de juegos empacados por caja.
           
           $sqlC="SELECT SUM(juegos) AS total, SUM(cajasEmpacadas) AS cajas FROM listaEmpaque WHERE caja ='". $numCaja. "' AND pedidoId = '". $numPedido. "'";
            $resultC=mysqli_query($conexion,$sqlC);
            
            while($mostrarC=mysqli_fetch_array($resultC)){
            $juegosCaja=$mostrarC['total'];
            $cajas=$mostrarC['cajas'];
            }
            //luego presento el calculo de las cajas de producto empacadas en este box
            
            if ($metodo=="4"){
                $cajasBox=$juegosCaja/12;
                ?>
                <h2>
        
        Cajas this box: 
                
                <td><?php echo $cajasBox ?></td>
            
           </h2>
           <?php
            }
            else{
                
            }
            
           ?>
           
           
        
        
                <table border="1" class="gray-table">
            <tr>
                <!--<td>id</td>-->
                <td>MOLD</td>
                <td>ANT/POS</td>
                <td>UPP/LOW</td>
                <td>SHADE</td>
                <td>LOTE</td>
                <td>TOTAL</td>
                
                
            </tr>
            
            <?php
            $sql="select * , COUNT(id), sum(juegos) as total FROM listaEmpaque WHERE caja ='". $numCaja. "'"." AND pedidoId = '". $numPedido. "'"." GROUP BY mold, shade, lote, uppLow ORDER BY mold;";
            $result=mysqli_query($conexion,$sql);
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <!--<td><?php echo $mostrar['id'] ?></td>-->
                <td><?php echo $mold = max(0, $mostrar['mold']); ?></td>
                <td><?php echo $antPos = max(0, $mostrar['antPos']); ?></td>
                <td><?php echo $uppLow = max(0, $mostrar['uppLow']); ?></td>
                <td><?php echo $mostrar['shade'] ?></td>
                <td><?php echo $lote = max(0, $mostrar['lote']); ?></td>
                <td><?php echo $total = max(0, $mostrar['total']); ?></td>
                
                
            </tr>
            <?php
            }
                
            
             //a continuación consulto el total de juegos empacados de todo el pedido
           
           $sqlE="SELECT SUM(juegos) AS total FROM listaEmpaque WHERE pedidoId = '". $numPedido. "'";
            $resultE=mysqli_query($conexion,$sqlE);
            
            while($mostrarE=mysqli_fetch_array($resultE)){
            $juegosTotEmpacados=max(0,$mostrarE['total']);
            }
            
            //a continuación consulto el total de juegos del pedido
           
           $sqlP="SELECT juegosTotales AS total FROM pedidos2 WHERE idP ='". $numPedido. "'";
            $resultP=mysqli_query($conexion,$sqlP);
            

            $juegosPedido = ''; // Asigna un valor predeterminado o define $juegosPedido como corresponda

            while($mostrarP=mysqli_fetch_array($resultP)){
            $juegosPedido=max(0,$mostrarP['total']);
            }
            //calculo los juegos que faltan por empacar de este pedido.
            


            if (isset($juegosPedido) && isset($juegosTotEmpacados)) {
                $juegosFaltan = $juegosPedido - $juegosTotEmpacados;
            }
            //actualizo el estado del pedido si los juegos empacados >=  a los pedidos. 
            
            if ($juegosTotEmpacados >= $juegosPedido){
                $sqlEstadoPedido="UPDATE pedidos2 SET estado= 'terminado' WHERE idP ='".$numPedido ."'";
                $resultEstadoPedido=mysqli_query($conexion,$sqlEstadoPedido);
            }
            else{
                
            }
            
           
            ?>
        </table>
        
        <br></br>
        <table border="1" class="gray-table">
    <tr>
        <td>juegos/Box</td>
        <td>cajas/Box</td>
        <td>Van</td>
        <td>Pedido</td>
        <td>Faltan</td>
    </tr>

    <tr>
        <td><?php echo max(0, $juegosCaja) ?></td>
        <td><?php echo max(0, $cajas) ?></td>
        <td><?php echo max(0, $juegosTotEmpacados) ?></td>
        <td><?php echo isset($juegosPedido) ? max(0, $juegosPedido) : '' ?></td>
        <td><?php echo isset($juegosFaltan) ? max(0, $juegosFaltan) : '' ?></td>
    </tr>
</table>

        </center>
        
   <br>
</div>
</body>
</html>
        <?php
            }
            ?>
            