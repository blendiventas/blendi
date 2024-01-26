<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ERROR);

ob_start();

require("index-datos.php");

if (isset($es_ajax) && !empty($es_ajax)) {
    if(!$pagina_de_inicio_sin_login) {
        if(!empty($ruta)) {
            if($ruta == "cobrar-productos") {
                require("cobrar.php");
            }else {
                require($ruta . ".php");
            }
        }else {
            if ($es_ajax_mesas) {
                if ($existen_mesas == true) {
                    require("index-mesas.php");
                }
            } else if ($es_ajax_cabecera_cesta) {
                if($tipo_librador == "tak") {
                    require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-tak.php");
                }else if($tipo_librador == "del") {
                    require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-del.php");
                }else {
                    require($_SERVER['DOCUMENT_ROOT']."/web-vistas/pantallas/datos-cesta-facturacion.php");
                }
            } else if ($es_ajax_documentos) {
                require($_SERVER['DOCUMENT_ROOT']."/web-vistas/documentos/pantalla-lista-general.php");
            } else {
                if (isset($cargar_categorias) && !empty($cargar_categorias)) {
                    require 'categorias.php';
                    require 'subcategorias.php';
                } else if ($mostrar_mas_vendidos && $pagina_de_inicio) {
                    require("index-mas-vendidos.php");
                    ?>
                    <script type="text/javascript">
                        (function() {
                            setCapaProductosHeight();
                        })();
                    </script>
                    <?php
                } else if ($productos_mostrar == true) {
                    require("productos.php");
                    ?>
                    <script type="text/javascript">
                        (function() {
                            setCapaProductosHeight();
                        })();
                    </script>
                    <?php
                } else if ($ficha_producto == true) {
                    require("web-vistas/producto/producto.php");
                    ?>
                    <script type="text/javascript">
                        (function() {
                            setCapaProductosHeight();
                        })();
                    </script>
                    <?php
                }
            }
        }

        ?>
        <script>
            (function() {
                <?php
                if(!empty($ruta) && $ruta == "cobrar") {
                    ?>
                    setUltimoElementoImporteEntregado(-1);
                    datosCobrar("0");
                    <?php
                }
                if(!empty($ruta) && $ruta == "cobrar-productos") {
                    if($lineas_documento > 1) {
                        ?>
                        setUltimoElementoImporteEntregado(-1);
                        datosCobrar("1");
                        <?php
                    }else {
                        ?>
                        setUltimoElementoImporteEntregado(-1);
                        datosCobrar("0");
                        <?php
                    }
                }
                ?>
            })();

            window.onload = function () {
                <?php
                if(!empty($ruta) && ($ruta == "cobrar" || $ruta == "cobrar-productos")) {
                    ?>
                    selectUltimoElementoImporteEntregado();
                    <?php
                }
                ?>
            }
        </script>
        <?php
        exit();
    }
}
?>

<!doctype html>
<html lang="<?php echo $lang; ?>" class="h-full bg-gray-100 <?php if ($darkMode) { echo 'dark'; } ?>">
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

    <?php
    if(!empty($foto_meta)) {
        ?>
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php echo $descripcion_title; ?>">
        <meta name="twitter:description" content="<?php echo $descripcion_meta; ?>">
        <meta name="twitter:image" content="<?php echo $foto_meta; ?>">
        <meta name="twitter:image:alt" content="<?php echo $foto_alt; ?>">

        <!-- Open Graph data -->
        <meta property="og:locale" content="<?php echo $locale_og; ?>" />
        <meta property="og:title" content="<?php echo $descripcion_title; ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo $url_completa; ?>" />
        <meta property="og:image" content="<?php echo $foto_meta; ?>" />
        <meta property="og:description" content="<?php echo $descripcion_meta; ?>" />
        <meta property="og:site_name" content="compra-e" />
        <?php
        if(!empty($pvp_meta)) {
            ?>
            <meta property="og:price:amount" content="<?php echo $pvp_meta; ?>" />
            <meta property="og:price:currency" content="EUR" />
            <?php
        }
    }
    ?>

    <link rel="canonical" href="<?php echo $host; ?>">

    <link href="<?php echo $host; ?>styles.css?v=1.35" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo $host; ?>assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="<?php echo $host; ?>assets/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo $host; ?>assets/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link rel="manifest" href="<?php echo $host; ?>assets/img/favicons/manifest.json"> -->
    <link rel="mask-icon" href="<?php echo $host; ?>assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="<?php echo $host; ?>favicon.ico">

    <script src="<?php echo $host; ?>scripts.js?v=1.36"></script>

    <?php
    if($interface == "tpv") {
        ?>
        <script src="<?php echo $host; ?>scripts_tpv.js"></script>
        <?php
        /*
        if($mesas_mostrar == true) {
            ?>
            <script src="<?php echo $host; ?>scripts_mesas.js"></script>
            <?php
        }
        */
    }
    if($ruta == "acceso-registro") {
        ?>
        <script src="<?php echo $host; ?>acceso-registro.js"></script>
        <?php
    }
    ?>

    <?php
    if ($pagina_de_inicio_sin_login && !empty($accion) && $accion == 'versiones') {
        ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $host ?>lib/markdown/assets/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo $host ?>lib/markdown/assets/css/bootstrap-responsive.css"/>
        <script type="text/javascript" src="<?php echo $host ?>lib/markdown/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $host ?>lib/markdown/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/marked.min.js"></script>
        <?php
    } else {
        ?>
        <link rel="stylesheet" href="<?php echo $host ?>css/flowbite.min.css" />
        <meta name="theme-color" content="#7952b3" />
        <script src="<?php echo $host ?>js/tailwind.js"></script>
        <?php
        if ($darkMode) {
            ?>
            <script src="<?php echo $host ?>js/tailwind-config-dark.js"></script>
            <link rel="stylesheet" href="<?php echo $host ?>styles-dark.css" />
            <?php
        } else {
            ?>
            <script src="<?php echo $host ?>js/tailwind-config.js"></script>
            <?php
        }
        ?>
        <script src="<?php echo $host ?>js/flowbite.js"></script>
        <script src="<?php echo $host ?>lib/kioskboard/kioskboard-aio-2.3.0.min.js"></script>
        <script src="<?php echo $host ?>js/socket.io.min.js"></script>
        <?php
    }
    ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <?php
    if ($pagina_de_inicio_sin_login) {
        ?>
        <script src="https://accounts.google.com/gsi/client" async defer></script>
        <?php
    }
    ?>
</head>
<!-- <body class="d-flex flex-column h-99-3" oncontextmenu="return false"> -->
<!-- <body class="d-flex flex-column h-99-3 m-0"> -->
<body class="h-full text-gray-600 bg-white" id="main_frame">
<div class="min-h-full">
    <?php
    if ($pagina_de_inicio_sin_login) {
        if (empty($accion)) {
            ?>
            <!--<nav class="bg-white shadow z-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="flex flex-1 items-center sm:items-stretch sm:justify-start">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-8" src="<?php echo $host ?>images/logo.png" alt="Blendi Ventas">
                            </div>
                            <div class="hidden sm:block">
                                <div class="ml-10 flex items-baseline">
                                    <a href="#" class="h-16 flex items-center text-black font-bold px-3 py-2 text-sm border-y-2 border-b-blendi-700 border-t-white" aria-current="page">Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <div class="flex items-center">
                            <div>
                                <div class="ml-10 flex items-baseline">
                                    <a href="<?php echo $host . "/admin";?>" title="Iniciar sesión" class="h-16 flex items-center text-gray px-3 py-2 text-sm font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white">Inicio sesión</a>
                                    <a href="<?php echo $host . "/admin/registro";?>" title="Iniciar sesión" class="h-16 flex items-center text-gray px-3 py-2 text-sm font-medium hover:border-y-2 hover:border-b-blendi-700 hover:border-t-white">Registro</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>-->
            <main class="w-full h-full home">
                <div class="grid grid-cols-1 sm:grid-cols-2 h-full">
                    <div class="items-center">
                        <div id="logo_blendi_vector" class="items-center flex sm:block">
                            <?php echo file_get_contents('images/logoBlendiBg/logo_blendi_bg_' . rand(1, 14) . '.svg'); ?>
                            <img src="/images/logo_white_sl.png" title="Blendi ventas" alt="Blendi ventas" class="mt-8 mx-auto" id="logo_blendi_sl" />
                        </div>
                    </div>
                    <div class="h-full w-full overflow-y-auto sm:bg-white backdrop-blur-lg px-3 sm:px-20 text-white sm:text-gray-450">
                        <div class="mt-3 sm:mt-32 text-3xl font-medium">
                            Iniciar sesión
                        </div>
                        <div class="text-l">
                            Introduce tus credenciales para acceder a tu cuenta
                        </div>
                        <div class="mt-4 flex justify-center">
                            <div id="g_id_onload"
                                 data-client_id="216923566052-4qtdf1f3egn20cc8sj05idic5agv2fmq.apps.googleusercontent.com"
                                 data-login_uri="https://software.blendi.es/admin/usuarios-inicio"
                                 data-auto_prompt="false">
                            </div>
                            <div class="g_id_signin"
                                 data-type="standard"
                                 data-size="large"
                                 data-theme="outline"
                                 data-text="sign_in_with"
                                 data-shape="rectangular"
                                 data-logo_alignment="left">
                            </div>
                        </div>
                        <div class="flex my-14">
                            <div class="grow mt-3">
                                <hr />
                            </div>
                            <div class="mx-12">
                                o
                            </div>
                            <div class="grow mt-3">
                                <hr />
                            </div>
                        </div>
                        <div id="iniciar_sesion">
                            <form action="/admin/usuarios-inicio" target="_self" method="post">
                                <div>
                                    <label for="empresa" class="block mb-2 text-l">Email</label>
                                    <div class="flex items-center">
                                        <input tabindex="0" type="email" name="empresa" id="empresa" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5 js-virtual-keyboard" data-kioskboard-type="all" data-kioskboard-placement="bottom" data-kioskboard-specialcharacters="true" placeholder="Email" maxlength="45" required />
                                    </div>
                                    <a tabindex="-1" class="text-xs text-gray-500 hover:text-gray-900" onclick="loadKeyboard('empresa')" href="javascript:;">Mostrar teclado</a>
                                </div>
                                <div class="mt-8">
                                    <div class="flex">
                                        <label for="clave" class="block mb-2 text-l">Contraseña</label>
                                        <div class="grow text-right">
                                            <a tabindex="-1" href="javascript:;" onclick="toggleOlvidasteTuContrasena()" class="underline hover:no-underline" title="¿Olvidaste tu contraseña?">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="relative w-full">
                                            <input  type="password" name="clave" id="clave" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5 js-virtual-keyboard" data-kioskboard-type="all" data-kioskboard-placement="bottom" data-kioskboard-specialcharacters="true" placeholder="Contraseña" maxlength="45" required/>
                                            <div class="absolute right-0 top-0 py-[2.5px] pr-[3px]">
                                                <a tabindex="-1" id="showPasswordLogin-clave" onclick="toogleShowPasswordLogin()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">Mostrar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="text-xs text-gray-500 hover:text-gray-900" onclick="loadKeyboard('clave')" href="javascript:;">Mostrar teclado</a>
                                </div>
                                <?php
                                if (isset($parametersGet['accesos'])) {
                                    ?>
                                    <div class="mt-8">
                                        Se ha intentado hacer login <?php echo $parametersGet['accesos']; ?> veces.
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="mt-8">
                                    <button type="submit" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center">Iniciar sesión</button>
                                </div>
                                <div class="mt-8">
                                    ¿Todavía no eres miembro? <a href="#" id="handleRegistroClick" onclick="toggleIniciarSesionRegistro()" class="font-medium underline hover:no-underline" title="Regístrate">Regístrate</a>
                                </div>
                            </form>
                        </div>
                        <div id="registro" class="hidden">
                            <form action="/admin/registro-completar" target="_self" method="post">
                                <div>
                                    <label for="empresa_registro" class="block text-l">Email</label>
                                    <input type="email" name="empresa" id="empresa_registro" class="rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Email" maxlength="45" required />
                                </div>
                                <div class="mt-2">
                                    <label for="clave_registro" class="block text-l">Contraseña</label>
                                    <div class="flex items-center">
                                        <div class="relative w-full">
                                            <input  type="password" name="clave" id="clave_registro" class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5 js-virtual-keyboard" data-kioskboard-type="all" data-kioskboard-placement="bottom" data-kioskboard-specialcharacters="true" placeholder="Contraseña" maxlength="45" required/>
                                            <div class="absolute right-0 top-0 py-[2.5px] pr-[3px]">
                                                <a tabindex="-1" id="showPasswordLogin-clave_registro" onclick="toogleShowPasswordLogin(1)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">Mostrar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="codigo_promocional" class="block text-l">Código promocional</label>
                                    <input type="text"
                                           value="<?php echo $codigoPromocional; ?>"
                                           name="codigo_promocional"
                                           id="codigo_promocional"
                                           placeholder="Código promocional"
                                           maxlength="45"
                                           class="rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5"
                                    />
                                </div>
                                <div class="mt-2">
                                    <label for="sector_registro" class="block text-l">Sector</label>
                                    <select name="sector" id="sector_registro" class="rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" required>
                                        <option value="restauracion" selected>Restauración</option>
                                        <option value="restauracion">Salas de fiesta</option>
                                        <option value="empresa">Empresa</option>
                                        <!--<option value="comercio">Comercio</option>
                                        <option value="estetica">Estética</option>
                                        <option value="empresa">Empresa</option>-->
                                    </select>
                                </div>
                                <div class="mt-2 text-xs flex items-center">
                                    <input type="checkbox" name="check_condiciones" id="check_condiciones" class="w-4 h-4 text-blendi-600 mr-3" required />
                                    <div>Acepto los <a href="/?accion=condiciones" class="font-medium underline hover:no-underline" title="Condiciones">Términos y Condiciones</a> y <a href="/?accion=politica_privacidad" class="font-medium underline hover:no-underline" title="Política de privacidad">Política de privacidad</a>.</div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center">Registrarse</button>
                                </div>
                                <div class="mt-2">
                                    ¿Ya tienes cuenta? <a href="#" onclick="toggleIniciarSesionRegistro()" class="font-medium underline hover:no-underline" title="Inicia sesión">Inicia sesión</a>
                                </div>
                            </form>
                        </div>
                        <div id="password_olvidado" class="hidden">
                            <div>
                                <label for="empresa_password_olvidado" class="block mb-2 text-l">Email</label>
                                <input type="email" name="empresa" id="empresa_password_olvidado" class="rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Email" maxlength="45" required />
                            </div>
                            <div class="mt-8" id="boton_restaurar_password">
                                <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="restaurarContrasena()">Restaurar contraseña</button>
                            </div>
                            <div class="mt-8">
                                <a href="#" onclick="toggleOlvidasteTuContrasena()" class="font-medium underline hover:no-underline" title="Iniciar sesión">Iniciar sesión</a>
                            </div>
                        </div>
                        <p class="text-xs">
                            Consulta nuestras <a href="/?accion=condiciones" class="font-medium underline hover:no-underline" title="Condiciones">Condiciones</a> y <a href="/?accion=politica_privacidad" class="font-medium underline hover:no-underline" title="Política de privacidad">Política de privacidad</a>.
                        </p>
                    </div>
                </div>
            </main>
            <?php
        } elseif($accion == 'restaurar_password') {
            $email = (isset($_GET['email']))? urldecode($_GET['email']) : null;
            $token = (isset($_GET['token']))? $_GET['token'] : null;
            ?>
            <main class="w-full h-full home">
                <div class="grid grid-cols-1 sm:grid-cols-2 h-full">
                    <div class="items-center hidden sm:flex">
                        <div class="h-1/2 w-4/6 mx-auto p-14 rounded-lg bg-blendigray-100/40 backdrop-blur-sm text-white">
                            <img src="/images/logo_white.png" title="Blendi ventas" alt="Blendi ventas" class="w-7/12" />
                            <div class="my-3 text-2xl font-medium">
                                Administra todo, todo desde un solo lugar.
                            </div>
                            <div class="text-sm">
                                Tu negocio al alcance de la mano para tomar decisiones informadas y planificar el futuro con confianza.
                            </div>
                        </div>
                    </div>
                    <div class="h-full w-full bg-blendigray-100/40 backdrop-blur-lg px-3 sm:px-20 text-white">
                        <div class="mt-12 sm:mt-32 text-3xl font-medium">
                            Restaurar contraseña
                        </div>
                        <div class="text-l">
                            Introduce tu nueva contraseña para acceder a tu cuenta
                        </div>
                        <div id="restaurar_password">
                            <div>
                                <label for="empresa_password_restaurar" class="block mb-2 text-l">Nueva contraseña</label>
                                <input type="password" name="password" id="empresa_password_restaurar" class="rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5" placeholder="Nueva contraseña" maxlength="45" required />
                            </div>
                            <div class="mt-8" id="boton_restaurar_password">
                                <button type="button" class="text-white bg-blendi-600 font-medium text-sm px-5 py-2.5 w-full text-center" onclick="modificarContrasena('<?php echo $email; ?>', '<?php echo $token; ?>')">Modificar contraseña</button>
                            </div>
                        </div>
                        <p class="text-xs">
                            Consulta nuestras <a href="/?accion=condiciones" class="font-medium underline hover:no-underline" title="Condiciones">Condiciones</a> y <a href="/?accion=politica_privacidad" class="font-medium underline hover:no-underline" title="Política de privacidad">Política de privacidad</a>.
                        </p>
                    </div>
                </div>
            </main>
            <?php
        } elseif($accion == 'versiones') {
            ?>
            <div class="container">
                <div class="row">
                    <div class="span8">
                        <h2>Notas de versión</h2>
                    </div>
                    <div class="span4" style="margin-top: 18px;">
                        <select name="version" id="version" onchange="toggleVersion()">
                            <?php
                            $firstSelected = false;
                            foreach ($versiones as $version) {
                                ?>
                                <option value="<?php echo str_replace('.', '_', $version['version']); ?>" <?php echo (!$firstSelected)? 'selected' : ''; ?>><?php echo $version['version']; ?></option>
                                <?php
                                $firstSelected = true;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <script type="text/javascript">
                    let capaVersion = '';
                </script>
                <?php
                $firstSelected = false;
                foreach ($versiones as $version) {
                    $idCapaVersion = 'capa_version_' . str_replace('.', '_', $version['version']);
                    ?>
                    <div class="versiones row <?php echo ($firstSelected)? 'hidden' : ''; ?>" id="<?php echo $idCapaVersion; ?>"><?php echo $version['text_md']; ?></div>
                    <script type="text/javascript">
                        capaVersion = document.getElementById('<?php echo $idCapaVersion; ?>');
                        capaVersion.innerHTML = marked.parse(capaVersion.innerHTML);
                    </script>
                    <?php
                    $firstSelected = true;
                }
                ?>
            </div>
            <?php
        } elseif($accion == 'politica_privacidad') {
            ?>
            <h3>POLITICA DE PRIVACIDAD</h3>
            <p> Última actualización: Enero 2021.</p>
            <p><strong>1.</strong> <strong>INFORMACIÓN AL USUARIO</strong></p>
            <p><strong>TU EMPRESA, S.L.</strong>, como Responsable del Tratamiento, le informa que, según lo dispuesto en el Reglamento (UE) 2016/679, de 27 de abril, (RGPD) y en la L.O. 3/2018, de 5 de diciembre, de protección de datos y garantía de los derechos digitales (LOPDGDD), trataremos su datos tal y como reflejamos en la presente Política de Privacidad.</p>
            <p>En esta Política de Privacidad describimos cómo recogemos sus datos personales y por qué los recogemos, qué hacemos con ellos, con quién los compartimos, cómo los protegemos y sus opciones en cuanto al tratamiento de sus datos personales.</p>
            <p>Esta Política se aplica al tratamiento de sus datos personales recogidos por la empresa para la prestación de sus servicios. Si acepta las medidas de esta Política, acepta que tratemos sus datos personales como se define en esta Política.</p>
            <p><strong>2. CONTACTO</strong></p>
            <p>Denominación social: <strong>TU EMPRESA, S.L.</strong> <br>Nombre comercial: <strong>TU EMPRESA</strong><br>CIF: <strong>NUMERO CIF</strong><br>Domicilio: <strong>DIRECCION DE TU NEGOCIO</strong><br>e-mail: <strong>tuemail@tudominio. com</strong><br>&nbsp;<br><strong>3. PRINCIPIOS CLAVE</strong></p>
            <p>Siempre hemos estado comprometidos con prestar nuestros servicios con el más alto grado de calidad, lo que incluye tratar sus datos con seguridad y transparencia. Nuestros principios son:</p>
            <ul><li><strong>Legalidad</strong>: Solo recopilaremos sus Datos personales para fines específicos, explícitos y legítimos.</li><li><strong>Minimización de datos</strong>: Limitamos la recogida de datos de carácter personal a lo que es estrictamente relevante y necesario para los fines para los que se han recopilado.</li><li><strong>Limitación de la Finalidad</strong>: Solo recogeremos sus datos personales para los fines declarados y solo según sus deseos.</li><li><strong>Precisión</strong>: Mantendremos sus datos personales exactos y actualizados.</li><li><strong>Seguridad de los Datos</strong>: Aplicamos las medidas técnicas y organizativas adecuadas y proporcionales a los riesgos para garantizar que sus datos no sufran daños, tales como divulgación o acceso no autorizado, la destrucción accidental o ilícita o su pérdida accidental o alteración y cualquier otra forma de tratamiento ilícito.</li><li><strong>Acceso y Rectificación</strong>: Disponemos de medios para que acceda o rectifique sus datos cuando lo considere oportuno.</li><li><strong>Conservación</strong>: Conservamos sus datos personales de manera legal y apropiada y solo mientras es necesario para los fines para los que se han recopilado.</li><li><strong>Las transferencias internacionales</strong>: cuando se dé el caso de que sus datos vayan a ser transferidos fuera de la UE/EEE se protegerán adecuadamente.</li><li><strong>Terceros</strong>: El acceso y transferencia de datos personales a terceros se llevan a cabo de acuerdo con las leyes y reglamentos aplicables y con las garantías contractuales adecuadas.</li><li><strong>Marketing Directo y cookies</strong>: Cumplimos con la legislación aplicable en materia de publicidad y cookies.</li></ul>
            <p><strong>4. RECOGIDA Y TRATAMIENTO DE SUS DATOS PERSONALES</strong><br>Las tipos de datos que se pueden solicitar y tratar son:</p>
            <ul><li>Datos de carácter identificativo.</li></ul>
            <p>También recogemos de forma automática datos sobre su visita a nuestro sitio web&nbsp; según se describe en la política de cookies.</p>
            <p>Siempre que solicitemos sus Datos personales, le informaremos con claridad de qué datos personales recogemos y con qué fin. En general, recogemos y tratamos sus datos personales con el propósito de:</p>
            <ul><li>Proporcionar información, servicios, productos, información relevante y novedades en el sector.</li><li>Envío de comunicaciones.</li></ul>
            <p><strong>5. LEGITIMIDAD</strong></p>
            <p>De acuerdo con la normativa de protección de datos aplicable, sus datos personales podrán tratarse siempre que:</p>
            <ul><li>Nos ha dado su consentimiento a los efectos del tratamiento. Por supuesto podrá retirar su consentimiento en cualquier momento.</li><li>Por requerimiento legal.</li><li>Por exisitr un interés legítimo que no se vea menoscabado por sus derechos de privacidad, como por ejemplo el envío de información comercial bien por suscripción a nuestra newsletter o por su condición de cliente.</li><li>Por se necesaria para la prestación de alguno de nuestros servicios mediante relación contractual entre usted y nosotros.</li></ul>
            <p><strong>6. COMUNICACIÓN DE DATOS PERSONALES</strong></p>
            <p>Los datos pueden ser comunicados a empresas relacionadas con&nbsp;<strong>TU EMPRESA, S.L.</strong>&nbsp;para la prestación de los diversos servicios en calidad de Encargados del Tratamiento. La empresa no realizará ninguna cesión, salvo por obligación legal.</p>
            <p><strong>7. SUS DERECHOS</strong></p>
            <p>En relación con la recogida y tratamiento de sus datos personales, puede ponerse en contacto con nosotros en cualquier momento para:</p>
            <ul><li>Acceder a sus datos personales y a cualquier otra información indicada en el Artículo 15.1 del RGPD.</li><li>Rectificar sus datos personales que sean inexactos o estén incompletos de acuerdo con el Artículo 16 del RGPD.</li><li>Suprimir sus datos personales de acuerdo con el Artículo 17 del RGPD.</li><li>Limitar el tratamiento de sus datos personales de acuerdo con el Artículo 18 del RGPD.</li><li>Solicitar la portabilidad de sus datos de acuerdo con el Artículo 20 del <a href="https://presencialismo.com" class="rank-math-link" target="_blank" rel="noopener"><span class="has-inline-color has-black-color">RGPD</span></a>.</li><li>Oponerse al tratamiento de sus datos personales de acuerdo con el artículo 21 del RGPD.</li></ul>
            <p>Si ha otorgado su consentimiento para alguna finalidad concreta, tiene derecho a retirar el consentimiento otorgado en cualquier momento, sin que ello afecte a la licitud del tratamiento basado en el consentimiento previo a su retirada <a href="https://presencialismo.com" class="rank-math-link" target="_blank" rel="noopener"><span class="has-inline-color has-black-color">rrhh</span></a>.</p>
            <p>Puede ejercer estos derechos enviando comunicación, motivada y acreditada, a tuemail@tudominio .com</p>
            <p>También tiene derecho a presentar una reclamación ante la Autoridad de control competente (<a href="https://aepd.es" class="rank-math-link" target="_blank" rel="noopener">www.aepd.es</a>) si&nbsp;considera que el tratamiento no se ajusta a la normativa vigente.</p>
            <p><strong>8. INFORMACIÓN LEGAL</strong><br>Los requisitos de esta Política complementan, y no reemplazan, cualquier otro requisito existente bajo la ley de protección de datos aplicable, que será la que prevalezca en cualquier caso.</p>
            <p>Esta Política está sujeta a revisiones periódicas y la empresa puede modificarla en cualquier momento. Cuando esto ocurra, le avisaremos de cualquier cambio y le pediremos que vuelva a leer la versión más reciente de nuestra Política y que confirme su aceptación.</p>
            <?php
        } elseif($accion == 'condiciones') {
            ?>
            <h2 style="text-align: center;"><strong>Términos y Condiciones de Uso</strong></h2><p>&nbsp;</p><p><strong>INFORMACIÓN
                RELEVANTE</strong></p><p>Es requisito necesario para la adquisición de los productos que se ofrecen en este
            sitio, que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan. El uso de nuestros
            servicios así como la compra de nuestros productos implicará que usted ha leído y aceptado los Términos y
            Condiciones de Uso en el presente documento. Todas los productos &nbsp;que son ofrecidos por nuestro sitio web
            pudieran ser creadas, cobradas, enviadas o presentadas por una página web tercera y en tal caso estarían sujetas
            a sus propios Términos y Condiciones. En algunos casos, para adquirir un producto, será necesario el registro
            por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.</p><p>El
            usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en
            caso de que se haya registrado y que sea necesario para la compra de alguno de nuestros productos.
            https://blendiventas.es no asume la responsabilidad en caso de que entregue dicha clave a terceros.</p><p>Todas
            las compras y transacciones que se lleven a cabo por medio de este sitio web, están sujetas a un proceso de
            confirmación y verificación, el cual podría incluir la verificación del stock y disponibilidad de producto,
            validación de la forma de pago, validación de la factura (en caso de existir) y el cumplimiento de las
            condiciones requeridas por el medio de pago seleccionado. En algunos casos puede que se requiera una
            verificación por medio de correo electrónico.</p><p>Los precios de los productos ofrecidos en esta Tienda Online
            es válido solamente en las compras realizadas en este sitio web.</p><p><strong>LICENCIA</strong></p><p>Blendi
            Ventas&nbsp; a través de su sitio web concede una licencia para que los usuarios utilicen&nbsp; los productos
            que son vendidos en este sitio web de acuerdo a los Términos y Condiciones que se describen en este
            documento.</p><p><strong>USO NO AUTORIZADO</strong></p><p>En caso de que aplique (para venta de software,
            templetes, u otro producto de diseño y programación) usted no puede colocar uno de nuestros productos,
            modificado o sin modificar, en un CD, sitio web o ningún otro medio y ofrecerlos para la redistribución o la
            reventa de ningún tipo.</p><p><strong>PROPIEDAD</strong></p><p>Usted no puede declarar propiedad intelectual o
            exclusiva a ninguno de nuestros productos, modificado o sin modificar. Todos los productos son propiedad &nbsp;de
            los proveedores del contenido. En caso de que no se especifique lo contrario, nuestros productos se proporcionan&nbsp;
            sin ningún tipo de garantía, expresa o implícita. En ningún esta compañía será &nbsp;responsables de ningún daño
            incluyendo, pero no limitado a, daños directos, indirectos, especiales, fortuitos o consecuentes u otras
            pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros productos.</p><p><strong>POLÍTICA DE
                REEMBOLSO Y GARANTÍA</strong></p><p>En el caso de productos que sean&nbsp; mercancías irrevocables
            no-tangibles, no realizamos reembolsos después de que se envíe el producto, usted tiene la responsabilidad de
            entender antes de comprarlo. &nbsp;Le pedimos que lea cuidadosamente antes de comprarlo. Hacemos solamente
            excepciones con esta regla cuando la descripción no se ajusta al producto. Hay algunos productos que pudieran
            tener garantía y posibilidad de reembolso pero este será especificado al comprar el producto. En tales casos la
            garantía solo cubrirá fallas de fábrica y sólo se hará efectiva cuando el producto se haya usado correctamente.
            La garantía no cubre averías o daños ocasionados por uso indebido. Los términos de la garantía están asociados a
            fallas de fabricación y funcionamiento en condiciones normales de los productos y sólo se harán efectivos estos
            términos si el equipo ha sido usado correctamente. Esto incluye:</p><p>– De acuerdo a las especificaciones
            técnicas indicadas para cada producto.<br>– En condiciones ambientales acorde con las especificaciones indicadas
            por el fabricante.<br>– En uso específico para la función con que fue diseñado de fábrica.<br>– En condiciones
            de operación eléctricas acorde con las especificaciones y tolerancias indicadas.</p><p><strong>COMPROBACIÓN
                ANTIFRAUDE</strong></p><p>La compra del cliente puede ser aplazada para la comprobación antifraude. También
            puede ser suspendida por más tiempo para una investigación más rigurosa, para evitar transacciones
            fraudulentas.</p><p><strong>PRIVACIDAD</strong></p><p>Este https://blendiventas.es garantiza que la <a
                    href="https://noticiasvalenciacf.es/" target="_blank">valencia cf noticias</a> información personal que
            usted envía cuenta con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una
            validación de los pedidos no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una
            orden judicial o requerimientos legales.</p><p>La suscripción a boletines de correos electrónicos publicitarios
            es voluntaria y podría ser seleccionada al momento de crear su cuenta.</p><p>Blendi Ventas reserva los derechos
            de cambiar o de modificar estos términos sin previo aviso.</p><p>Estas terminos y condiciones se han generado en&nbsp;<a
                    href="http://terminosycondicionesdeusoejemplo.com/"
                    target="_blank">terminosycondicionesdeusoejemplo.com</a>.</p>
            <?php
        } else {
            echo 'Página no encontrada';
        }
    } else {
        ?>
        <script type="text/javascript">
            function goFullscreen(checkexit) {
                // Must be called as a result of user interaction to work
                mf = document.getElementById("main_frame");
                if (mf && document.webkitFullscreenElement == null) {
                    mf.webkitRequestFullscreen();
                } else {
                    if (checkexit) {
                        document.webkitExitFullscreen();
                    }
                }
            }
            function fullscreenChanged() {
                maxicon = document.getElementById('maximize_icon');
                minicon = document.getElementById('minimize_icon');
                if (maxicon && minicon) {
                    if (document.webkitFullscreenElement == null) {
                        minicon.classList.add('hidden');
                        maxicon.classList.remove('hidden');
                    } else {
                        maxicon.classList.add('hidden');
                        minicon.classList.remove('hidden');
                    }
                }
                setTimeout(setHeights, 1000);
            }
            document.onwebkitfullscreenchange = fullscreenChanged;
            // document.documentElement.onclick = (function() { goFullscreen(false); });
            // document.onkeydown = (function() { goFullscreen(false); });
        </script>
        <?php
        if($interface == "tpv") {
            require("header-tpv.php");
        }else {
            require("header-web.php");
        }
        ?>
        <div class="py-5">&nbsp;</div>
        <div class="bg-main z-10"  id="bg-main">
            <?php
            if ($existen_mesas == true) {
                ?>
                <div id="capa_comedor" class="hidden overflow-y-auto">
                    <?php
                    require("index-mesas.php");
                    ?>
                </div>
                <?php
                require("index-comensales.php");
                require("index-entrega_domicilio.php");
            }

            ?>
            <div id="main" class="bg-main pt-2">
                <?php
                if($mostrar_cesta == "superior") {
                    ?>
                    <div id="capa-cesta" class="mr-1 ml-1">
                        <button id="button-cesta-cerrar" onclick="collapseCapa('capa-cesta');">
                            <img class="icono" src="<?php echo $host; ?>icons/System/close-fill.svg" alt="Cerrar cesta" />
                        </button><br />
                        <div id="loader-capa-cesta"></div>
                        <div id="contenido-capa-cesta">
                            <?php
                            require("pantalla-documento.php");
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div id="capa_documentos" class="hidden bg-blendi-35">
                    <?php
                    require ($_SERVER['DOCUMENT_ROOT'] . "/web-vistas/documentos/pantalla-inicio.php");
                    ?>
                </div>
                <?php
                if(!empty($ruta)) {
                    if ($mostrar_cesta == "lateral") {
                        ?>
                        <div id="capa-cesta-lateral" class="p-2 bg-white hidden">
                            <div id="loader-capa-cesta"></div>
                            <div id="contenido-capa-cesta" class="h-full">
                                <?php
                                require("pantalla-documento.php");
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    if($ruta == "cobrar-productos") {
                        ?>
                        <div id="capa_cobrar" class="hidden">
                            <?php
                            require("cobrar.php");
                            ?>
                        </div>
                        <?php
                    }else {
                        ?>
                        <div id="capa_<?php echo $ruta; ?>">
                            <?php
                            require($ruta . ".php");
                            ?>
                        </div>
                        <?php
                    }
                }else {
                    $grids_segun_capa_cesta = '5';

                    $id_capa_productos_ficha = '';
                    if ($productos_mostrar == true) {
                        $id_capa_productos_ficha = 'capa_productos';
                    } else if($ficha_producto == true) {
                        $id_capa_productos_ficha = 'capa_ficha_producto';
                    } else {
                        $id_capa_productos_ficha = 'capa_productos';
                    }
                    ?>
                    <div id="<?php echo $id_capa_productos_ficha; ?>" class="hidden">
                        <div class="grid grid-cols-5 bg-blendi-35">
                            <?php
                            if ($mostrar_cesta == "lateral") {
                                $grids_segun_capa_cesta = '3';
                                ?>
                                <div id="capa-cesta-lateral" class="bg-white hidden col-span-5 mb-3 sm:col-span-2 sm:block sm:mb-0">
                                    <div id="loader-capa-cesta"></div>
                                    <div id="contenido-capa-cesta" class="h-full">
                                        <?php
                                        require("pantalla-documento.php");
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-span-5 sm:col-span-<?php echo $grids_segun_capa_cesta; ?>">
                                <div id="capa_general_categorias" class="sticky top-[66px] col-span-5 sm:col-span-3 z-30">
                                    <?php
                                    require 'categorias.php';
                                    require 'subcategorias.php';
                                    ?>
                                </div>
                                <?php
                                if($mostrar_mas_vendidos && $pagina_de_inicio) {
                                    ?>
                                    <div id="capa_general_productos">
                                        <?php
                                        require("index-mas-vendidos.php");
                                        ?>
                                    </div>
                                    <?php
                                } else if ($productos_mostrar == true) {
                                    ?>
                                    <div id="capa_general_productos">
                                        <?php
                                        require("productos.php");
                                        ?>
                                    </div>
                                    <?php
                                } else if ($ficha_producto == true) {
                                    ?>
                                    <div id="capa_general_productos">
                                        <?php
                                        require("web-vistas/producto/producto.php");
                                        ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div id="capa_general_productos">
                                        &nbsp;
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <button id="botonOpenModalProducto" class="hidden" type="button" data-modal-toggle="capa-producto-modal">
                                Toggle modal
                            </button>
                            <div id="capa-producto-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white shadow bg-blendimodal-background dark:bg-white">
                                        <!-- Modal header -->
                                        <div class="hidden flex justify-between items-start p-4 rounded-t">
                                            <h3 class="ml-3 text-xl font-semibold" id="titulo-producto-modal">
                                                Producto
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="capa-producto-modal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Cerrar pantalla</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="w-full p-3" id="body-producto-modal">
                                            Cargando producto...
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center justify-end p-6 space-x-2 rounded-b">
                                            <button data-modal-toggle="capa-producto-modal" type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" id="cerrar_modal_producto">Descartar</button>
                                            <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="comprarProducto(0, 'insertar-producto', 0, 0, 0, '_modal');">Añadir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- INICIO MODAL Impresión -->
                            <?php
                            $select_sys = "obtener_modelos";
                            require($_SERVER['DOCUMENT_ROOT']."/web-gestion/datos-documentos.php");
                            ?>
                            <button id="botonOpenModalImpresion" class="hidden" type="button" data-modal-toggle="modal-impresion">
                                Toggle modal
                            </button>
                            <div id="modal-impresion" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                                <div class="relative p-4 w-full sm:w-5/6 h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-blendimodal-background shadow dark:bg-white">
                                        <!-- Modal header -->
                                        <div class="flex justify-between items-start p-4 rounded-t">
                                            <h3 class="text-xl font-semibold">
                                                Impresión de documento
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-impresion">
                                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Cerrar pantalla</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="w-full px-4 pb-4">
                                            Modelo de impresión:<br>
                                            <select class="w-96 mb-8p" id="id_modelos_impresion_1" name="id_modelos_impresion_1" >
                                                <?php
                                                foreach ($id_modelos_impresion_1 as $key_id_modelos_impresion_1 => $valor_id_modelos_impresion_1) {
                                                    $selected = "";
                                                    if($predeterminado_modelos_impresion_1[$key_id_modelos_impresion_1] == 1) {
                                                        $selected = " selected";
                                                    }
                                                    ?>
                                                    <option value="<?php echo $valor_id_modelos_impresion_1; ?>"<?php echo $selected; ?>><?php echo $descripcion_modelos_impresion_1[$key_id_modelos_impresion_1]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex flex-wrap items-center justify-end p-6 space-x-2 rounded-b">
                                            <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="imprimirDocumentoPDF(idDocumento,ejercicio,document.getElementById('id_modelos_impresion_1').value);" data-modal-toggle="modal-impresion">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FINAL MODAL -->
                            <button id="botonOpenModalCobrar" class="hidden" type="button" data-modal-toggle="capa-cobrar-modal">
                                Toggle modal
                            </button>
                            <?php
                            $descripcionCobro = 'cobro';
                            $descripcionCobrar = 'Cobrar';
                            if (isset($tipo_librador) && ($tipo_librador == 'pro' || $tipo_librador == 'cre')) {
                                $descripcionCobro = 'pago';
                                $descripcionCobrar = 'Pagar';
                            }
                            ?>
                            <div id="capa-cobrar-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                                <div class="relative p-4 w-full sm:w-5/6 h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-blendimodal-background shadow dark:bg-white">
                                        <!-- Modal header -->
                                        <div class="flex justify-between items-start p-4 rounded-t">
                                            <h3 class="text-xl font-semibold" id="titulo-cobrar-modal">
                                                <?php echo $descripcionCobrar; ?>
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="imprimirDocumento(idDocumento,ejercicio,'','');">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="capa-cobrar-modal">
                                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Cerrar pantalla</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="w-full px-4 pb-4" id="body-cobrar-modal">
                                            Cargando <?php echo $descripcionCobro; ?>...
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex flex-wrap items-center justify-end p-6 space-x-2 rounded-b">
                                            <button data-modal-toggle="capa-cobrar-modal" type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" id="cerrar_modal_cobro">Descartar</button>
                                            <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="cobrarDocumentoEleccionEjecucion('<?php echo strtolower($librador_tipo); ?>');">Finalizar pago</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button id="botonOpenModalTiquetCocina" class="hidden" type="button" data-modal-toggle="capa-tiquet-cocina-modal">
                                Toggle modal
                            </button>
                            <div id="capa-tiquet-cocina-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                                <div class="relative p-4 w-full sm:w-5/6 h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white shadow dark:bg-white">
                                        <!-- Modal header -->
                                        <!--<div class="flex justify-between items-start p-4 rounded-t">
                                            <h3 class="text-xl font-semibold" id="titulo-tiquet-cocina-modal">
                                                Resumen tíquet
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="capa-tiquet-cocina-modal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Cerrar pantalla</span>
                                            </button>
                                        </div>-->
                                        <!-- Modal body -->
                                        <div class="w-full pb-4 overflow-y-auto" style="max-height: 70%;" id="body-tiquet-cocina-modal">
                                            Cargando...
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex flex-wrap items-center justify-end p-6 space-x-2">
                                            <button type="button" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" data-modal-toggle="capa-cobrar-modal" onclick="document.getElementById('botonOpenModalTiquetCocina').click(); cobrarModal();">Cobrar</button>
                                            <div class="grow">&nbsp;</div>
                                            <button type="button" class="text-gray-650 bg-white border border-gray-650 text-sm font-medium px-5 py-2.5" data-modal-toggle="capa-tiquet-cocina-modal">Seguir añadiendo</button>
                                            <button type="button" class="text-white bg-blendi-600 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="cerrarDocumento();">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div id="capaImprimir"></div>
            </div>
        </div>
        <?php
        if($interface == "web") {
            require("index-registro.php");
        }
        ?>

        <div class="fixed bottom-0 w-full sm:hidden">
            <div class="flex items-center py-1 px-3 mx-3 rounded-lg bg-gray-200 hidden" id="producto_anadido_mobile">
                <div class="text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="grow" id="producto_anadido_descripcion_mobile">&nbsp;</div>
                <div class="text-right" id="producto_anadido_editar_mobile">&nbsp;</div>
                <div class="text-right ml-4" id="producto_anadido_eliminar_mobile">&nbsp;</div>
            </div>
        </div>
        <footer id="footer" class="sm:fixed bottom-0 text-center w-full bg-white py-1">
            <?php
            if($interface == "web") {
                ?>
                <div class="l-footer">
                    <img src="<?php echo $host; ?>images/logo_cuidatumusica_300.jpg" id="imagen-logo" class="w-70" alt="" title="" />
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam atque recusandae in sit sunt molestiae aliquid fugit. Mollitia eaque tempore iure sit nobis? Vitae nemo, optio maiores numquam quis recusandae.</p>
                </div>
                <ul class="r-footer">
                    <li>
                        <h2>
                            Social</h2>
                        <ul class="footer-box">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Pinterest</a></li>
                            <li><a href="#">Dribbble</a></li>
                        </ul>
                    </li>
                    <li class="features">
                        <h2>
                            Information</h2>
                        <ul class="footer-box h-box">
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Sales</a></li>
                            <li><a href="#">Tickets</a></li>
                            <li><a href="#">Certifications</a></li>
                            <li><a href="#">Customer Service</a></li>
                        </ul>
                    </li>
                    <li>
                        <h2>
                            Legal</h2>
                        <ul class="footer-box">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Contract</a></li>
                        </ul>
                    </li>
                </ul>
                <?php
            }
            ?>
            <div class="b-footer">
                <p>
                    All rights reserved by ©BLENDI 2022 - <?php echo date('Y'); ?> - <a href="<?php echo $host; ?>?accion=versiones" target="_blank">V. 0.18.36</a>
                </p>
            </div>
        </footer>

        <div id="notificaciones-mensajes" class="fixed bottom-2 right-2 bg-white dark:text-black p-3 w-1/4 hidden">
            <div id="notificaciones-mensajes-titulo" class="text-md font-bold">
                &nbsp;
            </div>
            <div id="notificaciones-mensajes-body" class="text-sm">
                &nbsp;
            </div>
        </div>

        <script>
            (function() {
                if(idDocumento != 0) {
                    if(mostrarCesta == "superior") {
                        lineasCesta('');
                    }else {
                        actualizarCesta();
                    }
                } else {
                    actualizarCesta();
                }
                if(interface_js == "web") {
                    if (libradorNombre != "") {
                        document.getElementById("opcionesInicio").style.display = "none";
                        document.getElementById("datosInicio").style.display = "block";
                        document.getElementById("nombreLibrador").innerHTML = libradorNombre;
                    } else if (libradorComercial != "" && libradorComercial != "Ventas") {
                        document.getElementById("opcionesInicio").style.display = "none";
                        document.getElementById("datosInicio").style.display = "block";
                        document.getElementById("nombreLibrador").innerHTML = libradorComercial;
                    } else if (libradorSocial != "" && libradorSocial != "Ventas") {
                        document.getElementById("opcionesInicio").style.display = "none";
                        document.getElementById("datosInicio").style.display = "block";
                        document.getElementById("nombreLibrador").innerHTML = libradorSocial;
                    } else {
                        document.getElementById("opcionesInicio").style.display = "block";
                        document.getElementById("datosInicio").style.display = "none";
                    }
                }
                <?php
                if(!empty($ruta) && $ruta == "cobrar") {
                    ?>
                    window.ultimoElementoImporteEntregado = -1;
                    datosCobrar("0");
                    <?php
                }
                if(!empty($ruta) && $ruta == "cobrar-productos") {
                    if($lineas_documento > 1) {
                        ?>
                        window.ultimoElementoImporteEntregado = -1;
                        datosCobrar("1");
                        <?php
                    }else {
                        ?>
                        window.ultimoElementoImporteEntregado = -1;
                        datosCobrar("0");
                        <?php
                    }
                }

                ?>
            })();

            window.onload = function () {
                <?php
                if(!empty($ruta) && ($ruta == "cobrar" || $ruta == "cobrar-productos")) {
                    ?>
                    if(ultimoElementoImporteEntregado >= 0) {
                        document.getElementById("importe-entregado_" + ultimoElementoImporteEntregado).select();
                        document.getElementById("importe-entregado_" + ultimoElementoImporteEntregado).focus();
                    }
                    <?php
                }else {
                    ?>

                    setHeights();

                    var focoMarcado = false;
                    <?php
                    if($mostrar_cesta == "lateral" && $tipo_librador == "del") {
                        ?>
                        if(document.getElementById("mobil_documento").value == "") {
                            document.getElementById("mobil_documento").focus();
                            focoMarcado = true;
                        }
                        <?php
                    }
                    ?>
                    if(focoMarcado == false) {
                        document.getElementById("textoBuscar").focus();
                    }
                    <?php
                }
                if ($id_producto_modal_sys && $descripcion_modal_sys && $tipo_producto_modal_sys) {
                    ?>
                    detallesProductoModal('<?php echo addslashes($descripcion_modal_sys); ?>', '<?php echo $id_producto_modal_sys;?>', '', '<?php echo $tipo_producto_modal_sys;?>', -1, false, '', '<?php echo (isset($dato_buscar))? $dato_buscar : ''; ?>');
                    document.getElementById('botonOpenModalProducto').click();
                    <?php
                }
                if($path_components[$indice_componente] == "documentos") {
                    if (isset($path_components[$indice_componente + 1])) {
                        $datosDocumento = $path_components[$indice_componente + 1];
                        $datosDocumento = explode('-', $datosDocumento);
                        if (count($datosDocumento) == 3) {
                            ?>
                            abrirDocumento('<?php echo $datosDocumento[0]; ?>', '<?php echo $datosDocumento[1]; ?>', '<?php echo $datosDocumento[2]; ?>');
                            <?php
                        }
                    } else {
                        ?>
                        if (window.innerWidth < 640) {
                            document.getElementById('boton-toggle-menu-header').click();
                        }
                        actualizarOtrosDocumentos('capa-otros-documentos', 'global', 'abiertos', 'mostrar');

                        <?php
                    }
                }
                if($path_components[$indice_componente] == "comedor") {
                    $zonaDisplay = 'comedor';
                    ?>
                    if (window.innerWidth < 640) {
                        document.getElementById('boton-toggle-menu-header').click();
                    }
                    let continuar = cerrarDocumento();
                    if (continuar) {
                        zonaDisplay = 'comedor';
                        gestionDeCapasGenerales();
                    }
                    <?php
                }
                ?>
            };

            (function() {
                if(sessionStorage.getItem('url_retorno_tpv')) {
                    sessionStorage.removeItem('url_retorno_tpv');
                }

                window.inputBuscar = document.getElementById('textoBuscar');
                inputBuscar.addEventListener('keyup', function(e) {
                    var keycode = e.keyCode || e.which;
                    if (keycode == 13) {
                        buscar(document.getElementById('textoBuscar').value);
                    }
                });

                gestionDeCapasGenerales();
            })();
        </script>
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
                        socket.emit("sendMessage", panel, terminal, message);
                    }
                    window.assignPanelAndTerminal = function (panel, terminal) {
                        // assign panel and terminal to the server
                        socket.emit("assignPanelAndTerminal", panel, terminal);
                    }

                    // receive a message from the server
                    window.socket.on("newMessage", (...message) => {
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
                                }, 10000);
                            }
                        }
                    });

                    window.assignPanelAndTerminal('<?php echo $id_panel; ?>', '<?php echo (empty($id_terminal_sys))? '1' : $id_terminal_sys; ?>');
                });
            }
        </script>
        <?php
    }
    if ($isCodigoPromocional) {
        echo "<script>document.getElementById(\"handleRegistroClick\").click();</script>";
    }
    ?>
</div>
</body>
</html>
<?php
$length = ob_get_length();
header('Content-Length: '.$length);
