<?php
    $user="root";
    $pass="";
    $server="localhost";
    $db="fitapp";
    $con= mysqli_connect($server, $user, $pass, $db);

    if ($con->connect_error) {
        die("Database connection failed: " . $con->connect_error);
    }
?>

