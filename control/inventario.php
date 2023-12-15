<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

$pedido = isset($_GET["pedidoId"]) ? $_GET["pedidoId"] : '';
if (empty($pedido)) {
    $pedido = isset($_GET["pedido"]) ? $_GET["pedido"] : '';
    if (empty($pedido)) {
        $pedido = isset($_POST["pedido"]) ? $_POST["pedido"] : '';
    }
}

$referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
$antPos = isset($_POST['antPos']) ? $_POST['antPos'] : '';
$uppLow = isset($_POST['uppLow']) ? $_POST['uppLow'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$lote = isset($_POST['lote']) ? $_POST['lote'] : '';
$caja = isset($_POST['caja']) ? $_POST['caja'] : '';
$fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : '';
$fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : '';

$filtros = array();
if ($pedido != '') {
    $filtros[] = "pedidoId = '$pedido'";
}
if ($referencia != '') {
    $filtros[] = "mold = '$referencia'";
}
if ($antPos != '') {
    $filtros[] = "antPos = '$antPos'";
}
if ($uppLow != '') {
    $filtros[] = "uppLow = '$uppLow'";
}
if ($color != '') {
    $filtros[] = "shade LIKE '%$color%'";
}
if ($lote != '') {
    $filtros[] = "lote = '$lote'";
}
if ($caja != '') {
    $filtros[] = "caja = '$caja'";
}
if ($fechaDesde != '' && $fechaHasta != '') {
    $filtros[] = "Fecha BETWEEN '$fechaDesde%' AND '$fechaHasta%'";
}
if (empty($filtros[0])) {
    $filtros[] = "1";
}

$consultaFiltros = 'select * , COUNT(id), sum(juegos) as total FROM listaEmpaque WHERE ';

$consultaSuma = 'select sum(juegos) as total FROM listaEmpaque WHERE ';

$juegosPedido = "";
$juegosEmpacados = "";
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

        .gray-table {
            background-color: #ccc; /* Color gris de fondo */
        }
    </style>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <center>
            <button class="btn btn-primary" onclick="location.href='../control/formulario_seleccionPedido.php?destino=inventario&Crear=Enviar'">Seleccion de Inventario</button>
            <button class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
        </center>
    </div>

    <div class="container mt-5">
        <center>
            <?php
            $sql2 = "SELECT codigoP from pedidos2 WHERE idP ='" . $pedido . "'";
            $result2 = mysqli_query($conexion, $sql2);
            ?>

            <h1>Inventario de

                <?php

                while ($mostrar2 = mysqli_fetch_array($result2)) {
                ?>

                    <td><?php echo $mostrar2['codigoP'] ?></td>

                <?php
                }
                ?>
            </h1>
        </center>
    </div>

    <div class="container mt-3">
        <center>
            <?php
            $sql5 = "SELECT SUM(juegos) AS totalEmpacado FROM listaEmpaque WHERE pedidoId ='" . $pedido . "'";
            $result5 = mysqli_query($conexion, $sql5);
            ?>

            <h3>Total juegos inventario:

                <?php

                while ($mostrar5 = mysqli_fetch_array($result5)) {
                    $juegosEmpacados = $mostrar5['totalEmpacado'];
                ?>

                    <td><?php echo $juegosEmpacados; ?></td>

                <?php
                }
                ?>
            </h3>
        </center>
    </div>

    <div class="container mt-5">
        <div class="row">
            <form action="formularioListas_digitaLote.php" method="get">
                <div class="mb-3">
                    <label for="caja" class="form-label">Seleccione una caja para ver su contenido o agregar ítems</label>
                    <select class="form-select" id="caja" name="caja" autofocus aria-label="Default select example">
                        <option selected>Selecciona una caja</option>
                        <?php
                        $sql1 = "SELECT COUNT(id),id, pedidoId, caja FROM listaEmpaque WHERE pedidoId ='" . $pedido . "'" . " GROUP BY caja";
                        $result = mysqli_query($conexion, $sql1);
                        while ($mostrar = mysqli_fetch_array($result)) {
                            echo '<option value="' . $mostrar["caja"] . '">' . $mostrar["caja"] . '</option>';
                        }
                        ?>
                        <option value="0">NuevaCaja</option>
                    </select>
                    <input name="pedido" type="hidden" value="<?php echo $pedido; ?>">
                </div>
                <br>
                <div class="mb-3">
                    <label for="metodo" class="form-label">Seleccionar Método de ingreso</label>
                    <select class="form-select" id="metodo" name="metodo" aria-label="Default select example">
                        <option value="">Selecciona</option>
                        <option value="5">Uno a uno</option>
                        <option value="6">Grupal</option>
                    </select>
                </div>
                <br>
                <input type="submit" name="Crear" class="btn btn-primary">
            </form>
        </div>
    </div>
    <br>

    <div class="container mt-5">
        <h2 class="text-center">Lista General del inventario</h2>
        <div class="row">
            <form action="inventario.php" method="POST">
                <div class="mb-3">
                    <label for="referencia" class="form-label">Referencia</label>
                    <input type="text" class="form-control" id="referencia" name="referencia">
                    <label for="antPos" class="form-label">Ant/Pos</label>
                    <select class="form-select" id="antPos" name="antPos" aria-label="Default select example">
                        <option selected></option>
                        <option value="ANT">ANT</option>
                        <option value="POS">POS</option>
                    </select>
                    <label for="uppLow" class="form-label">Sup/Inf</label>
                    <select class="form-select" id="uppLow" name="uppLow" aria-label="Default select example">
                        <option selected></option>
                        <option value="SUP">SUP</option>
                        <option value="INF">INF</option>
                    </select>
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" id="color" name="color">
                    <label for="lote" class="form-label">Lote</label>
                    <input type="text" class="form-control" id="lote" name="lote">
                    <label for="caja" class="form-label">Caja</label>
                    <input type="text" class="form-control" id="caja" name="caja">
                    <label for="fechaDesde" class="form-label">Desde</label>
                    <input type="Date" class="form-control" id="fechaDesde" name="fechaDesde" placeholder="Ingresa la fecha">
                    <label for="fechaHasta" class="form-label">Hasta</label>
                    <input type="Date" class="form-control" id="fechaHasta" name="fechaHasta" placeholder="Ingresa la fecha">
                    <input name="pedido" type="hidden" value="<?php echo $pedido; ?>">
                </div>
                <input type="submit" name="Empacar" class="btn btn-primary">
            </form>
        </div>
    </div>
    <br>

    <div class="container mt-5">
        <h2 class="text-center">Lista General del inventario</h2>
        <table class="table table-bordered gray-table">
            <thead>
                <tr>
                    <th>QR</th>
                    <th>MOLD</th>
                    <th>ANT/POS</th>
                    <th>UPP/LOW</th>
                    <th>SHADE</th>
                    <th>LOTE</th>
                    <th>BOX</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $consultaFiltros . implode(" AND ", $filtros) . " GROUP BY mold, shade, lote, uppLow ORDER BY mold";
                $result = mysqli_query($conexion, $sql);
                while ($mostrar = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $mostrar['codigoQR'] ?></td>
                        <td><?php echo $mostrar['mold'] ?></td>
                        <td><?php echo $mostrar['antPos'] ?></td>
                        <td><?php echo $mostrar['uppLow'] ?></td>
                        <td><?php echo $mostrar['shade'] ?></td>
                        <td><?php echo $mostrar['lote'] ?></td>
                        <td><?php echo $mostrar['caja'] ?></td>
                        <td><?php echo $mostrar['total'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Total de Juegos</h2>
        <table class="table table-bordered gray-table">
            <thead>
                <tr>
                    <th>TOTAL JUEGOS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlSuma = $consultaSuma . " " . implode(" AND ", $filtros);
                $resultSuma = mysqli_query($conexion, $sqlSuma);
                while ($mostrarSuma = mysqli_fetch_array($resultSuma)) {
                ?>
                    <tr>
                        <td><?php echo $mostrarSuma['total']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
