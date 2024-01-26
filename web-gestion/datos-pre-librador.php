<?php
session_start();

header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$id_sesion_js = filter_input(INPUT_POST, 'id_sesion_js', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$so_sys = filter_input(INPUT_POST, 'so', FILTER_SANITIZE_STRING);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$interface = trim($_POST['interface_js']);
if($interface == "web") {
    $id_panel = trim($_POST['id_panel']);
}
$id_documento = trim($_POST['id_documento']);
$ejercicio = trim($_POST['ejercicio']);
$select_sys = trim($_POST["select"]);

$busqueda = addslashes(trim($_POST["texto_buscar"]));

$nombre_registro = trim($_POST["nombre_registro"]);
$tipo_cuenta_registro = trim($_POST["tipo_cuenta_registro"]);
$email_registro = trim($_POST["email_registro"]);
$password_registro = trim($_POST["password_registro"]);
$tipo_librador = trim($_POST["tipo_librador"]);
$id_librador = trim($_POST["id_librador"]);
$tipo_documento_seleccionar = trim($_POST["tipo_documento_seleccionar"]);
$comensales = trim($_POST["comensales"]);

$codigo_librador_documento = trim($_POST["codigo_librador_documento"]);
$nombre_documento = trim($_POST["nombre_documento"]);
$apellido_1_documento = trim($_POST["apellido_1_documento"]);
$apellido_2_documento = trim($_POST["apellido_2_documento"]);
$razon_social_documento = trim($_POST["razon_social_documento"]);
$razon_comercial_documento = trim($_POST["razon_comercial_documento"]);
$nif_documento = trim($_POST["nif_documento"]);
$direccion_documento = trim($_POST["direccion_documento"]);
$numero_direccion_documento = trim($_POST["numero_direccion_documento"]);
$escalera_direccion_documento = trim($_POST["escalera_direccion_documento"]);
$piso_direccion_documento = trim($_POST["piso_direccion_documento"]);
$puerta_direccion_documento = trim($_POST["puerta_direccion_documento"]);
$localidad_documento = trim($_POST["localidad_documento"]);
$codigo_postal_documento = trim($_POST["codigo_postal_documento"]);
$fecha_entrega_documento = trim($_POST["fecha_entrega_documento"]);
$hora_entrega_documento = trim($_POST["hora_entrega_documento"]);
$provincia_documento = trim($_POST["provincia_documento"]);
$telefono_1_documento = trim($_POST["telefono_1_documento"]);
$telefono_2_documento = trim($_POST["telefono_2_documento"]);
$fax_documento = trim($_POST["fax_documento"]);
$mobil_documento = trim($_POST["mobil_documento"]);
$email_documento = trim($_POST["email_documento"]);
$persona_contacto_documento = trim($_POST["persona_contacto_documento"]);
$guardar_ficha = trim($_POST["guardar_ficha"]);

$id_datos_envio = trim($_POST['id_datos_envio']);
$actualizar_ficha = trim($_POST['actualizar_ficha']);
$nombre_envio_documento = trim($_POST['nombre_envio_documento']);
$apellido_1_envio = trim($_POST['apellido_1_envio']);
$apellido_2_envio = trim($_POST['apellido_2_envio']);
$razon_social_envio_documento = trim($_POST['razon_social_envio_documento']);
$razon_comercial_envio_documento = trim($_POST['razon_comercial_envio_documento']);
$direccion_envio_documento = trim($_POST['direccion_envio_documento']);
$numero_direccion_envio_documento = trim($_POST['numero_direccion_envio_documento']);
$escalera_direccion_envio_documento = trim($_POST['escalera_direccion_envio_documento']);
$piso_direccion_envio_documento = trim($_POST['piso_direccion_envio_documento']);
$puerta_direccion_envio_documento = trim($_POST['puerta_direccion_envio_documento']);
$localidad_envio_documento = trim($_POST['localidad_envio_documento']);
$codigo_postal_envio_documento = trim($_POST['codigo_postal_envio_documento']);
$provincia_envio_documento = trim($_POST['provincia_envio_documento']);
$id_zona_envio = trim($_POST['id_zona_envio']);
$telefono_1_envio_documento = trim($_POST['telefono_1_envio_documento']);
$telefono_2_envio_documento = trim($_POST['telefono_2_envio_documento']);
$mobil_envio_documento = trim($_POST['mobil_envio_documento']);
$persona_contacto_envio_documento = trim($_POST['persona_contacto_envio_documento']);
$observaciones_envio_documento = trim($_POST['observaciones_envio_documento']);

$serie_documento = trim($_POST['serie_documento']);
$numero_documento = trim($_POST['numero_documento']);
$fecha_documento = trim($_POST['fecha_documento']);
$fecha_entrada = trim($_POST['fecha_entrada']);
$id_modalidad_pago = trim($_POST['id_modalidad_pago']);
$id_modalidad_envio = trim($_POST['id_modalidad_envio']);
$id_modalidad_entrega = trim($_POST['id_modalidad_entrega']);
$recargo_documento_cesta = trim($_POST['recargo_documento_cesta']);
$irpf_documento_cesta = trim($_POST['irpf_documento_cesta']);
$descuento_pp_documento_cesta = trim($_POST['descuento_pp_documento_cesta']);
$descuento_librador_documento_cesta = trim($_POST['descuento_librador_documento_cesta']);
$descuento_librador_euro_documento_cesta = trim($_POST['descuento_librador_euro_documento_cesta']);

$fracciones = trim($_POST['fracciones']);
$total_fraccionar = trim($_POST['total_fraccionar']);
$total_fraccionar = str_replace(',','.',$total_fraccionar);

$nota_documento_cesta = trim($_POST['nota_documento_cesta']);

if($tipo_librador == "tak") {
    $fecha_recogida_documento = trim($_POST['fecha_recogida_documento']);
    $hora_recogida_documento = trim($_POST['hora_recogida_documento']);
}else {
    $fecha_recogida_documento = "0000-00-00";
    $hora_recogida_documento = "00:00:00";
}

$ajax = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

if($interface == "tpv") {
    // ESTE CODIGO ASEGURA QUE LA ID DEL PANEL ES LA DE LA SESION IDENTIFICADA.
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
    if ($conn->registros() == 1) {
        $id_panel = $result[0]['id_panel'];
    } else {
        throw new Exception("Acceso no permitido.");
    }
    unset($conn);
}

require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");