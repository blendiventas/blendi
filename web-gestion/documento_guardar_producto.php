<?php
$interface = 'web';

if (!isset($_SESSION["id_sesion"]))
{
    $_SESSION["id_sesion"] = session_id();
}

$idioma = 'es/'; /* - */
$id_idioma = 4; /* - */
$accion = $_POST['accion']; /* - */
$ejercicio = 'temp';
$interface = 'web';

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");
$result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

$pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
$decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
$decimales_importes = $result_configuracion[0]['decimales_importes'];

$result_tarifas = $conn->query("SELECT * FROM tarifas ORDER BY prioritaria DESC, id");
$id_tarifa_web = $result_tarifas[0]['id'];

// Datos documentos_1
$id_sesion = $_SESSION["id_sesion"]; /* - */
$id_sesion_js = 'temp'; /* - */
if(empty($_SESSION[$id_sesion_js]['id_documento'])){
    $id_documento_1 = null;
} else {
    $id_documento_1 = $_SESSION[$id_sesion_js]['id_documento'];
}
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
}
$so = ''; /* - */
$tipo_documento = 'ped';
$span_tipo_documento = 'ped'; /* - */
$procedencia = 'web'; /* - */
$tipo_librador = 'cli';
$span_tipo_librador = 'cli'; /* - */

// Datos documentos_1
$result_documento_1 = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_1 WHERE id=" . $id_documento_1 . " LIMIT 1");
if(isset($result_documento_1[0])){
    $id_librador = $result_documento_1[0]['id_librador']; /* - */
    $fecha_documento = $result_documento_1[0]['fecha_documento']; /* - */
    $fecha_entrada = $result_documento_1[0]['fecha_entrada']; /* - */
    $fecha_entrega_desde = $result_documento_1[0]['fecha_entrega_desde'];
    $fecha_entrega_hasta = $result_documento_1[0]['fecha_entrega_hasta'];
    $numero_documento = $result_documento_1[0]['numero_documento']; /* - */
    $serie_documento = $result_documento_1[0]['serie_documento']; /* - */
    $modalidad_pago = $result_documento_1[0]['modalidad_pago']; /* - */
    $modalidad_envio = $result_documento_1[0]['modalidad_envio']; /* - */
    $modalidad_entrega = $result_documento_1[0]['modalidad_entrega']; /* - */
    $id_irpf_librador = '';
    if (!empty($result_documento_1[0]['irpf_librador'])) {
        $result_irpf = $conn->query("SELECT id FROM irpf WHERE irpf='".$result_documento_1[0]['irpf_librador']."' LIMIT 1");
        $id_irpf_librador = (isset($result_irpf[0]))? $result_irpf[0]['id'] : ''; /* - */
    }
    $descuento_pp = $result_documento_1[0]['descuento_pp']; /* - */
    $descuento_librador = $result_documento_1[0]['descuento_librador']; /* - */
    $estado = $result_documento_1[0]['estado']; /* - */
    $entregado = 0;
    $id_usuario = $result_documento_1[0]['id_usuario']; /* - */
    $comensales = $result_documento_1[0]['comensales']; /* - */
    $id_terminal = $result_documento_1[0]['id_terminal'];
    $totalParaCalculoMetodoDePago = $result_documento_1[0]['total'];
} else {
    $id_librador = '';
    $fecha_documento = date('Y-m-d H:i:s');
    $fecha_entrada = date('Y-m-d H:i:s');
    $fecha_entrega_desde = '';
    $fecha_entrega_hasta = '';
    $numero_documento = '';
    $serie_documento = '';
    $modalidad_pago = '';
    $modalidad_envio = '';
    $modalidad_entrega = '';
    $id_irpf_librador = '';
    $descuento_pp = '';
    $descuento_librador = '';
    $estado = '';
    $entregado = '';
    $id_usuario = '';
    $comensales = '';
    $id_terminal = '';
    $totalParaCalculoMetodoDePago = 0;
}

$modalidad_envio = (isset($_POST['modalidad_envio']))? $_POST['modalidad_envio'] : $modalidad_envio;
$modalidad_entrega = (isset($_POST['modalidad_entrega']))? $_POST['modalidad_entrega'] : $modalidad_entrega;
$metodo_pago = (isset($_POST['metodo_pago']))? $_POST['metodo_pago'] : '';

// Datos documentos_2
$slug = $_POST['slug']; /* - */
$id_documento_2 = filter_input(INPUT_POST, 'id_documento_2', FILTER_SANITIZE_NUMBER_INT);

$result_documento_libradores = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_libradores WHERE id_documentos_1=" . $id_documento_1 . " LIMIT 1");
if (isset($result_documento_libradores[0]) && !isset($_POST['nombre_documento'])) {
    $codigo_librador_documento = $result_documento_libradores[0]['codigo_librador']; /* - */
    $nombre_documento = $result_documento_libradores[0]['nombre']; /* - */
    $apellido_1_documento = $result_documento_libradores[0]['apellido_1']; /* - */
    $apellido_2_documento = $result_documento_libradores[0]['apellido_2']; /* - */
    $razon_social_documento = $result_documento_libradores[0]['razon_social']; /* - */
    $razon_comercial_documento = $result_documento_libradores[0]['razon_comercial']; /* - */
    $nif_documento = $result_documento_libradores[0]['nif']; /* - */
    $direccion_documento = $result_documento_libradores[0]['direccion']; /* - */
    $numero_direccion_documento = $result_documento_libradores[0]['numero']; /* - */
    $escalera_direccion_documento = $result_documento_libradores[0]['escalera']; /* - */
    $piso_direccion_documento = $result_documento_libradores[0]['piso']; /* - */
    $puerta_direccion_documento = $result_documento_libradores[0]['puerta']; /* - */
    $localidad_documento = $result_documento_libradores[0]['localidad']; /* - */
    $codigo_postal_documento = $result_documento_libradores[0]['codigo_postal']; /* - */
    $provincia_documento = $result_documento_libradores[0]['provincia']; /* - */
    $telefono_1_documento = $result_documento_libradores[0]['telefono_1']; /* - */
    $telefono_2_documento = $result_documento_libradores[0]['telefono_2']; /* - */
    $fax_documento = $result_documento_libradores[0]['fax']; /* - */
    $email_documento = $result_documento_libradores[0]['email']; /* - */
    $persona_contacto_documento = $result_documento_libradores[0]['persona_contacto']; /* - */
    $telefono_1_envio_documento = $result_documento_libradores[0]['telefono_1']; /* - */
    $telefono_2_envio_documento = $result_documento_libradores[0]['telefono_2']; /* - */
    $mobil_documento = $result_documento_libradores[0]['mobil']; /* - */
    $persona_contacto_envio_documento = $result_documento_libradores[0]['persona_contacto']; /* - */
} else {
    $codigo_librador_documento = (isset($_POST['codigo_librador_documento']))? $_POST['codigo_librador_documento'] : '';
    $nombre_documento = (isset($_POST['nombre_documento']))? $_POST['nombre_documento'] : '';
    $apellido_1_documento = (isset($_POST['apellido_1_documento']))? $_POST['apellido_1_documento'] : '';
    $apellido_2_documento = (isset($_POST['apellido_2_documento']))? $_POST['apellido_2_documento'] : '';
    $razon_social_documento = (isset($_POST['razon_social_documento']))? $_POST['razon_social_documento'] : '';
    $razon_comercial_documento = (isset($_POST['razon_comercial_documento']))? $_POST['razon_comercial_documento'] : '';
    $nif_documento = (isset($_POST['nif_documento']))? $_POST['nif_documento'] : '';
    $direccion_documento = (isset($_POST['direccion_documento']))? $_POST['direccion_documento'] : '';
    $numero_direccion_documento = (isset($_POST['numero_direccion_documento']))? $_POST['numero_direccion_documento'] : '';
    $escalera_direccion_documento = (isset($_POST['escalera_direccion_documento']))? $_POST['escalera_direccion_documento'] : '';
    $piso_direccion_documento = (isset($_POST['piso_direccion_documento']))? $_POST['piso_direccion_documento'] : '';
    $puerta_direccion_documento = (isset($_POST['puerta_direccion_documento']))? $_POST['puerta_direccion_documento'] : '';
    $localidad_documento = (isset($_POST['localidad_documento']))? $_POST['localidad_documento'] : '';
    $codigo_postal_documento = (isset($_POST['codigo_postal_documento']))? $_POST['codigo_postal_documento'] : '';
    $provincia_documento = (isset($_POST['provincia_documento']))? $_POST['provincia_documento'] : '';
    $telefono_1_documento = (isset($_POST['telefono_1_documento']))? $_POST['telefono_1_documento'] : '';
    $telefono_2_documento = (isset($_POST['telefono_2_documento']))? $_POST['telefono_2_documento'] : '';
    $fax_documento = (isset($_POST['fax_documento']))? $_POST['fax_documento'] : '';
    $email_documento = (isset($_POST['email_documento']))? $_POST['email_documento'] : '';
    $persona_contacto_documento = (isset($_POST['persona_contacto_documento']))? $_POST['persona_contacto_documento'] : '';
    $telefono_1_envio_documento = (isset($_POST['telefono_1_envio_documento']))? $_POST['telefono_1_envio_documento'] : '';
    $telefono_2_envio_documento = (isset($_POST['telefono_2_envio_documento']))? $_POST['telefono_2_envio_documento'] : '';
    $mobil_documento = (isset($_POST['mobil_documento']))? $_POST['mobil_documento'] : '';
    $persona_contacto_envio_documento = (isset($_POST['persona_contacto_envio_documento']))? $_POST['persona_contacto_envio_documento'] : '';

    $signup_nombre = $nombre_documento;
    $signup_user = $email_documento;
    $signup_password = (isset($_POST['signup_password']))? $_POST['signup_password'] : '';
    if (!empty($signup_nombre) && !empty($signup_user) && !empty($signup_password)) {
        unset($conn);

        $select_sys = 'crear';
        $tipo_cuenta_registro = "persona";
        $nombre_registro = $signup_nombre;
        $email_registro = $signup_user;
        $password_registro = $signup_password;
        $tipo_documento_seleccionar = 'ped';
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");

        $conn = new db($id_panel);
        $conn->query("SET NAMES 'utf8'");
    }

    if (!empty($id_documento_1) && isset($_SESSION[$id_sesion_js]) && isset($_SESSION[$id_sesion_js]['id_librador'])) {
        unset($conn);

        $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
        $id_documento = $id_documento_1;
        $select_sys = 'guardar-seleccionar-librador';
        $guardar_ficha = 1;
        $fecha_recogida_documento = date('Y-m-d');
        $hora_recogida_documento = date('H:i:s');
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");

        $conn = new db($id_panel);
        $conn->query("SET NAMES 'utf8'");
    }
}

$id_zona_documento = $result_documento_libradores[0]['id_zona_documento']; /* - */

$result_documento_libradores_envio = $conn->query("SELECT * FROM documentos_" . $ejercicio . "_libradores_envio WHERE id_documentos_1=" . $id_documento_1 . " LIMIT 1");
if (isset($result_documento_libradores_envio[0]) && !isset($_POST['nombre_envio_documento'])) {
    $observaciones_envio_documento = $result_documento_libradores_envio[0]['observaciones']; /* - */
    $nombre_envio_documento = $result_documento_libradores_envio[0]['nombre']; /* - */
    $razon_social_envio_documento = $result_documento_libradores_envio[0]['razon_social']; /* - */
    $razon_comercial_envio_documento = $result_documento_libradores_envio[0]['razon_comercial']; /* - */
    $direccion_envio_documento = $result_documento_libradores_envio[0]['direccion']; /* - */
    $numero_direccion_envio_documento = $result_documento_libradores_envio[0]['numero']; /* - */
    $escalera_direccion_envio_documento = $result_documento_libradores_envio[0]['escalera']; /* - */
    $piso_direccion_envio_documento = $result_documento_libradores_envio[0]['piso']; /* - */
    $puerta_direccion_envio_documento = $result_documento_libradores_envio[0]['puerta']; /* - */
    $localidad_envio_documento = $result_documento_libradores_envio[0]['localidad']; /* - */
    $codigo_postal_envio_documento = $result_documento_libradores_envio[0]['codigo_postal']; /* - */
    $provincia_envio_documento = $result_documento_libradores_envio[0]['provincia']; /* - */
    $mobil_envio_documento = $result_documento_libradores_envio[0]['mobil']; /* - */
} else {
    $observaciones_envio_documento = (isset($_POST['observaciones_envio_documento']))? $_POST['observaciones_envio_documento'] : '';
    $nombre_envio_documento = (isset($_POST['nombre_envio_documento']))? $_POST['nombre_envio_documento'] : '';
    $razon_social_envio_documento = (isset($_POST['razon_social_envio_documento']))? $_POST['razon_social_envio_documento'] : '';
    $razon_comercial_envio_documento = (isset($_POST['razon_comercial_envio_documento']))? $_POST['razon_comercial_envio_documento'] : '';
    $direccion_envio_documento = (isset($_POST['direccion_envio_documento']))? $_POST['direccion_envio_documento'] : '';
    $numero_direccion_envio_documento = (isset($_POST['numero_direccion_envio_documento']))? $_POST['numero_direccion_envio_documento'] : '';
    $escalera_direccion_envio_documento = (isset($_POST['escalera_direccion_envio_documento']))? $_POST['escalera_direccion_envio_documento'] : '';
    $piso_direccion_envio_documento = (isset($_POST['piso_direccion_envio_documento']))? $_POST['piso_direccion_envio_documento'] : '';
    $puerta_direccion_envio_documento = (isset($_POST['puerta_direccion_envio_documento']))? $_POST['puerta_direccion_envio_documento'] : '';
    $localidad_envio_documento = (isset($_POST['localidad_envio_documento']))? $_POST['localidad_envio_documento'] : '';
    $codigo_postal_envio_documento = (isset($_POST['codigo_postal_envio_documento']))? $_POST['codigo_postal_envio_documento'] : '';
    $provincia_envio_documento = (isset($_POST['provincia_envio_documento']))? $_POST['provincia_envio_documento'] : '';
    $mobil_envio_documento = (isset($_POST['mobil_envio_documento']))? $_POST['mobil_envio_documento'] : '';
}

// de momento no se aplica el iva y el recargo del librador
$iva_librador = ''; /* - */
$recargo_librador = ''; /* - */

$orden = 0;
$nota_documento = ''; /* - */
$elemento = 0; /* - */
$id_producto = $_POST['id_producto']; /* - */
$cantidad = $_POST['cantidad'];

if (empty($id_producto)) {
    $insertar_modalidad_envio = (isset($_POST['insertar_modalidad_envio']))? $_POST['insertar_modalidad_envio'] : false;
    $insertar_metodo_pago = (isset($_POST['insertar_metodo_pago']))? $_POST['insertar_metodo_pago'] : false;
    if ($insertar_modalidad_envio) {
        $result_envios = $conn->query("SELECT * FROM modalidades_envio WHERE id=" . $modalidad_envio . " LIMIT 1");
        if (isset($result_envios[0])) {
            $imagen_producto = ''; /* - */
            $descripcion_producto = $result_envios[0]['descripcion']; /* - */
            $pvp_modalidad_envio = $result_envios[0]['incremento_pvp']; /* - */

            $select_sys = 'obtener_metodos_envio';
            $id_zona = $_POST['zona'];
            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-checkout.php");
            $conn = new db($id_panel);
            $conn->query("SET NAMES 'utf8'");
            foreach ($id_modalidades_envio as $key_modalidad_envio => $id_modalidad_envio) {
                if ($id_modalidad_envio == $modalidad_envio) {
                    $pvp_modalidad_envio = $incremento_pvp_modalidades_envio[$key_modalidad_envio];
                    if ($incremento_pvp_zona_modalidades_envio[$key_modalidad_envio]) {
                        $pvp_modalidad_envio = $incremento_pvp_zona_modalidades_envio[$key_modalidad_envio];
                    }
                    if ($incremento_pvp_zona_peso_modalidades_envio[$key_modalidad_envio]) {
                        $pvp_modalidad_envio = $incremento_pvp_zona_peso_modalidades_envio[$key_modalidad_envio];
                    }
                }
            }
            $pvp_modalidad_envio = number_format($pvp_modalidad_envio, 2, '.', '');

            $tipo_producto = 0; /* - */
            $id_iva_producto = $result_envios[0]['id_iva']; /* - */
            $detalles_producto = strip_tags($result_envios[0]['explicacion']); /* - */
            $result_productos_iva = $conn->query("SELECT * FROM productos_iva WHERE id=" . $id_iva_producto . " LIMIT 1");
            if (isset($result_productos_iva[0])) {
                $iva_producto = $result_productos_iva[0]['iva']; /* - */
                //$recargo_producto = $result_productos_iva[0]['recargo']; /* - */
                $recargo_producto = 0; /* - */
            } else {
                throw new Exception('No se puede continuar sin los datos de iva de producto.');
            }

            $id_enlazado = ''; /* - */
            $id_multiple = ''; /* - */
            $id_pack = ''; /* - */
        } else {
            throw new Exception('No se puede continuar sin los datos de producto.');
        }
    } else if ($insertar_metodo_pago) {
        $result_pago = $conn->query("SELECT * FROM metodos_pago WHERE id=" . $metodo_pago . " LIMIT 1");
        if (isset($result_pago[0])) {
            $imagen_producto = $result_pago[0]['imagen']; /* - */
            $descripcion_producto = $result_pago[0]['descripcion']; /* - */
            if ($result_pago[0]['incremento_por'] && $result_pago[0]['incremento_por'] > 0) {
                $pvp_metodo_pago = ($totalParaCalculoMetodoDePago / 100) * $result_pago[0]['incremento_por'];
            } else {
                $pvp_metodo_pago = $result_pago[0]['incremento_pvp']; /* - */
            }
            $tipo_producto = 0; /* - */
            $id_iva_producto = $result_pago[0]['id_iva']; /* - */
            $detalles_producto = strip_tags($result_pago[0]['explicacion']); /* - */
            $result_productos_iva = $conn->query("SELECT * FROM productos_iva WHERE id=" . $id_iva_producto . " LIMIT 1");
            if (isset($result_productos_iva[0])) {
                $iva_producto = $result_productos_iva[0]['iva']; /* - */
                //$recargo_producto = $result_productos_iva[0]['recargo']; /* - */
                $recargo_producto = 0; /* - */
            } else {
                throw new Exception('No se puede continuar sin los datos de iva de producto.');
            }

            $id_enlazado = ''; /* - */
            $id_multiple = ''; /* - */
            $id_pack = ''; /* - */
        } else {
            throw new Exception('No se puede continuar sin los datos de producto.');
        }
    } else {
        throw new Exception('No se puede continuar sin los datos de producto.');
    }
} else {
    $result_productos = $conn->query("SELECT * FROM productos WHERE id=" . $id_producto . " LIMIT 1");
    if (isset($result_productos[0])) {
        $imagen_producto = $result_productos[0]['imagen']; /* - */
        $descripcion_producto = $result_productos[0]['descripcion']; /* - */
        $tipo_producto = $result_productos[0]['tipo_producto']; /* - */
        $id_iva_producto = $result_productos[0]['id_iva']; /* - */
        $result_productos_iva = $conn->query("SELECT * FROM productos_iva WHERE id=" . $id_iva_producto . " LIMIT 1");
        if (isset($result_productos_iva[0])) {
            $iva_producto = $result_productos_iva[0]['iva']; /* - */
            //$recargo_producto = $result_productos_iva[0]['recargo']; /* - */
            $recargo_producto = 0; /* - */
        } else {
            throw new Exception('No se puede continuar sin los datos de iva de producto.');
        }

        $id_enlazado = ''; /* - */
        $id_multiple = ''; /* - */
        $id_pack = $_POST['id_pack']; /* - */
    } else {
        throw new Exception('No se puede continuar sin los datos de producto.');
    }
}

if ($id_producto) {
    $result_productos_pvp = $conn->query("SELECT * FROM productos_pvp WHERE id_producto=" . $id_producto . " AND id_packs = " . $id_pack . " AND id_tarifa=" . $id_tarifa_web . " LIMIT 1");
    if (isset($result_productos_pvp[0])) {
        $importe = '';
        $importe_fijo = '';
        $descuento_base = '';
        $importe_descuento_base = '';


        $base = $result_productos_pvp[0]['pvp'] / (1 + $iva_producto/100 + $recargo_producto/100);
        $recargo = $base * $recargo_producto / 100;
        $pvp_linea = $result_productos_pvp[0]['pvp'] * $cantidad;
        $pvp_unidad = $result_productos_pvp[0]['pvp'];
        $pvp_unidad_sin_incrementos = $result_productos_pvp[0]['pvp'];
        $incremento_unidad = 0;
        $unidad_producto = ''; /* - id unidades */
        $id_unidades = $unidad_producto;
        $descuento_total = 0;
        $importe_descuento_total = 0;
    } else {
        throw new Exception('No se puede continuar sin los datos de precios de producto.');
    }
} else if ($insertar_modalidad_envio) {
    $importe = '';
    $importe_fijo = '';
    $descuento_base = '';
    $importe_descuento_base = '';


    $base = $pvp_modalidad_envio / (1 + $iva_producto/100 + $recargo_producto/100);
    $recargo = $base * $recargo_producto / 100;
    $pvp_linea = $pvp_modalidad_envio * $cantidad;
    $pvp_unidad = $pvp_modalidad_envio;
    $pvp_unidad_sin_incrementos = $pvp_modalidad_envio;
    $incremento_unidad = 0;
    $unidad_producto = ''; /* - id unidades */
    $id_unidades = $unidad_producto;
    $descuento_total = 0;
    $importe_descuento_total = 0;
} else if ($insertar_metodo_pago) {
    $importe = '';
    $importe_fijo = '';
    $descuento_base = '';
    $importe_descuento_base = '';


    $base = $pvp_metodo_pago / (1 + $iva_producto/100 + $recargo_producto/100);
    $recargo = $base * $recargo_producto / 100;
    $pvp_linea = $pvp_metodo_pago * $cantidad;
    $pvp_unidad = $pvp_metodo_pago;
    $pvp_unidad_sin_incrementos = $pvp_metodo_pago;
    $incremento_unidad = 0;
    $unidad_producto = ''; /* - id unidades */
    $id_unidades = $unidad_producto;
    $descuento_total = 0;
    $importe_descuento_total = 0;
} else {
    throw new Exception('No se puede continuar sin los datos de precios de producto.');
}


$descripcion_atributos_producto = ''; /* - */
if (!isset($detalles_producto)) {
    $detalles_producto = ''; /* - */
}
$descripcion_oferta = '';
$id_productos_sku = ''; /* - */
$codigo_barras_producto = ''; /* - */
$referencia_producto = ''; /* - */
$lote_producto = ''; /* - */
$cantidad_lote_producto = '';
$numero_serie_producto = ''; /* - */
$caducidad_producto = ''; /* - */
$disponibilidad_producto = 1; /* - */
$peso_producto = ''; /* - */
$envio_gratis_producto = ''; /* - */
$cantidad_incremento = '';
$sumar_incremento = ''; /* - */
$referencia_librador = '';
$numero_serie = '';
$caducidad = '';
if (!isset($nota_producto)) {
    $nota_producto = ''; /* - */
}
$coste_producto = '';
$packs_disponibles = ''; /* - */
$descripcion_oferta = ''; /* - */
$id_documento_anterior = '';
$id_vendedor = '';
$observacion = '';

$id_linea = $_POST['id_linea']; /* - */
/* Comento esta linea la function isDate
 * se declara mucho despues
 *
 * if(!empty($fecha_documento) && !isDate($fecha_documento)) {
    $fecha_documento = date("Y-m-d");
}*/
