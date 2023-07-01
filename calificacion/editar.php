<?php
include('funciones.php');
$con= connection();

$id = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : "";



$sql = "SELECT * FROM calificacion WHERE id_usuario='$id'";
$resultado = mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <div class="users-form">
        <form action="editar_calificacion.php" method="post">
            <h1>Editar calificacion</h1>
            <input type="hidden" name="id" value="<?= $fila['id_usuario'] ?>">
            <input type="text" name="cod_calificacion" placeholder="cod_calificacion" value="<?= $fila['cod_calificacion'] ?>">
            <input type="text" name="servicio_solicitado" placeholder="servicio_solicitado" value="<?= $fila['servicio_solicitado'] ?>">
            <input type="text" name="nombre_oferente_de_servicio" placeholder="nombre_oferente_de_servicio" value="<?= $fila['nombre_oferente_servicio'] ?>">
            <input type="text" name="nombre_contratista" placeholder="nombre_contratista" value="<?= $fila['nombre_contratista'] ?>">
            <input type="text" name="fechar" placeholder="fechar" value="<?= $fila['fechar'] ?>">
            <input type="submit" value="Actualizar información">
        </form>
    </div>
</body>
</html>