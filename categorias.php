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
                        $nombre = validate($_POST["nombre"]);

                        $estado = validate($_POST["estado"]);




                        $sql = "insert into categoria (nombre, estado) values ('$nombre', $estado);";

                        $result = mysqli_query($conn, $sql);


                        if ($result == true) {
                            header("Location: categorias.php?alert=1");

                            exit();
                        }
                    } else if (isset($_POST["editar"])) {
                        $nombre = validate($_POST["nombre"]);

                        $estado = validate($_POST["estado"]);
                        $id_categoria = validate($_POST["id_categoria"]);


                        $sql = "update categoria
                set nombre = '$nombre', estado = $estado
                where id_categoria = $id_categoria;";

                        $result = mysqli_query($conn, $sql);

                        if ($result == true) {

                            header("Location: categorias.php?alert=2");

                            exit();
                        }
                    }
                } else {
                    if (isset($_GET["eliminar"])) {

                        $id_categoria = validate($_GET["id_categoria"]);


                        $sql = "update categoria
                set estado = 0
                where id_categoria = $id_categoria;";

                        $result = mysqli_query($conn, $sql);

                        if ($result == true) {
                            header("Location: categorias.php?alert=3");

                            exit();
                        }
                    }
                }

                $sql = "select * from categoria;";

                $result = mysqli_query($conn, $sql);

            ?>

                <?php
                if (isset($_GET["alert"])) {

                    switch ($_GET["alert"]) {
                        case '1':
                            echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha registrado correctamente la categoria',  
                            })
                    </script>";
                            break;
                        case '2':
                            echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha modificado correctamente la categoria',  
                            })
                    </script>";
                            break;
                        case '3':
                            echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha eliminado correctamente la categoria',  
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
                                        <button class="btn btn-primary" id="modal" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Categoria</button>
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['nombre']; ?></td>
                                                    <td><?php if ($row['estado'] == 1) echo "Activo";
                                                        else echo "Inactivo"; ?></td>
                                                    <td><a href="categorias.php?editar=<?php echo $row['id_categoria']; ?>">Editar</a> | <a href="categorias.php?eliminar=true&id_categoria=<?php echo $row['id_categoria']; ?>">Eliminar</a></td>
                                                </tr>
                                            <?php } ?>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                                    <a class="btn-close" aria-label="Close" href="categorias.php" role="button"></a>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="categorias.php" method="POST">
                                        <?php
                                        if (isset($_GET["editar"])) {

                                            $id_categoria = $_GET["editar"];
                                            $sql = "select * from categoria where id_Categoria = $id_categoria";

                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                                <input type="text" value="true" name="editar" hidden>
                                                <input type="text" value="<?php echo $row['id_categoria']; ?>" name="id_categoria" hidden>

                                                <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Nombre</label>
                                                    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control" id="inputEmail4">
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
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Nombre</label>
                                                <input type="text" name="nombre" class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputState" class="form-label">Estado</label>
                                                <select id="inputState" name="estado" class="form-select">
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>

                                        <?php } ?>
                                        <div class="modal-footer">
                                            <a class="btn btn-secondary" href="categorias.php" role="button">Cerrar</a>
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