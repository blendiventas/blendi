<?php
session_start();
if (!isset($_SESSION["id_sesion"]))
{
    $_SESSION["id_sesion"] = session_id();
}
$id_sesion_sys = $_SESSION["id_sesion"];

function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

$protocol = 'http://';

$host = $protocol . $_SERVER['HTTP_HOST'] . "/";
$host_url = $host;
$host_web = $host . 'web/';
$host_idioma = $host;
$host_images = $protocol . $_SERVER['HTTP_HOST'] . "/images/";
$ruta_sys = "recepcion_pedidos/";

$idioma_server = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5);
$id_idioma = 4;
$idioma = "es/";
$lang = "es";
$locale_og = "es-ES";
$ejercicio = date('Y');
$tipo_documento = 'ped';
$tipo_librador = 'cli';
$so = '';
$interface = '';
$id_sesion_js = 'temp';

$parametersGetComposite = explode('?', $_SERVER['REQUEST_URI']);
$parametersGetComposite = (isset($parametersGetComposite[1]))? $parametersGetComposite[1] : '';
$parametersGetComposite = explode('&', $parametersGetComposite);
$parametersGet = [];
for ($i = 0; $i < count($parametersGetComposite); $i++) {
    $elementToParametersGet = explode('=', $parametersGetComposite[$i]);
    if (isset($elementToParametersGet[0]) && isset($elementToParametersGet[1])) {
        $parametersGet[$elementToParametersGet[0]] = urldecode($elementToParametersGet[1]);
    }
}

$abrir_cesta = (isset($parametersGet["abrir_cesta"]))? $parametersGet["abrir_cesta"] : false;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_sys = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_sys = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_sys = $_SERVER['REMOTE_ADDR'];
    }
}

$posibleIdSessionJs = 'temp';
?>

<script type="application/javascript">
    if(window.sessionStorage) {
        if (!sessionStorage.getItem('id_sesion_js')) {
            sessionStorage.setItem('id_sesion_js', '<?php echo $posibleIdSessionJs; ?>');
            window.id_sesion_js = '<?php echo $posibleIdSessionJs; ?>';
            document.cookie = 'id_session_js=' + id_sesion_js;
            document.location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
        }else {
            window.id_sesion_js = sessionStorage.getItem('id_sesion_js');

            if ('<?php echo $id_sesion_js; ?>' != id_sesion_js) {
                sessionStorage.setItem('id_sesion_js', '<?php echo $posibleIdSessionJs; ?>');
                document.location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
            }
        }
    }
</script>

<?php
unset($posibleIdSessionJs);

if (isset($_SESSION[$id_sesion_js]) && isset($_SESSION[$id_sesion_js]['id_documento']))
{
    $id_documento_1 = $_SESSION[$id_sesion_js]['id_documento'];
} else {
    $id_documento_1 = null;
}

if (isset($_SESSION[$id_sesion_js]) && isset($_SESSION[$id_sesion_js]['id_librador']))
{
    $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
} else {
    $id_librador = null;
}

if(isset($_GET["url"])) {
    $path_components = explode("/", $_GET['url']);

    $tienda = $path_components[0];
    if (empty($tienda)) {
        unset($tienda);
    }

    if (isset($path_components[1])) {
        if ($path_components[1] === 'login') {
            $login = true;
        } else if ($path_components[1] === 'logout') {
            $logout = true;
        } else if ($path_components[1] === 'signup') {
            $signup = true;
        } else if ($path_components[1] === 'historial_pedidos') {
            $historialPedidos = true;
        } else if ($path_components[1] === 'procesar-pedido') {
            $checkout = true;
        } else {
            $categoria = $path_components[1];
            if (empty($categoria)) {
                unset($categoria);
            }
            if ($categoria == 'busqueda') {
                unset($categoria);
            }

            if (isset($path_components[2])) {
                $producto = $path_components[2];
                if (empty($producto)) {
                    unset($producto);
                }
            }
        }
    }
} else {
    throw new Exception('Negocio no encontrado.');
}

if (!isset($tienda) || empty($tienda)) {
    throw new Exception('Negocio no encontrado.');
}

$host_web_tienda = $host_web . $tienda . '/';

require("../assets/conn/ddbb.php");

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

if ($logout) {
    $_SESSION[$id_sesion_js]['id_librador'] = null;
    unset($_SESSION[$id_sesion_js]['id_librador']);
    unset($id_librador);
    unset($logout);
}

$signup_nombre = (isset($_POST['signup_nombre']))? $_POST['signup_nombre'] : '';
$signup_user = (isset($_POST['signup_user']))? $_POST['signup_user'] : '';
$signup_password = (isset($_POST['signup_password']))? $_POST['signup_password'] : '';
if (!empty($signup_nombre) && !empty($signup_user) && !empty($signup_password)) {
    $select_sys = 'crear';
    $tipo_cuenta_registro = "persona";
    $nombre_registro = $signup_nombre;
    $email_registro = $signup_user;
    $password_registro = $signup_password;
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");
    $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
}

$login_user = (isset($_POST['login_user']))? $_POST['login_user'] : '';
$login_password = (isset($_POST['login_password']))? $_POST['login_password'] : '';
if (!empty($login_user) && !empty($login_password)) {
    $select_sys = 'identificar';
    $email_registro = $login_user;
    $password_registro = $login_password;
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");
    $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
}


if (!empty($checkout) && isset($_SESSION[$id_sesion_js]) && isset($_SESSION[$id_sesion_js]['id_librador'])) {
    $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
    $select_sys = 'datos-facturacion';
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");
}
if (!empty($checkout)) {
    $select_sys = 'listado-filtrado';
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-zonas.php");
}

if (!empty($historialPedidos) && isset($_SESSION[$id_sesion_js]) && isset($_SESSION[$id_sesion_js]['id_librador'])) {
    $ejercicioDelHistorial = date('Y');
    $id_librador = $_SESSION[$id_sesion_js]['id_librador'];
    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");
    $pedidosUsuario = [];

    $result_documento_1 = $conn->query("SELECT * FROM documentos_" . $ejercicioDelHistorial . "_1 WHERE id_librador = " . $id_librador . " LIMIT 20");
    if ($conn->registros() >= 1) {
        foreach ($result_documento_1 as $linea_documento_1) {
            $newDocumentoAMostrar = new stdClass();
            $newDocumentoAMostrar->id = $linea_documento_1['id'];
            $newDocumentoAMostrar->numero_documento = $linea_documento_1['numero_documento'];
            $newDocumentoAMostrar->fecha_documento = $linea_documento_1['fecha_documento'];
            $newDocumentoAMostrar->ejercicio = $ejercicioDelHistorial;
            $newDocumentoAMostrar->lineas = [];
            $result_documento_2 = $conn->query("SELECT * FROM documentos_" . $newDocumentoAMostrar->ejercicio . "_2 WHERE id_documentos_1 = " . $newDocumentoAMostrar->id);
            if ($conn->registros() >= 1) {
                foreach ($result_documento_2 as $linea_documento_2) {
                    $newDocumentoAMostrar_linea = new stdClass();
                    $newDocumentoAMostrar_linea->id = $linea_documento_2['id'];
                    $newDocumentoAMostrar_linea->imagen = $linea_documento_2['imagen_producto'];
                    $newDocumentoAMostrar_linea->descripcion = $linea_documento_2['descripcion_producto'];
                    $newDocumentoAMostrar_linea->cantidad = $linea_documento_2['cantidad'];
                    $newDocumentoAMostrar_linea->pvp_unidad = $linea_documento_2['pvp_unidad'];
                    $newDocumentoAMostrar_linea->total_antes_descuento = $linea_documento_2['total_antes_descuento'];
                    $newDocumentoAMostrar_linea->total_despues_descuento = $linea_documento_2['total_despues_descuento'];
                    $newDocumentoAMostrar_linea->lote = '';
                    $newDocumentoAMostrar_linea->caducidad = '';
                    $newDocumentoAMostrar_linea->numero_serie = '';

                    $newDocumentoAMostrar->lineas[] = $newDocumentoAMostrar_linea;
                }
            }

            $pedidosUsuario[] = $newDocumentoAMostrar;
        }
    }

    unset($conn);
}

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");
$result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

$pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
$decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
$decimales_importes = $result_configuracion[0]['decimales_importes'];

$result_tarifas = $conn->query("SELECT * FROM tarifas ORDER BY prioritaria DESC, id");
$id_tarifa_web = $result_tarifas[0]['id'];
$descripcion_tarifa_web = stripslashes($result_tarifas[0]['descripcion']);
unset($conn);

$descripcion_title = "Web - " . strtoupper($tienda);
$descripcion_meta = "Web - " . strtoupper($tienda);
$h1 = "Web";
$keywords = "";
$robots = "follow,index,all";
$foto_meta = "";
$foto_alt = "";
$url_completa = $host_url;
$host_links = $host . 'web/' . $tienda;
$accion = "";
?>
<script>
    if(window.sessionStorage) {
        if (!sessionStorage.getItem('id_sesion')) {
            sessionStorage.setItem('id_sesion', '<?php echo $id_sesion_sys; ?>');
            var idSesion = '<?php echo $id_sesion_sys; ?>';
        }else {
            if(sessionStorage.getItem('id_sesion') != '<?php echo $id_sesion_sys; ?>') {
                sessionStorage.setItem('id_sesion', '<?php echo $id_sesion_sys; ?>');
            }
            var idSesion = sessionStorage.getItem('id_sesion');
        }
    }else {
        var idSesion = '<?php echo $id_sesion_sys; ?>';
    }

    window.tienda = '<?php echo $tienda; ?>';
    window.host_url = '<?php echo $host_url; ?>';
    window.host_web_tienda = '<?php echo $host_web_tienda; ?>';
    window.id_panel = '<?php echo $id_panel; ?>';
    window.id_documento_1 = '<?php echo $id_documento_1; ?>';
    window.id_librador = '<?php echo $id_librador; ?>';
    window.tipoLibrador = '<?php echo $tipo_librador; ?>';
    window.ip = '<?php echo $ip_sys; ?>';
    window.so = '<?php echo $so; ?>';
    window.idioma = '<?php echo $idioma; ?>';
    window.decimalesCantidades = '<?php echo $decimales_cantidades; ?>';
    window.decimalesImportes = '<?php echo $decimales_importes; ?>';
</script>

<?php

$select_sys = 'principal';
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-empresa.php");

if (isset($id_librador)) {
    $select_sys = 'datos-facturacion';
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-librador.php");
}

if (count($path_components) == 1) {
    $select_sys = 'activas_inicio';
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-categorias.php");
}

$select_sys = 'activas';
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-categorias.php");

$mostrar_precio = false;
if (isset($categoria)) {
    $select_sys = 'descripcion_url';
    $descripcion_url_familia = $categoria;
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-categorias.php");

    $mostrar_precio = empty($id_grupo_clientes_categoria) || $id_grupo_clientes_prioritario == $id_grupo_clientes_categoria || $id_grupo_clientes_categoria == $id_grupo_clientes;
}

if (isset($categoria) && !isset($producto)) {
    $pagina = (isset($parametersGet['pagina']))? (intval($parametersGet['pagina']) - 1) : 0;
    $orden = (isset($parametersGet['orden']))? intval($parametersGet['orden']) : 1;
    $resultados = (isset($parametersGet['resultados']))? intval($parametersGet['resultados']) : 30;
    $ordenIndex = $orden;
    if ($ordenIndex == 2) {
        $orden = 'productos_pvp.pvp';
    } else {
        $orden = 'productos.descripcion';
    }
    if ($resultados > 50) {
        $resultados = 50;
    }

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    $select_sys = 'web-productos-categorias';
    $cadena_limite_inicial = $pagina * $resultados;
    $cadena_limite_final = $resultados;
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
    $paginaActual = $pagina + 1;
    $cantidadPaginas = ceil($productosEnLaCategoria / $resultados);
    $resultadosTotales = $pagina * $resultados + $resultados;
    if ($productosEnLaCategoria < $resultadosTotales) {
        $resultadosTotales = $productosEnLaCategoria;
    }

    $subcategorias = [];
    foreach ($categorias['de'] as $keyCategoria => $de) {
        if ($de == $id_categoria_mostrar) {
            $subcategorias[] = $keyCategoria;
        }
    }

    unset($conn);
}

if (isset($parametersGet['categoria']) && isset($parametersGet['search']) && !isset($categoria) && !isset($producto)) {
    $pagina = (isset($parametersGet['pagina']))? (intval($parametersGet['pagina']) - 1) : 0;
    $orden = (isset($parametersGet['orden']))? intval($parametersGet['orden']) : 1;
    $resultados = (isset($parametersGet['resultados']))? intval($parametersGet['resultados']) : 30;
    $ordenIndex = $orden;
    if ($ordenIndex == 2) {
        $orden = 'productos_pvp.pvp';
    } else {
        $orden = 'productos.descripcion';
    }
    if ($resultados > 50) {
        $resultados = 50;
    }

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    $select_sys = 'web-productos-buscar';
    $cadena_limite_inicial = $pagina * $resultados;
    $cadena_limite_final = $resultados;
    $dato_buscar = slugify($parametersGet['search']);
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
    $paginaActual = $pagina + 1;
    $cantidadPaginas = ceil($productosEnLaCategoria / $resultados);
    $resultadosTotales = $pagina * $resultados + $resultados;
    if ($productosEnLaCategoria < $resultadosTotales) {
        $resultadosTotales = $productosEnLaCategoria;
    }

    $subcategorias = [];
    foreach ($categorias['de'] as $keyCategoria => $de) {
        if ($de == $parametersGet['categoria']) {
            $subcategorias[] = $keyCategoria;
        }
    }

    unset($conn);

    $categoria = 'busqueda';
}

if (isset($producto)) {
    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    $select_sys = 'buscar-producto';
    $indice_componente = 1;
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");

    if ($id_producto) {
        $id_producto_sys = $id_producto;
        $select_sys = 'web-producto';
        require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-productos.php");
    } else {
        throw new Exception('Producto no encontrado.');
    }

    unset($conn);
}


$anadidoQueryURI = '';
if (isset($parametersGet['categoria'])) {
    $anadidoQueryURI .= '&categoria=' . $parametersGet['categoria'];
}
if (isset($parametersGet['search'])) {
    $anadidoQueryURI .= '&search=' . $parametersGet['search'];
}

