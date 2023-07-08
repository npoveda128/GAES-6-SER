
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
</head>



<body>


    <div class="container-fluid rest-pxy">
        <div class="row">

            <div class="col-md-3 rest-pxy"> <?php require_once('sidebar.php') ?></div>

            <?php

            include "db_conn.php";

            function validate($data)
            {

                $data = trim($data);

                $data = stripslashes($data);

                $data = htmlspecialchars($data);

                return $data;
            }

            if ($_SESSION['rol'] == 'Administrador') {

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["agregar"])) {
                        $nombres = validate($_POST["nombres"]);

                        $apellidos = validate($_POST["apellidos"]);

                        $email = validate($_POST["email"]);

                        $password = validate($_POST["password"]);

                        $fecha_nacimiento = validate($_POST["fecha_nacimiento"]);

                        $tipo_documento = validate($_POST["tipo_documento"]);
                        $numero_documento = validate($_POST["numero_documento"]);
                        $rol = validate($_POST["rol"]);
                        $estado = validate($_POST["estado"]);


                        $sql = "insert into persona 
        (nombres, apellidos, fecha_nacimiento, numero_documento, tipo_documento, estado) 
        values 
        ('$nombres', '$apellidos', '$fecha_nacimiento', '$numero_documento', '$tipo_documento', $estado);";

                        $result = mysqli_query($conn, $sql);

                        if ($result == true) {

                            $id_persona = $conn->insert_id;

                            $sql = "insert into usuario
            (id_persona, email, password, rol, estado)
            values
            ($id_persona, '$email', '$password', '$rol', $estado);";

                            $result = mysqli_query($conn, $sql);

                            if ($result == true) {
                                header("Location: ofertantes.php?alert=1");

                                exit();
                            }
                        }
                    } else if (isset($_POST["editar"])) {
                        $id_persona = validate($_POST["id_persona"]);

                        $id_usuario = validate($_POST["id_usuario"]);

                        $nombres = validate($_POST["nombres"]);

                        $apellidos = validate($_POST["apellidos"]);

                        $email = validate($_POST["email"]);

                        $password = validate($_POST["password"]);

                        $fecha_nacimiento = validate($_POST["fecha_nacimiento"]);

                        $tipo_documento = validate($_POST["tipo_documento"]);
                        $numero_documento = validate($_POST["numero_documento"]);
                        $rol = validate($_POST["rol"]);
                        $estado = validate($_POST["estado"]);


                        $sql = "update persona
            set nombres = '$nombres', apellidos = '$apellidos', fecha_nacimiento = '$fecha_nacimiento', numero_documento = '$numero_documento', tipo_documento = '$tipo_documento', estado = $estado
            where id_persona = $id_persona;";

                        $result = mysqli_query($conn, $sql);

                        if ($result == true) {

                            $sql = "update usuario
                set email = '$email', password = '$password', rol = '$rol', estado = $estado
                where id_usuario = $id_usuario;";

                            $result = mysqli_query($conn, $sql);

                            if ($result == true) {
                                header("Location: ofertantes.php?alert=2");

                                exit();
                            }
                        }
                    }
                } else {
                    if (isset($_GET["eliminar"])) {

                        $id_usuario = validate($_GET["id_usuario"]);
                        $id_persona = validate($_GET["id_persona"]);


                        $sql = "update persona
            set estado = 0
            where id_persona = $id_persona;";

                        $result = mysqli_query($conn, $sql);

                        if ($result == true) {

                            $sql = "update usuario
            set estado = 0
            where id_usuario = $id_usuario;";

                            $result = mysqli_query($conn, $sql);

                            if ($result == true) {
                                echo "Usuario eliminado";
                                header("Location: ofertantes.php?alert=3");

                                exit();
                            }
                        }
                    }
                }

                $sql = "select id_usuario, persona.id_persona, email, rol, usuario.estado, nombres, apellidos, numero_documento, tipo_documento from usuario inner join persona on usuario.id_persona = persona.id_persona where usuario.rol = 'Ofertante';";

                $result = mysqli_query($conn, $sql);

            ?>

                <?php
                if (isset($_GET["alert"])) {

                    switch ($_GET["alert"]) {
                        case '1':
                            echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha registrado correctamente el Ofertante',  
                            })
                    </script>";
                            break;
                        case '2':
                            echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha modificado correctamente el Ofertante',  
                            })
                    </script>";
                            break;
                        case '3':
                            echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha eliminado correctamente el Ofertante',  
                            })
                    </script>";
                            break;
                        case '4':
                            echo "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Ha ocurrido un error.',  
                            })
                    </script>";
                            break;
                        default:
                            # code...
                            break;
                    }
                }
                ?>

                <style>
                    @media (min-width: 768px) {
                        .rest-pxy {
                            padding-left: 0px !important;
                            padding-bottom: 0px !important;
                        }
                    }
                </style>


                <div class="col-md-9 ">
                    <div class="row">
                        <div class="col-12">
                            <header><?php require_once('header.php') ?></header>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <main class="col-md-12 col-sm-12 overflow-auto h-100">
                                <div class="bg-light border rounded-3 p-3">
                                    <div class="d-grid gap-2 pb-5">
                                        <button class="btn btn-primary" id="modal" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Ofertante</button>
                                        <form method="POST" action="./downl.php">
                                            <?php 
                                                $data= array();
                                            ?>
                                            <input type="hidden" name="data" value=<?php $data ?>>
                                            <button class="btn btn-primary excelxd" type="submit">Descargar excel</button>
                                        </form>
                                        <style>
                                            .excelxd{
                                                background-color: green;
                                                border: 1px solid green;
                                            }
                                            .excelxd:hover{
                                                background-color: black;
                                                border: 1px solid green;
                                            }

                                        </style>
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Número Documento</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            while ($row = mysqli_fetch_array($result)) {
                                                $data = mysqli_fetch_assoc($result)
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['numero_documento']; ?></td>
                                                    <td><?php if ($row['estado'] == 1) echo "Activo";
                                                        else echo "Inactivo"; ?></td>
                                                    <td><a href="ofertantes.php?editar=<?php echo $row['id_usuario']; ?>">Editar</a> | <a href="ofertantes.php?eliminar=true&id_usuario=<?php echo $row['id_usuario']; ?>&id_persona=<?php echo $row['id_persona']; ?>">Eliminar</a></td>
                                                </tr>
                                            <?php } 
                
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </main>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Ofertante</h5>
                                    <a class="btn-close" aria-label="Close" href="ofertantes.php" role="button"></a>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="ofertantes.php" method="POST">
                                                
                                        <?php
                                        if (isset($_GET["editar"])) {

                                            $id_usuario = $_GET["editar"];
                                            $sql = "select id_usuario, email, password, rol, usuario.estado, persona.id_persona, nombres, apellidos, fecha_nacimiento, numero_documento, tipo_documento from usuario inner join persona on usuario.id_persona = persona.id_persona where usuario.id_usuario = $id_usuario;";

                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                                <input type="text" value="true" name="editar" hidden>
                                                <input type="text" value="<?php echo $row['id_usuario']; ?>" name="id_usuario" hidden>
                                                <input type="text" value="<?php echo $row['id_persona']; ?>" name="id_persona" hidden>
                                                <div class="col-md-4">
                                                    <label for="inputEmail4" class="form-label">Nombres</label>
                                                    <input type="text" name="nombres" value="<?php echo $row['nombres']; ?>" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputPassword4" class="form-label">Apellidos</label>
                                                    <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputPassword4" class="form-label">Fecha Nacimiento</label>
                                                    <input type="date" name="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Email</label>
                                                    <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Contraseña</label>
                                                    <input type="password" name="password" value="<?php echo $row['password']; ?>" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputState" class="form-label">Tipo de documento</label>
                                                    <select id="inputState" name="tipo_documento" class="form-select">
                                                        <option value="CC" <?php if ($row['tipo_documento'] == "CC") echo "selected"; ?>>Cédula de ciudadanía</option>
                                                        <option value="TI" <?php if ($row['tipo_documento'] == "TI") echo "selected"; ?>>Tarjeta de identidad</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Número documento</label>
                                                    <input type="number" name="numero_documento" value="<?php echo $row['numero_documento']; ?>" class="form-control" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputState" class="form-label">Rol</label>
                                                    <select id="inputState" name="rol" class="form-select">
                                                        <option value="Ofertante" selected>Ofertante</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputState" class="form-label">Estado</label>
                                                    <select id="inputState" name="estado" class="form-select">
                                                        <option value="1" <?php if ($row['estado'] == "1") echo "selected"; ?>>Activo</option>
                                                        <option value="0" <?php if ($row['estado'] == "0") echo "selected"; ?>>Inactivo</option>
                                                    </select>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>

                                            <input type="text" value="true" name="agregar" hidden>
                                            <div class="col-md-4">
                                                <label for="inputEmail4" class="form-label">Nombres</label>
                                                <input type="text" name="nombres" class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputPassword4" class="form-label">Apellidos</label>
                                                <input type="text" name="apellidos" class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputPassword4" class="form-label">Fecha Nacimiento</label>
                                                <input type="date" name="fecha_nacimiento" class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword4" class="form-label">Contraseña</label>
                                                <input type="password" name="password" class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">Tipo de documento</label>
                                                <select id="inputState" name="tipo_documento" class="form-select">
                                                    <option value="CC" selected>Cédula de ciudadanía</option>
                                                    <option value="TI">Tarjeta de identidad</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword4" class="form-label">Número documento</label>
                                                <input type="number" name="numero_documento" class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">Rol</label>
                                                <select id="inputState" name="rol" class="form-select">
                                                    <option value="Ofertante" selected>Ofertante</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">Estado</label>
                                                <select id="inputState" name="estado" class="form-select">
                                                    <option value="1" selected>Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>

                                        <?php } ?>
                                        <div class="modal-footer">
                                            <a class="btn btn-secondary" href="ofertantes.php" role="button">Cerrar</a>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            <?php

            } else {

                header("Location: index.php");

                exit();
            }
            ?>

        </div>
    </div>


</body>

<script>
    let url = window.location.search;
    let getUrl = new URLSearchParams(url);
    if (getUrl.get('editar') != null) {
        console.log("editar");
        var modal = document.getElementById('modal');
        modal.click();

    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>