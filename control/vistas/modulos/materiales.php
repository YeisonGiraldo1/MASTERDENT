<?php

if (!isset($_SESSION['Cedula']) or !isset($_SESSION['Contrasena'])) {
  $cedula = 1993;
  $contrasena = 2050;
  echo "<script>
    alert('Zona  no autorizada,por favor inicia la seccion');
    window.location='../index.php';
  
  
    
  </script>";
} else {


  $cedula = $_SESSION['Cedula'];
  $contrasena = $_SESSION['Contrasena'];
  $rol = $_SESSION['Rol'];

  $conexion = mysqli_connect("localhost", "root", "", "u638142989_MasterdentDB");
}

if ($rol == 1 or $rol == 3) {



?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="UTF-8">
    <title>materiales</title>
  </head>
  <!--  -->
  <style>
    nav.viewContainer {
      display: flex;
      align-items: center;
      margin-top: 5%;
      width: 50%;
      min-height: 90%;
      max-height: 90%;
      flex-direction: column;
      margin: auto;
      gap: 4rem;
      margin-top: 5%;
    }

    nav.viewContainer section {
      width: 100%;
      height: 50%;
    }

    .viewContainer .view1 h1 {
      color: black;
      font-weight: bold;
    }

    .viewContainer .view2 {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .viewContainer .view2 button {
      padding: 1rem;
      outline: none;
      border-radius: 7px;
      border: none;
      transition: background 0.5s;
      width: 30%;
    }

    .viewContainer .view2 button:hover {
      background-color: rgb(255, 255, 250);
    }

    
        body {
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Public/imagenes/moldeado2.jpeg');
            background-size: cover;
        }
           .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }
        
 
  </style>

  <body style="overflow-y: scroll;"> <!--hace que funcione el scroll correctamente  -->
    <main>
      <nav class="viewContainer">
        <section class="view1">
          <h1>Materiales</h1>
        </section>
        <section class="view2">
          <button onclick="location.href='../control/formulario_lotes.php'">Nuevo Lote</button>
          <button onclick="location.href='../control/material_preparado.php'">Material Preparado</button>
          <button onclick="location.href='../control/'">Material Pigmentado</button>
        </section>
      </nav>

    </main>
  </body>

  </html>

<?php
} else {
  echo "<h1>No estoy autorizado para ingresar a esta pagina.</h1>";
}
?>