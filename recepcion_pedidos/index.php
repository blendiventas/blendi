<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

ob_start();

require("index-datos.php");

if (isset($es_ajax) && !empty($es_ajax)) {
    if ($tiquet_individual) {
        $recepcionDePedido = $recepcionDePedidos[0];
        require 'tiquet-cocina.php';
    } else {
        require("cuerpo.php");
    }
    exit();
}
?>

<!doctype html>
<html lang="<?php echo $lang; ?>" class="<?php if ($darkMode) { echo 'dark'; } ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="https://www.ciclotic.com" />
    <meta http-equiv="content-language" content="<?php echo $lang; ?>" />
    <meta name="description" content="<?php echo $descripcion_meta; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="cicloTIC">

    <meta name="robots" content="<?php echo $robots; ?>">

    <title><?php echo $descripcion_title; ?></title>

    <link rel="canonical" href="<?php echo $host_url; ?>">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo $host_url; ?>assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="<?php echo $host_url; ?>assets/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo $host_url; ?>assets/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link rel="manifest" href="<?php echo $host_url; ?>assets/img/favicons/manifest.json"> -->
    <link rel="mask-icon" href="<?php echo $host_url; ?>assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="<?php echo $host_url; ?>favicon.ico">

    <script src="<?php echo $host_url ?>js/tailwind.js"></script>
    <?php
    if ($darkMode) {
        ?>
        <script src="<?php echo $host ?>js/tailwind-config-dark.js?ver=1.00"></script>
    <link rel="stylesheet" href="<?php echo $host ?>styles-dark.css" />
    <?php
    } else {
    ?>
        <script src="<?php echo $host ?>js/tailwind-config.js?ver=1.00"></script>
        <?php
    }
    ?>
    <script src="<?php echo $host_url ?>js/flowbite.js"></script>
    <script src="<?php echo $host_url ?>js/socket.io.min.js"></script>
    <script src="<?php echo $host_url ?>recepcion_pedidos/scripts.js?v=1.20"></script>

    <link href="<?php echo $host_url ?>recepcion_pedidos/styles.css?v=0.1" rel="stylesheet">
</head>
<body class="bg-blendi-35 dark:text-gray-600">
<?php
require($_SERVER['DOCUMENT_ROOT']."/admin/vistas/cabecera.php");
?>
<div class="mt-20">
    <div class="flex items-center justify-end m-2">
        <div>
            Imprimir tíquets:&nbsp;
        </div>
        <label class="relative inline-flex items-center cursor-pointer mr-5">
            <input type="checkbox" name="imprimir_tiquets" id="imprimir_tiquets" value="1" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blendi-600 dark:peer-focus:ring-blendi-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blendi-600"></div>
        </label>
        <button onclick="actualizarCocina()" id="actualizarCocinaBoton">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </button>
    </div>
</div>
<section id="cuerpo">
    <?php
    require("cuerpo.php");
    ?>
</section>
<div id="notificaciones-mensajes" class="fixed bottom-2 right-2 bg-white dark:text-black p-3 w-1/4 hidden">
    <div id="notificaciones-mensajes-titulo" class="text-md font-bold">
        &nbsp;
    </div>
    <div id="notificaciones-mensajes-body" class="text-sm">
        &nbsp;
    </div>
</div>

<script type="application/javascript">
    if (location.host == 'software.blendi.es') {
        window.socket = io("blendinotifications.es:9000");

        window.sendMessage = function (panel, terminal, message) {
            console.log('SendMessage: Socket not connected');
        }
        window.assignPanelAndTerminal = function (panel, terminal) {
            console.log('AssignPanelAndTerminal: Socket not connected');
        }

        window.socket.on("connect", () => {
            console.log(window.socket.id);

            window.sendMessage = function (panel, terminal, message) {
                // send a message to the server
                window.socket.emit("sendMessage", panel, terminal, message);
            }
            window.assignPanelAndTerminal = function (panel, terminal) {
                // assign panel and terminal to the server
                window.socket.emit("assignPanelAndTerminal", panel, terminal);
            }

            // receive a message from the server
            window.socket.on("newMessage", (...message) => {
                actualizarCocina();
                let notificaciones = document.getElementById('notificaciones-mensajes');
                if (notificaciones) {
                    let notificacionesTitulo = document.getElementById('notificaciones-mensajes-titulo');
                    let notificacionesBody = document.getElementById('notificaciones-mensajes-body');

                    if (notificacionesTitulo && notificacionesBody) {
                        notificacionesTitulo.innerHTML = "Nueva notificación";
                        notificacionesBody.innerHTML = message;

                        notificaciones.classList.remove('hidden');

                        ocultarNotificaciones = setTimeout(function () {
                            let notificaciones = document.getElementById('notificaciones-mensajes');
                            if (notificaciones) {
                                notificaciones.classList.add('hidden');
                            }

                            let imprimir_tiquets = document.getElementById('imprimir_tiquets');
                            if (imprimir_tiquets && imprimir_tiquets.checked) {
                                let messageArray = message.toString().split(' ');
                                imprimirTiquet('tiquet' + messageArray[1]);
                            }
                        }, 10000);
                    }
                }
            });

            window.assignPanelAndTerminal('<?php echo $id_panel; ?>', '<?php echo (empty($id_terminal_sys)) ? '1' : $id_terminal_sys; ?>');
        });
    }
</script>
</body>
</html>
<?php
$length = ob_get_length();
header('Content-Length: '.$length);
