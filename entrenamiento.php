<?php
    require 'conexion.php';
   
    if (!empty($_POST['peso'])){
        echo "<script>console.log('enviado');</script>";
        $peso=$_POST['peso'];
      
        $sql = "INSERT INTO `peso` (peso) VALUES (?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('d',$peso);
        if ($stmt->execute()) {
           
            echo '<script language="javascript">alert("Se ha añadido el producto correctamente");</script>';
        } else {
            echo "error";
            echo '<script language="javascript">alert("No se ha añadido el producto");</script>';

        }
        header('Location: entrenamiento.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrenamiento</title>
</head>
<body>
    <h1>Entrenamiento</h1>
    <label for="">Añadir nuevo peso</label>
    <div class=anadirPeso>
        <form method="post">
            <input type="text" placeholder="kg" name="peso">
            <input type="submit" value="Aceptar">
        </form>
        

    </div>
    <div class=tablaPeso>
    <table>
            <tr><th colspan="3"><h1>Pesos registrados: </h1></th></tr>
            <tr>
                <td>Fecha</td>
                <td>Peso(kg)</td>
                 
            </tr>
            <?php
                $sql="SELECT date_format(fecha, '%d-%m-%Y') as fecha,peso FROM `peso`";
                $resultado=mysqli_query($con,$sql);
                while($fila=mysqli_fetch_array($resultado)){
            ?>
            <tr>
                
                <td class="texto"><?php echo $fila['fecha'] ?></td>
                <td class="texto"><?php echo $fila['peso'] ?></td>
                
                

            </tr>
            <?php
                }
            ?>
            </table>
    </div>
</body>
</html>