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

<!-- Agrega estos enlaces en la sección head de tu HTML -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-oS3QGVnm6MOBqch3geQcV3kxr83r4pR9Nyp+RTtDz3cM7CYC/SpWQROQjbzm+JCE" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    
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
    <style>
        body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Public/imagenes/terminacion4.jpeg');
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

    
        <table class="table table-dark table-striped">
        
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
               
                <td>
                <td><a href="#" class="eliminar-btn" data-id="<?php echo $mostrar['id']; ?>"><i class="fas fa-trash" style="color: red;"></i></a></td>

</tr>
<?php
}

//
/* <td>
    <a class="btn btn-danger" href="eliminarEmplaquetado.php?id=<?php echo $mostrar['id'];?>" onclick="confirmarEliminar(<?php echo $mostrar['id'];?>)">
        <i class="fa fa-trash"></i>
    </a>
</td> */






?>
</table>

<!-- ... Otros elementos del encabezado ... -->

<!-- ... Tu código anterior ... -->


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
                window.location.href = 'eliminarEmplaquetado.php?id=' + id;
            }
        });
    });
});
</script>




<!-- ... Tu código posterior ... -->


<!-- ... Otros elementos del cuerpo ... -->


 </table>
 </center>
 <br></br>
 <br></br>
 
 <br></br>
        </div>
        
    </div>
</body>
</html>