<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moldes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <button class="btn btn-primary" onclick="location.href='../../'">Inicio</button>

    <h1>Tabla Moldes</h1>
    
    <br>

    
        <table class="table table-striped">
            <tr>
                <td>id</td>
                <td>nombre</td>
                <td>referencia</td>
                <td>juegos</td>           
                <td>tipo</td> 
                <td>capas</td>               
                
                
            </tr>
            
            <?php
            $sql="SELECT * from moldes2 INNER JOIN referencias2 ON referencias2.`id`=moldes2.`referenciaId3` ORDER BY moldes2.`idM` ASC";
            $result=mysqli_query($conexion,$sql);
            
            while($mostrar=mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $mostrar['idM'] ?></td>
                <td><?php echo $mostrar['nombreM'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['juegos'] ?></td>                 
                <td><?php echo $mostrar['tipo'] ?></td>
                <td><?php echo $mostrar['capas'] ?></td>
              
                
            </tr>
            <?php
            }
            ?>
        </table>
        </div>

    
</body>
</html>