<?php
// INICIO calculo totales linea
if(!empty($iva_librador) && $iva_librador >= 0) {
    // De momento no aplicamos el iva del librador
    // $iva_aplicar = $iva_librador;
    // $recargo_aplicar = $recargo_librador;

    $iva_aplicar = $iva_producto;
    $recargo_aplicar = $recargo_producto;
}else {
    $iva_aplicar = $iva_producto;
    $recargo_aplicar = $recargo_producto;
}

if (!$pvp_iva_incluido || $tipo_librador == "pro" || $tipo_librador == "cre") {
    $pvp_unidad_sin_incrementos *= (1 + ($iva_aplicar / 100));
    $pvp_unidad *= (1 + ($iva_aplicar / 100));
    $pvp_linea *= (1 + ($iva_aplicar / 100));
}

if($tipo_librador == "pro" || $tipo_librador == "cre") {
    $importe = $pvp_unidad / (1 + ($iva_aplicar / 100));
    $importe_sin_incrementos = $pvp_unidad_sin_incrementos / (1 + ($iva_aplicar / 100));
    $importe_fijo = 0;
    // En proveedores y creditores siempre es con importe sin iva
    $base_antes_descuento = $cantidad * ($importe + $importe_fijo);
    $base_antes_descuento_sin_incrementos = $cantidad * ($importe_sin_incrementos + $importe_fijo);
}else {
    $importe = $pvp_unidad / (1 + ($iva_aplicar / 100));
    $importe_sin_incrementos = $pvp_unidad_sin_incrementos / (1 + ($iva_aplicar / 100));
    $importe_fijo = 0;
    // En clientes es con importe sin iva o con iva según configuración
    if($pvp_iva_incluido == 0) {
        $base_antes_descuento = $cantidad * ($importe + $importe_fijo);
        $base_antes_descuento_sin_incrementos = $cantidad * ($importe_sin_incrementos + $importe_fijo);
    }else {
        $base_antes_descuento = ($cantidad * $pvp_unidad) / (1 + ($iva_aplicar / 100));
        $base_antes_descuento_sin_incrementos = ($cantidad * $pvp_unidad_sin_incrementos) / (1 + ($iva_aplicar / 100));
    }
}

// Si en la configuración no tenemos iva incluido calculamos el descuento en la base
if (!$pvp_iva_incluido) {
    $importe_descuento_base = $base_antes_descuento / 100 * $descuento_base;
    $importe_descuento_base_sin_incrementos = $base_antes_descuento_sin_incrementos / 100 * $descuento_base;
} else {
    $descuento_total = $descuento_base;
    $descuento_base = 0;
    $importe_descuento_base = 0;
    $importe_descuento_base_sin_incrementos = 0;
}
$base_despues_descuento = $base_antes_descuento - $importe_descuento_base;
$base_despues_descuento_sin_incrementos = $base_antes_descuento_sin_incrementos - $importe_descuento_base_sin_incrementos;

// Cálculo de impuestos sobre la base
$importe_iva = $base_despues_descuento / 100 * $iva_aplicar;
$importe_iva_sin_incrementos = $base_despues_descuento_sin_incrementos / 100 * $iva_aplicar;
$importe_recargo = 0;
$importe_recargo_sin_incrementos = 0;
if($recargo_aplicar != 0) {
    $importe_recargo = $base_despues_descuento / 100 * $recargo_aplicar;
    $importe_recargo_sin_incrementos = $base_despues_descuento_sin_incrementos / 100 * $recargo_aplicar;
}

// Calculamos el total antes de los descuentos totales pero con los descuentos sobre la base aplicados
$total_linea = $base_despues_descuento + $importe_iva + $importe_recargo;
$total_linea_sin_incrementos = $base_despues_descuento_sin_incrementos + $importe_iva_sin_incrementos + $importe_recargo_sin_incrementos;

// Calculamos el descuento total si en la configuración tenemos el iva incluido
if ($pvp_iva_incluido) {
    $importe_descuento_total = ($base_despues_descuento + $importe_iva + $importe_recargo) / 100 * $descuento_total;
    $importe_descuento_total_sin_incrementos = ($base_despues_descuento_sin_incrementos + $importe_iva_sin_incrementos + $importe_recargo_sin_incrementos) / 100 * $descuento_total;
} else {
    $importe_descuento_total = 0;
    $importe_descuento_total_sin_incrementos = 0;
}

// Calculamos el total despues de los descuentos
$total_despues_descuento = $base_despues_descuento + $importe_iva + $importe_recargo - $importe_descuento_total;
$total_despues_descuento_sin_incrementos = $base_despues_descuento_sin_incrementos + $importe_iva_sin_incrementos + $importe_recargo_sin_incrementos - $importe_descuento_total_sin_incrementos;

// Recualculamos las bases y los impuestos si hay descuento total
if ($importe_descuento_total) {
    $base_antes_descuento = $total_despues_descuento / (1 + ($iva_aplicar / 100) + ($recargo_aplicar / 100));
    $base_antes_descuento_sin_incrementos = $total_despues_descuento_sin_incrementos / (1 + ($iva_aplicar / 100) + ($recargo_aplicar / 100));
    $base_despues_descuento = $base_antes_descuento;
    $base_despues_descuento_sin_incrementos = $base_antes_descuento_sin_incrementos;

    $importe_iva = $base_despues_descuento / 100 * $iva_aplicar;
    $importe_iva_sin_incrementos = $base_despues_descuento_sin_incrementos / 100 * $iva_aplicar;
    $importe_recargo = 0;
    $importe_recargo_sin_incrementos = 0;
    if($recargo_aplicar != 0) {
        $importe_recargo = $base_despues_descuento / 100 * $recargo_aplicar;
        $importe_recargo_sin_incrementos = $base_despues_descuento_sin_incrementos / 100 * $recargo_aplicar;
    }
}

// Calculamos el PVP unidad si hay descuento base
$pvp_unidad = $total_despues_descuento / $cantidad;
$pvp_unidad_sin_incrementos = $total_despues_descuento_sin_incrementos / $cantidad;

// FINAL calculo totales linea