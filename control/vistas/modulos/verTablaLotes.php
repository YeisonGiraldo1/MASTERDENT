<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
  
$color = isset( $_POST['color'] ) ? $_POST['color'] : '';
$lote = isset( $_POST['lote'] ) ? $_POST['lote'] : '';

$filtros = array();

 if ($color != ''){
            $filtros[]= "colores2.`nombre` LIKE '%$color%'";
    }
    if ($lote != ''){
            $filtros[]= "nombreL = '$lote'";
    }
    
     
    if (empty($filtros)) {
        $filtros[] = "1";
    }


 $consultaFiltros='SELECT lotes2.* , colores2.`nombre` AS color FROM lotes2 INNER JOIN colores2 ON lotes2.`colorId2`= colores2.`id` WHERE ';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lotes</title>
    
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
    




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lotes</title>
</head>
<body>
    
    <button onclick="location.href='../../'">Inicio</button>

<center>
    <h1>Lotes</h1>
    
    <br>
    
    <div class="row">
            <form action="verTablaLotes.php" method="POST">
            
          
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control "  id="color" name="color" size="10">
                    
                    <label for="lote" class="form-label">Lote</label>
                    <input type="text" class="form-control "  id="lote" name="lote" size="10">
                    
                   

                
                <input type="submit" name="Empacar" >
            </form>
        </div>
        
    </div>
                    <br>

    
        <table border="1">
            <tr>
                <td>id</td>
                <td>Número</td>
                <td>color</td>
                <td>fechaCreacion</td>
                <!--<td>fechaActualizacion</td>
                <td>estado</td>-->
                <td>Acción</td>
                <td>Acción</td>
                
            </tr>
            
            <?php
            
            if ($color != ''){
            echo "-COLOR = $color";
    }
    if ($lote != ''){
            echo "-LOTE = '$lote'";
    }
    
            $sql= $consultaFiltros." ".implode(" AND ",$filtros) ." ORDER BY id DESC ";
            //echo $sql;
            $result=mysqli_query($conexion,$sql); 
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['nombreL'] ?></td>
                <td><?php echo $mostrar['color'] ?></td>
                <td><?php echo $mostrar['fechaCreacion'] ?></td>
                <!--<td><?php //echo $mostrar['fechaActualizacion'] ?></td>
                <td><?php //echo $mostrar['estado'] ?></td>-->
 <td><a href="eliminar_lotes.php?id=<?php echo $mostrar['id'];?>">Eliminar</a></td>
 <td><a href="editar_lotes.php?id=<?php echo $mostrar['id'];?>">Editar</a></td>            
</tr>
<?php
}
?>
</table>

<script type="text/javascript">
$(document).on("click", "#delRg", function(event) {
event.preventDefault();

let ifRegistro = $(this).attr('data-rg');

$.ajax({
    url: "../control/eliminar_Lotes.php",
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

 </table>
 
 <br></br>
 </center>
</body>
</html>

          
       
