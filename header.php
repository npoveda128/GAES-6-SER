<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
</head>

<body>
  <?php

  //session_start();

  if (isset($_SESSION['id_usuario']) && isset($_SESSION['rol'])) {

  ?>

    <header class="py-3 mb-4 border-bottom shadow" style="background-color: rgb(52 12 108);">
      <div class="container-fluid align-items-center d-flex">
        <div class="flex-shrink-1">
          <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none">

          </a>
        </div>
        <div class="flex-grow-1 d-flex align-items-center">
          <div class="w-100 me-3 text-center">
            <h1>
              <span class="badge">
              <?php

switch (basename($_SERVER['REQUEST_URI'])) {
  case 'contratistas.php':
    echo "Contratistas";
    break;
  case 'ofertantes.php':
    echo "Ofertantes";
    break;
  case 'categorias.php':
    echo "Categorias";
    break;
  case 'servicios_admin.php':
    echo "Servicios";
    break;
  case 'chat_admin.php':
    echo "Chat";
    break;
  case 'servicios_contratista.php':
    echo "Servicios";
    break;
  case 'chat_contratista.php':
    echo "Chat";
    break;
  case 'portafolio.php':
    echo "Mi Portafolio";
    break;
  case 'chat_ofertante.php':
    echo "Chat";
    break;
  default:
    
    break;
}
?>
              </span>
              
            </h1>
          </div>
          <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2">
              <li><a class="dropdown-item" href="#"></a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <?php

  } else {

    header("Location: ./principal/index.html");

    exit();
  }

  ?>

</body>

</html>