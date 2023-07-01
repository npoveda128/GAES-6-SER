<?php 

function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ser";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $conn;
}
?>