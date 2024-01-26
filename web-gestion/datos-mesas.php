<?php
$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$result_comedores = $conn->query("SELECT * FROM comedores WHERE activo=1 ORDER BY orden");
foreach ($result_comedores as $key_comedores => $valor_comedores) {
    $id_comedores[] = $valor_comedores['id'];
    $descripcion_comedores[] = stripslashes($valor_comedores['descripcion']);
    $principal_comedores[] = $valor_comedores['principal'];
}

$ancho_capa_mesas = 0;
$alto_capa_mesas = 0;
$result_mesas = $conn->query("SELECT id,id_comedores,nombre,imagen_mesa,imagen_mesa_ocupada,imagen_mesa_ocupada,radio,comensales,ancho_pos,alto_pos,ancho,alto 
                                FROM libradores WHERE tipo='mes' AND activo='1'");
foreach ($result_mesas as $key_mesas => $valor_mesas) {
    $matriz_id_mesas[] = $valor_mesas['id'];
    $matriz_id_comedores_mesas[] = $valor_mesas['id_comedores'];
	$matriz_descripcion_mesas[] = stripslashes($valor_mesas['nombre']);
	$matriz_image_mesa_mesas[] = stripslashes($valor_mesas['imagen_mesa']);
	$matriz_image_mesa_ocupada_mesas[] = stripslashes($valor_mesas['imagen_mesa_ocupada']);
    $matriz_radio_mesas[] = stripslashes($valor_mesas['radio']);
	$matriz_comensales_mesas[] = $valor_mesas['comensales'];
	$matriz_ancho_pos_mesas[] = $valor_mesas['ancho_pos'];
	$matriz_alto_pos_mesas[] = $valor_mesas['alto_pos'];
	$matriz_ancho_mesas[] = $valor_mesas['ancho'];
	$matriz_alto_mesas[] = $valor_mesas['alto'];
    if($valor_mesas['ancho_pos'] + $valor_mesas['ancho'] > $ancho_capa_mesas) {
        //$ancho_capa_mesas = $valor_mesas['ancho_pos'] + ($valor_mesas['ancho'] * 2);
        $ancho_capa_mesas = $valor_mesas['ancho_pos'] + ($valor_mesas['ancho'] * 1.2);
    }
    if($valor_mesas['alto_pos'] + $valor_mesas['alto'] > $alto_capa_mesas) {
        //$alto_capa_mesas = $valor_mesas['alto_pos'] + ($valor_mesas['alto'] * 2);
        $alto_capa_mesas = $valor_mesas['alto_pos'] + ($valor_mesas['alto'] * 1.2);
    }
    $ejercicio_documento_mesa[] = $ejercicio;
    $result_recibos = $conn->query("SELECT id_documento,id_librador FROM documentos_".$ejercicio."_recibos WHERE id_librador='".$valor_mesas['id']."' AND pagado='0' LIMIT 1");
    if($conn->registros() == 1) {
        $color_mesa[] = "#FE0303";
        $id_documento_mesa[] = $result_recibos[0]['id_documento'];
        $id_librador_mesa[] = $result_recibos[0]['id_librador'];
        $result_comensales = $conn->query("SELECT bloqueado, comensales FROM documentos_".$ejercicio."_1 WHERE id='".$result_recibos[0]['id_documento']."' LIMIT 1");
        if($conn->registros() == 1) {
            $numero_comensales[] = $result_comensales[0]['comensales'];
            $bloqueado_mesa[] = $result_comensales[0]['bloqueado'];
        }else {
            $numero_comensales[] = -1;
        }
    }else {
        $color_mesa[] = "#000000";
        $id_documento_mesa[] = 0;
        $bloqueado_mesa[] = 0;
        $id_librador_mesa[] = 0;
        $numero_comensales[] = -1;
    }
}

$result_lineas = $conn->query("SELECT * FROM libradores_lineas");
foreach ($result_lineas as $key => $valor) {
    $matriz_id_lineas[] = $valor['id'];
    $matriz_id_comedores_lineas[] = $valor['id_comedores'];
    $matriz_ancho_pos_lineas[] = $valor['ancho_pos'];
    $matriz_alto_pos_lineas[] = $valor['alto_pos'];
    $matriz_ancho_lineas[] = $valor['ancho'];
    $matriz_alto_lineas[] = $valor['alto'];
}

unset($conn);