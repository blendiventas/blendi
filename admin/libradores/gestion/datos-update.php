<?php
header('Content-Type: application/json');

$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_libradores = filter_input(INPUT_POST, 'id_libradores', FILTER_SANITIZE_NUMBER_INT);
$tipo_librador = filter_input(INPUT_POST, 'tipo_librador', FILTER_SANITIZE_STRING);
$id_grupo_clientes_libradores = filter_input(INPUT_POST, 'id_grupo_clientes_libradores', FILTER_SANITIZE_NUMBER_INT);
$codigo_librador_libradores = filter_input(INPUT_POST, 'codigo_librador_libradores', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$nombre_libradores = filter_input(INPUT_POST, 'nombre_libradores', FILTER_SANITIZE_STRING);
$apellido_1_libradores = filter_input(INPUT_POST, 'apellido_1_libradores', FILTER_SANITIZE_STRING);
$apellido_2_libradores = filter_input(INPUT_POST, 'apellido_2_libradores', FILTER_SANITIZE_STRING);
$razon_social_libradores = filter_input(INPUT_POST, 'razon_social_libradores', FILTER_SANITIZE_STRING);
$razon_comercial_libradores = filter_input(INPUT_POST, 'razon_comercial_libradores', FILTER_SANITIZE_STRING);
$nif_libradores = filter_input(INPUT_POST, 'nif_libradores', FILTER_SANITIZE_STRING);
$direccion_libradores = filter_input(INPUT_POST, 'direccion_libradores', FILTER_SANITIZE_STRING);
$numero_libradores = filter_input(INPUT_POST, 'numero_libradores', FILTER_SANITIZE_STRING);
$escalera_libradores = filter_input(INPUT_POST, 'escalera_libradores', FILTER_SANITIZE_STRING);
$piso_libradores = filter_input(INPUT_POST, 'piso_libradores', FILTER_SANITIZE_STRING);
$puerta_libradores = filter_input(INPUT_POST, 'puerta_libradores', FILTER_SANITIZE_STRING);
$localidad_libradores = filter_input(INPUT_POST, 'localidad_libradores', FILTER_SANITIZE_STRING);
$codigo_postal_libradores = filter_input(INPUT_POST, 'codigo_postal_libradores', FILTER_SANITIZE_STRING);
$provincia_libradores = filter_input(INPUT_POST, 'provincia_libradores', FILTER_SANITIZE_STRING);
$id_zona_libradores = filter_input(INPUT_POST, 'id_zona_libradores', FILTER_SANITIZE_NUMBER_INT);
$telefono_1_libradores = filter_input(INPUT_POST, 'telefono_1_libradores', FILTER_SANITIZE_STRING);
$telefono_2_libradores = filter_input(INPUT_POST, 'telefono_2_libradores', FILTER_SANITIZE_STRING);
$fax_libradores = filter_input(INPUT_POST, 'fax_libradores', FILTER_SANITIZE_STRING);
$mobil_libradores = filter_input(INPUT_POST, 'mobil_libradores', FILTER_SANITIZE_STRING);
$email_libradores = filter_input(INPUT_POST, 'email_libradores', FILTER_SANITIZE_STRING);
$password_acceso_libradores = filter_input(INPUT_POST, 'password_acceso_libradores', FILTER_SANITIZE_STRING);
$id_categoria_sms_libradores = filter_input(INPUT_POST, 'id_categoria_sms_libradores', FILTER_SANITIZE_NUMBER_INT);
$id_categoria_email_libradores = filter_input(INPUT_POST, 'id_categoria_email_libradores', FILTER_SANITIZE_NUMBER_INT);
$persona_contacto_libradores = filter_input(INPUT_POST, 'persona_contacto_libradores', FILTER_SANITIZE_STRING);
$banco_libradores = filter_input(INPUT_POST, 'banco_libradores', FILTER_SANITIZE_STRING);
$entidad_libradores = filter_input(INPUT_POST, 'entidad_libradores', FILTER_SANITIZE_STRING);
$agencia_libradores = filter_input(INPUT_POST, 'agencia_libradores', FILTER_SANITIZE_STRING);
$dc_libradores = filter_input(INPUT_POST, 'dc_libradores', FILTER_SANITIZE_STRING);
$cuenta_libradores = filter_input(INPUT_POST, 'cuenta_libradores', FILTER_SANITIZE_STRING);
$iban_libradores = filter_input(INPUT_POST, 'iban_libradores', FILTER_SANITIZE_STRING);
$sexo_libradores = filter_input(INPUT_POST, 'sexo_libradores', FILTER_SANITIZE_STRING);
$fecha_nacimiento_libradores = filter_input(INPUT_POST, 'fecha_nacimiento_libradores', FILTER_SANITIZE_STRING);
$observaciones_libradores = filter_input(INPUT_POST, 'observaciones_libradores', FILTER_SANITIZE_STRING);
$id_modalidades_envio_libradores = filter_input(INPUT_POST, 'id_modalidades_envio_libradores', FILTER_SANITIZE_STRING);
$id_modalidades_entrega_libradores = filter_input(INPUT_POST, 'id_modalidades_entrega_libradores', FILTER_SANITIZE_STRING);
$id_modalidades_pago_libradores = filter_input(INPUT_POST, 'id_modalidades_pago_libradores', FILTER_SANITIZE_STRING);
$plazo_entrega_libradores = filter_input(INPUT_POST, 'plazo_entrega_libradores', FILTER_SANITIZE_NUMBER_INT);
$id_iva_libradores = filter_input(INPUT_POST, 'id_iva_libradores', FILTER_SANITIZE_STRING);
$recargo_libradores = filter_input(INPUT_POST, 'recargo_libradores', FILTER_SANITIZE_STRING);
$id_irpf_libradores = filter_input(INPUT_POST, 'id_irpf_libradores', FILTER_SANITIZE_STRING);
$dia_pago_1_libradores = filter_input(INPUT_POST, 'dia_pago_1_libradores', FILTER_SANITIZE_STRING);
$dia_pago_2_libradores = filter_input(INPUT_POST, 'dia_pago_2_libradores', FILTER_SANITIZE_STRING);
$descuento_pp_libradores = filter_input(INPUT_POST, 'descuento_pp_libradores', FILTER_SANITIZE_STRING);
$descuento_librador_libradores = filter_input(INPUT_POST, 'descuento_librador_libradores', FILTER_SANITIZE_STRING);
$id_tarifa_web_libradores = filter_input(INPUT_POST, 'id_tarifa_web_libradores', FILTER_SANITIZE_NUMBER_INT);
$id_tarifa_tpv_libradores = filter_input(INPUT_POST, 'id_tarifa_tpv_libradores', FILTER_SANITIZE_NUMBER_INT);
$procedencia_libradores = filter_input(INPUT_POST, 'procedencia_libradores', FILTER_SANITIZE_STRING);
$id_cliente_origen_libradores = filter_input(INPUT_POST, 'id_cliente_origen_libradores', FILTER_SANITIZE_NUMBER_INT);
$id_vendedor_libradores = filter_input(INPUT_POST, 'id_vendedor_libradores', FILTER_SANITIZE_NUMBER_INT);
$id_nivel_comisiones_libradores = filter_input(INPUT_POST, 'id_nivel_comisiones_libradores', FILTER_SANITIZE_NUMBER_INT);
$activo_libradores = filter_input(INPUT_POST, 'activo_libradores', FILTER_SANITIZE_NUMBER_INT);
$id_banco_cobro_libradores = filter_input(INPUT_POST, 'id_banco_cobro_libradores', FILTER_SANITIZE_STRING);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
if($tipo == "mes") {
    $imagen_mesa = filter_input(INPUT_POST, 'imagen_mesa', FILTER_SANITIZE_STRING);
    $imagen_mesa_ocupada = filter_input(INPUT_POST, 'imagen_mesa_ocupada', FILTER_SANITIZE_STRING);
    $radio = filter_input(INPUT_POST, 'radio_mesa', FILTER_SANITIZE_NUMBER_INT);
    $id_comedor = filter_input(INPUT_POST, 'id_comedor', FILTER_SANITIZE_NUMBER_INT);
    $comensales = filter_input(INPUT_POST, 'comensales_mesa', FILTER_SANITIZE_NUMBER_INT);
    $ancho_pos = filter_input(INPUT_POST, 'ancho_pos_mesa', FILTER_SANITIZE_NUMBER_INT);
    $alto_pos = filter_input(INPUT_POST, 'alto_pos_mesa', FILTER_SANITIZE_NUMBER_INT);
    $ancho = filter_input(INPUT_POST, 'ancho_mesa', FILTER_SANITIZE_NUMBER_INT);
    $alto = filter_input(INPUT_POST, 'alto_mesa', FILTER_SANITIZE_NUMBER_INT);
}else {
    $imagen_mesa = "";
    $imagen_mesa_ocupada = "";
    $radio = 0;
    $id_comedor = 0;
    $comensales = 0;
    $ancho_pos = 0;
    $alto_pos = 0;
    $ancho = 0;
    $alto = 0;
}

if($tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "cli") {
    $tipo = $tipo_librador;
}

$apartado = '';
if(isset($_POST['apartado'])) {
    $apartado = $_POST['apartado'];
    if($select_sys == 'guardar') {
        if($apartado == 'costes-importes') {
            $id_libradores_productos = $_POST['id_libradores_productos'];
            $id_librador = $_POST['id_librador'];
            $id_producto = $_POST['id_producto'];
            $coste_importe = $_POST['coste_importe'];
        }else if($apartado == 'eliminar-costes-importes') {
            $id_libradores_productos = $_POST['id_libradores_productos'];
        }
    }
}

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/gestion/datos-update-php.php");