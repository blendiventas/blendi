<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_modelos = filter_input(INPUT_POST, 'id_modelos', FILTER_SANITIZE_NUMBER_INT);

if($select_sys == "guardar") {
    $descripcion_modelos = filter_input(INPUT_POST, 'descripcion_modelos', FILTER_SANITIZE_STRING);
    $ancho_modelos = filter_input(INPUT_POST, 'ancho_modelos', FILTER_SANITIZE_NUMBER_INT);
    $alto_modelos = filter_input(INPUT_POST, 'alto_modelos', FILTER_SANITIZE_NUMBER_INT);
    $interlineado_modelos = filter_input(INPUT_POST, 'interlineado_modelos', FILTER_SANITIZE_NUMBER_INT);
    $marcar_lineas_modelos = filter_input(INPUT_POST, 'marcar_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $lineas_pagina_modelos = filter_input(INPUT_POST, 'lineas_pagina_modelos', FILTER_SANITIZE_NUMBER_INT);
    $tipo_documento_modelos = filter_input(INPUT_POST, 'tipo_documento_modelos', FILTER_SANITIZE_STRING);
    $serie_modelos = filter_input(INPUT_POST, 'serie_modelos', FILTER_SANITIZE_STRING);
    $activo_modelos = filter_input(INPUT_POST, 'activo_modelos', FILTER_SANITIZE_NUMBER_INT);
    $predeterminado_modelos = filter_input(INPUT_POST, 'predeterminado_modelos', FILTER_SANITIZE_NUMBER_INT);
}else {
    $elemento = filter_input(INPUT_POST, 'elemento', FILTER_SANITIZE_NUMBER_INT);
    $id_lineas_modelos = filter_input(INPUT_POST, 'id_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $zona_modelos = filter_input(INPUT_POST, 'zona_modelos_' . $elemento, FILTER_SANITIZE_STRING);
    $campo_modelos = filter_input(INPUT_POST, 'campo_modelos_' . $elemento, FILTER_SANITIZE_STRING);
    $inicio_ancho_lineas_modelos = filter_input(INPUT_POST, 'inicio_ancho_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $inicio_alto_lineas_modelos = filter_input(INPUT_POST, 'inicio_alto_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $ancho_lineas_modelos = filter_input(INPUT_POST, 'ancho_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $alto_lineas_modelos = filter_input(INPUT_POST, 'alto_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $border_lineas_modelos = filter_input(INPUT_POST, 'border_lineas_modelos_' . $elemento, FILTER_SANITIZE_STRING);
    $grueso_borde_lineas_modelos = filter_input(INPUT_POST, 'grueso_borde_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $color_borde_r_lineas_modelos = filter_input(INPUT_POST, 'color_borde_r_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $color_borde_g_lineas_modelos = filter_input(INPUT_POST, 'color_borde_g_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $color_borde_b_lineas_modelos = filter_input(INPUT_POST, 'color_borde_b_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $fuente_letra_lineas_modelos = filter_input(INPUT_POST, 'fuente_letra_lineas_modelos_' . $elemento, FILTER_SANITIZE_STRING);
    $estilo_letra_lineas_modelos = filter_input(INPUT_POST, 'estilo_letra_lineas_modelos_' . $elemento, FILTER_SANITIZE_STRING);
    $size_letra_lineas_modelos = filter_input(INPUT_POST, 'size_letra_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
    $alineacion_lineas_modelos = filter_input(INPUT_POST, 'alineacion_lineas_modelos_' . $elemento, FILTER_SANITIZE_STRING);
    $color_letra_r_lineas_modelos = filter_input(INPUT_POST, 'color_letra_r_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $color_letra_g_lineas_modelos = filter_input(INPUT_POST, 'color_letra_g_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $color_letra_b_lineas_modelos = filter_input(INPUT_POST, 'color_letra_b_lineas_modelos', FILTER_SANITIZE_NUMBER_INT);
    $mostrar_lineas_modelos = filter_input(INPUT_POST, 'mostrar_lineas_modelos_' . $elemento, FILTER_SANITIZE_NUMBER_INT);
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/impresion_documentos/gestion/datos-update-php.php");