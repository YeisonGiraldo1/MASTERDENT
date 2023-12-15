<?php
$conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
  
$color = isset( $_POST['color'] ) ? $_POST['color'] : '';
$lote = isset( $_POST['lote'] ) ? $_POST['lote'] : '';

$filtros = array();

 if ($color != ''){
            $filtros[]= "colores2.`nombre` LIKE '%$color%'";
    }
    if ($lote != ''){
            $filtros[]= "nombreL = '$lote'";
    }
    
     
    if (empty($filtros)) {
        $filtros[] = "1";
    }


 $consultaFiltros='SELECT lotes2.* , colores2.`nombre` AS color FROM lotes2 INNER JOIN colores2 ON lotes2.`colorId2`= colores2.`id` WHERE ';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lotes</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
    <link href="cssProyecto/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="cssProyecto/slide.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../resources/estilos.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
          body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../../../Public/imagenes/almacen2.jpeg');
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
</head>
<body>
    <div class="container mt-5">
        <button class="btn btn-primary" onclick="location.href='../../'">Inicio</button>
        <center>
            <h1 class="mt-3">Lotes</h1>
            <form action="verTablaLotes.php" method="POST" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" size="10">
                    </div>
                    <div class="col-md-4">
                        <label for="lote" class="form-label">Lote</label>
                        <input type="text" class="form-control" id="lote" name="lote" size="10">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn btn-success" name="Empacar">
                    </div>
                </div>
            </form>

            <table class="table table-bordered mt-3 gray-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Número</th>
                        <th>color</th>
                        <th>fechaCreacion</th>
                        <th>Acción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($color != '') {
                        echo "-COLOR = $color";
                    }
                    if ($lote != '') {
                        echo "-LOTE = '$lote'";
                    }

                    $sql = $consultaFiltros . " " . implode(" AND ", $filtros) . " ORDER BY id DESC ";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $mostrar['id'] ?></td>
                            <td><?php echo $mostrar['nombreL'] ?></td>
                            <td><?php echo $mostrar['color'] ?></td>
                            <td><?php echo $mostrar['fechaCreacion'] ?></td>
                            <td><a href="eliminar_lotes.php?id=<?php echo $mostrar['id'];?>" class="btn btn-danger">Eliminar</a></td>
                            <td><a href="editar_lotes.php?id=<?php echo $mostrar['id'];?>" class="btn btn-warning">Editar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </center>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <script src="sweetalert2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).on("click", "#delRg", function(event) {
                event.preventDefault();

                let ifRegistro = $(this).attr('data-rg');

                $.ajax({
                    url: "../control/eliminar_Lotes.php",
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
    </div>
</body>
</html>
