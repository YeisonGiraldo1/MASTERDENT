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
						<a href="" target="blank">Otros</a>
						<ul class="hijos">
							<li><a href="#">...</a></li>
							<li><a href="#">...</a></li>
							<li><a href="#">...</a></li>

						</ul>
					</li>
					<li><a href="index.php?action=materiales&menu=navegacion_moldeado" target="blank">Materiales</a></li>
					<li><a href="index.php?action=moldes&menu=navegacion_moldeado" target="blank">Moldes</a></li>
					<li><a href="BusquedaRotulosPorEstacion.php?estaciones=1&Buscar=Enviar" target="blank">Produccion de Moldeado</a></li>
					<li><a href="BusquedaRotulosPorEstacion.php?estaciones=9&Buscar=Enviar" target="blank">Desperdicios</a></li>
					<li><a href='../control/vistas/modulos/verTablaTiempoPrensas.php' target="blank">Tiempos Prensas</a></li>
					<li><a href='../control/formulario_temperaturaPrensas.php' target="blank">Temperatura de planchas</a></li>
					<li><a href='../control/vistas/modulos/verTablaPrensadas.php' target="blank">Cuentas Prensadas</a></li>
					<li><a href='../control/progProduccion/progProduccion1.php' target="blank">Programacion</a></li>
					<li><a href="index.php?action=cerrar_sesion" target="blank">Cerrar Sesion</a></li>


				</ul>
			</nav>
		</div>
	</header>
</body>

</html>