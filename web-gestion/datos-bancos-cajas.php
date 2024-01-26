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
    case "bancos-cajas":
        /*
        CREATE TABLE `bancos_cajas` (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `descripcion` VARCHAR(35) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `entidad` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `agencia` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `dc` VARCHAR(2) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `cuenta` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `iban` VARCHAR(24) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        */
        $result_bancos_cajas = $conn->query("SELECT * FROM bancos_cajas WHERE activo='1' ORDER BY descripcion");
        foreach ($result_bancos_cajas as $key_bancos_cajas => $valor_bancos_cajas) {
            $id_bancos_cajas[] = $valor_bancos_cajas['id'];
            $descripcion_bancos_cajas[] = stripslashes($valor_bancos_cajas['descripcion']);
            $iban_bancos_cajas[] = stripslashes($valor_bancos_cajas['iban']);
        }

        if (isset($ajax)) {
            echo json_encode([
                'logs' => "error"
            ]);
        }
        break;
}
unset($conn);