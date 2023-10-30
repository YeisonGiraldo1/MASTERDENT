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
					<li class="submenu">
						<a href="" target="blank">Emplaquetados</a>
						<ul class="hijos">
							<li><a href="BusquedaRotulosPorEstacion.php?estaciones=4&Buscar=Enviar">Interno</a></li>
							<li><a href="BusquedaRotulosPorEstacion.php?estaciones=5&Buscar=Enviar">Externo</a></li>
							

						</ul>
					</li>
					<li><a href="BusquedaRotulosPorEstacion.php?estaciones=7&Buscar=Enviar" target="blank">Almacen Granel</a></li>
					<li><a href="BusquedaRotulosPorEstacion.php?estaciones=6&Buscar=Enviar" target="blank">Revision</a></li>
					<li><a href="BusquedaRotulosPorEstacion.php?estaciones=3&Buscar=Enviar" target="blank">Separado</a></li>
					<li><a href="BusquedaRotulosPorEstacion.php?estaciones=2&Buscar=Enviar" target="blank">Acabado</a></li>
					<li><a href='../control/vistas/modulos/verTablaGranel.php' target="blank">Producto a Granel</a></li>
					<li><a href='../control/vistas/modulos/verTablaPedidos.php?origenBusqueda=terminacion' target="blank">Pedidos</a></li>
					<li><a href='../control/formulario_seleccionPedido.php?destino=asignacion&Crear=Enviar' target="blank">Asignacion de producto Terminado</a></li>
					<li><a href='../control/formularioEmplaquetado2.php' target="blank">Emplaquetados</a></li>
					<li><a href="index.php?action=cerrar_sesion" target="blank">Cerrar Sesion</a></li>


				</ul>
			</nav>
		</div>
	</header>
</body>

</html>