<?php
    // $refs = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
    // $sql1="SELECT * from colores2 ORDER BY id ASC";
    // $result=mysqli_query($conexion,$sql1);
    
    // while($mostrar=mysqli_fetch_array($result)){
    //     var_dump($mostrar);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<div style="text-align: center;">
    <button  class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
    <button class="btn btn-primary" onclick="location.href='../control/tableroTerminacion2.php'">Tablero</button>
     <button class="btn btn-primary" onclick="location.href='../control/consolidadoEmplaquetado.php'">Consolidado Emplaquetado</button>
     <button class="btn btn-primary" onclick="location.href='../control/consolidadoPorEmplaquetar.php'">Consolidado Entregado A Emplaquetar</button>
     </div>
    <br></br>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplaquetado Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
         
       
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>
<body>
    <center><h2>Registro de Emplaquetado</h2>
    <div class="container mt-5">
        <div class="row">
            <form action="creaEmplaquetado.php" method="get">
                
                
                
                  <div class="mb-3">
                    <label for="emplaquetador" class="form-label">Emplaquetador</label>
                    <select class="form-select" id="emplaquetador" name="emplaquetador" autofocus aria-label="Default select example">
                        <option selected>Seleccionar emplaquetador</option>
                    <?php
                        $sql1="SELECT * from emplaquetadores  ORDER BY id ASC";
                        $result=mysqli_query($conexion,$sql1);
                        
                        while($mostrar=mysqli_fetch_array($result)){
                    ?>
                    <?php
                        echo '<option value="'.$mostrar["id"].'">'.$mostrar["nombre"].'     /       '.$mostrar["iniciales"].'</option>';
                    ?>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                
                 <div class="mb-3">
                    <label for="rotulo" class="form-label">ID del rótulo</label>
                   
                    <input type="text" class="form-control" id="rotulo" name="rotulo" placeholder="ID de rótulo">
                    
                    </div>
                
               
                
                
                <div class="mb-3">
                    <label for="cajas" class="form-label">Cajas</label>
                    <input type="text" class="form-control" id="cajas" name="cajas" placeholder="Digita cantidad de cajas">
                </div>
               
              

                
                <input type="submit" name="Crear" class="btn btn-success">
            </form>
            <br></br>
            <br></br>
            <br></br>
            <br>
               <h1>Últimos Registros</h1>
    
    <br>

    
        <table class="table table-bordered table-striped">
        
            <tr>
                <td>id</td>
                <td>Nombre</td>
                <td>Sigla</td>
                <td>Linea</td>
                <td>Juegos</td>
                <td>Fecha</td>
                <td>Acción</td>
                
            </tr>
            
            <?php
            $sql="SELECT seguimientoEmplaquetado.*, emplaquetadores.nombre as nombre, emplaquetadores.iniciales as iniciales FROM `seguimientoEmplaquetado` INNER JOIN emplaquetadores ON seguimientoEmplaquetado.emplaquetador = emplaquetadores.id ORDER BY id desc LIMIT 50; ";
            
            $result=mysqli_query($conexion,$sql); 
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['id'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['iniciales'] ?></td>
                <td><?php echo $mostrar['linea'] ?></td>
                <td><?php echo $mostrar['juegos'] ?></td>
                <td><?php echo $mostrar['fechaHora'] ?></td>
               
 <td><a class="btn btn-danger" href="eliminarEmplaquetado.php?id=<?php echo $mostrar['id'];?>"> <i class="fa fa-trash"></i></a></td>

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
    url: "../control/eliminarEmplaquetado.php",
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
 </center>
 <br></br>
 <br></br>
 
 <br></br>
        </div>
        
    </div>
</body>
</html>