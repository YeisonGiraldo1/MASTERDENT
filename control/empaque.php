<?php
$conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");

$pedido = isset($_GET["pedidoId"]) ? $_GET["pedidoId"] : '';
if (is_null($pedido)) {
    $pedido = $_GET['pedido'];
    if (is_null($pedido)) {
        $pedido = $_POST['pedido'];
    }
}
$referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
$antPos = isset($_POST['antPos']) ? $_POST['antPos'] : '';
$uppLow = isset($_POST['uppLow']) ? $_POST['uppLow'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$lote = isset($_POST['lote']) ? $_POST['lote'] : '';
$caja = isset($_POST['caja']) ? $_POST['caja'] : '';

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

$consultaFiltros = 'select * , COUNT(id), sum(juegos) as total FROM listaEmpaque WHERE ';

$consultaSuma = 'select sum(juegos) as total FROM listaEmpaque WHERE ';

$juegosPedido = "";
$juegosEmpacados = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Empaque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <div class="row">
        <button class="btn btn-primary" onclick="location.href='../control/formulario_seleccionPedido.php'">Despachar otro pedido</button>
        <button class="btn btn-primary" onclick="location.href='../control'">Inicio</button>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center">Detalles del pedido</h1>
    <div class="row">
        <?php
        $sql2 = "SELECT codigoP from pedidos2 WHERE idP ='" . $pedido . "'";
        $result2 = mysqli_query($conexion, $sql2);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Código del Pedido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar2 = mysqli_fetch_array($result2)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar2['codigoP'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <?php
        $sql3 = "SELECT pedidos2.`idCliente`, clientes2.`nombreCliente` AS cliente from pedidos2 INNER JOIN clientes2 ON pedidos2.`idCliente` = clientes2.`id` WHERE idP ='" . $pedido . "'";
        $result3 = mysqli_query($conexion, $sql3);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Cliente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar3 = mysqli_fetch_array($result3)) {
                    $nombreCliente = $mostrar3['cliente'];
                    ?>
                    <tr>
                        <td><?php echo $nombreCliente; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <?php
        $sql4 = "SELECT juegosTotales AS total FROM pedidos2 WHERE idP ='" . $pedido . "'";
        $result4 = mysqli_query($conexion, $sql4);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Juegos del pedido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar4 = mysqli_fetch_array($result4)) {
                    $juegosPedido = $mostrar4['total'];
                    ?>
                    <tr>
                        <td><?php echo $juegosPedido; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <?php
        $sql5 = "SELECT SUM(juegos) AS totalEmpacado FROM listaEmpaque WHERE pedidoId ='" . $pedido . "'";
        $result5 = mysqli_query($conexion, $sql5);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Total juegos empacados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($mostrar5 = mysqli_fetch_array($result5)) {
                    $juegosEmpacados = $mostrar5['totalEmpacado'];
                    ?>
                    <tr>
                        <td><?php echo $juegosEmpacados; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Juegos que faltan por empacar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo intval($juegosPedido) - intval($juegosEmpacados); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center">Empacar pedido</h1>
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
                    <option value="1">Uno a uno</option>
                    <option value="2">Grupal</option>
                    <option value="3">Manual</option>
                    <option value="4">StarPlus</option>
                </select>
            </div>
            <br>
            <input type="submit" name="Crear" class="btn btn-primary">
        </form>
    </div>
    <br>
    <h2 class="text-center">Lista General del pedido</h2>
    <div class="row">
        <form action="empaque.php" method="POST">
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
                <input name="pedido" type="hidden" value="<?php echo $pedido; ?>">
                <input type="submit" name="Empacar" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center">Lista General del pedido</h2>
    <table class="table table-bordered">
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
    <table class="table table-bordered">
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
