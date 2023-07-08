<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
</head>

<body>
    <style>
        .txt-white{
            color: white!important;
        }
        .active-item{
            background-color: #19003a!important;
        }
        .full-sidebar{
            height: auto;
        }

        @media (min-width: 768px) {
            .full-sidebar {
                height: 100vh;
            }
        }

    </style>
    <aside class="col-12 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 pb-3 full-sidebar">
        <div class="border rounded-3 p-4 sticky-top" style="background-color: rgb(52 12 108); height: inherit;">
            <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                <li class="nav-item">
                    <a href="#" class="nav-link text-center" aria-current="page">
                        <img src="./img/logo.png" alt="SER LOGO" class="img-fluid" style="width: 30%;">
                    </a>
                </li>
                <?php
                if ($_SESSION['rol'] == "Administrador") { ?>
                    <li class="nav-item">
                        <a href="contratistas.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'contratistas.php') echo "active-item"; ?> p-3 text-truncate txt-white">
                            <i class="fas fa-calendar"></i>
                            <span class="d-none d-sm-inline">Contratistas</span>
                        </a>
                    </li>
                    <li>
                        <a href="ofertantes.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'ofertantes.php') echo "active-item"; ?> p-3 text-truncate txt-white">
                            <i class="fas fa-calendar"></i>
                            <span class="d-none d-sm-inline">Ofertantes</span>
                        </a>
                    </li>
                    <li>
                        <a href="categorias.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'categorias.php') echo "active-item"; ?> p-3 text-truncate txt-white"><i class="bi bi-card-text fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Categorías</span> </a>
                    </li>
                    <li>
                        <a href="servicios_admin.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'servicios_admin.php') echo "active-item"; ?> p-3 text-truncate txt-white"><i class="bi bi-bricks fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Servicios admin</span> </a>
                    </li>
                    <li>
                        <a href="chat_admin.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'chat_admin.php') echo "active-item"; ?> p-3 text-truncate txt-white"><i class="bi bi-people fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Chat admin</span> </a>
                    </li>
                <?php
                }

                if ($_SESSION['rol'] == "Contratista") {
                ?>
                    <li>
                        <a href="servicios_contratista.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'servicios_contratista.php') echo "active-item"; ?> p-3 text-truncate txt-white"><i class="bi bi-people fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Servicios contratista</span> </a>
                    </li>
                    <li>
                        <a href="chat_contratista.php" class="nav-link p-3 <?php if(basename($_SERVER['REQUEST_URI']) == 'chat_contratista.php') echo "active-item"; ?> text-truncate txt-white"><i class="bi bi-people fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Chat contratista</span> </a>
                    </li>
                <?php
                }

                if ($_SESSION['rol'] == "Ofertante") {
                ?>
                    <li>
                        <a href="portafolio.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'portafolio.php') echo "active-item"; ?> p-3 text-truncate txt-white"><i class="bi bi-people fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Mi portafolio</span> </a>
                    </li>
                    <li>
                        <a href="chat_ofertante.php" class="nav-link <?php if(basename($_SERVER['REQUEST_URI']) == 'chat_ofertante.php') echo "active-item"; ?> p-3 text-truncate txt-white"><i class="bi bi-people fs-5"></i>
                        <i class="fas fa-calendar"></i>    
                        <span class="d-none d-sm-inline">Chat ofertante</span> </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </aside>
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>