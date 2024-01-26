<?php
$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
if($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
}else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$logs = new stdClass();

switch ($select_sys) {
    case "metodos-pago":
        /*
        CREATE TABLE `metodos_pago` (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
            `explicacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
            `interface` VARCHAR(3) NOT NULL DEFAULT 'tpv' COLLATE 'utf8_spanish_ci',
            `prioritario` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
            `id_iva` INT(10) NOT NULL DEFAULT '0',
            `incremento_pvp` DOUBLE(4,2) NOT NULL DEFAULT '0.00',
            `incremento_por` DOUBLE(4,2) NOT NULL DEFAULT '0.00',
            `ruta` VARCHAR(200) NOT NULL COLLATE 'utf8_spanish_ci',
            `sistema` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
            `imagen` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
        */
        $result_metodos_pago = $conn->query("SELECT * FROM metodos_pago WHERE activo='1' AND interface='".$interface."' ORDER BY orden,descripcion");
        foreach ($result_metodos_pago as $key_metodos_pago => $valor_metodos_pago) {
            $id_metodos_pago[] = $valor_metodos_pago['id'];
            $descripcion_metodos_pago[] = stripslashes($valor_metodos_pago['descripcion']);
            $explicacion_metodos_pago[] = stripslashes($valor_metodos_pago['explicacion']);
            $prioritario_metodos_pago[] = $valor_metodos_pago['prioritario'];
            $id_iva_metodos_pago[] = $valor_metodos_pago['id_iva'];
            $incremento_pvp_metodos_pago[] = $valor_metodos_pago['incremento_pvp'];
            $incremento_por_metodos_pago[] = $valor_metodos_pago['incremento_por'];
            $ruta_metodos_pago[] = stripslashes($valor_metodos_pago['ruta']);
            $sistema_metodos_pago[] = stripslashes($valor_metodos_pago['sistema']);
            $imagen_metodos_pago[] = stripslashes($valor_metodos_pago['imagen']);
            $updated_metodos_pago[] = stripslashes($valor_metodos_pago['updated']);
            $directo_metodos_pago[] = $valor_metodos_pago['directo'];
        }

        if (isset($ajax)) {
            echo json_encode([
                'logs' => "error"
            ]);
        }
        break;
}
unset($conn);