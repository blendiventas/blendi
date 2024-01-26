<?php
if (!isset($conn)) {
    require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
}

$protocolAccess = 'http://';

$result_acceso = $conn->query("SELECT id_panel,dia,hora FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
if($conn->registros() == 1) {
    $result = $conn->query("SELECT id,sector,m_cocina,dominio_ftp,base,revisar_tablas FROM identificacion_panel WHERE id=" . $result_acceso[0]['id_panel'] . " AND bloqueado=0 LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel_sys = $result[0]['id'];
        $sector = $result[0]['sector'];
        $m_cocina = $result[0]['m_cocina'];
        $dominio_ftp_sys = stripslashes($result[0]['dominio_ftp']) . "/";
        $nombre_base_sys = stripslashes($result[0]['base']);
        $dia_sys = $result_acceso[0]['dia'];
        $hora_sys = $result_acceso[0]['hora'];
        $revisar_tablas_sys = $result[0]['revisar_tablas'];
    }
}
unset($conn);

if(!empty($id_panel_sys) && !empty($dominio_ftp_sys)) {
    $conn = new db($id_panel_sys);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id_usuario,dia,hora,id_terminal FROM usuarios_accesos WHERE sesion='" . $id_sesion_sys . "' AND activo=1 LIMIT 1");
    if ($conn->registros() == 1) {
        if($path_url_sys[0] != "cerrar-sesion") {
            $id_usuario_sys = $result[0]['id_usuario'];
            $dia_sys = $result[0]['dia'];
            $hora_sys = $result[0]['hora'];
            $id_terminal_sys = $result[0]['id_terminal'];
            $_SESSION['id_terminal'] = $id_terminal_sys;
            $result_usuario = $conn->query("SELECT usuario,terminal,id_idioma FROM usuarios WHERE id=" . $id_usuario_sys . " AND bloqueo=0 LIMIT 1");
            if ($conn->registros() == 1) {
                $usuario_sys = stripslashes($result_usuario[0]['usuario']);
                $id_idioma_sys = $result_usuario[0]['id_idioma'];
                $terminales_de_acceso = $result_usuario[0]['terminal'];
            }
            $result_idioma = $conn->query("SELECT idioma FROM idiomas WHERE id=" . $id_idioma_sys . " LIMIT 1");
            if ($conn->registros() == 1) {
                $idioma_sys = stripslashes($result_idioma[0]['idioma']);
            }
            require("permisos.php");
            $acceso_correcto_sys = 1;
        }else {
            $result = $conn->query("UPDATE usuarios_accesos SET activo=0 WHERE sesion='" . $id_sesion_sys . "' AND activo=1");

            // Destruir todas las variables de sesión.
            $_SESSION = array();

            // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Finalmente, destruir la sesión.
            session_destroy();
            session_unset();

            header('Location: ' . $protocolAccess . $_SERVER['HTTP_HOST']);
        }
    } else {
        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
        session_unset();

        header('Location: ' . $protocolAccess . $_SERVER['HTTP_HOST']);
        unset($conn);
        exit();
    }
    unset($conn);
}else {
    // Destruir todas las variables de sesión.
    $_SESSION = array();

    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();
    session_unset();

    header('Location: ' . $protocolAccess . $_SERVER['HTTP_HOST']);
    exit();
}