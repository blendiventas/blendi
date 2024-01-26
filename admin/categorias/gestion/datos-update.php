<?php
header('Content-Type: application/json');
$id_sesion_sys = filter_input(INPUT_POST, 'id_sesion', FILTER_SANITIZE_STRING);
$ip_sys = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$id_panel_sys = filter_input(INPUT_POST, 'id_panel', FILTER_SANITIZE_NUMBER_INT);
$id_idioma_sys = filter_input(INPUT_POST, 'id_idioma', FILTER_SANITIZE_NUMBER_INT);
$select_sys = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
$id_categorias = filter_input(INPUT_POST, 'id_categorias', FILTER_SANITIZE_STRING);
$id_idioma_categorias = filter_input(INPUT_POST, 'id_idioma_categorias', FILTER_SANITIZE_NUMBER_INT);
$apartado_url = filter_input(INPUT_POST, 'apartado', FILTER_SANITIZE_STRING);
$descripcion_categorias = filter_input(INPUT_POST, 'descripcion_categorias', FILTER_SANITIZE_STRING);
$de_categorias = filter_input(INPUT_POST, 'de_categorias', FILTER_SANITIZE_NUMBER_INT);
$activo_categorias = filter_input(INPUT_POST, 'activo_categorias', FILTER_SANITIZE_NUMBER_INT);
$orden_categorias = filter_input(INPUT_POST, 'orden_categorias', FILTER_SANITIZE_STRING);
$id_terminal_categorias_terminales = (isset($_POST['id_terminal_categorias_terminales']))? $_POST['id_terminal_categorias_terminales'] : [];
$alt_categorias = filter_input(INPUT_POST, 'alt_categorias', FILTER_SANITIZE_STRING);
$tittle_categorias = filter_input(INPUT_POST, 'tittle_categorias', FILTER_SANITIZE_STRING);
$id_grupo_categorias = filter_input(INPUT_POST, 'id_grupo', FILTER_SANITIZE_STRING);
$descripcion_url_categorias = filter_input(INPUT_POST, 'descripcion_url_categorias', FILTER_SANITIZE_STRING);
$titulo_meta_categorias = filter_input(INPUT_POST, 'titulo_meta_categorias', FILTER_SANITIZE_STRING);
$descripcion_meta_categorias = filter_input(INPUT_POST, 'descripcion_meta_categorias', FILTER_SANITIZE_STRING);
$texto_inicio_categorias = filter_input(INPUT_POST, 'texto_inicio_categorias', FILTER_SANITIZE_STRING);
$inicio_categorias = filter_input(INPUT_POST, 'inicio_categorias', FILTER_SANITIZE_NUMBER_INT);
$orden_inicio_categorias = filter_input(INPUT_POST, 'orden_inicio_categorias', FILTER_SANITIZE_STRING);
$mostrar_buscador_categorias = filter_input(INPUT_POST, 'mostrar_buscador_categorias', FILTER_SANITIZE_NUMBER_INT);
$id_grupo_clientes_categorias = filter_input(INPUT_POST, 'id_grupo_clientes_categorias', FILTER_SANITIZE_NUMBER_INT);
$link_categorias = filter_input(INPUT_POST, 'link_categorias', FILTER_SANITIZE_STRING);
$link_externo_categorias = filter_input(INPUT_POST, 'link_externo_categorias', FILTER_SANITIZE_STRING);
$texto_titulo_categorias = filter_input(INPUT_POST, 'texto_titulo_categorias', FILTER_SANITIZE_STRING);
$color_fondo_categorias = filter_input(INPUT_POST, 'color_fondo', FILTER_SANITIZE_STRING);
$color_letra_categorias = filter_input(INPUT_POST, 'color_letra', FILTER_SANITIZE_STRING);

$ajax_sys = true;

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

require($_SERVER['DOCUMENT_ROOT']."/admin/categorias/gestion/datos-update-php.php");