
<?php
  
session_start();
  if(!isset ($_SESSION['Cedula']) or !isset($_SESSION['Contrasena'])){ 
    $cedula=1993;
  $contrasena=2050;
    echo "<script>
    alert('Zona  no autorizada,por favor inicia la seccion');
    window.location='../index.php';
  
  
    
  </script>";
  
   
  }
  
  else{
    
    
    $cedula=$_SESSION['Cedula'];
    $contrasena=$_SESSION['Contrasena']; 
   $rol=$_SESSION['Rol'];
  





   $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
  
   
    
  
  }
  
  if($rol==1 OR $rol==3 ){
      
      $referencia = isset( $_POST['referencia'] ) ? $_POST['referencia'] : '';
    $antPos = isset( $_POST['antPos'] ) ? $_POST['antPos'] : '';
    $uppLow = isset( $_POST['uppLow'] ) ? $_POST['uppLow'] : '';
    $color = isset( $_POST['color'] ) ? $_POST['color'] : '';
    $lote = isset( $_POST['lote'] ) ? $_POST['lote'] : '';
    $caja = isset( $_POST['caja'] ) ? $_POST['caja'] : '';
    $pedido = isset( $_POST['pedido'] ) ? $_POST['pedido'] : '';
    
    
    $filtros = array();
   if ($pedido != ''){
            $filtros[]= "pedido = '$pedido'";
    }
    if ($referencia != ''){
            $filtros[]= "mold = '$referencia'";
    }
    if ($antPos != ''){
            $filtros[]= "antPos = '$antPos'";
    }
    if ($uppLow != ''){
            $filtros[]= "uppLow = '$uppLow'";
    }
    if ($color != ''){
            $filtros[]= "shade LIKE '%$color%'";
    }
    if ($lote != ''){
            $filtros[]= "lote = '$lote'";
    }
    if ($caja != ''){
            $filtros[]= "caja = '$caja'";
    }
    
    if (empty($filtros)) {
        $filtros[] = "1";
    } else {
        if (is_null($filtros[0])) {
            $filtros[0] = "1";
        }
    }
    
    $consultaFiltros='select listaEmpaque.*, pedidos2.`codigoP` AS pedido, clientes2.nombreCliente AS cliente FROM listaEmpaque INNER JOIN pedidos2 ON listaEmpaque.`pedidoId` = pedidos2.`idP` INNER JOIN clientes2 ON pedidos2.idCliente = clientes2.id WHERE ';
    
    
    
  
  ?>
 










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ListaGlobal</title>
    
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

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    
</head>
<body>
    
    <div class="container">
    <button class="btn btn-primary" onclick="location.href='../../../control'">Inicio</button>
    
    <center>
        
        

    <h2>Lista de empaque global</h2>
    
    
      
            <form action="verTablaListasGeneral.php" method="POST">
            
            <div class="row">


            <div class="col-md-4">
                    <label for="referencia" class="form-label">Referencia</label>
                    <input type="text" class="form-control "  id="referencia" name="referencia" size="10">
                    </div>
        
                    

                    <div class="col-md-4">
                <label for="antPos" class="form-label">Ant/Pos</label>
                    <select class="form-select"  id="antPos" name="antPos" aria-label="Default select example">
                        <option selected></option>
                        <option value="ANT">ANT</option>
                        <option value="POS">POS</option>
                    </select>
                    </div>

                        <div class="col-md-4">
                     <label for="uppLow" class="form-label">Sup/Inf</label>
                    <select class="form-select"  id="uppLow" name="uppLow" aria-label="Default select example">
                        <option selected></option>
                        <option value="SUP">SUP</option>
                        <option value="INF">INF</option>
                    </select>
                    </div>
         

                    <div class="row">


                    <div class="col-md-4">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control "  id="color" name="color" size="10">
                    </div>

                    <div class="col-md-4">
                    <label for="lote" class="form-label">Lote</label>
                    <input type="text" class="form-control "  id="lote" name="lote" size="10">
                    </div>
                    <!--<label for="caja" class="form-label">Caja</label>
                    <input type="text" class="form-control "  id="caja" name="caja" size="10">-->
                    

                    <div class="col-md-4">
                   <label for="pedido" class="form-label">Pedido</label>
                    <input type="text" class="form-control "  id="pedido" name="pedido" size="10">
                    <br>
                    </div>
                    </div>
                    

                 
                
                    <div class="row">
<div class="col-md-12"> 
                <input type="submit" name="Empacar" class="btn btn-success">
            </form>
            </div>
                    </div>
       

                    <br>

                    <section class="mt-4">
                    <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                <td>id</td>
                <td>MOLD</td>
                <td>ANT/POS</td>
                <td>UPP/LOW</td>
                <td>SHADE</td>
                <td>LOTE</td>
                <td>JUEGOS</td>
                <td>PEDIDO</td>
                <td>CLIENTE</td>
                <td>FECHA</td>
                <td>ACCIÓN</td>
                
            </tr>
            </thead>

            <tbody>
             <?php
             
             if ($pedido != ''){
            echo "-pedido = '$pedido'";
    }
    if ($referencia != ''){
            echo "-mold = '$referencia'";
    }
    if ($antPos != ''){
            echo "-antPos = '$antPos'";
    }
    if ($uppLow != ''){
            echo "-uppLow = '$uppLow'";
    }
    if ($color != ''){
            echo "-shade = $color";
    }
    if ($lote != ''){
            echo "-lote = '$lote'";
    }
    if ($caja != ''){
            echo "-caja = '$caja'";
    }
             
             
            $sql=$consultaFiltros." ".implode(" AND ",$filtros) ." ORDER BY `id` DESC LIMIT 1000";
            //echo $sql;
            $result=mysqli_query($conexion,$sql);
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['mold'] ?></td>
                <td><?php echo $mostrar['antPos'] ?></td>
                <td><?php echo $mostrar['uppLow'] ?></td>
                <td><?php echo $mostrar['shade'] ?></td>
                <td><?php echo $mostrar['lote'] ?></td>
                <td><?php echo $mostrar['juegos'] ?></td>
                <td><?php echo $mostrar['pedido'] ?></td>
                <td><?php echo $mostrar['cliente'] ?></td>
                <td><?php echo $mostrar['Fecha'] ?></td>
                <td><a href="#" class="eliminar-btn" data-id="<?php echo isset($mostrar['id']) ? $mostrar['id'] : ''; ?>"><i class="fas fa-trash" style="color: red;"></i></a></td>

                
            </tr>
            <?php
            }
            ?>
          </tbody>
                </table>
            </div>
        </section>
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
                window.location.href = '../../eliminar_pedidoG.php?id=' + id;

            }
        });
    });
});
</script>

</div>
<br></br>

<p>Cuando no se filtra se listan los ultimos 1000 registros de lista de empaque.</p>
    </center>
</body>
</html>

<?php
}

else {
  echo"<h1>No estoy autorizado para ingresar a esta pagina.</h1>";
}
?>