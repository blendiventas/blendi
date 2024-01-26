<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

ob_start();

require("index-datos.php");
?>

<!doctype html>
<html lang="<?php echo $lang; ?>">
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
    <link rel="apple-touch-icon" href="<?php echo $host_url; ?><?php echo $host_web; ?>assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="<?php echo $host_url; ?><?php echo $host_web; ?>assets/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo $host_url; ?><?php echo $host_web; ?>assets/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link rel="manifest" href="<?php echo $host_url; ?><?php echo $host_web; ?>assets/img/favicons/manifest.json"> -->
    <link rel="mask-icon" href="<?php echo $host_url; ?><?php echo $host_web; ?>assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="<?php echo $host_url; ?><?php echo $host_web; ?>assets/img/favicons/favicon.ico">

    <link href="<?php echo $host_url; ?>web/styles.css" rel="stylesheet">

    <script src="<?php echo $host_url ?>js/tailwind.js"></script>
    <script src="<?php echo $host_url ?>js/tailwind-config.js"></script>
    <script src="<?php echo $host_url ?>js/flowbite.js"></script>

    <script src="<?php echo $host_url ?>web/scripts.js?ver=1.11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>


<?php
if (!isset($checkout)) {
    require ('headers/default.php');
}
if (isset($producto)) {
    require('secciones/producto/default.php');
} else if (isset($categoria)) {
    require('secciones/categoria/default.php');
} else if (isset($checkout)) {
    require('secciones/checkout/default.php');
} else if (isset($historialPedidos)) {
    require('secciones/historialPedidos/default.php');
} else if (isset($login)) {
    require('secciones/login/default.php');
} else if (isset($signup)) {
    require('secciones/signup/default.php');
} else {
    require('secciones/inicios/default.php');
}

if (!isset($checkout)) {
    ?>
    <?php
}
?>

<!-- Cart -->
<section class="relative hidden" id="carrito">
    &nbsp;
</section>
<?php
if (!isset($checkout)) {
    ?>
    <section class="py-20 bg-blue-300">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4 pb-6 lg:pb-16 border-b border-gray-400">
                <div class="w-full lg:w-3/5 px-4 mb-20">
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-10 lg:mb-0">
                            <h3 class="mb-8 text-lg font-bold font-heading text-white">Información</h3>
                            <ul>
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">Sobre nosotros</a></li>
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">Comunicaciones</a></li>
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">Condiciones de uso</a></li>
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">Política de privacidad</a></li>
                                <li class="mb-6">
                                <li class="mb-6">
                                <li>
                            </ul>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-10 lg:mb-0">
                            <h3 class="mb-8 text-lg font-bold font-heading text-white">Servicio al cliente</h3>
                            <ul>
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">Buscar un producto</a></li>
                                <li class="mb-6">
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">Pedidos</a></li>
                                <li class="mb-6"><a class="text-gray-50 hover:text-gray-200" href="#">FAQs</a></li>
                                <li class="mb-6">
                                <li>
                            </ul>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-4">
                            <h3 class="mb-8 text-lg text-white font-bold font-heading">Contacto</h3>
                            <ul>
                                <li class="mb-6">
                                    <h4 class="mb-2 text-gray-50">Teléfono</h4>
                                    <a class="text-white hover:underline" href="#">93 000 00 00</a>
                                </li>
                                <li class="mb-6">
                                    <h4 class="mb-2 text-gray-50">Email</h4>
                                    <a class="text-white hover:underline" href="#">test@blendi.com</a>
                                </li>
                                <li>


                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-2/5 px-4 order-first lg:order-1 mb-20">
                    &nbsp;
                </div>
                <div class="w-full px-4 flex flex-wrap justify-between lg:order-last">
                    <div class="w-full md:w-auto mb-4 md:mb-0 flex flex-wrap">
                        <img class="mr-4 mb-2" src="<?php echo $host_web; ?>assets/brands/visa.svg" alt="">
                        <img class="mr-4 mb-2" src="<?php echo $host_web; ?>assets/brands/paypal.svg" alt="">
                        <img class="mb-2" src="<?php echo $host_web; ?>assets/brands/mastercard.svg" alt="">
                    </div>
                    <div class="w-full md:w-auto flex">
                        <a class="inline-flex items-center justify-center w-12 h-12 mr-2 rounded-full" href="#">
                            <img src="<?php echo $host_web; ?>assets/buttons/facebook-white-circle.svg" alt="">
                        </a>
                        <a class="inline-flex items-center justify-center w-12 h-12 mr-2 rounded-full" href="#">
                            <img src="<?php echo $host_web; ?>assets/buttons/instagram-circle.svg" alt="">
                        </a>
                        <a class="inline-flex items-center justify-center w-12 h-12 rounded-full" href="#">
                            <img src="<?php echo $host_web; ?>assets/buttons/twitter-circle.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="pt-14 flex items-center justify-center">
                <a class="inline-block mr-4 text-white text-lg font-bold font-heading" href="<?php echo $host_links; ?>">
                    <img class="h-7" src="<?php echo $host_images . 'datos_empresa/' . $logo_datos_empresa; ?>" alt="" width="auto">
                </a>
                <p class="inline-block text-sm text-gray-200">
                    Precios&nbsp;
                    <?php
                    if ($pvp_iva_incluido) {
                        echo 'con';
                    } else {
                        echo 'sin';
                    }
                    ?>
                    &nbsp;IVA incluido.&nbsp;
                    © Copyright <?php echo date('Y'); ?> <?php echo $nombre_comercial_datos_empresa; ?>
                </p>
            </div>
        </div>
    </section>
    <?php
}
?>
<script type="text/javascript">
    (function() {
        let mostrarCarrito = <?php echo ($abrir_cesta)? 'true' : 'false'; ?>;
        actualizarCarrito(mostrarCarrito, <?php echo (isset($checkout))? 'true' : 'false'; ?>);
    })();
</script>
</body>
</html>
<?php
$length = ob_get_length();
header('Content-Length: '.$length);
