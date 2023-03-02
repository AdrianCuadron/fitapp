<?php
    require 'conexion.php';
    $con->set_charset("utf8");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" href="image/logo.png">
    <title>fitapp</title>
</head>
<body>
    <div class=logo>FITAPP</div>
    <div class=botones>
        <a class="botonPagina" href="nutricion.php">NUTRICION</a>
        <a class="botonPagina" href="entrenamiento.php">ENTRENAMIENTO</a>
        <a class="botonPagina" href="configuracion.php">CONFIGURACION</a>
    </div>
</body>
</html>