<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
    
    $moldesPrensada=null;

    //obtengo los datos del formulario anterior
    
    $ano= isset($_POST ["Ano"]) ? $_POST["Ano"]: null;
    $mes= isset($_POST ["Mes"]) ? $_POST["Mes"]: null;
    $dia= isset($_POST ["Dia"]) ? $_POST["Dia"]: null;
    
   
    

 

    if (is_null($ano)){
        
       $fecha= isset($_POST["fecha"]) ? $_POST["fecha"]: null;

       
        if(is_null($fecha)){
            //echo "la fecha post es nula";
        $fecha=$_GET ["fecha"];
        //echo $fecha;
        $turno=$_GET ["turno"];
        //echo $turno;
        $prensada=$_GET ["prensada"];
        //echo $prensada;
        
        //limito el tamaño de los datos

$fecha = substr($fecha, (int) -12);
$turno = substr($turno, (int) -10);
$prensada = substr($prensada, (int) -2);
        
        //elimino los espacios en blanco del string turno.
        
        $turno=trim($turno," ");
        //echo "fecha sin espacios en blanco".$fecha;
       
    }
    }
    else{
    //$fecha=$dia."/".$mes."/".$ano;
    $ano=$ano+2000;
    $fecha=$ano."-".$mes."-".$dia;
    $turno=$_POST ["turno"];
    $prensada=$_POST ["prensada"];
   
    }
    //$turno=$_POST ["turno"];
    //$prensada=$_POST ["prensada"];
    

/*var_dump($fecha);
var_dump($turno);
var_dump($prensada);*/

//limito el tamaño de los datos

$fecha = substr($fecha, -12);
$turno = substr($turno, -10);
$prensada = substr($prensada, -2);


//elimino los espacios en blanco del string

$turno=trim($turno," ");

//echo "después de limitar los datos";

/*var_dump($fecha);
var_dump($turno);
var_dump($prensada);*/

  //a continuación consulto el total de moldes de la prensada actual.
           
           $sqlC="SELECT SUM(cantidadMoldes) AS total FROM rotulos2 WHERE rotulos2.`fecha` = '".$fecha."' AND rotulos2.`turno` LIKE '%".$turno."%' AND rotulos2.`prensada` = '".$prensada."' ";
            $resultC=mysqli_query($conexion,$sqlC);
            
            while($mostrarC=mysqli_fetch_array($resultC)){
            $moldesPrensada=$mostrarC['total'];
            }







?>

<!DOCTYPE html>
<html lang="en">
    <button class="btn btn-primary" onclick="location.href='../../control'">Inicio</button>
    <button  class="btn btn-primary" onclick="location.href='progProduccion2.php?fecha=<?php echo $fecha?>&turno=<?php echo $turno?>&prensada=<?php echo $prensada?>'">Cambiar Prensada/Turno/Fecha</button>
    <!--<button onclick="location.href='../control/progProduccion/cambiarPrensada.php?turno=<?php //echo $turno?>&fecha=<?php //echo $fecha?>">Cambiar prensada</button>
    	<button onclick="location.href='../control/progProduccion/cambiarTurno.php?prensada=<?php //echo $prensada?>&fecha=<?php //echo $fecha?> ">Cambiar Turno</button>-->
			
<head>
	<meta charset="UTF-8">
	<title>Programación</title>
	
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

        .gray-table {
            background-color: #ccc; /* Color gris de fondo */
        }

       
        
    </style>
</head>
<body>
    <center>

    <?php
        //presento detalles del pedido a empacar
        //1. presento el nombre del pedido
        $turno = trim($turno, " ");

        $sqlC = "SELECT SUM(cantidadMoldes) AS total FROM rotulos2 WHERE rotulos2.`fecha` = '" . $fecha . "' AND rotulos2.`turno` LIKE '%" . $turno . "%' AND rotulos2.`prensada` = '" . $prensada . "' ";
        $resultC = mysqli_query($conexion, $sqlC);


            ?>



       <h2>Programación del día: <?php echo $fecha ?> </h2>
        <h2>Turno:  <?php echo $turno ?></h2>
        
            
            
          
            
            <div class="container mt-5">
        <h1>Programar Prensada</h1>
        <div class="row">
            <form action="progProduccion4.php" method="POST">
            
            <div class="mb-3">
                    <label for="pedido" class="form-label">Seleccionar Pedido</label>
                    <select class="form-select" autofocus id="pedido" name="pedido" aria-label="Default select example">
                        <option selected>Selecciona un pedido</option>
                    <?php
                        $sql1="SELECT * from pedidos2 ORDER BY idP DESC";
                        $result=mysqli_query($conexion,$sql1);
                        
                        while($mostrar=mysqli_fetch_array($result)){
                            
                    ?>
                    <?php
                        echo '<option value="'.$mostrar["idP"].'">'.$mostrar["codigoP"]." / ".$mostrar["nota"].'</option>';
                        
                    ?>


                    <?php

                        }

                    ?>
                    </select>

        </div>
        <br>
        
         <div class="mb-3">
                    <label for="color" class="form-label">Seleccionar Color</label>
                    <select class="form-select" id="color" name="color" aria-label="Default select example">
                        <option selected>Selecciona un color</option>
                    <?php
                        $sql2="SELECT * FROM colores2 ORDER BY id";
                        //$sql2="SELECT lotes2.*, colores2.`nombre` AS 'color' from lotes2 INNER JOIN colores2 ON lotes2.`colorId2` = colores2.`id`  ORDER BY color DESC LIMIT 200";
                        $result=mysqli_query($conexion,$sql2);
                        
                        while($mostrar=mysqli_fetch_array($result)){
                            
                    ?>
                    <?php
                        //echo '<option value="'.$mostrar["id"].'">'.$mostrar["nombreL"]. " / ".$mostrar["color"].'</option>';
                        echo '<option value="'.$mostrar["id"].'">'.$mostrar["nombre"].'</option>';
                        
                    ?>


                    <?php

                        }

                    ?>
                    </select>

                      <input name="fecha" type="hidden" value=" <?php
                        echo $fecha;  
                    ?>">
                      <input name="turno" type="hidden" value=" <?php
                        echo $turno; 
                    ?>">
                    <input name="prensada" type="hidden" value=" <?php
                        echo $prensada; 
                    ?>">
                   
                </div>
                <br>
                <input type="submit" name="Crear"  class="btn btn-success">
            </form>
        </div>
        
        <br>    

    <h1>Prensada:  <?php echo $prensada ?> Moldes:  <?php echo$moldesPrensada?> </h1>
    
    <br>

    
        <table class="table table-striped gray-table" >
            <tr>
                <!--<td>id</td>-->
               
                <td>Fecha</td>
                <td>Prensada</td>
                <td>Pedido</td>
                <td>Referencia</td>
                <td>Color</td>
                <td>#MoldesDisponibles</td>
                <td>Juegos/Molde</td>
                <td>Tipo</td>
                <td>2C/4C</td>
                <td>#MoldesProgramados</td>
                <td>Turno</td>
                <td>CantidadProgramada</td>
                <td>Material(g)</td>
                <td>lote</td>
                <td>nota</td>
                <td>acción</td>
                <td>acción</td>
                
                
            </tr>
            
            <?php
            $sql="SELECT rotulos2.*,referencias2.`nombre` AS 'referencia', referencias2.`totalMoldes` AS 'totalMoldes', referencias2.`juegos` AS 'juegosR', referencias2.`tipo` AS 'tipo', referencias2.`capas` AS 'capas', colores2.`nombre` AS 'Color', pedidos2.`codigoP` AS Pedido, lotes2.`nombreL` AS Lote, estaciones2.`nombre` AS 'estacionActual' FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN colores2 ON rotulos2.`colorId` = colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido` = pedidos2.`idP` INNER JOIN lotes2  ON  rotulos2.`loteId`= lotes2.`id` INNER JOIN estaciones2 ON rotulos2.`estacionId2` = estaciones2.`id`   WHERE rotulos2.`fecha` = '".$fecha."' AND rotulos2.`turno` LIKE '%".$turno."%' AND rotulos2.`prensada` = '".$prensada."'  ORDER BY rotulos2.`id` ASC";
            
            $result=mysqli_query($conexion,$sql);
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <!--<td><?php //echo $mostrar['id'] ?></td>-->
                
                
                
                <td><?php echo $mostrar['fecha'] ?></td>
                <td><?php echo $mostrar['prensada'] ?></td>
                <td><?php echo $mostrar['Pedido'] ?></td>
                <td><?php echo $mostrar['referencia'] ?></td>
                <td><?php echo $mostrar['Color'] ?></td>
                <td><?php echo $mostrar["totalMoldes"] ?></td>
                <td><?php echo $mostrar["juegosR"] ?></td>
                <td><?php echo $mostrar["tipo"] ?></td>
                <td><?php echo $mostrar["capas"] ?></td>
                <td><?php echo $mostrar['cantidadMoldes'] ?></td>
                <td><?php echo $turno ?></td>
                <td><?php echo $mostrar['total'] ?></td>
                <td></td>
                <td><?php echo $mostrar['Lote'] ?></td>
                <td><?php echo $mostrar['nota'] ?></td>
                <td><a href="editar_rotulo.php?id=<?php echo $mostrar['id'] ?>&turno=<?php echo $turno?>&prensada=<?php echo $prensada?>&fecha=<?php echo $fecha?> "><i class="fas fa-edit" style="color: blue;"></i></a></td>
                <!-- <td><a href="#" data-href="eliminar_rotulo.php?id=<?php echo $mostrar['id']; ?>" data-rg="<?= $mostrar['id'] ?>" id="delRg" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Eliminar</a></td> -->
                <td><a href="#" class="eliminar-btn" data-id="<?php echo $mostrar['id']; ?>"><i class="fas fa-trash" style="color: red;"></i></a></td>
            </tr>
             

            </tr>
            <?php
            }
            ?>
        </table>
        
        <!-- <script type="text/javascript">
        $(document).on("click", "#delRg", function(event) {
            event.preventDefault();

            let ifRegistro = $(this).attr('data-rg');

            $.ajax({
                url: "../control/eliminar_rotulo.php",
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
    </script> -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Obtén todos los elementos con la clase 'eliminar-btn'
    var botonesEliminar = document.querySelectorAll('.eliminar-btn');

    // Itera sobre los elementos y agrega un evento de clic a cada uno
    botonesEliminar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();

            // Obtiene el valor del atributo 'data-id'
            var idRotulo = boton.getAttribute('data-id');

            // Confirma si el usuario realmente desea eliminar antes de enviar la solicitud
            var confirmacion = confirm('¿Estás seguro de que quieres eliminar este registro?');

            if (confirmacion) {
                // Envía una solicitud al script 'eliminar_rotulo.php' con el parámetro 'id'
                window.location.href = '../vistas/modulos/eliminar_rotulo.php?id=' + idRotulo;
            }
        });
    });
});
</script>

    
    <!--
    <div class="row">
            <form action="datosParaDuplicar.php" method="GET" name="duplicar">

                <div class="mb-3">

                    
                    <input name="fecha" type="hidden" value=" <?php
                        echo $fecha;  
                    ?>">
                      <input name="turno" type="hidden" value=" <?php
                        echo $turno; 
                    ?>">
                    <input name="prensada" type="hidden" value=" <?php
                        echo $prensada; 
                    ?>">
                </div>        
                <br>

   
                

                <button onClick='submitForm()'>Duplicar Prensada</button>
                <br>
            </form>
            
            <script>
    function submitForm() {
        document.getElementById('duplicar').submit();
    }
</script>
        
        
    </div>
    -->
    
    <div class="row">
            <form action="formularioImprimirProg.php" method="GET" name="imprimir">

                <div class="mb-3">

                    
                    <input name="fecha" type="hidden" value=" <?php
                        echo $fecha;  
                    ?>">
                      <input name="turno" type="hidden" value=" <?php
                        echo $turno; 
                    ?>">
                    
                </div>        
                <br>

   
                

                <button class="btn btn-primary" onClick='submitForm()'>Imprimir hoja de producción y etiquetas</button>
                <br><br>
            </form>
            
            <script>
    function submitForm() {
        document.getElementById('imprimir').submit();
    }
</script>
        <br></br>
    

    <br>
    
    <h1>Todas las prensadas del turno</h1>
    <table class="table table-striped gray-table">
            <tr>
                <!--<td>id</td>-->
               
                <td>Fecha</td>
                <td>Prensada</td>
                <td>Pedido</td>
                <td>Referencia</td>
                <td>Color</td>
                <td>#MoldesDisponibles</td>
                <td>Juegos/Molde</td>
                <td>Tipo</td>
                <td>2C/4C</td>
                <td>#MoldesProgramados</td>
                <td>Turno</td>
                <td>CantidadProgramada</td>
                <td>Material(g)</td>
                <td>lote</td>
                <td>nota</td>
                <td>acción</td>
                <td>acción</td>
                
                
            </tr>
            
            <?php
            $sql="SELECT rotulos2.*,referencias2.`nombre` AS 'referencia', referencias2.`totalMoldes` AS 'totalMoldes', referencias2.`juegos` AS 'juegosR', referencias2.`tipo` AS 'tipo', referencias2.`capas` AS 'capas', colores2.`nombre` AS 'Color', pedidos2.`codigoP` AS Pedido, lotes2.`nombreL` AS Lote, estaciones2.`nombre` AS 'estacionActual' FROM rotulos2 INNER JOIN referencias2 ON rotulos2.`referenciaId`= referencias2.`id` INNER JOIN colores2 ON rotulos2.`colorId` = colores2.`id` INNER JOIN pedidos2 ON rotulos2.`pedido` = pedidos2.`idP` INNER JOIN lotes2  ON  rotulos2.`loteId`= lotes2.`id` INNER JOIN estaciones2 ON rotulos2.`estacionId2` = estaciones2.`id`   WHERE rotulos2.`fecha` = '".$fecha."' AND rotulos2.`turno` LIKE '%".$turno."%' ORDER BY rotulos2.`id` ASC";
            
            $result=mysqli_query($conexion,$sql);
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <!--<td><?php //echo $mostrar['id'] ?></td>-->
                
                
                
                <td><?php echo $mostrar['fecha'] ?></td>
                <td><?php echo $mostrar['prensada'] ?></td>
                <td><?php echo $mostrar['Pedido'] ?></td>
                <td><?php echo $mostrar['referencia'] ?></td>
                <td><?php echo $mostrar['Color'] ?></td>
                <td><?php echo $mostrar["totalMoldes"] ?></td>
                <td><?php echo $mostrar["juegosR"] ?></td>
                <td><?php echo $mostrar["tipo"] ?></td>
                <td><?php echo $mostrar["capas"] ?></td>
                <td><?php echo $mostrar['cantidadMoldes'] ?></td>
                <td><?php echo $turno ?></td>
                <td><?php echo $mostrar['total'] ?></td>
                <td></td>
                <td><?php echo $mostrar['Lote'] ?></td>
                <td><?php echo $mostrar['nota'] ?></td>
                <td><a href="editar_rotulo.php?id=<?php echo $mostrar['id'] ?>&turno=<?php echo $turno?>&prensada=<?php echo $prensada?>&fecha=<?php echo $fecha?> "><i class="fas fa-edit" style="color: blue;"></i></a></td>

                <!-- <td><a href="#" data-href="eliminar_rotulo.php?id=<?php echo $mostrar['id']; ?>" data-rg="<?= $mostrar['id'] ?>" id="delRg" data-toggle="modal" class="btn btn-danger" data-target="#confirm-delete">Eliminar</a></td> -->
                <td><a href="#" class="eliminar-btn" data-id="<?php echo $mostrar['id']; ?>"><i class="fas fa-trash" style="color: red;"></i></a></td>
            </tr>
            <?php
            }
            ?>
        </table>
     <br></br>
    
    </center>
    

<!-- ELIMINAR REGISTRO -->
    <?php

if (!$conexion) {
    die("La conexión falló: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id_rotulo = $_GET['id'];

    // Realizar la consulta para eliminar el registro
    $sql = "DELETE FROM rotulos2 WHERE id = $id_rotulo";

    if (mysqli_query($conexion, $sql)) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    echo "No se proporcionó un ID válido para eliminar.";
}

mysqli_close($conexion);
?>
    </div>
</body>
</html>