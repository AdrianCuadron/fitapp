<?php
    require 'conexion.php';
    if (!empty($_POST['producto'])){
        $producto=$_POST['producto'];
        #coger id del producto
        $sql = "SELECT id FROM producto where nombre=?";
        $stmt = $con->prepare($sql); 
        $stmt->bind_param("s", $producto);
        $stmt->execute();
        //$result = $conn->query($sql);

        $result = $stmt->get_result();
        if ($fila = $result->fetch_assoc()){
            $idProducto=$fila["id"];

            $sql = "INSERT INTO `ingesta` (idProducto) VALUES (?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('i',$idProducto);
            if ($stmt->execute()) {
                $message='<div class="mensaje">Producto añadido correctamente</div>';
                //echo '<script language="javascript">alert("Se ha añadido el producto correctamente");</script>';
            } else {
                echo "error";
                echo '<script language="javascript">alert("No se ha añadido el producto");</script>';

        }
        }
        else{
            $message='<div class="mensaje">No existe ese producto</div>';
        }
        
        header('Location: nutricion.php');
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Nutricion</title>
</head>
<body>
    <h1>NUTRICION</h1>
    <div class=añadirProd>
        <label for="">Añadir ingesta</label>
        <form method="post">
        
            <input type="text" placeholder="Nombre Producto" name="producto">
            <input type="submit" value="Aceptar">
                
        </form>
        <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
        <?php endif; ?>
    </div>

    <!-- tabla para la nutricion -->
    <div class=tablaNutricion> </div>
    <table>
            <tr><th colspan="3"><h1>Productos consumidos: </h1></th></tr>
            <tr>
                <td>Nombre</td>
                <td>kCal</td>
                <td>Carbohidratos</td>
                <td>Proteinas</td> 
                <td>Grasas</td>
                <td>Azucar</td> 
                 
            </tr>
            <?php
                $sql="SELECT ingesta.id as idIng,nombre,carbohidratos,proteinas,grasas,azucar,kilocalorias FROM `ingesta` inner join producto on ingesta.idProducto=producto.id where ingesta.fecha=date(now())";
                $resultado=mysqli_query($con,$sql);
                while($fila=mysqli_fetch_array($resultado)){
            ?>
            <tr>
                
                <td class="texto"><?php echo $fila['nombre'] ?></td>
                <td class="texto"><?php echo $fila['kilocalorias'] ?></td>
                <td class="texto"><?php echo $fila['carbohidratos'] ?></td>
                <td class="texto"><?php echo $fila['proteinas'] ?></td>
                <td class="texto"><?php echo $fila['grasas'] ?></td>
                <td class="texto"><?php echo $fila['azucar'] ?></td>
                
                
                <td><a class ="botonEliminar" href="eliminarIngesta.php?id=<?php echo $fila['idIng']; ?>"><img class="botonEliminar"src="image/cancelar.png"/></a></td>
                
                
            </tr>
            <?php
                }
            ?>
            </table>

            <div class="resumen">
                <h2>Resumen del dia</h2>
                <?php
                $sql="SELECT sum(kiloCalorias) as sumkCal,sum(carbohidratos) as sumH,sum(proteinas) as sumP,sum(grasas) as sumG,sum(azucar) as sumA FROM `ingesta` inner join producto on ingesta.idProducto=producto.id where ingesta.fecha=date(now())";
                $resultado=mysqli_query($con,$sql);
                while($fila=mysqli_fetch_array($resultado)){
                    $sumkCal=$fila["sumkCal"];
                    $sumH=$fila["sumH"];
                    $sumP=$fila["sumP"];
                    $sumG=$fila["sumG"];
                    $sumA=$fila["sumA"];
                }
        
                ?>

                <h3>kiloCalorias: <?php echo $sumkCal?></h3>
                <h3>carbohidratos: <?php echo $sumH?></h3>
                <h3>proteinas: <?php echo $sumP?></h3>
                <h3>grasas: <?php echo $sumG?></h3>
                <h3>azucar: <?php echo $sumA?></h3>
                
            </div>
    
</body>
</html>