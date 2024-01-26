<?php
/* Zona: cabecera documento */
foreach ($result_modelos_2 as $key_modelos_2 => $valor_modelos_2) {
    if(empty($valor_modelos_2['border'])) {
        $border = 0;
    }else {
        $border = $valor_modelos_2['border'];
    }
    if($valor_modelos_2['zona'] == "cabecera") {
        $pdf->SetFont($valor_modelos_2['fuente_letra'], $valor_modelos_2['estilo_letra'], $valor_modelos_2['size_letra']);
        $pdf->setXY($valor_modelos_2['inicio_ancho'],$valor_modelos_2['inicio_alto']);
        if ($valor_modelos_2['campo'] == "nombre_librador" && ($nombre_librador != "" || $apellido_1_librador != "" || $apellido_2_librador != "")) {
            $str = iconv('UTF-8', 'windows-1252', $nombre_librador . " " . $apellido_1_librador . " " . $apellido_2_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "nombre_librador" && $razon_social_librador != "") {
            $str = iconv('UTF-8', 'windows-1252', $razon_social_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "nif_librador") {
            $str = iconv('UTF-8', 'windows-1252', $nif_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,0, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "direccion_librador") {
            if(!empty($numero_librador)) {
                $direccion_librador .= ", núm. ".$numero_librador;
            }
            if(!empty($escalera_librador)) {
                $direccion_librador .= ", Esc. ".$escalera_librador;
            }
            if(!empty($piso_librador)) {
                $direccion_librador .= " ".$piso_librador;
            }
            if(!empty($puerta_librador)) {
                $direccion_librador .= " ".$puerta_librador;
            }
            $str = iconv('UTF-8', 'windows-1252', $direccion_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "codigo_postal_librador") {
            $str = iconv('UTF-8', 'windows-1252', $codigo_postal_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "localidad_librador") {
            $str = iconv('UTF-8', 'windows-1252', $localidad_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "provincia_librador") {
            $str = iconv('UTF-8', 'windows-1252', $provincia_librador);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "serie_documento") {
            $str = iconv('UTF-8', 'windows-1252', $serie_documento);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "numero_documento") {
            $str = iconv('UTF-8', 'windows-1252', $numero_documento);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
        if ($valor_modelos_2['campo'] == "fecha_documento") {
            $str = iconv('UTF-8', 'windows-1252', $fecha_documento);
            $pdf->Cell($valor_modelos_2['ancho'], $valor_modelos_2['alto'], $str, $border,1, $valor_modelos_2['alineacion']);
        }
    }
}