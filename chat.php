<?php
include "db_conn.php";

if (isset($_GET["id_chat"]) && !empty($_GET["id_chat"])) {
    if(isset($_GET["rol"])){
        $rol = $_GET["rol"]; 
    }else{
        $rol = 'Ofertante';
    }
    
    $id_chat = $_GET["id_chat"];
    $sql = "select id_conversacion, conversacion.id_persona, conversacion.id_chat, fecha, mensaje, persona.nombres, servicio.nombre from conversacion inner join persona on conversacion.id_persona = persona.id_persona inner join chat on conversacion.id_chat = chat.id_chat inner join servicio on chat.id_servicio = servicio.id_servicio where conversacion.id_chat = $id_chat;";
    $sql2 = "select persona.id_persona from conversacion inner join persona on conversacion.id_persona = persona.id_persona inner join usuario on persona.id_persona = usuario.id_persona where conversacion.id_chat = $id_chat and usuario.rol = '$rol';";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $id_persona_reference = "";
    
    while ($row = mysqli_fetch_array($result2)) {
        $id_persona_reference = $row["id_persona"];
    }


    while ($row = mysqli_fetch_array($result)) {
        if ($id_persona_reference == $row["id_persona"]) {


?>
            <div class="message-feed right">
                <div class="pull-right">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt class="img-avatar">
                </div>
                <div class="media-body">
                    <div class="mf-content"><?php echo $row['mensaje']; ?></div>
                    <small class="mf-date"><i class="fa fa-clock-o"></i> <?php echo $row['fecha']; ?></small>
                </div>
            </div>
        <?php
        } else {


        ?>
            <div class="message-feed left">
                <div class="pull-left">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="img-avatar">
                </div>
                <div class="media-body">
                    <div class="mf-content"><?php echo $row['mensaje']; ?></div>
                    <small class="mf-date"><i class="fa fa-clock-o"></i> <?php echo $row['fecha']; ?></small>
                </div>
            </div>
<?php
        }
    }
}else{


?>



<?php
}
?>