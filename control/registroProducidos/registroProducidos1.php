<?php
    
    $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
    
    //reviso si me han llegado datos por el método get
    
        $fecha = isset($_GET ["fecha"]) ? $_GET["fecha"]: null;
        //echo $fecha;
        $turno= isset($_GET ["turno"]) ? $_GET["turno"]: null;
        //echo $turno;
        $prensada= isset($_GET["prensada"]) ? $_GET["prensada"]: null;


    
         //limito el tamaño de los datos

       $fecha = substr($fecha, intval(-12));
$turno = substr($turno, intval(-10));
$prensada = substr($prensada, intval(-2));
        //elimino los espacios en blanco del string turno.
        
        $turno=trim($turno," ");
        //echo "fecha sin espacios en blanco".$fecha;
        
        
//exploto la fecha para presentar los valores como predeterminados y así evitar la movimientos innecesarior

$date = explode ("-",$fecha);

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
</head>
<body>
    
    <center><h1>Ingrese los datos de la prensada</h1>
    <div class="container mt-5">
        <div class="row">
            <form action="registroProducidos2.php" method="POST">
                
               
               <div class="mb-3">
    
                      <div class="mb-3">
                          
                   <label for="fecha" class="form-label">Fecha*</label>
                    <input type="Date" class="form-control" id="fecha" name="fecha" placeholder="Ingresa la fecha" >
                         </div>
<br>

  <div class="mb-3">
                    <label for="turno" class="form-label">Turno*</label>
                    <select class="form-select" id="turno" name="turno" aria-label="Default select example">
                        
                        <option value="">Selecciona</option>
                        <option value="mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noche">Noche</option>
                        
                    </select>
                </div>
                <br>
                
                  
                        <input name="cantidadRotulos" type="hidden" value=" <?php
                        echo $cantidadRotulos; 
                    ?>">
                      
                </div>
                     
                     <br>
                
                <input class="btn btn-success" type="submit" name="Programar" >
            </form>
            </center>
        </div>
        
    </div>
</body>
</html>