<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
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
            background-image: url('../../../Public/imagenes/moldeado2.jpeg');
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
    <meta charset="UTF-8">
    <title>Prensadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="location.href='../../../control'">Inicio</button>
            </div>
        </div>
    </div>
    
    <div class="container mt-5">
        <center>
            <h1>Filtros de búsqueda prensadas</h1>
            <form action="verTablaPrensadas2.php" method="get">
                <div class="mb-3">
                    <label for="filtro" class="form-label">Tipo de filtro</label>
                    <select class="form-select" id="filtro" name="filtro" aria-label="Default select example">
                        <option value="">Seleccione Filtro</option>
                        <option value="1">Intervalo Fecha y hora</option>
                        <option value="2">Día específico</option>
                        <option value="3">Turno Automático</option>
                        <option value="4">Día y Turno</option>
                    </select>
                </div>
                <br>
                <input type="submit" name="Crear" class="btn btn-primary">
            </form>
        </center>
    </div>

    <div class="container mt-5">
        <h1 class="text-center">Tabla Prensadas</h1>
        <br>
        <table class="table table-bordered gray-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Tiempo Prensada</th>
                    <th>Tiempo improductivo</th>
                    <th>Fecha y hora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM cuentaPrensadas2 WHERE minutos > '2' ORDER BY `id` DESC LIMIT 30000";
                $result = mysqli_query($conexion, $sql);
                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $mostrar['id'] ?></td>
                        <td><?php echo $mostrar['minutos'] ?></td>
                        <td><?php echo $mostrar['improductivo'] ?></td>
                        <td><?php echo $mostrar['fechaCreacion'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
