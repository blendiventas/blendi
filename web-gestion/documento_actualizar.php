<?php
header('Content-Type: application/json');

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$id_sesion = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$idioma = filter_input(INPUT_POST, 'idioma', FILTER_SANITIZE_STRING);
$ejercicio = $_POST['ejercicio'];
$tipo_librador = $_POST['tipo_librador'];
$interface = $_POST['interface_js'];
if($interface == "web") {
    $tienda = $_POST['tienda'];

    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id,sector FROM identificacion_panel WHERE web_blendi='" . addslashes($tienda) . "' LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id'];
        $sector = $result[0]['sector'];
    } else {
        throw new Exception('Negocio no encontrado.');
    }
    unset($conn);
}
$id_documento_1 = filter_input(INPUT_POST, 'id_documento_1', FILTER_SANITIZE_NUMBER_INT);
$decimales_cantidades = filter_input(INPUT_POST, 'decimales_cantidades', FILTER_SANITIZE_NUMBER_INT);
$decimales_importes = filter_input(INPUT_POST, 'decimales_importes', FILTER_SANITIZE_NUMBER_INT);

$funcion_origen = filter_input(INPUT_POST, 'funcion_origen', FILTER_SANITIZE_STRING);
/*
 * Valores de funcion_origen:
        actualizarCesta
        productosCobro
        datosCobrar
        imprimirDocumento
*/

if(empty($ejercicio)) { $ejercicio = date("Y"); }

$datos = "";
foreach ($_POST as $key => $valor) {
    $datos .= $key.": ".$valor."<br />";
}

$logs = new stdClass();

$logs->datos = $datos;

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

if($funcion_origen == 'tiquetCamarero' && $interface == "tpv") {
    require("documento_actualizar_camarero.php");
}elseif($funcion_origen == 'carritoWeb') {
    require("documento_actualizar_carrito.php");
}else {
    require("documento_actualizar_datos.php");

    $logs->nombre_fiscal = $nombre_fiscal;
    $logs->nombre_comercial = $nombre_comercial;
    $logs->nif = $nif;
    $logs->direccion = $direccion;
    $logs->codigo_postal = $codigo_postal;
    $logs->poblacion = $poblacion;
    $logs->provincia = $provincia;
    $logs->tel1 = $tel1;
    $logs->tel2 = $tel2;
    $logs->movil = $movil;
    $logs->fax = $fax;
    $logs->email = $email;
    $logs->logo = $logo;

    $logs->selec1 = "SELECT * FROM documentos_" . $ejercicio . "_1 WHERE id=" . $id_documento_1 . " LIMIT 1";

    $logs->tipo_documento = $tipo_documento;
    $logs->tipo_librador = $tipo_librador;
    $logs->id_librador = $id_librador;
    $logs->fecha_documento = $fecha_documento;
    $logs->fecha_entrada = $fecha_entrada;
    $logs->numero_documento = $numero_documento;
    $logs->serie_documento = $serie_documento;
    $logs->modalidad_pago = $modalidad_pago;
    $logs->modalidad_envio = $modalidad_envio;
    $logs->modalidad_entrega = $modalidad_entrega;
    $logs->id_modalidad_pago = $id_modalidad_pago;
    $logs->id_modalidad_envio = $id_modalidad_envio;
    $logs->id_modalidad_entrega = $id_modalidad_entrega;
    $logs->irpf = $irpf;
    $logs->importe_irpf = $importe_irpf;
    $logs->descuento_pp = $descuento_pp;
    $logs->importe_descuento_pp = $importe_descuento_pp;
    $logs->descuento_librador = $descuento_librador;
    $logs->importe_descuento_librador = $importe_descuento_librador;
    $logs->total = number_format($total, 2, ",", ".");
    $logs->estado = $estado_1;
    $logs->id_usuario_documento = $id_usuario;
    $logs->comensales = $comensales;
    $logs->id_terminal = $id_terminal_1;

    $logs->usuario_documento = $usuario_documento;

    $logs->nota_documento = $nota_documento;

    $logs->nombre_librador = $nombre_librador;
    $logs->apellido_1_librador = $apellido_1_librador;
    $logs->apellido_2_librador = $apellido_2_librador;
    $logs->razon_social_librador = $razon_social_librador;
    $logs->nif_librador = $nif_librador;
    $logs->direccion_librador = $direccion_librador;
    $logs->numero_librador = $numero_librador;
    $logs->escalera_librador = $escalera_librador;
    $logs->piso_librador = $piso_librador;
    $logs->puerta_librador = $puerta_librador;
    $logs->codigo_postal_librador = $codigo_postal_librador;
    $logs->localidad_librador = $localidad_librador;
    $logs->provincia_librador = $provincia_librador;
    $logs->telefono_1_librador = $telefono_1_librador;
    $logs->telefono_2_librador = $telefono_2_librador;
    $logs->movil_librador = $movil_librador;
    $logs->email_librador = $email_librador;
    $logs->persona_contacto_librador = $persona_contacto_librador;

    $logs->selec2_2 = "SELECT * FROM documentos_" . $ejercicio . "_2 WHERE id_documentos_1=" . $id_documento_1 . " ORDER BY id";

    $logs->selec_nota_producto = "SELECT * FROM documentos_" . $ejercicio . "_observaciones WHERE id_documentos_2=" . $valor['id'] . " AND id_documentos_combo = 0 LIMIT 1";

    if (isset($id_documento_2)) {
        $logs->lineas = true;
        $logs->id_documento_2 = $id_documento_2;
        $logs->fecha = $fecha;
        $logs->id_producto = $id_producto;
        $logs->id_productos_detalles_enlazado = $id_productos_detalles_enlazado;
        $logs->id_productos_detalles_multiples = $id_productos_detalles_multiples;
        $logs->id_packs = $id_packs;
        $logs->slug = $slug;
        $logs->tipo_producto = $tipo_producto;
        $logs->imagen_producto = $imagen_producto;
        $logs->descripcion_producto = $descripcion_producto;
        $logs->detalles_producto = $detalles_producto;
        $logs->descripcion_oferta = $descripcion_oferta;
        $logs->codigo_barras_producto = $codigo_barras_producto;
        $logs->referencia_producto = $referencia_producto;
        $logs->referencia_librador = $referencia_librador;
        $logs->numero_serie = $numero_serie_producto;
        $logs->lote = $lote_producto;
        $logs->caducidad = $caducidad_producto;
        $logs->cantidad = $cantidad;
        $logs->id_unidades = $id_unidades;
        $logs->unidad = $unidad;
        $logs->coste = $coste;
        $logs->importe = $importe;
        $logs->importe_fijo = $importe_fijo;
        $logs->base_antes_descuento = $base_antes_descuento;
        $logs->descuento_base = $descuento_base;
        $logs->importe_descuento_base = $importe_descuento_base;
        $logs->base_despues_descuento = $base_despues_descuento;
        $logs->base = number_format($base, 2, ",", ".");
        $logs->iva = $iva;
        $logs->importe_iva = $importe_iva;
        $logs->recargo = $recargo;
        $logs->importe_recargo = $importe_recargo;
        $logs->pvp_unidad = $pvp_unidad;
        $logs->pvp_unidad_sin_incrementos = $pvp_unidad_sin_incrementos;
        $logs->total_antes_descuento = $total_antes_descuento;
        $logs->descuento_total = $descuento_total;
        $logs->importe_descuento_total = $importe_descuento_total;
        $logs->total_despues_descuento = $total_despues_descuento;
        $logs->id_documento_anterior = $id_documento_anterior;
        $logs->id_vendedor = $id_vendedor;
        $logs->estado_linea = $estado_2;
        $logs->id_usuario = $id_usuario;
        $logs->orden = $orden;

        $logs->orden_descripcion_cantidades = $orden_descripcion_cantidades;
        $logs->orden_cantidades = $orden_cantidades;

        $logs->hora = $hora;
        $logs->id_terminal_linea = $id_terminal_2;

        $logs->indice = $indice;
        $logs->base_iva = $base_iva;
        $logs->iva = $iva;
        $logs->importe_iva = $importe_iva;
        $logs->recargo = $recargo;
        $logs->importe_recargo = $importe_recargo;

        $logs->nota_producto = $nota_producto;

        if (isset($id_recibos)) {
            $logs->id_recibos = $id_recibos;
            $logs->importe_recibos = $importe_recibos;
            $logs->documento_bancario = $documento_bancario;
            $logs->vencimiento_documento_bancario = $vencimiento_documento_bancario;
            $logs->nota = $nota;
            $logs->fecha_recibos = $fecha_recibos;
            $logs->vencimiento_recibos = $vencimiento_recibos;
            $logs->pagado_recibos = $pagado_recibos;
            $logs->fecha_pago_recibos = $fecha_pago_recibos;
            $logs->id_banco_caja_ingreso_recibos = $id_banco_caja_ingreso_recibos;
            $logs->id_bancos_cajas_ingreso_recibos = $id_bancos_cajas_ingreso_recibos;
            $logs->bancos_cajas_ingreso_recibos = $bancos_cajas_ingreso_recibos;
            $logs->iban_bancos_cajas_ingreso_recibos = $iban_bancos_cajas_ingreso_recibos;
            $logs->id_metodo_pago_recibos = $id_metodo_pago_recibos;
            $logs->id_metodos_pago_recibos = $id_metodos_pago_recibos;
            $logs->metodos_pago_recibos = $metodos_pago_recibos;
            $logs->metodos_pago = $metodos_pago;
            $logs->id_modalidad_pago_recibos = $id_modalidad_pago_recibos;
            $logs->numero_efecto_recibos = $numero_efecto_recibos;
            $logs->id_usuario_pago_recibos = $id_usuario_pago_recibos;
            $logs->id_usuarios_pago_recibos = $id_usuarios_pago_recibos;
            $logs->usuarios_pago_recibos = $usuarios_pago_recibos;
            $logs->impreso_recibos = $impreso_recibos;
            $logs->bancos_cajas_ingreso_recibos = $bancos_cajas_ingreso_recibos;
            $logs->metodos_pago_recibos = $metodos_pago_recibos;
            $logs->usuarios_pago_recibos = $usuarios_pago_recibos;
        }
    } else {
        $logs->lineas = false;
    }

    echo json_encode($logs);
}