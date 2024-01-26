<?php
/* Zona: pie documento */
foreach ($result_modelos_2 as $key_modelos_2 => $valor_modelos_2) {
    if (empty($valor_modelos_2['border'])) {
        $border = 0;
    } else {
        $border = $valor_modelos_2['border'];
    }
    if($valor_modelos_2['zona'] == "pie") {
        $pdf->SetFont($valor_modelos_2['fuente_letra'], $valor_modelos_2['estilo_letra'], $valor_modelos_2['size_letra']);
        $pdf->setXY($valor_modelos_2['inicio_ancho'],$valor_modelos_2['inicio_alto']);
        if ($valor_modelos_2['campo'] == "irpf" && $irpf != 0) {
            $str = iconv('UTF-8', 'windows-1252', $irpf . "% IRPF: " . number_format($importe_irpf, 2, ",", ".") . " €");
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "descuento_pp" && $descuento_pp != 0) {
            $str = iconv('UTF-8', 'windows-1252', $descuento_pp . "% descuento p.p.: " . number_format($importe_descuento_pp, 2, ",", ".") . " €");
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "descuento_librador" && $descuento_librador != 0) {
            $str = iconv('UTF-8', 'windows-1252', $descuento_librador . "% descuento: " . number_format($importe_descuento_librador, 2, ",", ".") . " €");
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "total") {
            $str = iconv('UTF-8', 'windows-1252', number_format($total, 2, ',', '.') . " €");
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "usuario_documento" && $usuario_documento != "") {
            $str = iconv('UTF-8', 'windows-1252', "Atendido por: ".$usuario_documento);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "comensales" && $comensales != 0) {
            $str = iconv('UTF-8', 'windows-1252', "Comensales: ".$comensales);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);

        }
        if ($valor_modelos_2['campo'] == "modalidad_pago" && $modalidad_pago != "") {
            $str = iconv('UTF-8', 'windows-1252', "Modalidad pago: ".$modalidad_pago);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "metodos_pago") {
            for ($bucle = 0; $bucle < count($metodos_pago); $bucle++) {
                $str = iconv('UTF-8', 'windows-1252', "Método pago: ".$metodos_pago[$bucle]);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
        }
        if ($valor_modelos_2['campo'] == "modalidad_envio" && $tipo_documento == "alb") {
            if ($modalidad_envio != "") {
                $str = iconv('UTF-8', 'windows-1252', "Modalidad envío: ".$modalidad_envio);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
        }
        if ($valor_modelos_2['campo'] == "modalidad_entrega" && $tipo_documento == "alb") {
            if ($modalidad_entrega != "") {
                $str = iconv('UTF-8', 'windows-1252', "Modalidad entrega: ".$modalidad_entrega);
                $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
            }
        }
        if ($valor_modelos_2['campo'] == "nota_documento" && $nota_documento != "") {
            $str = iconv('UTF-8', 'windows-1252', "Nota: ".$nota_documento);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
        }
    }
}
$alto_linea = 0;
$sumar_linea = $result_modelos_1[0]['interlineado'];
foreach ($iva as $key_iva => $valor_iva) {
    if($base_iva[$key_iva] != 0) {
        foreach ($result_modelos_2 as $key_modelos_2 => $valor_modelos_2) {
            if (empty($valor_modelos_2['border'])) {
                $border = 0;
            } else {
                $border = $valor_modelos_2['border'];
            }
            if ($valor_modelos_2['zona'] == "pie") {
                if (empty($alto_linea) &&
                    ($valor_modelos_2['campo'] == "iva" ||
                        $valor_modelos_2['campo'] == "recargo" ||
                        $valor_modelos_2['campo'] == "base_iva" ||
                        $valor_modelos_2['campo'] == "importe_iva" ||
                        $valor_modelos_2['campo'] == "importe_recargo")) {
                    $alto_linea = $valor_modelos_2['inicio_alto'];
                }
                $pdf->SetFont($valor_modelos_2['fuente_letra'], $valor_modelos_2['estilo_letra'], $valor_modelos_2['size_letra']);
                $pdf->setXY($valor_modelos_2['inicio_ancho'], $alto_linea);
                if ($valor_modelos_2['campo'] == "iva") {
                    $str = iconv('UTF-8', 'windows-1252', $iva[$key_iva]);
                    $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
                }
                if ($valor_modelos_2['campo'] == "recargo" && $importe_recargo[$key_iva] != 0) {
                    $str = iconv('UTF-8', 'windows-1252', $recargo[$key_iva]);
                    $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
                }
                if ($valor_modelos_2['campo'] == "base_iva") {
                    $str = iconv('UTF-8', 'windows-1252', number_format($base_iva[$key_iva], 2, ',', '.'));
                    $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
                }
                if ($valor_modelos_2['campo'] == "importe_iva") {
                    $str = iconv('UTF-8', 'windows-1252', number_format($importe_iva[$key_iva], 2, ',', '.'));
                    $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
                }
                if ($valor_modelos_2['campo'] == "importe_recargo" && $importe_recargo[$key_iva] != 0) {
                    $str = iconv('UTF-8', 'windows-1252', number_format($importe_recargo[$key_iva], 2, ',', '.'));
                    $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border, 1, $valor_modelos_2['alineacion']);
                }
            }
        }
        $alto_linea += $sumar_linea;
    }
}