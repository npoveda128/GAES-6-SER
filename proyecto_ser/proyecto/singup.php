<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <style>
        body {
            font-family: "Karla", sans-serif;
            background-color: #d0d0ce;
            min-height: 100vh;
        }

        .brand-wrapper {
            margin-bottom: 19px;
        }

        .brand-wrapper .logo {
            height: 37px;
        }

        .login-card {
            border: 0;
            border-radius: 27.5px;
            box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
            overflow: hidden;
        }

        .login-card-img {
            border-radius: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .login-card .card-body {
            padding: 85px 60px 60px;
        }

        @media (max-width: 422px) {
            .login-card .card-body {
                padding: 35px 24px;
            }
        }

        .login-card-description {
            font-size: 25px;
            color: #000;
            font-weight: normal;
            margin-bottom: 23px;
        }



        .login-card .form-control {
            border: 1px solid #d5dae2;
            padding: 15px 25px;
            margin-bottom: 20px;
            min-height: 45px;
            font-size: 13px;
            line-height: 15;
            font-weight: normal;
        }

        .login-card .form-control::-webkit-input-placeholder {
            color: #919aa3;
        }

        .login-card .form-control::-moz-placeholder {
            color: #919aa3;
        }

        .login-card .form-control:-ms-input-placeholder {
            color: #919aa3;
        }

        .login-card .form-control::-ms-input-placeholder {
            color: #919aa3;
        }

        .login-card .form-control::placeholder {
            color: #919aa3;
        }

        .login-card .login-btn {
            padding: 13px 20px 12px;
            background-color: #000;
            border-radius: 4px;
            font-size: 17px;
            font-weight: bold;
            line-height: 20px;
            color: #fff;
            margin-bottom: 24px;
        }

        .login-card .login-btn:hover {
            border: 1px solid #000;
            background-color: transparent;
            color: #000;
        }

        .login-card .forgot-password-link {
            font-size: 14px;
            color: #919aa3;
            margin-bottom: 12px;
        }

        .login-card-footer-text {
            font-size: 16px;
            color: #0d2366;
            margin-bottom: 60px;
        }

        @media (max-width: 767px) {
            .login-card-footer-text {
                margin-bottom: 24px;
            }
        }

        .login-card-footer-nav a {
            font-size: 14px;
            color: #919aa3;
        }

        .footer-link {
            position: absolute;
            bottom: 1rem;
            text-align: center;
            width: 100%;
        }

        /*# sourceMappingURL=login.css.map */
    </style>

    <?php

    include "db_conn.php";

    $fullname = $email = $gender = $comment = $age = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombres = validate($_POST["nombres"]);

        $apellidos = validate($_POST["apellidos"]);

        $email = validate($_POST["email"]);

        $password = validate($_POST["password"]);

        $fecha_nacimiento = validate($_POST["fecha_nacimiento"]);

        $tipo_documento = validate($_POST["tipo_documento"]);
        $numero_documento = validate($_POST["numero_documento"]);
        $rol = validate($_POST["rol"]);


        $sql = "insert into persona 
    (nombres, apellidos, fecha_nacimiento, numero_documento, tipo_documento, estado) 
    values 
    ('$nombres', '$apellidos', '$fecha_nacimiento', '$numero_documento', '$tipo_documento', 1);";

        $result = mysqli_query($conn, $sql);

        if ($result == true) {

            $id_persona = $conn->insert_id;

            $sql = "insert into usuario
        (id_persona, email, password, rol, estado)
        values
        ($id_persona, '$email', '$password', '$rol', 1);";

            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Registro exitoso, inicia sesión ahora.',  
              })
    </script>";
            } else {
                echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Ha ocurrido un error creado el usuario.',  
              })
    </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Ha ocurrido un error creado la persona.',  
              })
    </script>";
        }
    }

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;
    }

    ?>


    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0" style="background-color: rgb(52 12 108);">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="https://img.freepik.com/vector-gratis/influencers-ingenuos-disenan-pegatinas_52683-76289.jpg?w=740&t=st=1688771957~exp=1688772557~hmac=baecb9792321a2aae2d8492b53dadbfddf611d16fa2ce1c14b2679824f881944" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="login-card-description">Registrate</p>
                            <form action="singup.php" method="post">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="Nombres" class="sr-only">Nombres</label>
                                            <input type="text" name="nombres" id="Nombres" class="form-control" placeholder="Nombres">
                                        </div>
                                        <div class="col-6">
                                            <label for="Apellidos" class="sr-only">Apellidos</label>
                                            <input type="text" name="apellidos" id="Apellidos" class="form-control" placeholder="Apellidos">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="col-6">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="Nombres" class="sr-only">Tipo de documento</label>
                                            <select name="tipo_documento" id="" class="form-control">
                                                <option value="CC">Cédula de ciudadanía</option>
                                                <option value="TI">Tarjeta de identidad</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="numero_documento" class="sr-only">Número de documento</label>
                                            <input type="number" name="numero_documento" id="numero_documento" class="form-control" placeholder="Número de documento">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="fecha_nacimiento" class="sr-only">Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="fecha">
                                        </div>
                                        <div class="col-6">
                                            <label for="Apellidos" class="sr-only">Rol</label>
                                            <select name="rol" id="" class="form-control">
                                                <option value="Ofertante">Ofertante</option>
                                                <option value="Contratista">Contratista</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Registrar">
                            </form>
                            <p class="login-card-footer-text">Ya tienes una cuenta? <a href="login.php" class="text-reset">Ingresa aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>