<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>listaEmpaque</title>
</head>
<body>
    

    <h1>Lista de empaque</h1>
    
    <br>

    
        <table border="1">
            <tr>
                <td>id</td>
                <td>MOLD</td>
                <td>ANT/POS</td>
                <td>UPP/LOW</td>
                <td>SHADE</td>
                <td>LOTE</td>
                <td>TOTAL</td>
                
            </tr>
            
            <?php
            $sql="select * , COUNT(id), sum(juegos) as total FROM listaEmpaque GROUP BY mold, shade, lote ORDER BY mold;";
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
                <td><?php echo $mostrar['total'] ?></td>
                
            </tr>
            <?php
            }
            ?>
        </table>
        
         
    <br>

    </br>
<button onclick="location.href='../control/formularioListas.php'">Ingreso uno a uno</button>
<button onclick="location.href='../control/vistas/modulos/verTablaReferencias.php'">Exportar</button>
    <button onclick="location.href='../control/limpiarTabla.php'">Limpiar Tabla</button>
    
    

    
</body>
</html>