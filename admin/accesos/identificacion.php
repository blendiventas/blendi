<?php
if(!isset($identificacion_acceso_sys)) {
    $identificacion_acceso_sys = false;

    if (empty($id_sesion_sys)) {
        session_start();
        $id_sesion_sys = session_id();
    }
    if (empty($ip_sys)) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_sys = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_sys = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_sys = $_SERVER['REMOTE_ADDR'];
            }
        }
    }

    $result = $conn->query("SELECT id FROM usuarios_accesos WHERE sesion='" . $id_sesion_sys . "' AND activo=1 LIMIT 1");
    if ($conn->registros() == 1) {
        $identificacion_acceso_sys = true;
    }else {
        ?>
        <script>
            window.location.href = "/admin/index.php";
            alert("Debes identificarte.");
        </script>
        <?php
        exit();
    }
}