<?php
require_once 'EnlacesPaginas2.php'; // Agrega esta línea

class MvcController
{

	#bloque de llamada a la plantilla



	public function plantilla()
	{

		include "vistas/template.php";
		#creo una función que me muestra el archivo template. luego en index creo el objeto de la clase MvcControllers. el include se utiliza para incluir otro archivo php.
	}

	public function plantilla2()
	{

		include "vistas/modulos/template2.php";
		#creo una función que me muestra el archivo template. luego en index creo el objeto de la clase MvcControllers. el include se utiliza para incluir otro archivo php.
	}

	#bloque de interacción del usuario
	#la siguiente función es para recibir la variable action
	public function enlacesPaginasController()
	{
		$enlacesController = "";
		if (isset($_GET["action"]) && strcmp("cerrar_session", $_GET["action"]) == 1) {
			// header("Location: ../index.php");
			echo "<script>window.location.href = '../index.php'</script>";
			session_destroy();
			exit;
		} else if (isset($_GET["action"])) {
			#uilizo el isset para decir qeu la variable action trae información.
			$enlacesController = $_GET["action"];
			#la variable enlaces recibirá todo lo que llegue por el metodo GET

		} else {
			$enlacesController = "estaciones";
		}

		$respuesta = EnlacesPaginas::enlacesPaginasModelo($enlacesController);
		#una manera de heredar la clase enlaces paginas y la función.

		include $respuesta;
	}

	public function enlacesPaginasController2()
	{

		$enlacesController2 = "";
		if (isset($_GET["submenu"])) {
			#uilizo el isset para decir qeu la variable submenu trae información.
			$enlacesController2 = $_GET["submenu"];
			#la variable enlaces recibirá todo lo que llegue por el metodo GET

		} else {
			$enlacesController2 = "estaciones";
		}

		$respuesta2 = EnlacesPaginas2::enlacesPaginasModel2($enlacesController2);
		#una manera de heredar la clase enlaces paginas y la función.

		include $respuesta2;
	}
}
