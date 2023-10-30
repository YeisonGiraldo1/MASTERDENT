<?php

class EnlacesPaginas
{

	public static function enlacesPaginasModelo($enlacesModelo)
	{

		if (strcmp("cerrar_session", $enlacesModelo) == 1) {
			if (!(session_status() === PHP_SESSION_ACTIVE)) {
				session_start();
			}

			session_destroy();
			$ruta = "../index.php";
			header("Location: $ruta");
			exit;
		} else if (
			$enlacesModelo == "estaciones" || $enlacesModelo == "pedidos" ||
			$enlacesModelo == "materiales" ||
			$enlacesModelo == "moldes" || $enlacesModelo == "cerrar_sesion" ||
			$enlacesModelo == "registro_usuario" || $enlacesModelo == "fallos_masterdent" ||
			$enlacesModelo == "template2"
		)


			$modulo = "vistas/modulos/" . $enlacesModelo . ".php";

		else {
			$modulo = "vistas/modulos/estaciones.php";
		}

		return $modulo;
	}
}
