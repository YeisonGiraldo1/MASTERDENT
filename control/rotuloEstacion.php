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

        
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Rótulos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <form action="BusquedaRotulosPorCodigo.php" method="get">
                
                <div class="mb-3">
                    <label for="rotulos" class="form-label">Buscar ubicación actual del Rotulo según su código</label>
                   
                    <input type="text" class="form-control" id="rotulos" name="rotulos" placeholder="id de rótulo">
                    
                    </div>
                        
                    
                    
                    </select>
                </div>
                <input type="submit" name="Buscar">


                 </form>

        </div>
         
    </div>

</body>
</html>