<?php
    // $refs = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    $conexion = mysqli_connect("localhost","u638142989_master2022","Master2022*","u638142989_MasterdentDB");
  
    // $sql1="SELECT * from colores2 ORDER BY id ASC";
    // $result=mysqli_query($conexion,$sql1);
    
    // while($mostrar=mysqli_fetch_array($result)){
    //     var_dump($mostrar);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Simulación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
        <!--  if ($_SESSION["mensaje"] && $_SESSION["mensaje"] != null) {
             echo "<script>".$_SESSION["mensaje"]."</script>";
         } -->
    <div class="container mt-5">
        <center><h1>Formulario de simulación de datos enviados por el módulo RFID</h1></center>
        <div class="row">
            <form action="interaccion_arduino.php" method="get">

                <div class="mb-3">
                    <label for="rotulo_php" class="form-label">Código de Rótulo</label>
                    <input type="text" class="form-control" id="rotulo_php" name="rotulo_php" placeholder="Digita número de Rótulo">
                </div>

                <div class="mb-3">
                    <label for="dist_php" class="form-label">Código de Molde</label>
                    <input type="text" class="form-control" id="dist_php" name="dist_php" placeholder="Digita número de Molde">
                </div>

                <div class="mb-3">
                    <label for="proceso_php" class="form-label">Código de proceso</label>
                    <input type="text" class="form-control" id="proceso_php" name="proceso_php" placeholder="Digita número variable de proceso">
                </div>


                <div class="mb-3">
                    <label for="hum_php" class="form-label">Numero de estación</label>
                    <input type="text" class="form-control" id="hum_php" name="hum_php" placeholder="Digita estación">
                </div>
                

                <div class="mb-3">
                    <label for="temp_php" class="form-label">Número de juegos</label>
                    <input type="text" class="form-control" id="temp_php" name="temp_php" placeholder="Digita cantidad de juegos">
                </div>

                
                
                <input type="submit" name="Enviar" >
            </form>
        </div>
        
    </div>
</body>
</html>