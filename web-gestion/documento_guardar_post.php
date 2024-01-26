<?php
$idioma = $_POST['idioma']; /* - */
$id_idioma = $_POST['id_idioma']; /* - */
$accion = $_POST['accion']; /* - */
$ejercicio = $_POST['ejercicio']; /* - */
$interface = $_POST['interface_js'];
if($interface == "web") {
    $id_panel = $_POST['id_panel'];
}

$decimales_cantidades = filter_input(INPUT_POST, 'decimales_cantidades', FILTER_SANITIZE_NUMBER_INT);
$decimales_importes = filter_input(INPUT_POST, 'decimales_importes', FILTER_SANITIZE_NUMBER_INT);

// Datos documentos_1
$id_documento_1 = $_POST['id_documento_1']; /* - */
$id_sesion = $_POST['id_sesion']; /* - */
$id_sesion_js = $_POST['id_sesion_js']; /* - */
$ip = $_POST['ip']; /* - */
$so = $_POST['so']; /* - */
$tipo_documento = $_POST['tipo_documento']; /* - */
$span_tipo_documento = $_POST['span_tipo_documento']; /* - */
$procedencia = $_POST['procedencia']; /* - */
$tipo_librador = $_POST['tipo_librador']; /* - */
$span_tipo_librador = $_POST['span_tipo_librador']; /* - */
$id_librador = $_POST['id_librador']; /* - */
$slug = $_POST['slug']; /* - */
$fecha_documento = $_POST['fecha_documento']; /* - */
$fecha_entrada = $_POST['fecha_entrada']; /* - */
$fecha_entrega_desde = $_POST['fecha_entrega_desde'];
$fecha_entrega_hasta = $_POST['fecha_entrega_hasta'];
$numero_documento = $_POST['numero_documento']; /* - */
$serie_documento = $_POST['serie_documento']; /* - */
$id_modalidad_pago = $_POST['id_modalidad_pago']; /* - */
$id_modalidad_envio = $_POST['id_modalidad_envio']; /* - */
$id_modalidad_entrega = $_POST['id_modalidad_entrega']; /* - */
$id_irpf_librador = $_POST['irpf_librador']; /* - */
$descuento_pp = $_POST['descuento_pp']; /* - */
$descuento_librador = $_POST['descuento_librador']; /* - */
$estado = $_POST['estado']; /* - */
$entregado = 0;
$id_usuario = $_POST['id_usuario']; /* - */
$comensales = $_POST['comensales']; /* - */
if ($_SESSION['id_terminal']) {
    $id_terminal = $_SESSION['id_terminal'];
} else {
    $id_terminal = $_POST['id_terminal']; /* - */
}

// Datos documentos_2
$id_documento_2 = filter_input(INPUT_POST, 'id_documento_2', FILTER_SANITIZE_NUMBER_INT);
$codigo_librador_documento = $_POST['codigo_librador_documento']; /* - */
$nombre_documento = $_POST['nombre_documento']; /* - */
$apellido_1_documento = $_POST['apellido_1_documento']; /* - */
$apellido_2_documento = $_POST['apellido_2_documento']; /* - */
$razon_social_documento = $_POST['razon_social_documento']; /* - */
$razon_comercial_documento = $_POST['razon_comercial_documento']; /* - */
$nif_documento = $_POST['nif_documento']; /* - */
$direccion_documento = $_POST['direccion_documento']; /* - */
$numero_direccion_documento = $_POST['numero_direccion_documento']; /* - */
$escalera_direccion_documento = $_POST['escalera_direccion_documento']; /* - */
$piso_direccion_documento = $_POST['piso_direccion_documento']; /* - */
$puerta_direccion_documento = $_POST['puerta_direccion_documento']; /* - */
$localidad_documento = $_POST['localidad_documento']; /* - */
$codigo_postal_documento = $_POST['codigo_postal_documento']; /* - */
$provincia_documento = $_POST['provincia_documento']; /* - */
$telefono_1_documento = $_POST['telefono_1_documento']; /* - */
$telefono_2_documento = $_POST['telefono_2_documento']; /* - */
$fax_documento = $_POST['fax_documento']; /* - */
$email_documento = $_POST['email_documento']; /* - */
$persona_contacto_documento = $_POST['persona_contacto_documento']; /* - */
$id_zona_documento = $_POST['id_zona_documento']; /* - */
$telefono_1_envio_documento = $_POST['telefono_1_envio_documento']; /* - */
$telefono_2_envio_documento = $_POST['telefono_2_envio_documento']; /* - */
$mobil_documento = $_POST['mobil_documento']; /* - */
$persona_contacto_envio_documento = $_POST['persona_contacto_envio_documento']; /* - */
$observaciones_envio_documento = $_POST['observaciones_envio_documento']; /* - */

$nombre_envio_documento = $_POST['nombre_envio_documento']; /* - */
$razon_social_envio_documento = $_POST['razon_social_envio_documento']; /* - */
$razon_comercial_envio_documento = $_POST['razon_comercial_envio_documento']; /* - */
$direccion_envio_documento = $_POST['direccion_envio_documento']; /* - */
$numero_direccion_envio_documento = $_POST['numero_direccion_envio_documento']; /* - */
$escalera_direccion_envio_documento = $_POST['escalera_direccion_envio_documento']; /* - */
$piso_direccion_envio_documento = $_POST['piso_direccion_envio_documento']; /* - */
$puerta_direccion_envio_documento = $_POST['puerta_direccion_envio_documento']; /* - */
$localidad_envio_documento = $_POST['localidad_envio_documento']; /* - */
$codigo_postal_envio_documento = $_POST['codigo_postal_envio_documento']; /* - */
$provincia_envio_documento = $_POST['provincia_envio_documento']; /* - */
$mobil_envio_documento = $_POST['mobil_envio_documento']; /* - */
$iva_librador = $_POST['iva_librador']; /* - */
$recargo_librador = $_POST['recargo_librador']; /* - */
$orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_STRING);
$nota_documento = $_POST['nota_documento']; /* - */
$elemento = $_POST['elemento']; /* - */
$id_producto = $_POST['id_producto']; /* - */

$imagen_producto = $_POST['imagen_producto_'.$elemento]; /* - */
$descripcion_producto = $_POST['descripcion_producto_'.$elemento]; /* - */
$tipo_producto = $_POST['tipo_producto_'.$elemento]; /* - */

$id_enlazado = $_POST['idEnlazado']; /* - */
$id_multiple = $_POST['idMultiple']; /* - */
$id_pack = $_POST['idPack']; /* - */

$descripcion_atributos_producto = $_POST['descripcion_atributos_producto_'.$elemento]; /* - */
$detalles_producto = $_POST['detalles_producto']; /* - */
if (is_array($detalles_producto)) {
    $detalles_producto = strip_tags(join(', ', $detalles_producto));
}
$descripcion_oferta = filter_input(INPUT_POST, 'descripcion_oferta', FILTER_SANITIZE_STRING);
$id_productos_sku = $_POST['id_productos_sku_' . $elemento]; /* - */
$codigo_barras_producto = $_POST['codigo_barras_producto_' . $elemento]; /* - */
$referencia_producto = $_POST['referencia_producto_' . $elemento]; /* - */
$lote_producto = $_POST['lote_producto_' . $elemento]; /* - */
/* $cantidad_lote_producto = number_format($_POST['cantidad_lote_producto_' . $elemento], $decimales_cantidades, ".", ""); */
$cantidad_lote_producto = $_POST['cantidad_lote_producto_' . $elemento];
$numero_serie_producto = $_POST['numero_serie_producto_' . $elemento]; /* - */
$caducidad_producto = $_POST['caducidad_producto_' . $elemento]; /* - */
$disponibilidad_producto = $_POST['disponibilidad_producto_' . $elemento]; /* - */
$peso_producto = $_POST['peso_producto_' . $elemento]; /* - */
$envio_gratis_producto = $_POST['envio_gratis_producto_' . $elemento]; /* - */
/* $cantidad_incremento = number_format($_POST['cantidad_incremento_' . $elemento], $decimales_cantidades, ".", ""); */
$cantidad_incremento = $_POST['cantidad_incremento_' . $elemento];
$sumar_incremento = $_POST['sumar_incremento_' . $elemento]; /* - */
$referencia_librador = filter_input(INPUT_POST, 'referencia_librador', FILTER_SANITIZE_STRING);
$numero_serie = filter_input(INPUT_POST, 'numero_serie', FILTER_SANITIZE_STRING);
/* $lote = filter_input(INPUT_POST, 'lote', FILTER_SANITIZE_STRING); */
$caducidad = $_POST['caducidad'];
/* $cantidad = number_format($_POST['cantidad_'.$elemento], $decimales_cantidades, ".", ""); */
$cantidad = $_POST['cantidad_'.$elemento];
$nota_producto = $_POST['nota_producto_'.$elemento]; /* - */
/* $coste_producto = number_format($_POST['coste_producto_' . $elemento], $decimales_importes, ".", ""); */
$coste_producto = $_POST['coste_producto_' . $elemento];
/* $importe = number_format(filter_input(INPUT_POST, 'importe', FILTER_SANITIZE_NUMBER_FLOAT), $decimales_importes, ".", ""); */
$importe = filter_input(INPUT_POST, 'importe', FILTER_SANITIZE_NUMBER_FLOAT);
/* $importe_fijo = number_format(filter_input(INPUT_POST, 'importe_fijo', FILTER_SANITIZE_NUMBER_FLOAT), $decimales_importes, ".", ""); */
$importe_fijo = filter_input(INPUT_POST, 'importe_fijo', FILTER_SANITIZE_NUMBER_FLOAT);
$descuento_base = str_replace(',', '.', $_POST['descuento_base']);
$descuento_base_euro = str_replace(',', '.', $_POST['descuento_base_euro']);
/* $importe_descuento_base = number_format(filter_input(INPUT_POST, 'importe_descuento_base', FILTER_SANITIZE_NUMBER_FLOAT), $decimales_importes, ".", ""); */
$importe_descuento_base = filter_input(INPUT_POST, 'importe_descuento_base', FILTER_SANITIZE_NUMBER_FLOAT);
$id_iva_producto = $_POST['id_iva_producto_'.$elemento]; /* - */
$iva_producto = $_POST['iva_producto_'.$elemento]; /* - */
$recargo_producto = $_POST['recargo_producto_'.$elemento]; /* - */
$packs_disponibles = $_POST['packs_disponibles_'.$elemento]; /* - */
$fecha_entrega_desde = $_POST['fecha_entrega_desde_'.$elemento]; /* - */
$fecha_entrega_hasta = $_POST['fecha_entrega_hasta_'.$elemento]; /* - */
$descripcion_oferta = $_POST['descripcion_oferta_'.$elemento]; /* - */
/* $base = number_format($_POST['base'], $decimales_importes, ".", ""); */
$base = $_POST['base'];
$recargo = $_POST['recargo'];
/* $pvp_linea = number_format($_POST['pvp_total_'.$elemento], $decimales_importes, ".", ""); */
$pvp_linea = $_POST['pvp_total_'.$elemento];
/* $pvp_unidad = number_format($pvp_linea / $cantidad, $decimales_importes, ".", ""); */
$pvp_unidad = $pvp_linea / $cantidad;
/* $pvp_unidad_sin_incrementos = number_format($_POST['precio'], $decimales_importes, ".", ""); */
$pvp_unidad_sin_incrementos = $_POST['precio'];
/* $incremento_unidad = number_format($_POST['incremento_linea_'.$elemento], $decimales_importes, ".", ""); */
$incremento_unidad = $_POST['incremento_linea_'.$elemento];
$unidad_producto = $_POST['unidad_producto_'.$elemento]; /* - id unidades */
$id_unidades = $unidad_producto;
$descuento_total = filter_input(INPUT_POST, 'descuento_total', FILTER_SANITIZE_NUMBER_FLOAT);
/* $importe_descuento_total = number_format(filter_input(INPUT_POST, 'importe_descuento_total', FILTER_SANITIZE_NUMBER_FLOAT), $decimales_importes, ".", ""); */
$importe_descuento_total = filter_input(INPUT_POST, 'importe_descuento_total', FILTER_SANITIZE_NUMBER_FLOAT);
$id_documento_anterior = filter_input(INPUT_POST, 'id_documento_anterior', FILTER_SANITIZE_NUMBER_INT);
$id_vendedor = filter_input(INPUT_POST, 'id_vendedor', FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['nota_linea'])) {
    $observacion = $_POST['nota_linea'];
} else {
    $observacion = $_POST['observacion_' . $elemento];
}
$id_tarifa_web = $_POST['id_tarifa_web'];

$id_linea = $_POST['id_linea']; /* - */

// Si no existe descuento base pero si descuento base en euros calculamos el primero en base al segundo.
if (empty((float) $descuento_base) && (float) $descuento_base <= 0 && !empty((float) $descuento_base_euro) && (float) $descuento_base_euro > 0) {
    $descuento_base = ((float) $descuento_base_euro / $pvp_unidad_sin_incrementos) * 100;
}

if(empty($ejercicio)) { $ejercicio = date("Y"); }
if(!isDate($fecha_documento)) {
    $fecha_documento = date("Y-m-d");
}
$ejercicio = substr($fecha_documento, 0, 4);
