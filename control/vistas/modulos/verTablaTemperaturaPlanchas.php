<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

// Verificar si se ha enviado un parámetro "eliminar" a través de la URL
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']); // Convertir a entero para seguridad

    // Verificar que el ID sea válido
    if ($idEliminar > 0) {
        // Realizar la consulta de eliminación
        $sqlEliminar = "DELETE FROM temperaturaPrensas WHERE id = '$idEliminar'";
        $resultadoEliminar = mysqli_query($conexion, $sqlEliminar);

        // Verificar el resultado de la consulta de eliminación
        if ($resultadoEliminar) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al intentar eliminar el registro: " . mysqli_error($conexion);
        }
    } else {
        echo "ID no válido.";
    }
}

// Continuar con el resto del código para mostrar la tabla
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TemperaturaPrensas</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../../../Public/imagenes/moldeado3.jpeg');
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
    <!-- Agrega el enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <link href="cssProyecto/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="cssProyecto/slide.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="../resources/estilos.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </script>
</head>

<body>
    <button onclick="location.href='../../../control/index.php'" class="btn btn-primary">Inicio</button>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 gray-table">
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="3">MASTERDENT</td>
                        <td rowspan="3">
                            <h2>CONTROL DE VULCANIZADORAS</h2>
                        </td>
                        <td>Cod F-PR-01</td>
                    </tr>
                    <tr>
                        <td>Versión 002</td>
                    </tr>
                    <tr>
                        <td>24-ene-22</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 gray-table">
                <table class="table table-bordered">
                    <tr>
                        <td>Prensa</td>
                        <td>Zona</td>
                        <td>Temperatura Indicador</td>
                        <td>Set Point</td>
                        <td>Temperatura Patrón</td>
                        <td>Accion Set Point</td>
                        <td>Corriente</td>
                        <td>Fecha y Hora</td>
                        <td>Acción</td>
                    </tr>
               

                    <script type="text/javascript">
    function eliminarRegistro(id) {
        var confirmar = confirm("¿Estás seguro de que quieres eliminar este registro?");

        if (confirmar) {
            $.ajax({
                url: "eliminar_registro_temperatura.php",
                method: "GET",
                data: { id: id },
                success: function (result) {
                    console.log(result);
                    location.reload(); // Recargar la página después de la eliminación
                },
                error: function (request, status, error) {
                    console.error(request.responseText);
                    console.error(error);
                }
            });
        }
    }
</script>


                    <?php
                    $sql = "SELECT * FROM temperaturaPrensas ORDER BY fechaCreacion DESC ";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['prensa'] ?></td>
                        <td><?php echo $mostrar['zona'] ?></td>
                        <td><?php echo $mostrar['tempIndicador'] ?></td>
                        <td><?php echo $mostrar['setPoint'] ?></td>
                        <td><?php echo $mostrar['tempPatron'] ?></td>
                        <td><?php echo $mostrar['accion'] ?></td>
                        <td><?php echo $mostrar['corriente'] ?></td>
                        <td><?php echo $mostrar['fechaCreacion'] ?></td>
                        <td>
                        <td>
    <a href="?eliminar=<?php echo $mostrar['id']; ?>" class="btn btn-danger">Eliminar</a>
</td>


                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
              
            </div>
        </div>
    </div>
    </center>
</body>

</html>
