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
      //$_SESSION['rol'] == 'Administrador'
      if ($_SESSION['rol'] == 'Administrador') {
        date_default_timezone_set("America/Bogota");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST["agregar"])) {
            $id_categoria = validate($_POST["id_categoria"]);

            $id_persona = validate($_POST["id_persona"]);

            $nombre = validate($_POST["nombre"]);

            $descripcion = validate($_POST["descripcion"]);

            $precio = validate($_POST["precio"]);
            $fecha = date("y-m-d h:i:sa");
            $fecha_publicacion = $fecha;
            $fecha_modificacion = $fecha;
            $estado = validate($_POST["estado"]);


            $sql = "insert into servicio 
            (id_categoria, id_persona, nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, estado)
            values
            ($id_categoria, $id_persona, '$nombre', '$descripcion', $precio, '$fecha_publicacion', '$fecha_modificacion', $estado);";

            $result = mysqli_query($conn, $sql);

            if ($result == true) {

              header("Location: servicios_admin.php?alert=1");

              exit();
            }
          } else if (isset($_POST["editar"])) {
            $id_servicio = validate($_POST["id_servicio"]);
            $id_categoria = validate($_POST["id_categoria"]);

            $id_persona = validate($_POST["id_persona"]);

            $nombre = validate($_POST["nombre"]);

            $descripcion = validate($_POST["descripcion"]);

            $precio = validate($_POST["precio"]);


            $fecha_modificacion = date("y-m-d h:i:sa");
            $estado = validate($_POST["estado"]);


            $sql = "update servicio
            set id_categoria = $id_categoria, id_persona = $id_persona, nombre = '$nombre', descripcion = '$descripcion', precio = $precio, fecha_modificacion = '$fecha_modificacion', estado = $estado
            where id_servicio = $id_servicio;";

            $result = mysqli_query($conn, $sql);

            if ($result == true) {

              header("Location: servicios_admin.php?alert=2");

              exit();
            }
          }
        } else {
          if (isset($_GET["eliminar"])) {

            $id_servicio = validate($_GET["eliminar"]);
            $fecha_modificacion = date("y-m-d h:i:sa");

            $sql = "update servicio
            set estado = 0, fecha_modificacion = '$fecha_modificacion'
            where id_servicio = $id_servicio;";

            $result = mysqli_query($conn, $sql);

            if ($result == true) {

              header("Location: servicios_admin.php?alert=3");

              exit();
            }
          }
        }

        $sql = "select servicio.id_servicio, servicio.id_categoria, categoria.nombre as categoria, servicio.id_persona, persona.nombres, persona.apellidos, servicio.nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, servicio.estado, id_calificacion, porcentaje, fecha, calificacion.estado from servicio inner join categoria on servicio.id_categoria = categoria.id_categoria left join calificacion on servicio.id_servicio = calificacion.id_servicio inner join persona on servicio.id_persona = persona.id_persona order by servicio.id_servicio desc;";
        $sql2 = "select persona.id_persona, nombres, apellidos from persona inner join usuario on persona.id_persona = usuario.id_persona where usuario.rol = 'Ofertante' and usuario.estado = 1;";
        $sql3 = "select * from categoria where estado = 1;";
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);
        $result3 = mysqli_query($conn, $sql3);

      ?>

        <?php
        if (isset($_GET["alert"])) {

          switch ($_GET["alert"]) {
            case '1':
              echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha registrado correctamente el servicio',  
                            })
                    </script>";
              break;
            case '2':
              echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha modificado correctamente el servicio',  
                            })
                    </script>";
              break;
            case '3':
              echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha eliminado correctamente el servicio',  
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
          @import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");

          /* This pen */
          body {
            font-family: "Baloo 2", cursive;
            font-size: 16px;
            color: #ffffff;
            text-rendering: optimizeLegibility;
            font-weight: initial;
          }

          .dark {
            background: #110f16;
          }

          .light {
            background: #f3f5f7;
          }

          a,
          a:hover {
            text-decoration: none;
            transition: color 0.3s ease-in-out;
          }

          #pageHeaderTitle {
            margin: 2rem 0;
            text-transform: uppercase;
            text-align: center;
            font-size: 2.5rem;
          }

          /* Cards */
          .postcard {
            flex-wrap: wrap;
            display: flex;
            box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
            border-radius: 10px;
            margin: 0 0 2rem 0;
            overflow: hidden;
            position: relative;
            color: #ffffff;
          }

          .postcard.dark {
            background-color: #18151f;
          }

          .postcard.light {
            background-color: #e1e5ea;
          }

          .postcard .t-dark {
            color: #18151f;
          }

          .postcard a {
            color: inherit;
          }

          .postcard h1,
          .postcard .h1 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
          }

          .postcard .small {
            font-size: 80%;
          }

          .postcard .postcard__title {
            font-size: 1.75rem;
          }

          .postcard .postcard__img {
            max-height: 180px;
            width: 100%;
            object-fit: cover;
            position: relative;
          }

          .postcard .postcard__img_link {
            display: contents;
          }

          .postcard .postcard__bar {
            width: 50px;
            height: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #424242;
            transition: width 0.2s ease;
          }

          .postcard .postcard__text {
            padding: 1.5rem;
            position: relative;
            display: flex;
            flex-direction: column;
          }

          .postcard .postcard__preview-txt {
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: justify;
            height: 100%;
          }

          .postcard .postcard__tagbox {
            display: flex;
            flex-flow: row wrap;
            font-size: 14px;
            margin: 20px 0 0 0;
            padding: 0;
            justify-content: center;
          }

          .postcard .postcard__tagbox .tag__item {
            display: inline-block;
            background: rgba(83, 83, 83, 0.4);
            border-radius: 3px;
            padding: 2.5px 10px;
            margin: 0 5px 5px 0;
            cursor: default;
            user-select: none;
            transition: background-color 0.3s;
          }

          .postcard .postcard__tagbox .tag__item:hover {
            background: rgba(83, 83, 83, 0.8);
          }

          .postcard:before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: linear-gradient(-70deg, #424242, transparent 50%);
            opacity: 1;
            border-radius: 10px;
          }

          .postcard:hover .postcard__bar {
            width: 100px;
          }

          @media screen and (min-width: 769px) {
            .postcard {
              flex-wrap: inherit;
            }

            .postcard .postcard__title {
              font-size: 2rem;
            }

            .postcard .postcard__tagbox {
              justify-content: start;
            }

            .postcard .postcard__img {
              max-width: 300px;
              max-height: 100%;
              transition: transform 0.3s ease;
            }

            .postcard .postcard__text {
              padding: 3rem;
              width: 100%;
            }

            .postcard .media.postcard__text:before {
              content: "";
              position: absolute;
              display: block;
              background: #18151f;
              top: -20%;
              height: 130%;
              width: 55px;
            }

            .postcard:hover .postcard__img {
              transform: scale(1.1);
            }

            .postcard:nth-child(2n+1) {
              flex-direction: row;
            }

            .postcard:nth-child(2n+0) {
              flex-direction: row-reverse;
            }

            .postcard:nth-child(2n+1) .postcard__text::before {
              left: -12px !important;
              transform: rotate(4deg);
            }

            .postcard:nth-child(2n+0) .postcard__text::before {
              right: -12px !important;
              transform: rotate(-4deg);
            }
          }

          @media screen and (min-width: 1024px) {
            .postcard__text {
              padding: 2rem 3.5rem;
            }

            .postcard__text:before {
              content: "";
              position: absolute;
              display: block;
              top: -20%;
              height: 130%;
              width: 55px;
            }

            .postcard.dark .postcard__text:before {
              background: #020024;
            }

            .postcard.light .postcard__text:before {
              background: #e1e5ea;
            }
          }

          /* COLORS */
          .postcard .postcard__tagbox .green.play:hover {
            background: #79dd09;
            color: black;
          }

          .green .postcard__title:hover {
            color: #79dd09;
          }

          .green .postcard__bar {
            background-color: #79dd09;
          }

          .green::before {
            background-image: linear-gradient(-30deg, rgba(121, 221, 9, 0.1), transparent 50%);
          }

          .green:nth-child(2n)::before {
            background-image: linear-gradient(30deg, rgba(121, 221, 9, 0.1), transparent 50%);
          }

          .postcard .postcard__tagbox .blue.play:hover {
            background: #0076bd;
          }

          .blue .postcard__title:hover {
            color: #0076bd;
          }

          .blue .postcard__bar {
            background-color: #0076bd;
          }

          .blue::before {
            background-image: linear-gradient(-30deg, rgba(0, 118, 189, 0.1), transparent 50%);
          }

          .blue:nth-child(2n)::before {
            background-image: linear-gradient(30deg, rgba(0, 118, 189, 0.1), transparent 50%);
          }

          .postcard .postcard__tagbox .red.play:hover {
            background: #bd150b;
          }

          .red .postcard__title:hover {
            color: #bd150b;
          }

          .red .postcard__bar {
            background-color: #bd150b;
          }

          .red::before {
            background-image: linear-gradient(-30deg, rgba(189, 21, 11, 0.1), transparent 50%);
          }

          .red:nth-child(2n)::before {
            background-image: linear-gradient(30deg, rgba(189, 21, 11, 0.1), transparent 50%);
          }

          .postcard .postcard__tagbox .yellow.play:hover {
            background: #bdbb49;
            color: black;
          }

          .yellow .postcard__title:hover {
            color: #bdbb49;
          }

          .yellow .postcard__bar {
            background-color: #bdbb49;
          }

          .yellow::before {
            background-image: linear-gradient(-30deg, rgba(189, 187, 73, 0.1), transparent 50%);
          }

          .yellow:nth-child(2n)::before {
            background-image: linear-gradient(30deg, rgba(189, 187, 73, 0.1), transparent 50%);
          }

          @media screen and (min-width: 769px) {
            .green::before {
              background-image: linear-gradient(-80deg, rgba(121, 221, 9, 0.1), transparent 50%);
            }

            .green:nth-child(2n)::before {
              background-image: linear-gradient(80deg, rgba(121, 221, 9, 0.1), transparent 50%);
            }

            .blue::before {
              background-image: linear-gradient(-80deg, rgba(0, 118, 189, 0.1), transparent 50%);
            }

            .blue:nth-child(2n)::before {
              background-image: linear-gradient(80deg, rgba(0, 118, 189, 0.1), transparent 50%);
            }

            .red::before {
              background-image: linear-gradient(-80deg, rgba(189, 21, 11, 0.1), transparent 50%);
            }

            .red:nth-child(2n)::before {
              background-image: linear-gradient(80deg, rgba(189, 21, 11, 0.1), transparent 50%);
            }

            .yellow::before {
              background-image: linear-gradient(-80deg, rgba(189, 187, 73, 0.1), transparent 50%);
            }

            .yellow:nth-child(2n)::before {
              background-image: linear-gradient(80deg, rgba(189, 187, 73, 0.1), transparent 50%);
            }
          }
        </style>

        <style>
          .star-wrapper {
            display: contents;
          }

          .star-wrapper a {
            font-size: 0.7em;
            color: #fff;
            text-decoration: none;
            transition: all 0.5s;
            margin: 4px;
          }

          .star-wrapper a:hover {
            color: gold;
            transform: scale(1.3);
          }

          .s {
            color: gold !important;
          }

          .s1:hover~a {
            color: gold;
          }

          .s2:hover~a {
            color: gold;
          }

          .s3:hover~a {
            color: gold;
          }

          .s4:hover~a {
            color: gold;
          }

          .s5:hover~a {
            color: gold;
          }

          .wraper {
            position: absolute;
            bottom: 30px;
            right: 50px;
          }
        </style>


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
                  <div class="d-grid gap-2 pb-3">
                    <button class="btn btn-primary" type="button" id="modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Servicio</button>
                  </div>

                  <section class="">
                    <div class="container">


                      <?php
                      while ($row = mysqli_fetch_array($result)) {
                      ?>
                        <article class="postcard dark red" style="background: linear-gradient(90deg, rgba(2,0,36,1) 43%, rgba(52,12,108,1) 71%);">
                          <a class="postcard__img_link" href="#">
                            <img class="postcard__img" src="https://picsum.photos/501/500" alt="Image Title" />
                          </a>
                          <div class="postcard__text">
                            <h1 class="postcard__title red">
                              <?php
                              echo $row['nombre'];
                              $id_servicio = $row['id_servicio'];
                              $sql4 = "select AVG(porcentaje) from calificacion where id_servicio = $id_servicio";
                              $result4 = mysqli_query($conn, $sql4);

                              ?> -
                              <?php
                              while ($row5 = mysqli_fetch_array($result4)) {
                                $estrellas = 0;
                                if ($row5['AVG(porcentaje)'] >= 1 && $row5['AVG(porcentaje)'] < 2) {
                                  $estrellas = 1;
                                } else if ($row5['AVG(porcentaje)'] >= 2 && $row5['AVG(porcentaje)'] < 3) {
                                  $estrellas = 2;
                                } else if ($row5['AVG(porcentaje)'] >= 3 && $row5['AVG(porcentaje)'] < 4) {
                                  $estrellas = 3;
                                } else if ($row5['AVG(porcentaje)'] >= 4 && $row5['AVG(porcentaje)'] < 5) {
                                  $estrellas = 4;
                                } elseif ($row5['AVG(porcentaje)'] >= 5) {
                                  $estrellas = 5;
                                }
                              ?>
                                <div class="star-wrapper">
                                  <a href="#" class="fas fa-star <?php if ($estrellas > 0) {
                                                                    echo "s";
                                                                    $estrellas = $estrellas - 1;
                                                                  } ?>"></a>
                                  <a href="#" class="fas fa-star <?php if ($estrellas > 0) {
                                                                    echo "s";
                                                                    $estrellas = $estrellas - 1;
                                                                  } ?>"></a>
                                  <a href="#" class="fas fa-star <?php if ($estrellas > 0) {
                                                                    echo "s";
                                                                    $estrellas = $estrellas - 1;
                                                                  } ?>"></a>
                                  <a href="#" class="fas fa-star <?php if ($estrellas > 0) {
                                                                    echo "s";
                                                                    $estrellas = $estrellas - 1;
                                                                  } ?>"></a>
                                  <a href="#" class="fas fa-star <?php if ($estrellas > 0) {
                                                                    echo "s";
                                                                    $estrellas = $estrellas - 1;
                                                                  } ?>"></a>
                                </div>
                              <?php } ?>
                            </h1>
                            <div class="postcard__subtitle small">
                              <time datetime="2020-05-25">
                                <i class="fas fa-calendar-alt mr-2"></i><?php echo $row['fecha_publicacion']; ?>
                              </time>
                            </div>
                            <div class="postcard__bar"></div>
                            <div class="postcard__preview-txt"><?php echo $row['descripcion']; ?></div>
                            <ul class="postcard__tagbox">
                              <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></li>
                              <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $row['categoria']; ?></li>
                              <li class="tag__item"><i class="fas fa-clock mr-2"></i><?php echo $row['precio']; ?> COP</li>
                              <li class="tag__item play red">
                                <a href="servicios_admin.php?editar=<?php echo $row['id_servicio']; ?>"><i class="fas fa-play mr-2"></i>EDITAR</a>
                              </li>
                              <li class="tag__item play red">
                                <a href="servicios_admin.php?eliminar=<?php echo $row['id_servicio']; ?>"><i class="fas fa-play mr-2"></i>ELIMINAR</a>
                              </li>
                            </ul>
                          </div>
                        </article>
                      <?php } ?>
                    </div>
                  </section>
                </div>
              </main>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                  <form class="row g-3" action="servicios_admin.php" method="POST">
                    <?php
                    if (isset($_GET["editar"])) {

                      $id_servicio = $_GET["editar"];
                      $sql = "select servicio.id_servicio, servicio.id_categoria, categoria.nombre, servicio.id_persona, persona.nombres, persona.apellidos, servicio.nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, servicio.estado, id_calificacion, porcentaje, fecha, calificacion.estado as estado_calificacion from servicio inner join categoria on servicio.id_categoria = categoria.id_categoria left join calificacion on servicio.id_servicio = calificacion.id_servicio inner join persona on servicio.id_persona = persona.id_persona where servicio.id_servicio = $id_servicio;";

                      $result = mysqli_query($conn, $sql);

                      while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <input type="text" value="true" name="editar" hidden>
                        <input type="text" value="<?php echo $row['id_servicio']; ?>" name="id_servicio" hidden>
                        <div class="col-md-6">
                          <label for="inputEmail4" class="form-label">Nombre</label>
                          <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-6">
                          <label for="inputPassword4" class="form-label">Descripcion</label>
                          <input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>" class="form-control" id="inputPassword4">
                        </div>


                        <div class="col-md-6">
                          <label for="inputState" class="form-label">Ofertante</label>
                          <select id="inputState" name="id_persona" class="form-select">
                            <?php
                            while ($row2 = mysqli_fetch_array($result2)) {
                            ?>
                              <option value="<?php echo $row2["id_persona"]; ?>" <?php if ($row['id_persona'] == $row2["id_persona"]) echo "selected"; ?>><?php echo $row2["nombres"]; ?> <?php echo $row2["apellidos"]; ?></option>
                            <?php } ?>
                          </select>

                        </div>
                        <div class="col-md-6">
                          <label for="inputPassword4" class="form-label">Precio</label>
                          <input type="number" name="precio" value="<?php echo $row['precio']; ?>" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-md-6">
                          <label for="inputState" class="form-label">Categoria</label>
                          <select id="inputState" name="id_categoria" class="form-select">
                            <?php
                            while ($row3 = mysqli_fetch_array($result3)) {
                            ?>
                              <option value="<?php echo $row3["id_categoria"]; ?>" <?php if ($row['id_categoria'] == $row3["id_categoria"]) echo "selected"; ?>><?php echo $row3["nombre"]; ?></option>
                            <?php } ?>
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
                      <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="inputEmail4">
                      </div>
                      <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Descripcion</label>
                        <input type="text" name="descripcion" class="form-control" id="inputPassword4">
                      </div>


                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Ofertante</label>
                        <select id="inputState" name="id_persona" class="form-select">
                          <?php
                          while ($row = mysqli_fetch_array($result2)) {
                          ?>
                            <option value="<?php echo $row["id_persona"]; ?>"><?php echo $row["nombres"]; ?> <?php echo $row["apellidos"]; ?></option>
                          <?php } ?>
                        </select>

                      </div>
                      <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" id="inputPassword4">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Categoria</label>
                        <select id="inputState" name="id_categoria" class="form-select">
                          <?php
                          while ($row = mysqli_fetch_array($result3)) {
                          ?>
                            <option value="<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></option>
                          <?php } ?>
                        </select>

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
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
<script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>