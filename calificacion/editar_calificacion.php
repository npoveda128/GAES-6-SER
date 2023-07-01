<?php 
include('conexion.php');
include('funciones.php');
$con = connection();

$servername = "localhost";
$username = "root";
$password = "";
$database = "ser";


    $id = $_POST['id_usuario'];
    $fechar = $_POST["fechar"];
    $nombre_oferente_de_servicio = $_POST["nombre_oferente_de_servicio"];
    $servicio_solicitado = $_POST["servicio_solicitado"];
    $nombre_contratista = $_POST["nombre_contratista"];
    $calificacion = $_POST["calificacion"];

    $sql = " UPDATE `calificacion` SET id_usuario='$id' calificacion='$calificacion' servicio_colicitado='$servicio_solicitado' nombre_oferente_de_servicio'$nombre_oferente_de_servicio' nombre_contratista='$nombre_contratista'fechar='$fechar' WHERE id_usuario='$id'";
    $resultado = mysqli_query($con, $sql);

    if ($resultado){
        header("location: conexion.php");
    }
?>