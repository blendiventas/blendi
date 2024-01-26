<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_productos = filter_input(INPUT_POST, 'id_productos', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_productos = filter_input(INPUT_POST, 'id_idioma_productos', FILTER_SANITIZE_NUMBER_INT);
$apartado_url = filter_input(INPUT_POST, 'apartado', FILTER_SANITIZE_STRING);
$entra = $select_sys;

$logs_sys = new stdClass();

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT'] . "/assets/conn/ddbb.php");

$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

$result_configuracion = $conn->query("SELECT pvp_iva_incluido FROM configuracion");
$pvp_iva_incluido = 0;
if ($conn->registros() >= 1) {
    $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
}

if(empty($apartado_url) OR $apartado_url == "null") {
    $entra = "1";
    $descripcion_productos = filter_input(INPUT_POST, 'descripcion_productos', FILTER_SANITIZE_STRING);
    $descripcion_url_productos = (isset($_POST['descripcion_url_productos']))? $_POST['descripcion_url_productos'] : '';
    $tipo_producto_productos = filter_input(INPUT_POST, 'tipo_producto_productos', FILTER_SANITIZE_NUMBER_INT);
    $producto_venta_productos = filter_input(INPUT_POST, 'producto_venta_productos', FILTER_SANITIZE_NUMBER_INT);
    $control_stock = $_POST['control_stock'];
    $id_productos_unidades = filter_input(INPUT_POST, 'id_productos_unidades', FILTER_SANITIZE_NUMBER_INT);
    $id_unidades = filter_input(INPUT_POST, 'id_unidades', FILTER_SANITIZE_NUMBER_INT);
    $id_iva_productos = filter_input(INPUT_POST, 'id_iva_productos', FILTER_SANITIZE_NUMBER_INT);

    $result_iva = $conn->query("SELECT iva FROM productos_iva WHERE id = " . $id_iva_productos);
    $iva_aplicar = 0;
    if ($conn->registros() >= 1) {
        $iva_aplicar = $result_iva[0]['iva'];
    }
    $id_productos_pvp = $_POST['id_productos_pvp'];
    $id_tarifas = $_POST['id_tarifas'];
    $margen_productos_pvp = $_POST['margen_productos_pvp'];
    $pvp_productos_pvp = $_POST['pvp_productos_pvp'];
    if ($pvp_iva_incluido == 0) {
        if (is_array($pvp_productos_pvp)) {
            foreach($pvp_productos_pvp as $key => $pvp_producto_pvp) {
                $pvp_productos_pvp[$key] *= (1 + ($iva_aplicar / 100));;
            }
        } else {
            $pvp_productos_pvp *= (1 + ($iva_aplicar / 100));
        }
    }
    $id_ofertas_productos_pvp = $_POST['id_ofertas_productos_pvp'];
    $oferta_desde_productos_pvp = $_POST['oferta_desde_productos_pvp'];
    $oferta_hasta_productos_pvp = $_POST['oferta_hasta_productos_pvp'];
    $pvp_oferta_productos_pvp = $_POST['pvp_oferta_productos_pvp'];
    if ($pvp_iva_incluido == 0) {
        if (is_array($pvp_oferta_productos_pvp)) {
            foreach($pvp_oferta_productos_pvp as $key => $pvp_oferta_producto_pvp) {
                $pvp_oferta_productos_pvp[$key] *= (1 + ($iva_aplicar / 100));;
            }
        } else {
            $pvp_oferta_productos_pvp *= (1 + ($iva_aplicar / 100));
        }
    }

    $activo = filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_NUMBER_INT);
    $id_categoria_productos_categorias = $_POST['id_categoria_productos_categorias'];
    $orden_productos_categorias = $_POST['orden_productos_categorias'];
    $activo_productos_categorias = $_POST['activo_productos_categorias'];
    $id_categoria_elaborados_productos_elaborados = $_POST['id_categoria_elaborados_productos_elaborados'];
}elseif($apartado_url == "unidades") {
    $entra = "2";
    $id_productos_unidades = filter_input(INPUT_POST, 'id_productos_unidades', FILTER_SANITIZE_NUMBER_INT);
    $id_unidades = filter_input(INPUT_POST, 'id_unidades', FILTER_SANITIZE_NUMBER_INT);
    $conversion = $_POST['conversion'];
    $principal = filter_input(INPUT_POST, 'principal', FILTER_SANITIZE_NUMBER_INT);
    $activo = filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_NUMBER_INT);
    if(empty($conversion)) {
        $conversion = 1;
    }
}elseif($apartado_url == "propiedades") {
    $entra = "3";
    $id_productos_enlazados = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
}elseif($apartado_url == "personalizacion" && $select_sys == 'guardar-titulo') {
    $id_titulo = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_SANITIZE_NUMBER_INT);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_NUMBER_INT);
    $orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_NUMBER_INT);
    $relacionadosDescripciones = explode(',', filter_input(INPUT_POST, 'relacionadosDescripciones', FILTER_SANITIZE_STRING));
    $relacionadosDefecto = explode(',', filter_input(INPUT_POST, 'relacionadosDefecto', FILTER_SANITIZE_STRING));
    $idProductoRelacionado = explode(',', filter_input(INPUT_POST, 'idProductoRelacionado', FILTER_SANITIZE_STRING));
    $tarifas = explode(',', filter_input(INPUT_POST, 'tarifas', FILTER_SANITIZE_STRING));
    $sumarCon = explode(',', filter_input(INPUT_POST, 'sumarCon', FILTER_SANITIZE_STRING));
    if (is_array($tarifas)) {
        $newSumarCon = [];
        foreach ($sumarCon as $keySumarCon => $incrementos) {
            $newSumarCon[] = explode(';', $incrementos);

            if ($pvp_iva_incluido == 0) {
                $result_iva = $conn->query("SELECT pi.iva AS iva FROM productos p JOIN productos_iva pi ON p.id_iva = pi.id WHERE p.id = " . $idProductoRelacionado[$keySumarCon]);
                $iva_aplicar = 0;
                if ($conn->registros() >= 1) {
                    $iva_aplicar = $result_iva[0]['iva'];
                }
                if (is_array($newSumarCon[$keySumarCon])) {
                    foreach($newSumarCon[$keySumarCon] as $keyTarifa => $pvp_producto_pvp) {
                        $newSumarCon[$keySumarCon][$keyTarifa] *= (1 + ($iva_aplicar / 100));
                    }
                }
            }
        }
        $sumarCon = $newSumarCon;
    }
    $tipo_producto = (isset($_POST['tipo_producto']))? $_POST['tipo_producto'] : null;
}elseif($apartado_url == "personalizacion" && $select_sys == 'eliminar-titulo') {
    $id_titulo = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_SANITIZE_NUMBER_INT);
    $tipo_producto = (isset($_POST['tipo_producto']))? $_POST['tipo_producto'] : null;
}elseif($select_sys == "guardar-elaborado") {
    $entra = "SI";
    $tipo_producto = $_POST['tipo_producto'];
    $id_productos_elaborados = $_POST['id_productos_elaborados'];
    $cantidad_base_productos_elaborados = $_POST['cantidad_base_productos_elaborados'];
    $id_unidades_base_productos_elaborados = $_POST['id_unidades_base_productos_elaborados'];
    $cantidad_productos_elaborados = (isset($_POST['cantidad_productos_elaborados']))? $_POST['cantidad_productos_elaborados'] : 0;
    $horas_tiempo_productos_elaborados = (isset($_POST['horas_tiempo_productos_elaborados']))? $_POST['horas_tiempo_productos_elaborados'] : 0;
    $minutos_tiempo_productos_elaborados = (isset($_POST['minutos_tiempo_productos_elaborados']))? $_POST['minutos_tiempo_productos_elaborados'] : 0;
    $segundos_tiempo_productos_elaborados = (isset($_POST['segundos_tiempo_productos_elaborados']))? $_POST['segundos_tiempo_productos_elaborados'] : 0;
    $tiempo_productos_elaborados = $horas_tiempo_productos_elaborados * 60 * 60;
    $tiempo_productos_elaborados += $minutos_tiempo_productos_elaborados * 60;
    $tiempo_productos_elaborados += $segundos_tiempo_productos_elaborados;
}elseif($select_sys == "guardar-pack" || $select_sys == "eliminar-pack") {
    $id_productos_packs = $_POST['id_productos_packs'];
    $pack_producto = $_POST['pack_producto'];
    $pack_producto_enlazado = $_POST['pack_producto_enlazado']; // matriz
    $id_atributo_multiple = $_POST['id_atributo_multiple'];
    $pack_producto_multiple = $_POST['pack_producto_multiple']; // matriz
    $cantidad_pack = $_POST['cantidad_pack'];
    $activo = $_POST['activo'];
    $orden_productos_packs = $_POST['orden_productos_packs'];
}elseif($apartado_url == "costes") {
    $coste = $_POST['coste'];
    $peso_bruto = $_POST['peso_bruto'];
    $peso_neto = $_POST['peso_neto'];
}elseif($apartado_url == "imagen") {
    $entra = "4";
    $imagen_productos = filter_input(INPUT_POST, 'nombre_imagen', FILTER_SANITIZE_STRING);
    $alt_productos = filter_input(INPUT_POST, 'alt_productos', FILTER_SANITIZE_STRING);
    $tittle_productos = filter_input(INPUT_POST, 'tittle_productos', FILTER_SANITIZE_STRING);
    $updated_sys = date("y-m-d").date("H:m:s");
    $updated_sys = str_replace("-","",$updated_sys);
    $updated_sys = str_replace(":","",$updated_sys);
}elseif($select_sys == "guardar-composicion") {
    $entra = "SI";
    $id_tabla_relacionado = $_POST['id_tabla_relacionado'];
    $id_producto_relacionado = $_POST['id_producto_relacionado'];
    $tipo_producto = $_POST['tipo_producto'];
    $id_enlazado = $_POST['id_enlazado'];
    $id_multiple = $_POST['id_multiple'];
    $id_pack = $_POST['id_pack'];
    $id_grupo = $_POST['id_grupo'];
    $activo = $_POST['activo'];
    $id_unidad = $_POST['id_unidad'];
    $modelo = $_POST['modelo'];
    $cantidad_con = $_POST['cantidad_con'];
    $cantidad_mitad = $_POST['cantidad_mitad'];
    $cantidad_sin = $_POST['cantidad_sin'];
    $cantidad_doble = $_POST['cantidad_doble'];
    $incrementos_tarifas = $_POST['incrementos_tarifas'];
    $id_tarifas = explode(",",$_POST['id_tarifas']);
    $sumar_con = explode(",",$_POST['sumar_con']);
    $sumar_mitad = explode(",",$_POST['sumar_mitad']);
    $sumar_sin = explode(",",$_POST['sumar_sin']);
    $sumar_doble = explode(",",$_POST['sumar_doble']);
    $por_defecto = $_POST['por_defecto'];
    $fijo = $_POST['fijo'];
    $mostrar = $_POST['mostrar'];
}elseif($select_sys == "guardar-embalaje") {
    $entra = "SI";
    $id_tabla_relacionado = $_POST['id_tabla_relacionado'];
    $id_producto_relacionado = $_POST['id_producto_relacionado'];
    $cantidad = $_POST['cantidad'];
    $sumar = $_POST['sumar'];
}elseif($select_sys == "eliminar-relacionado" OR $select_sys == "eliminar-relacionado-combo" OR $select_sys == "eliminar-embalaje") {
    $entra = "5";
    $id_producto_relacionado = filter_input(INPUT_POST, 'id_producto_relacionado', FILTER_SANITIZE_NUMBER_INT);
}elseif($select_sys == "eliminar-relacionado-elaborados") {
    $entra = "5";
    $id_producto_relacionado_elaborado = filter_input(INPUT_POST, 'id_producto_relacionado_elaborado', FILTER_SANITIZE_NUMBER_INT);
}elseif($apartado_url == "web") {
    $entra = "6";
    $id_productos_web_datos = $_POST['idProductoProductosWeb'];
    $id_enlazado = filter_input(INPUT_POST, 'idProductosDetallesEnlazadoProductosWeb', FILTER_SANITIZE_NUMBER_INT);
    $id_multiple = filter_input(INPUT_POST, 'idProductosDetallesMultiplesProductosWeb', FILTER_SANITIZE_NUMBER_INT);
    $id_pack = filter_input(INPUT_POST, 'idPacksProductosWeb', FILTER_SANITIZE_NUMBER_INT);
    $id_productos_otros = $_POST['id_productos_otros'];
    $descripcion_larga_productos = $_POST['descripcion_larga'];
    $descripcion_url_productos = $_POST['descripcion_url'];
    $titulo_meta_productos = $_POST['titulo_meta'];
    $descripcion_meta_productos = $_POST['descripcion_meta'];
    $tienda_productos = $_POST['tienda_productos'];
    $url_externa_productos = $_POST['url_externa'];
    $gastos_productos = $_POST['gastos'];
    $envio_gratis_productos = $_POST['envio_gratis'];
    $dias_entrega = $_POST['dias_entrega'];
}elseif($apartado_url == "referencias") {
    $entra = "7";
    $id_productos_referencia_datos = $_POST['idProductoProductosReferencias'];
    $id_enlazado = filter_input(INPUT_POST, 'idProductosDetallesEnlazadoProductosReferencias', FILTER_SANITIZE_NUMBER_INT);
    $id_multiple = filter_input(INPUT_POST, 'idProductosDetallesMultiplesProductosReferencias', FILTER_SANITIZE_NUMBER_INT);
    $id_pack = filter_input(INPUT_POST, 'idPacksProductosReferencias', FILTER_SANITIZE_NUMBER_INT);
    $codigo_barras = $_POST['codigo_barras'];
    $referencia = $_POST['referencia'];
}elseif($apartado_url == "otros") {
    $entra = "8";
    $id_productos_otros_datos = $_POST['idProductoProductosOtros'];
    $id_enlazado = filter_input(INPUT_POST, 'idProductosDetallesEnlazadoProductosOtros', FILTER_SANITIZE_NUMBER_INT);
    $id_multiple = filter_input(INPUT_POST, 'idProductosDetallesMultiplesProductosOtros', FILTER_SANITIZE_NUMBER_INT);
    $id_pack = filter_input(INPUT_POST, 'idPacksProductosOtros', FILTER_SANITIZE_NUMBER_INT);
    $disponibilidad_productos = $_POST['disponibilidad_productos'];
    $enviar_productos = $_POST['enviar_productos'];
    $manual_productos = $_POST['manual_productos'];
    $profesionales_productos = $_POST['profesionales_productos'];
    $peso_productos = $_POST['peso_productos'];
    $bultos_productos = $_POST['bultos_productos'];
    $descuento_maximo_productos = $_POST['descuento_maximo_productos'];
    $id_observaciones_productos = $_POST['id_observaciones_productos'];
    $observacion_productos = $_POST['observacion_productos'];
    $aplicar_descuento_productos = $_POST['aplicar_descuento_productos'];
}elseif($apartado_url == "control_stock") {
    $entra = "9";
    $id_productos_otros = $_POST['idProductosOtros'];
    $id_enlazado = filter_input(INPUT_POST, 'idProductosDetallesEnlazadoProductosStock', FILTER_SANITIZE_NUMBER_INT);
    $id_multiple = filter_input(INPUT_POST, 'idProductosDetallesMultiplesProductosStock', FILTER_SANITIZE_NUMBER_INT);
    $id_pack = filter_input(INPUT_POST, 'idPacksProductosStock', FILTER_SANITIZE_NUMBER_INT);
    $control_stock = $_POST['control_stock'];
}elseif($apartado_url == "stock" || $apartado_url == "elaboracion") {
    $entra = "10";
    $id_productos_otros = $_POST['idProductosOtros'];
    $idProductoProductosSku = $_POST['idProductoProductosSku'];
    $id_enlazado = filter_input(INPUT_POST, 'idProductosDetallesEnlazadoProductosStock', FILTER_SANITIZE_NUMBER_INT);
    $id_multiple = filter_input(INPUT_POST, 'idProductosDetallesMultiplesProductosStock', FILTER_SANITIZE_NUMBER_INT);
    $id_pack = filter_input(INPUT_POST, 'idPacksProductosStock', FILTER_SANITIZE_NUMBER_INT);
    $control_stock = $_POST['control_stock'];
    $id_productos_sku_stock = $_POST['id_productos_sku_stock'];
    $lote = $_POST['lote'];
    $caducidad = $_POST['caducidad'];
    $numero_serie = $_POST['numero_serie'];
    $tipo_documento = $_POST['tipo_documento'];
    $fecha = $_POST['fecha'];
    $id_documento_1 = $_POST['id_documento_1'];
    $id_documento_2 = $_POST['id_documento_2'];
    $tipo_librador = $_POST['tipo_librador'];
    $id_librador = $_POST['id_librador'];
    $cantidad = $_POST['cantidad'];
    $id_unidades = $_POST['id_unidades'];
    $unidad = $_POST['unidad'];
    $producto_traspasar = $_POST['producto_traspasar'];
    $importe = $_POST['importe'];
}elseif($select_sys == "guardarLoteElaboracion") {
    $entra = "11";
    $id_linea_elaborado = filter_input(INPUT_POST, 'id_linea_elaborado', FILTER_SANITIZE_NUMBER_INT);
    $loteLineaElaboracion = filter_input(INPUT_POST, 'loteLineaElaboracion', FILTER_SANITIZE_STRING);
    $caducidadLineaElaboracion = filter_input(INPUT_POST, 'caducidadLineaElaboracion', FILTER_SANITIZE_STRING);
    $numero_serieLineaElaboracion = filter_input(INPUT_POST, 'numero_serieLineaElaboracion', FILTER_SANITIZE_STRING);
    $totalCantidadLineaElaboracion = $_POST['totalCantidadLineaElaboracion'];
    $cantidadLineaElaboracion = $_POST['cantidadLineaElaboracion'];
}

unset($conn);

require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/gestion/datos-update-php.php");