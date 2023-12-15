<?php
  
session_start();
  if(!isset ($_SESSION['Cedula']) or !isset($_SESSION['Contrasena'])){ 
    $cedula=1993;
  $contrasena=2050;
    echo "<script>
    alert('Zona  no autorizada,por favor inicia la seccion');
    window.location='../index.php';
  
  
    
  </script>";
  
   
  }
  
  else{
    
    
    $cedula=$_SESSION['Cedula'];
    $contrasena=$_SESSION['Contrasena']; 
   $rol=$_SESSION['Rol'];
  





   $conexion = mysqli_connect("localhost","root","","u638142989_MasterdentDB");
  
  }
  
  if($rol==1 OR $rol==3 ){
    
  
  ?>
 
 
 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Programación de Producción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../../Public/imagenes/moldeado2.jpeg');
            background-size: cover;
        }

        .container {
            margin-top: 5%;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .button-container button {
            padding: 1rem;
            outline: none;
            border-radius: 7px;
            border: none;
            transition: background 0.5s;
            width: 200px;
            font-size: 16px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #007bff;
            color: #fff;
        }

        h1 {
            color: #343a40;
            font-weight: bold;
            text-align: center;
        }

    
           .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }
    </style>
   
</head>

<body>
    <div class="container mt-5">
        <h1>Programación de Producción</h1>
        <div class="button-container">
            <button onclick="location.href='../../control'">Inicio</button>
            <button onclick="location.href='../../control/progProduccion/progProduccion2.php'">Nueva Programación</button>
            <button onclick="location.href='../../control/registroProducidos/registroProducidos1.php'">Producidos</button>
            <button onclick="location.href='../../control/filtros_Rotulos/filtrados.php'">Filtros de búsqueda</button>
            <button onclick="location.href='formularioImprimirProg.php'">Imprimir</button>
            <button onclick="location.href='../progProduccion/invima.php'">INVIMA</button>
        </div>
    </div>
</body>

</html>

<?php
}

else {
  echo"<h1>No estoy autorizado para ingresar a esta pagina.</h1>";
}
?>
