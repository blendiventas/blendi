<?php
$conn = new db($id_panel_w);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_w == true) {
    switch ($select_w) {
        case "ofertas-de":
            /*
            -- ofertas --
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NULL DEFAULT NULL,
            */
            $descripcion_ofertas = "Sin oferta";
            $result = $conn->query("SELECT id,descripcion,activo FROM ofertas WHERE id=" . $id_ofertas_productos_pvp." LIMIT 1");
            if($conn->registros() == 1) {
                $id_ofertas = $result[0]['id'];
                $descripcion_ofertas = stripslashes($result[0]['descripcion']);
                $activo_ofertas = $result[0]['activo'];
            }
            if (isset($ajax_w)) {
                echo json_encode([
                    'id_ofertas' => $id_ofertas,
                    'descripcion_ofertas' => $descripcion_ofertas,
                    'activo_ofertas' => $activo_ofertas
                ]);
            }
            break;
        case "ofertas":
            /*
            -- ofertas --
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NULL DEFAULT NULL,
            */
            $result = $conn->query("SELECT id,descripcion,activo FROM ofertas WHERE id_idioma=" . $id_idioma_w." AND activo=1");
            if($conn->registros() == 1) {
                foreach ($result as $key => $valor) {
                    $matriz_id_ofertas[] = $valor['id'];
                    $matriz_descripcion_ofertas[] = stripslashes($valor['descripcion']);
                    $matriz_activo_ofertas[] = $valor['activo'];
                }
            }
            if (isset($ajax_w)) {
                echo json_encode([
                    'matriz_id_ofertas' => $matriz_id_ofertas,
                    'matriz_descripcion_ofertas' => $matriz_descripcion_ofertas,
                    'matriz_activo_ofertas' => $matriz_activo_ofertas
                ]);
            }
            break;
    }
}