<?php
$importe_descuento_pp = 0;
$importe_descuento_pp_total = 0;
$importe_descuento_librador = 0;
$importe_descuento_librador_total = 0;
$importe_iva_total = 0;
$importe_recargo_total = 0;
$result_totales = $conn->query("SELECT base,iva,importe_iva,recargo,importe_recargo 
                                FROM documentos_".$ejercicio."_iva WHERE id_documentos_1=".$id_documento_1);
$base_totales_lineas = [];
$iva_totales_lineas = [];
$importe_iva_totales_lineas = [];
$recargo_totales_lineas = [];
$importe_recargo_totales_lineas = [];
foreach ($result_totales as $key_totales => $valor_totales) {
    $base = $valor_totales['base'];
    if($descuento_pp != 0) {
        $importe_descuento_pp = ($base / 100 * $descuento_pp);
        $importe_descuento_pp_total += $importe_descuento_pp;
    }

    if($descuento_librador != 0) {
        $importe_descuento_librador = ($base / 100 * $descuento_librador);
        $importe_descuento_librador_total += $importe_descuento_librador;
    }
    $base_total_linea_actual = ($base - ($importe_descuento_pp + $importe_descuento_librador));
    if(!isset($base_totales_lineas[intval($valor_totales['iva'])])) {
        $base_totales_lineas[intval($valor_totales['iva'])] = number_format($base_total_linea_actual, 2, '.', '');
        $iva_totales_lineas[intval($valor_totales['iva'])] = $valor_totales['iva'];
        $importe_iva_totales_lineas[intval($valor_totales['iva'])] = number_format($base_total_linea_actual, 2, '.', '') / 100 * $valor_totales['iva'];
        $recargo_totales_lineas[intval($valor_totales['iva'])] = $valor_totales['recargo'];
        $importe_recargo_totales_lineas[intval($valor_totales['iva'])] = number_format($base_total_linea_actual, 2, '.', '') / 100 * $valor_totales['recargo'];
    }else {
        $base_totales_lineas[intval($valor_totales['iva'])] += number_format($base_total_linea_actual, 2, '.', '');
        $importe_iva_totales_lineas[intval($valor_totales['iva'])] += number_format($base_total_linea_actual, 2, '.', '') / 100 * $valor_totales['iva'];
        $importe_recargo_totales_lineas[intval($valor_totales['iva'])] += number_format($base_total_linea_actual, 2, '.', '') / 100 * $valor_totales['recargo'];
    }
}

$base_total = 0;
$importe_descuento_pp = $importe_descuento_pp_total;
$importe_descuento_librador = $importe_descuento_librador_total;
foreach ($base_totales_lineas as $key_totales => $valor_totales) {
    $base_total += $valor_totales;

    $importe_iva_total += number_format($importe_iva_totales_lineas[$key_totales], 2, '.', '');
    $importe_recargo_total += number_format($importe_recargo_totales_lineas[$key_totales], 2, '.', '');

    $total += (number_format($valor_totales, 2, '.', '') + number_format($importe_iva_totales_lineas[$key_totales], 2, '.', '') + number_format($importe_recargo_totales_lineas[$key_totales], 2, '.', ''));
    $datos .= "(" . $valor_totales . " + " . $importe_iva_totales_lineas[$key_totales] . " + " . $importe_recargo_totales_lineas[$key_totales] . ")";
    $datos .= "-base_total_" . $key_totales . ": ".$valor_totales."\r\n";
    $datos .= "-iva_total_" . $key_totales . ": ".$importe_iva_totales_lineas[$key_totales]."\r\n";
    $datos .= "-recargo_total_" . $key_totales . ": ".$importe_recargo_totales_lineas[$key_totales]."\r\n";
    $datos .= "-total_" . $key_totales . ": ".$total."\r\n";
}

if (!isset($pvp_iva_incluido))
{
    $result_configuracion = $conn->query("SELECT pvp_iva_incluido FROM configuracion");
    $pvp_iva_incluido = 0;
    if ($conn->registros() >= 1) {
        $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
    }
}
if ($pvp_iva_incluido) {
    $total = 0;

    $result_totales_2 = $conn->query("SELECT total_despues_descuento 
                                FROM documentos_".$ejercicio."_2 WHERE id_documentos_1=".$id_documento_1);
    foreach ($result_totales_2 as $key_totales_2 => $valor_totales_2) {
        $total += number_format($valor_totales_2['total_despues_descuento'], 2, '.', '');
    }

    if($descuento_pp != 0) {
        $total_descuento_pp = ($total / 100 * $descuento_pp);
    }

    if($descuento_librador != 0) {
        $total_descuento_librador = ($total / 100 * $descuento_librador);
    }

    if($total_descuento_pp != 0 || $total_descuento_librador != 0) {
        $total -= $total_descuento_pp;
        $total -= $total_descuento_librador;
        $total = number_format($total, 2, '.', '');
    }
}

$base_total = number_format($base_total, 2, '.', '');
if (($base_total + $importe_iva_total + $importe_recargo_total) > $total) {
    $base_total -= 0.01;
}

if(!empty($id_irpf_librador)) {
    $result_irpf = $conn->query("SELECT irpf FROM irpf WHERE id=".$id_irpf_librador." LIMIT 1");
    if($conn->registros() == 1) {
        $irpf_librador = $result_irpf[0]['irpf'];
        $importe_irpf = $base_total / 100 * $irpf_librador;
    }
}else {
    $irpf_librador = 0;
    $importe_irpf = 0;
}

$total -= number_format($importe_irpf, 2, '.', '');
$datos .= "-importe_irpf: ".$importe_irpf."\r\n";
$datos .= "-total: ".$total."\r\n";