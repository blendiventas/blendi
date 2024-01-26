<?php
/*
CREATE TABLE `documentos_2022_recibos` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `id_documento` INT(11) NULL DEFAULT NULL,
    `tipo_documento` VARCHAR(3) NOT NULL COLLATE 'utf8_spanish_ci',
    `id_librador` INT(11) NULL DEFAULT NULL,
    `importe` DOUBLE(15,2) NULL DEFAULT NULL,
    `fecha` DATE NULL DEFAULT NULL,
    `vencimiento` DATE NULL DEFAULT NULL,
    `pagado` TINYINT(1) NOT NULL DEFAULT '0',
    `fecha_pago` DATE NULL DEFAULT NULL,
    `id_banco_caja_ingreso` INT(10) NOT NULL DEFAULT '0',
    `id_metodo_pago` INT(10) NOT NULL DEFAULT '0',
    `id_modalidad_pago` INT(10) NOT NULL DEFAULT '0',
    `numero_efecto` INT(10) NOT NULL DEFAULT '1',
    `id_usuario_pago` INT(10) NULL DEFAULT NULL,
    `impreso` TINYINT(1) NOT NULL DEFAULT '0',
*/
if(empty($id_documento_1)) {
    $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_1 VALUES(
            NULL,
            '0',
            '" . $tipo_documento . "',
            '" . $id_librador . "',
            '" . $total . "',
            '" . addslashes($interface) . "',
            '" . addslashes($tipo_librador) . "',
            '" . $id_librador . "',
            '" . $fecha_documento . "',
            '" . date('Y-m-d') . "',
            '" . $fecha_entrega_desde . "',
            '" . $fecha_entrega_hasta . "',
            '',
            '" . addslashes($numero_documento) . "',
            '" . addslashes($serie_documento) . "',
            '" . addslashes($modalidad_pago) . "',
            '" . addslashes($modalidad_envio) . "',
            '" . addslashes($modalidad_entrega) . "',
            '" . $irpf_librador . "',
            '" . $importe_irpf . "',
            '" . $descuento_pp . "',
            '" . $importe_descuento_pp . "',
            '" . $descuento_librador . "',
            '" . $importe_descuento_librador . "',
            '" . $base_total . "',
            '" . $total . "',
            '" . $estado . "',
            '0',
            '" . $id_usuario . "',
            '" . $comensales . "',
            '" . date("H:i:s") . "',
            '" . $id_terminal . "')");

    $result = $conn->query("INSERT INTO documentos_" . $ejercicio . "_recibos VALUES(
                    NULL,
                    '" . $id_documentos_1 . "',
                    '" . addslashes($tipoVolcado) . "',
                    '" . $result_origen_documento_1[0]['id_librador'] . "',
                    '" . $valor_importe_recibos . "',
                    '" . $fecha . "',
                    '" . $dias_recibos[$key_importe_recibos] . "',
                    '0',
                    '',
                    '',
                    '0',
                    '0',
                    '" . $result_origen_documento_1[0]['modalidad_pago'] . "',
                    '" . $numero_efecto . "',
                    '0',
                    '0',
                    '',
                    NULL,
                    '')");

}else {
    $result = $conn->query("UPDATE documentos_" . $ejercicio . "_recibos SET 
            importe='" . $valor_importe_recibos . "' 
            WHERE id_documento='".$id_documento_1."' AND numero_efecto='".$numero_efecto."' LIMIT 1");
}