<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nombre_fiscal_datos_empresa = filter_input(INPUT_POST, 'nombre_fiscal_datos_empresa', FILTER_SANITIZE_STRING);
$nombre_comercial_datos_empresa = filter_input(INPUT_POST, 'nombre_comercial_datos_empresa', FILTER_SANITIZE_STRING);
$nif_datos_empresa = filter_input(INPUT_POST, 'nif_datos_empresa', FILTER_SANITIZE_STRING);
$direccion_datos_empresa = filter_input(INPUT_POST, 'direccion_datos_empresa', FILTER_SANITIZE_STRING);
$codigo_postal_datos_empresa = filter_input(INPUT_POST, 'codigo_postal_datos_empresa', FILTER_SANITIZE_STRING);
$poblacion_datos_empresa = filter_input(INPUT_POST, 'poblacion_datos_empresa', FILTER_SANITIZE_STRING);
$provincia_datos_empresa = filter_input(INPUT_POST, 'provincia_datos_empresa', FILTER_SANITIZE_STRING);
$tel1_datos_empresa = filter_input(INPUT_POST, 'tel1_datos_empresa', FILTER_SANITIZE_STRING);
$tel2_datos_empresa = filter_input(INPUT_POST, 'tel2_datos_empresa', FILTER_SANITIZE_STRING);
$movil_datos_empresa = filter_input(INPUT_POST, 'movil_datos_empresa', FILTER_SANITIZE_STRING);
$fax_datos_empresa = filter_input(INPUT_POST, 'fax_datos_empresa', FILTER_SANITIZE_STRING);
$email_datos_empresa = filter_input(INPUT_POST, 'email_datos_empresa', FILTER_SANITIZE_STRING);
$tarifas_datos_empresa = filter_input(INPUT_POST, 'tarifas_datos_empresa', FILTER_SANITIZE_STRING);
$iva_incluido_datos_empresa = filter_input(INPUT_POST, 'iva_incluido_datos_empresa', FILTER_SANITIZE_NUMBER_INT);
$logo_datos_empresa = filter_input(INPUT_POST, 'logo_datos_empresa', FILTER_SANITIZE_STRING);
$updated_datos_empresa = filter_input(INPUT_POST, 'updated_datos_empresa', FILTER_SANITIZE_STRING);
$url_web_datos_empresa = filter_input(INPUT_POST, 'url_web_datos_empresa', FILTER_SANITIZE_STRING);
$id_librador = filter_input(INPUT_POST, 'id_librador_configuracion', FILTER_SANITIZE_NUMBER_INT);
$id_librador_tak = filter_input(INPUT_POST, 'id_librador_tak_configuracion', FILTER_SANITIZE_NUMBER_INT);
$servicio_domicilio = filter_input(INPUT_POST, 'servicio_domicilio_configuracion', FILTER_SANITIZE_NUMBER_INT);
$pvp_iva_incluido = filter_input(INPUT_POST, 'pvp_iva_incluido_configuracion', FILTER_SANITIZE_NUMBER_INT);
$mostrar_precios_tpv = filter_input(INPUT_POST, 'mostrar_precios_tpv_configuracion', FILTER_SANITIZE_NUMBER_INT);
$mostrar_mas_vendidos_configuracion = filter_input(INPUT_POST, 'mostrar_mas_vendidos_configuracion', FILTER_SANITIZE_NUMBER_INT);
$color_fondo = filter_input(INPUT_POST, 'color_fondo_configuracion', FILTER_SANITIZE_STRING);
$color_letra = filter_input(INPUT_POST, 'color_letra_configuracion', FILTER_SANITIZE_STRING);
$filas_menu = filter_input(INPUT_POST, 'filas_menu_configuracion', FILTER_SANITIZE_NUMBER_INT);
$decimales_cantidades = filter_input(INPUT_POST, 'decimales_cantidades_configuracion', FILTER_SANITIZE_NUMBER_INT);
$decimales_importes = filter_input(INPUT_POST, 'decimales_importes_configuracion', FILTER_SANITIZE_NUMBER_INT);
$tipo_menu_superior = filter_input(INPUT_POST, 'tipo_menu_superior_configuracion', FILTER_SANITIZE_NUMBER_INT);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/datos_empresa/gestion/datos-update-php.php");