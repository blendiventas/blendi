<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$darkMode = 0;
$result = $conn->query("SELECT id_usuario, id_terminal FROM usuarios_accesos WHERE sesion='".$id_sesion_sys."' AND activo='1' LIMIT 1");
if($conn->registros() == 1) {
    $id_usuario = $result[0]['id_usuario'];
    $id_terminal_sys = $result[0]['id_terminal'];

    $result = $conn->query("SELECT usuario, avatar, terminal, dark FROM usuarios WHERE id='".$id_usuario."' LIMIT 1");
    if($conn->registros() == 1) {
        $nombre_usuario = stripslashes($result[0]['usuario']);
        $avatar_usuario = $result[0]['avatar'];
        $terminales_de_acceso = $result[0]['terminal'];
        $darkMode = $result[0]['dark'];
    }

}

unset($conn);