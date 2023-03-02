<?php
    require 'conexion.php';
    $con->set_charset("utf8");
    session_start();
    if (!empty($_POST['nombre']) && !empty($_POST['carbohidratos']) && !empty($_POST['proteinas']) && !empty($_POST['grasas']) && !empty($_POST['azucar']) && !empty($_POST['kiloCalorias'])) {
        echo "hola";
        $nombre=$_POST['nombre'];
        $carbohidratos=$_POST['carbohidratos'];
        $proteinas=$_POST['proteinas'];
        $grasas=$_POST['grasas'];
        $azucar=$_POST['azucar'];
        $kiloCalorias=$_POST['kiloCalorias'];
        
        
        $sql = "INSERT INTO `producto` (nombre,kiloCalorias,carbohidratos,proteinas,grasas,azucar) VALUES (?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('siiiii', $nombre,$kiloCalorias,$carbohidratos,$proteinas,$grasas,$azucar);
        if ($stmt->execute()) {
           
            echo '<script language="javascript">alert("Se ha añadido el producto correctamente");</script>';
        } else {
            echo '<script language="javascript">alert("No se ha añadido el producto");</script>';

        }
        header('Location: configuracion.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
</head>
<body>
    <div class=formProducto>
        <form class="formulario" method="post">
            
            <input class="inputProducto" type="text" placeholder="Nombre" name="nombre">
            <input class="inputProducto" type="text" placeholder="kiloCalorias" name="kiloCalorias">
            <input class="inputProducto" type="text" placeholder="Carbohidratos" name="carbohidratos">
            <input class="inputProducto" type="text" placeholder="Proteinas" name="proteinas">
            <input class="inputProducto" type="text" placeholder="Grasas" name="grasas">
            <input class="inputProducto" type="text" placeholder="Azucar" name="azucar">
            
            <input type="submit" value="Crear nuevo producto">
        </form>
    </div>
</body>
</html>