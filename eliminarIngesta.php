<?php

require 'conexion.php';
session_start();
$con->set_charset("utf8");
$id = $_GET['id'];
$sql = "DELETE FROM ingesta WHERE id=$id";

if (mysqli_query($con, $sql)) {
    header("Location: nutricion.php");
} else {
    echo '<div class="alert alert-danger">Error al eliminar el coche</div>';
}
?>