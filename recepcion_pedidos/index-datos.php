<?php
session_start();
if (!isset($_SESSION["id_sesion"]))
{
    $_SESSION["id_sesion"] = session_id();
}

$protocol = 'http://';

$id_sesion_sys = $_SESSION["id_sesion"];
$id_sesion_js = (empty($_COOKIE['id_session_js']))? '' : $_COOKIE['id_session_js'];
$host = $protocol . $_SERVER['HTTP_HOST'] . "/";
$host_url = $host;
$host_idioma = $host;
$host_images = $protocol . $_SERVER['HTTP_HOST'] . "/images/";
$ruta_sys = "recepcion_pedidos/";

$es_ajax = (isset($_POST['ajax']))? $_POST['ajax'] : false;
$tiquet_individual = (isset($_POST['tiquet_individual']))? $_POST['tiquet_individual'] : false;

$idioma_server = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5);
$id_idioma = 4;
$idioma = "es/";
$lang = "es";
$locale_og = "es-ES";
$ejercicio = date('Y');
$tipo_documento = 'tiq';
$so = '';
$interface = '';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_sys = $_SERVER['HTTP_CLIENT_IP'];
} else {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_sys = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_sys = $_SERVER['REMOTE_ADDR'];
    }
}

$posibleIdSessionJs = uniqid();
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
unset($posibleIdSessionJs);

require("../assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$pagina_de_inicio_sin_login = false;
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion_sys . "' ORDER BY id DESC LIMIT 1");
if ($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
    $result = $conn->query("SELECT sector,dominio_ftp,m_cocina FROM identificacion_panel WHERE id='" . $id_panel . "' LIMIT 1");
    if ($conn->registros() == 1) {
        $sector = $result[0]['sector'];
        $m_cocina = $result[0]['m_cocina'];
    }
} else {
    throw new Exception('No tienes permiso para acceder.');
}
unset($conn);

$id_usuario = 0;
$nombre_usuario = "";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-usuario.php");
$id_usuario_sys = $id_usuario;

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");
$result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");

$decimales_cantidades = $result_configuracion[0]['decimales_cantidades'];
$decimales_importes = $result_configuracion[0]['decimales_importes'];


require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/permisos.php");
unset($conn);

$descripcion_title = "Recepción pedidos - Blendi ventas";
$descripcion_meta = "Recepción pedidos - Blendi ventas";
$h1 = "Recepción pedidos";
$keywords = "";
$robots = "follow,index,all";
$foto_meta = "";
$foto_alt = "";
$url_completa = $host_url;
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
        if (!sessionStorage.getItem('ip')) {
            sessionStorage.setItem('ip', '<?php echo $ip_sys; ?>');
            var ip = '<?php echo $ip_sys; ?>';
        }else {
            var ip = sessionStorage.getItem('ip');
        }
    }else {
        var idSesion = '<?php echo $id_sesion_sys; ?>';
        var ip = '<?php echo $ip_sys; ?>';
    }

    var host_url = '<?php echo $host_url; ?>';
    var id_panel = '<?php echo $id_panel; ?>';
</script>

<?php
$select_sys = "activas";
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-categorias.php");

require ('web-gestion/datos-pedidos.php');

$select_sys = 'principal';
require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-empresa.php");

$nowMinus1Hour = new DateTime();
$nowMinus1Hour->modify('-1 hour');
if (empty($iban_datos_empresa) && $nowMinus1Hour > $fecha_inicio_plan_datos_empresa) {
    ?>
    <script type="application/javascript">
        window.location.href='<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-suscripcion';
    </script>
    <?php
}
