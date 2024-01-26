<?php
session_start();
if (!isset($_SESSION["id_sesion"]))
{
    $_SESSION["id_sesion"] = session_id();
}
$id_sesion_sys = $_SESSION["id_sesion"];
$id_sesion_js = (empty($_COOKIE['id_session_js']))? '' : $_COOKIE['id_session_js'];

$interface = "tpv";
$tipo_documento = "ped";
$tipo_librador = "cli";
$id_librador = 0;
$ejercicio = date("Y");

$protocol = 'http://';
$host_images = $protocol . $_SERVER['HTTP_HOST'] . "/images/";
$host_idioma = $protocol . $_SERVER['HTTP_HOST'] . "/";
$host = $protocol . $_SERVER['HTTP_HOST'] . "/";
$url_base = "";
$url = $_SERVER["REQUEST_URI"];
$ruta = "";
$host_url = $protocol . $_SERVER['HTTP_HOST'] . "/";
$indice_componente = 0;
$dato_buscar = "";
$sector = "restauracion";
$existen_mesas = false;
$mesas_mostrar = false;
$mostrar_familias = "superior";
//$tipus_menu_web_superior = "normal";
$tipus_menu_web_superior = "scroll-horizontal";
$color_letra_paginacion = "white";
$color_fondo_paginacion = "#156772";
$color_letra_botones = "white";
$color_fondo_botones = "#156772";
$mostrar_cesta = "lateral";
$mostrar_peso = false;
$mostrar_disponibilidad = false;
$mostrar_stock = 0; // 0: NO, 1: STOCK, 2: CANTIDAD DE STOCK
$mostrar_cesta_pantalla = false;
$pagina_de_inicio = false;
$isCodigoPromocional = isset($_GET['promocion']);
$codigoPromocional = $isCodigoPromocional ? $_GET['promocion'] :'';

$parametersGetComposite = explode('?', $_SERVER['REQUEST_URI']);
$parametersGetComposite = (isset($parametersGetComposite[1]))? $parametersGetComposite[1] : '';
$parametersGetComposite = explode('&', $parametersGetComposite);
$parametersGet = [];
for ($i = 0; $i < count($parametersGetComposite); $i++) {
    $elementToParametersGet = explode('=', $parametersGetComposite[$i]);
    if (isset($elementToParametersGet[0]) && isset($elementToParametersGet[1])) {
        $parametersGet[$elementToParametersGet[0]] = $elementToParametersGet[1];
    }
}

if(isset($_GET["url"])) {
    $path_components = explode("/", $_GET['url']);
    if(empty($path_components[count($path_components) - 1])) {
        unset($path_components[count($path_components) - 1]);
    }
    $path_sesion = explode("/", $_GET["url"]);

    if (count($path_sesion) == 4 || (count($path_sesion) == 5 && empty($path_sesion[4]))) {
        if($path_sesion[3] == "ventas-inicio" || $path_sesion[3] == "ventas" ||
            $path_sesion[3] == "compras-inicio" || $path_sesion[3] == "compras" ||
            $path_sesion[3] == "gastos-inicio" || $path_sesion[3] == "gastos") {
            $pagina_de_inicio = true;
        }
    }
    if (count($path_sesion) >= 4) {
        if($path_sesion[0] == "presupuestos" OR $path_sesion[0] == "pedidos" OR $path_sesion[0] == "albaranes" OR $path_sesion[0] == "facturas" OR $path_sesion[0] == "tiquets") {
            if($path_sesion[2] == "tpv" AND ($path_sesion[3] == "ventas" OR $path_sesion[3] == "compras" OR $path_sesion[3] == "gastos" OR $path_sesion[3] == "ventas-inicio" OR $path_sesion[3] == "compras-inicio" OR $path_sesion[3] == "gastos-inicio")) {
                $id_sesion_sys = $path_sesion[1];
                $_SESSION["id_sesion"] = $id_sesion_sys;
                if($path_sesion[3] == "ventas-inicio" OR $path_sesion[3] == "compras-inicio" OR $path_sesion[3] == "gastos-inicio") {
                    if($path_sesion[3] == "ventas-inicio") {
                        $path_sesion[3] = "ventas";
                    }else if($path_sesion[3] == "compras-inicio") {
                        $path_sesion[3] = "compras";
                    }else {
                        $path_sesion[3] = "gastos";
                    }
                    /* REINICIAMOS TODAS LAS VARIABLES */
                    ?>
                    <script>
                        sessionStorage.removeItem('id_sesion');
                        sessionStorage.removeItem('ip');
                        sessionStorage.removeItem('id_usuario');
                        sessionStorage.removeItem('interface_js');
                        sessionStorage.removeItem('tipo_documento');
                        sessionStorage.removeItem('tipo_librador');
                        sessionStorage.removeItem('mostrar_cesta');
                        sessionStorage.removeItem('mostrar_familias');
                        sessionStorage.removeItem('so');
                        sessionStorage.removeItem('idioma');
                        sessionStorage.removeItem('id_idioma');
                        sessionStorage.removeItem('id_documento');
                        sessionStorage.removeItem('ejercicio');
                        sessionStorage.removeItem('id_librador');
                        sessionStorage.removeItem('mostrar_cesta_pantalla');
                    </script>
                    <?php
                }
                $host_url = $protocol.$_SERVER['HTTP_HOST']."/".$path_sesion[0]."/".$path_sesion[1]."/".$path_sesion[2]."/".$path_sesion[3]."/";
                $indice_componente = 4;
                if($path_sesion[3] == "compras" OR $path_sesion[3] == "compras-inicio") {
                    $tipo_librador = "pro";
                }else if($path_sesion[3] == "gastos" OR $path_sesion[3] == "gastos-inicio") {
                    $tipo_librador = "cre";
                }
                if($path_sesion[0] == "presupuestos") {
                    $tipo_documento = "pre";
                }else if($path_sesion[0] == "albaranes") {
                    $tipo_documento = "alb";
                }else if($path_sesion[0] == "facturas") {
                    $tipo_documento = "fac";
                }else if($path_sesion[0] == "tiquets") {
                    $tipo_documento = "tiq";
                }
                unset($_GET["url"]);
            }
        }
    }
}

$es_ajax = (isset($_POST['ajax']))? $_POST['ajax'] : false;
$es_ajax_mesas = (isset($_POST['ajax_mesas']))? $_POST['ajax_mesas'] : false;
$es_ajax_cabecera_cesta = (isset($_POST['ajax_cabecera_cesta']))? $_POST['ajax_cabecera_cesta'] : false;
$es_ajax_documentos = (isset($_POST['ajax_documentos']))? $_POST['ajax_documentos'] : false;

$posibleIdSessionJs = uniqid();

if (empty($es_ajax_documentos)) {
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
                    document.cookie = 'id_session_js=' + id_sesion_js;
                    document.location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
                }
            }
        }
    </script>
    <?php
}

unset($posibleIdSessionJs);

$mostra_nota_productos = true;
$plazo_entrega_productos = false;
$procedencia = "web";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_sys = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_sys = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_sys = $_SERVER['REMOTE_ADDR'];
    }
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getPlatform($user_agent) {
    $plataformas = array(
        'Windows 10' => 'Windows NT 10.0+',
        'Windows 8.1' => 'Windows NT 6.3+',
        'Windows 8' => 'Windows NT 6.2+',
        'Windows 7' => 'Windows NT 6.1+',
        'Windows Vista' => 'Windows NT 6.0+',
        'Windows XP' => 'Windows NT 5.1+',
        'Windows 2003' => 'Windows NT 5.2+',
        'Windows' => 'Windows otros',
        'iPhone' => 'iPhone',
        'iPad' => 'iPad',
        'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
        'Mac otros' => 'Macintosh',
        'Android' => 'Android',
        'BlackBerry' => 'BlackBerry',
        'Linux' => 'Linux',
    );
    foreach($plataformas as $plataforma=>$pattern){
        if (preg_match('/(?i)'.$pattern.'/', $user_agent))
            return $plataforma;
    }
    return 'Otras';
}
$so = getPlatform($user_agent);

require("assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$pagina_de_inicio_sin_login = false;
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1 && count($path_sesion) > 2) {
    $id_panel = $result[0]['id_panel'];
    $result = $conn->query("SELECT sector,m_cocina,dominio_ftp FROM identificacion_panel WHERE id='" . $id_panel . "' LIMIT 1");
    if ($conn->registros() == 1) {
        $sector = $result[0]['sector'];
        $m_cocina = $result[0]['m_cocina'];
    }

    $id_usuario = 0;
    $nombre_usuario = "";
    require("web-gestion/datos-usuario.php");
    if(empty($id_usuario)) {
        echo "El usuario identificado sólo dispone de acceso a pedidos via web.";
    }
    $id_usuario_sys = $id_usuario;

    unset($conn);
    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");
    require("admin/accesos/permisos.php");
} else {
    $pagina_de_inicio_sin_login = true;
}
unset($conn);

$cargar_categorias = (isset($_POST['cargar_categorias']))? $_POST['cargar_categorias'] : false;
$accion = (isset($_GET['accion']))? $_GET['accion'] : '';
if ($accion === 'versiones') {
    $pagina_de_inicio_sin_login = true;
    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
    $versiones = $conn->query("SELECT * FROM versiones ORDER BY id DESC LIMIT 10;");
    unset($conn);
}
if ($pagina_de_inicio_sin_login) {
    $descripcion_title = "Blendi ventas";
    $descripcion_meta = "Blendi ventas";
    $h1 = "Blendi ventas";
    $keywords = "";
    $robots = "follow,index,all";
    $foto_meta = "";
    $foto_alt = "";
    $url_completa = $host_url;
} else {
    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");
    require("admin/accesos/permisos.php");
    unset($conn);

    $select_sys = "activos";
    require("web-gestion/datos-idiomas.php");

    $select_sys = "principal";
    require("web-gestion/datos-empresa.php");

    $nowMinus1Hour = new DateTime();
    $nowMinus1Hour->modify('-1 hour');
    if (empty($iban_datos_empresa) && $nowMinus1Hour > $fecha_inicio_plan_datos_empresa) {
        ?>
        <script type="application/javascript">
            window.location.href='<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-suscripcion';
        </script>
        <?php
    }

    $idioma_server = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5);
    // Si idioma es uno de los incluidos, hacemos el cambio. Si no, comprobamos la URL o dejamos castellano por defecto
    $id_idioma = 4; // idioma castellano por defecto
    $idioma = "es/";
    $lang = "es";
    $locale_og = "es-ES";

    $id_documento = 0;
    if (isset($_SESSION[$id_sesion_js]["ejercicio"]))
    {
        $ejercicio = $_SESSION[$id_sesion_js]["ejercicio"];
    }
    if (isset($_SESSION[$id_sesion_js]["id_documento"]))
    {
        $id_documento = $_SESSION[$id_sesion_js]["id_documento"];
    }

    if(isset($_POST['id_documento'])) {
        $id_documento = $_POST['id_documento'];
    }
    if(isset($_POST['ejercicio'])) {
        $ejercicio = $_POST['ejercicio'];
    }

    $select_sys = "obtener_numero_documento";
    require("web-gestion/datos-documentos.php");

    $select_sys = "listado";
    require("web-gestion/datos-iva.php");

    $select_sys = "inicio";
    require("web-gestion/datos-librador.php");
    $color_letra_paginacion = $color_letra_botones;
    $color_fondo_paginacion = $color_fondo_botones;

    $select_sys = "lista-libradores";
    require("web-gestion/datos-librador.php");

    if($interface == "tpv") {
        $id_tarifa_web = $id_tarifa_tpv;
    }

    if (empty($es_ajax_documentos)) {
        ?>
        <script>
            (function() {
                if(window.sessionStorage) {
                    if (!sessionStorage.getItem('id_sesion')) {
                        sessionStorage.setItem('id_sesion', '<?php echo $id_sesion_sys; ?>');
                        window.idSesion = '<?php echo $id_sesion_sys; ?>';
                    }else {
                        if(sessionStorage.getItem('id_sesion') != '<?php echo $id_sesion_sys; ?>') {
                            sessionStorage.setItem('id_sesion', '<?php echo $id_sesion_sys; ?>');
                        }
                        window.idSesion = sessionStorage.getItem('id_sesion');
                    }
                    if (!sessionStorage.getItem('ip')) {
                        sessionStorage.setItem('ip', '<?php echo $ip_sys; ?>');
                        window.ip = '<?php echo $ip_sys; ?>';
                    }else {
                        window.ip = sessionStorage.getItem('ip');
                    }

                    if (!sessionStorage.getItem('id_usuario')) {
                        sessionStorage.setItem('id_usuario', '<?php echo $id_usuario; ?>');
                        window.idUsuario = '<?php echo $id_usuario; ?>';
                    }else {
                        window.idUsuario = sessionStorage.getItem('id_usuario');
                    }

                    if (!sessionStorage.getItem('interface_js')) {
                        sessionStorage.setItem('interface_js', '<?php echo $interface; ?>');
                        window.interface_js = '<?php echo $interface; ?>';
                    }else {
                        window.interface_js = sessionStorage.getItem('interface_js');
                    }
                    if (!sessionStorage.getItem('tipo_documento') || '<?php echo $tipo_documento; ?>') {
                        sessionStorage.setItem('tipo_documento', '<?php echo $tipo_documento; ?>');
                        window.tipoDocumento = '<?php echo $tipo_documento; ?>';
                    }else {
                        window.tipoDocumento = sessionStorage.getItem('tipo_documento');
                    }
                    if (!sessionStorage.getItem('tipo_librador') || '<?php echo $tipo_librador; ?>') {
                        sessionStorage.setItem('tipo_librador', '<?php echo $tipo_librador; ?>');
                        window.tipoLibrador = '<?php echo $tipo_librador; ?>';
                    }else {
                        window.tipoLibrador = sessionStorage.getItem('tipo_librador');
                    }
                    if (!sessionStorage.getItem('mostrar_cesta')) {
                        sessionStorage.setItem('mostrar_cesta', '<?php echo $mostrar_cesta; ?>');
                        window.mostrarCesta = '<?php echo $mostrar_cesta; ?>';
                    }else {
                        window.mostrarCesta = sessionStorage.getItem('mostrar_cesta');
                    }
                    if (!sessionStorage.getItem('mostrar_familias')) {
                        sessionStorage.setItem('mostrar_familias', '<?php echo $mostrar_familias; ?>');
                        window.mostrarFamilias = '<?php echo $mostrar_familias; ?>';
                    }else {
                        window.mostrarFamilias = sessionStorage.getItem('mostrar_familias');
                    }

                    if (!sessionStorage.getItem('so')) {
                        sessionStorage.setItem('so', '<?php echo $so; ?>');
                        window.so = '<?php echo $so; ?>';
                    }else {
                        window.so = sessionStorage.getItem('so');
                    }
                    if (!sessionStorage.getItem('idioma')) {
                        sessionStorage.setItem('idioma', '<?php echo $idioma; ?>');
                        window.idioma = '<?php echo $idioma; ?>';
                    }else {
                        window.idioma = sessionStorage.getItem('idioma');
                    }
                    if (!sessionStorage.getItem('id_idioma')) {
                        sessionStorage.setItem('id_idioma', '<?php echo $id_idioma; ?>');
                        window.id_idioma = '<?php echo $id_idioma; ?>';
                    }else {
                        window.id_idioma = sessionStorage.getItem('id_idioma');
                    }
                    if (!sessionStorage.getItem('id_documento')) {
                        sessionStorage.setItem('id_documento', '<?php echo $id_documento; ?>');
                        window.idDocumento = '<?php echo $id_documento; ?>';
                    }else {
                        window.idDocumento = sessionStorage.getItem('id_documento');
                    }
                    if (!sessionStorage.getItem('ejercicio')) {
                        sessionStorage.setItem('ejercicio', '<?php echo $ejercicio; ?>');
                        window.ejercicio = '<?php echo $ejercicio; ?>';
                    }else {
                        if(sessionStorage.getItem('ejercicio') == 'undefined') {
                            sessionStorage.setItem('ejercicio', '<?php echo $ejercicio; ?>');
                        }
                        window.ejercicio = sessionStorage.getItem('ejercicio');
                    }
                    if (!sessionStorage.getItem('id_librador')) {
                        sessionStorage.setItem('id_librador', '<?php echo $id_librador; ?>');
                        window.idLibrador = '<?php echo $id_librador; ?>';
                    }else {
                        window.idLibrador = sessionStorage.getItem('id_librador');
                    }
                    if (!sessionStorage.getItem('id_librador_tak')) {
                        sessionStorage.setItem('id_librador_tak', '<?php echo $id_librador_tak; ?>');
                        window.idLibradorTak = '<?php echo $id_librador_tak; ?>';
                    }else {
                        window.idLibradorTak = sessionStorage.getItem('id_librador_tak');
                    }
                    if (!sessionStorage.getItem('servicio_domicilio')) {
                        sessionStorage.setItem('servicio_domicilio', '<?php echo $servicio_domicilio; ?>');
                        window.servicioDomicilio = '<?php echo $servicio_domicilio; ?>';
                    }else {
                        window.servicioDomicilio = sessionStorage.getItem('servicio_domicilio');
                    }
                    if (!sessionStorage.getItem('mostrar_cesta_pantalla')) {
                        sessionStorage.setItem('mostrar_cesta_pantalla', 'no');
                        window.mostrarCestaPantalla = 'no';
                    }else {
                        window.mostrarCestaPantalla = 'no';
                    }
                }else {
                    window.idSesion = '<?php echo $id_sesion_sys; ?>';
                    window.ip = '<?php echo $ip_sys; ?>';
                    window.idUsuario = '<?php echo $id_usuario; ?>';
                    window.interface_js = '<?php echo $interface; ?>';
                    window.tipoDocumento = '<?php echo $tipo_documento; ?>';
                    window.tipoLibrador = '<?php echo $tipo_librador; ?>';
                    window.mostrarCesta = '<?php echo $mostrar_cesta; ?>';
                    window.mostrarFamilias = '<?php echo $mostrar_familias; ?>';
                    window.so = '<?php echo $so; ?>';
                    window.id_idioma = '<?php echo $id_idioma; ?>';
                    window.idioma = '<?php echo $idioma; ?>';
                    window.idDocumento = '<?php echo $id_documento; ?>';
                    window.ejercicio = '<?php echo $ejercicio; ?>';
                    window.idLibrador = '<?php echo $id_librador; ?>';
                    window.idLibradorTak = '<?php echo $id_librador_tak; ?>';
                    window.servicioDomicilio = '<?php echo $servicio_domicilio; ?>';
                    window.mostrarCestaPantalla = 'no';
                }

                window.libradorNombre = '<?php echo $librador_nombre; ?>';
                window.libradorSocial = '<?php echo $librador_social; ?>';
                window.libradorComercial = '<?php echo $librador_comercial; ?>';
                window.idModalidadesEnvio = '<?php echo $id_modalidades_envio; ?>';
                window.idModalidadesEntrega = '<?php echo $id_modalidades_entrega; ?>';
                window.idModalidadesPago = '<?php echo $id_modalidades_pago; ?>';
                window.idIva = '<?php echo $id_iva_librador; ?>';
                window.pvpIvaIncluido = '<?php echo $pvp_iva_incluido; ?>';
                window.ivaLibrador = '<?php echo $iva_librador; ?>';
                window.recargo = '<?php echo $recargo; ?>';
                window.recargoLibrador = '<?php echo $recargo_librador; ?>';
                window.idIrpf = '<?php echo $id_irpf_librador; ?>';
                window.descuentoPp = '<?php echo $descuento_pp; ?>';
                window.descuentoLibrador = '<?php echo $descuento_librador; ?>';
                window.idTarifaWeb = '<?php echo $id_tarifa_web; ?>';
                window.filasMenuSuperior = '<?php echo $filas_menu_superior; ?>';
                window.decimalesCantidades = '<?php echo $decimales_cantidades; ?>';
                window.decimalesImportes = '<?php echo $decimales_importes; ?>';

                window.host = '<?php echo $host; ?>';
                window.host_url = '<?php echo $host_url; ?>';
                window.urlCompleta = '<?php echo $url_completa = $host_url; ?>';
                window.id_panel = '<?php echo $id_panel; ?>';
                window.id_terminal = '<?php echo $id_terminal; ?>';
                window.sector = '<?php echo $sector; ?>';
            })();
        </script>
        <?php
    }

    if(isset($_GET["url"])) {
        $path_idioma = explode("/", $_GET["url"]);
        if (isset($path_idioma[0])) {
            $select_sys = "path";
            require("web-gestion/datos-idiomas.php");
        }
    }

    $descripcion_title = "";
    $descripcion_meta = "";
    $h1 = "";
    $accion = "";

    if($tipo_librador == "cli" || $tipo_librador == "tak" || $tipo_librador == "del" || $tipo_librador == "mes") {
        $definicion_tipo_librador = "clientes";
        $titulo_tipo_librador = "Cliente";
    }else if($tipo_librador == "pro") {
        $definicion_tipo_librador = "proveedores";
        $titulo_tipo_librador = "Proveedor";
    }else if($tipo_librador == "cre") {
        $definicion_tipo_librador = "creditores";
        $titulo_tipo_librador = "Creditor";
    }
    /* $descripcion_title = $nombre_usuario."/".$path_sesion[0]."/".$definicion_tipo_librador; */

    $texto_traducir = "descripcion_meta";
    $select_sys = "traducir";
    require("web-gestion/datos-traducir.php");
    $descripcion_meta = $traduccion;

    $keywords = "";
    //$robots = "follow,index,all";
    $robots = "noindex, nofollow";
    $foto_meta = "";
    $foto_alt = "";
    $url_completa = $host_url;
    $pagina = 1;
    $orden_path = "a-z";
    $orden = "productos_categorias.orden, productos.descripcion";
    $orden_descripcion = "defecto";
    $pvp_meta = 0;

    $inicio_mostrar = false;
    $formulario_mostrar = false;
    $productos_mostrar = false;
    $categorias_mostrar = false;
    $ficha_producto = false;
    $id_categoria_mostrar = 0;
    $de_categoria_mostrar = 0;

    $id_linea = (isset($path_components[$indice_componente + 2]))? $path_components[$indice_componente + 2] : null;

    $lineas_documento = 0;
    if(!empty($id_documento)) {
        $select_sys = "obtener_lineas_documento";
        require("web-gestion/datos-documentos.php");
    }

    if(isset($path_components[$indice_componente])) {
        if(!empty($path_components[$indice_componente])) {
            /*
            Puede ser el idioma
            Puede ser la URL de la categoria
            Puede ser una URL concreta
            */
            if($path_components[$indice_componente] == "acceso-registro") {
                $h1 = "ACCESO REGISTRO";
                $ruta = $path_components[$indice_componente];
            }else if($path_components[$indice_componente] == "cobrar" || $path_components[$indice_componente] == "cobrar-productos") {
                $h1 = "COBRAR";
                $ruta = $path_components[$indice_componente];
            }else if($path_components[$indice_componente] == "pagar") {
                $h1 = "PAGAR";
                $ruta = $path_components[$indice_componente];
            }else if($path_components[$indice_componente] == "abrir-documento") {
                $accion = $path_components[$indice_componente];
                $categorias_mostrar = true;
            }else if($path_components[$indice_componente] == "documentos") {
                $categorias_mostrar = true;
            }else if($path_components[$indice_componente] == "comedor") {
                $categorias_mostrar = true;
            }else if($path_components[$indice_componente] == "buscar-productos") {
                $orden = "productos.descripcion ASC";
                $categorias_mostrar = true;
                $productos_mostrar == true;
                $dato_buscar = preg_replace('/[^a-zA-Z0-9\'\.\,]/', '-', $path_components[($indice_componente + 1)]);
                if(isset($path_components[$indice_componente + 2])) {
                    if(!empty($path_components[$indice_componente + 2])) {
                        if(substr($path_components[$indice_componente + 2],0,4) == "pag=") {
                            $productos_mostrar = true;
                            $partes_path = explode("_",$path_components[$indice_componente + 2]);
                            $pagina = substr($partes_path[0], 4);
                            $orden_path = substr($partes_path[1], 4);
                            if($orden_path == "a-z") {
                                $orden = "productos.descripcion ASC";
                                $orden_descripcion = "A-Z";
                            }else if($orden_path == "z-a") {
                                $orden = "productos.descripcion DESC";
                                $orden_descripcion = "Z-A";
                            }else if($orden_path == "precio") {
                                $orden = "productos_pvp.pvp DESC";
                                $orden_descripcion = "precio más alto";
                            }else if($orden_path == "-precio") {
                                $orden = "productos_pvp.pvp ASC";
                                $orden_descripcion = "precio más bajo";
                            }
                        }else {
                            $categorias_mostrar = true;
                            $ficha_producto = true;
                        }
                    }
                }else {
                    $productos_mostrar = true;
                }
            }else if($path_components[$indice_componente] == "documentos") {
                $h1 = "DOCUMENTOS";
            }else {
                $select_sys = "descripcion_url";
                $descripcion_url_familia = $path_components[$indice_componente];
                require("web-gestion/datos-categorias.php");
                $h1 = $cadena_h1;
            }
        }
        if(isset($path_components[($indice_componente + 1)])) {
            if(!empty($path_components[($indice_componente + 1)])) {
                if(substr($path_components[($indice_componente + 1)],0,4) == "pag=") {
                    $productos_mostrar = true;
                    $partes_path = explode("_",$path_components[($indice_componente + 1)]);
                    $pagina = substr($partes_path[0], 4);
                    $orden_path = substr($partes_path[1], 4);
                    if($orden_path == "a-z") {
                        $orden = "productos.descripcion ASC";
                        $orden_descripcion = "A-Z";
                    }else if($orden_path == "z-a") {
                        $orden = "productos.descripcion DESC";
                        $orden_descripcion = "Z-A";
                    }else if($orden_path == "precio") {
                        $orden = "productos_pvp.pvp DESC";
                        $orden_descripcion = "precio más alto";
                    }else if($orden_path == "-precio") {
                        $orden = "productos_pvp.pvp ASC";
                        $orden_descripcion = "precio más bajo";
                    }
                }else {
                    $datosDocumento = $path_components[$indice_componente + 1];
                    $datosDocumento = explode('-', $datosDocumento);

                    /*
                    Puede ser la URL del producto
                    o el numero de pagina
                    */
                    $categorias_mostrar = true;
                    $ficha_producto = true;
                }
            }
        }else {
            $productos_mostrar = true;
        }
    }else {
        $inicio_mostrar = true;
        $categorias_mostrar = true;
    }

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");
    $select_sys = "productos-relacionados-grupos";
    require("web-gestion/datos-productos.php");
    unset($conn);

    if($inicio_mostrar == true) {
        if(isset($id_productos_relacionados_grupos)) {
            if(!isset($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'])) {
                $_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'] = 0;
            }
        }
    }

    if($categorias_mostrar == true) {
        $select_sys = "activas";
        require("web-gestion/datos-categorias.php");
    }

    if(!empty($id_documento)) {
        $mesas_mostrar = false;
    }

    if($productos_mostrar == true || $ficha_producto == true) {
        $mesas_mostrar = false;

        $productos_pagina = 215;
        $productos_mostrados = 0;
        $productos_total = 0;

        if ($pagina == 1) {
            $cadena_limite_inicial = 0;
        } else {
            $cadena_limite_inicial = ($pagina - 1) * $productos_pagina;
        }
        $cadena_limite_final = $cadena_limite_inicial + $productos_pagina;

        if(!empty($id_categoria_mostrar)) {
            $conn = new db($id_panel);
            $conn->query("SET NAMES 'utf8'");

            $select_sys = "productos-categorias";
            require("web-gestion/datos-productos.php");
            unset($conn);
        }else if(!empty($dato_buscar)) {
            $conn = new db($id_panel);
            $conn->query("SET NAMES 'utf8'");

            $select_sys = "productos-buscar";
            require("web-gestion/datos-productos.php");
            unset($conn);
            if(isset($id_producto_mostrar)) {
                $productos_mostrar = true;
                $ficha_producto = false;

                if(count($id_producto_mostrar) == 1) {
                    $id_producto_modal_sys = $id_producto_mostrar[0];
                    $descripcion_modal_sys = $descripcion[0];
                    $tipo_producto_modal_sys = $tipo_producto_categorias[0];
                }
            }else {
                $productos_mostrar = false;
                $ficha_producto = false;
            }
        }
        $paginas = ceil($productos_total / $productos_pagina);
    }else {
        $productos_mostrar = false;
        $ficha_producto = false;
    }

    if($existen_mesas == true) {
        require("web-gestion/datos-mesas.php");
    }

    if($ficha_producto == true) {
        $productos_mostrar = false;
        $descripcion_url = $path_components[($indice_componente + 1)];

        $conn = new db($id_panel);
        $conn->query("SET NAMES 'utf8'");

        if(empty($dato_buscar)) {
            $id_producto_sys = 0;
            $select_sys = "buscar-producto";
            require("web-gestion/datos-productos.php");
            $id_producto_sys = $id_producto;
        }else {
            $path_components[($indice_componente)] = $descripcion_categoria_producto[0];
            //$path_components[($indice_componente + 1)] = $descripcion[0];
            $path_components[($indice_componente + 1)] = $descripcion_url_mostrar[0];
        }

        if(!empty($id_producto_sys)) {
            $select_sys = "producto";
            require("web-gestion/datos-productos.php");

            $h1 = stripslashes($result_producto[0]['descripcion']);

            $packs_disponibles_sys = $packs_disponibles;

            if(!isset($descripcion_categoria) || empty($descripcion_categoria)) {
                $select_sys = "descripcion_url";
                $descripcion_url_familia = $path_components[$indice_componente];
                require("web-gestion/datos-categorias.php");
            }

            $descripcion_producto_sys = $descripcion_producto;
            $tipo_producto_sys = $tipo_producto;
            $imagen_producto_sys = $imagen_producto;
            $updated_producto_sys = $updated_producto;
            $alt_producto_sys = $alt_producto;
            $tittle_producto_sys = $tittle_producto;
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
            unset($tipo_producto);
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
        }
        unset($conn);
    }

    $descripcion_title = $nombre_usuario."/".$path_sesion[0]."/".$definicion_tipo_librador;

    if (!$es_ajax) {
        ?>
        <script>
            (function () {
                window.accion = "<?php echo $accion; ?>";
                window.ruta = "<?php echo $ruta; ?>";
                window.descripcionCategoria = '<?php echo (empty($descripcion_categoria))? '' : $descripcion_categoria; ?>';
                <?php
                if($ruta == "cobrar" || $ruta == "cobrar-productos") {
                    ?>
                    sessionStorage.setItem('mostrar_cesta_pantalla', 'no');
                    window.mostrarCestaPantalla = 'no';
                    <?php
                }else {
                    ?>
                    if(window.idDocumento == 0) {
                        sessionStorage.setItem('mostrar_cesta_pantalla', 'si');
                        window.mostrarCestaPantalla = 'si';
                    }else {
                        sessionStorage.setItem('mostrar_cesta_pantalla', 'si');
                        window.mostrarCestaPantalla = 'si';
                    }
                    <?php
                }
                ?>

                window.mesasMostrar = '<?php echo $mesas_mostrar; ?>';
                window.existenMesas = <?php echo ($existen_mesas)? '1' : '0'; ?>;

                <?php
                for ($bucleConsole = 0 ; $bucleConsole < $contador ; $bucleConsole++) {
                    echo "console.log('Contador: ".$bucleConsole."');";
                    echo "console.log('Producto: ".$descripcion_producto_sys[$bucleConsole]."');";
                    echo "console.log('Tipo: ".$tipo_producto_sys[$bucleConsole]."');";
                    echo "console.log('Coste: ".$coste_producto_principal_sys[$bucleConsole]."');";
                    echo "console.log('IVA: ".$iva_producto_sys[$bucleConsole]."');";
                    echo "console.log('PVP: ".$pvp_producto_sys[$bucleConsole]."');";
                    echo "console.log('PVP oferta: ".$pvp_oferta_producto_sys[$bucleConsole]."');";
                    echo "console.log('----------------------------------');";
                }
                echo "console.log('IVA incluido empresa: ".$iva_incluido_datos_empresa."');";
                echo "console.log('IVA incluido librador: ".$pvp_iva_incluido."');";
                echo "console.log('Datos del documento-------------------');";
                echo "console.log('Cantidad: ".$cantidad_producto."');";
                echo "console.log('Coste: ".$coste_producto_principal_sys."');";
                echo "console.log('PVP: ".$pvp_producto_sys[0]."');";
                echo "console.log('Orden: ".$orden_producto."');";
                echo "console.log('Lote: ".$lote_recuperado."');";
                echo "console.log('----------------------------------');";
                ?>



                window.zonasDisplay = [
                    'comedor',
                    'productos',
                    'ficha_producto',
                    'cobrar',
                    'documentos',
                    'accion'
                ];
                window.zonaDisplay = '';
                <?php
                $zonasDisplay = [
                    'comedor',
                    'productos',
                    'ficha_producto',
                    'cobrar',
                    'documentos',
                    'accion'
                ];
                $zonaDisplay = '';
                if ($mostrar_mas_vendidos && $pagina_de_inicio) {
                    $zonaDisplay = 'productos';
                    ?>
                    window.zonaDisplay = 'productos';
                    <?php
                } else if($existen_mesas == true && $mesas_mostrar == true) {
                    $zonaDisplay = 'comedor';
                    ?>
                    window.zonaDisplay = 'comedor';
                    <?php
                } else if(!empty($ruta) && ($ruta == "cobrar" || $ruta == "cobrar-productos")) {
                    $zonaDisplay = 'cobrar';
                    ?>
                    window.zonaDisplay = 'cobrar';
                    <?php
                } else if($productos_mostrar == true) {
                    $zonaDisplay = 'productos';
                    ?>
                    window.zonaDisplay = 'productos';
                    <?php
                } else if($ficha_producto == true) {
                    $zonaDisplay = 'ficha_producto';
                    ?>
                    window.zonaDisplay = 'ficha_producto';
                    <?php
                } else {
                    $zonaDisplay = 'productos';
                    ?>
                    window.zonaDisplay = 'productos';
                    <?php
                }
                ?>
            })();
        </script>
        <?php
    }
}
