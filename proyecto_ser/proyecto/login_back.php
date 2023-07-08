<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if (empty($email)) {

        header("Location: login.php?error=Email is required");

        exit();

    }else if(empty($pass)){

        header("Location: login.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT id_usuario, email, password, rol, usuario.estado, persona.id_persona, persona.nombres, persona.apellidos FROM usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona WHERE email='$email' AND password='$pass' AND usuario.estado=1";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $email && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['rol'] = $row['rol'];

                $_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['id_persona'] = $row['id_persona'];
                $_SESSION['nombre'] = $row['nombres'] . " " . $row['apellidos'];

                header("Location: index.php");

                exit();

            }else{

                header("Location: login.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: login.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: login.php");

    exit();

}

?>