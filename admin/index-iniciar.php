<?php
$id_token_google = (isset($_POST['credential']))? $_POST['credential'] : null;
if ($id_token_google) {
    require_once 'libraries/google-api-php-client/vendor/autoload.php';

    $client = new Google_Client(['client_id' => '216923566052-4qtdf1f3egn20cc8sj05idic5agv2fmq.apps.googleusercontent.com']);
    $payload = $client->verifyIdToken($id_token_google);
    if ($payload) {
        $userid = $payload['sub'];
        $userEmail = $payload['email'];
        $_POST['empresa'] = $userEmail;

        require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");
        $conn = new db(0);
        $conn->query("SET NAMES 'utf8'");

        $result = $conn->query("SELECT id, password FROM identificacion_panel WHERE empresa='" . addslashes($userEmail) . "' LIMIT 1");
        if ($conn->registros() == 1) {
            $_POST['clave'] = $result[0]['password'];
        } else {
            unset($conn);

            $_POST['clave'] = uniqid();
            $_POST['sector'] = 'restauracion';

            require 'usuarios/gestion/registro.php';

            // Volvemos a crear la conexión para que no requiera el fichero ddbb en la identificación
            $conn = new db(0);
            $conn->query("SET NAMES 'utf8'");
        }
    }
}

if(isset($_POST['empresa']) && isset($_POST['clave'])) {
    require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/datos-identificacion.php");
}else {
    require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/datos-acceso.php");
}

// NUEVO CODIGO PARA ACTUALIZAR LAS VERSIONES DE LAS TABLAS -> INICIO
if($revisar_tablas_sys) {

    $conn = new db($id_panel_sys);
    $conn->query("SET NAMES 'utf8'");

    require("versiones/actualizaciones.php");
    unset($conn);

    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");
    $result = $conn->query("UPDATE identificacion_panel SET revisar_tablas=null WHERE id=" . $id_panel_sys . " LIMIT 1");
    unset($conn);

    $revisar_tablas_sys = 0;
}
// NUEVO CODIGO PARA ACTUALIZAR LAS VERSIONES DE LAS TABLAS -> FIN

if($acceso_correcto_sys == 1) {
    $id_panel = $id_panel_sys;

    $id_usuario = 0;
    $nombre_usuario = "";
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-usuario.php");

    $select_sys = 'principal';
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-empresa.php");

    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");
    $result_configuracion = $conn->query("SELECT * FROM configuracion WHERE id=1 LIMIT 1");
    $pvp_iva_incluido = $result_configuracion[0]['pvp_iva_incluido'];
    $mostrar_mas_vendidos = $result_configuracion[0]['mostrar_mas_vendidos'];
    unset($conn);

    $nowMinus1Hour = new DateTime();
    $nowMinus1Hour->modify('-1 hour');
    if ($ruta_sys != 'usuarios/inicio/' && $ruta_sys != 'suscripcion/' && empty($iban_datos_empresa) && $nowMinus1Hour > $fecha_inicio_plan_datos_empresa) {
        ?>
        <script type="application/javascript">
            window.location.href='<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-suscripcion';
        </script>
        <?php
    }

    $select_sys = "activas";
    require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-categorias.php");
    if (empty($descarga_url)) {
        ?>
        <script>
            console.log("Acceso correcto.");
            if(window.sessionStorage) {
                console.log("sessionStorage OK.");
                if (!sessionStorage.getItem('id_sesion')) {
                    sessionStorage.setItem('id_sesion', '<?php echo $id_sesion_sys; ?>');
                    var idSesion = '<?php echo $id_sesion_sys; ?>';
                }else {
                    var idSesion = sessionStorage.getItem('id_sesion');
                }
                if (!sessionStorage.getItem('ip')) {
                    sessionStorage.setItem('ip', '<?php echo $ip_sys; ?>');
                    var ip = '<?php echo $ip_sys; ?>';
                }else {
                    var ip = sessionStorage.getItem('ip');
                }
                if (!sessionStorage.getItem('id_panel')) {
                    sessionStorage.setItem('id_panel', '<?php echo $id_panel_sys; ?>');
                    var idPanel = '<?php echo $id_panel_sys; ?>';
                }else {
                    var idPanel = sessionStorage.getItem('id_panel');
                }
                if (!sessionStorage.getItem('id_idioma')) {
                    sessionStorage.setItem('id_idioma', '<?php echo $id_idioma_sys; ?>');
                    var idIdioma = '<?php echo $id_idioma_sys; ?>';
                }else {
                    var idIdioma = sessionStorage.getItem('id_idioma');
                }
                if (!sessionStorage.getItem('ruta')) {
                    sessionStorage.setItem('ruta', '<?php echo $ruta_sys; ?>');
                    var ruta = '<?php echo $ruta_sys; ?>';
                }else {
                    var ruta = sessionStorage.getItem('ruta');
                }
            }else {
                console.log("sessionStorage FAIL.");
                var idSesion = '<?php echo $id_sesion_sys; ?>';
                var ip = '<?php echo $ip_sys; ?>';
                var idPanel = '<?php echo $id_panel_sys; ?>';
                var idIdioma = '<?php echo $id_idioma_sys; ?>';
                var ruta = '<?php echo $ruta_sys; ?>';
            }
            var hostBase = '<?php echo $_SERVER['DOCUMENT_ROOT']; ?>';
            var sector = '<?php echo $sector; ?>';
            <?php
            if(isset($ancla_url)) {
            ?>
            var anclaLista ="<?php echo $ancla_url; ?>";
            <?php
            }else {
            ?>
            var anclaLista ="";
            <?php
            }
            if(isset($ancla_ficha_modal)) {
            ?>
            var anclaFichaModal = <?php echo $ancla_ficha_modal; ?>;
            <?php
            }else {
            ?>
            var anclaFichaModal = null;
            <?php
            }
            ?>
        </script>
        <?php
    }
}else {
    unset($_SESSION["id_sesion"]);
    unset($id_sesion);

    $id_panel_sys = 0;
    $sector = "";
    $dominio_ftp_sys = "";
    $dia_sys = "";
    $hora_sys = "";
    $revisar_tablas_sys = 0;
    $id_usuario_sys = 0;
    $usuario_sys = "";
    $id_idioma_sys = 4; // idioma castellano por defecto
    $idioma_sys = "castellano";
    $id_terminal_sys = 0;
    $ip_sys = "";
    $acceso_correcto_sys = 0;
    $path_url_sys = explode('/', $_GET["url"]);
    ?>
    <script>
        console.log("Acceso incorrecto.");
        if(window.sessionStorage) {
            if (sessionStorage.getItem('id_sesion')) {
                sessionStorage.removeItem('id_sesion');
            }
            if (sessionStorage.getItem('ip')) {
                sessionStorage.removeItem('ip');
            }
            if (sessionStorage.getItem('id_panel')) {
                sessionStorage.removeItem('id_panel');
            }
            if (sessionStorage.getItem('id_idioma')) {
                sessionStorage.removeItem('id_idioma');
            }
        }
        var idSesion = '';
        var ip = '';
        var idPanel = '';
        var sector = '';
        var idIdioma = '';
        var hostBase = '';

        <?php
        if ($path_url_sys[0] != 'registro-completar') {
           ?>
            window.location = '<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>?accesos=<?php echo (isset($registrosAccesos))? $registrosAccesos : '0'; ?>';
            <?php
        }
        ?>
    </script>
    <?php
}