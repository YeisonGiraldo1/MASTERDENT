<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>

	<style>
    section {
        height: 100vh; /* Usamos la altura de la ventana del navegador para centrar verticalmente */
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column; /* Para alinear verticalmente */
        justify-content: center;
        align-items: center;
        text-align: center;
    }
</style>

</head>
<body>

	<?php
	include "modulos/navegacion.php";

	?>

	

	<section>
		<?php
		$mvc = new MvcController();
		$mvc -> enlacesPaginasController();


		?>
	</section>
</body>
</html>