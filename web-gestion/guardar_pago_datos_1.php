<?php
$result = $conn->query("SELECT * FROM documentos_".$ejercicio."_1 WHERE id = " . $id_documento_1 . " LIMIT 1");

$id_modalidad_pago = 0;
$modalidad_pago = $result[0]['modalidad_pago'];
$logs->modalidades_pago = "SELECT id FROM modalidades_pago WHERE descripcion='".addslashes($modalidad_pago)."' LIMIT 1";
$result_modalidades_pago = $conn->query("SELECT id FROM modalidades_pago WHERE descripcion='".addslashes($modalidad_pago)."' LIMIT 1");
if($conn->registros() == 1) {
    $id_modalidad_pago = $result_modalidades_pago[0]['id'];
}

$id_sesion = stripslashes($result[0]['id_sesion']);
$ip = stripslashes($result[0]['ip']);
$so = stripslashes($result[0]['so']);
$tipo_documento = stripslashes($result[0]['tipo_documento']);
$interface = stripslashes($result[0]['procedencia']);
$tipo_librador = stripslashes($result[0]['tipo_librador']);
$id_librador = $result[0]['id_librador'];
$fecha_documento = $result[0]['fecha_documento'];
$fecha_entrega_desde = $result[0]['fecha_entrega_desde'];
$fecha_entrega_hasta = $result[0]['fecha_entrega_hasta'];
$numero_documento = stripslashes($result[0]['numero_documento']);
$serie_documento = stripslashes($result[0]['serie_documento']);
$modalidad_pago = stripslashes($result[0]['modalidad_pago']);
$modalidad_envio = stripslashes($result[0]['modalidad_envio']);
$modalidad_entrega = stripslashes($result[0]['modalidad_entrega']);
$irpf_librador = $result[0]['irpf'];
$descuento_pp = $result[0]['descuento_pp'];
$descuento_librador = $result[0]['descuento_librador'];
$comensales = 1;
$id_terminal = $result[0]['id_terminal'];

// libradores
$result_libradores = $conn->query("SELECT * FROM documentos_".$ejercicio."_libradores WHERE id_documentos_1 = " . $id_documento_1 . " LIMIT 1");
if($conn->registros() == 1) {
    $codigo_librador_documento = stripslashes($result_libradores[0]['codigo_librador']);
    $nombre_documento = stripslashes($result_libradores[0]['nombre']);
    $apellido_1_documento = stripslashes($result_libradores[0]['apellido_1']);
    $apellido_2_documento = stripslashes($result_libradores[0]['apellido_2']);
    $razon_social_documento = stripslashes($result_libradores[0]['razon_social']);
    $razon_comercial_documento = stripslashes($result_libradores[0]['razon_comercial']);
    $nif_documento = stripslashes($result_libradores[0]['nif']);
    $direccion_documento = stripslashes($result_libradores[0]['direccion']);
    $numero_direccion_documento = stripslashes($result_libradores[0]['numero']);
    $escalera_direccion_documento = stripslashes($result_libradores[0]['escalera']);
    $piso_direccion_documento = stripslashes($result_libradores[0]['piso']);
    $puerta_direccion_documento = stripslashes($result_libradores[0]['puerta']);
    $localidad_documento = stripslashes($result_libradores[0]['localidad']);
    $codigo_postal_documento = stripslashes($result_libradores[0]['codigo_postal']);
    $provincia_documento = stripslashes($result_libradores[0]['provincia']);
    $telefono_1_documento = stripslashes($result_libradores[0]['telefono_1']);
    $telefono_2_documento = stripslashes($result_libradores[0]['telefono_2']);
    $fax_documento = stripslashes($result_libradores[0]['fax']);
    $mobil_documento = stripslashes($result_libradores[0]['mobil']);
    $email_documento = stripslashes($result_libradores[0]['email']);
    $persona_contacto_documento = stripslashes($result_libradores[0]['persona_contacto']);
}

// libradores envio
$result_libradores_envio = $conn->query("SELECT * FROM documentos_".$ejercicio."_libradores_envio WHERE id_documentos_1 = " . $id_documento_1 . " LIMIT 1");
if($conn->registros() == 1) {
    $fecha_documento = $result_libradores_envio[0]['fecha_documento'];
    $id_librador = $result_libradores_envio[0]['id_librador'];
    $nombre_documento = stripslashes($result_libradores_envio[0]['nombre']);
    $apellido_1_documento = stripslashes($result_libradores_envio[0]['apellido_1']);
    $apellido_2_documento = stripslashes($result_libradores_envio[0]['apellido_2']);
    $razon_social_documento = stripslashes($result_libradores_envio[0]['razon_social']);
    $razon_comercial_documento = stripslashes($result_libradores_envio[0]['razon_comercial']);
    $direccion_documento = stripslashes($result_libradores_envio[0]['direccion']);
    $numero_direccion_documento = stripslashes($result_libradores_envio[0]['numero']);
    $escalera_direccion_documento = stripslashes($result_libradores_envio[0]['escalera']);
    $piso_direccion_documento = stripslashes($result_libradores_envio[0]['piso']);
    $puerta_direccion_documento = stripslashes($result_libradores_envio[0]['puerta']);
    $localidad_documento = stripslashes($result_libradores_envio[0]['localidad']);
    $codigo_postal_documento = stripslashes($result_libradores_envio[0]['codigo_postal']);
    $provincia_documento = stripslashes($result_libradores_envio[0]['provincia']);
    $zona = stripslashes($result_libradores_envio[0]['zona']);
    $telefono_1_documento = stripslashes($result_libradores_envio[0]['telefono_1']);
    $telefono_2_documento = stripslashes($result_libradores_envio[0]['telefono_2']);
    $mobil_documento = stripslashes($result_libradores_envio[0]['mobil']);
    $persona_contacto_documento = stripslashes($result_libradores_envio[0]['persona_contacto']);
    $observaciones_envio_documento = stripslashes($result_libradores_envio[0]['observaciones']);
}