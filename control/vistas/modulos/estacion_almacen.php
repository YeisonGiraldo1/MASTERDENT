<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../imagenes/moldeado1.jpeg');
            background-size: cover;
        }

        .image-container {
            display: flex;
        }

        .image {
            width: 50%;
            margin: 0 10px;
        }

        .title-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            padding: 20px;
            text-align: center;
         
        }

        h1 {
             position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
           
        }
    </style>
</head>

<body>
    <div class="image-container">
        <img class="image" src="../Public/imagenes/almacen1.jpeg" alt="Imagen 1">
        <img class="image" src="../Public/imagenes/almacen2.jpeg" alt="Imagen 2">
    </div>
    <div class="title-container">
        <h1>BIENVENIDO A LA ESTACIÓN DE ALMACÉN</h1>
    </div>
</body>

</html>
