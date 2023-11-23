<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
if (mysqli_connect_errno()) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tiempo_Prensas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <header class="text-center mt-4">
        <h1 class="display-4">Filtros de búsqueda Tiempo Prensas</h1>
    </header>
    <nav class="mt-4">
        <a class="btn btn-primary" href="../../../control">Inicio</a>
    </nav>
    <main class="mt-4">
        <form action="verTablaTiempoPrensas2.php" method="get">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="filtro">Tipo de filtro</label>
                    <select class="form-control" id="filtro" name="filtro">
                        <option value="">Seleccione Filtro</option>
                        <option value="1">Intervalo Fecha y hora</option>
                        <option value="2">Día específico</option>
                        <option value="3">Turno Automático</option>
                        <option value="4">Día y Turno</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="prensa">Prensa</label>
                    <select class="form-control" id="prensa" name="prensa">
                        <option value="">Seleccione Prensa</option>
                        <option value="1">Prensa 1</option>
                        <option value="2">Prensa 2</option>
                        <option value="3">Prensa 3</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Crear</button>
                </div>
            </div>
        </form>
        <section class="mt-4">
            <h2 class="h4">Tabla Tiempos Prensas</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Prensa</th>
                            <th>Tiempo Activa</th>
                            <th>Tiempo Inactiva</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mostrar todos los registros
                        $sql = "SELECT * FROM tiempoPrensas ORDER BY `id` DESC LIMIT 30000";
                        $result = mysqli_query($conexion, $sql);
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar['id'] ?></td>
                                <td><?php echo $mostrar['prensa'] ?></td>
                                <td><?php echo $mostrar['tiempoActiva'] ?></td>
                                <td><?php echo $mostrar['tiempoInactiva'] ?></td>
                                <td><?php echo $mostrar['fechaCreacion'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>
