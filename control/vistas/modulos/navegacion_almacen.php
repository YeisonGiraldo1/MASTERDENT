<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Template</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			text-decoration: none;
			font-family: "Open Sans", sans-serif;
		}

		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
			overflow: hidden;
			/* Para evitar que haya un desplazamiento vertical */
		}

		body {

			background-repeat: no-repeat;
			/* Evita que el gradiente se repita */
			background-size: 100% 100%;

		}

		header {
			width: 100%;
			height: 90px;
			background-color: #284886;
		}

		.interior {
			max-width: 100%;
			padding: 0 10px;
			margin: auto;
		}

		.logo {
			float: left;
			padding: 15px 20px 0;
		}

		.logo img {
			height: 60px;
		}

		.logo img:hover {
			transform: scale(1.1);
		}

		.navegacion {
			float: right;
			display: flex;
			align-items: center;
			min-height: 90px;
			z-index: 1000;
		}

		.navegacion ul {
			list-style: none;
			padding: 0 10px;
		}

		.navegacion ul li {
			display: inline-block;
			position: relative;
			transition: .3s linear;
			z-index: 1000;
		}

		.navegacion ul li:hover {
			transform: scale(1.1);
		}

		.navegacion ul li a {
			color: white;
			text-align: center;
			text-transform: uppercase;
			font-size: 14px;
			font-weight: bold;
			padding: 12px 20px;
			transition: .3s linear;
		}

		.navegacion ul li a:hover {
			color: #A5D330;
			transform: scale(1.1);
		}

		.navegacion ul li:hover .hijos {
			display: block;
		}

		.navegacion .submenu .hijos {
			display: none;
			background: #284886;
			position: absolute;
			width: auto;
		}

		.navegacion .submenu .hijos li {
			display: block;
			overflow: hidden;
			border-bottom: none;
		}

		.navegacion .submenu .hijos li a {
			display: block;
		}

		.navegacion ul li:hover .subhijos {
			display: block;
		}

		.navegacion li ul li .subhijos {
			position: relative;
		}
	</style>

</head>

<body>

	<header>
		<div class="interior">
			<!-- <a href="#" class="logo" target="blank"><img src="../imagenes/nuevamasterdent.png" alt="Logo"></a> -->
			<nav class="navegacion">
				<ul>
					<li><a href="index.php?action=estaciones" target="blank">Ir a la pagina principal</a></li>
					<li><a href='../control/formulario_seleccionPedido.php?destino=inventario&Crear=Enviar' target="blank">Inventario</a></li>

					<li><a href='../control/vistas/modulos/verTablaPedidos.php?origenBusqueda=almacen' target="blank">Pedidos de Almacen</a></li>
					<li><a href='../control/formulario_pedidos.php' target="blank">Nuevo Pedido</a></li>
					<li><a href='../control/formulario_lotes.php' target="blank">Nuevo Lote</a></li>
					<li><a href='../control/formulario_clientes.php' target="blank">Nuevo Cliente</a></li>
					<li><a href='../control/formulario_seleccionPedido.php' target="blank">Lista de empaque</a></li>
					<li><a href='../control/formulario_seleccionPedido.php?destino=empaqueNacional&Crear=Enviar' target="blank">Lista de Empaque N</a></li>
					<li><a href='../control/formulario_seleccionPedido.php?destino=empaqueInternacional&Crear=Enviar' target="blank">Lista de empaque I</a></li>
					<li class="submenu">
						<a href="#" target="blank">Busquedas de produccion</a>
						<ul class="hijos">
							<li><a href='../control/referenciaColor.php'>Referencia y color</a></li>
							<li><a href='../control/rotuloEstacion.php'>Codigo (Id)</a></li>
							<li><a href='../control/rotuloPedido.php'>Por pedido</a></li>
							<li><a href='../control/rotuloLote.php'>Por lote</a></li>
							<li><a href='../control/filtros_Rotulos/filtrados.php'>Busqueda Avanzada</a></li>

						</ul>
					</li>
					<li><a href='../control/pedidosConsolidado.php' target="blank">Consolidado de Pedidos</a></li>
					<li><a href='../control/formulario_seleccionPedido.php?destino=detalles&Crear=Enviar' target="blank">Editar Pedidos</a></li>
					<li><a href='../control/vistas/modulos/verTablaLotes.php' target="blank">Ver Lotes</a></li>
					<li><a href="index.php?action=cerrar_sesion" target="blank">Cerrar Sesion</a></li>


				</ul>
			</nav>
		</div>
	</header>
</body>

</html>