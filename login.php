


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

        .login-card form {
            max-width: 326px;
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
if (isset($_GET['error'])) { 
    $error = $_GET['error'];
    echo "<script>
            Swal.fire({
              icon: 'error',
              title: '$error',  
              })
    </script>"; 
}
    
?>

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0" style="background-color: rgb(52 12 108);">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="https://img.freepik.com/vector-gratis/dibujado-mano-gente-diseno-plano-agitando-ilustracion_23-2149192525.jpg?w=740&t=st=1688763425~exp=1688764025~hmac=a15246f67cf16928bbd88143af6ee9d37cb9bdfe54acfc74ad83dd64aab6d5cb" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="login-card-description">Inicia Sesión</p>
                            <form action="login_back.php" method="post">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Ingresar">
                            </form>
                            <p class="login-card-footer-text">No tienes una cuenta? <a href="singup.php" class="text-reset">Registrate aquí</a></p>
                            <p class="login-card-footer-text"><a href="./principal/index.html" class="text-reset"><-- Regresar</a></p>
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