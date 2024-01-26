<?php
/* Zona: cuerpo documento */
$alto_linea = 0;
$lineas_pagina = $result_modelos_1[0]['lineas_pagina'];
foreach ($id_documento_2 as $key_id_documento_2 => $valor_id_documento_2) {
    $sumar_linea = $result_modelos_1[0]['interlineado'];
    foreach ($result_modelos_2 as $key_modelos_2 => $valor_modelos_2) {
        if (empty($valor_modelos_2['border'])) {
            $border = 0;
        } else {
            $border = $valor_modelos_2['border'];
        }
        if ($valor_modelos_2['zona'] == "cuerpo") {
            if(empty($alto_linea)) {
                $alto_linea = $valor_modelos_2['inicio_alto'];
            }
            $pdf->SetFont($valor_modelos_2['fuente_letra'], $valor_modelos_2['estilo_letra'], $valor_modelos_2['size_letra']);
            $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea);
            if ($valor_modelos_2['campo'] == "cantidad") {
                $str = iconv('UTF-8', 'windows-1252', number_format($cantidad[$key_id_documento_2], $decimales_cantidades, ',', '.') . ' ' . $unidad[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "descripcion_producto") {
                $str = iconv('UTF-8', 'windows-1252', $descripcion_producto[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "base_unidad") {
                if ($tipo_librador == 'pro' or $tipo_librador == 'cre') {
                    $str = iconv('UTF-8', 'windows-1252', number_format($coste[$key_id_documento_2], $decimales_importes, ',', '.'));
                }else {
                    $str = iconv('UTF-8', 'windows-1252', number_format($pvp_unidad_sin_incrementos[$key_id_documento_2], $decimales_importes, ',', '.'));
                }
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "iva_linea") {
                $str = iconv('UTF-8', 'windows-1252', $iva_linea[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "pvp_unidad") {
                $str = iconv('UTF-8', 'windows-1252', number_format($pvp_unidad_sin_incrementos[$key_id_documento_2], $decimales_importes, ',', '.'));
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "descuento_linea") {
                $str = iconv('UTF-8', 'windows-1252', $descuento_linea[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "total_despues_descuento") {
                $str = iconv('UTF-8', 'windows-1252', number_format($pvp_unidad_sin_incrementos[$key_id_documento_2] * $cantidad[$key_id_documento_2], $decimales_importes, ',', '.'));
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "referencia_producto") {
                $str = iconv('UTF-8', 'windows-1252', $referencia_producto[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "referencia_proveedor") {
                $str = iconv('UTF-8', 'windows-1252', $referencia_proveedor[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "lote_producto" && !empty($lote_producto[$key_id_documento_2])) {
                $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea + $sumar_linea);
                $sumar_linea += $result_modelos_1[0]['interlineado'];
                $str = iconv('UTF-8', 'windows-1252', $lote_producto[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "serie_producto" && !empty($serie_producto[$key_id_documento_2])) {
                $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea + $sumar_linea);
                $sumar_linea += $result_modelos_1[0]['interlineado'];
                $str = iconv('UTF-8', 'windows-1252', $serie_producto[$key_id_documento_2]);
                $pdf->MultiCell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "detalles_producto" && !empty($detalles_producto[$key_id_documento_2])) {
                $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea + $sumar_linea);
                $sumar_linea += $result_modelos_1[0]['interlineado'];
                $str = iconv('UTF-8', 'windows-1252', $detalles_producto[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "descripcion_oferta" && !empty($descripcion_oferta[$key_id_documento_2])) {
                $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea + $sumar_linea);
                $sumar_linea += $result_modelos_1[0]['interlineado'];
                $str = iconv('UTF-8', 'windows-1252', $descripcion_oferta[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "nota_producto" && !empty($nota_producto[$key_id_documento_2])) {
                $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea + $sumar_linea);
                $sumar_linea += $result_modelos_1[0]['interlineado'];
                $str = iconv('UTF-8', 'windows-1252', $nota_producto[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
            if ($valor_modelos_2['campo'] == "documento_anterior" && !empty($numero_documento_anterior[$key_id_documento_2])) {
                $nombre_tipo_documento_anterior = 'Número: ';
                if ($tipo_documento_anterior[$key_id_documento_2] == 'pre') {
                    $nombre_tipo_documento_anterior = 'Número presupuesto: ';
                } else if ($tipo_documento_anterior[$key_id_documento_2] == 'ped') {
                    $nombre_tipo_documento_anterior = 'Número pedido: ';
                } else if ($tipo_documento_anterior[$key_id_documento_2] == 'alb') {
                    $nombre_tipo_documento_anterior = 'Número albarán: ';
                }
                $pdf->setXY($valor_modelos_2['inicio_ancho'],$alto_linea + $sumar_linea);
                $sumar_linea += $result_modelos_1[0]['interlineado'];
                $str = iconv('UTF-8', 'windows-1252', $nombre_tipo_documento_anterior . $numero_documento_anterior[$key_id_documento_2]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
        }
    }
    $alto_linea += $sumar_linea;
    $lineas_pagina -= 1;
    if ($lineas_pagina == 0) {
        $pdf->AddPage();
        $pdf->setSourceFile($raiz . "/modelos_impresion_" . $result_modelos_1[0]['id'] . ".pdf");
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);
        $alto_linea = 0;
        $lineas_pagina = $result_modelos_1[0]['lineas_pagina'];

        require("crear_pdf_cabecera.php");
    }
}