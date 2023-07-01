<?php

include('conexion.php');


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  </head>
  <body>
    <form action="conexion.php" method="post">
      <h1><center>calificacion de servicio</center></h1>
      <div class="col-12"><br>
        <div class="card">
          <div class="card-header">
            <h2><center>calificacion por estrellas</center></h2>
            <h5 class="card-title"><center>calificar</center></h5>
            <p><center>Muchas Gracias por prestar el servicio solicitado, para volver <br>
              a ser contratado realice la calificacion de experiencia GRACIAS.</center></p>
            <br>
          </div>
          <div class="card-body">
            <div class="col-12" style="text-align: center;">
              <table class="table" id="tabla_calificacion">
                <thead class="thead-dark">

                  <tr>
                    <th>#</th>
                    <th>nombre contratista</th>
                    <th>calificacion</th>
                    <th>Accion</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <th>
                       <h3>fecha</h3>
                       <label for="fechar">Ingrese la fecha de hoy</label>
                       <input type="text" id="fechar" name="fechar" class="table" />
                    </th>
                  </tr>
                  <tr>
                    <th>
                      <h3>nombre de oferente de servicio</h3>
                      <label for="nombre_oferente_de_servicio">Ingrese el nombre del oferente de servicio</label>
                      <input type="text" id="nombre_oferente_de_servicio" name="nombre_oferente_de_servicio" class="table"/>  
                    </th>
                  </tr>
                  <tr>
                    <th>
                      <h3>servicio solicitado</h3>
                      <label for="servicio_solicitado">Ingrese el servicio solicitado</label>
                      <input type="text" id="servicio_solicitado" name="servicio_solicitado" class="table" />
                    </th>
                  </tr>
                  <tr>
                    <th>
                      <h3>Nombre contratista</h3>
                      <label for="nombre_contratista">Ingrese el nombre del contratista</label>
                      <input type="text" id="nombre_contratista" name="nombre_contratista" class="table" />
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <input type="hidden" id="calificacion" name="calificacion" />
                      <span class="fa fa-star" onclick="calificar(1)" style="cursor: pointer;" id="1star"></span>
                      <span class="fa fa-star" onclick="calificar(2)" style="cursor: pointer;" id="2star"></span>
                      <span class="fa fa-star" onclick="calificar(3)" style="cursor: pointer;" id="3star"></span>
                      <span class="fa fa-star" onclick="calificar(4)" style="cursor: pointer;" id="4star"></span>
                      <span class="fa fa-star" onclick="calificar(5)" style="cursor: pointer;" id="5star"></span>
                    </td>
                    <td><br><button type="button" class="btn btn-primary" onclick="mensaje()" style="background-color: #572862;">Calificar</button><br></td>
                    <td><br><button type="submit" class="btn btn-primary" style="background-color: #572862;">Enviar calificacion</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+YtoA5S9gX6H5u1/4j+4szr8uE4Wh/N1yN1sVRVo4r7Lq5s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+YD9M6D7W1E6kFpB4gFaB8AEpL6a6Wu4yTj4pjy611jwli1r1QD8w3X8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      function calificar(calificacion) {
        document.getElementById("calificacion").value = calificacion;
        for (let i = 1; i <= 5; i++) {
          const star = document.getElementById(i + "star");
          if (i <= calificacion) {
            star.classList.add("checked");
          } else {
            star.classList.remove("checked");
          }
        }
      }

      function mensaje() {
        alert("¡Calificación enviada!");
      }
    </script>
  </body>
</html>