<?php

$ejercicio = (isset($_POST['ejercicio']))? $_POST['ejercicio'] : false;
$id_producto_sys = (isset($_POST['id_producto']))? $_POST['id_producto'] : false;
$id_documento_producto_relacionado_combo_sys = (isset($_POST['id_documento_producto_relacionado_combo']))? $_POST['id_documento_producto_relacionado_combo'] : false;
$tipo_producto_sys = (isset($_POST['tipo_producto']))? $_POST['tipo_producto'] : false;
$tipo_documento = (isset($_POST['tipo_documento']))? $_POST['tipo_documento'] : false;
$id_librador = (isset($_POST['id_librador']))? $_POST['id_librador'] : 0;
$tipo_librador = (isset($_POST['tipo_librador']))? $_POST['tipo_librador'] : false;
$descuento_pp = (isset($_POST['descuento_pp']))? $_POST['descuento_pp'] : false;
$descuento_librador = (isset($_POST['descuento_librador']))? $_POST['descuento_librador'] : false;
$iva_librador = (isset($_POST['iva_librador']))? $_POST['iva_librador'] : false;
$recargo = (isset($_POST['recargo']))? $_POST['recargo'] : false;
$recargo_librador = (isset($_POST['recargo_librador']))? $_POST['recargo_librador'] : false;
$id_irpf_librador = (isset($_POST['id_irpf']))? $_POST['id_irpf'] : false;
$path_components = [];
$path_components[] = '';
$path_components[] = '';
$indice_componente = 0;
$id_linea = (isset($_POST['id_linea']))? $_POST['id_linea'] : false;
$pvp_iva_incluido = (isset($_POST['pvp_iva_incluido']))? $_POST['pvp_iva_incluido'] : false;
$interface = 'tpv';
$idioma = (isset($_POST['idioma']))? $_POST['idioma'] : false;
$id_idioma = (isset($_POST['id_idioma']))? $_POST['id_idioma'] : false;
$id_sesion = (isset($_POST['id_sesion']))? $_POST['id_sesion'] : false;
$ip = (isset($_POST['ip']))? $_POST['ip'] : false;
$descripcion_categoria = (isset($_POST['descripcion_categoria']))? $_POST['descripcion_categoria'] : '';
$decimales_cantidades = (isset($_POST['decimales_cantidades']))? $_POST['decimales_cantidades'] : false;
$decimales_importes = (isset($_POST['decimales_importes']))? $_POST['decimales_importes'] : false;
$id_tarifa_web = (isset($_POST['id_tarifa_web']))? $_POST['id_tarifa_web'] : false;
$modificar_linea = (isset($_POST['modificar_linea']))? $_POST['modificar_linea'] : '';
$borrar_linea = (isset($_POST['borrar_linea']) && $_POST['borrar_linea'] == 'true')? true : false;
$extraNombreFormularioProducto = '_modal';
$comprarConFormularioPorAjax = true;
$hiddenPorModalEnProductoCombo = '';
if (!empty($id_documento_producto_relacionado_combo_sys)) {
    $hiddenPorModalEnProductoCombo = ' hidden';
}
$mostra_nota_productos = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

if($interface == "tpv") {
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
    $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id_panel'];
    } else {
        throw new Exception("Acceso no permitido.");
    }
    unset($conn);
}

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$select_sys = "producto";
require("datos-productos.php");

$packs_disponibles_sys = $packs_disponibles;

$descripcion_producto_sys = $descripcion_producto;
$tipo_producto_sys = $tipo_producto;
$imagen_producto_sys = $imagen_producto;
$updated_producto_sys = $updated_producto;
$alt_producto_sys = $alt_producto;
$tittle_producto_sys = $tittle_producto;
$iva_producto_sys = $iva_producto;
$recargo_producto_sys = $recargo_producto;

if ($descripcion_atributos_unicos_producto) {
    foreach ($descripcion_atributos_unicos_producto as $key_descripcion_atributos_unicos_producto => $valor_descripcion_atributos_unicos_producto) {
        $descripcion_atributos_unicos_producto_sys[] = $valor_descripcion_atributos_unicos_producto;
    }
}

$select_sys = "productos-buscar";
$dato_buscar = (isset($_POST['dato_buscar']))? $_POST['dato_buscar'] : null;
require("datos-productos.php");

$packs_disponibles_sys = $packs_disponibles;

$select_sys = "activas";
require("datos-categorias.php");

$descripcion_producto_sys = $descripcion_producto;
$tipo_producto_sys = $tipo_producto;
$tipo_producto_sys_original = $tipo_producto_sys;
$imagen_producto_sys = $imagen_producto;
$updated_producto_sys = $updated_producto;
$alt_producto_sys = '';
$tittle_producto_sys = '';
$coste_producto_principal_sys = $coste_producto_principal;
$iva_producto_sys = $iva_producto;
$recargo_producto_sys = 0;
if($recargo == 1) {
    $recargo_producto_sys = $recargo_producto;
}
foreach ($id_unidades as $key => $valor) {
    $id_unidades_sys[] = $id_unidad_productos[$key];
    $unidad_producto_sys[] = $unidad_producto[$key];
    $unidad_principal_producto_sys[] = $unidad_principal_producto[$key];
    $conversion_unidad_producto_sys[] = $conversion_unidad_producto[$key];
}
foreach ($descripcion_atributos_unicos_producto as $key => $valor) {
    $descripcion_atributos_unicos_producto_sys[] = $valor;
}
$contador = 0;
foreach ($id_enlazados_producto as $key => $valor) {
    $id_enlazados_producto_sys[$contador] = $id_enlazados_producto[$key];
    $id_multiples_producto_sys[$contador] = $id_multiples_producto[$key];
    $id_packs_producto_sys[$contador] = $id_packs_producto[$key];
    if(isset($descripcion_atributos_producto[$key])) {
        $descripcion_atributos_producto_sys[$contador] = $descripcion_atributos_producto[$key];
    }
    if(isset($cantidad_packs_producto[$key])) {
        $cantidad_packs_producto_sys[$contador] = $cantidad_packs_producto[$key];
    }
    $control_stock_producto_sys[$contador] = $control_stock_producto[$key];
    $disponibilidad_producto_sys[$contador] = $disponibilidad_producto[$key];
    $profesionales_producto_sys[$contador] = $profesionales_producto[$key];
    $peso_producto_sys[$contador] = $peso_producto[$key];
    $bultos_producto_sys[$contador] = $bultos_producto[$key];
    $gastos_producto_sys[$contador] = $gastos_producto[$key];
    $envio_gratis_producto_sys[$contador] = $envio_gratis_producto[$key];
    $dias_entrega_producto_sys[$contador] = $dias_entrega_producto[$key];
    $aplicar_descuento_producto_sys[$contador] = $aplicar_descuento_producto[$key];
    $descuento_maximo_producto_sys[$contador] = $descuento_maximo_producto[$key];
    $id_productos_sku_sys[$contador] = $id_productos_sku[$key];
    $codigo_barras_producto_sys[$contador] = $codigo_barras_producto[$key];
    $referencia_producto_sys[$contador] = $referencia_producto[$key];
    $pvp_producto_sys[$contador] = $pvp_producto[$key];
    if(isset($id_ofertas_producto[$key])) {
        $id_ofertas_producto_sys[$contador] = $id_ofertas_producto[$key];
        $oferta_desde_producto_sys[$contador] = $oferta_desde_producto[$key];
        $oferta_hasta_producto_sys[$contador] = $oferta_hasta_producto[$key];
        $pvp_oferta_producto_sys[$contador] = $pvp_oferta_producto[$key];
        $descripcion_ofertas_producto_sys[$contador] = $descripcion_ofertas_producto[$key];
    }
    if(isset($images_producto[$key])) {
        $images_producto_sys[$contador] = $images_producto[$key];
        $images_updated_producto_sys[$contador] = $images_updated_producto[$key];
        $images_alt_producto_sys[$contador] = $images_alt_producto[$key];
        $images_tittle_producto_sys[$contador] = $images_tittle_producto[$key];
    }
    if(isset($observaciones_producto[$key])) {
        $observaciones_producto_sys[$contador] = $observaciones_producto[$key];
    }
    $contador += 1;
}
unset($id_producto);
unset($descripcion_producto);
unset($imagen_producto);
unset($updated_producto);
unset($alt_producto);
unset($tittle_producto);
unset($id_unidades);
unset($id_unidad_productos);
unset($unidad_producto);
unset($unidad_principal_producto);
unset($conversion_unidad_producto);
unset($iva_producto);
unset($recargo_producto);
unset($descripcion_atributos_unicos_producto);
unset($packs_disponibles);
unset($cantidad_packs_producto);
unset($descripcion_atributos_producto);
unset($id_enlazados_producto);
unset($id_multiples_producto);
unset($id_packs_producto);
unset($control_stock_producto);
unset($disponibilidad_producto);
unset($profesionales_producto);
unset($peso_producto);
unset($bultos_producto);
unset($gastos_producto);
unset($envio_gratis_producto);
unset($dias_entrega_producto);
unset($aplicar_descuento_producto);
unset($descuento_maximo_producto);
unset($id_productos_sku);
unset($codigo_barras_producto);
unset($referencia_producto);
unset($lote_producto_entrada);
unset($caducidad_producto_entrada);
unset($numero_serie_producto_entrada);
unset($stock_producto_entrada);
unset($lote_producto_salida);
unset($caducidad_producto_salida);
unset($numero_serie_producto_salida);
unset($stock_producto_salida);
unset($pvp_producto);
unset($id_ofertas_producto);
unset($oferta_desde_producto);
unset($oferta_hasta_producto);
unset($pvp_oferta_producto);
unset($descripcion_ofertas_producto);
unset($images_producto);
unset($images_updated_producto);
unset($images_alt_producto);
unset($images_tittle_producto);
unset($observaciones_producto);

require("../web-vistas/producto/producto.php");
