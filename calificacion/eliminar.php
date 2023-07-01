<?php 
include('funciones.php');
$con= connection();
$id = isset($_POST['id_usuario']) ? $_GET['id_usuario'] : "";

$sql = "DELETE * FROM 'calificacion' WHERE id_usuario='$id'";
$resultado = mysqli_query($con, $sql);

if ($resultado){
    header("location: conexion.php");
}

return $conn;
?>