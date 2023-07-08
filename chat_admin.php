<?php
include "db_conn.php";
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");

    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["eliminar"])) {
        $id_chat = $_GET["eliminar"];
        $sql = "delete from conversacion where id_chat = $id_chat;";

        $result = mysqli_query($conn, $sql);

        if ($result == true) {

            header("Location: chat_admin.php?id_chat=$id_chat");

            exit();
        }
    } else if (isset($_GET["finalizar"])) {
        date_default_timezone_set("America/Bogota");
        $id_servicio = $_GET["id_servicio"];
        $id_chat = $_GET["finalizar"];
        $calificacion = $_GET["calificacion"];
        $fecha = date("y-m-d h:i:sa");
        $sql = "update chat
        set estado = 2
        where id_chat = $id_chat;";

        $result = mysqli_query($conn, $sql);

        if ($result == true) {

            $sql = "insert into calificacion
            (id_servicio, id_chat, porcentaje, fecha, estado)
            values
            ($id_servicio, $id_chat, $calificacion, '$fecha', 1);";

            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                header("Location: chat_admin.php?id_chat=$id_chat&alert=1");

                exit();
            }
        }
    } else if (isset($_GET["bloquear"])) {
        $id_chat = $_GET["bloquear"];
        $sql = "update chat
        set estado = 3
        where id_chat = $id_chat;";

        $result = mysqli_query($conn, $sql);

        if ($result == true) {

            header("Location: chat_admin.php?id_chat=$id_chat");

            exit();
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>messages like material design - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: Roboto, sans-serif;
            font-size: 13px;
            line-height: 1.42857143;
            color: #767676;
            background-color: #edecec;
        }

        #messages-main {
            position: relative;
            margin: 0 auto;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        #messages-main:after,
        #messages-main:before {
            content: " ";
            display: table;
        }

        #messages-main .ms-menu {

            left: 0;
            top: 0;
            border-right: 1px solid #eee;
            padding-bottom: 50px;
            height: 100%;

            background: #fff;
        }

        @media (min-width:768px) {
            #messages-main .ms-body {}
        }

        @media (max-width:767px) {
            #messages-main .ms-menu {
                height: calc(100% - 58px);
                display: none;
                z-index: 1;
                top: 58px;
            }

            #messages-main .ms-menu.toggled {
                display: block;
            }

            #messages-main .ms-body {
                overflow: hidden;
            }
        }

        #messages-main .ms-user {
            padding: 15px;
            background: rgb(52 12 108);
        }

        #messages-main .ms-user>div {
            color: white;
            overflow: hidden;
            padding: 3px 5px 0 15px;
            font-size: 14px;
        }

        #messages-main #ms-compose {
            position: fixed;
            bottom: 120px;
            z-index: 1;
            right: 30px;
            box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
        }

        #ms-menu-trigger {
            user-select: none;
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 100%;
            padding-right: 10px;
            padding-top: 19px;
        }

        #ms-menu-trigger i {
            font-size: 21px;
        }

        #ms-menu-trigger.toggled i:before {
            content: '\f2ea'
        }

        .fc-toolbar:before,
        .login-content:after {
            content: ""
        }

        .message-feed {
            padding: 20px;
        }

        #footer,
        .fc-toolbar .ui-button,
        .fileinput .thumbnail,
        .four-zero,
        .four-zero footer>a,
        .ie-warning,
        .login-content,
        .login-navigation,
        .pt-inner,
        .pt-inner .pti-footer>a {
            text-align: center;
        }

        .message-feed.right>.pull-right {
            margin-left: 15px;
        }

        .message-feed:not(.right) .mf-content {
            background: #03a9f4;
            color: #fff;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .message-feed.right .mf-content {
            background: #eee;
        }

        .mf-content {
            padding: 12px 17px 13px;
            border-radius: 2px;
            display: inline-block;
            max-width: 80%
        }

        .mf-date {
            display: block;
            color: #B3B3B3;
            margin-top: 7px;
        }

        .mf-date>i {
            font-size: 14px;
            line-height: 100%;
            position: relative;
            top: 1px;
        }

        .msb-reply {
            box-shadow: 0 -20px 20px -5px #fff;
            position: relative;
            margin-top: 30px;
            border-top: 1px solid #eee;
            background: #f8f8f8;
        }

        .four-zero,
        .lc-block {
            box-shadow: 0 1px 11px rgba(0, 0, 0, .27);
        }

        .msb-reply textarea {
            width: 100%;
            font-size: 13px;
            border: 0;
            padding: 10px 15px;
            resize: none;
            height: 60px;
            background: 0 0;
        }

        .msb-reply button {
            position: absolute;
            top: 0;
            right: 0;
            border: 0;
            height: 100%;
            width: 60px;
            font-size: 25px;
            color: #2196f3;
            background: 0 0;
        }

        .msb-reply button:hover {
            background: #f2f2f2;
        }

        .img-avatar {
            height: 37px;
            border-radius: 2px;
            width: 37px;
        }

        .list-group.lg-alt .list-group-item {
            border: 0;
        }

        .p-15 {
            padding: 15px !important;
        }

        .btn:not(.btn-alt) {
            border: 0;
        }

        .action-header {
            position: relative;
            background: rgb(52 12 108);
            padding: 15px 13px 15px 17px;
        }

        .ah-actions {
            z-index: 3;
            float: right;
            margin-top: 7px;
            position: relative;
        }

        .actions {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .actions>li {
            display: inline-block;
        }

        .actions:not(.a-alt)>li>a>i {
            color: white;
        }

        .actions>li>a>i {
            font-size: 20px;
        }

        .actions>li>a {
            display: block;
            padding: 0 10px;
        }

        .ms-body {
            background: #fff;
        }

        #ms-menu-trigger {
            user-select: none;
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 100%;
            padding-right: 10px;
            padding-top: 19px;
            cursor: pointer;
        }

        #ms-menu-trigger,
        .message-feed.right {
            text-align: right;
        }

        #ms-menu-trigger,
        .toggle-switch {
            -webkit-user-select: none;
            -moz-user-select: none;
        }
    </style>

    <script>
        function ajax() {

            let url = window.location.search;
            let getUrl = new URLSearchParams(url);

            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('ms-body').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'chat.php?id_chat=' + getUrl.get('id_chat'), true);
            req.send();
        }

        setInterval(function() {
            ajax();
        }, 1000);
    </script>
</head>

<body onload="ajax()">

    <?php
    if (isset($_GET["alert"])) {

        switch ($_GET["alert"]) {
            case '1':
                echo "<script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Se ha finalizado el servicio contratado con exito.',  
                            })
                    </script>";
                break;
            case '2':
                echo "<script>
                
                        </script>";
                break;
            default:
                # code...
                break;
        }
    }
    ?>

    <?php


    //session_start();

    //$_SESSION['rol'] == 'Administrador'
    if ($_SESSION['rol'] == 'Administrador') {

        $sql = "select id_chat, servicio.nombre, fecha_creacion, chat.estado from chat inner join servicio on chat.id_servicio = servicio.id_servicio;";

        $result = mysqli_query($conn, $sql);
    ?>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container-fluid bootstrap snippets bootdey" style="padding-top: 50px;">
            <div class="tile tile-alt" id="messages-main">
                <div class="row">
                    <div class="col-md-3">
                        <div class="ms-menu">
                            <div class="ms-user clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="img-avatar pull-left">
                                <div><?php echo $_SESSION["nombre"]; ?><br> <a href="logout.php" class="__cf_email__" data-cfemail="38551550575454594f5941785f55595154165b5755" style="color: aqua;">Cerrar Sesión</a></div>
                            </div>
                            <div class="p-15">
                                <div class="dropdown">
                                    <a class="btn btn-primary btn-block" href="index.php" role="button">Regresar</a>
                                </div>
                            </div>
                            <div class="list-group lg-alt">
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <a class="list-group-item media" style="background: <?php if ($row["estado"] == 3) echo "antiquewhite";
                                                                                        elseif ($row["estado"] == 2) echo "aliceblue"; ?>;" href="chat_admin.php?id_chat=<?php echo $row['id_chat']; ?>">
                                        <div class="pull-left">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="img-avatar">
                                        </div>
                                        <div class="media-body">
                                            <small class="list-group-item-heading"><?php echo $row['nombre']; ?></small>
                                            <small class="list-group-item-text c-gray"></small>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="ms-body">
                            <div class="action-header clearfix">
                                <div class="visible-xs" id="ms-menu-trigger">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <?php if (isset($_GET["id_chat"]) && !empty($_GET["id_chat"])) { ?>
                                    <div class="pull-left hidden-xs">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="img-avatar m-r-10">
                                        <div class="lv-avatar pull-left">
                                        </div>
                                        <span style="color: white; font-size: 25px; padding-left: 30px;">
                                            <?php


                                            $id_chat = $_GET["id_chat"];
                                            $id_servicio = "";
                                            $sql = "select chat.id_chat, persona.nombres, servicio.nombre, servicio.id_servicio from chat inner join persona_chat on chat.id_chat = persona_chat.id_chat inner join persona on persona_chat.id_persona = persona.id_persona inner join usuario on persona.id_persona = usuario.id_persona inner join servicio on chat.id_servicio = servicio.id_servicio where chat.id_chat = $id_chat and usuario.rol = 'Ofertante';";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo $row["nombres"] . " - " . $row["nombre"];
                                                $id_servicio = $row["id_servicio"];
                                            }


                                            ?>
                                        </span>
                                    </div>
                                    <ul class="ah-actions actions">
                                        <li>
                                            <a href="chat_admin.php?eliminar=<?php echo $id_chat; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="chat_admin.php?alert=2&id_chat=<?php echo $id_chat; ?>&id_servicio=<?php echo $id_servicio; ?>">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="chat_admin.php?bloquear=<?php echo $id_chat; ?>">
                                                <i class="fa fa-clock-o"></i>
                                            </a>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </div>
                            <div id="ms-body">

                            </div>

                            <?php

                            if (isset($_GET["id_chat"]) && !empty($_GET["id_chat"])) {
                                $id_chat = $_GET["id_chat"];
                                $sql = "select chat.estado from chat where id_chat = $id_chat;";

                                $result = mysqli_query($conn, $sql);

                                $estado_reference = "";

                                while ($row = mysqli_fetch_array($result)) {
                                    $estado_reference = $row["estado"];
                                }
                                if ($estado_reference == 1) {
                            ?>
                                    <div class="msb-reply">
                                        <form action="chat_admin.php?id_chat=<?php echo $_GET["id_chat"]; ?>" method="POST">
                                            <input type="text" name="id_persona" value="<?php echo $_SESSION["id_persona"]; ?>" hidden>
                                            <input type="text" name="id_chat" value="<?php echo $_GET["id_chat"]; ?>" hidden>
                                            <textarea name="mensaje" placeholder="What's on your mind..."></textarea>
                                            <button type="submit" name="agregar"><i class="fa fa-paper-plane-o"></i></button>
                                        </form>

                                        <?php
                                        date_default_timezone_set("America/Bogota");

                                        if (isset($_POST["agregar"])) {

                                            $id_persona = $_POST["id_persona"];
                                            $id_chat = $_POST["id_chat"];
                                            $fecha = date("y-m-d h:i:sa");
                                            $mensaje = $_POST["mensaje"];


                                            $sql = "insert into conversacion
                                (id_persona, id_chat, fecha, mensaje)
                                values
                                ($id_persona, $id_chat, '$fecha', '$mensaje');";

                                            $result = mysqli_query($conn, $sql);

                                            if ($result == true) {

                                                //echo "Servicio registrado";
                                            }
                                        }
                                        ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                if ($('#ms-menu-trigger')[0]) {
                    $('body').on('click', '#ms-menu-trigger', function() {
                        $('.ms-menu').toggleClass('toggled');
                    });
                }
            });
        </script>

    <?php
    } else {

        header("Location: index.php");

        exit();
    }
    ?>
</body>

<script>
    let url = window.location.search;
    let getUrl = new URLSearchParams(url);
    let id_servicio = getUrl.get('id_servicio');
    let id_chat = getUrl.get('id_chat');
    if (getUrl.get('alert') != null && getUrl.get('alert') == "2") {
        console.log("calificacion");
        Swal.fire({
            title: 'Califica el servicio contratado',
            html: '<style>label { display: inline-block; padding: 0; cursor: pointer; vertical-align: middle; } label.reset { font-size: 10px; border: 1px solid #000; border-radius: 5px; margin: 10px 5px; padding: 2px 3px; } label.star { width: 30px; height: 27px; } /* ocultamos los radiobuttons */ input[name=rating] { display: none; } /* estrellas inmediatamente despues de un radiobutton van amarillas */ input[type=radio]+label.star svg path { fill: #fe0 } /* estrellas a la derecha del radiobutton checked van blanco */ input[type=radio]:checked~label.star svg path { fill: #fff; }</style><input id=rating0 type=radio value=0 name=rating checked /><label class=star for=rating1><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275"><path stroke="#605a00" stroke-width="15"   d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z"/></svg></label><input id=rating1 type=radio value=1 name=rating /><label class=star for=rating2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275"><path stroke="#605a00" stroke-width="15" d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z"/></svg></label><input id=rating2 type=radio value=2 name=rating /><label class=star for=rating3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275"><path stroke="#605a00" stroke-width="15" d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z"/></svg></label><input id=rating3 type=radio value=3 name=rating /><label class=star for=rating4><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275"><path stroke="#605a00" stroke-width="15" d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z"/></svg></label><input id=rating4 type=radio value=4 name=rating /><label class=star for=rating5><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 275"><path stroke="#605a00" stroke-width="15" d="M150 25l29 86h90l-72 54 26 86-73-51-73 51 26-86-72-54h90z"/></svg></label><input id=rating5 type=radio value=5 name=rating /><label class=reset for=rating0>reset</label>',
            input: 'hidden',
            inputAttributes: {
                autocapitalize: 'off',
                id: 'texto',
            },
            confirmButtonText: 'Enviar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                //return fetch(`chat_admin.php?finalizar=1&calificacion=${login}`)
                window.location.href = `chat_admin.php?finalizar=${id_chat}&id_servicio=${id_servicio}&calificacion=${login}`;
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {

            }
        })
    }
</script>

<script>
    // para todos los radiobutton rating agregar un on change
    const changeRating = document.querySelectorAll('input[name=rating]');
    changeRating.forEach((radio) => {
        radio.addEventListener('change', getRating);
    });

    // buscar el radiobutton checked y armar el texto con el valor ( 0 - 5 )
    function getRating() {
        let estrellas = document.querySelector('input[name=rating]:checked').value;
        document.getElementById("texto").value = (
            0 < estrellas ?
            estrellas  :
            "0"
        );

        // opcionalmente agregar un ajax para guardar el rating
    }
</script>

</html>