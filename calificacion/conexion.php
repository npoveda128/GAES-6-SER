<?php
include ('funciones.php');
$con = connection();

// Operación de inserción (Create)

$fechar = isset($_POST["fechar"]) ? $_POST["fechar"] : "";
$nombre_oferente_de_servicio = isset($_POST["nombre_oferente_de_servicio"]) ? $_POST["nombre_oferente_de_servicio"] : "";
$servicio_solicitado = isset($_POST["servicio_solicitado"]) ? $_POST["servicio_solicitado"] : "";
$nombre_contratista = isset($_POST["nombre_contratista"]) ? $_POST["nombre_contratista"] : "";
$calificacion = isset($_POST["calificacion"]) ? $_POST["calificacion"] : "";
$id = isset($_POST["id_usuario"]) ? $_POST["id_usuario"] : "";

$sql = "INSERT INTO `calificacion` (`cod_calificacion`, `servicio_solicitado`, `nombre_oferente_servicio`, `nombre_contratista`, `fechar`) VALUES ('$calificacion','$servicio_solicitado','$nombre_oferente_de_servicio','$nombre_contratista','$fechar')";

if ($con->query($sql) === TRUE) {
    echo "Registro insertado correctamente.";   
} else {
    echo "Error al insertar el registro: " . $con->error;
}

// Cierre de la conexión

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>consultas</title>
</head>
<body>
    <a href="consulta.php">consultas</a>
</body>
</html>