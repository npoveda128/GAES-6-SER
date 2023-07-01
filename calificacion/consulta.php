<?php
include('funciones.php');

$servername = "localhost";
$username = "root";
$password = "";
$database = "ser";

$sql = "SELECT * FROM `calificacion`";

$conn = mysqli_connect($servername, $username, $password, $database)or die ('no se pudo conectar');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$resultado = mysqli_query($conn,$sql);

while($fila=mysqli_fetch_array($resultado)){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>consultas</title>
    
</head>
<body>
    <table>
    <div>
   <td>id</td>
    <td>calificacion</td>
    <td>servicio solicitado</td>
    <td>nombre de oferente de servicio</td>
    <td>nombre contratista</td>
    <td>fecha</td>
   </div>
        <tr>
            <td><?php echo $fila['id_usuario']?></td>
            <td><?php echo $fila['cod_calificacion'] ?></td>
            <td><?php echo $fila['servicio_solicitado'] ?></td>
            <td><?php echo $fila['nombre_oferente_servicio'] ?></td>
            <td><?php echo $fila['nombre_contratista'] ?></td>
            <td><?php echo $fila['fechar'] ?></td>
            
            
            <th><a href="editar.php?id=<?= $fila['id_usuario']?>" class="users-table-edit--edit">editar</a></th>
            <th><a href="eliminar.php?id=<?= $fila['id_usuario']?>" class="users-table-edit--delete">eliminar</a>
            </th>
        </tr>

    <?php
}

    ?>
    </table>
</body>
</html>

